<?php

namespace App\Livewire\Admin\Access;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

#[Layout('components.layouts.admin')]
class AccessManager extends Component
{
    use WithPagination;

    public string $activeTab = 'users';

    public bool $showUserModal = false;
    public ?int $editingUserId = null;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $selectedRole = 'Editor';

    public ?int $selectedRoleId = null;
    public string $selectedRoleName = '';
    public array $rolePermissions = [];

    // Master Permission Groups (Add any future module here - Auto-synced to DB!)
    public array $permissionGroups = [
        'Pages & Builder' => [
            'pages.view'    => 'View List',
            'pages.create'  => 'Create',
            'pages.edit'    => 'Edit / Compose',
            'pages.publish' => 'Publish',
            'pages.delete'  => 'Delete',
        ],
        'Media Library' => [
            'media.view'   => 'Browse Assets',
            'media.upload' => 'Upload',
            'media.delete' => 'Delete',
        ],
        'Services Module' => [
            'services.view'   => 'View List',
            'services.create' => 'Create',
            'services.edit'   => 'Edit Specs',
            'services.delete' => 'Delete',
        ],
        'Business Units' => [
            'business_units.view'   => 'View Units',
            'business_units.create' => 'Add Unit',
            'business_units.edit'   => 'Edit Overview',
            'business_units.delete' => 'Delete',
        ],
        'Products & Parts' => [
            'products.view'   => 'View Catalog',
            'products.create' => 'Add Part',
            'products.edit'   => 'Edit Specs',
            'products.delete' => 'Delete',
        ],
        'Executive Board' => [
            'leadership.view'   => 'View Members',
            'leadership.create' => 'Add Leader',
            'leadership.edit'   => 'Edit Bio',
            'leadership.delete' => 'Delete',
        ],
        'RFQ & Inquiries' => [
            'enquiries.view'   => 'View Leads',
            'enquiries.reply'  => 'Reply',
            'enquiries.delete' => 'Delete',
        ],
        'Design & Menus' => [
            'theme.manage' => 'Theme Customizer',
            'menus.manage' => 'Menu Builder',
        ],
        'Platform Administration' => [
            'settings.manage' => 'Global Settings',
            'users.view'      => 'View Users',
            'users.create'    => 'Add User',
            'users.edit'      => 'Edit Roles',
            'users.delete'    => 'Delete Users',
            'roles.manage'    => 'Manage Permissions',
        ],
    ];

    public function mount(): void
    {
        // 1. Auto-Discover & Auto-Sync any new permissions into DB without seeders!
        $this->autoSyncNewPermissionsToDatabase();

        // 2. Select default role
        $firstRole = Role::where('name', '!=', 'Super Administrator')->first() ?? Role::first();
        if ($firstRole) {
            $this->selectRole($firstRole->id);
        }
    }

    /**
     * Self-Healing Pipeline: Automatically registers any newly defined permissions into DB on the fly.
     */
    protected function autoSyncNewPermissionsToDatabase(): void
    {
        $allCodePermissions = collect($this->permissionGroups)
            ->flatMap(fn($group) => array_keys($group))
            ->toArray();

        $existingDbPermissions = Permission::pluck('name')->toArray();
        $missingPermissions = array_diff($allCodePermissions, $existingDbPermissions);

        if (! empty($missingPermissions)) {
            foreach ($missingPermissions as $perm) {
                Permission::firstOrCreate(['name' => $perm]);
            }
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
        }
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function openCreateUserModal(): void
    {
        $this->reset(['editingUserId', 'name', 'email', 'password']);
        $this->selectedRole = 'Editor';
        $this->showUserModal = true;
    }

    public function openEditUserModal(int $userId): void
    {
        $user = User::findOrFail($userId);
        $this->editingUserId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->selectedRole = $user->roles->first()?->name ?? 'Editor';
        $this->showUserModal = true;
    }

    public function saveUser(): void
    {
        $this->validate([
            'name'         => 'required|string|max:150',
            'email'        => ['required', 'email', Rule::unique('users', 'email')->ignore($this->editingUserId)],
            'selectedRole' => 'required|exists:roles,name',
            'password'     => $this->editingUserId ? 'nullable|min:6' : 'required|min:6',
        ]);

        if ($this->editingUserId) {
            $user = User::findOrFail($this->editingUserId);
            $user->update([
                'name'  => $this->name,
                'email' => $this->email,
            ]);

            if (!empty($this->password)) {
                $user->update(['password' => Hash::make($this->password)]);
            }

            $user->syncRoles([$this->selectedRole]);
            session()->flash('message', 'User account successfully updated.');
        } else {
            $user = User::create([
                'name'     => $this->name,
                'email'    => $this->email,
                'password' => Hash::make($this->password),
            ]);

            $user->assignRole($this->selectedRole);
            session()->flash('message', 'New user account created successfully.');
        }

        $this->showUserModal = false;
        $this->reset(['editingUserId', 'name', 'email', 'password']);
    }

    public function deleteUser(int $userId): void
    {
        if (auth()->id() === $userId) {
            session()->flash('error', 'You cannot delete your own administrative account.');
            return;
        }

        $user = User::findOrFail($userId);

        if ($user->hasRole('Super Administrator') && User::role('Super Administrator')->count() <= 1) {
            session()->flash('error', 'Cannot delete the only Super Administrator account.');
            return;
        }

        $user->delete();
        session()->flash('message', 'User account successfully removed.');
    }

    public function selectRole(int $roleId): void
    {
        $this->selectedRoleId = $roleId;
        $role = Role::findOrFail($roleId);
        $this->selectedRoleName = $role->name;
        // Ensure strictly continuous indexed array
        $this->rolePermissions = array_values($role->permissions->pluck('name')->toArray());
    }

    /**
     * Toggle all checkboxes strictly in this group without affecting other groups.
     */
    public function toggleAllGroup(string $groupName): void
    {
        if ($this->selectedRoleName === 'Super Administrator') {
            return;
        }

        $groupPerms = array_keys($this->permissionGroups[$groupName] ?? []);
        $intersect = array_intersect($groupPerms, $this->rolePermissions);
        $allChecked = count($intersect) === count($groupPerms);

        if ($allChecked) {
            // Remove group items and strictly reset array indices
            $this->rolePermissions = array_values(array_diff($this->rolePermissions, $groupPerms));
        } else {
            // Add group items, eliminate duplicates, and strictly reset array indices
            $this->rolePermissions = array_values(array_unique(array_merge($this->rolePermissions, $groupPerms)));
        }
    }

    public function saveRolePermissions(): void
    {
        if (! $this->selectedRoleId || $this->selectedRoleName === 'Super Administrator') {
            return;
        }

        $role = Role::findOrFail($this->selectedRoleId);
        $role->syncPermissions($this->rolePermissions);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        session()->flash('message', "Permissions matrix for role '{$role->name}' successfully updated.");
    }

    public function render()
    {
        return view('livewire.admin.access.access-manager', [
            'users' => User::with('roles')->latest()->paginate(15),
            'roles' => Role::withCount('users')->get(),
        ])->title('Access Control Studio | Nordroy CMS');
    }
}