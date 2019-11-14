@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="max-w-sm md:max-w-md lg:max-w-lg rounded-xl overflow-hidden lg:shadow-lg lg:border mx-auto mt-10 pt-2 pb-5 bg-white">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-6 text-center"> {{ __('Verify Your Email Address') }} </div>

            <div class="card-body">
                @if (session('resent'))
                    <div class="p-4 bg-green-200 text-teal-900 rounded-lg mb-6" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="d-inline text-teal-700" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
