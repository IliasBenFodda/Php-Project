@props(['type' => 'success', 'message' => null])

@php
    $message = $message ?? session($type);
    $classes = $type === 'error'
        ? 'bg-red-50 border-red-200 text-red-700'
        : 'bg-green-50 border-green-200 text-green-700';
@endphp

@if ($message)
    <div {{ $attributes->merge(['class' => 'mb-4 rounded-md border p-4 text-sm ' . $classes]) }}>
        {{ $message }}
    </div>
@endif
