<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('package')->orderBy('created_at', 'desc')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'admin_notes' => 'nullable|string'
        ]);

        $updates = [
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ];

        if ($request->status === 'confirmed' && !$booking->confirmed_at) {
            $updates['confirmed_at'] = now();
            // Automatically log current user id if we had full auth setup, but kept simplified here:
            // $updates['confirmed_by'] = auth('admin')->id(); 
        }

        $booking->update($updates);
        return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
