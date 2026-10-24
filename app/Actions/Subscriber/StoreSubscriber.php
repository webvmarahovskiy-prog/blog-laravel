<?php

namespace App\Actions\Subscriber;

use App\Models\Subscriber;

class StoreSubscriber
{
    /**
     * @param  array{email: string}  $data
     */
    public function handle(array $data): Subscriber
    {
        return Subscriber::create($data);
    }
}
