<?php

namespace Tests\Feature;



use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;


class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_creation()
    {
        $user = [
            'name' => 'John',
            'email' => 'shlatim@yandex.ry',
            'password' => 'qwerty123',
            'role' => 'user'
        ];

        $response = $this->post('/create', $user);

        // Основные проверки
        $response->assertStatus(302);
        $response->assertRedirect('/login');

        // Проверки БД
        $this->assertDatabaseHas('user', [
            'name' => 'John',
            'email' => 'shlatim@yandex.ry',
            'role' => 'user'
        ]);

        // Проверка пароля
        $createdUser = User::where('email', 'shlatim@yandex.ry')->first();
        $this->assertNotNull($createdUser);
        $this->assertTrue(Hash::check('qwerty123', (string)$createdUser->password));

    }

    public function test_auth_user(): void
    {
        // 1. Сначала создаем пользователя в базе
        $user = User::create([
            'name' => 'John',
            'email' => 'shlatim@yandex.ru',
            'password' => 'qwerty123',
            'role' => 'user'
        ]);

        // 2. Пытаемся аутентифицироваться
        $response = $this->post('/auth', [
            'email' => $user->email,
            'password' => 'qwerty123', 
            'name' => $user->name
        ]);

        // 3. Проверки
        $response->assertStatus(302); // Проверяем редирект после успешной аутентификации
        $response->assertRedirect('/dashboard'); // Укажите ожидаемый маршрут редиректа

        // 5. Проверяем сессию (если используется)
        $this->assertTrue(session()->has('user_id'));
        $this->assertEquals($user->id, session('user_id'));
    }

    public function test_update_data(): void
    {
        $user = User::create([
            'name' => 'John',
            'email' => 'shlatim@yandex.ru',
            'password' => 'qwerty123',
            'role' => 'user'
        ]);

        Session::put('user_id', $user->id);

        $response = $this->put('/update_data', [
            'name' => 'anton',
            'email' => 'anton@yandex.ru',
            'phone' => '89117953775',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');

        $this->assertDatabaseHas('user', [
            'name' => 'anton',
            'email' => 'anton@yandex.ru',
            'phone' => '89117953775'
        ]);

        $this->assertDatabaseMissing('user', [
            'name' => 'John',
            'email' => 'shlatim@yandex.ru',
            'password' => 'qwerty123',
        ]);
    }

    public function test_exit(): void 
    {
        Session::put('user_id', 1);

        $response = $this->get('/dashboard/exit');

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $this->assertFalse(session()->has('user_id'));
    }

    public function test_dasboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }
}