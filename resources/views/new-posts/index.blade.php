<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New posts') }}
            </h2>
            @can('create', \App\Models\NewPost::class)
                <a href="{{ route('new-posts.create') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Create new post') }}
                </a>
           @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') === 'new-post-deleted')
                <p class="mb-4 font-medium text-sm text-green-600">
                    {{ __('New post deleted.') }}
                </p>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($newPosts->isEmpty())
                        <p>{{ __('No new posts yet. Create one to get started.') }}</p>
                    @else
                        <ul class="divide-y divide-gray-100">
                            @foreach ($newPosts as $newPost)
                                <li class="py-4 flex justify-between gap-4 flex-wrap">
                                    <a href="{{ route('new-posts.show', $newPost) }}" class="font-medium text-indigo-600 hover:text-indigo-900">
                                        {{ $newPost->title }}
                                    </a>
                                    <span class="text-sm text-gray-500">{{ $newPost->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-6">
                            {{ $newPosts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
