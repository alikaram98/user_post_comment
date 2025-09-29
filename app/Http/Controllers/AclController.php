<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AclController extends Controller
{
    public function roleStore(StoreRoleRequest $request): JsonResponse
    {
        try {
            Role::create($request->validated());

            return response()->json([
                'message' => 'نقش با موفقیت اضافه شد',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'       => 'در ذخیره کردن نقش مشگل پیش آمده است',
                'error-message' => $e->getMessage()
            ]);
        }
    }

    public function userSetRole(User $user, Role $role)
    {
        try {
            $user->syncRoles([$role->name]);

            return response()->json([
                'message' => 'نقش با موفقیت برای کاربر مورد نظر اعمال شد'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'       => 'در تعیین نقش برای کاربر مشگلی پیش آمده',
                'error-message' => $e->getMessage()
            ]);
        }
    }

    public function permissionStore(StorePermissionRequest $request): JsonResponse
    {
        try {
            Permission::create($request->validated());

            return response()->json([
                'message' => 'دسترسی با موفقیت اضافه شد',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'       => 'در ذخیره کردن دسترسی مشگل پیش آمده اس',
                'error-message' => $e->getMessage()
            ]);
        }
    }
}
