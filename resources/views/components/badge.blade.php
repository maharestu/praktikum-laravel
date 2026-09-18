<!-- Tugas Pertemuan 5 -->

@props(['status'])

@php
    $class = match ($status) {
        'Aman' => 'bg-green-100 text-green-800',
        'Menipis' => 'bg-yellow-100 text-yellow-800',
        'Habis' => 'bg-red-100 text-red-800',
        default => 'bg-gray-100 text-gray-800',
    };
@endphp

<span class="px-2 py-1 text-xs font-semibold rounded-full {{ $class }}">
    {{ $status }}
</span>

<!-- =================  -->