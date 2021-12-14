<div class="card">
    <div class="card-header">

        <h3 class="h5">{{ __('site.orders') }}</h3>

        {{-- search --}}
        <form action="{{ route('dashboard.orders.index') }}" method="GET" class="d-inline-block">

            @csrf

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="search" class="float-right form-control"
                        placeholder="{{ __('site.search') }}">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>

            </div>
        </form>
        {{-- end search --}}

    </div>
    <!-- /.card-header -->
    <div class="p-0 card-body table-responsive">
        @if ($orders->count() > 0)

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('site.client_name') }}</th>
                        <th>{{ __('site.price') }}</th>
                        <th>{{ __('site.created_at') }}</th>
                        <th>{{ __('site.action') }}</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ $order->client->name }}</td>

                            <td>{{ number_format($order->total_price) }}</td>

                            <td>{{ $order->created_at }}</td>

                            <td>
                                <a href="#" class="btn btn-success btn-sm display-products" data-url="{{ route('dashboard.orders.products', $order->id) }}" data-method="GET"><i class="fa fa-list"></i> {{ __('site.display') }}</a>

                                <form action="{{ route('dashboard.orders.destroy', $order->id) }}"
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
            {{ $orders->appends(['search' => request()->query('search')])->links() }}
        </div>
    </div>

    <!-- /.card-body -->
</div>

