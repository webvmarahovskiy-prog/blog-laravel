<?php

namespace App\Actions\ContactMessage;

use App\Models\ContactMessage;

class StoreContactMessage
{
    /**
     * @param  array{name: string, email: string, message: string}  $data
     */
    public function handle(array $data): ContactMessage
    {
        return ContactMessage::create($data);
    }
}
