@extends('admin.layouts.app')

@section('title', 'Добавить приходную накладную')

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

@section('aside')
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
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-cash-stack"></i>
                            <p>Продажа</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-archive"></i>
                            <p>
                                Продукция
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-clipboard2"></i>
                                    <p>Все товары</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.create') }}" class="nav-link">
                                    <i class="nav-icon bi bi-plus-circle"></i>
                                    <p>Добавить товар</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-pencil-square"></i>
                                    <p>Изменить товар</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-box-seam"></i>
                            <p>
                                Склад
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-check-square"></i>
                                    <p>Приход</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('inventory.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Остаток</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-file-earmark-x"></i>
                                    <p>Списание</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <br>
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">
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
@endsection
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">@yield('title')</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}">Главная</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @yield('title')
                        </li>
                    </ol>
                </div>

                <div class="card mb-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success m-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('invoice.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Название продукта</th>
                                    <th>Количество</th>
                                    <th>Закупочная цена</th>
                                    <th>Сумма</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr class="product-row">
                                        <td>
                                            {{ $product->title }}
                                            <input type="hidden" name="products[{{ $product->id }}][product_id]" value="{{ $product->id }}">
                                            <input type="hidden" name="products[{{ $product->id }}][product_title]" value="{{ $product->title }}">
                                        </td>
                                        <td>
                                            <input type="number" name="products[{{ $product->id }}][quantity]" class="form-control quantity" placeholder="Количество" step="1" min="0">
                                        </td>
                                        <td>
                                            <input type="number" name="products[{{ $product->id }}][purchase_price]" class="form-control purchase-price" placeholder="Цена закупки" step="0.01" min="0">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control total-price" readonly value="0">
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- Кнопка отправки формы -->
                        <div class="card-footer clearfix">
                            <button type="submit" class="btn btn-success float-right">Сохранить накладную</button>
                        </div>
                    </form>
                </div> <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const rows = document.querySelectorAll('.product-row');

            // Функция для пересчёта суммы в строке
            rows.forEach(row => {
                const quantityInput = row.querySelector('.quantity');
                const purchasePriceInput = row.querySelector('.purchase-price');
                const totalPriceInput = row.querySelector('.total-price');

                function calculateRowTotal() {
                    const quantity = parseFloat(quantityInput.value) || 0;
                    const purchasePrice = parseFloat(purchasePriceInput.value) || 0;

                    // Рассчитываем сумму для строки
                    const total = quantity * purchasePrice;
                    totalPriceInput.value = total.toFixed(2);
                }

                // Добавляем обработчики для пересчёта строки при изменении данных
                quantityInput.addEventListener('input', calculateRowTotal);
                purchasePriceInput.addEventListener('input', calculateRowTotal);
            });

            // Удаляем строки с пустыми данными перед отправкой формы
            form.addEventListener('submit', function (event) {
                rows.forEach(row => {
                    const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
                    const purchasePrice = parseFloat(row.querySelector('.purchase-price').value) || 0;

                    // Если оба поля пустые, удаляем строку из DOM
                    if (quantity === 0 && purchasePrice === 0) {
                        row.querySelector('.quantity').name = '';
                        row.querySelector('.purchase-price').name = '';
                    }
                });
            });
        });
    </script>
@endsection
