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
                        <li class="breadcrumb-item active">{{ __('site.orders') }}</li>
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
            <div class="col-md-8">
                @include('dashboard.orders._orders-list')
            </div>

            {{-- orders --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="h5">{{ __('site.display_products') }}</h3>
                    </div>

                    <div id="order-products">

                        <div class="loader" style="display: none"></div>


                    </div>
                </div>

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

        .center{
            margin: auto;
            width: 50%;
            border: 3px solid green;
            padding: 10px;
        }
        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

    </style>
@endsection

@section('script')
    <script src="{{ asset('js/order.js') }}"></script>
    <script src="{{ asset('js/printThis.js') }}"></script>
@endsection
