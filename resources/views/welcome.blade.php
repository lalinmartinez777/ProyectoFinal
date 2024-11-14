<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* TailwindCSS styles */
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            body {
                font-family: Figtree, ui-sans-serif, system-ui, sans-serif;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                background-color: #f3f4f6;
            }
            .button {
                padding: 10px 20px;
                border-radius: 8px;
                border: 1px solid transparent;
                background-color: #ffffff;
                color: #1f2937;
                font-weight: 500;
                transition: all 0.2s ease;
                text-decoration: none;
                text-align: center;
                width: 100px;
                margin: 0 10px;
            }
            .button:hover {
                color: #111827;
                border-color: #FF2D20;
            }
            .button-container {
                display: flex;
                gap: 10px;
            }
        </style>
    </head>
    <body>
        <div class="button-container">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="button">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="button">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="button">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </body>
</html>
