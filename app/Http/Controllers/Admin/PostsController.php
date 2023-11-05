<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Services\ImageService;
use App\Services\UnsplashService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tags = [
            'title' => 'Admin Posts Index',
            'active' => 'admin.posts'
        ];


        $items = Post::query()->with('user:id,name')->paginate(10)->withQueryString();

        return view('admin.posts.index', ['tags' => $tags, 'items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tags = [
            'title' => 'Admin Posts Create',
            'active' => 'admin.posts.create'
        ];

        return view('admin.posts.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request, UnsplashService $unsplashService): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $unsplashService->getRandomImage();
        auth()->user()->posts()->create($data);
        return redirect()->route('admin.posts')->with('flash_message', ['type' => 'success', 'message' => 'Successfully created post.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        $tags = [
            'title' => 'Admin Edit Post ' . $post->title,
        ];

        return view('admin.posts.edit', ['tags' => $tags, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(PostStoreRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());
        return redirect()->back();
    }

    public function imageUpdate(Post $post, UnsplashService $unsplashService, ImageService $imageService): string
    {
        $oldImage = $post->image;
        $post->image = $unsplashService->getRandomImage();
        $post->save();
        $imageService->deleteImage($oldImage);

        return "<img src='{$post->image}' alt=''>";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse|RedirectResponse
    {
        $post->delete();
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect(route('admin.posts'))->with('flash_message', ['type' => 'success', 'message' => 'Successfully deleted post.']);

    }
}
