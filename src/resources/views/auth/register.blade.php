<x-guest-layout>
    <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-violet-600">JoinFest</p>
    <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Register</h1>
    <p class="mt-2 mb-6 text-sm text-slate-500">Buat akun untuk mulai menemukan dan memesan event di JoinFest.</p>

    @if (session('status'))
        <div class="mb-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="mb-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4" x-data="{ role: 'user' }">
        @csrf

        {{-- Role Selection --}}
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Daftar Sebagai <span class="text-red-600">*</span></label>
            <div class="grid grid-cols-2 gap-3">
                <label class="flex cursor-pointer items-center justify-center gap-2 rounded-xl border border-slate-300 p-3 shadow-sm transition-all has-[:checked]:border-violet-600 has-[:checked]:bg-violet-50">
                    <input type="radio" name="role" value="user" x-model="role" class="h-4 w-4 text-violet-600 focus:ring-violet-500" required>
                    <span class="text-sm font-semibold text-slate-900">Pengguna Umum</span>
                </label>
                <label class="flex cursor-pointer items-center justify-center gap-2 rounded-xl border border-slate-300 p-3 shadow-sm transition-all has-[:checked]:border-violet-600 has-[:checked]:bg-violet-50">
                    <input type="radio" name="role" value="organizer" x-model="role" class="h-4 w-4 text-violet-600 focus:ring-violet-500" required>
                    <span class="text-sm font-semibold text-slate-900">Event Organizer</span>
                </label>
            </div>
        </div>

        <div>
            <label for="name" class="mb-2 block text-sm font-medium text-slate-700">Name <span class="text-red-600">*</span></label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email <span class="text-red-600">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password <span class="text-red-600">*</span></label>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">Confirm Password <span class="text-red-600">*</span></label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15">
        </div>

        {{-- Organizer Fields --}}
        <div x-show="role === 'organizer'" x-cloak x-transition.opacity class="space-y-4 rounded-2xl border border-violet-100 bg-violet-50/50 p-5 mt-6">
            <h3 class="text-lg font-bold text-slate-900">Data Organizer & Pembayaran</h3>
            <p class="text-xs text-slate-500">Informasi ini dibutuhkan untuk verifikasi dan pencairan dana penjualan tiket.</p>

            <div>
                <label for="organization_name" class="mb-2 block text-sm font-medium text-slate-700">Nama Organisasi / EO <span class="text-red-600">*</span></label>
                <input id="organization_name" type="text" name="organization_name" value="{{ old('organization_name') }}" :required="role === 'organizer'" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15" placeholder="Contoh: Bintang Kreasindo">
            </div>

            <div>
                <label for="phone" class="mb-2 block text-sm font-medium text-slate-700">Nomor Telepon / WhatsApp <span class="text-red-600">*</span></label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" :required="role === 'organizer'" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15" placeholder="0812xxxxxx">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 sm:col-span-1">
                    <label for="bank_name" class="mb-2 block text-sm font-medium text-slate-700">Nama Bank <span class="text-red-600">*</span></label>
                    <input id="bank_name" type="text" name="bank_name" value="{{ old('bank_name') }}" :required="role === 'organizer'" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15" placeholder="BCA / Mandiri / BNI">
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="bank_account_number" class="mb-2 block text-sm font-medium text-slate-700">Nomor Rekening <span class="text-red-600">*</span></label>
                    <input id="bank_account_number" type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" :required="role === 'organizer'" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15" placeholder="Nomor rekening valid">
                </div>
            </div>

            <div>
                <label for="bank_account_name" class="mb-2 block text-sm font-medium text-slate-700">Nama Pemilik Rekening <span class="text-red-600">*</span></label>
                <input id="bank_account_name" type="text" name="bank_account_name" value="{{ old('bank_account_name') }}" :required="role === 'organizer'" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/15" placeholder="Sesuai buku tabungan">
            </div>
        </div>

        <button type="submit" class="mt-6 inline-flex h-12 w-full items-center justify-center rounded-xl bg-gradient-to-r from-violet-600 to-violet-500 px-4 text-sm font-semibold text-white shadow-[0_12px_20px_rgba(109,40,217,0.25)] transition hover:-translate-y-0.5 hover:shadow-[0_16px_24px_rgba(109,40,217,0.3)]">Create account</button>
    </form>

    <p class="mt-4 text-center text-sm text-slate-500">
        Already registered?
        <a class="font-semibold text-violet-600 transition hover:text-violet-700" href="{{ route('login') }}">Login</a>
    </p>
</x-guest-layout>
