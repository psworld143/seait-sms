<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_routes()
    {
        $role = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_faculty_can_access_faculty_routes()
    {
        $role = Role::create(['name' => 'faculty']);
        $user = User::factory()->create();
        $user->assignRole('faculty');

        $response = $this->actingAs($user)->get('/faculty/dashboard');
        $response->assertStatus(200);
    }

    public function test_student_can_access_student_routes()
    {
        $role = Role::create(['name' => 'student']);
        $user = User::factory()->create();
        $user->assignRole('student');

        $response = $this->actingAs($user)->get('/student/dashboard');
        $response->assertStatus(200);
    }

    public function test_head_can_access_head_routes()
    {
        $role = Role::create(['name' => 'head']);
        $user = User::factory()->create();
        $user->assignRole('head');

        $response = $this->actingAs($user)->get('/head/dashboard');
        $response->assertStatus(200);
    }

    public function test_user_without_role_cannot_access_protected_routes()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(403);

        $response = $this->actingAs($user)->get('/faculty/dashboard');
        $response->assertStatus(403);

        $response = $this->actingAs($user)->get('/student/dashboard');
        $response->assertStatus(403);

        $response = $this->actingAs($user)->get('/head/dashboard');
        $response->assertStatus(403);
    }

    public function test_guest_cannot_access_protected_routes()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');

        $response = $this->get('/faculty/dashboard');
        $response->assertRedirect('/login');

        $response = $this->get('/student/dashboard');
        $response->assertRedirect('/login');

        $response = $this->get('/head/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_student_cannot_access_admin_routes()
    {
        $role = Role::create(['name' => 'student']);
        $user = User::factory()->create();
        $user->assignRole('student');

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_faculty_cannot_access_student_routes()
    {
        $role = Role::create(['name' => 'faculty']);
        $user = User::factory()->create();
        $user->assignRole('faculty');

        $response = $this->actingAs($user)->get('/student/dashboard');
        $response->assertStatus(403);
    }

    public function test_user_with_multiple_roles_can_access_any_of_their_role_routes()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $facultyRole = Role::create(['name' => 'faculty']);
        
        $user = User::factory()->create();
        $user->assignRole(['admin', 'faculty']);

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/faculty/dashboard');
        $response->assertStatus(200);
    }
}
