<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;

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

    public function delete(Comment $comment) {
        try {
            Gate::authorize('delete', $comment);

            $comment->delete();

            return response()->json([
                'message' => 'حذف نظر با موفقیت انجام شد'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'در حذف کردن نظر مشگلی پیش آمده'
            ]);
        }
    }

    public function update(Comment $comment, UpdateCommentRequest $request) {
        try {
            Gate::authorize('update', $comment);

            $comment->update(['comment' => $request->comment]);

            return response()->json([
                'message' => 'نظر کاربر با موفقیت به روز رسانی شد'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'در به روز رسانی نظر کاربر مشگلی پیش آمده'
            ]);
        }
    }
}
