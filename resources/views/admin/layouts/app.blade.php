<!doctype html>
<html lang="{{ env('APP_LOCALE') }}" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Главная страница')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
          crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
          crossorigin="anonymous">

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @yield('nav')

    <aside class="app-sidebar bg-body-secondary shadow">
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a href="{{ route('admin') }}" class="brand-link">
                <!--begin::Brand Text-->
                <span class="brand-text fw-light">{{ env('APP_NAME') }}</span>
                <!--end::Brand Text-->
            </a>
            <!--end::Brand Link-->
        </div>
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <!--begin::Sidebar Menu-->
                <ul class="nav sidebar-menu flex-column">
                    <li class="nav-item">
                        <a href="{{ route('sales.index') }}" class="nav-link{{ request()->routeIs('sales.index') ? ' active' : '' }}">
                            <i class="nav-icon bi bi-cash-stack"></i>
                            <p>Продажа</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav sidebar-menu flex-column" role="menu">

                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link{{ request()->routeIs('products.index') ? ' active' : '' }}">
                            <i class="nav-icon bi bi-archive"></i>
                            <p>Все товары</p>
                        </a>
                    </li>
                    <li class="nav-item ms-3">
                        <a href="{{ route('products.create') }}" class="nav-link{{ request()->routeIs('products.create') ? ' active' : '' }}">
                            <i class="nav-icon bi bi-plus-circle"></i>
                            <p>Добавить товар</p>
                        </a>
                    </li>

                    <li class="nav-item ms-3">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-pencil-square"></i>
                            <p>Изменить товар</p>
                        </a>
                    </li>

                </ul>

                <ul class="nav sidebar-menu flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-box-seam"></i>
                            <p>
                                Склад
                            </p>
                        </a>
                    </li>

                    <li class="nav-item ms-3">
                        <a href="{{ route('invoice.create') }}" class="nav-link{{ request()->routeIs('invoice.create') ? ' active' : '' }}">
                            <i class="nav-icon bi bi-check-square"></i>
                            <p>Приход</p>
                        </a>
                    </li>

                    <li class="nav-item ms-3">
                        <a href="{{ route('inventory.index') }}" class="nav-link{{ request()->routeIs('inventory.index') ? ' active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Остаток</p>
                        </a>
                    </li>

                    <li class="nav-item ms-3">
                        <a href="{{ route('write-off.create') }}" class="nav-link{{ request()->routeIs('write-off.create') ? ' active' : '' }}">
                            <i class="nav-icon bi bi-file-earmark-x"></i>
                            <p>Списание</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav sidebar-menu flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-graph-up"></i>
                            <p>Статистика</p>
                        </a>
                    </li>
                </ul>
                <!--end::Sidebar Menu-->
            </nav>
        </div>
    </aside>

    <main class="app-main">

        @yield('content')

    </main>


    <footer class="app-footer"> <!--begin::To the end-->
        <a href="#" class="text-decoration-none">{{ env('APP_NAME') }}</a>, beta
    </footer>

    <!--end::Footer-->
</div>
<!-- Скрипты футер -->
@yield('js')
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>
<!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        crossorigin="anonymous"></script>
<script>
    // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
    // IT'S ALL JUST JUNK FOR DEMO
    // ++++++++++++++++++++++++++++++++++++++++++

    const visitors_chart_options = {
        series: [{
            name: "High - 2023",
            data: [100, 120, 170, 167, 180, 177, 160],
        },
            {
                name: "Low - 2023",
                data: [60, 80, 70, 67, 80, 77, 100],
            },
        ],
        chart: {
            height: 200,
            type: "line",
            toolbar: {
                show: false,
            },
        },
        colors: ["#0d6efd", "#adb5bd"],
        stroke: {
            curve: "smooth",
        },
        grid: {
            borderColor: "#e7e7e7",
            row: {
                colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                opacity: 0.5,
            },
        },
        legend: {
            show: false,
        },
        markers: {
            size: 1,
        },
        xaxis: {
            categories: ["22th", "23th", "24th", "25th", "26th", "27th", "28th"],
        },
    };

    const visitors_chart = new ApexCharts(
        document.querySelector("#visitors-chart"),
        visitors_chart_options
    );
    visitors_chart.render();

    const sales_chart_options = {
        series: [{
            name: "Net Profit",
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
        },
            {
                name: "Revenue",
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
            },
            {
                name: "Free Cash Flow",
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
            },
        ],
        chart: {
            type: "bar",
            height: 200,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "55%",
                endingShape: "rounded",
            },
        },
        legend: {
            show: false,
        },
        colors: ["#0d6efd", "#20c997", "#ffc107"],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"],
        },
        xaxis: {
            categories: [
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
            ],
        },
        fill: {
            opacity: 1,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands";
                },
            },
        },
    };

    const sales_chart = new ApexCharts(
        document.querySelector("#sales-chart"),
        sales_chart_options
    );
    sales_chart.render();
</script>
<!--end::Script-->
</body>
</html>
