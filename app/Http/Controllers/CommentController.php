<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        try {
            $comment = new Comment($request->validated());

            auth('api')->user()->comments()->save($comment);

            return response()->json([
                'message' => 'نظر با موفقیت ثبت شد',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'       => 'در ذخیره سازی نظر مشگلی به وجود آمده',
                'error-message' => $e->getMessage()
            ]);
        }
    }
}
