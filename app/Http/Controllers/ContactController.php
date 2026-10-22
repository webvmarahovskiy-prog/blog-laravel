<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ], [
            'required' => 'Заповніть це поле.',
            'email' => 'Вкажіть коректний email.',
            'max' => 'Занадто довго: максимум :max символів.',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contact')->with('status', 'Дякуємо! Ваше повідомлення надіслано.');
    }
}
