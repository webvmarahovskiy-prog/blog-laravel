<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Зворотний зв'язок — {{ config('app.name', 'Laravel') }}</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: system-ui, -apple-system, "Segoe UI", sans-serif; background: #f5f5f4; color: #1c1917; }
        main { max-width: 560px; margin: 48px auto; padding: 0 16px; }
        .card { background: #fff; border: 1px solid #e7e5e4; border-radius: 12px; padding: 32px; }
        h1 { margin: 0 0 8px; font-size: 24px; }
        p.lead { margin: 0 0 24px; color: #57534e; }
        label { display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px; }
        input, textarea { width: 100%; padding: 10px 12px; border: 1px solid #d6d3d1; border-radius: 8px; font: inherit; }
        input:focus, textarea:focus { outline: 2px solid #f53003; outline-offset: 1px; border-color: transparent; }
        textarea { min-height: 140px; resize: vertical; }
        .field { margin-bottom: 18px; }
        .field.has-error input, .field.has-error textarea { border-color: #dc2626; }
        .error { margin-top: 6px; color: #dc2626; font-size: 13px; }
        .status { margin-bottom: 20px; padding: 12px 14px; border-radius: 8px; background: #dcfce7; color: #166534; }
        button { padding: 11px 20px; border: 0; border-radius: 8px; background: #1c1917; color: #fff; font: inherit; font-weight: 600; cursor: pointer; }
        button:hover { background: #f53003; }
    </style>
</head>
<body>
<main>
    <div class="card">
        <h1>Зворотний зв'язок</h1>
        <p class="lead">Напишіть нам, і ми відповімо на вказаний email.</p>

        @if (session('status'))
            <div class="status" role="status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" novalidate>
            @csrf

            <div class="field @error('name') has-error @enderror">
                <label for="name">Ім'я</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="255" autocomplete="name">
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field @error('email') has-error @enderror">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email">
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field @error('message') has-error @enderror">
                <label for="message">Повідомлення</label>
                <textarea id="message" name="message" required maxlength="5000">{{ old('message') }}</textarea>
                @error('message') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit">Надіслати</button>
        </form>
    </div>
</main>
</body>
</html>
