@component('mail::message')
# Nouvelle commande.

Vous avez reçu une nouvelle commande.

<div class="row invoice-info">
                        <div class="col-4">Client
                            <address><strong>{{ $order->user->fullName }}</strong><br>Email: {{ $order->user->email }} <br>
                            Tél : {{ $order->phone_number }}</address>
                        </div>
                        <br>
                        <br>
                        <div class="col-4">
                            <b>ID Commande:</b> {{ $order->order_number }}<br>
                            <b>Montant:</b> {{ round($order->grand_total, 2) }} {{ config('settings.currency_symbol') }}<br>
                            <b>Mode de paiement:</b> {{ $order->payment_method }}<br>
                            <b>Statut de paiement:</b> {{ $order->payment_status == 1 ? 'Effectué' : 'Non Effectué' }}<br>
                            <b>Statut de la commande:</b> {{ $order->status }}<br>
                        </div>
                    </div>
                    <br><br>
@component('mail::table')
| ID            | Produit       | SKU #    |Quantité      | Sous-total |
| ------------- |:-------------:| --------:|-------------:|-----------:|
@foreach($order->items as $item)
| {{ $item->id }} | {{ $item->product->name }} | {{ $item->product->sku }}|{{ $item->quantity }} |{{ round($item->price, 2) }} {{ config('settings.currency_symbol') }} |
@endforeach
@endcomponent

{{ config('app.name') }}
@endcomponent
