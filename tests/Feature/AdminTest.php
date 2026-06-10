<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Course;
use App\Models\LmsAssignment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create admin role and user
        $adminRole = Role::create(['name' => 'admin']);
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    public function test_admin_can_access_dashboard()
    {
        $response = $this->actingAs($this->admin)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    public function test_admin_dashboard_shows_correct_statistics()
    {
        // Create some test data
        Student::factory()->count(5)->create();
        Faculty::factory()->count(3)->create();
        Course::factory()->count(4)->create();
        LmsAssignment::factory()->count(6)->create();

        $response = $this->actingAs($this->admin)->get('/admin/dashboard');
        
        $response->assertStatus(200);
        $response->assertViewHas('totalStudents', 5);
        $response->assertViewHas('totalFaculty', 3);
        $response->assertViewHas('totalCourses', 4);
        $response->assertViewHas('totalAssignments', 6);
    }

    public function test_non_admin_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_admin_can_view_users_list()
    {
        User::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get('/admin/users');
        $response->assertStatus(200);
        $response->assertViewIs('admin.users.index');
    }

    public function test_admin_can_create_new_user()
    {
        $role = Role::create(['name' => 'student']);

        $response = $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'roles' => ['student'],
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
        ]);
    }

    public function test_admin_can_edit_user()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'faculty']);

        $response = $this->actingAs($this->admin)->put("/admin/users/{$user->id}", [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'roles' => ['faculty'],
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_admin_can_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)->delete("/admin/users/{$user->id}");

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_can_view_roles()
    {
        Role::create(['name' => 'student']);
        Role::create(['name' => 'faculty']);

        $response = $this->actingAs($this->admin)->get('/admin/roles');
        $response->assertStatus(200);
        $response->assertViewIs('admin.roles.index');
    }

    public function test_admin_can_create_role()
    {
        $response = $this->actingAs($this->admin)->post('/admin/roles', [
            'name' => 'new_role',
        ]);

        $response->assertRedirect('/admin/roles');
        $this->assertDatabaseHas('roles', ['name' => 'new_role']);
    }

    public function test_admin_can_view_permissions()
    {
        $response = $this->actingAs($this->admin)->get('/admin/permissions');
        $response->assertStatus(200);
        $response->assertViewIs('admin.permissions.index');
    }

    public function test_admin_can_create_permission()
    {
        $response = $this->actingAs($this->admin)->post('/admin/permissions', [
            'name' => 'new_permission',
        ]);

        $response->assertRedirect('/admin/permissions');
        $this->assertDatabaseHas('permissions', ['name' => 'new_permission']);
    }
}
