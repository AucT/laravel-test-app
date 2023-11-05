<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-4">
    @foreach($items as $post)
        <div class="max-w-xs rounded overflow-hidden shadow-lg" style="max-width: 600px;">
            <img class="w-full" src="{{ $post->image }}" alt="{{ $post->title }}">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $post->title }}</div>
                <p class="text-gray-700 text-base">{{ $post->body }}</p>
            </div>
        </div>
    @endforeach
        {{ $items->links() }}
    </div>



</x-app-layout>
