<?php

namespace Tests\Feature;



use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;


class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user(): void
    {
        $user = [
                'name' => 'John',
                'email' => 'shlatim@yandex.ry',
                'password' => 'qwerty123',
                'role' => 'user'
        ];

        $response = $this->post('/create', $user);

        $response->assertStatus(302);
        $this->assertDatabaseHas('user', [
            'name' => 'John',
            'email' => 'shlatim@yandex.ry'
        ]);
    }

    public function test_auth_user(): void 
    {
        $user = User::factory()->create(['password' => 'qwerty123']);

        $response = $this->post('/auth', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'qwerty123',
            'role' => 'user']);

        $response->assertStatus(302);

        Session::forget('user_id');
    }

    public function test_update_data(): void
    {
        $user = User::factory()->create(['password' => 'dont care']);

        $response = $this->put('/update_data', $user->toArray());

        $response->assertStatus(302);

        $this->assertDatabaseHas('user', [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone
        ]);
    }

    public function test_exit(): void 
    {
        Session::put('user_id', 1);

        $response = $this->get('/dashboard/exit');

        $response->assertStatus(302);

        if (Session::get('user_id')) 
        {
            throw new Exception('Не получилось выйти');
        }
    }

    public function test_dasboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }
}