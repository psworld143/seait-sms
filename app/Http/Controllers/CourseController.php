<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of courses
     */
    public function index()
    {
        // Fetch all active colleges with their courses
        $colleges = DB::table('colleges')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // Fetch all active courses for display
        $courses = DB::table('courses as co')
            ->join('colleges as c', 'co.college_id', '=', 'c.id')
            ->select('co.*', 'c.name as college_name', 'c.short_name as college_short_name', 'c.color_theme', 'c.logo_url')
            ->where('co.is_active', 1)
            ->where('c.is_active', 1)
            ->orderBy('c.sort_order', 'asc')
            ->orderBy('co.sort_order', 'asc')
            ->orderBy('co.name', 'asc')
            ->get();

        // Fix college logo paths for Laravel
        foreach ($courses as $course) {
            if (!empty($course->logo_url) && !str_starts_with($course->logo_url, 'http')) {
                $course->logo_url = asset($course->logo_url);
            }
        }

        // Organize courses by college for display
        $collegesData = [];
        foreach ($courses as $course) {
            $collegeId = $course->college_id;
            if (!isset($collegesData[$collegeId])) {
                $collegesData[$collegeId] = [
                    'name' => $course->college_name,
                    'short_name' => $course->college_short_name,
                    'color_theme' => $course->color_theme,
                    'logo_url' => $course->logo_url,
                    'courses' => []
                ];
            }
            $collegesData[$collegeId]['courses'][] = $course;
        }

        return view('courses.index', compact('colleges', 'courses', 'collegesData'));
    }

    /**
     * Display the specified course
     */
    public function show($id)
    {
        // Fetch the specific course with college information
        $course = DB::table('courses as co')
            ->join('colleges as c', 'co.college_id', '=', 'c.id')
            ->select('co.*', 'c.name as college_name', 'c.short_name as college_short_name', 'c.color_theme', 'c.logo_url', 'c.description as college_description')
            ->where('co.id', $id)
            ->where('co.is_active', 1)
            ->where('c.is_active', 1)
            ->first();

        if (!$course) {
            abort(404);
        }

        // Fix college logo path for Laravel
        if (!empty($course->logo_url) && !str_starts_with($course->logo_url, 'http')) {
            $course->logo_url = asset($course->logo_url);
        }

        // Fetch related courses from the same college
        $relatedCourses = DB::table('courses as co')
            ->join('colleges as c', 'co.college_id', '=', 'c.id')
            ->select('co.*', 'c.name as college_name')
            ->where('co.college_id', $course->college_id)
            ->where('co.id', '!=', $id)
            ->where('co.is_active', 1)
            ->where('c.is_active', 1)
            ->orderBy('co.sort_order', 'asc')
            ->orderBy('co.name', 'asc')
            ->limit(6)
            ->get();

        // Fetch course subjects/curriculum
        $subjects = DB::table('course_subjects')
            ->where('course_id', $id)
            ->where('is_active', 1)
            ->orderBy('year_level', 'asc')
            ->orderBy('semester', 'asc')
            ->orderBy('sort_order', 'asc')
            ->get();

        // Fetch course requirements
        $requirements = DB::table('course_requirements')
            ->where('course_id', $id)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('courses.detail', compact('course', 'relatedCourses', 'subjects', 'requirements'));
    }
}
