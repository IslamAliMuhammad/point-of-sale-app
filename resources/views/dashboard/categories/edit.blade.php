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
            <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">{{ __('site.categories') }}</a></li>
            <li class="breadcrumb-item active">{{ __('site.edit_category') }}</li>
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
            <h3 class="card-title float-left h5">{{ __('site.edit_category') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('dashboard.categories.update', $category->id) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="card-body">
                {{-- DRY --}}
                @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label for="{{ $locale . 'Name' }}" class="required">{{ __('site.'. $locale .'.name') }}</label>
                        <input type="text" class="form-control" id="{{ $locale . 'Name' }}" name="{{ $locale }}[name]" value="{{ $category->translate($locale)->name }}">
                        @error($locale . '.name')
                            <div class="alert alert-danger">{{ __($message) }}</div>
                        @enderror
                    </div>
                @endforeach

            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i>
                    {{ __('site.update') }}</button>
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
