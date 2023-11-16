<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ecommerce\StoreCartOrderRequest;
use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\Product;
use Carts;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Str;

class CartController extends Controller
{

    private function getCartResponse(\Darryldecode\Cart\Cart $cart)
    {
        $items    = $cart->getContent();
        $count    = $items->sum('quantity');
        $subtotal = $cart->getSubTotal();
        $total    = $cart->getTotal();
        return compact('items', 'count', 'subtotal', 'total');
    }

    public function index(Request $request)
    {
        /** @var \Darryldecode\Cart\Cart */
        $cart = Carts::session($request->route('cart_id'));

        return $this->getCartResponse($cart);
    }

    public function store(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric',
        ]);

        $product = Product::query()->orderable()->findOrFail($request->route('product_id'));

        /** @var \Darryldecode\Cart\Cart */
        $cart = Carts::session($request->route('cart_id'));

        $cart->add([
            'id'              => uniqid(),
            'name'            => $product->name,
            'price'           => $product->price,
            'quantity'        => $request->get('quantity', 1),
            'attributes'      => array(),
            'associatedModel' => $product,
        ]);

        return res()->success('ecommerce.item_cart_added', $this->getCartResponse($cart));
    }

    public function update(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric',
        ]);

        /** @var \Darryldecode\Cart\Cart */
        $cart = Carts::session($request->route('cart_id'));
        $cart->update($request->route('cart_item_id'), [
            'quantity' => $request->get('qty'),
        ]);

        return res()->success('ecommerce.item_cart_updated', $this->getCartResponse($cart));
    }

    public function destroy(Request $request)
    {
        /** @var \Darryldecode\Cart\Cart */
        $cart = Carts::session($request->route('cart_id'));

        $cart->remove($request->route('cart_item_id'));

        return res()->success('ecommerce.item_cart_removed', $this->getCartResponse($cart));
    }

    public function transformToOrder(StoreCartOrderRequest $request)
    {
        /** @var Cart  */
        $cart      = Carts::session($request->route('cart_id'));
        $cartItems = $cart->getContent();
        $cartTotal = $cart->getTotal();

        if ($cartTotal == 0 || $cartItems->count() === 0) {
            return res()->error('ecommerce.invalid_order');
        }

        $order = Order::query()->create([
            'uuid'         => Str::uuid(),
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'company_name' => $request->company_name,
            'status'       => $request->status,
            'country_code' => $request->country_code,
            'address'      => $request->address,
            'address2'     => $request->address2,
            'city'         => $request->city,
            'zip_code'     => $request->zip_code,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'notes'        => $request->notes,
            'total'        => $cartTotal,
            'status'       => 'pending',
        ]);

        $order->items()->createMany($cartItems->map(function ($item) {
            return [
                'product_id' => $item->associatedModel->id,
                'name'       => $item->name,
                'price'      => $item->price,
                'quantity'   => $item->qty,
            ];
        }));
        $cart->clear();
        $order->refresh();
        return res()->success('ecommerce.order_success', $order);
    }
}
