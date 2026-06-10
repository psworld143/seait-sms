<!-- Navigation -->
<nav class="bg-transparent dark:bg-transparent sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-2 sm:px-4">
        <div class="flex items-center justify-between py-3 md:py-4">
            <!-- Logo and Brand - Leftmost Position -->
            <div class="flex items-center space-x-2 md:space-x-4 flex-shrink-0">
                <img src="{{ asset('images/seait-logo.png') }}" alt="SEAIT Logo" class="h-6 sm:h-8 md:h-12 w-auto">
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-seait-dark truncate">SEAIT</h1>
                </div>
            </div>

            <!-- Center Navigation - Desktop -->
            <div class="hidden lg:flex items-center justify-center flex-1 px-4 ml-8">
                <div class="flex items-center space-x-2 xl:space-x-3 flex-nowrap">
                    <a href="{{ route('home') }}#home" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-sm xl:text-base px-1 py-1">Home</a>
                    <a href="{{ route('home') }}#about" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-sm xl:text-base px-1 py-1">About</a>
                    <a href="{{ route('home') }}#academics" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-sm xl:text-base px-1 py-1">Academics</a>
                    <a href="{{ route('home') }}#admissions" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-sm xl:text-base px-1 py-1">Admissions</a>
                    <a href="{{ route('home') }}#research" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-sm xl:text-base px-1 py-1">Research & Publication</a>
                    <a href="{{ route('home') }}#news" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-sm xl:text-base px-1 py-1">News</a>
                    <a href="{{ route('home') }}#contact" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-sm xl:text-base px-1 py-1">Contact</a>

                    <!-- Services Dropdown -->
                    <div class="relative group">
                        <button class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-sm xl:text-base px-1 py-1 flex items-center">
                            Services
                            <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute top-full left-0 mt-1 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="{{ route('services') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-th-large mr-2"></i>All Services
                                </a>
                                <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
                                <a href="{{ route('calendar') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-calendar-alt mr-2"></i>School Calendar
                                </a>
                                <a href="{{ route('services', ['category' => 1]) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-graduation-cap mr-2"></i>Academic Services
                                </a>
                                <a href="{{ route('services', ['category' => 2]) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-user-graduate mr-2"></i>Student Support
                                </a>
                                <a href="{{ route('services', ['category' => 3]) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-laptop mr-2"></i>Technology Services
                                </a>
                                <a href="{{ route('services', ['category' => 4]) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-heartbeat mr-2"></i>Health & Wellness
                                </a>
                                <a href="{{ route('services', ['category' => 5]) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-bus mr-2"></i>Transportation
                                </a>
                                <a href="{{ route('services', ['category' => 6]) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-desktop mr-2"></i>Virtual Learning
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Center Navigation - Tablet -->
            <div class="hidden md:flex lg:hidden items-center justify-center flex-1 px-2 ml-4">
                <div class="flex items-center space-x-1 flex-nowrap">
                    <a href="{{ route('home') }}#home" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-xs px-1 py-1">Home</a>
                    <a href="{{ route('home') }}#about" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-xs px-1 py-1">About</a>
                    <a href="{{ route('home') }}#academics" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-xs px-1 py-1">Academics</a>
                    <a href="{{ route('home') }}#admissions" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-xs px-1 py-1">Admissions</a>
                    <a href="{{ route('home') }}#research" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-xs px-1 py-1">Research</a>
                    <a href="{{ route('home') }}#news" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-xs px-1 py-1">News</a>
                    <a href="{{ route('home') }}#contact" class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-xs px-1 py-1">Contact</a>
                    <!-- Services Dropdown - Tablet -->
                    <div class="relative group">
                        <button class="text-seait-dark dark:text-white hover:text-seait-orange transition whitespace-nowrap text-xs px-1 py-1 flex items-center">
                            Services
                            <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute top-full left-0 mt-1 w-40 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="{{ route('services') }}" class="block px-3 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-th-large mr-2"></i>All Services
                                </a>
                                <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
                                <a href="{{ route('calendar') }}" class="block px-3 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-calendar-alt mr-2"></i>School Calendar
                                </a>
                                <a href="{{ route('services', ['category' => 1]) }}" class="block px-3 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-graduation-cap mr-2"></i>Academic
                                </a>
                                <a href="{{ route('services', ['category' => 2]) }}" class="block px-3 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-user-graduate mr-2"></i>Student Support
                                </a>
                                <a href="{{ route('services', ['category' => 3]) }}" class="block px-3 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-laptop mr-2"></i>Technology
                                </a>
                                <a href="{{ route('services', ['category' => 4]) }}" class="block px-3 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-heartbeat mr-2"></i>Health
                                </a>
                                <a href="{{ route('services', ['category' => 5]) }}" class="block px-3 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-bus mr-2"></i>Transport
                                </a>
                                <a href="{{ route('services', ['category' => 6]) }}" class="block px-3 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-desktop mr-2"></i>Virtual
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - User Menu and Mobile Toggle -->
            <div class="flex items-center space-x-2 md:space-x-4">
                <!-- Dark Mode Toggle -->
                <button id="dark-mode-toggle" class="text-seait-dark dark:text-white hover:text-seait-orange transition p-2">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>

                <!-- User Menu - Desktop -->
                @auth
                <div class="hidden md:block relative group">
                    <button class="flex items-center space-x-2 text-seait-dark dark:text-white hover:text-seait-orange transition">
                        <div class="w-8 h-8 bg-seait-orange rounded-full flex items-center justify-center text-white font-semibold">
                            {{ substr(auth()->user()->first_name, 0, 1) }}
                        </div>
                        <span class="hidden lg:block text-sm">{{ auth()->user()->first_name }}</span>
                        <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full right-0 mt-1 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                <i class="fas fa-user mr-2"></i>Profile
                            </a>
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                <i class="fas fa-cog mr-2"></i>Admin Panel
                            </a>
                            @endif
                            @if(auth()->user()->role === 'faculty')
                            <a href="{{ route('faculty.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                <i class="fas fa-chalkboard-teacher mr-2"></i>Faculty Panel
                            </a>
                            @endif
                            @if(auth()->user()->role === 'student')
                            <a href="{{ route('student.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                <i class="fas fa-graduation-cap mr-2"></i>Student Portal
                            </a>
                            @endif
                            <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-seait-orange hover:text-white transition">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('login') }}" class="text-seait-dark dark:text-white hover:text-seait-orange transition text-sm">Login</a>
                </div>
                @endauth

                <!-- Mobile Menu Toggle -->
                <button id="mobile-menu-toggle" class="md:hidden text-seait-dark dark:text-white hover:text-seait-orange transition p-2">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white dark:bg-gray-800 rounded-lg shadow-lg mt-2 p-4">
            <div class="space-y-2">
                <a href="{{ route('home') }}#home" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">Home</a>
                <a href="{{ route('home') }}#about" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">About</a>
                <a href="{{ route('home') }}#academics" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">Academics</a>
                <a href="{{ route('home') }}#admissions" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">Admissions</a>
                <a href="{{ route('home') }}#research" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">Research</a>
                <a href="{{ route('home') }}#news" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">News</a>
                <a href="{{ route('home') }}#contact" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">Contact</a>
                <a href="{{ route('services') }}" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">Services</a>
                
                @auth
                <div class="border-t border-gray-200 dark:border-gray-600 pt-2 mt-2">
                    <a href="{{ route('profile') }}" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">
                        <i class="fas fa-user mr-2"></i>Profile
                    </a>
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">
                        <i class="fas fa-cog mr-2"></i>Admin Panel
                    </a>
                    @endif
                    @if(auth()->user()->role === 'faculty')
                    <a href="{{ route('faculty.dashboard') }}" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>Faculty Panel
                    </a>
                    @endif
                    @if(auth()->user()->role === 'student')
                    <a href="{{ route('student.dashboard') }}" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">
                        <i class="fas fa-graduation-cap mr-2"></i>Student Portal
                    </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left text-seait-dark dark:text-white hover:text-seait-orange transition py-2">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
                @else
                <div class="border-t border-gray-200 dark:border-gray-600 pt-2 mt-2">
                    <a href="{{ route('login') }}" class="block text-seait-dark dark:text-white hover:text-seait-orange transition py-2">Login</a>
                    
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });

    // Dark mode toggle
    document.getElementById('dark-mode-toggle').addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDark ? 'dark' : 'light');
    });

    // Initialize dark mode from localStorage
    if (localStorage.getItem('darkMode') === 'dark') {
        document.body.classList.add('dark-mode');
    }
</script>
