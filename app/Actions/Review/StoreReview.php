<?php

namespace App\Actions\Review;

use App\Models\Review;

class StoreReview
{
    /**
     * @param  array{name: string, rating: int, body: string}  $data
     */
    public function handle(array $data): Review
    {
        return Review::create($data);
    }
}
