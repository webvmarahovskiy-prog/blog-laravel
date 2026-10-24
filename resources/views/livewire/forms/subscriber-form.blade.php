<div class="subscribe">
    <style>
        .subscribe { margin-top: 24px; padding-top: 20px; border-top: 1px solid #e3e3e0; }
        .subscribe h2 { margin-bottom: 4px; font-weight: 500; }
        .subscribe p { margin-bottom: 10px; color: #706f6c; }
        .subscribe form { display: flex; gap: 8px; }
        .subscribe input { flex: 1; min-width: 0; padding: 6px 10px; border: 1px solid #19140035; border-radius: 2px; background: #fff; color: #1b1b18; }
        .subscribe input:focus { outline: 2px solid #f53003; outline-offset: 1px; }
        .subscribe button { padding: 6px 16px; border: 1px solid #000; border-radius: 2px; background: #1b1b18; color: #fff; cursor: pointer; }
        .subscribe button:hover { background: #000; }
        .subscribe .error { margin-top: 6px; color: #dc2626; }
        .subscribe .status { margin-bottom: 10px; color: #166534; }
        @media (prefers-color-scheme: dark) {
            .subscribe { border-top-color: #3e3e3a; }
            .subscribe p { color: #a1a09a; }
            .subscribe input { background: #0a0a0a; color: #ededec; border-color: #3e3e3a; }
            .subscribe button { background: #eeeeec; border-color: #eeeeec; color: #1c1c1a; }
            .subscribe button:hover { background: #fff; }
            .subscribe .status { color: #4ade80; }
        }
    </style>

    <h2>Підписка на розсилку</h2>
    <p>Залиште email — надсилатимемо новини, без спаму.</p>

    @if (session('success'))
        <div class="status" role="status">{{ session('success') }}</div>
    @endif

    <form wire:submit="save" novalidate>
        <input id="subscriber-email" aria-label="Email" wire:model="email" type="email" required maxlength="255" autocomplete="email" placeholder="you@example.com">
        <button type="submit" wire:loading.attr="disabled">Підписатися</button>
    </form>
    @error('email') <div class="error">{{ $message }}</div> @enderror
</div>
