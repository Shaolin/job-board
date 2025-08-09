{{-- <x-layout>

  
    <div class="max-w-3xl mx-auto p-4">
        <h1 class="text-3xl font-bold mb-2">{{ $job->title }}</h1>
        <p class="text-gray-600 mb-4">Posted by {{ $job->employer->company_name }}</p>

        <p class="mb-4">{{ $job->description }}</p>

        <p><strong>Location:</strong> {{ $job->location }}</p>
        <p><strong>Salary:</strong> {{ $job->salary }}</p>
        <p><strong>Type:</strong> {{ $job->type }}</p>

        <a href="#" class="inline-block mt-4 text-blue-500 hover:underline">Apply Now</a>
    </div>
          


               
        


</x-layout> --}}

<x-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-md mt-10 space-y-6">

        {{-- Header Section --}}
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $job->title }}</h1>
                <p class="text-gray-600 mt-1">Posted by 
                    <span class="font-semibold">{{ $job->employer['name']}}</span>
                </p>
            </div>

            {{-- Employer Logo --}}
            {{-- @if ($job->employer->logo)
                <img src="{{ asset($job->employer->logo) }}" alt="Employer Logo" class="w-16 h-16 rounded-md border">
               
            @endif --}}
            <x-employer-logo :employer="$job->employer" />
        </div>

        {{-- Description --}}
        <div class="text-gray-800 leading-relaxed">
            {!! nl2br(e($job->description)) !!}
        </div>

        {{-- Job Info --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700 text-sm">
            <p><strong>📍 Location:</strong> {{ $job->location }}</p>
            <p><strong>💼 Type:</strong> {{ $job->schedule }}</p>
            <p><strong>💰 Salary:</strong> {{ $job->salary }}</p>
            <p><strong>📅 Posted:</strong> {{ $job->created_at->diffForHumans() }}</p>
        </div>

        {{-- Tags --}}
        @if ($job->tags->count())
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($job->tags as $tag)
                    <x-tag :tag="$tag" />
                @endforeach
            </div>
        @endif

       
        {{-- apply --}}

        @php
    $employerEmail = $job->employer->user->email;
    $subject = urlencode("Application for {$job->title}");
      @endphp

     <a href="mailto:{{ $employerEmail }}?subject={{ $subject }}" class="btn btn-primary">
    Apply Now
       </a>

        {{-- apply end --}}
        @can('update', $job)
    {{-- <a href="/'jobs.edit', $job" class="btn btn-primary">Edit Job</a> --}}
    <a href='{{ route('jobs.edit', $job) }}' class="btn btn-primary">Edit Job</a>
     @endcan

     {{-- delete --}}
     @can('update', $job) {{-- Only show if user owns the job --}}
<form action="{{ route('jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete Job</button>
</form>
@endcan

    </div>
</x-layout>


