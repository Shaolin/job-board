<x-layout>


<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold mb-6">Edit Job Listing</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jobs.update', $job) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Job Title -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
            <input type="text" name="title" id="title"
                   value="{{ old('title', $job->title) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Job Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $job->description) }}</textarea>
        </div>

        <!-- Salary -->
        <div class="mb-4">
            <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
            <input type="text" name="salary" id="salary"
                   value="{{ old('salary', $job->salary) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Location -->
        <div class="mb-4">
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" id="location"
                   value="{{ old('location', $job->location) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Schedule -->
        <div class="mb-4">
            <label for="schedule" class="block text-sm font-medium text-gray-700">Schedule</label>
            <select name="schedule" id="schedule"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="Full Time" {{ old('schedule', $job->schedule) == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                <option value="Part Time" {{ old('schedule', $job->schedule) == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                <option value="Contract" {{ old('schedule', $job->schedule) == 'Contract' ? 'selected' : '' }}>Contract</option>
            </select>
        </div>

        <!-- URL -->
        <div class="mb-4">
            <label for="url" class="block text-sm font-medium text-gray-700">Application URL</label>
            <input type="url" name="url" id="url"
                   value="{{ old('url', $job->url) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Featured -->
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="featured" id="featured"
                   value="1" {{ old('featured', $job->featured) ? 'checked' : '' }}
                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
            <label for="featured" class="ml-2 block text-sm text-gray-700">Featured Listing</label>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <a href="{{ route('jobs.show', $job) }}" class="mr-3 text-gray-600 hover:text-gray-800">Cancel</a>
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                Update Job
            </button>
        </div>
    </form>
</div>


</x-layout>
