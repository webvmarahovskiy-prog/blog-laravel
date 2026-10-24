<?php

use App\Livewire\Forms\SubscriberForm;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('shows the subscribe form on the home page', function () {
    $this->get('/')
        ->assertOk()
        ->assertSeeLivewire(SubscriberForm::class);
});

it('subscribes, resets the form and flashes success', function () {
    Livewire::test(SubscriberForm::class)
        ->set('email', 'ivan@example.com')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('email', '')
        ->assertSee('Дякуємо! Ви підписалися на розсилку.');

    $this->assertDatabaseHas('subscribers', ['email' => 'ivan@example.com']);
});

it('validates the email', function (string $email, string $rule) {
    Livewire::test(SubscriberForm::class)
        ->set('email', $email)
        ->call('save')
        ->assertHasErrors(['email' => $rule]);

    $this->assertDatabaseCount('subscribers', 0);
})->with([
    'empty' => ['', 'required'],
    'invalid' => ['not-an-email', 'email'],
]);

it('does not subscribe the same email twice', function (string $email) {
    Subscriber::create(['email' => 'ivan@example.com']);

    Livewire::test(SubscriberForm::class)
        ->set('email', $email)
        ->call('save')
        ->assertHasErrors(['email' => 'unique'])
        ->assertSee('Цей email уже підписаний на розсилку.');

    $this->assertDatabaseCount('subscribers', 1);
})->with([
    'same case' => 'ivan@example.com',
    'different case and spaces' => '  Ivan@Example.COM ',
]);
