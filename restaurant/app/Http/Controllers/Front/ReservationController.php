<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function index()
    {
        return view('Client_Side.reservation');
    }


    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string',
            'reservation_time' => 'required|after:now',
            'guest_count' => 'required|integer|min:1',

        ]);
        

        Reservation::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'reservation_time' => $request->reservation_time,
            'guests_count' => $request->guest_count,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Votre réservation a été effectuée avec succès ! Nous vous répondrons dans une heure.');
    }
}
