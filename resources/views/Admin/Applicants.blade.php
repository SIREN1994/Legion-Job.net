@extends('Admin.adminpanel')

@section('content')
    <div class="overflow-x-auto">

        <!-- Date filter form -->
        <form action="/datefilter" method="GET" class="mb-4">
            <div class="flex items-center">
                <label for="start_date" class="mr-2">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="mr-4">
                <label for="end_date" class="mr-2">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="mr-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
            </div>
        </form>

        <table class="table-auto border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Name</th>
                    <th class="border border-gray-400 px-4 py-2">User ID</th>
                    <th class="border border-gray-400 px-4 py-2">User Email</th>
                    <th class="border border-gray-400 px-4 py-2">Applied Job ID</th>
                    <th class="border border-gray-400 px-4 py-2">Job Title</th>
                    <th class="border border-gray-400 px-4 py-2">Company Name</th>
                    <th class="border border-gray-400 px-4 py-2">Resume</th>
                    <th class="border border-gray-400 px-4 py-2">Applied Date</th>
                    <th class="border border-gray-400 px-4 py-2">Download CV</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">{{ $record->client_name }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $record->client_id }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $record->client_email }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $record->job_id }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $record->job_title }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $record->company_name }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $record->cv }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $record->created_at }}</td>
                        
                        <td class="border border-gray-400 px-4 py-2">
                            <form action="/downcv" method="POST">
                                @csrf
                                <input type="hidden" name="cv_path" value="{{ $record->cv }}">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
