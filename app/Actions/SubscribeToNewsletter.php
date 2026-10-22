<?php

namespace App\Actions\Newsletter;

use App\Models\Subscriber;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class SubscribeToNewsletter
{
    public function handle(string $email): Subscriber
    {
        try {
            return Subscriber::create(['email' => Str::lower(trim($email))]);
        } catch (UniqueConstraintViolationException) {
            throw ValidationException::withMessages([
                'email' => 'Цей email вже підписаний на розсилку.',
            ]);
        }
    }
}