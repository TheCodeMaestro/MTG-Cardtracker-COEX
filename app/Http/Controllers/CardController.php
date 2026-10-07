<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\TrackedCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::limit(20)->get();
        return view('dashboard', ['cards' => $cards]);
    }

    // Track a card for the user
    public function track(Card $card)
    {
        $trackedCard = TrackedCard::firstOrCreate([
            'card_id' => $card->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrackedCard $trackedCard)
    {
        if ($trackedCard->user_id === Auth::id()) {
            $trackedCard->delete();
        }
        return redirect()->back();
    }

    // Show the tracked cards of the user
    public function showTrackedCards()
    {
        $trackedCards = TrackedCard::with('card')->where('user_id', Auth::id())->get();

        return view('trackedCards', [
            'trackedCards' => $trackedCards,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        //
    }
}
