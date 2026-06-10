<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEAIT - South East Asian Institute of Technology, Inc.</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'seait-orange': '#FF6B35',
                        'seait-dark': '#2C3E50',
                        'seait-light': '#FFF8F0'
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/dark-mode.css') }}">
    <script src="{{ asset('assets/js/dark-mode.js') }}"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .prose a:hover {
            color: #EA580C;
        }

        /* Admission Tab Styles */
        .admission-tab.active {
            background-color: #FF6B35;
            color: white;
        }
        .admission-tab:not(.active) {
            background-color: #E5E7EB;
            color: #374151;
        }
        .admission-tab:not(.active):hover {
            background-color: #D1D5DB;
        }

        /* Timeline Scrollbar Styles */
        .timeline-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .timeline-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        .timeline-scroll::-webkit-scrollbar-thumb {
            background: #FF6B35;
            border-radius: 3px;
        }
        .timeline-scroll::-webkit-scrollbar-thumb:hover {
            background: #e55a2b;
        }

        /* Equal Height Sections */
        .history-grid {
            min-height: 400px;
        }
        .timeline-section {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .mission-vision-section {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Smooth Scrolling and Navbar Offset */
        html {
            scroll-behavior: smooth;
        }
        section {
            scroll-margin-top: 60px;
        }

        /* Perfect Circular Icons */
        .contact-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .contact-icon-large {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* College Icon Styles - Ensure Perfect Circles */
        .college-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }
        .college-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .college-icon-fallback {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Enhanced carousel transitions */
        .carousel-slide {
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Ensure carousel content is visible when slide is active */
        .carousel-slide.opacity-100 .carousel-title,
        .carousel-slide.opacity-100 .carousel-subtitle,
        .carousel-slide.opacity-100 .carousel-description,
        .carousel-slide.opacity-100 .carousel-button {
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Override any conflicting styles for carousel content */
        .carousel-title,
        .carousel-subtitle,
        .carousel-description,
        .carousel-button {
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: opacity, transform;
        }

        /* Enhanced navigation styles */
        .carousel-dot {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .carousel-nav {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Active navbar link styles */
        .navbar-link-active {
            color: #FF6B35 !important;
            font-weight: 600;
        }
        .navbar-link-active:hover {
            color: #FF6B35 !important;
        }

        .carousel-title, .carousel-subtitle, .carousel-description {
            text-shadow: 0 2px 8px rgba(0,0,0,0.35), 0 1px 2px rgba(0,0,0,0.25);
        }

        /* Page Loader Styles */
        #page-loader {
            background: #fff;
            transition: opacity 0.5s;
        }
        .dark-mode #page-loader {
            background: #1e293b;
        }
        .loader-spinner {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* Hide carousel until images are loaded */
        .carousel-hidden {
            opacity: 0;
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-gray-50 dark-mode" data-theme="light">
    <!-- Cookie Consent -->
    <div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-seait-dark text-white p-4 z-50">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between">
            <div class="text-sm mb-4 md:mb-0">
                <p>This website uses cookies to enhance your experience.</p>
                <p class="text-xs mt-1">See our <a href="{{ route('privacy') }}" class="text-seait-orange underline">Privacy Policy</a></p>
            </div>
            <div class="flex space-x-2">
                <button onclick="acceptCookies()" class="bg-seait-orange text-white px-4 py-2 rounded text-sm">Accept</button>
                <button onclick="declineCookies()" class="bg-gray-600 text-white px-4 py-2 rounded text-sm">Decline</button>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    @include('includes.navbar')

    <!-- Hero Section with Carousel -->
    <section id="home" class="relative bg-gradient-to-r from-seait-orange to-orange-600 text-white min-h-screen flex items-center">
        <div class="relative overflow-hidden w-full">
            <!-- Carousel Container -->
            <div id="carousel" class="relative h-screen min-h-[400px] sm:min-h-[500px] md:min-h-[600px] lg:min-h-[700px] xl:min-h-[800px] carousel-hidden">
                @php $slide_count = 0; @endphp
                @foreach($carouselSlides as $slide)
                @php $slide_count++; @endphp
                <div class="carousel-slide absolute inset-0 transition-all duration-1000 ease-in-out {{ $slide_count === 1 ? 'opacity-100 scale-100 pointer-events-auto' : 'opacity-0 scale-105 pointer-events-none' }}" data-slide="{{ $slide_count }}">
                    <!-- Background Image with Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $slide->image_url }}'); filter: blur(1px);"></div>

                    <!-- Content Container -->
                    <div class="relative z-10 flex h-full">
                        <!-- Mobile: Center content, Desktop/Tablet: Lower left with reduced top margin -->
                        <div class="w-full flex items-center justify-center md:items-end md:justify-start md:pb-20 md:pt-8 md:pl-8 lg:pb-24 lg:pt-12 lg:pl-12">
                            <div class="max-w-7xl mx-auto md:mx-0 px-4 text-center md:text-left">
                                <div class="max-w-4xl md:max-w-2xl lg:max-w-3xl rounded-xl shadow-lg p-6 md:p-8">
                                    <!-- Title -->
                                    <h1 class="carousel-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-2 md:mb-3 px-2 md:px-0 {{ $slide_count === 1 ? 'animate-fade-in' : 'opacity-0 transform translate-y-8' }}">
                                        {!! nl2br(e($slide->title)) !!}
                                    </h1>

                                    <!-- Subtitle -->
                                    @if(!empty($slide->subtitle))
                                    <p class="carousel-subtitle text-2xl sm:text-3xl md:text-4xl mb-3 md:mb-4 px-2 md:px-0 {{ $slide_count === 1 ? 'animate-fade-in-delay' : 'opacity-0 transform translate-y-8' }}">
                                        {!! nl2br(e($slide->subtitle)) !!}
                                    </p>
                                    @endif

                                    <!-- Description -->
                                    @if(!empty($slide->description))
                                    <p class="carousel-description text-lg sm:text-xl md:text-2xl mb-4 md:mb-6 max-w-3xl md:max-w-none mx-auto md:mx-0 px-2 md:px-0 {{ $slide_count === 1 ? 'animate-fade-in-delay-2' : 'opacity-0 transform translate-y-8' }}">
                                        {!! nl2br(e($slide->description)) !!}
                                    </p>
                                    @endif

                                    <!-- Button -->
                                    @if(!empty($slide->button_text) && !empty($slide->button_link))
                                    <div class="carousel-button {{ $slide_count === 1 ? 'animate-fade-in-delay-3' : 'opacity-0 transform translate-y-8' }}">
                                        <a href="{{ $slide->button_link }}" class="bg-white text-seait-orange px-8 md:px-10 py-4 md:py-5 rounded-lg font-semibold text-lg md:text-2xl hover:bg-gray-100 transition-all duration-300 inline-block shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                            {!! nl2br(e($slide->button_text)) !!}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @if($slide_count > 1)
                <!-- Carousel Navigation Dots -->
                <div class="absolute top-6 md:top-8 lg:top-12 left-1/2 transform -translate-x-1/2 z-30">
                    <div class="flex space-x-3 md:space-x-4">
                        @for($i = 1; $i <= $slide_count; $i++)
                        <button class="carousel-dot w-4 h-4 md:w-5 md:h-5 rounded-full bg-white bg-opacity-90 hover:bg-opacity-100 transition-all duration-300 shadow-lg {{ $i === 1 ? 'bg-opacity-100 scale-110' : 'bg-opacity-60 hover:bg-opacity-80' }}" data-slide="{{ $i }}" title="Go to slide {{ $i }}"></button>
                        @endfor
                    </div>
                </div>

                <!-- Previous/Next Navigation Buttons -->
                <button class="carousel-nav absolute left-4 md:left-6 lg:left-8 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-50 text-white p-3 md:p-4 rounded-full transition-all duration-300 z-30 hover:scale-110 hover:shadow-lg" onclick="previousSlide()" title="Previous slide">
                    <i class="fas fa-chevron-left text-lg md:text-xl"></i>
                </button>
                <button class="carousel-nav absolute right-4 md:right-6 lg:right-8 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-50 text-white p-3 md:p-4 rounded-full transition-all duration-300 z-30 hover:scale-110 hover:shadow-lg" onclick="nextSlide()" title="Next slide">
                    <i class="fas fa-chevron-right text-lg md:text-xl"></i>
                </button>
                @endif
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="min-h-screen bg-white flex items-center pt-8">
        <div class="max-w-7xl mx-auto px-4 py-8 md:py-16 w-full">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-seait-dark mb-4">About SEAIT</h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto px-4">Committed to academic excellence and innovation in technology education</p>
            </div>

            <!-- History Section -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <h3 class="text-2xl md:text-3xl font-bold text-seait-dark mb-4">Our History</h3>
                    <p class="text-gray-600 max-w-4xl mx-auto">A journey of excellence and innovation in education</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch history-grid">
                    <!-- Timeline Events - Scrollable -->
                    <div class="bg-white rounded-lg shadow-sm p-6 timeline-scroll timeline-section">
                        <h4 class="text-xl font-semibold text-seait-dark mb-4">Timeline of Events</h4>
                        <div class="max-h-96 overflow-y-auto pr-2 space-y-4 flex-1">
                            @foreach($timelineEvents as $event)
                            <div class="flex items-start space-x-4 border-l-4 border-seait-orange pl-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-seait-orange rounded-full flex items-center justify-center text-white font-bold text-sm">{{ $event->year }}</div>
                                <div class="flex-1">
                                    <h5 class="text-lg font-semibold text-seait-dark mb-2">{{ $event->title }}</h5>
                                    <p class="text-gray-600 text-sm">{{ $event->description }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Mission & Vision -->
                    <div class="bg-gray-100 p-8 rounded-lg mission-vision-section">
                        @foreach($missionVision as $item)
                        <div class="mb-6">
                            <h4 class="text-xl font-semibold text-seait-dark mb-4">{{ $item->title }}</h4>
                            <p class="text-gray-600">{{ $item->content }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Core Values Section -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <h3 class="text-2xl md:text-3xl font-bold text-seait-dark mb-4">Our Core Values</h3>
                    <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto px-4">The foundation of our commitment to excellence</p>
                </div>

                @php
                $totalCoreValues = count($coreValues);
                $firstRowLimit = 3; // Max cards for the first row on large screens
                @endphp

                @if($totalCoreValues > 0)
                <!-- First row of core values (up to 3 cards) -->
                <div class="flex justify-center mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 max-w-6xl">
                        @for($i = 0; $i < min($totalCoreValues, $firstRowLimit); $i++)
                        @php $coreValue = $coreValues[$i]; @endphp
                        <div class="text-center p-6 bg-seait-light rounded-lg hover:shadow-lg transition duration-300 w-full max-w-sm">
                            <div class="w-16 h-16 bg-seait-orange rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="{{ $coreValue->icon }} text-white text-2xl"></i>
                            </div>
                            <h3 class="text-lg md:text-xl font-semibold mb-3 text-seait-dark">{{ $coreValue->title }}</h3>
                            <p class="text-gray-600 text-sm md:text-base">{{ $coreValue->description }}</p>
                        </div>
                        @endfor
                    </div>
                </div>
                @endif

                @if($totalCoreValues > $firstRowLimit)
                <!-- Remaining core values in a centered row -->
                <div class="flex justify-center">
                    <div class="flex gap-6 md:gap-8 justify-center">
                        @for($i = $firstRowLimit; $i < $totalCoreValues; $i++)
                        @php $coreValue = $coreValues[$i]; @endphp
                        <div class="text-center p-6 bg-seait-light rounded-lg hover:shadow-lg transition duration-300 w-full max-w-sm">
                            <div class="w-16 h-16 bg-seait-orange rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="{{ $coreValue->icon }} text-white text-2xl"></i>
                            </div>
                            <h3 class="text-lg md:text-xl font-semibold mb-3 text-seait-dark">{{ $coreValue->title }}</h3>
                            <p class="text-gray-600 text-sm md:text-base">{{ $coreValue->description }}</p>
                        </div>
                        @endfor
                    </div>
                </div>
                @endif
            </div>

            <!-- Board of Directors -->
            <div>
                <div class="text-center mb-12">
                    <h3 class="text-2xl md:text-3xl font-bold text-seait-dark mb-4">Board of Directors</h3>
                    <p class="text-gray-600 max-w-4xl mx-auto">Meet the visionary leaders guiding SEAIT towards excellence</p>
                </div>

                <div class="flex flex-wrap justify-center gap-6 md:gap-8">
                    @foreach($boardDirectors as $director)
                    <div class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-lg transition w-full max-w-sm md:max-w-xs lg:max-w-sm">
                        @if(!empty($director->photo_url))
                        <img src="{{ $director->photo_url }}" alt="{{ $director->name }} Photo" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                        @else
                        <div class="w-24 h-24 bg-seait-orange rounded-full mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-user-tie text-white text-2xl"></i>
                        </div>
                        @endif
                        <h4 class="text-lg font-semibold text-seait-dark mb-1">{{ $director->name }}</h4>
                        <p class="text-seait-orange font-medium mb-2">{{ $director->position }}</p>
                        <p class="text-gray-600 text-sm">{{ $director->bio }}</p>
                        @if(!empty($director->email) || !empty($director->phone) || !empty($director->linkedin_url))
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex justify-center space-x-3">
                                @if(!empty($director->email))
                                <a href="mailto:{{ $director->email }}" class="text-gray-400 hover:text-seait-orange transition" title="Email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                @endif
                                @if(!empty($director->phone))
                                <a href="tel:{{ $director->phone }}" class="text-gray-400 hover:text-seait-orange transition" title="Phone">
                                    <i class="fas fa-phone"></i>
                                </a>
                                @endif
                                @if(!empty($director->linkedin_url))
                                <a href="{{ $director->linkedin_url }}" target="_blank" class="text-gray-400 hover:text-seait-orange transition" title="LinkedIn">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Academics Section -->
    <section id="academics" class="min-h-screen bg-gray-50 flex items-center pt-8">
        <div class="max-w-7xl mx-auto px-4 py-8 md:py-16 w-full">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-seait-dark mb-4">Academic Programs</h2>
                <p class="text-lg md:text-xl text-gray-600 px-4">Explore our comprehensive range of academic offerings</p>
            </div>

            <!-- Colleges Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-12">
                @foreach($collegesData as $collegeId => $collegeData)
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 relative">
                    <!-- Logo positioned at top center with 50% overlap -->
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2">
                        @if(!empty($collegeData['logo_url']))
                        <div class="w-20 h-20 rounded-full overflow-hidden shadow-xl border-4 border-white">
                            <img src="{{ $collegeData['logo_url'] }}" alt="{{ $collegeData['name'] }} Logo" class="w-full h-full object-cover">
                        </div>
                        @else
                        <div class="w-20 h-20 rounded-full flex items-center justify-center shadow-xl border-4 border-white"
                             style="background: linear-gradient(135deg, {{ $collegeData['color_theme'] }}, {{ $collegeData['color_theme'] }}dd);">
                            <span class="text-white font-bold text-2xl">{{ substr($collegeData['short_name'], 0, 2) }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="mt-12">
                        <div class="mb-6">
                            <h3 class="text-lg md:text-xl font-bold text-seait-dark mb-1">{{ $collegeData['name'] }}</h3>
                            <p class="text-sm text-gray-500 font-medium">{{ count($collegeData['courses']) }} Programs</p>
                        </div>

                        <div class="space-y-3">
                            @foreach($collegeData['courses'] as $course)
                            <div class="group">
                                <a href="{{ route('course.detail', $course->id) }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:shadow-sm">
                                    <div class="w-2 h-2 bg-gradient-to-r from-seait-orange to-orange-400 rounded-full mr-3 flex-shrink-0 shadow-sm"></div>
                                    <span class="text-gray-700 group-hover:text-seait-orange font-medium transition-colors duration-200 flex-1">
                                        {{ $course->name }}
                                    </span>
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <i class="fas fa-arrow-right text-seait-orange text-sm"></i>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="news" class="min-h-screen bg-white flex items-center pt-8">
        <div class="max-w-7xl mx-auto px-4 py-8 md:py-16 w-full">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-seait-dark mb-4">Latest News & Events</h2>
                <p class="text-lg md:text-xl text-gray-600 px-4">Stay updated with the latest happenings and upcoming events at SEAIT</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @php $newsCount = 0; @endphp
                @foreach($news as $newsItem)
                @php $newsCount++; @endphp
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <div class="p-4 md:p-6">
                        <!-- Type Badge -->
                        <div class="flex justify-between items-start mb-3">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full @if($newsItem->type === 'news') bg-blue-100 text-blue-800 @elseif($newsItem->type === 'event') bg-purple-100 text-purple-800 @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($newsItem->type) }}
                            </span>
                            <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($newsItem->created_at)->format('M d, Y') }}</span>
                        </div>

                        <h3 class="text-lg md:text-xl font-semibold mb-2 text-seait-dark">
                            <a href="{{ route('news.detail', $newsItem->id) }}" class="hover:text-seait-orange transition">
                                {{ $newsItem->title }}
                            </a>
                        </h3>
                        <div class="text-gray-600 mb-4 prose prose-sm max-w-none text-sm md:text-base">
                            @php
                            $content = strip_tags($newsItem->content);
                            echo htmlspecialchars(substr($content, 0, 150)) . '...';
                            @endphp
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-500">
                                @if($newsItem->type === 'event')
                                    <i class="fas fa-calendar-alt mr-1"></i>Event
                                @else
                                    <i class="fas fa-newspaper mr-1"></i>News
                                @endif
                            </span>
                            <a href="{{ route('news.detail', $newsItem->id) }}" class="text-seait-orange hover:underline text-xs md:text-sm">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach

                @while($newsCount < 6)
                @php $newsCount++; @endphp
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-lg opacity-50">
                    <div class="p-4 md:p-6">
                        <div class="animate-pulse">
                            <div class="h-6 bg-gray-200 rounded mb-2"></div>
                            <div class="h-4 bg-gray-200 rounded mb-2"></div>
                            <div class="h-4 bg-gray-200 rounded mb-2"></div>
                            <div class="h-4 bg-gray-200 rounded mb-4"></div>
                            <div class="flex justify-between items-center">
                                <div class="h-4 bg-gray-200 rounded w-20"></div>
                                <div class="h-4 bg-gray-200 rounded w-16"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endwhile
            </div>

            <div class="text-center mt-8 md:mt-12">
                <a href="{{ route('news.index') }}" class="bg-seait-orange text-white px-6 md:px-8 py-3 rounded-lg font-semibold hover:bg-orange-600 transition text-sm md:text-base">View All News</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="min-h-screen bg-gray-50 flex items-center pt-8">
        <div class="max-w-7xl mx-auto px-4 py-8 md:py-16 w-full">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-seait-dark mb-4">Contact Us</h2>
                <p class="text-lg md:text-xl text-gray-600 px-4">Get in touch with our departments for assistance</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($departments as $department)
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="contact-icon mr-4" style="background-color: {{ $department->color_theme }}">
                            <i class="{{ $department->icon }} text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-seait-dark">{{ $department->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $department->description }}</p>
                        </div>
                    </div>

                    @if(isset($departmentContacts[$department->id]) && count($departmentContacts[$department->id]) > 0)
                    <div class="space-y-3">
                        @foreach($departmentContacts[$department->id] as $contact)
                        <div class="flex items-start space-x-3">
                            <i class="{{ $contact->icon }} text-seait-orange mt-1"></i>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-seait-dark">{{ $contact->title }}</h4>
                                @if($contact->contact_type === 'phone')
                                    <a href="tel:{{ $contact->contact_value }}" class="text-sm text-gray-600 hover:text-seait-orange transition">
                                        {{ $contact->contact_value }}
                                    </a>
                                @elseif($contact->contact_type === 'email')
                                    <a href="mailto:{{ $contact->contact_value }}" class="text-sm text-gray-600 hover:text-seait-orange transition">
                                        {{ $contact->contact_value }}
                                    </a>
                                @elseif($contact->contact_type === 'website')
                                    <a href="{{ $contact->contact_value }}" target="_blank" class="text-sm text-gray-600 hover:text-seait-orange transition">
                                        {{ $contact->contact_value }}
                                    </a>
                                @else
                                    <p class="text-sm text-gray-600">{{ $contact->contact_value }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-500 italic">No contact information available</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('includes.footer')

    <script>
        // Cookie functionality
        function acceptCookies() {
            document.getElementById("cookie-banner").style.display = "none";
            localStorage.setItem("cookiesAccepted", "true");
        }

        function declineCookies() {
            document.getElementById("cookie-banner").style.display = "none";
            localStorage.setItem("cookiesAccepted", "false");
        }

        if (localStorage.getItem("cookiesAccepted")) {
            document.getElementById("cookie-banner").style.display = "none";
        }

        // Carousel functionality
        let currentSlide = 1;
        let slideInterval;
        let slides = [];
        let dots = [];
        let totalSlides = 0;

        function showSlide(slideNumber) {
            slides.forEach((slide, idx) => {
                if (idx === slideNumber - 1) {
                    slide.classList.add("opacity-100", "scale-100", "pointer-events-auto");
                    slide.classList.remove("opacity-0", "scale-105", "pointer-events-none");
                } else {
                    slide.classList.remove("opacity-100", "scale-100", "pointer-events-auto");
                    slide.classList.add("opacity-0", "scale-105", "pointer-events-none");
                }
            });

            dots.forEach(dot => {
                dot.classList.remove("bg-opacity-100", "scale-125");
                dot.classList.add("bg-opacity-50", "scale-100");
            });

            if (dots[slideNumber - 1]) {
                dots[slideNumber - 1].classList.remove("bg-opacity-50", "scale-100");
                dots[slideNumber - 1].classList.add("bg-opacity-100", "scale-125");
            }

            currentSlide = slideNumber;
        }

        function nextSlide() {
            const next = currentSlide === totalSlides ? 1 : currentSlide + 1;
            showSlide(next);
        }

        function previousSlide() {
            const prev = currentSlide === 1 ? totalSlides : currentSlide - 1;
            showSlide(prev);
        }

        document.addEventListener("DOMContentLoaded", function() {
            slides = document.querySelectorAll(".carousel-slide");
            dots = document.querySelectorAll(".carousel-dot");
            totalSlides = slides.length;

            if (totalSlides > 0) {
                dots.forEach((dot, index) => {
                    dot.addEventListener("click", () => {
                        showSlide(index + 1);
                    });
                });

                const carousel = document.getElementById("carousel");
                if (carousel) {
                    carousel.classList.remove("carousel-hidden");
                }
            }
        });
    </script>
</body>
</html>
