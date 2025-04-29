<x-guest-layout>
    <style>
        body {
            background-color: rgb(251, 248, 238);
        }

        .container-center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .register {
            width: 420px;
            position: relative;
            border-radius: 10px;
            border: 1px solid #6e5d32;
            background-color: rgb(251, 248, 238);
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logo {
            position: absolute;
            top: 15px;
            left: 15px;
            width: 50px;
            height: auto;
        }

        h1 {
            color: #6e5d32;
            font-size: 24px;
            text-align: center;
            margin-top: 60px;
            margin-bottom: 25px;
        }

        .register input {
            width: 100%;
            height: 35px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #6e5d32;
            padding-left: 10px;
            background-color: rgb(250, 250, 247);
            color: #6e5d32;
        }

        .register button {
            width: 100%;
            height: 35px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #6e5d32;
            background-color: #6e5d32;
            color: white;
            cursor: pointer;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>

    <div class="container-center">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="register">
                <img class="logo" src="{{ asset('images/Black and Gold Vintage Luxury Hotel Logo.png') }}" alt="Logo">

                <h1>Welcome To Our Palace</h1>

                <x-validation-errors class="error" />

                <label for="name">Username</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">

                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">

                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">

                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />
                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <button type="submit">Sign Up</button>

                <div class="login-link">
                    <a href="{{ route('login') }}">Already registered? Login</a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
