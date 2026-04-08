<x-guest-layout>
    <h2 class="auth-title">Verify Email</h2>

    <p style="font-size:13px;color:#666a73;margin-top:0;margin-bottom:14px;">
        Thanks for signing up. Please click the verification link we sent to your email.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="auth-status">A new verification link has been sent to your email.</div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-dark">Resend verification email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" style="margin-top:10px;">
        @csrf
        <button type="submit" class="btn btn-light">Log out</button>
    </form>
</x-guest-layout>
