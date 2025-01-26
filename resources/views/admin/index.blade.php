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
        <div class="row m-4">
            <div class="col-md-6">
                <h4>Доходы</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Период</th>
                        <th>Доход</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Общий доход</td>
                        <td>{{ $totalIncome }} ₽</td>
                    </tr>
                    <tr>
                        <td>Доход за {{ now()->year }}</td>
                        <td>{{ $yearIncome }} ₽</td>
                    </tr>
                    @foreach($monthlyIncomes as $month => $income)
                        <tr>
                            <td>{{ $month }}</td>
                            <td>{{ $income }} ₽</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-5">
                <h4>Самые продаваемые</h4>
                <canvas id="topProductsChart"></canvas>
            </div>
        </div>

    </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const topProductsChartCtx = document.getElementById('topProductsChart').getContext('2d');
            const topProducts = @json($topProducts);

            const labels = topProducts.map(product => product.title);
            const data = topProducts.map(product => product.total_quantity);

            new Chart(topProductsChartCtx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Количество продаж',
                        data: data,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                        hoverOffset: 4,
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    },
                },
            });
        });

    </script>
@endsection


