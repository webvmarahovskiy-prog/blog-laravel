<?php

namespace App\Livewire\Forms;

use App\Actions\Subscriber\StoreSubscriber;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubscriberForm extends Component
{
    #[Validate('required|email|max:255|unique:subscribers,email', as: 'email', message: [
        'email.unique' => 'Цей email уже підписаний на розсилку.',
    ])]
    public string $email = '';

    public function save(StoreSubscriber $storeSubscriber): void
    {
        // Normalize before validating so "Ivan@Example.com" counts as a duplicate of "ivan@example.com".
        $this->email = Str::lower(trim($this->email));

        $storeSubscriber->handle($this->validate());

        $this->reset();

        session()->flash('success', 'Дякуємо! Ви підписалися на розсилку.');
    }

    public function render()
    {
        return view('livewire.forms.subscriber-form');
    }
}
