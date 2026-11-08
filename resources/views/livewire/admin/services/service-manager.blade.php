<div class="space-y-6">
    <!-- Pickers Included at Root -->
    <x-icon-picker-modal />
    <x-media-picker-modal />

    <!-- Top Executive Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200 dark:border-slate-800">
        <div>
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-[#003C58]/10 dark:bg-cyan-500/10 text-[#003C58] dark:text-cyan-400 flex items-center justify-center">
                    <x-icon name="solid:wrench" class="w-4 h-4" />
                </div>
                <h1 class="text-xl font-bold font-heading text-slate-900 dark:text-white">Services &amp; Precision Overhauls</h1>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#003C58]/10 dark:bg-cyan-500/10 text-[#003C58] dark:text-cyan-400">
                    {{ $stats['total'] }} SERVICES
                </span>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Manage turbocharger overhauls, dynamic balancing rigs, cartridge exchange programs, and 24/7 port emergency squads.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button type="button" 
                    wire:click="createService" 
                    class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm transition-all inline-flex items-center justify-center gap-2 cursor-pointer">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="whitespace-nowrap">Add New Service</span>
            </button>
        </div>
    </div>

    <!-- Flash Alert -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
            <button type="button" @click="show = false" class="text-emerald-500 hover:text-emerald-700 cursor-pointer">
                <x-icon name="solid:xmark" class="w-3.5 h-3.5" />
            </button>
        </div>
    @endif

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400">Total Services</span>
                <div class="text-xl sm:text-2xl font-black font-heading text-slate-900 dark:text-white mt-0.5">{{ $stats['total'] }}</div>
            </div>
            <div class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center justify-center">
                <x-icon name="solid:layer-group" class="w-4 h-4" />
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-mono uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Active Online</span>
                <div class="text-xl sm:text-2xl font-black font-heading text-emerald-600 dark:text-emerald-400 mt-0.5">{{ $stats['active'] }}</div>
            </div>
            <div class="w-9 h-9 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                <x-icon name="solid:circle-check" class="w-4 h-4" />
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-mono uppercase tracking-wider text-cyan-600 dark:text-cyan-400">Featured (Home)</span>
                <div class="text-xl sm:text-2xl font-black font-heading text-cyan-600 dark:text-cyan-400 mt-0.5">{{ $stats['featured'] }}</div>
            </div>
            <div class="w-9 h-9 rounded-xl bg-cyan-50 dark:bg-cyan-950/40 text-cyan-600 dark:text-cyan-400 flex items-center justify-center">
                <x-icon name="solid:star" class="w-4 h-4" />
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400">Draft / Inactive</span>
                <div class="text-xl sm:text-2xl font-black font-heading text-slate-500 dark:text-slate-400 mt-0.5">{{ $stats['inactive'] }}</div>
            </div>
            <div class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center">
                <x-icon name="solid:eye-slash" class="w-4 h-4" />
            </div>
        </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="relative w-full sm:w-80">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Search service title, slug, summary..." 
                   class="w-full pl-9 pr-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500" />
        </div>

        <div class="flex items-center gap-2.5 w-full sm:w-auto">
            <select wire:model.live="statusFilter" 
                    class="px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-[#003C58] cursor-pointer">
                <option value="all">All Statuses</option>
                <option value="active">Active Only</option>
                <option value="inactive">Inactive / Draft</option>
            </select>

            <select wire:model.live="featuredFilter" 
                    class="px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-[#003C58] cursor-pointer">
                <option value="all">All Placements</option>
                <option value="featured">Featured (Homepage)</option>
                <option value="standard">Standard Catalog</option>
            </select>
        </div>
    </div>

    <!-- Services Table List -->
    <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-950/60 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 uppercase tracking-wider font-mono text-[10px]">
                    <tr>
                        <th class="py-3.5 px-4 w-16 text-center">Order</th>
                        <th class="py-3.5 px-4">Service &amp; Vector Icon</th>
                        <th class="py-3.5 px-4 hidden md:table-cell">Short Summary</th>
                        <th class="py-3.5 px-4 text-center">Featured</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    @forelse ($services as $service)
                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-800/40 transition-colors">
                            <!-- Order / Position -->
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <span class="font-mono font-bold text-slate-500 dark:text-slate-400 text-xs w-5 text-center">{{ $service->order }}</span>
                                    <div class="flex flex-col">
                                        <button type="button" 
                                                wire:click="moveUp({{ $service->id }})" 
                                                title="Move service up"
                                                class="text-slate-400 hover:text-slate-700 dark:hover:text-white p-0.5 cursor-pointer">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                        </button>
                                        <button type="button" 
                                                wire:click="moveDown({{ $service->id }})" 
                                                title="Move service down"
                                                class="text-slate-400 hover:text-slate-700 dark:hover:text-white p-0.5 cursor-pointer">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </td>

                            <!-- Icon & Title -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-[#003C58] dark:text-cyan-400 shrink-0 shadow-2xs">
                                        <x-icon :name="$service->icon ?: 'solid:gauge'" class="w-5 h-5" />
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                            <span class="truncate">{{ $service->display_title }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 mt-0.5 font-mono text-[10px] text-slate-400">
                                            <span class="text-slate-500">/{{ $service->slug }}</span>
                                            @if(!empty($service->title['bn']) && $service->title['bn'] !== $service->title['en'])
                                                <span>&bull;</span>
                                                <span class="truncate text-slate-400 font-sans">{{ $service->title['bn'] }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Short Summary -->
                            <td class="py-3.5 px-4 hidden md:table-cell max-w-xs">
                                <p class="line-clamp-2 text-slate-500 dark:text-slate-400 text-xs">
                                    {{ $service->display_summary ?: 'No summary provided.' }}
                                </p>
                            </td>

                            <!-- Featured on Home -->
                            <td class="py-3.5 px-4 text-center">
                                <button type="button" 
                                        wire:click="toggleFeatured({{ $service->id }})" 
                                        class="cursor-pointer inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold transition-all {{ $service->is_featured ? 'bg-cyan-500/10 text-cyan-600 dark:text-cyan-400 border border-cyan-500/20' : 'bg-slate-100 dark:bg-slate-800 text-slate-400 border border-transparent' }}">
                                    <x-icon name="solid:star" class="w-3 h-3 {{ $service->is_featured ? 'text-amber-500' : 'text-slate-300 dark:text-slate-600' }}" />
                                    <span>{{ $service->is_featured ? 'Featured' : 'Standard' }}</span>
                                </button>
                            </td>

                            <!-- Status Active/Inactive -->
                            <td class="py-3.5 px-4 text-center">
                                <button type="button" 
                                        wire:click="toggleActive({{ $service->id }})" 
                                        class="cursor-pointer inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold transition-all {{ $service->is_active ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $service->is_active ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    <span>{{ $service->is_active ? 'Published' : 'Draft' }}</span>
                                </button>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    <button type="button" 
                                            wire:click="editService({{ $service->id }})" 
                                            title="Edit service details"
                                            class="p-1.5 rounded-lg text-slate-500 hover:text-slate-800 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                                        <x-icon name="solid:pen-to-square" class="w-3.5 h-3.5" />
                                    </button>

                                    <button type="button" 
                                            wire:click="duplicateService({{ $service->id }})" 
                                            title="Duplicate service"
                                            class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                                        <x-icon name="solid:clone" class="w-3.5 h-3.5" />
                                    </button>

                                    <button type="button" 
                                            wire:click="confirmDelete({{ $service->id }})" 
                                            title="Delete service"
                                            class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors cursor-pointer">
                                        <x-icon name="solid:trash" class="w-3.5 h-3.5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-3 text-slate-400">
                                    <x-icon name="solid:wrench" class="w-6 h-6" />
                                </div>
                                <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300">No Services Found</h4>
                                <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">No marine overhaul services match your current search or filter criteria.</p>
                                <button type="button" wire:click="createService" class="mt-4 px-4 py-2 rounded-xl text-xs font-bold bg-[#003C58] text-white dark:bg-cyan-500 dark:text-slate-950 cursor-pointer">
                                    Create First Service
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($services->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                {{ $services->links() }}
            </div>
        @endif
    </div>

    <!-- CREATE / EDIT SERVICE MODAL -->
    @if ($isFormModalOpen)
        <div class="fixed inset-0 z-[9990] overflow-y-auto flex items-center justify-center p-4 sm:p-6"
             x-data="{ activeTab: 'general' }">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-950/75 backdrop-blur-sm transition-opacity"
                 wire:click="closeFormModal"></div>

            <!-- Modal Content -->
            <div class="relative w-full max-w-3xl rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden flex flex-col max-h-[90vh] z-10">
                
                <!-- Modal Header -->
                <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white">
                            {{ $editingServiceId ? 'Edit Marine Service' : 'Add New Overhaul Service' }}
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                            Configure technical specifications, dynamic balancing parameters, vector icon, and content.
                        </p>
                    </div>

                    <button type="button" 
                            wire:click="closeFormModal" 
                            class="p-1.5 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer">
                        <x-icon name="solid:xmark" class="w-5 h-5" />
                    </button>
                </div>

                <!-- Modal Form Body -->
                <form wire:submit="saveService" class="flex-1 overflow-y-auto p-6 space-y-6">
                    
                    <!-- Title & Slug Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                Service Title (English) <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   wire:model.live.debounce.400ms="title_en" 
                                   placeholder="e.g. Dynamic Rotor Balancing (100k RPM)" 
                                   class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500" />
                            @error('title_en') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                Service Title (Bengali) <span class="text-slate-400 font-normal">(ঐচ্ছিক)</span>
                            </label>
                            <input type="text" 
                                   wire:model="title_bn" 
                                   placeholder="e.g. ডায়নামিক রটার ব্যালেন্সিং" 
                                   class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500" />
                            @error('title_bn') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                URL Slug <span class="text-rose-500">*</span>
                            </label>
                            <div class="flex items-center">
                                <span class="px-3 py-2 text-xs bg-slate-100 dark:bg-slate-800 text-slate-400 rounded-l-xl border border-r-0 border-slate-200 dark:border-slate-800 font-mono">/services/</span>
                                <input type="text" 
                                       wire:model="slug" 
                                       placeholder="dynamic-rotor-balancing" 
                                       class="flex-1 px-3 py-2 text-xs rounded-r-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white font-mono focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500" />
                            </div>
                            @error('slug') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                Display Order <span class="text-slate-400 font-normal">(Priority)</span>
                            </label>
                            <input type="number" 
                                   wire:model="order" 
                                   min="0"
                                   class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white font-mono focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500" />
                            @error('order') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Icon & Featured Image Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/50 border border-slate-200 dark:border-slate-800">
                        <!-- Vector Icon Picker -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-2">Vector Icon</label>
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-[#003C58] dark:text-cyan-400 shadow-inner shrink-0">
                                    <x-icon :name="$icon ?: 'solid:gauge'" class="w-6 h-6" />
                                </div>
                                <div class="space-y-1">
                                    <span class="font-mono text-[10px] text-slate-500 block truncate max-w-[180px]">{{ $icon ?: 'solid:gauge' }}</span>
                                    <button type="button" 
                                            @click="$dispatch('open-icon-picker', { targetField: 'icon' })"
                                            class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 shadow-2xs transition-colors inline-flex items-center gap-1.5 cursor-pointer">
                                        <x-icon name="solid:palette" class="w-3.5 h-3.5" />
                                        <span>Select Icon</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image Picker -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-2">Featured Image</label>
                            <div class="flex items-center gap-3">
                                <div class="w-16 h-12 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden shrink-0 shadow-inner">
                                    @if ($featured_image_url)
                                        <img src="{{ $featured_image_url }}" alt="Preview" class="w-full h-full object-cover" />
                                    @else
                                        <x-icon name="solid:image" class="w-5 h-5 text-slate-300 dark:text-slate-600" />
                                    @endif
                                </div>
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="$dispatch('open-media-picker', { targetField: 'featured_image' })"
                                                class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 shadow-2xs transition-colors inline-flex items-center gap-1.5 cursor-pointer">
                                            <x-icon name="solid:images" class="w-3.5 h-3.5" />
                                            <span>Browse Media</span>
                                        </button>
                                        @if ($featured_image_id)
                                            <button type="button" 
                                                    wire:click="removeFeaturedImage" 
                                                    class="p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 dark:hover:bg-rose-950/40 rounded-lg cursor-pointer"
                                                    title="Remove Image">
                                                <x-icon name="solid:xmark" class="w-3.5 h-3.5" />
                                            </button>
                                        @endif
                                    </div>
                                    <span class="text-[10px] text-slate-400 block">Optional image for detailed service page.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Short Summary (EN & BN) -->
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                Short Summary (English) <span class="text-slate-400 font-normal">(Used on Cards &amp; Grid)</span>
                            </label>
                            <textarea wire:model="short_summary_en" 
                                      rows="3" 
                                      placeholder="Brief overview of tolerances, equipment used, and marine capability..."
                                      class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500"></textarea>
                            @error('short_summary_en') <span class="text-rose-500 text-[11px] block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                Short Summary (Bengali) <span class="text-slate-400 font-normal">(বাংলা সংক্ষিপ্ত বিবরণ)</span>
                            </label>
                            <textarea wire:model="short_summary_bn" 
                                      rows="2" 
                                      placeholder="সংক্ষিপ্ত সারসংক্ষেপ..."
                                      class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500"></textarea>
                        </div>
                    </div>

                    <!-- Full Technical Content (EN & BN) -->
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                Technical Specifications &amp; Methodology (English)
                            </label>
                            <textarea wire:model="content_en" 
                                      rows="4" 
                                      placeholder="In-depth technical breakdown of procedures, classification approvals, testing protocols..."
                                      class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                Technical Specifications (Bengali) <span class="text-slate-400 font-normal">(ঐচ্ছিক)</span>
                            </label>
                            <textarea wire:model="content_bn" 
                                      rows="3" 
                                      placeholder="বিস্তারিত কারিগরি কার্যপ্রণালী..."
                                      class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#003C58] dark:focus:ring-cyan-500"></textarea>
                        </div>
                    </div>

                    <!-- Toggles: Active & Featured -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <label class="flex items-center gap-3 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950/50 border border-slate-200 dark:border-slate-800 cursor-pointer">
                            <input type="checkbox" wire:model="is_active" class="w-4 h-4 text-[#003C58] dark:text-cyan-500 rounded-md border-slate-300 dark:border-slate-700 focus:ring-0 cursor-pointer" />
                            <div>
                                <span class="text-xs font-bold text-slate-800 dark:text-white block">Active on Portal</span>
                                <span class="text-[10px] text-slate-400 block">Service is visible on public website.</span>
                            </div>
                        </label>

                        <label class="flex items-center gap-3 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950/50 border border-slate-200 dark:border-slate-800 cursor-pointer">
                            <input type="checkbox" wire:model="is_featured" class="w-4 h-4 text-[#003C58] dark:text-cyan-500 rounded-md border-slate-300 dark:border-slate-700 focus:ring-0 cursor-pointer" />
                            <div>
                                <span class="text-xs font-bold text-slate-800 dark:text-white block">Featured on Homepage</span>
                                <span class="text-[10px] text-slate-400 block">Showcase in Section 5 Precision Overhauls grid.</span>
                            </div>
                        </label>
                    </div>

                    <!-- Modal Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <button type="button" 
                                wire:click="closeFormModal" 
                                class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                            Cancel
                        </button>

                        <button type="submit" 
                                wire:loading.attr="disabled"
                                class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm transition-all inline-flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50">
                            <span wire:loading.remove wire:target="saveService" class="inline-flex items-center gap-2 whitespace-nowrap">
                                <x-icon name="solid:check" class="w-4 h-4" />
                                <span>{{ $editingServiceId ? 'Update Service' : 'Save Service' }}</span>
                            </span>
                            <span wire:loading.inline-flex wire:target="saveService" class="items-center justify-center gap-2 whitespace-nowrap" style="display: none;">
                                <svg class="animate-spin h-4 w-4 text-current shrink-0" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Saving Service...</span>
                            </span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    @endif

    <!-- DELETE CONFIRMATION MODAL -->
    @if ($isDeleteModalOpen)
        <div class="fixed inset-0 z-[9995] overflow-y-auto flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-slate-950/75 backdrop-blur-sm transition-opacity"
                 wire:click="closeDeleteModal"></div>

            <div class="relative w-full max-w-md rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xl p-6 text-center space-y-4 z-10">
                <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-500 flex items-center justify-center mx-auto">
                    <x-icon name="solid:triangle-exclamation" class="w-6 h-6" />
                </div>

                <div class="space-y-1">
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Delete Service</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Are you sure you want to permanently delete <strong class="text-slate-900 dark:text-white">"{{ $serviceNameToDelete }}"</strong>? This action cannot be undone.
                    </p>
                </div>

                <div class="flex items-center justify-center gap-3 pt-2">
                    <button type="button" 
                            wire:click="closeDeleteModal" 
                            class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                        Cancel
                    </button>

                    <button type="button" 
                            wire:click="deleteService" 
                            wire:loading.attr="disabled"
                            class="px-4 py-2 rounded-xl text-xs font-bold bg-rose-600 hover:bg-rose-700 text-white shadow-xs transition-colors inline-flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50">
                        <span wire:loading.remove wire:target="deleteService" class="inline-flex items-center gap-1.5 whitespace-nowrap">
                            <x-icon name="solid:trash" class="w-3.5 h-3.5" />
                            <span>Confirm Delete</span>
                        </span>
                        <span wire:loading.inline-flex wire:target="deleteService" class="items-center justify-center gap-1.5 whitespace-nowrap" style="display: none;">
                            <svg class="animate-spin h-3.5 w-3.5 text-current shrink-0" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Deleting...</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
