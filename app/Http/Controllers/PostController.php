<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use function auth;

class PostController extends Controller
{
    public function index(): View
    {
        return view('posts.index', [
            'posts' => Post::where('user_id', auth()->id())
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $post = auth()->user()->posts()->create([...$request->validated()]);
        
        return redirect()->route('posts.show', $post)->with('status', 'post-created');
    }

    public function show(Post $post): View
    {
        $this->ensureOwnedByAuthUser($post);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $this->ensureOwnedByAuthUser($post);

        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->ensureOwnedByAuthUser($post);

        $post->update($request->validated());

        return redirect()->route('posts.show', $post)->with('status', 'post-updated');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->ensureOwnedByAuthUser($post);

        $post->delete();

        return redirect()->route('posts.index')->with('status', 'post-deleted');
    }

    protected function ensureOwnedByAuthUser(Post $post): void
    {
        abort_unless($post->user_id === auth()->id(), 403);
    }
}
