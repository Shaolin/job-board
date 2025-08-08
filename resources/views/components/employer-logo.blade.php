

@props(['employer', 'width' => 90])


{{-- <img src="{{ asset($employer->logo)}}" alt="logo" class="rounded-xl" width="{{$width}}"> --}}

<img src="{{ asset('storage/' . $employer->logo) }}" alt="logo" class="rounded-xl" width="{{ $width }}">

