<?php

namespace App\Livewire\Forms;

use App\Actions\Review\StoreReview;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ReviewForm extends Component
{
    #[Validate('required|string|max:255', as: "ім'я")]
    public string $name = '';

    #[Validate('required|integer|between:1,5', as: 'оцінка')]
    public ?int $rating = null;

    #[Validate('required|string|max:5000', as: 'відгук')]
    public string $body = '';

    public function save(StoreReview $storeReview): void
    {
        $storeReview->handle($this->validate());

        $this->reset();

        session()->flash('success', 'Дякуємо за відгук!');
    }

    public function render()
    {
        return view('livewire.forms.review-form');
    }
}
