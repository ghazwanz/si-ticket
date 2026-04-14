<x-guest-layout>
    <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-violet-600">JoinFest</p>
    <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Verify Email</h1>

    <p class="mt-2 mb-6 text-sm text-slate-500">
        Thanks for signing up. Please click the verification link we sent to your email.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">A new verification link has been sent to your email.</div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="inline-flex h-12 w-full items-center justify-center rounded-xl bg-gradient-to-r from-violet-600 to-violet-500 px-4 text-sm font-semibold text-white shadow-[0_12px_20px_rgba(109,40,217,0.25)] transition hover:-translate-y-0.5 hover:shadow-[0_16px_24px_rgba(109,40,217,0.3)]">Resend verification email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3">
        @csrf
        <button type="submit" class="inline-flex h-12 w-full items-center justify-center rounded-xl border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Log out</button>
    </form>
</x-guest-layout>
