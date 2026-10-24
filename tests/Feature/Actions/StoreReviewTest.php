<?php

use App\Actions\Review\StoreReview;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores a review', function () {
    $review = (new StoreReview)->handle([
        'name' => 'Іван',
        'rating' => 5,
        'body' => 'Все сподобалось!',
    ]);

    expect($review)->toBeInstanceOf(Review::class)
        ->and($review->exists)->toBeTrue()
        ->and($review->rating)->toBe(5);

    $this->assertDatabaseHas('reviews', [
        'name' => 'Іван',
        'rating' => 5,
        'body' => 'Все сподобалось!',
    ]);
});
