@extends('Admin.adminpanel')
@section('content')

<div class="flex flex-wrap justify-center">

    @foreach ($jobs as $job)
    <div class="bg-white p-8 rounded shadow-md w-96 m-4">
        <img src="{{ asset($job->logo) }}" alt="{{ $job->title }} Logo" class="w-full h-32 object-cover mb-4">

        <h2 class="text-xl font-semibold mb-2">{{ $job->title }}</h2>
        <h2 class="text-xl font-semibold mb-2">Hiring Company : {{ $job->company }}</h2>
        <p class="text-gray-500 mb-2">{{ $job->tags }}</p>
        <a href="{{ $job->website }}" target="_blank" class="text-blue-500 hover:underline">{{ $job->website }}</a>
        <!--Edit -->
        <form action="/jobs_edit" method="GET">
            @csrf
            <button type="submit" name="getID" value="{{$job->job_id}}" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none">
                Edit Job
            </button> <br><br>       
        </form>
      
        <!--delete -->
        <form action="/delete" method="POST">
            @csrf
            <button type="submit" name="getID" value="{{$job->job_id}}" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none">
                Delete Job
            </button>
        </form>
    </div>
    
    @endforeach

</div>


@endsection
