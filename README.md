# Laravel Blog

[![Tests](https://github.com/webvmarahovskiy-prog/blog-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/webvmarahovskiy-prog/blog-laravel/actions/workflows/tests.yml)
![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4-FB70A9?logo=livewire&logoColor=white)
![Pest](https://img.shields.io/badge/Tests-Pest%205-F28D1A)

Блог на Laravel 13 з інтерактивними формами на Livewire 4: зворотний зв'язок, підписка на розсилку та відгуки.

## Можливості

- **Контактна форма** — `/contact`, збереження повідомлень у `contact_messages`.
- **Підписка на розсилку** — збереження email у `subscribers`.
- **Відгуки** — `/reviews`, збереження у `reviews`.
- Валідація в реальному часі через атрибути `#[Validate]`.
- Flash-повідомлення після успішної відправки та скидання форми.

## Стек

| Компонент | Версія |
|-----------|--------|
| PHP       | 8.5    |
| Laravel   | 13     |
| Livewire  | 4      |
| Pest      | 5      |
| PHPUnit   | 13     |
| БД        | SQLite (за замовчуванням) |
| Фронтенд  | Vite   |

## Вимоги

- PHP >= 8.5
- Composer
- Node.js та npm

## Встановлення

```bash
git clone git@github.com:webvmarahovskiy-prog/blog-laravel.git
cd blog-laravel
composer setup
```

Скрипт `composer setup` встановлює залежності, створює `.env`, генерує ключ застосунку, запускає міграції та збирає фронтенд.

<details>
<summary>Встановлення вручну</summary>

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
npm install
npm run build
```

</details>

## Запуск

```bash
composer dev
```

Застосунок буде доступний за адресою http://localhost:8000.

### Docker

```bash
docker compose up -d
```

## Тести

```bash
composer test
```

Або напряму:

```bash
php artisan test
```

Тести також запускаються автоматично в GitHub Actions ([`.github/workflows/tests.yml`](.github/workflows/tests.yml)) при кожному push і pull request.

## Архітектура

Кожна форма складається з трьох частин:

```
app/
├── Livewire/Forms/<Name>Form.php      # Livewire-компонент, валідація через #[Validate]
├── Actions/<Name>/Store<Name>.php     # Збереження в БД, метод handle(array $data)
resources/views/livewire/forms/        # Blade-шаблони форм
tests/Feature/Actions/                 # Pest-тести для кожної Action
```

Потік даних:

```
Blade view → Livewire Form (#[Validate]) → Store<Name>::handle($data) → Model → БД
                     ↓
        reset() + session()->flash('success', ...)
```

### Приклад

```php
// app/Livewire/Forms/ContactMessageForm.php
#[Validate('required|email|max:255', as: 'email')]
public string $email = '';

public function save(StoreContactMessage $storeContactMessage): void
{
    $storeContactMessage->handle($this->validate());

    $this->reset();

    session()->flash('success', 'Дякуємо! Ваше повідомлення надіслано.');
}
```

### Наявні форми

| Форма | Компонент | Action | Модель |
|-------|-----------|--------|--------|
| Контакти | `ContactMessageForm` | `StoreContactMessage` | `ContactMessage` |
| Підписка | `SubscriberForm` | `StoreSubscriber` | `Subscriber` |
| Відгуки | `ReviewForm` | `StoreReview` | `Review` |

## Додавання нової форми

1. Створи міграцію та модель: `php artisan make:model Post -m`
2. Створи Action `app/Actions/Post/StorePost.php` з методом `handle(array $data)`.
3. Створи Livewire-компонент `app/Livewire/Forms/PostForm.php` з атрибутами `#[Validate]`.
4. Додай view у `resources/views/livewire/forms/post-form.blade.php`.
5. Напиши Pest-тест у `tests/Feature/Actions/StorePostTest.php`.

## Код-стайл

```bash
./vendor/bin/pint
```

## Ліцензія

Проєкт розповсюджується під ліцензією [MIT](https://opensource.org/licenses/MIT).
