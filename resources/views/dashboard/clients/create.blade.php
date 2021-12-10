@extends('layouts/dashboard/app')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('site.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.clients.index') }}">{{ __('site.clients') }}</a></li>
            <li class="breadcrumb-item active">{{ __('site.create_client') }}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title float-left h5">{{ __('site.create_client') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('dashboard.clients.store') }}" enctype="multipart/form-data">

            @csrf
            @method('POST')

            <div class="card-body">
                <div class="form-group">
                    <label for="nameInput" class="required">{{ __('site.name') }}</label>
                    <input type="text" class="form-control" id="nameInput" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="alert alert-danger">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phoneInput1" class="required">{{ __('site.phone') . ' 1' }}</label>
                    <input type="text" class="form-control" id="phoneInput1" name="phone[]" value="{{ old('phone.0') }}" required>
                    @error('phone.0')
                        <div class="alert alert-danger">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phoneInput2">{{ __('site.phone') . ' 2'  }}</label>
                    <input type="text" class="form-control" id="phoneInput2" name="phone[]" value="{{ old('phone.1') }}" >
                    @error('phone.1')
                        <div class="alert alert-danger">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="addressInput" class="required">{{ __('site.address') }}</label>
                    <textarea type="text" class="form-control" id="addressInput" name="address" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="alert alert-danger">{{ __($message) }}</div>
                    @enderror
                </div>

            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                    {{ __('site.add') }}</button>
            </div>
        </form>


    </div>
    <!-- /.card -->
@endsection

@section('style')
<style>
    .required:after {
      content:" *";
      color: red;
    }
  </style>
@endsection
