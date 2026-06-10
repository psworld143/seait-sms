@extends('layouts.app')

@section('title', 'Reset Password - SEAIT')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-seait-dark">
                Reset your password
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Enter your new password below.
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
            @csrf
            
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="space-y-4">
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="form-input @error('email') border-red-500 @enderror"
                           placeholder="Email address" value="{{ $email ?? old('email') }}">
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="sr-only">New Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required 
                           class="form-input @error('password') border-red-500 @enderror"
                           placeholder="New Password">
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="sr-only">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                           class="form-input"
                           placeholder="Confirm New Password">
                </div>
            </div>

            <div>
                <button type="submit" class="btn-primary w-full">
                    Reset Password
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
