<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of news articles
     */
    public function index()
    {
        // Fetch all approved news, events and announcements
        $news = DB::table('posts')
            ->where('status', 'approved')
            ->whereIn('type', ['news', 'event'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $announcements = DB::table('posts')
            ->where('status', 'approved')
            ->where('type', 'announcement')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Categories table doesn't exist, so we'll use empty collection
        $categories = collect([]);

        return view('news.index', compact('news', 'announcements', 'categories'));
    }

    /**
     * Display the specified news article
     */
    public function show($id)
    {
        // Fetch the specific news article
        $news = DB::table('posts')
            ->where('id', $id)
            ->where('status', 'approved')
            ->whereIn('type', ['news', 'event'])
            ->first();

        if (!$news) {
            abort(404);
        }

        // Fetch related news (same category or recent)
        $relatedNews = DB::table('posts')
            ->where('status', 'approved')
            ->whereIn('type', ['news', 'event'])
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Fetch recent announcements
        $announcements = DB::table('posts')
            ->where('status', 'approved')
            ->where('type', 'announcement')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('news.detail', compact('news', 'relatedNews', 'announcements'));
    }
}
