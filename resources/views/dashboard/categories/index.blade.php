@extends('layouts/dashboard/app')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('site.categories') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('site.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('site.categories') }}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('content')
    @include('includes.dashboard._success-alert')
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    {{-- search --}}
                    <form action="{{ route('dashboard.categories.index') }}" method="GET" class="d-inline-block">

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


                    <a class="btn btn-secondary btn-sm mr-2" href="{{ route('dashboard.categories.create') }}"><i
                            class="fa fa-plus"></i>
                        {{ __('site.add') }}</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if ($categories->count() > 0)

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('site.name') }}</th>
                                    <th>{{ __('site.products_count') }}</th>
                                    <th>{{ __('site.related_products') }}</th>
                                    <th>{{ __('site.action') }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($categories as $index => $category)
                                    <tr>
                                        <td>{{ $index++ }}</td>

                                        <td>{{ $category->name }}</td>

                                        <td>{{ $category->products()->count() }}</td>

                                        <td><a href="{{ route('dashboard.products.index', ['category_id' => $category->id]) }}" class="btn btn-success btn-sm">{{ __('site.related_products') }}</a></td>

                                        <td>
                                            <a class="btn btn-info btn-sm "
                                                href="{{ route('dashboard.categories.edit', $category->id) }}"><i
                                                    class="fa fa-edit"></i> {{ __('site.edit') }}</a>

                                            <form action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                                method="POST" class="d-inline-block deleteUser delete">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><i
                                                        class="fa fa-trash" data-toggle="modal"
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
