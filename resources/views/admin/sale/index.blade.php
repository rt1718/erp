@extends('admin.layouts.app')

@section('title', 'Продажа')

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

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <!-- Заголовок страницы -->
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
            </div>

            <div class="row mt-4">
                <!-- Уведомления -->
                <div class="col-12">
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
                </div>
            </div>

            <div class="row mt-4">
                <!-- Список категорий -->
                <div class="col-md-3 mb-3">
                    <h4>Категории</h4>
                    <ul class="list-group">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                <a href="#" class="category-link text-decoration-none text-body"
                                   data-category-id="{{ $category->id }}">
                                    {{ $category->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Список товаров -->
                <div class="col-md-5 mb-3">
                    <h4>Товары</h4>
                    <ul class="list-group product-list">
                        @foreach($products as $product)
                            <li class="list-group-item product-item list-unstyled"
                                data-product-id="{{ $product->id }}"
                                data-product-title="{{ $product->title }}"
                                data-product-price="{{ $product->sale_price }}"
                                data-category-id="{{ $product->category_id }}">
                                {{ $product->title }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Корзина -->
                <div class="col-md-4 mb-3">
                    <h4>Корзина</h4>
                    <form id="sale-form" action="{{ route('sales.store') }}" method="POST">
                        @csrf
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Сумма</th>
                                <th>Удалить</th>
                            </tr>
                            </thead>
                            <tbody id="cart">
                            <!-- Товары в корзине добавляются сюда -->
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary w-100">Продать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoryLinks = document.querySelectorAll('.category-link');
            const productItems = document.querySelectorAll('.product-item');
            const cart = document.getElementById('cart');

            // Итоговая сумма корзины
            const totalElement = document.createElement('div');
            totalElement.classList.add('mt-3', 'fw-bold');
            totalElement.textContent = 'Итоговая сумма: 0';
            cart.parentNode.appendChild(totalElement);

            // Функция пересчёта итоговой суммы корзины
            function calculateTotal() {
                let total = 0;
                const rows = cart.querySelectorAll('tr');
                rows.forEach(row => {
                    const price = parseFloat(row.querySelector('input[name$="[price]"]').value) || 0;
                    const quantity = parseFloat(row.querySelector('input[name$="[quantity]"]').value) || 0;
                    const rowTotalInput = row.querySelector('.row-total-input');

                    // Пересчитываем итоговую сумму для строки
                    const rowTotal = price * quantity;
                    rowTotalInput.value = rowTotal.toFixed(2);

                    // Добавляем к общей сумме корзины
                    total += rowTotal;
                });
                totalElement.textContent = `Итоговая сумма: ${total.toFixed(2)}`;
            }

            // Функция добавления товара в корзину
            function addToCart(event) {
                const productId = this.dataset.productId;
                const productTitle = this.dataset.productTitle;
                const productPrice = parseFloat(this.dataset.productPrice);

                // Проверка на дублирование
                const existingRow = cart.querySelector(`[data-product-id="${productId}"]`);
                if (existingRow) {
                    const quantityInput = existingRow.querySelector('input[name$="[quantity]"]');
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                    calculateTotal();
                    return;
                }

                const row = document.createElement('tr');
                row.dataset.productId = productId;

                row.innerHTML = `
            <td>
                ${productTitle}
                <input type="hidden" name="products[${productId}][product_id]" value="${productId}">
                <input type="hidden" name="products[${productId}][product_title]" value="${productTitle}">
            </td>
            <td>
                <input type="number" name="products[${productId}][price]" class="form-control price-input" value="${productPrice}" step="0.01">
            </td>
            <td>
                <input type="number" name="products[${productId}][quantity]" class="form-control quantity-input" value="1" min="1" step="1">
            </td>
            <td>
                <input type="number" name="products[${productId}][total_price]" class="form-control row-total-input" value="${productPrice}" step="0.01">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-item">×</button>
            </td>
        `;

                // Обработчики событий для пересчёта при изменении данных
                const priceInput = row.querySelector('.price-input');
                const quantityInput = row.querySelector('.quantity-input');
                const rowTotalInput = row.querySelector('.row-total-input');

                // Пересчёт при изменении количества или цены
                const debounce = (func, delay = 1000) => {
                    let timeout;
                    return (...args) => {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => func(...args), delay);
                    };
                };

                const calculateRowTotal = debounce(() => {
                    const quantity = parseFloat(quantityInput.value) || 0;
                    const price = parseFloat(priceInput.value) || 0;

                    rowTotalInput.value = (quantity * price).toFixed(2);
                    calculateTotal();
                });

                const calculatePriceFromTotal = debounce(() => {
                    const quantity = parseFloat(quantityInput.value) || 1; // Защита от деления на 0
                    const rowTotal = parseFloat(rowTotalInput.value) || 0;

                    priceInput.value = (rowTotal / quantity).toFixed(2);
                    calculateTotal();
                });

                quantityInput.addEventListener('input', calculateRowTotal);
                priceInput.addEventListener('input', calculateRowTotal);
                rowTotalInput.addEventListener('input', calculatePriceFromTotal);

                // Удаление строки
                row.querySelector('.remove-item').addEventListener('click', function () {
                    row.remove();
                    calculateTotal();
                });

                cart.appendChild(row);
                calculateTotal();
            }

            // Назначаем обработчики клика для каждого товара
            productItems.forEach(item => {
                item.addEventListener('click', addToCart);
            });
        });

    </script>
@endsection
