@extends('layouts/dashboard/app')

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title float-left h5">{{ __('site.edit_user') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('dashboard.users.update', $user->id) }}" enctype="multipart/form-data">

            @csrf
            @method('PATCH')

            <div class="card-body">
                <div class="form-group">
                    <label for="inputFirstName">{{ __('site.first_name') }}</label>
                    <input type="text" class="form-control" id="inputFirstName" name="first_name" value="{{ $user->first_name }}" required>
                    @error('first_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputLastName">{{ __('site.last_name') }}</label>
                    <input type="text" class="form-control" id="inputLastName" name="last_name" value="{{ $user->last_name }}" required>
                    @error('last_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail">{{ __('site.email') }}</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $user->email }}" required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- image uploader --}}
                <div class="form-group">
                    <label for="inputPhoto">{{ __('site.image') }}</label>
                    <input type="file" class="form-control-file" id="inputImage" name="image">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- permissions --}}
                <div class="permissions mt-4">
                    <h3 class="mb-3 h5">{{ __('site.permissions') }}</h3>
                    <div class="form-group d-flex flex-row">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="createCheckbox" value="create"
                                name="permissions[]" @if(in_array('create', $permissions)) checked @endif>
                            <label for="createCheckbox" class="custom-control-label">{{ __('site.create') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="readCheckbox" value="read"
                                name="permissions[]" @if(in_array('read', $permissions)) checked @endif>
                            <label for="readCheckbox" class="custom-control-label">{{ __('site.read') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="updateCheckbox" value="update"
                                name="permissions[]" @if(in_array('update', $permissions)) checked @endif>
                            <label for="updateCheckbox" class="custom-control-label">{{ __('site.update') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="deleteCheckbox" value="delete"
                                name="permissions[]" @if(in_array('delete', $permissions)) checked @endif>
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
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                    {{ __('site.edit') }}</button>
            </div>
        </form>


    </div>
    <!-- /.card -->
@endsection

{{-- @php
    dd($permissions);
@endphp --}}
