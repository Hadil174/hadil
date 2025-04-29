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

        .login-box {
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

        .login-box input {
            width: 100%;
            height: 35px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #6e5d32;
            padding-left: 10px;
            background-color: rgb(250, 250, 247);
            color: #6e5d32;
        }

        .login-box button {
            width: 100%;
            height: 35px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #6e5d32;
            background-color: #6e5d32;
            color: white;
            cursor: pointer;
        }

        .login-box p {
            text-align: center;
            margin-top: 10px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>

    <div class="container-center">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="login-box">
                <img class="logo" src="{{ asset('images/Black and Gold Vintage Luxury Hotel Logo.png') }}" alt="Logo">
                
                <h1>Login</h1>

                <x-validation-errors class="error" />

                @if (session('error'))
                    <div class="error">{{ session('error') }}</div>
                @endif

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email" value="{{ old('email') }}">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">

                <button type="submit">Login</button>

                <p>
                    <a href="{{ route('register') }}">Don't have an account? Sign Up</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
