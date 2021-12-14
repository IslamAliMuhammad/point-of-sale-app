<!-- /.card-header -->
<div class="p-0 card-body table-responsive" id="print-header">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('site.name') }}</th>
                    <th>{{ __('site.quantity') }}</th>
                    <th>{{ __('site.price') }}</th>
                </tr>
            </thead>

            {{-- display order products --}}
            <tbody>

                @foreach ($products as $index => $product)
                    <tr data-total={{ $order->total_price }}>
                        <td>{{ $product->name }}</td>

                        <td>{{ $product->pivot->quantity }}</td>

                        <td>{{ $product->sale_price * $product->pivot->quantity }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
</div>
<!-- /.card-body -->


<div class="card-footer">
    <div class="mt-2" id="print-footer">
        <h5 class="d-inline-block" >{{ __('site.total') }} : <span>{{ $order->total_price }}</span></h5>
    </div>

    <button class="mt-2 btn btn-primary btn-block" id="print-btn"><i class="fas fa-print"></i> {{ __('site.print') }}</button>
</div>
