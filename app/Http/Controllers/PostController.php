<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Http\Requests\PostRequest;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
// use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::with('user', 'tags', 'category')->latest()->paginate(6),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        return view('posts.create', [
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }

    public function store(PostRequest $request)
    {
        $attr = $request->all();

        $slug = Str::slug($request->title);
        $attr['slug'] = $slug;

        $thumbnail = $request->file('thumbnail');
        $thumbnailUrl = $thumbnail->store("images/posts");
        $attr['thumbnail'] = $thumbnailUrl;

        $attr['category_id'] = $request->category;

        $post = Auth::user()->posts()->create($attr);
        $post->tags()->attach($request->tags);

        session()->flash('success', 'Post Successfully Created!');
        return redirect('/posts');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $attr = $request->all();
        $attr['category_id'] = $request->category;

        $thumbnail = $request->file('thumbnail');
        $thumbnailUrl = $thumbnail->store("images/posts");
        $attr['thumbnail'] = $thumbnailUrl;

        $post->update($attr);

        $post->tags()->sync($request->tags);

        session()->flash('success', 'Post updated successfuly');

        return redirect('/posts');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->tags()->detach();
        $post->delete();

        session()->flash('success', 'Post was successfully deleted!');
        return redirect('/posts');
    }
}
