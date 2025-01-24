@extends('admin.layouts.app')

@section('title', 'Остатки')

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

                <div class="card mb-4">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Название продукта</th>
                                <th>Остаток</th>
                                <th>Единица измерения</th>
                                <th>Цена продажи</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->unit }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Нет данных</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection

