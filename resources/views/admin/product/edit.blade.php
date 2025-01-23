@extends('admin.layouts.app')

@section('title', "Изменить {$products->title}")

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
                                <a href="#" class="nav-link">
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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $products->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label for="title" class="form-label">Название</label>
                                        <div class="mb-10">
                                            <input name="title" type="text" class="form-control" id="title" value="{{ $products->title }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="quantity" class="form-label">Количество</label>
                                        <div class="mb-10">
                                            <input name="quantity" type="text" class="form-control" id="quantity" value="{{ $products->quantitye }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="purchase_price" class="form-label">Цена закупка</label>
                                        <div class="mb-10">
                                            <input name="purchase_price" type="text" class="form-control" id="purchase_price" value="{{ $products->purchase_price }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="content" class="form-label">Цена продажа</label>
                                        <div class="mb-10">
                                            <input name="sale_price" type="text" class="form-control" id="sale_price" value="{{ $products->sale_price }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4">

                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label for="unit" class="form-label">Ед. измерения</label>
                                        <div class="mb-10">
                                            <input name="unit" type="text" class="form-control" id="unit" value="{{ $products->unit }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Категория</label>
                                        <select name="category_id" class="form-select" id="category_id" required>
                                            @foreach($categories as $categoryId => $categoryTitle)
                                                <option value="{{ $categoryId }}" @selected($products->category_id == $categoryId)>{{ $categoryTitle }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <input type="hidden" id="image" name="image" value="">
                                        <button type="button" class="btn btn-outline-primary popup_selector" data-inputid="image">Добавить обложку</button>
                                        <div class="post-image mt-3"></div>

                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Добавить</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form><!--end::Row--> <!--begin::Row-->

            </div>
        </div>
@endsection

