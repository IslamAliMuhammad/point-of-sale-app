@extends('layouts/dashboard/app')

@section('content')

    @include('includes.dashboard._success-alert')

    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('site.users') }}</h3>

                    {{-- search --}}
                    <form action="{{ route('dashboard.users.index') }}" method="GET" class="d-inline-block">

                        @csrf

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="search" class="form-control float-right"
                                    placeholder="{{ __('site.search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>

                        </div>
                    </form>
                    {{-- end search --}}


                    <a class="btn btn-secondary btn-sm mr-2 @cannot('create users') disabled @endcannot"
                        href="{{ route('dashboard.users.create') }}"><i class="fa fa-plus-circle"></i>
                        {{ __('site.add') }}</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if ($users->count() > 0)
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
                                            <a class="btn btn-info btn-sm  @cannot('edit users') disabled @endcannot"
                                                href="{{ route('dashboard.users.edit', $user->id) }}"><i
                                                    class="fa fa-edit"></i> {{ __('site.edit') }}</a>

                                            <form action="{{ route('dashboard.users.destroy', $user->id) }}"
                                                method="POST" class="d-inline-block deleteUser delete">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit" @cannot('delete users')
                                                    disabled @endcannot><i class="fa fa-trash" data-toggle="modal"
                                                        data-target="#exampleModal"></i>
                                                    {{ __('site.delete') }}</button>

                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <h2 class="m-3 h4">{{ __('site.no_records') }}</h2>
                    @endif
                </div>

                <div class="card-footer">
                    <div>
                        {{ $users->appends(['search' => request()->query('search')])->links() }}
                    </div>
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
