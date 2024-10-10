@extends('layout')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="text-xl font-bold mb-4">{{ __('Login') }}</div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email"
                            class="block text-gray-700 text-sm font-bold mb-2">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password"
                            class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                            name="password" required autocomplete="current-password">
                        @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input class="form-check-input mr-2 leading-tight" type="checkbox" name="remember"
                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="block text-gray-700 text-sm font-bold" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="mb-4">
                        <a href="{{ route('register') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Register') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection