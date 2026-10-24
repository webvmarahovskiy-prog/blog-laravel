<?php

use App\Livewire\Forms\ContactMessageForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('displays the contact page with the form', function () {
    $this->get('/contact')
        ->assertOk()
        ->assertSee('Зворотний зв\'язок', false)
        ->assertSeeLivewire(ContactMessageForm::class);
});

it('stores the message, resets the form and flashes success', function () {
    Livewire::test(ContactMessageForm::class)
        ->set('name', 'Іван')
        ->set('email', 'ivan@example.com')
        ->set('message', 'Привіт!')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('name', '')
        ->assertSet('email', '')
        ->assertSet('message', '')
        ->assertSee('Дякуємо! Ваше повідомлення надіслано.');

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Іван',
        'email' => 'ivan@example.com',
        'message' => 'Привіт!',
    ]);
});

it('validates the fields', function () {
    Livewire::test(ContactMessageForm::class)
        ->set('email', 'not-an-email')
        ->call('save')
        ->assertHasErrors(['name' => 'required', 'email' => 'email', 'message' => 'required']);

    $this->assertDatabaseCount('contact_messages', 0);
});
