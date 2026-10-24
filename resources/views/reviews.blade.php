<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Відгуки — {{ config('app.name', 'Laravel') }}</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: system-ui, -apple-system, "Segoe UI", sans-serif; background: #f5f5f4; color: #1c1917; }
        main { max-width: 560px; margin: 48px auto; padding: 0 16px; }
        .card { background: #fff; border: 1px solid #e7e5e4; border-radius: 12px; padding: 32px; }
        h1 { margin: 0 0 8px; font-size: 24px; }
        p.lead { margin: 0 0 24px; color: #57534e; }
        label, legend { display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px; }
        input[type="text"], textarea { width: 100%; padding: 10px 12px; border: 1px solid #d6d3d1; border-radius: 8px; font: inherit; }
        input[type="text"]:focus, textarea:focus { outline: 2px solid #f53003; outline-offset: 1px; border-color: transparent; }
        textarea { min-height: 140px; resize: vertical; }
        fieldset { margin: 0; padding: 0; border: 0; }
        .field { margin-bottom: 18px; }
        .field.has-error input[type="text"], .field.has-error textarea { border-color: #dc2626; }
        .rating-options { display: flex; gap: 8px; }
        .rating-option { margin: 0; }
        .rating-option input { position: absolute; opacity: 0; }
        .rating-option span { display: inline-flex; align-items: center; justify-content: center; width: 44px; height: 44px; border: 1px solid #d6d3d1; border-radius: 8px; cursor: pointer; font-weight: 600; }
        .rating-option input:checked + span { background: #1c1917; border-color: #1c1917; color: #fff; }
        .rating-option input:focus-visible + span { outline: 2px solid #f53003; outline-offset: 1px; }
        .field.has-error .rating-option span { border-color: #dc2626; }
        .error { margin-top: 6px; color: #dc2626; font-size: 13px; }
        .status { margin-bottom: 20px; padding: 12px 14px; border-radius: 8px; background: #dcfce7; color: #166534; }
        button { padding: 11px 20px; border: 0; border-radius: 8px; background: #1c1917; color: #fff; font: inherit; font-weight: 600; cursor: pointer; }
        button:hover { background: #f53003; }
    </style>
    @livewireStyles
</head>
<body>
<main>
    <div class="card">
        <h1>Відгуки</h1>
        <p class="lead">Поділіться враженнями: оцініть нас від 1 до 5 і напишіть кілька слів.</p>

        <livewire:forms.review-form />
    </div>
</main>
@livewireScripts
</body>
</html>
