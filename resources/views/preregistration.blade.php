@extends('layouts.app')

@section('title', 'Pre-registration - SEAIT')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-seait-dark mb-6">Pre-registration</h1>
            
            <div class="prose max-w-none">
                <p class="text-gray-700 mb-6">
                    Welcome to SEAIT's pre-registration system. This form allows prospective students to 
                    express their interest in our programs and begin the application process.
                </p>
                
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">Important Information</h3>
                    <p class="text-blue-700 text-sm">
                        Pre-registration is the first step in the admission process. After submitting this form, 
                        you will receive further instructions via email regarding the complete application process.
                    </p>
                </div>
                
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                            <input type="text" id="first_name" name="first_name" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-seait-orange">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-seait-orange">
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-seait-orange">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-seait-orange">
                    </div>
                    
                    <div>
                        <label for="program" class="block text-sm font-medium text-gray-700 mb-2">Program of Interest *</label>
                        <select id="program" name="program" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-seait-orange">
                            <option value="">Select a program</option>
                            <option value="computer_science">Computer Science</option>
                            <option value="information_technology">Information Technology</option>
                            <option value="business_administration">Business Administration</option>
                            <option value="accounting">Accounting</option>
                            <option value="engineering">Engineering</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Additional Information</label>
                        <textarea id="message" name="message" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-seait-orange"
                                  placeholder="Tell us more about your interests and goals..."></textarea>
                    </div>
                    
                    <div class="flex items-start">
                        <input type="checkbox" id="agree" name="agree" required 
                               class="mt-1 h-4 w-4 text-seait-orange focus:ring-seait-orange border-gray-300 rounded">
                        <label for="agree" class="ml-2 text-sm text-gray-700">
                            I agree to the <a href="{{ route('privacy') }}" class="text-seait-orange hover:text-orange-600">Privacy Policy</a> 
                            and <a href="{{ route('terms') }}" class="text-seait-orange hover:text-orange-600">Terms of Service</a>
                        </label>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-seait-orange text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition-colors">
                            Submit Pre-registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
