<?php

use Carbon\Carbon;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

/**
 * Class PermissionTableSeeder.
 */
class PermissionTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncateMultiple([config('access.permissions_table'), config('access.permission_role_table')]);

        /**
         * Don't need to assign any permissions to administrator because the all flag is set to true
         * in RoleTableSeeder.php.
         */

        /**
         * Misc Access Permissions.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-backend';
        $viewBackend->display_name = 'View Backend';
        $viewBackend->sort = 1;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->save();
        /**
         * Access Permissions.
         */
        $permission_model = config('access.permission');
        $manageUsers = new $permission_model();
        $manageUsers->name = 'manage-users';
        $manageUsers->display_name = 'Manage Users';
        $manageUsers->sort = 2;
        $manageUsers->created_at = Carbon::now();
        $manageUsers->updated_at = Carbon::now();
        $manageUsers->save();

        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-roles';
        $manageRoles->display_name = 'Manage Roles';
        $manageRoles->sort = 3;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();


        /**
         * Inquiry Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-inquiry';
        $manageRoles->display_name = 'Manage Inquiry';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();

        /**
         * Tag Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-tag';
        $manageRoles->display_name = 'Manage Tag';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();

        /**
         * Slide Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-slide';
        $manageRoles->display_name = 'Manage Slide';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();

        /**
         * Page Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-page';
        $manageRoles->display_name = 'Manage Page';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();

        /**
         * Menu Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-block';
        $manageRoles->display_name = 'Manage Block';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();

        /**
         * Menu Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-menu';
        $manageRoles->display_name = 'Manage Menu';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();

        /**
         * Menu Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-project';
        $manageRoles->display_name = 'Manage Projects';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();

        /**
         * Menu Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-products';
        $manageRoles->display_name = 'Manage Product';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();

        /**
         * Menu Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-newsletter';
        $manageRoles->display_name = 'Manage Newsletter';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();

        /**
         * Menu Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-setting';
        $manageRoles->display_name = 'Site Settings';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();


        /**
         * Menu Permissions
         */
        $permission_model = config('access.permission');
        $manageRoles = new $permission_model();
        $manageRoles->name = 'manage-view';
        $manageRoles->display_name = 'Manage Views';
        $manageRoles->sort = 4;
        $manageRoles->created_at = Carbon::now();
        $manageRoles->updated_at = Carbon::now();
        $manageRoles->save();


        $this->enableForeignKeys();
    }
}
