@extends('admin.layouts.app')

@section('title', 'Все товары')

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

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Категория</th>
                                <th>Название</th>
                                <th>Ед.</th>
                                <th>Количество</th>
                                <th>Цена</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr class="align-middle">
                                <td>{{ $product->category->title }}</td>
                                <td>{{ $product->title }}</td>
                                <td>@if($product->unit)
                                        {{ $product->unit }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>@if($product->quantity)
                                        {{ $product->quantity }}
                                    @else
                                        -
                                    @endif</td>
                                <td>{{ $product->sale_price }}</td>
                                <td>
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                          method="product">
                                        @csrf
                                        @method('DELETE')
                                        <a
                                            href="{{ route('products.destroy', ['product' => $product->id]) }}"
                                             onclick="return confirm('Удалить?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </form>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endsection

