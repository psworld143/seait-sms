<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_user_can_view_register_page()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    public function test_user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'student',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    public function test_user_can_login_with_valid_credentials()
    {
        // Create a user with student role
        $role = Role::create(['name' => 'student']);
        $user = User::factory()->create();
        $user->assignRole('student');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/student/dashboard');
        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_admin_user_redirects_to_admin_dashboard()
    {
        $role = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/dashboard');
    }

    public function test_faculty_user_redirects_to_faculty_dashboard()
    {
        $role = Role::create(['name' => 'faculty']);
        $user = User::factory()->create();
        $user->assignRole('faculty');

        $response = $this->actingAs($user)->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/faculty/dashboard');
    }

    public function test_student_user_redirects_to_student_dashboard()
    {
        $role = Role::create(['name' => 'student']);
        $user = User::factory()->create();
        $user->assignRole('student');

        $response = $this->actingAs($user)->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/student/dashboard');
    }

    public function test_head_user_redirects_to_head_dashboard()
    {
        $role = Role::create(['name' => 'head']);
        $user = User::factory()->create();
        $user->assignRole('head');

        $response = $this->actingAs($user)->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/head/dashboard');
    }
}
