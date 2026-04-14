<x-guest-layout>
    <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-violet-600">JoinFest</p>
    <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Confirm</h1>

    <p class="mt-2 mb-6 text-sm text-slate-500">
        This is a secure area. Please enter your password to continue.
    </p>

    @if ($errors->any())
        <div class="mb-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password <span class="text-red-600">*</span></label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
        </div>

        <button type="submit" class="inline-flex h-12 w-full items-center justify-center rounded-xl bg-gradient-to-r from-violet-600 to-violet-500 px-4 text-sm font-semibold text-white shadow-[0_12px_20px_rgba(109,40,217,0.25)] transition hover:-translate-y-0.5 hover:shadow-[0_16px_24px_rgba(109,40,217,0.3)]">Confirm password</button>
    </form>
</x-guest-layout>
