@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-sm md:max-w-md lg:max-w-lg rounded-xl overflow-hidden lg:shadow-lg lg:border mx-auto mt-10 pt-2 pb-5 bg-white">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-6 text-center">{{ __('Reset Password') }}</div>

            @if (session('status'))
                <div class="p-4 bg-green-200 text-teal-900 rounded-lg mb-6" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <label class="block mb-3">
                    <span class="block text-gray-700 text-sm font-bold mb-2"> {{ __('E-Mail Address') }} </span>
                    <input id="email" type="email" class="form-input mt-1 block w-full @error('email') border-red-600 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>

                <button type="submit" class="block w-full bg-secondary hover:bg-secondary-dark text-white font-bold py-2 px-4 rounded-full mt-5">
                    {{ __('Send Password Reset Link') }}
                </button>

            </form>
        </div>
    </div>
</div>
@endsection
