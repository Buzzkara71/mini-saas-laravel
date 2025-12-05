{{-- Wrapper modern layout --}}
@props(['title' => ''])

@include('layouts.app-modern', [
    'title' => $title,
    'slot' => $slot
])
