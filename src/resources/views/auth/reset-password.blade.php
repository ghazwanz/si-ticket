<x-guest-layout>
    <div class="text-center">
        <p class="mb-1 text-xs font-bold uppercase tracking-widest text-violet-600">JoinFest</p>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">New Password</h1>
        <p class="mt-2 text-sm text-slate-500">Pick a strong password that you haven't used before.</p>
    </div>

    @if ($errors->any())
        <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <div class="flex items-center gap-2 font-semibold mb-2">
                <x-heroicon-s-exclamation-circle class="w-5 h-5 text-red-500" />
                <span>There were errors with your submission</span>
            </div>
            <ul class="list-disc list-inside pl-7">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}" class="mt-8 space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email Address <span class="text-red-500">*</span></label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-o-envelope class="h-5 w-5 text-slate-400" />
                </div>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow" placeholder="you@example.com">
            </div>
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-slate-700">New Password <span class="text-red-500">*</span></label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-o-lock-closed class="h-5 w-5 text-slate-400" />
                </div>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow">
            </div>
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">Confirm Password <span class="text-red-500">*</span></label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-o-lock-closed class="h-5 w-5 text-slate-400" />
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow">
            </div>
        </div>

        <button type="submit" class="group relative flex w-full justify-center mt-6 rounded-xl bg-violet-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition-all disabled:opacity-50">
            Update Password
            <x-heroicon-s-arrow-right class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1" />
        </button>
    </form>
</x-guest-layout>
