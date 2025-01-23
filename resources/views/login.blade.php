@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
<div class="container mt-5" style="max-width: 300px">
    <form class="position-absolute top-50 start-50 translate-middle" action="{{ route('login.post') }}" method="post">

        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
