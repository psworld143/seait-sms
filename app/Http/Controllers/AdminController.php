<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Course;
use App\Models\LmsAssignment;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $totalStudents = Student::count();
        $totalFaculty = Faculty::count();
        $totalCourses = Course::count();
        $totalAssignments = LmsAssignment::count();
        
        // Get recent activities (you might want to create an Activity model)
        $recentActivities = collect(); // Placeholder for now
        
        return view('admin.dashboard', compact(
            'totalStudents',
            'totalFaculty', 
            'totalCourses',
            'totalAssignments',
            'recentActivities'
        ));
    }

    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::with('roles')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->roles);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Display a listing of roles
     */
    public function rolesIndex()
    {
        $roles = Role::with('permissions')->paginate(15);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role
     */
    public function rolesCreate()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role
     */
    public function rolesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);
        
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display a listing of permissions
     */
    public function permissionsIndex()
    {
        $permissions = Permission::paginate(15);
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission
     */
    public function permissionsCreate()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created permission
     */
    public function permissionsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Display a listing of departments
     */
    public function departmentsIndex()
    {
        $departments = \App\Models\Department::with('head')->paginate(15);
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Display a listing of subjects
     */
    public function subjectsIndex()
    {
        $subjects = \App\Models\Subject::with('department')->paginate(15);
        return view('admin.subjects.index', compact('subjects'));
    }
}
