@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-sm md:max-w-md lg:max-w-lg rounded-xl overflow-hidden lg:shadow-lg lg:border mx-auto mt-10 pt-2 pb-5 bg-white">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-6 text-center">{{ __('Reset Password') }}</div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <label class="block mb-3">
                    <span class="block text-gray-700 text-sm font-bold mb-2"> {{ __('E-Mail Address') }} </span>
                    <input type="email" class="form-input mt-1 block w-full @error('email') border-red-600 @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>

                <label class="block mb-3">
                    <span class="block text-gray-700 text-sm font-bold mb-2"> {{ __('Password') }} </span>
                    <input id="password" type="password" class="form-input mt-1 block w-full @error('password') border-red-600 @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>

                <label class="block mb-3">
                    <span class="block text-gray-700 text-sm font-bold mb-2"> {{ __('Confirm Password') }} </span>
                    <input id="password-confirm" type="password" class="form-input mt-1 block w-full" name="password_confirmation" required autocomplete="new-password">
                </label>

                <button type="submit" class="block w-full bg-secondary hover:bg-secondary-dark text-white font-bold py-2 px-4 rounded-full mt-5">
                    {{ __('Reset Password') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
