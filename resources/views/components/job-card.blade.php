


@props(['job'])

    <x-panel class="flex flex-col text-center">
            
    {{-- <div class="self-start text-sm">{{$job->employer->name}}</div> --}}
    <div>

    
    <a href= "{{$job->url}}" target="_blank" class="self-start text-sm text-gray-4 00">{{$job->employer->name}}</a>
</div>
    <div class="py-8">
        <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">


            @php
    dd($job->id, $job instanceof \App\Models\Job);
@endphp

             {{-- <a href="{{$job->url}}"  target="_blank">

                
                {{$job->title}}</a> --}}
             

                 <a href="{{ route('jobs.show', $job) }}">
                    {{$job->title}}</a>  

                   
                   
        </h3>
        <p class="text-sm mt-4">{{$job->salary}}</p>
    </div>

    <div class="flex justify-between items-center mt-auto">

        <div>
         

            @foreach ($job->tags as $tag)

            <x-tag  :$tag size="small" />
                
            @endforeach
          
          
        
        </div>
        

        
        <x-employer-logo :employer="$job->employer" :width="42"/>

    </div>



</x-panel>