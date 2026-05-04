<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewPostRequest;
use App\Http\Requests\UpdateNewPostRequest;
use App\Models\NewPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use function auth;

class NewPostController extends Controller
{
    public function index(): View
    {
        return view('new-posts.index', [
            'newPosts' => NewPost::where('user_id', auth()->id())
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('new-posts.create');
    }

    public function store(StoreNewPostRequest $request): RedirectResponse
    {
        $newPost = auth()->user()->newPosts()->create([...$request->validated()]);

        return redirect()->route('new-posts.show', $newPost)->with('status', 'new-post-created');
    }

    public function show(NewPost $newPost): View
    {
        return view('new-posts.show', compact('newPost'));
    }

    public function edit(NewPost $newPost): View
    {
        return view('new-posts.edit', compact('newPost'));
    }

    public function update(UpdateNewPostRequest $request, NewPost $newPost): RedirectResponse
    {
        $newPost->update($request->validated());

        return redirect()->route('new-posts.show', $newPost)->with('status', 'new-post-updated');
    }

    public function destroy(NewPost $newPost): RedirectResponse
    {
        $newPost->delete();

        return redirect()->route('new-posts.index')->with('status', 'new-post-deleted');
    }
}
