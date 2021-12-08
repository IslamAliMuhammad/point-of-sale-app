@extends('layouts/dashboard/app')

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title float-left h5">{{ __('site.add_category') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('dashboard.categories.store') }}" enctype="multipart/form-data">

            @csrf
            @method('POST')

            <div class="card-body">
                {{-- DRY --}}
                @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label for="{{ $locale . 'Name' }}">{{ __('site.'. $locale .'.name') }}</label>
                        <input type="text" class="form-control" id="{{ $locale . 'Name' }}" name="{{ $locale }}[name]" value="{{ old($locale.'.name') }}" >
                        @error($locale . '.name')
                            <div class="alert alert-danger">{{ __($message) }}</div>
                        @enderror
                    </div>
                @endforeach

            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i>
                    {{ __('site.add') }}</button>
            </div>
        </form>


    </div>
    <!-- /.card -->
@endsection
