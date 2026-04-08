<x-guest-layout>
    <h2 class="auth-title">Confirm</h2>

    <p style="font-size:13px;color:#666a73;margin-top:0;margin-bottom:14px;">
        This is a secure area. Please enter your password to continue.
    </p>

    @if ($errors->any())
        <div class="auth-errors">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="auth-field">
            <label for="password">Password <span style="color:#b42318">*</span></label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
        </div>

        <button type="submit" class="btn btn-dark">Confirm password</button>
    </form>
</x-guest-layout>
