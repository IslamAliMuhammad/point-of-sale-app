@extends('layouts/dashboard/app')

@section('content')
    @include('includes._success-alert')
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('site.users') }}</h3>

                    {{-- search --}}
                    <form action="{{ route('dashboard.categories.index') }}" method="GET" class="d-inline-block">

                        @csrf

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="{{ __('site.search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>

                        </div>
                    </form>
                    {{-- end search --}}


                    <a class="btn btn-secondary btn-sm mr-2 @cannot('create') disabled @endcannot"
                        href="{{ route('dashboard.categories.create') }}"><i class="fa fa-plus-circle"></i>
                        {{ __('site.add') }}</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('site.name') }}</th>
                                <th>{{ __('site.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ $index++ }}</td>

                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm  @cannot('update') disabled @endcannot"
                                            href="{{ route('dashboard.categories.edit', $category->id) }}"><i
                                                class="fa fa-edit"></i> {{ __('site.edit') }}</a>

                                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST"
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

                <div class="card-footer">
                    <div>
                        {{ $categories->appends(['search' => request()->query('search')])->links() }}
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
                return confirm("Do you want to delete this category?");
            });

            $(".alert-success").fadeTo(2000, 500).slideUp(500, function() {
                $(".alert-success").slideUp(500);
            });
        });
    </script>
@endsection
