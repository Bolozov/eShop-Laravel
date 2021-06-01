<?php

namespace App\Http\Controllers\Site;

use Cart;
use App\Models\Admin;
use App\Mail\newOrderEmail;
use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        return view('site.pages.checkout');
    }

    public function placeOrder(Request $request)
    {

        $order = $this->orderRepository->storeOrderDetails($request->all());
        $adminEmails = Admin::select('email')->get();
        foreach ($adminEmails as $email) {
            \Mail::to($email)->send(new newOrderEmail($order));
        }
        Cart::clear();
        return view('site.pages.success', compact('order'));
    }

}
