<x-guest-layout>
    <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-violet-600">JoinFest</p>
    <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">New Password</h1>

    @if ($errors->any())
        <div class="mb-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}" class="mt-6 space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email <span class="text-red-600">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-slate-700">New Password <span class="text-red-600">*</span></label>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">Confirm Password <span class="text-red-600">*</span></label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
        </div>

        <button type="submit" class="inline-flex h-12 w-full items-center justify-center rounded-xl bg-gradient-to-r from-violet-600 to-violet-500 px-4 text-sm font-semibold text-white shadow-[0_12px_20px_rgba(109,40,217,0.25)] transition hover:-translate-y-0.5 hover:shadow-[0_16px_24px_rgba(109,40,217,0.3)]">Update password</button>
    </form>
</x-guest-layout>
