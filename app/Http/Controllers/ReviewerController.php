<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class ReviewerController extends Controller
{
    public function show(User $user): View
    {
        $user->load([
            'reviews' => fn ($query) => $query->latest()->with('eatery'),
        ]);

        return view('reviewers.show', compact('user'));
    }
}