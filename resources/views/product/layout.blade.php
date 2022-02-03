<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/product.css">
    <script src="/js/product.js" defer></script>
</head>
<body>
    <header>
    @include('product.header')
    </header>
    <br>
    <div class="container">
   @yield('content')
</div>
    </div>
    <footer class="footer bg-dark  fixed-bottom">
    @include('product.footer')
    </footer>
</body>
</html>