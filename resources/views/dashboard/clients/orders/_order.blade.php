<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ __('site.order') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" method="POST" action="{{ route('dashboard.clients.orders.store', $client->id) }}">

        @csrf


        <div class="p-0 card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('site.product') }}</th>
                        <th>{{ __('site.quantity') }}</th>
                        <th>{{ __('site.purchase_price') }}</th>
                        <th>{{ __('site.delete') }}</th>
                    </tr>
                </thead>
                <tbody id="order-list">


                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

            {{-- Order total price --}}
            <div class="form-group">
                <label for="total-price">{{ __('site.total') }}</label>
                <input readonly type="number" value="0" id="total-price" name="total_price">
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="add-order" disabled><i class="fa fa-plus"></i>
                {{ __('site.add_order') }}</button>
        </div>
    </form>
</div>


