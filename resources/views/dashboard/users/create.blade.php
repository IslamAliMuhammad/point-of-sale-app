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
            <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">{{ __('site.users') }}</a></li>
            <li class="breadcrumb-item active">{{ __('site.create_user') }}</li>
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
            <h3 class="card-title float-left h5">{{ __('site.create_user') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('dashboard.users.store') }}" enctype="multipart/form-data">

            @csrf
            @method('POST')

            <div class="card-body">
                <div class="form-group">
                    <label for="inputFirstName">{{ __('site.first_name') }}</label>
                    <input type="text" class="form-control" id="inputFirstName" name="first_name"
                        value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputLastName">{{ __('site.last_name') }}</label>
                    <input type="text" class="form-control" id="inputLastName" name="last_name"
                        value="{{ old('last_name') }}" required>
                    @error('last_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail">{{ __('site.email') }}</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}"
                        required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputPassword">{{ __('site.password') }}</label>
                    <input type="password" class="form-control" id="inputPassword" name="password" required>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputPasswordConfirmation">{{ __('site.password_confirmation') }}</label>
                    <input type="password" class="form-control" id="inputPasswordConfirmation"
                        name="password_confirmation" required>
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- image uploader --}}
                <div class="form-group">
                    <label for="inputImage" class="notRequired">{{ __('site.image') }}</label>
                    <input type="file" class="form-control-file" id="inputImage" name="image">
                    <img id="imagePreview" src="{{ asset('uploads/user-images/default.jpg') }}" alt="your image" class="img-thumbnail mt-2" style="width: 100px"/>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- permissions --}}
                <div class="permissions mt-4">
                    <h3 class="mb-3 h5 required">{{ __('site.permissions') }}</h3>

                    <div class="form-group d-flex flex-row">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="createCheckbox" value="create users"
                                name="permissions[]">
                            <label for="createCheckbox" class="custom-control-label">{{ __('site.create') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="readCheckbox" value="read users"
                                name="permissions[]">
                            <label for="readCheckbox" class="custom-control-label">{{ __('site.read') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="updateCheckbox" value="edit users"
                                name="permissions[]">
                            <label for="updateCheckbox" class="custom-control-label">{{ __('site.update') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="deleteCheckbox" value="delete users"
                                name="permissions[]">
                            <label for="deleteCheckbox" class="custom-control-label">{{ __('site.delete') }}</label>
                        </div>

                        @error('permissions')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
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

@section('script')
    <script>
        inputImage.onchange = evt => {
            const [file] = inputImage.files
            if (file) {
                imagePreview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection

@section('style')
<style>
    label:not(.notRequired, .custom-control-label):after {
      content:" *";
      color: red;
    }

    .required:after {
        content:" *";
        color: red;
    }
  </style>
@endsection
