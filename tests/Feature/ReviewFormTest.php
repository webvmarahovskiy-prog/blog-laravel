<?php

use App\Livewire\Forms\ReviewForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('displays the reviews page with the form', function () {
    $this->get('/reviews')
        ->assertOk()
        ->assertSee('Відгуки')
        ->assertSeeLivewire(ReviewForm::class);
});

it('stores the review, resets the form and flashes success', function () {
    Livewire::test(ReviewForm::class)
        ->set('name', 'Іван')
        ->set('rating', 4)
        ->set('body', 'Добре, але є що покращити.')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('name', '')
        ->assertSet('rating', null)
        ->assertSet('body', '')
        ->assertSee('Дякуємо за відгук!');

    $this->assertDatabaseHas('reviews', [
        'name' => 'Іван',
        'rating' => 4,
        'body' => 'Добре, але є що покращити.',
    ]);
});

it('requires all fields', function () {
    Livewire::test(ReviewForm::class)
        ->call('save')
        ->assertHasErrors(['name' => 'required', 'rating' => 'required', 'body' => 'required']);

    $this->assertDatabaseCount('reviews', 0);
});

it('rejects a rating outside 1 to 5', function (int $rating) {
    Livewire::test(ReviewForm::class)
        ->set('name', 'Іван')
        ->set('rating', $rating)
        ->set('body', 'Текст')
        ->call('save')
        ->assertHasErrors(['rating' => 'between']);

    $this->assertDatabaseCount('reviews', 0);
})->with([0, 6, -1]);
