<div x-data="{
        isOpen: false,
        title: 'Confirm Action',
        message: 'Are you sure you want to proceed? This action cannot be undone.',
        type: 'danger',
        confirmButtonText: 'Yes, Proceed',
        cancelButtonText: 'Cancel',
        targetMethod: null,
        targetParams: [],

        openModal(detail) {
            this.title = detail.title || 'Confirm Action';
            this.message = detail.message || 'Are you sure you want to proceed?';
            this.type = detail.type || 'danger';
            this.confirmButtonText = detail.confirmButtonText || 'Confirm';
            this.cancelButtonText = detail.cancelButtonText || 'Cancel';
            this.targetMethod = detail.method || null;
            this.targetParams = detail.params || [];
            this.isOpen = true;
        },

        executeAction() {
            if (this.targetMethod && window.Livewire) {
                const components = window.Livewire.all();
                components.forEach(component => {
                    // Livewire 3: methods exist under $wire
                    if (component.$wire && typeof component.$wire[this.targetMethod] === 'function') {
                        component.$wire[this.targetMethod](...this.targetParams);
                    }
                });
            }
            this.closeModal();
        },

        closeModal() {
            this.isOpen = false;
        }
     }"
     @open-confirm-dialog.window="openModal($event.detail)"
     @keydown.escape.window="closeModal()"
     class="relative z-[10000]"
     style="display: none;"
     x-show="isOpen">

    <!-- Backdrop -->
    <div x-show="isOpen"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="closeModal()"
         class="fixed inset-0 bg-slate-950/75 backdrop-blur-sm transition-opacity"></div>

    <!-- Dialog Box -->
    <div class="fixed inset-0 z-10 overflow-y-auto p-4 flex items-center justify-center">
        <div x-show="isOpen"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
             @click.outside="closeModal()"
             class="w-full max-w-md rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xl p-6 relative overflow-hidden">
            
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0"
                     :class="{
                         'bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/20': type === 'danger',
                         'bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20': type === 'warning',
                         'bg-[#013d5a]/10 text-[#013d5a] dark:text-cyan-400 border border-[#013d5a]/20': type === 'info'
                     }">
                    
                    <template x-if="type === 'danger'">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </template>
                    <template x-if="type !== 'danger'">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </template>
                </div>

                <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white" x-text="title"></h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed" x-text="message"></p>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-end gap-2.5">
                <button type="button" 
                        @click="closeModal()" 
                        class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                    <span x-text="cancelButtonText"></span>
                </button>

                <button type="button" 
                        @click="executeAction()" 
                        :class="{
                            'bg-rose-600 hover:bg-rose-500 text-white shadow-rose-500/20': type === 'danger',
                            'bg-amber-600 hover:bg-amber-500 text-white shadow-amber-500/20': type === 'warning',
                            'bg-[#013d5a] hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 text-white': type === 'info'
                        }"
                        class="px-4 py-2 rounded-xl text-xs font-bold shadow-sm transition-all active:scale-95 cursor-pointer flex items-center gap-1.5">
                    <span x-text="confirmButtonText"></span>
                </button>
            </div>

        </div>
    </div>
</div>