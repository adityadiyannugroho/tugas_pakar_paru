@extends('layouts.app')

@section('body.class', 'hold-transition layout-top-nav')

@section('content')
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a href="/home" class="navbar-brand">
                <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
            </a>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <x-nav-link :href="url('/home')">
                            Beranda
                        </x-nav-link>
                    </li>
                    @admin
                        <li class="nav-item">
                            <x-nav-link :href="url('/diagnose')">
                                Diagnosis
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="url('/disease')">
                                Penyakit
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="url('/symptom')">
                                Gejala
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="url('/disease-symptom')">
                                Daftar Hubungan
                            </x-nav-link>
                        </li>
                    @endadmin
                </ul>
            </div>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <form action="/logout" method="post">
                        @csrf
                        <button class="btn btn-link nav-link">
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-3">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2 justify-content-center">
                    <div class="@yield('header.title.class', 'col-sm-12')">
                        <h1 class="m-0 text-dark">@yield('header.title')</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            @yield('dashboard.content')
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
@endsection
