<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResearchController extends Controller
{
    /**
     * Display the research page
     */
    public function index()
    {
        // Fetch research categories
        $categories = DB::table('research_categories')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // Fetch featured publications
        $featuredPublications = DB::table('publications as p')
            ->leftJoin('research_categories as rc', 'p.research_category_id', '=', 'rc.id')
            ->select('p.*', 'rc.name as category_name', 'rc.color_theme')
            ->where('p.is_active', 1)
            ->where('p.featured', 1)
            ->orderBy('p.sort_order', 'asc')
            ->orderBy('p.publication_date', 'desc')
            ->limit(6)
            ->get();

        // Fetch all publications with pagination
        $publications = DB::table('publications as p')
            ->leftJoin('research_categories as rc', 'p.research_category_id', '=', 'rc.id')
            ->select('p.*', 'rc.name as category_name', 'rc.color_theme')
            ->where('p.is_active', 1)
            ->orderBy('p.sort_order', 'asc')
            ->orderBy('p.publication_date', 'desc')
            ->paginate(12);

        // Fetch publication authors
        $publicationIds = $publications->pluck('id')->toArray();
        $authors = [];
        if (!empty($publicationIds)) {
            $authors = DB::table('publication_authors as pa')
                ->join('users as u', 'pa.user_id', '=', 'u.id')
                ->select('pa.publication_id', 'pa.is_primary_author', 'u.name as author_name', 'u.title as author_title', 'u.department as author_department')
                ->whereIn('pa.publication_id', $publicationIds)
                ->orderBy('pa.is_primary_author', 'desc')
                ->orderBy('u.name', 'asc')
                ->get()
                ->groupBy('publication_id');
        }

        // Fetch research statistics
        $stats = [
            'total_publications' => DB::table('publications')->where('is_active', 1)->count(),
            'total_categories' => DB::table('research_categories')->where('is_active', 1)->count(),
            'featured_publications' => DB::table('publications')->where('is_active', 1)->where('featured', 1)->count(),
            'recent_publications' => DB::table('publications')->where('is_active', 1)->where('publication_date', '>=', now()->subYear())->count(),
        ];

        return view('research.index', compact('categories', 'featuredPublications', 'publications', 'authors', 'stats'));
    }

    /**
     * Display publications by category
     */
    public function category($categoryId)
    {
        $category = DB::table('research_categories')
            ->where('id', $categoryId)
            ->where('is_active', 1)
            ->first();

        if (!$category) {
            abort(404);
        }

        // Fetch publications in this category
        $publications = DB::table('publications as p')
            ->leftJoin('research_categories as rc', 'p.research_category_id', '=', 'rc.id')
            ->select('p.*', 'rc.name as category_name', 'rc.color_theme')
            ->where('p.is_active', 1)
            ->where('p.research_category_id', $categoryId)
            ->orderBy('p.sort_order', 'asc')
            ->orderBy('p.publication_date', 'desc')
            ->paginate(12);

        // Fetch publication authors
        $publicationIds = $publications->pluck('id')->toArray();
        $authors = [];
        if (!empty($publicationIds)) {
            $authors = DB::table('publication_authors as pa')
                ->join('users as u', 'pa.user_id', '=', 'u.id')
                ->select('pa.publication_id', 'pa.is_primary_author', 'u.name as author_name', 'u.title as author_title', 'u.department as author_department')
                ->whereIn('pa.publication_id', $publicationIds)
                ->orderBy('pa.is_primary_author', 'desc')
                ->orderBy('u.name', 'asc')
                ->get()
                ->groupBy('publication_id');
        }

        // Fetch all categories for navigation
        $categories = DB::table('research_categories')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('research.category', compact('category', 'publications', 'authors', 'categories'));
    }
}
