<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    /**
     * Display the academic calendar
     */
    public function index()
    {
        // Fetch academic calendar events
        $calendarEvents = DB::table('calendar_events')
            ->where('is_active', 1)
            ->orderBy('event_date', 'asc')
            ->orderBy('sort_order', 'asc')
            ->get();

        // Group events by month and year
        $groupedEvents = [];
        foreach ($calendarEvents as $event) {
            $date = \Carbon\Carbon::parse($event->event_date);
            $year = $date->year;
            $month = $date->format('F');
            
            if (!isset($groupedEvents[$year])) {
                $groupedEvents[$year] = [];
            }
            if (!isset($groupedEvents[$year][$month])) {
                $groupedEvents[$year][$month] = [];
            }
            
            $groupedEvents[$year][$month][] = $event;
        }

        // Fetch academic year information
        $academicYears = DB::table('academic_years')
            ->where('is_active', 1)
            ->orderBy('year_start', 'desc')
            ->get();

        // Fetch current academic year
        $currentYear = DB::table('academic_years')
            ->where('is_active', 1)
            ->where('is_current', 1)
            ->first();

        // Fetch calendar categories
        $categories = DB::table('calendar_categories')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('calendar.index', compact('groupedEvents', 'academicYears', 'currentYear', 'categories'));
    }

    /**
     * Display calendar events by category
     */
    public function category($categoryId)
    {
        $category = DB::table('calendar_categories')
            ->where('id', $categoryId)
            ->where('is_active', 1)
            ->first();

        if (!$category) {
            abort(404);
        }

        // Fetch events in this category
        $calendarEvents = DB::table('calendar_events')
            ->where('is_active', 1)
            ->where('calendar_category_id', $categoryId)
            ->orderBy('event_date', 'asc')
            ->orderBy('sort_order', 'asc')
            ->get();

        // Group events by month and year
        $groupedEvents = [];
        foreach ($calendarEvents as $event) {
            $date = \Carbon\Carbon::parse($event->event_date);
            $year = $date->year;
            $month = $date->format('F');
            
            if (!isset($groupedEvents[$year])) {
                $groupedEvents[$year] = [];
            }
            if (!isset($groupedEvents[$year][$month])) {
                $groupedEvents[$year][$month] = [];
            }
            
            $groupedEvents[$year][$month][] = $event;
        }

        // Fetch all categories for navigation
        $categories = DB::table('calendar_categories')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('calendar.category', compact('category', 'groupedEvents', 'categories'));
    }
}
