<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of services
     */
    public function index(Request $request)
    {
        $category = $request->get('category');

        // Fetch service categories
        $categories = DB::table('service_categories')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // Fetch services based on category filter
        $query = DB::table('services as s')
            ->leftJoin('service_categories as sc', 's.service_category_id', '=', 'sc.id')
            ->select('s.*', 'sc.name as category_name', 'sc.color_theme')
            ->where('s.is_active', 1);

        if ($category) {
            $query->where('s.service_category_id', $category);
        }

        $services = $query->orderBy('s.sort_order', 'asc')
            ->orderBy('s.name', 'asc')
            ->paginate(12);

        // Get selected category info
        $selectedCategory = null;
        if ($category) {
            $selectedCategory = DB::table('service_categories')
                ->where('id', $category)
                ->where('is_active', 1)
                ->first();
        }

        return view('services.index', compact('categories', 'services', 'selectedCategory'));
    }

    /**
     * Display the specified service
     */
    public function show($id)
    {
        // Fetch the specific service with category information
        $service = DB::table('services as s')
            ->leftJoin('service_categories as sc', 's.service_category_id', '=', 'sc.id')
            ->select('s.*', 'sc.name as category_name', 'sc.color_theme')
            ->where('s.id', $id)
            ->where('s.is_active', 1)
            ->first();

        if (!$service) {
            abort(404);
        }

        // Fetch related services from the same category
        $relatedServices = DB::table('services as s')
            ->leftJoin('service_categories as sc', 's.service_category_id', '=', 'sc.id')
            ->select('s.*', 'sc.name as category_name')
            ->where('s.service_category_id', $service->service_category_id)
            ->where('s.id', '!=', $id)
            ->where('s.is_active', 1)
            ->orderBy('s.sort_order', 'asc')
            ->orderBy('s.name', 'asc')
            ->limit(6)
            ->get();

        // Fetch service requirements
        $requirements = DB::table('service_requirements')
            ->where('service_id', $id)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Fetch service contacts
        $contacts = DB::table('service_contacts')
            ->where('service_id', $id)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Fetch all categories for navigation
        $categories = DB::table('service_categories')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('services.detail', compact('service', 'relatedServices', 'requirements', 'contacts', 'categories'));
    }
}
