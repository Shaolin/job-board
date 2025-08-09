<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    //     $jobs = Job::latest()->get()->groupBy('featured');

        
    //     return view('jobs.index' ,[
    //         'jobs' => $jobs[0],

    //         'featuredJobs' => $jobs[1],
            
    //         'tags' => Tag::all(),
    //     ]);
        
    // }
    public function index()
    {
        // Paginate only non-featured jobs (where 'featured' is false or 0)
        $jobs = Job::where('featured', false)
                    ->latest()
                    ->simplePaginate(5, ['*'], 'jobs'); // second param is the query string key
    
        // Get featured jobs (optional: limit to recent ones)
        $featuredJobs = Job::where('featured', true)
                           ->latest()
                           ->take(6)
                           ->get();
    
        return view('jobs.index', [
            'jobs' => $jobs,
            'featuredJobs' => $featuredJobs,
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $attributes =  $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in('Part Time', 'Full Time')],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

       $job =  Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if($attributes['tags'] ?? false){
            foreach (explode(',', $attributes['tags']) as $tag){
                $job->tag($tag);
            }
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $this->authorize('update', $job);

       
        // return view('jobs.edit', ['job' => $job]);
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
         // Authorize the user (extra safety even if middleware is applied)
    $this->authorize('update', $job);

    // Validate incoming data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'salary' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'schedule' => 'nullable|string|max:255',
        'url' => 'nullable|url|max:255',
        'featured' => 'nullable|boolean',
    ]);

    // Checkbox handling
    $validated['featured'] = $request->has('featured');

    // Update the job
    $job->update($validated);

    // Redirect back to the job page with success message
    return redirect()
        ->route('jobs.show', $job)
        ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        
         // Authorization check using JobPolicy
            $this->authorize('delete', $job);
            

              $job->delete();

               return redirect()->route('jobs.index')
                     ->with('success', 'Job listing deleted successfully.');
    }
}
