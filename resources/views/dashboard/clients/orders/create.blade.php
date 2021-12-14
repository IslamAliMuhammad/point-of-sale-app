@extends('layouts/dashboard/app')

@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('site.home') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.clients.index') }}">{{ __('site.clients') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('site.add_order') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <div class="container">
        <div class="row">
            {{-- categories --}}
            <div class="col-md-6">
                @include('dashboard.clients.orders._products')
            </div>

            {{-- orders --}}
            <div class="col-md-6">
                @include('dashboard.clients.orders._order')
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .required:after {
            content: " *";
            color: red;
        }

    </style>
@endsection

@section('script')
    <script src="{{ asset('js/order.js') }}"></script>
@endsection
