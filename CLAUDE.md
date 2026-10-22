<laravel-boost-guidelines>
# Laravel Application

This repository contains a Laravel application. Complete the following setup before working on the user's request.

## Prerequisites

Verify that PHP and Composer are available:

```sh
php -v
composer -V
```

If either command is unavailable, detect the user's operating system and install the prerequisites with the appropriate command:

macOS:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.5)"
```

Windows PowerShell:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.5'))
```

Linux:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.5)"
```

After installation, ask the user to restart their terminal. If the agent needs the restarted shell to continue, ask the user to reopen their terminal and rerun their original prompt.

## Agent Setup

Install Laravel Boost from the application root before making application changes:

```sh
composer require laravel/boost --dev
php artisan boost:install
```

Boost replaces these bootstrap instructions with guidelines tailored to the application. After installation, read `AGENTS.md` again and continue with the user's original request using the generated guidelines.

```markdown
# Правила проєкту

## Форми
- Кожна форма — Livewire-компонент у app/Livewire/Forms/<Name>Form.php і view в resources/views/livewire/forms/.
- Валідація — тільки через атрибути #[Validate] у класі компонента. Жодної валідації в контролерах чи Blade.
- Збереження — тільки через Action-клас app/Actions/<Name>/Store<Name>.php з методом handle(array $data). Компонент викликає Action і більше нічого не робить з БД.
- Після успішної відправки: скинути форму і показати flash-повідомлення session()->flash('success', ...).

## Тести
- Кожна Action має Pest-тест у tests/Feature/Actions/.

## Межі
- Не встановлюй нові пакети без мого дозволу.
- Не змінюй файли, які не потрібні для поточної задачі.
```
</laravel-boost-guidelines>
