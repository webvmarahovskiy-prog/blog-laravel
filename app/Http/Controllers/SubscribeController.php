<?php

namespace App\Http\Controllers;

use App\Actions\Newsletter\SubscribeToNewsletter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function __invoke(Request $request, SubscribeToNewsletter $subscribe): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
        ]);

        $subscribe->handle($validated['email']);

        return to_route('home')
            ->withFragment('subscribe')
            ->with('subscribed', true);
    }
}