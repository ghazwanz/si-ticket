<x-guest-layout>
    <div class="text-center">
        <p class="mb-1 text-xs font-bold uppercase tracking-widest text-violet-600">JoinFest</p>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Buat Akun</h1>
        <p class="mt-2 text-sm text-slate-500">Daftar untuk menemukan dan memesan event.</p>
    </div>

    @if (session('status'))
        <div class="mt-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 flex items-center gap-2">
            <x-heroicon-s-check-circle class="w-5 h-5" />
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <div class="flex items-center gap-2 font-semibold mb-2">
                <x-heroicon-s-exclamation-circle class="w-5 h-5 text-red-500" />
                <span>Ada kesalahan pada pengisian formulir</span>
            </div>
            <ul class="list-disc list-inside pl-7">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5" x-data="{ role: 'user' }">
        @csrf

        {{-- Role Selection --}}
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Saya mendaftar sebagai <span class="text-red-500">*</span></label>
            <div class="grid grid-cols-2 gap-3">
                <label class="flex cursor-pointer items-center justify-center gap-2 rounded-xl border p-3 shadow-sm transition-all" :class="role === 'user' ? 'border-violet-600 bg-violet-50 text-violet-900' : 'border-slate-300 hover:bg-slate-50 text-slate-700'">
                    <input type="radio" name="role" value="user" x-model="role" class="sr-only" required>
                    <x-heroicon-o-user class="w-5 h-5" />
                    <span class="text-sm font-semibold">Pengguna</span>
                </label>
                <label class="flex cursor-pointer items-center justify-center gap-2 rounded-xl border p-3 shadow-sm transition-all" :class="role === 'organizer' ? 'border-violet-600 bg-violet-50 text-violet-900' : 'border-slate-300 hover:bg-slate-50 text-slate-700'">
                    <input type="radio" name="role" value="organizer" x-model="role" class="sr-only" required>
                    <x-heroicon-o-building-storefront class="w-5 h-5" />
                    <span class="text-sm font-semibold">Penyelenggara</span>
                </label>
            </div>
        </div>

        <div>
            <label for="name" class="mb-2 block text-sm font-medium text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-o-identification class="h-5 w-5 text-slate-400" />
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow" placeholder="John Doe">
            </div>
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Alamat Email<span class="text-red-500">*</span></label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-o-envelope class="h-5 w-5 text-slate-400" />
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow" placeholder="you@example.com">
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <x-heroicon-o-lock-closed class="h-5 w-5 text-slate-400" />
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="new-password" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow">
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">Konfirmasi Password <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <x-heroicon-o-lock-closed class="h-5 w-5 text-slate-400" />
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow">
                </div>
            </div>
        </div>

        {{-- Organizer Fields --}}
        <div x-show="role === 'organizer'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-5 rounded-2xl border border-violet-100 bg-violet-50/50 p-5 mt-6">
            <div class="pb-2 border-b border-violet-100">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <x-heroicon-s-building-office-2 class="h-4 w-4 text-violet-500" />
                    Data Penyelenggara & Pembayaran
                </h3>
                <p class="text-xs text-slate-500 mt-1">Wajib diisi untuk verifikasi dan pencairan dana tiket.</p>
            </div>

            <div>
                <label for="organization_name" class="mb-2 block text-sm font-medium text-slate-700">Nama Penyelenggara <span class="text-red-500">*</span></label>
                <input id="organization_name" type="text" name="organization_name" value="{{ old('organization_name') }}" :required="role === 'organizer'" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 px-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow" placeholder="e.g. Bintang Kreasindo">
            </div>

            <div>
                <label for="phone" class="mb-2 block text-sm font-medium text-slate-700">WhatsApp / Phone <span class="text-red-500">*</span></label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" :required="role === 'organizer'" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 px-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow" placeholder="0812xxxxxx">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 sm:col-span-1">
                    <label for="bank_name" class="mb-2 block text-sm font-medium text-slate-700">Nama Bank <span class="text-red-500">*</span></label>
                    <input id="bank_name" type="text" name="bank_name" value="{{ old('bank_name') }}" :required="role === 'organizer'" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 px-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow" placeholder="BCA / Mandiri / BNI">
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="bank_account_number" class="mb-2 block text-sm font-medium text-slate-700">Nomor Rekening <span class="text-red-500">*</span></label>
                    <input id="bank_account_number" type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" :required="role === 'organizer'" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 px-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow" placeholder="e.g. 1234567890">
                </div>
            </div>

            <div>
                <label for="bank_account_name" class="mb-2 block text-sm font-medium text-slate-700">Nama Pemilik Rekening <span class="text-red-500">*</span></label>
                <input id="bank_account_name" type="text" name="bank_account_name" value="{{ old('bank_account_name') }}" :required="role === 'organizer'" class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 px-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-shadow" placeholder="As it appears on the bank account">
            </div>
        </div>

        <button type="submit" class="group relative flex w-full justify-center mt-6 rounded-xl bg-violet-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition-all disabled:opacity-50">
            Buat Akun
            <x-heroicon-s-arrow-right class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1" />
        </button>
    </form>

    <p class="mt-8 text-center text-sm text-slate-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-violet-600 hover:text-violet-700 transition-colors">Masuk</a>
    </p>
</x-guest-layout>
