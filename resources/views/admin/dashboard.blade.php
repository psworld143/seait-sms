@extends('layouts.app')

@section('title', 'Admin Dashboard - SEAIT')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-semibold text-seait-dark mb-6">Admin Dashboard</h1>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Students</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalStudents ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-6 rounded-lg border border-green-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Faculty</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalFaculty ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-purple-50 p-6 rounded-lg border border-purple-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Courses</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalCourses ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-orange-50 p-6 rounded-lg border border-orange-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-orange-100 rounded-lg">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Assignments</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalAssignments ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">User Management</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.users.index') }}" class="block text-seait-orange hover:text-orange-600">Manage Users</a>
                            <a href="{{ route('admin.roles.index') }}" class="block text-seait-orange hover:text-orange-600">Manage Roles</a>
                            <a href="{{ route('admin.permissions.index') }}" class="block text-seait-orange hover:text-orange-600">Manage Permissions</a>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Academic Management</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.courses.index') }}" class="block text-seait-orange hover:text-orange-600">Manage Courses</a>
                            <a href="{{ route('admin.departments.index') }}" class="block text-seait-orange hover:text-orange-600">Manage Departments</a>
                            <a href="{{ route('admin.subjects.index') }}" class="block text-seait-orange hover:text-orange-600">Manage Subjects</a>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">LMS Management</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.assignments.index') }}" class="block text-seait-orange hover:text-orange-600">Manage Assignments</a>
                            <a href="{{ route('admin.materials.index') }}" class="block text-seait-orange hover:text-orange-600">Manage Materials</a>
                            <a href="{{ route('admin.quizzes.index') }}" class="block text-seait-orange hover:text-orange-600">Manage Quizzes</a>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        @forelse($recentActivities ?? [] as $activity)
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-2 h-2 bg-seait-orange rounded-full"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-900">{{ $activity->description }}</p>
                                    <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No recent activity</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
