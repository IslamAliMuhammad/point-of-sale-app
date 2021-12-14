@extends('layouts/dashboard/app')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('site.products') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('site.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('site.products') }}</li>
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
                    <form action="{{ route('dashboard.products.index') }}" method="GET" class="d-inline-block">

                        @csrf

                        <div class="card-tools d-flex" style="width: 500px">
                            <div class="input-group input-group-md">
                                <input type="text" name="search" class="float-right form-control"
                                    placeholder="{{ __('site.search') }}">
                            </div>

                            <div class="mr-2 input-group input-group-md">
                                <select class="custom-select" id="categories" name="category_id">
                                    <option value="0">{{ __('site.all_categories') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>

                        </div>
                    </form>
                    {{-- end search --}}


                    <a class="mr-2 btn btn-secondary btn-sm" href="{{ route('dashboard.products.create') }}"><i
                            class="fa fa-plus"></i>
                        {{ __('site.add') }}</a>

                </div>
                <!-- /.card-header -->
                <div class="p-0 card-body table-responsive">
                    @if ($products->count() > 0)

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('site.name') }}</th>
                                    <th>{{ __('site.description') }}</th>
                                    <th>{{ __('site.image') }}</th>
                                    <th>{{ __('site.purchase_price') }}</th>
                                    <th>{{ __('site.sale_price') }}</th>
                                    <th>{{ __('site.profit_percent') }}</th>
                                    <th>{{ __('site.stock') }}</th>
                                    <th>{{ __('site.action') }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($products as $index => $product)
                                    <tr>
                                        <td>{{ $index++ }}</td>

                                        <td>{{ $product->name }}</td>
                                        <td>{!! $product->description !!}</td>
                                        <td><img class="img-thumbnail" src="{{ asset('uploads/product-images/' . $product->image) }}" alt="product iamge" style="width: 75px"></td>
                                        <td>{{ $product->purchase_price }}</td>
                                        <td>{{ $product->sale_price }}</td>
                                        <td>{{ $product->profit_percent }} %</td>
                                        <td>{{ $product->stock }}</td>

                                        <td class="flex-row d-flex">
                                            <div>
                                                <a class="btn btn-info btn-sm "
                                                href="{{ route('dashboard.products.edit', $product->id) }}"><i
                                                    class="fa fa-edit"></i> {{ __('site.edit') }}</a>
                                            </div>

                                            <div class="ml-1">
                                                <form action="{{ route('dashboard.products.destroy', $product->id) }}"
                                                    method="POST" class="d-inline-block deleteUser delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit"><i
                                                            class="fa fa-trash" data-toggle="modal"
                                                            data-target="#exampleModal"></i>
                                                        {{ __('site.delete') }}</button>

                                                </form>
                                            </div>

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
                        {{ $products->appends(['search' => request()->query('search'), 'category_id' => request()->query('category_id')])->links() }}
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
