@extends('layouts.app')

@section('title', $news->title . ' - SEAIT')

@section('content')
<div class="min-h-screen bg-gray-50 pt-16">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('home') }}" class="hover:text-seait-orange">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('news.index') }}" class="hover:text-seait-orange">News</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-seait-dark">{{ $news->title }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-8">
                        <!-- Article Header -->
                        <header class="mb-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full @if($news->type === 'news') bg-blue-100 text-blue-800 @elseif($news->type === 'event') bg-purple-100 text-purple-800 @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($news->type) }}
                                </span>
                                <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($news->created_at)->format('F d, Y') }}</span>
                            </div>
                            <h1 class="text-2xl md:text-3xl font-bold text-seait-dark mb-4">{{ $news->title }}</h1>
                        </header>

                        <!-- Article Content -->
                        <div class="prose prose-lg max-w-none text-gray-700">
                            {!! $news->content !!}
                        </div>

                        <!-- Article Footer -->
                        <footer class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>Published on {{ \Carbon\Carbon::parse($news->created_at)->format('F d, Y \a\t g:i A') }}</span>
                                <div class="flex space-x-4">
                                    <a href="#" class="hover:text-seait-orange transition">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                    <a href="#" class="hover:text-seait-orange transition">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="hover:text-seait-orange transition">
                                        <i class="fas fa-share"></i>
                                    </a>
                                </div>
                            </div>
                        </footer>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Related News -->
                @if($relatedNews->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold text-seait-dark mb-4">Related News</h3>
                    <div class="space-y-4">
                        @foreach($relatedNews as $related)
                        <div class="border-b border-gray-200 pb-3 last:border-b-0">
                            <h4 class="text-sm font-medium text-seait-dark mb-1">
                                <a href="{{ route('news.detail', $related->id) }}" class="hover:text-seait-orange transition">
                                    {{ $related->title }}
                                </a>
                            </h4>
                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($related->created_at)->format('M d, Y') }}</p>
                        </div>
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
