<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
//        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $appAdminPermission = \Spatie\Permission\Models\Permission::create(['name' => ACCESS_APP_ADMIN_LABEL, 'description' => ACCESS_APP_ADMIN_LABEL . ' access description lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ', 'guard_name' => 'web']);

        $supportManagerPermission = Permission::create(['name' => ACCESS_APP_SUPPORT_MANAGER_LABEL, 'description' => ACCESS_APP_SUPPORT_MANAGER_LABEL . ' access description lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'guard_name' => 'web']);

        $contentEditorPermission = Permission::create(['name' => ACCESS_APP_CONTENT_EDITOR_LABEL, 'description' => ACCESS_APP_CONTENT_EDITOR_LABEL . ' access description lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'guard_name' => 'web']);

    }
}
