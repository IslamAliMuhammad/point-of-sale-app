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
            <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">{{ __('site.products') }}</a></li>
            <li class="breadcrumb-item active">{{ __('site.edit_product') }}</li>
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
            <h3 class="card-title float-left h5">{{ __('site.edit_product') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('dashboard.products.update', $product->id) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">
                    <label for="categories">{{ __('site.all_categories') }}</label>
                        <select class="custom-select" id="categories" name="category_id">
                            <option>{{ __('site.all_categories') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($product->category_id === $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    @error('name')
                        <div class="alert alert-danger">{{ __($message) }}</div>
                    @enderror
                </div>

                {{-- DRY --}}
                @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label for="{{ $locale . 'Name' }}">{{ __('site.'. $locale .'.name') }}</label>
                        <input type="text" class="form-control" id="{{ $locale . 'Name' }}" name="{{ $locale }}[name]" value="{{ $product->translate($locale)->name }}" >
                        @error($locale . '.name')
                            <div class="alert alert-danger">{{ __($message) }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="{{ $locale . 'Description' }}">{{ __('site.'. $locale .'.description') }}</label>
                        <textarea class="form-control editor" id="{{ $locale . 'Description' }}" name="{{ $locale }}[description]">{{ $product->translate($locale)->description }}</textarea>
                        @error($locale . '.description')
                            <div class="alert alert-danger">{{ __($message) }}</div>
                        @enderror
                    </div>
                @endforeach


                {{-- image uploader --}}
                <div class="form-group">
                    <label for="inputImage" class="notRequired">{{ __('site.image') }}</label>
                    <input type="file" class="form-control-file" id="inputImage" name="image">
                    <img id="imagePreview" src="{{ asset('uploads/product-images/' . $product->image) }}" alt="product image" class="img-thumbnail mt-2" style="width: 100px"/>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="purchasePriceInput">{{ __('site.purchase_price') }}</label>
                    <input type="number" step="0.01" class="form-control" id="purchasePriceInput" name="purchase_price" value="{{ $product->purchase_price }}" >
                    @error('purchase_price')
                        <div class="alert alert-danger">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="salePriceInput">{{ __('site.purchase_price') }}</label>
                    <input type="number" step="0.01" min="0" class="form-control" id="salePriceInput" name="sale_price" value="{{ $product->sale_price }}" >
                    @error('sale_price')
                        <div class="alert alert-danger">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stockInput">{{ __('site.stock') }}</label>
                    <input type="number" min="0" class="form-control" id="stockInput" name="stock" value="{{ $product->stock }}" >
                    @error('stock')
                        <div class="alert alert-danger">{{ __($message) }}</div>
                    @enderror
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

@section('script')
    <script>
        var allEditors = document.querySelectorAll('.editor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i], {
                language: "{{ app()->getLocale() }}",
            });
        }

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
    label:not(.notRequired):after {
      content:" *";
      color: red;
    }
  </style>
@endsection
