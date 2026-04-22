<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('display_order', 'asc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'icon' => 'nullable|max:255',
            'display_order' => 'integer'
        ]);
        $validated['active'] = $request->has('active');

        Service::create($validated);
        return redirect()->route('services.index')->with('success', 'Service added.');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'icon' => 'nullable|max:255',
            'display_order' => 'integer'
        ]);
        $validated['active'] = $request->has('active');

        $service->update($validated);
        return redirect()->route('services.index')->with('success', 'Service updated.');
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted.');
    }
}
