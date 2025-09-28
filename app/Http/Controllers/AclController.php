<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AclController extends Controller
{
    public function roleStore(StoreRoleRequest $request)
    {
        try {
            Role::create($request->validated());

            return response()->json([
                'message' => 'نقش با موفقیت اضافه شد',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'       => 'در ذخیره کردن نقش مشگل پیش آمده اس',
                'error-message' => $e->getMessage()
            ]);
        }
    }

    public function setPermission() {}
}
