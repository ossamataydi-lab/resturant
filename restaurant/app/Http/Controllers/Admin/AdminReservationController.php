<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     */
public function index()
    {
        $reservations = Reservation::orderBy('reservation_time', 'desc')->get();
        $currentLocale = session('admin_locale', 'fr');

        // Map field names to match what the view expects
        $reservations = $reservations->map(function ($reservation) {
            return (object) [
                'id' => $reservation->id,
                'name' => $reservation->customer_name,
                'phone' => $reservation->customer_phone,
                'email' => '', // No email field in migration, default to empty
                'reservation_date' => \Carbon\Carbon::parse($reservation->reservation_time)->format('Y-m-d'),
                'reservation_time' => \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i'),
                'guest_count' => $reservation->guests_count,
                'status' => $reservation->status,
            ];
        });

        return view('admin.reservations.index', compact('reservations', 'currentLocale'));
    }

    /**
     * Update the specified reservation status.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status,
        ]);
        return redirect()->route('admin.reservations.index')->with('success', __('Réservation mise à jour avec succès!'));
    }

    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', __('Réservation supprimée avec succès!'));
    }
}
