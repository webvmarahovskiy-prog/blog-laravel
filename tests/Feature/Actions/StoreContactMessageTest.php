<?php

use App\Actions\ContactMessage\StoreContactMessage;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores a contact message', function () {
    $contactMessage = (new StoreContactMessage)->handle([
        'name' => 'Іван',
        'email' => 'ivan@example.com',
        'message' => 'Привіт!',
    ]);

    expect($contactMessage)->toBeInstanceOf(ContactMessage::class)
        ->and($contactMessage->exists)->toBeTrue();

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Іван',
        'email' => 'ivan@example.com',
        'message' => 'Привіт!',
    ]);
});
