<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>shopping demo</title>

        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

        <script src="{{ asset('js/jquery-1.12.3.min.js') }}"></script>
    </head>
    <body>
        
    <header class="shadow-sm mb-5">
        <nav class="d-flex justify-content-end align-items-center">
            <a href="{{ route('products') }}" class="px-3 py-2">商品頁面</a>
            @if (!Auth::guard('member')->check())
                <a href="{{ route('login') }}" class="px-3 py-2">登入</a>
            @else
                <a href="{{ route('logout') }}" class="px-3 py-2">登出</a>
            @endif
            
            <a href="{{ route('cart') }}" class="px-3 py-2">購物車</a>
        </nav>
    </header>