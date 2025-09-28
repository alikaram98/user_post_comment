<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try {
            $post = Post::create($request->validated());

            return response()->json([
                'message' => 'مقاله با موفقیت اضافه شد',
                'post'    => $post
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'در اضافه کردن مقاله مشگلی پیش آمده', 'error-message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        try {
            return response()->json([
                'post' => $post,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'در گرفتن مقاله مشگلی پیش آمده',
                'error'   => $e->getMessage(),
            ], $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
