<!doctype html>
<html lang="{{ env('APP_LOCALE') }}" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Главная страница')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous">
</head>

<body>

@if(!request()->routeIs('login'))
    <header>
        <!-- Общий хедер -->
        <nav>
            <a href="/">Главная</a>
            <a href="/about">О нас</a>
        </nav>
    </header>
@endif

<main>

@yield('content')

</main>

@if(!request()->routeIs('login'))
    <footer class="app-footer"> <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div> <!--end::To the end--> <!--begin::Copyright-->
        <strong>
            Copyright &copy; {{ date('Y') }}
            <a href="#" class="text-decoration-none">{{ env('APP_NAME') }}</a>.
        </strong>
        <!--end::Copyright-->
    </footer>
    <!--end::Footer-->
@endif
</body>
</html>
