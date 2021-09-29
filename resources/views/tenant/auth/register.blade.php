@extends('layouts.tenant')

@section('content')

<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
        {{ __('Sign up') }}
    </h2>
    <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
        Already have an account?
        <a href="{{ route('tenant.login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
            Sign in.
        </a>
    </p>
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form method="POST" action="{{ route('tenant.register') }}">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Full name') }}:
                </label>
                <div class="mt-1 rounded-md">
                    <input name="name" id="name" type="text" required class="shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-500 @enderror" name="name" value="{{ old('name', request()->query('name')) }}" autofocus />
                    
                    @error('name')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
            
            <div class="mt-6">
                <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Email address') }}:
                </label>
                <div class="mt-1 rounded-md">
                    <input name="email" id="email" type="email" required class="shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-500 @enderror" name="email" value="{{ old('email', request()->query('email')) }}" autofocus />
                    
                    @error('email')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
            
            <div class="mt-6">
                <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Password') }}:
                </label>
                <div class="mt-1 rounded-md">
                    <input id="password" type="password" required class="shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-500 @enderror" name="password" />

                    @error('password')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Confirm password') }}:
                </label>
                <div class="mt-1 rounded-md">
                    <input id="password_confirmation" type="password" required class="shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password_confirmation') border-red-500 @enderror" name="password_confirmation" />
                </div>
            </div>
            
            <div class="mt-6">
                <span class="block w-full rounded-md shadow-sm">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        {{ __('Sign up') }}
                    </button>
                </span>
            </div>
        </form>
        
    </div>
</div>
@endsection
