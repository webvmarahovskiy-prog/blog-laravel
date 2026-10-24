<div>
    @if (session('success'))
        <div class="status" role="status">{{ session('success') }}</div>
    @endif

    <form wire:submit="save" novalidate>
        <div class="field @error('name') has-error @enderror">
            <label for="name">Ім'я</label>
            <input id="name" wire:model="name" type="text" required maxlength="255" autocomplete="name">
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <fieldset class="field rating @error('rating') has-error @enderror">
            <legend>Оцінка</legend>
            <div class="rating-options">
                @foreach (range(1, 5) as $value)
                    <label class="rating-option">
                        <input type="radio" wire:model="rating" name="rating" value="{{ $value }}" required>
                        <span>{{ $value }}</span>
                    </label>
                @endforeach
            </div>
            @error('rating') <div class="error">{{ $message }}</div> @enderror
        </fieldset>

        <div class="field @error('body') has-error @enderror">
            <label for="body">Відгук</label>
            <textarea id="body" wire:model="body" required maxlength="5000"></textarea>
            @error('body') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled">Надіслати відгук</button>
    </form>
</div>
