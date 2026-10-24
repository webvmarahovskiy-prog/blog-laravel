<?php

namespace App\Livewire\Forms;

use App\Actions\ContactMessage\StoreContactMessage;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactMessageForm extends Component
{
    #[Validate('required|string|max:255', as: "ім'я")]
    public string $name = '';

    #[Validate('required|email|max:255', as: 'email')]
    public string $email = '';

    #[Validate('required|string|max:5000', as: 'повідомлення')]
    public string $message = '';

    public function save(StoreContactMessage $storeContactMessage): void
    {
        $storeContactMessage->handle($this->validate());

        $this->reset();

        session()->flash('success', 'Дякуємо! Ваше повідомлення надіслано.');
    }

    public function render()
    {
        return view('livewire.forms.contact-message-form');
    }
}
