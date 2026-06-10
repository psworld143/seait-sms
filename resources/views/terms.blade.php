@extends('layouts.app')

@section('title', 'Terms of Service - SEAIT')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-seait-dark mb-6">Terms of Service</h1>
            
            <div class="prose max-w-none">
                <p class="text-gray-600 mb-6">Last updated: {{ date('F d, Y') }}</p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">1. Acceptance of Terms</h2>
                <p class="text-gray-700 mb-4">
                    By accessing and using the SEAIT website and services, you accept and agree to be bound by 
                    the terms and provision of this agreement.
                </p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">2. Use License</h2>
                <p class="text-gray-700 mb-4">
                    Permission is granted to temporarily access the materials on SEAIT's website for personal, 
                    non-commercial transitory viewing only.
                </p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">3. User Responsibilities</h2>
                <p class="text-gray-700 mb-4">
                    Users are responsible for maintaining the confidentiality of their account information 
                    and for all activities that occur under their account.
                </p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">4. Academic Integrity</h2>
                <p class="text-gray-700 mb-4">
                    All users must adhere to the institution's academic integrity policies and maintain 
                    ethical standards in their academic work.
                </p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">5. Termination</h2>
                <p class="text-gray-700 mb-4">
                    We may terminate or suspend access to our service immediately, without prior notice 
                    or liability, for any reason whatsoever.
                </p>
                
                <h2 class="text-2xl font-semibold text-seait-dark mb-4">6. Contact Information</h2>
                <p class="text-gray-700 mb-4">
                    If you have any questions about these Terms of Service, please contact us at 
                    <a href="mailto:legal@seait.edu.ph" class="text-seait-orange hover:text-orange-600">legal@seait.edu.ph</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
