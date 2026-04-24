<?php

namespace App\Http\Controllers;

use App\Models\FooterContent;
use Illuminate\Http\Request;

class AdminFooterController extends Controller
{
    public function index()
    {
        $items = FooterContent::orderBy('section')->orderBy('display_order')->get();
        return view('admin.footer-items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.footer-items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'section'  => 'required|max:255',
            'key_name' => 'required|max:255',
            'value'    => 'required',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        FooterContent::create($data);
        return redirect()->route('footer-items.index')->with('success', 'Footer item added.');
    }

    public function edit($id)
    {
        $item = FooterContent::findOrFail($id);
        return view('admin.footer-items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = FooterContent::findOrFail($id);
        $request->validate([
            'section'  => 'required|max:255',
            'key_name' => 'required|max:255',
            'value'    => 'required',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        $item->update($data);
        return redirect()->route('footer-items.index')->with('success', 'Footer item updated.');
    }

    public function destroy($id)
    {
        FooterContent::findOrFail($id)->delete();
        return redirect()->route('footer-items.index')->with('success', 'Footer item deleted.');
    }
}
