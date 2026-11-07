<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Reset Spatie Cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Granular Permissions Grouped by Modules
        $permissions = [
            // Pages & Builder
            'pages.view', 'pages.create', 'pages.edit', 'pages.delete', 'pages.publish',
            // Media Assets
            'media.view', 'media.upload', 'media.delete',
            // Corporate Modules (Nordroy Services, Products, Leadership)
            'services.view', 'services.create', 'services.edit', 'services.delete',
            'business_units.view', 'business_units.create', 'business_units.edit', 'business_units.delete',
            'products.view', 'products.create', 'products.edit', 'products.delete',
            'leadership.view', 'leadership.create', 'leadership.edit', 'leadership.delete',
            // Communications & Inquiries
            'enquiries.view', 'enquiries.reply', 'enquiries.delete',
            // Appearance & Design
            'theme.manage', 'menus.manage',
            // System Administration
            'settings.manage', 'users.view', 'users.create', 'users.edit', 'users.delete', 'roles.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 3. Define Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Administrator']);
        $adminRole      = Role::firstOrCreate(['name' => 'Administrator']);
        $editorRole     = Role::firstOrCreate(['name' => 'Editor']);
        $contentManager = Role::firstOrCreate(['name' => 'Content Manager']);

        // 4. Assign Permissions
        // Super Admin gets EVERYTHING
        $superAdminRole->syncPermissions(Permission::all());

        // Administrator gets everything except sensitive user/roles management
        $adminRole->syncPermissions([
            'pages.view', 'pages.create', 'pages.edit', 'pages.delete', 'pages.publish',
            'media.view', 'media.upload', 'media.delete',
            'services.view', 'services.create', 'services.edit', 'services.delete',
            'business_units.view', 'business_units.create', 'business_units.edit', 'business_units.delete',
            'products.view', 'products.create', 'products.edit', 'products.delete',
            'leadership.view', 'leadership.create', 'leadership.edit', 'leadership.delete',
            'enquiries.view', 'enquiries.reply',
            'menus.manage', 'settings.manage',
        ]);

        // Editor gets content modules & media
        $editorRole->syncPermissions([
            'pages.view', 'pages.create', 'pages.edit',
            'media.view', 'media.upload',
            'services.view', 'services.create', 'services.edit',
            'business_units.view', 'business_units.edit',
            'products.view', 'products.edit',
            'leadership.view', 'leadership.edit',
            'enquiries.view',
        ]);

        // Content Manager
        $contentManager->syncPermissions([
            'pages.view', 'pages.edit',
            'media.view', 'media.upload',
            'services.view', 'services.edit',
            'enquiries.view',
        ]);

        // 5. Default Super Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Principal Admin',
                'password' => Hash::make('12345678'),
            ]
        );

        $admin->assignRole($superAdminRole);
    }
}