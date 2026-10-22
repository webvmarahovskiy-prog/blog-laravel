<?php 
namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::query()
            ->latest()
            ->paginate(10);

        return view('reviews.index', compact('reviews'));
    }

    public function store(StoreReviewRequest $request)
    {
        Review::create($request->validated());

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Дякуємо за ваш відгук!');
    }
}