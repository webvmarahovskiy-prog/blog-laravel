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

        <div class="field @error('email') has-error @enderror">
            <label for="email">Email</label>
            <input id="email" wire:model="email" type="email" required maxlength="255" autocomplete="email">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field @error('message') has-error @enderror">
            <label for="message">Повідомлення</label>
            <textarea id="message" wire:model="message" required maxlength="5000"></textarea>
            @error('message') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled">Надіслати</button>
    </form>
</div>
