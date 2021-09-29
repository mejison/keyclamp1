@extends('layouts.tenant', ['title' => __('New post')])

@section('content')

<form method="POST" action="{{ route('tenant.posts.store') }}">
    @csrf
    <div>
        <div>
            <div class="grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="title" class="block text-sm font-medium leading-5 text-gray-700">
                        Title
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input id="title" name="title" value="{{ old('title') }}" class="flex-1 form-input block w-full min-w-0 rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('title')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                
                <div class="sm:col-span-6">
                    <label for="body" class="block text-sm font-medium leading-5 text-gray-700">
                        Body
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <textarea id="body" name="body" rows="5" class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">{{ old('body') }}</textarea>
                    </div>
                    @error('body')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                
            </div>
        </div>
        
    </div>
    <div class="mt-8 border-t border-gray-200 pt-5">
        <div class="flex justify-end">
            <span class="inline-flex rounded-md shadow-sm">
                <a href="{{ route('tenant.posts.index') }}" class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                    Cancel
                </a>
            </span>
            <span class="ml-3 inline-flex rounded-md shadow-sm">
                <button type="submit" class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                    Save
                </button>
            </span>
        </div>
    </div>
</form>

@endsection