@extends('layouts.app')

@section('title', 'News & Events - SEAIT')

@section('content')
<div class="min-h-screen bg-gray-50 pt-16">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-seait-dark mb-4">News & Events</h1>
            <p class="text-lg text-gray-600">Stay updated with the latest happenings at SEAIT</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                @if($news->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($news as $newsItem)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full @if($newsItem->type === 'news') bg-blue-100 text-blue-800 @elseif($newsItem->type === 'event') bg-purple-100 text-purple-800 @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($newsItem->type) }}
                                    </span>
                                    <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($newsItem->created_at)->format('M d, Y') }}</span>
                                </div>

                                <h3 class="text-lg font-semibold mb-2 text-seait-dark">
                                    <a href="{{ route('news.detail', $newsItem->id) }}" class="hover:text-seait-orange transition">
                                        {{ $newsItem->title }}
                                    </a>
                                </h3>
                                <div class="text-gray-600 text-sm mb-4">
                                    @php
                                    $content = strip_tags($newsItem->content);
                                    echo htmlspecialchars(substr($content, 0, 150)) . '...';
                                    @endphp
                                </div>
                                <a href="{{ route('news.detail', $newsItem->id) }}" class="text-seait-orange hover:underline text-sm">Read More</a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $news->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500">No news articles found.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Categories -->
                @if($categories->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold text-seait-dark mb-4">Categories</h3>
                    <div class="space-y-2">
                        @foreach($categories as $category)
                        <a href="{{ route('news.index', ['category' => $category->id]) }}" class="block text-gray-600 hover:text-seait-orange transition">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Recent Announcements -->
                @if($announcements->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-seait-dark mb-4">Recent Announcements</h3>
                    <div class="space-y-4">
                        @foreach($announcements as $announcement)
                        <div class="border-b border-gray-200 pb-3 last:border-b-0">
                            <h4 class="text-sm font-medium text-seait-dark mb-1">
                                <a href="{{ route('news.detail', $announcement->id) }}" class="hover:text-seait-orange transition">
                                    {{ $announcement->title }}
                                </a>
                            </h4>
                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($announcement->created_at)->format('M d, Y') }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
