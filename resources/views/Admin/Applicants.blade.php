@extends('Admin.adminpanel')

@section('content')
<div class="overflow-x-auto p-4">

    <!-- Date filter form -->
    <form action="/datefilter" method="GET" class="mb-4 flex items-center">
        <label for="start_date" class="mr-2 text-lg font-bold text-purple-700">Start Date:</label>
        <input type="date" id="start_date" name="start_date" class="mr-4 border-2 border-purple-500 rounded-lg p-2 focus:outline-none focus:border-purple-700">
        <label for="end_date" class="mr-2 text-lg font-bold text-purple-700">End Date:</label>
        <input type="date" id="end_date" name="end_date" class="mr-4 border-2 border-purple-500 rounded-lg p-2 focus:outline-none focus:border-purple-700">
        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
            Filter
        </button>
    </form>

    <table class="table-auto border-collapse border border-purple-500">
        <thead>
            <tr class="bg-purple-400 text-white">
                <th class="border border-purple-500 px-4 py-2">Name</th>
                <th class="border border-purple-500 px-4 py-2">User ID</th>
                <th class="border border-purple-500 px-4 py-2">User Email</th>
                <th class="border border-purple-500 px-4 py-2">Applied Job ID</th>
                <th class="border border-purple-500 px-4 py-2">Job Title</th>
                <th class="border border-purple-500 px-4 py-2">Company Name</th>
                <th class="border border-purple-500 px-4 py-2">Resume</th>
                <th class="border border-purple-500 px-4 py-2">Applied Date</th>
                <th class="border border-purple-500 px-4 py-2">Download CV</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
            <tr>
                <td class="border border-purple-500 px-4 py-2">{{ $record->client_name }}</td>
                <td class="border border-purple-500 px-4 py-2">{{ $record->client_id }}</td>
                <td class="border border-purple-500 px-4 py-2">{{ $record->client_email }}</td>
                <td class="border border-purple-500 px-4 py-2">{{ $record->job_id }}</td>
                <td class="border border-purple-500 px-4 py-2">{{ $record->job_title }}</td>
                <td class="border border-purple-500 px-4 py-2">{{ $record->company_name }}</td>
                <td class="border border-purple-500 px-4 py-2">{{ $record->cv }}</td>
                <td class="border border-purple-500 px-4 py-2">{{ $record->created_at }}</td>

                <td class="border border-purple-500 px-4 py-2">
                    <form action="/downcv" method="POST">
                        @csrf
                        <input type="hidden" name="cv_path" value="{{ $record->cv }}">
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                            Download CV
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
