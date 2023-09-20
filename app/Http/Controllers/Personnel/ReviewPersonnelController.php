<?php

namespace App\Http\Controllers\Personnel;

use App\Models\Review;
use App\Events\ReviewCensoredEvent;
use App\Events\ReviewPublishedEvent;
use App\Http\Controllers\Controller;

class ReviewPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews =  Review::orderBy('created_at', 'DESC')->get();

        return view('personnel.reviews.index', compact('reviews'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('personnel.reviews.show', compact('review'));
    }

    /**
     * Autorise a publication of the review
     */

    public function publish(Review $review)
    {

        $review->published =  1;
        $review->censored = 0;
        $review->update();
        $user = $review->user;

        event(new ReviewPublishedEvent($user));

        return redirect()->route('personnel.reviews.index')->with('toast_success', 'Commentaire autorisé à la publication');
    }

    /**
     * Censor a review
     */

    public function censor(Review $review)
    {

        $review->published = 0;
        $review->censored = 1;
        $review->update();
        $user = $review->user;
        $user->censoredComments += 1;
        $user->update();

        event(new ReviewCensoredEvent($user));

        return redirect()->route('personnel.reviews.index')->with('toast_success', 'Commentaire censurée');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('personnel.reviews.index')->with('toast_success', 'Commentaire supprimé');
    }
}
