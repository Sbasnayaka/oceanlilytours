<?php

namespace App\Http\Controllers;

use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class AdminWhyChooseUsController extends Controller
{
    public function index()
    {
        $features = WhyChooseUs::orderBy('display_order', 'asc')->get();
        return view('admin.why-choose-us.index', compact('features'));
    }

    public function create()
    {
        return view('admin.why-choose-us.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'icon_class'  => 'nullable|max:100',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        WhyChooseUs::create($data);
        return redirect()->route('why-choose-us.index')->with('success', 'Feature added successfully.');
    }

    public function edit($id)
    {
        $feature = WhyChooseUs::findOrFail($id);
        return view('admin.why-choose-us.edit', compact('feature'));
    }

    public function update(Request $request, $id)
    {
        $feature = WhyChooseUs::findOrFail($id);

        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'icon_class'  => 'nullable|max:100',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        $feature->update($data);
        return redirect()->route('why-choose-us.index')->with('success', 'Feature updated successfully.');
    }

    public function destroy($id)
    {
        WhyChooseUs::findOrFail($id)->delete();
        return redirect()->route('why-choose-us.index')->with('success', 'Feature deleted.');
    }
}
