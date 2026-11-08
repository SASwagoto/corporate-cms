<div>
    <x-slot:header>Access Control</x-slot:header>

    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
        <div>
            <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Security & RBAC</span>
            <h1 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">Access Control & Permissions Studio</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400">Manage administrative users, roles, and granular module permissions.</p>
        </div>

        @if($activeTab === 'users')
            <button wire:click="openCreateUserModal"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm active:scale-95 transition-all cursor-pointer">
                <x-icon name="solid:user-plus" class="w-3.5 h-3.5" />
                <span>Add Administrator</span>
            </button>
        @else
            @if($selectedRoleName !== 'Super Administrator')
                <button wire:click="saveRolePermissions" wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm active:scale-95 transition-all cursor-pointer disabled:opacity-50 shrink-0">
                    <span wire:loading.remove wire:target="saveRolePermissions" class="inline-flex items-center gap-2 whitespace-nowrap">Save Permissions</span>
                    <span wire:loading.inline-flex wire:target="saveRolePermissions" class="items-center justify-center gap-2 whitespace-nowrap" style="display: none;">
                        <svg class="animate-spin h-3.5 w-3.5 text-current shrink-0" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Saving...</span>
                    </span>
                </button>
            @endif
        @endif
    </div>

    <!-- Feedback Alerts -->
    @if (session()->has('message'))
        <div class="mb-4 p-3 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-800 dark:text-emerald-400 text-xs font-semibold flex items-center justify-between">
            <span>{{ session('message') }}</span>
            <button @click="$el.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 cursor-pointer">&times;</button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-3 rounded-xl bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 text-rose-800 dark:text-rose-400 text-xs font-semibold flex items-center justify-between">
            <span>{{ session('error') }}</span>
            <button @click="$el.parentElement.remove()" class="text-rose-500 hover:text-rose-700 cursor-pointer">&times;</button>
        </div>
    @endif

    <!-- Main Studio Tabs -->
    <div class="flex items-center gap-1.5 p-1 rounded-xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 w-fit mb-5 shadow-2xs">
        <button wire:click="setTab('users')"
            class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer flex items-center gap-2 {{ $activeTab === 'users' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950 shadow-xs' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
            <x-icon name="solid:users" class="w-3.5 h-3.5" />
            <span>Administrative Users</span>
        </button>

        <button wire:click="setTab('roles')"
            class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-colors cursor-pointer flex items-center gap-2 {{ $activeTab === 'roles' ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950 shadow-xs' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white' }}">
            <x-icon name="solid:shield-halved" class="w-3.5 h-3.5" />
            <span>Roles & Permissions Matrix</span>
        </button>
    </div>

    <!-- ==================== TAB 1: USERS LIST ==================== -->
    @if($activeTab === 'users')
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 dark:bg-slate-950/60 border-b border-slate-200 dark:border-slate-800 text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                        <tr>
                            <th class="py-3 px-5">Administrator</th>
                            <th class="py-3 px-5">Assigned Role</th>
                            <th class="py-3 px-5">Created On</th>
                            <th class="py-3 px-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                        @foreach($users as $user)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors">
                                <td class="py-3 px-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-[#003C58]/10 dark:bg-cyan-500/10 text-[#003C58] dark:text-cyan-400 font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 dark:text-white text-xs">{{ $user->name }}</p>
                                            <p class="text-[11px] text-slate-400">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-5">
                                    @foreach($user->roles as $role)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#003C58]/10 text-[#003C58] dark:bg-cyan-500/10 dark:text-cyan-400 border border-[#003C58]/20">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="py-3 px-5 text-slate-400 text-[11px]">
                                    {{ $user->created_at->format('d M, Y') }}
                                </td>
                                <td class="py-3 px-5 text-right space-x-1">
                                    <button wire:click="openEditUserModal({{ $user->id }})" class="p-1 rounded-lg text-slate-400 hover:text-slate-800 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer" title="Edit User">
                                        <x-icon name="solid:pen-to-square" class="w-3.5 h-3.5" />
                                    </button>

                                    @if(auth()->id() !== $user->id)
                                        <button type="button"
                                                @click="$dispatch('open-confirm-dialog', {
                                                    title: 'Delete User Account',
                                                    message: 'Are you sure you want to permanently delete \'{{ $user->name }}\'? They will immediately lose dashboard access.',
                                                    type: 'danger',
                                                    confirmButtonText: 'Delete User',
                                                    method: 'deleteUser',
                                                    params: [{{ $user->id }}]
                                                })"
                                                class="p-1 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors cursor-pointer" title="Delete User">
                                            <x-icon name="solid:trash" class="w-3.5 h-3.5" />
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-t border-slate-100 dark:border-slate-800 text-xs">
                {{ $users->links() }}
            </div>
        </div>
    @endif

    <!-- ==================== TAB 2: ROLES & COMPACT 2-COLUMN PERMISSIONS MATRIX ==================== -->
    @if($activeTab === 'roles')
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
            
            <!-- Roles Selector Sidebar -->
            <div class="lg:col-span-3 space-y-1.5 lg:sticky lg:top-28">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-1 block mb-1">Select Role</span>
                @foreach($roles as $role)
                    <button type="button" wire:click="selectRole({{ $role->id }})"
                        class="w-full px-3 py-2.5 rounded-xl border text-left transition-all cursor-pointer flex items-center justify-between {{ $selectedRoleId === $role->id ? 'bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950 border-[#003C58]' : 'bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-50' }}">
                        <div class="truncate">
                            <p class="font-bold text-xs truncate">{{ $role->name }}</p>
                            <p class="text-[10px] opacity-75">{{ $role->users_count }} Assigned</p>
                        </div>
                        <x-icon name="solid:chevron-right" class="w-3 h-3 opacity-60 shrink-0" />
                    </button>
                @endforeach
            </div>

            <!-- Granular Permissions Matrix -->
            <div class="lg:col-span-9 space-y-4">
                
                <!-- Super Admin Special Unrestricted Banner -->
                @if($selectedRoleName === 'Super Administrator')
                    <div class="p-6 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-800 dark:text-amber-300 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/20 flex items-center justify-center shrink-0 text-amber-600 dark:text-amber-400">
                            <x-icon name="solid:bolt" class="w-5 h-5" />
                        </div>
                        <div>
                            <h4 class="text-sm font-bold uppercase tracking-wider text-amber-900 dark:text-amber-200">Root Super Administrator Role Active</h4>
                            <p class="text-xs mt-1 text-slate-600 dark:text-slate-300 leading-relaxed">
                                The <strong>Super Administrator</strong> possesses native, unrestricted root access to every single module, database table, and operation via Laravel's core <code>Gate::before</code> interceptor. You do not need to manually configure permissions for this role.
                            </p>
                        </div>
                    </div>
                @else
                    <!-- Compact 2-Column Permissions Grid -->
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-3.5">
                        @foreach($permissionGroups as $groupName => $perms)
                            <div class="p-3.5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-2xs">
                                
                                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-2 mb-2.5">
                                    <h4 class="text-xs font-bold text-slate-800 dark:text-white flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#003C58] dark:bg-cyan-400"></span>
                                        <span>{{ $groupName }}</span>
                                    </h4>
                                    <button type="button" wire:click="toggleAllGroup('{{ $groupName }}')" class="text-[10px] font-bold text-[#003C58] dark:text-cyan-400 hover:underline cursor-pointer">
                                        Toggle All
                                    </button>
                                </div>

                                <!-- Compact Chips/Pills Grid -->
                                <div class="grid grid-cols-2 gap-1.5">
                                    @foreach($perms as $permKey => $permLabel)
                                        <label class="flex items-center gap-2 p-1.5 rounded-lg border border-slate-100 dark:border-slate-800/80 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer select-none">
                                            <input type="checkbox" 
                                                   wire:model="rolePermissions" 
                                                   value="{{ $permKey }}"
                                                   class="w-3.5 h-3.5 rounded border-slate-300 dark:border-slate-700 text-[#003C58] focus:ring-[#003C58]/20" />
                                            <span class="text-[11px] font-medium text-slate-700 dark:text-slate-300 truncate" title="{{ $permKey }}">{{ $permLabel }}</span>
                                        </label>
                                    @endforeach
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

        </div>
    @endif

    <!-- ==================== USER CREATE/EDIT MODAL ==================== -->
    @if($showUserModal)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm" wire:click="$set('showUserModal', false)"></div>
            
            <div class="relative w-full max-w-md rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xl p-6 z-10">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                    <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">
                        {{ $editingUserId ? 'Edit Administrator' : 'Create Administrator' }}
                    </h3>
                    <button wire:click="$set('showUserModal', false)" class="text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
                        <x-icon name="solid:xmark" class="w-4 h-4" />
                    </button>
                </div>

                <form wire:submit="saveUser" class="space-y-3.5 pt-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Full Name</label>
                        <input type="text" wire:model="name" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]" />
                        @error('name') <span class="text-rose-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Email Address</label>
                        <input type="email" wire:model="email" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]" />
                        @error('email') <span class="text-rose-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                            Password {{ $editingUserId ? '(Leave blank to keep unchanged)' : '' }}
                        </label>
                        <input type="password" wire:model="password" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]" />
                        @error('password') <span class="text-rose-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Assigned Role</label>
                        <select wire:model="selectedRole" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58]">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-2">
                        <button type="button" wire:click="$set('showUserModal', false)" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" wire:loading.attr="disabled" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 cursor-pointer disabled:opacity-50 inline-flex items-center justify-center">
                            <span wire:loading.remove wire:target="saveUser" class="inline-flex items-center gap-2 whitespace-nowrap">Save Account</span>
                            <span wire:loading.inline-flex wire:target="saveUser" class="items-center justify-center gap-2 whitespace-nowrap" style="display: none;">
                                <svg class="animate-spin h-3.5 w-3.5 text-current shrink-0" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Saving...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>