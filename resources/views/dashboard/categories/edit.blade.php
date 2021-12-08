@extends('layouts/dashboard/app')

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title float-left h5">{{ __('site.update_category') }}</h3>
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
                        <label for="{{ $locale . 'Name' }}">{{ __('site.'. $locale .'.name') }}</label>
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

