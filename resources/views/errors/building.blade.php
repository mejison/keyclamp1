@extends('layouts.central')

@section('content')

<div class="flex h-full justify-center mt-32 leading-loose text-center text-xl">
    <div>
        <h1 class="text-5xl font-medium mb-2">We're building your site.</h1>
        
        <p>Please wait while our 🤖 robots build your website.</p>
        <p>It shouldn't take more than a minute.</p>
        
        <a href="javascript:window.location.reload()" class="inline-flex rounded-md shadow-sm mt-4">
              <button type="button" class="uppercase tracking-wide inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                Retry
            </button>
        </a>
    </div>
</div>

@endsection