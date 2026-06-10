@extends('layouts.app')

@section('title', 'Forgot Password - SEAIT')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-seait-dark">
                Forgot your password?
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Enter your email address and we'll send you a link to reset your password.
            </p>
        </div>
        
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
        <form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
            @csrf
            
            <div>
                <label for="email" class="sr-only">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required 
                       class="form-input @error('email') border-red-500 @enderror"
                       placeholder="Email address" value="{{ old('email') }}">
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn-primary w-full">
                    Send Password Reset Link
                </button>
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-seait-orange hover:text-orange-500 text-sm">
                    Back to login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
