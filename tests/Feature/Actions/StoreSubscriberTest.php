<?php

use App\Actions\Subscriber\StoreSubscriber;
use App\Models\Subscriber;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores a subscriber', function () {
    $subscriber = (new StoreSubscriber)->handle(['email' => 'ivan@example.com']);

    expect($subscriber)->toBeInstanceOf(Subscriber::class)
        ->and($subscriber->exists)->toBeTrue();

    $this->assertDatabaseHas('subscribers', ['email' => 'ivan@example.com']);
});

it('does not store the same email twice', function () {
    (new StoreSubscriber)->handle(['email' => 'ivan@example.com']);

    expect(fn () => (new StoreSubscriber)->handle(['email' => 'ivan@example.com']))
        ->toThrow(UniqueConstraintViolationException::class);

    $this->assertDatabaseCount('subscribers', 1);
});
