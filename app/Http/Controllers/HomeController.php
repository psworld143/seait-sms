<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Post;
use App\Models\CarouselSlide;

class HomeController extends Controller
{
    /**
     * Display the home page with all dynamic data
     */
    public function index()
    {
        // Fetch approved news, events and announcements (exact query from original)
        $news = DB::table('posts')
            ->where('status', 'approved')
            ->whereIn('type', ['news', 'event'])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $announcements = DB::table('posts')
            ->where('status', 'approved')
            ->where('type', 'announcement')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Fetch active carousel slides (exact query from original)
        $carouselSlides = DB::table('carousel_slides')
            ->where('status', 'approved')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Fix image paths for Laravel
        foreach ($carouselSlides as $slide) {
            if (!empty($slide->image_url) && !str_starts_with($slide->image_url, 'http')) {
                $slide->image_url = asset($slide->image_url);
            }
        }

        // Fetch admission levels and their data (exact query from original)
        $admissionLevels = DB::table('admission_levels')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // Fetch admission contacts (exact query from original)
        $admissionContacts = DB::table('admission_contacts')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('title', 'asc')
            ->get();

        // Fetch active colleges (simplified query to avoid GROUP BY issues)
        $colleges = DB::table('colleges')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // Fetch all active courses for display (exact query from original)
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

        // Fetch timeline events (exact query from original)
        $timelineEvents = DB::table('timeline_events')
            ->where('is_active', 1)
            ->orderBy('year', 'desc')
            ->orderBy('sort_order', 'asc')
            ->get();

        // Fetch mission and vision (exact query from original)
        $missionVision = DB::table('mission_vision')
            ->where('is_active', 1)
            ->orderBy('type', 'asc')
            ->get();

        // Fetch core values (exact query from original)
        $coreValues = DB::table('core_values')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();

        // Fetch board directors (exact query from original)
        $boardDirectors = DB::table('board_directors')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // Fix board director photo paths for Laravel
        foreach ($boardDirectors as $director) {
            if (!empty($director->photo_url) && !str_starts_with($director->photo_url, 'http')) {
                $director->photo_url = asset($director->photo_url);
            }
        }

        // Fetch departments (simplified query to avoid GROUP BY issues)
        $departments = DB::table('departments')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // Fetch featured publications (fixed column name)
        $featuredPublications = DB::table('publications as p')
            ->leftJoin('research_categories as rc', 'p.research_category_id', '=', 'rc.id')
            ->select('p.*', 'rc.name as category_name', 'rc.color_theme')
            ->where('p.is_active', 1)
            ->where('p.featured', 1)
            ->orderBy('p.sort_order', 'asc')
            ->orderBy('p.publication_date', 'desc')
            ->limit(3)
            ->get();

        // Fetch all publications (fixed column name)
        $publications = DB::table('publications as p')
            ->leftJoin('research_categories as rc', 'p.research_category_id', '=', 'rc.id')
            ->select('p.*', 'rc.name as category_name', 'rc.color_theme')
            ->where('p.is_active', 1)
            ->orderBy('p.sort_order', 'asc')
            ->orderBy('p.publication_date', 'desc')
            ->limit(9)
            ->get();

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

        // Get department contacts for each department
        $departmentContacts = [];
        foreach ($departments as $department) {
            $contacts = DB::table('department_contacts')
                ->where('department_id', $department->id)
                ->where('is_active', 1)
                ->orderBy('sort_order', 'asc')
                ->get();
            $departmentContacts[$department->id] = $contacts;
        }

        return view('home', compact(
            'news',
            'announcements', 
            'carouselSlides',
            'admissionLevels',
            'admissionContacts',
            'colleges',
            'courses',
            'collegesData',
            'timelineEvents',
            'missionVision',
            'coreValues',
            'boardDirectors',
            'departments',
            'departmentContacts',
            'featuredPublications',
            'publications'
        ));
    }
}
