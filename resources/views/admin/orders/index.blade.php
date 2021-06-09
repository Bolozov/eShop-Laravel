@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-bar-chart"></i> {{ $pageTitle }}</h1>
        <p>{{ $subTitle }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th> Numéro de commande </th>
                            <th> Client </th>
                            <th class="text-center"> Montant total </th>
                            <th class="text-center"> Articles Qté </th>
                            <th class="text-center"> Statut de paiement </th>
                            <th class="text-center"> Statut </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->user->fullName }}</td>
                            <td class="text-center">{{ number_format($order->grand_total, 2, ',', ' ')  }} {{ config('settings.currency_symbol') }}</td>
                            <td class="text-center">{{ $order->item_count }}</td>
                            <td class="text-center">
                                @if ($order->payment_status == 1)
                                <span class="badge badge-success">Complété</span>
                                @else
                                <span class="badge badge-danger">Pas achevé</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge badge-success">{{ $order->status }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Second group">
                                    <a href="{{ route('admin.orders.show', $order->order_number) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $('#sampleTable').DataTable({
        language: {
            url: '{{ asset("backend/js/French.json") }}'
        }
    });

</script>
@endpush
