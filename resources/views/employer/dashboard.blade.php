<x-layout>
    <!-- resources/views/employer/dashboard.blade.php -->





<div class="container">
    <h2 class="mb-4">My Job Listings</h2>

    <div class="row">
        @forelse($jobs as $job)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    {{-- Employer Logo --}}
                    <img src="{{ asset('storage/' . $job->employer->logo) }}" 
                         class="card-img-top p-3" 
                         alt="{{ $job->employer->name }}" 
                         style="height: 120px; object-fit: contain;">

                    <div class="card-body">
                        {{-- Job Title & Location --}}
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <p class="text-muted mb-2">
                            <i class="bi bi-geo-alt"></i> {{ $job->location }}
                        </p>

                        {{-- Salary --}}
                        {{-- <p class="fw-bold text-primary">₦{{ number_format($job->salary) }}</p> --}}
                        <p class="fw-bold text-primary">
                            ₦{{ number_format((float) $job->salary) }}
                        </p>

                        {{-- Applicants Count (placeholder) --}}
                        <span class="badge bg-info text-dark">
                            {{ rand(0, 20) }} Applicants
                        </span>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No jobs found.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $jobs->links() }}
    </div>
</div>



</x-layout>