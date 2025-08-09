@props(['label', 'name', 'description' => ''])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full',
    ];
@endphp

<x-forms.field :$label :$name>
    <textarea {{ $attributes($defaults) }} rows="5">{{ old($name, $description) }}</textarea>
</x-forms.field>
