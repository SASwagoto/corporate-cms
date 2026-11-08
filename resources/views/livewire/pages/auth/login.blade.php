<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.empty')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen flex items-center justify-center p-6 bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 font-sans selection:bg-[#003C58] selection:text-white">
    
    <div class="w-full max-w-md">
        
        <!-- Official Nordroy Brand Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center mb-3">
                @php
                    $siteLogoLight = \App\Models\Setting::get('site_logo', 'assets/images/logo.png');
                    $siteLogoDark = \App\Models\Setting::get('site_logo_dark') ?: $siteLogoLight;
                @endphp
                <img src="{{ asset($siteLogoLight) }}" 
                     alt="{{ \App\Models\Setting::get('site_name', 'Nordroy CMS') }}" 
                     class="h-12 w-auto object-contain dark:hidden" />
                <img src="{{ asset($siteLogoDark) }}" 
                     alt="{{ \App\Models\Setting::get('site_name', 'Nordroy CMS') }}" 
                     class="h-12 w-auto object-contain hidden dark:block" />
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Enterprise Management Platform</p>
        </div>

        <!-- Auth Card -->
        <div class="p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none">
            
            <div class="mb-6">
                <h2 class="text-base font-bold text-slate-900 dark:text-white">Authorized Access</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Sign in to manage corporate services & operations.</p>
            </div>

            <!-- Session Alert -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form with Alpine Submitting Lock -->
            <form wire:submit="login" 
                  x-data="{ isSubmitting: false }" 
                  @submit="isSubmitting = true" 
                  class="space-y-4">
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email address</label>
                    <input wire:model="form.email" id="email" type="email" required autofocus
                        placeholder="admin@corporate.test"
                        class="w-full px-3.5 py-2.5 rounded-xl text-sm bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#003C58]/40 focus:border-[#003C58] transition-all" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-1.5 text-xs text-rose-500" />
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-semibold text-slate-700 dark:text-slate-300">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" wire:navigate class="text-xs text-[#003C58] dark:text-cyan-400 hover:underline">Forgot?</a>
                        @endif
                    </div>
                    <input wire:model="form.password" id="password" type="password" required
                        placeholder="••••••••••••"
                        class="w-full px-3.5 py-2.5 rounded-xl text-sm bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#003C58]/40 focus:border-[#003C58] transition-all" />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-1.5 text-xs text-rose-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center pt-1">
                    <label for="remember" class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="form.remember" id="remember" type="checkbox"
                            class="w-4 h-4 rounded border-slate-300 dark:border-slate-700 text-[#003C58] focus:ring-[#003C58]/30" />
                        <span class="text-xs text-slate-500 dark:text-slate-400">Keep me signed in</span>
                    </label>
                </div>

                <!-- Rock-Solid Non-Flickering Button -->
                <div class="pt-2">
                    <button type="submit"
                        :disabled="isSubmitting"
                        class="w-full h-11 px-4 rounded-xl font-bold text-xs tracking-wider uppercase bg-[#003C58] text-white hover:bg-[#024a6d] dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 shadow-sm active:scale-[0.99] transition-all flex items-center justify-center cursor-pointer disabled:opacity-85 disabled:cursor-wait">
                        
                        <!-- Normal State (Stays hidden once submitted) -->
                        <span x-show="!isSubmitting" class="inline-flex items-center justify-center gap-2 whitespace-nowrap">
                            <span>Sign In</span>
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>

                        <!-- Permanent Loading State during navigation -->
                        <span x-show="isSubmitting" class="inline-flex items-center justify-center gap-2.5 whitespace-nowrap" style="display: none;">
                            <svg class="animate-spin h-4 w-4 shrink-0 text-current" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="tracking-wider">Verifying...</span>
                        </span>
                    </button>
                </div>

            </form>
        </div>

        <!-- Footer Link -->
        <div class="text-center mt-6">
            <a href="/" wire:navigate class="text-xs text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                &larr; Return to public corporate website
            </a>
        </div>

    </div>

</div>