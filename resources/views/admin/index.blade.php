@extends('admin.layouts.app')

@section('title', 'Статистика')

@section('nav')
    <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Start Navbar Links-->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        @yield('title')
                    </a>
                </li>
            </ul>
            <!--end::Start Navbar Links-->
            <!--begin::End Navbar Links-->
            <ul class="navbar-nav ms-auto">
                <!--begin::Fullscreen Toggle-->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                        <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                        <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;">
                        </i>
                    </a>
                </li>
                <!--end::Fullscreen Toggle-->
                <!--begin::Exit-->
                <li class="nav-item dropdown user-menu">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <span class="d-none d-md-inline">Выйти</span>
                    </a>
                </li>
                <!--end::User Menu Dropdown-->
            </ul>
            <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
    </nav>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Карточки с итогами -->
        <div class="row mt-4">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success text-black">
                    <div class="inner">
                        <h3>{{ $totalSales }}</h3>
                        <p>Доход (₽)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-ruble-sign"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger text-black">
                    <div class="inner">
                        <h3>{{ $totalExpenses }}</h3>
                        <p>Расходы (₽)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 text-black">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $profit }}</h3>
                        <p>Прибыль (₽)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info text-black">
                    <div class="inner">
                        <h3>{{ $totalProducts }}</h3>
                        <p>Остатки на складе</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div>

            <!-- Графики -->
            <!-- Доходы и расходы -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Доходы и Расходы</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="incomeExpenseChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Топ продаваемых товаров -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Топ продаваемых товаров</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Доходы и расходы
            const incomeExpenseCtx = document.getElementById('incomeExpenseChart').getContext('2d');
            new Chart(incomeExpenseCtx, {
                type: 'line',
                data: {
                    labels: @json($incomeExpenseLabels), // Даты
                    datasets: [
                        {
                            label: 'Доходы',
                            data: @json($incomeData), // Массив доходов
                            borderColor: 'rgba(40, 167, 69, 1)',
                            backgroundColor: 'rgba(40, 167, 69, 0.2)',
                            fill: true,
                        },
                        {
                            label: 'Расходы',
                            data: @json($expenseData), // Массив расходов
                            borderColor: 'rgba(220, 53, 69, 1)',
                            backgroundColor: 'rgba(220, 53, 69, 0.2)',
                            fill: true,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });

            // Топ продаваемых товаров
            const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
            new Chart(topProductsCtx, {
                type: 'pie',
                data: {
                    labels: @json($topProductsLabels), // Названия товаров
                    datasets: [{
                        data: @json($topProductsData), // Количество продаж
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                        ],
                        hoverOffset: 4,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });
        });
    </script>
@endsection


