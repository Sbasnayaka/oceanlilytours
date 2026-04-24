<?php

namespace App\Http\Controllers;

use App\Models\NavbarItem;
use Illuminate\Http\Request;

class AdminNavbarController extends Controller
{
    public function index()
    {
        $items = NavbarItem::with('children')->whereNull('parent_id')->orderBy('display_order', 'asc')->get();
        return view('admin.navbar-items.index', compact('items'));
    }

    public function create()
    {
        $parents = NavbarItem::whereNull('parent_id')->get();
        return view('admin.navbar-items.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|max:255',
            'url'   => 'nullable|max:500',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        NavbarItem::create($data);
        return redirect()->route('navbar-items.index')->with('success', 'Navbar item added.');
    }

    public function edit($id)
    {
        $item = NavbarItem::findOrFail($id);
        $parents = NavbarItem::whereNull('parent_id')->where('id', '!=', $id)->get();
        return view('admin.navbar-items.edit', compact('item', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $item = NavbarItem::findOrFail($id);
        $request->validate([
            'label' => 'required|max:255',
            'url'   => 'nullable|max:500',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        $item->update($data);
        return redirect()->route('navbar-items.index')->with('success', 'Navbar item updated.');
    }

    public function destroy($id)
    {
        $item = NavbarItem::findOrFail($id);
        // Also delete children? Let's be safe and set parent_id to null for children or delete them.
        // For a simple CMS, deleting children is often expected.
        NavbarItem::where('parent_id', $id)->delete();
        $item->delete();
        return redirect()->route('navbar-items.index')->with('success', 'Navbar item and sub-items deleted.');
    }
}
