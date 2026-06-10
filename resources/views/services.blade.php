@extends('layouts.app')

@section('title', 'Services - SEAIT')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-seait-dark mb-4">Our Services</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Discover the comprehensive range of services we offer to support our students' academic journey and personal development.
            </p>
        </div>

        <!-- Service Categories -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach($categories as $id => $category)
            <a href="{{ route('services', ['category' => $id]) }}" 
               class="block bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 {{ $selectedCategory == $id ? 'ring-2 ring-seait-orange' : '' }}">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-seait-orange rounded-lg flex items-center justify-center text-white mr-4">
                        @switch($id)
                            @case(1)
                                <i class="fas fa-graduation-cap text-xl"></i>
                                @break
                            @case(2)
                                <i class="fas fa-user-graduate text-xl"></i>
                                @break
                            @case(3)
                                <i class="fas fa-laptop text-xl"></i>
                                @break
                            @case(4)
                                <i class="fas fa-heartbeat text-xl"></i>
                                @break
                            @case(5)
                                <i class="fas fa-bus text-xl"></i>
                                @break
                            @case(6)
                                <i class="fas fa-desktop text-xl"></i>
                                @break
                            @default
                                <i class="fas fa-cog text-xl"></i>
                        @endswitch
                    </div>
                    <h3 class="text-lg font-semibold text-seait-dark">{{ $category }}</h3>
                </div>
                <p class="text-gray-600 text-sm">
                    @switch($id)
                        @case(1)
                            Academic advising, library services, research support, and tutoring.
                            @break
                        @case(2)
                            Career counseling, student organizations, financial aid, and disability services.
                            @break
                        @case(3)
                            IT support, computer labs, WiFi access, and software licenses.
                            @break
                        @case(4)
                            Health center, mental health support, fitness center, and nutrition services.
                            @break
                        @case(5)
                            Shuttle service, parking facilities, bike rental, and public transport info.
                            @break
                        @case(6)
                            Online learning platform, video conferencing, digital library, and virtual labs.
                            @break
                        @default
                            Comprehensive support services for students.
                    @endswitch
                </p>
            </a>
            @endforeach
        </div>

        <!-- Selected Category Services -->
        @if($selectedCategory && !empty($selectedServices))
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-seait-dark mb-6">{{ $categories[$selectedCategory] }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($selectedServices as $service)
                <div class="border border-gray-200 rounded-lg p-6 hover:border-seait-orange transition-colors">
                    <h3 class="text-lg font-semibold text-seait-dark mb-2">{{ $service['name'] }}</h3>
                    <p class="text-gray-600">{{ $service['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Contact Information -->
        <div class="mt-12 bg-seait-dark text-white rounded-lg p-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold mb-4">Need Help?</h2>
                <p class="text-gray-300 mb-6">
                    Our support team is here to help you with any questions about our services.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:support@seait.edu.ph" class="bg-seait-orange text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition-colors">
                        <i class="fas fa-envelope mr-2"></i>Email Support
                    </a>
                    <a href="tel:+631234567890" class="border border-white text-white px-6 py-3 rounded-lg hover:bg-white hover:text-seait-dark transition-colors">
                        <i class="fas fa-phone mr-2"></i>Call Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
