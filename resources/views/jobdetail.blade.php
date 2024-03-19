@extends('layout')

@section('content')

@if(auth()->check())
@php
$name = session()->get('user')['name'] ?? 'User';    
$client = \App\Models\Client::where('name', $name)->first();
$resume = $client ? $client->resume : null;
@endphp


@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="flex">
    <!-- Main Content -->
    <div class="w-3/4 p-4">
        @foreach ($jobs as $job)
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">{{$job->title}}</h2>
                <p class="text-gray-700">{{$job->company}}</p>
                <img src="{{$job->logo}}" alt="{{$job->company}}" class="mt-2">
                <p class="text-xl font-semibold mb-2">{{$job->description}}</p>
                <br>
                <h2 class="text-xl font-semibold mb-2">Job Description</h2>
                <ul class="list-disc ml-6">
                    @php
                        $requirements = explode(',', $job->job_description);
                    @endphp
                    @foreach($requirements as $requirement)
                        <li>{{ trim($requirement) }}</li>
                    @endforeach
                </ul>
                <br>
                <h2 class="text-xl font-semibold mb-2">Job Requirements</h2>
                <ul class="list-disc ml-6">
                    @php
                        $requirements = explode(',', $job->job_requirement);
                    @endphp
                    @foreach($requirements as $requirement)
                        <li>{{ trim($requirement) }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>


    <div>
        <div class="mt-8">
            <h2 class="text-lg font-semibold mb-4">Logged in as: {{$name}}</h2>
            
        </div>
        
        @if($resume)
        <div class="mt-4">
            <h2 class="text-lg font-semibold mb-2">Resume:</h2>
            <h2>Current CV : {{pathinfo($resume, PATHINFO_FILENAME)}}</h2>
            <form action="/applyjob" method="POST">
                @csrf
                <button name="getID" value="{{$job->job_id}}" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none">Apply This Job</button>
            </form>
        </div>

        <div class="mt-4">
            <form action="/updatecv" method="POST" enctype="multipart/form-data">
                @csrf
               <input type="file" name="resume" accept=".pdf" class="mb-2">
               <button type="submit" class="bg-red-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none">Update A New Resume</button>
           </form>
        </div>
        @else

        <!-- Get current session username and upload a cv at it's row at Client Model, 
                    then redirect the page with intened method, you will have to make a job applied record table first 
                    then prevent the current user to apply the same job twice!
                    This website will complete it's sturcture after I made applied cv was sent to admin site with client and applied job
                    paired the actual PDF or Words File-->
        
            
        <form action="/updatecv" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="resume">Upload a new CV:</label>
                    <input type="file" name="resume" accept=".pdf" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline">Update CV</button>
        </form>      
        @endif
    </div>
</div>

@else
<div class="flex">
    <!-- Main Content -->
    <div class="w-3/4 p-4">
        @foreach ($jobs as $job)
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">{{$job->title}}</h2>
                <p class="text-gray-700">{{$job->company}}</p>
                <img src="{{$job->logo}}" alt="{{$job->company}}" class="mt-2">
                <p class="text-xl font-semibold mb-2">{{$job->description}}</p>
                <br>
                <h2 class="text-xl font-semibold mb-2">Job Description</h2>
                <ul class="list-disc ml-6">
                    @php
                        $requirements = explode(',', $job->job_description);
                    @endphp
                    @foreach($requirements as $requirement)
                        <li>{{ trim($requirement) }}</li>
                    @endforeach
                </ul>
                <br>
                <h2 class="text-xl font-semibold mb-2">Job Requirements</h2>
                <ul class="list-disc ml-6">
                    @php
                        $requirements = explode(',', $job->job_requirement);
                    @endphp
                    @foreach($requirements as $requirement)
                        <li>{{ trim($requirement) }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <!-- Sidebar -->
    <div class="w-1/4 p-4 bg-gray-200">
        <div>
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops! Something went wrong.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h2 class="text-lg font-semibold mb-4">Log In To Apply Job</h2>
            <form action="/loginX" method="POST">
                @csrf
                <input type="hidden" name="getID" value="{{ $job->job_id }}">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 p-2 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 p-2 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">Log In</button>
            </form>
        </div>    
    </div>
</div>
@endif

@endsection
