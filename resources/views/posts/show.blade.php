<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4 flex-wrap">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $post->title }}
            </h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </a>
                <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline" onsubmit="return confirm(@json(__('Delete this post?')))">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit">{{ __('Delete') }}</x-danger-button>
                </form>
                <a href="{{ route('posts.index') }}" class="text-sm text-gray-600 underline hover:text-gray-900 ms-2">{{ __('Back') }}</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') === 'post-created')
                <p class="mb-4 font-medium text-sm text-green-600">{{ __('Post created.') }}</p>
            @endif
            @if (session('status') === 'post-updated')
                <p class="mb-4 font-medium text-sm text-green-600">{{ __('Post updated.') }}</p>
            @endif

            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-sm text-gray-500 mb-6">{{ __('Posted') }} {{ $post->created_at->format('M j, Y g:i A') }}</p>
                    <div class="text-gray-900 leading-relaxed whitespace-pre-wrap">{{ $post->body }}</div>
                </div>
            </article>
        </div>
    </div>
</x-app-layout>
