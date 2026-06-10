@extends('layouts.app')

@section('title', 'Privacy Policy - SEAIT')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-seait-dark mb-6">Privacy Policy</h1>
            
            <div class="prose max-w-none">
                <p class="text-gray-600 mb-6">Last updated: {{ date('F d, Y') }}</p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">1. Information We Collect</h2>
                <p class="text-gray-700 mb-4">
                    We collect information you provide directly to us, such as when you create an account, 
                    enroll in courses, or contact us for support.
                </p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">2. How We Use Your Information</h2>
                <p class="text-gray-700 mb-4">
                    We use the information we collect to provide, maintain, and improve our services, 
                    communicate with you, and ensure the security of our platform.
                </p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">3. Information Sharing</h2>
                <p class="text-gray-700 mb-4">
                    We do not sell, trade, or otherwise transfer your personal information to third parties 
                    without your consent, except as described in this policy.
                </p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">4. Data Security</h2>
                <p class="text-gray-700 mb-4">
                    We implement appropriate security measures to protect your personal information 
                    against unauthorized access, alteration, disclosure, or destruction.
                </p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">5. Contact Us</h2>
                <p class="text-gray-700 mb-4">
                    If you have any questions about this Privacy Policy, please contact us at 
                    <a href="mailto:privacy@seait.edu.ph" class="text-seait-orange hover:text-orange-600">privacy@seait.edu.ph</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
