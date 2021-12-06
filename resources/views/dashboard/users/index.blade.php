@extends('layouts/dashboard/app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('site.users') }}</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                    <a class="btn btn-secondary btn-sm mr-2 @cannot('create') disabled @endcannot"
                        href="{{ route('dashboard.users.create') }}"><i class="fa fa-plus-circle"></i>
                        {{ __('site.add') }}</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('site.first_name') }}</th>
                                <th>{{ __('site.last_name') }}</th>
                                <th>{{ __('site.email') }}</th>
                                <th>{{ __('site.image') }}</th>
                                <th>{{ __('site.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><img src="{{ asset('uploads/user-images/' . $user->image) }}" alt="user"
                                            class="img-thumbnail" style="width: 50px;"></td>
                                    <td>
                                        <a class="btn btn-info btn-sm  @cannot('update') disabled @endcannot"
                                            href="{{ route('dashboard.users.edit', $user->id) }}"><i
                                                class="fa fa-edit"></i> {{ __('site.edit') }}</a>

                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST"
                                            class="d-inline-block deleteUser delete">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" @cannot('delete') disabled
                                                @endcannot><i class="fa fa-trash" data-toggle="modal"
                                                    data-target="#exampleModal"></i>
                                                {{ __('site.delete') }}</button>

                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(".delete").on("submit", function(e) {
                return confirm("Do you want to delete this user?");
            });

            $(".alert-success").fadeTo(2000, 500).slideUp(500, function() {
                $(".alert-success").slideUp(500);
            });
        });
    </script>
@endsection
