<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_is_displayed(): void
    {
        $this->get('/contact')->assertOk()->assertSee('Зворотний зв\'язок', false);
    }

    public function test_message_is_stored(): void
    {
        $this->post('/contact', [
            'name' => 'Іван',
            'email' => 'ivan@example.com',
            'message' => 'Привіт!',
        ])->assertRedirect(route('contact'))->assertSessionHas('status');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Іван',
            'email' => 'ivan@example.com',
            'message' => 'Привіт!',
        ]);
    }

    public function test_fields_are_validated(): void
    {
        $this->post('/contact', ['email' => 'not-an-email'])
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }
}
