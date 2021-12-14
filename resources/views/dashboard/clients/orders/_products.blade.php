@foreach ($categories as $category)
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $category->name }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="p-0 card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('site.name') }}</th>
                        <th>{{ __('site.stock') }}</th>
                        <th>{{ __('site.price') }}</th>
                        <th>{{ __('site.add') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($category->products as $product)
                        <tr id="{{ $product->id }}">
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ number_format($product->sale_price) }}</td>
                            <td><button id="product-{{ $product->id }}" class="btn btn-success btn-sm add-product-btn" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->sale_price }}" data-stock="{{ $product->stock }}"> <i class="fa fa-plus"></i></button> </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endforeach


