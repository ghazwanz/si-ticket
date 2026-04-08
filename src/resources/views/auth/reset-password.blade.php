<x-guest-layout>
    <h2 class="auth-title">New Password</h2>

    @if ($errors->any())
        <div class="auth-errors">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="auth-field">
            <label for="email">Email <span style="color:#b42318">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
        </div>

        <div class="auth-field">
            <label for="password">New Password <span style="color:#b42318">*</span></label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
        </div>

        <div class="auth-field">
            <label for="password_confirmation">Confirm Password <span style="color:#b42318">*</span></label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-dark">Update password</button>
    </form>
</x-guest-layout>
