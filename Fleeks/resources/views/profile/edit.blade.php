<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Profile') }}
            </h2>
            <p class="mt-1 text-sm text-white/60">Manage your account information and security.</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="border border-white/15 rounded-2xl overflow-hidden bg-[#0b1220]/40">
                <div class="px-6 py-6 border-b border-white/10">
                    <div class="flex items-center justify-between gap-6">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="h-12 w-12 rounded-full bg-white/10 border border-white/15 flex items-center justify-center text-white/80 font-semibold">
                                {{ strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs uppercase tracking-wider text-white/50">Signed in as</div>
                                <div class="mt-1 text-lg font-semibold text-white truncate">{{ auth()->user()->name }}</div>
                                <div class="text-sm text-white/60 truncate">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <div class="hidden sm:block text-right">
                            <div class="text-xs uppercase tracking-wider text-white/50">Account</div>
                            <div class="mt-1 text-sm text-white/70">Profile & security settings</div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="border border-white/10 rounded-xl bg-white/5">
                            <div class="px-5 py-4 border-b border-white/10">
                                <div class="text-xs uppercase tracking-wider text-white/50">Account</div>
                                <div class="mt-1 text-base font-semibold text-white">Profile information</div>
                            </div>
                            <div class="p-5">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="border border-white/10 rounded-xl bg-white/5">
                                <div class="px-5 py-4 border-b border-white/10">
                                    <div class="text-xs uppercase tracking-wider text-white/50">Security</div>
                                    <div class="mt-1 text-base font-semibold text-white">Password</div>
                                </div>
                                <div class="p-5">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>

                            <div class="border border-red-500/20 rounded-xl bg-red-500/5">
                                <div class="px-5 py-4 border-b border-red-500/20">
                                    <div class="text-xs uppercase tracking-wider text-red-200/70">Danger zone</div>
                                    <div class="mt-1 text-base font-semibold text-white">Delete account</div>
                                </div>
                                <div class="p-5">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
