<x-guest-layout>
    <div class="text-center">
        <p class="mb-1 text-xs font-bold uppercase tracking-widest text-violet-600">JoinFest</p>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Verify Email</h1>
        <p class="mt-2 text-sm text-slate-500">Thanks for signing up. Please click the verification link we sent to your email.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 flex items-center gap-2">
            <x-heroicon-s-check-circle class="w-5 h-5" />
            <span>A new verification link has been sent to your email.</span>
        </div>
    @endif

    <div class="mt-8 space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="group relative flex w-full justify-center rounded-xl bg-violet-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition-all disabled:opacity-50">
                Resend Verification Email
                <x-heroicon-s-paper-airplane class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1" />
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full justify-center rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-200 transition-all">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
