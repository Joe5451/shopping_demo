<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function addCart($product_id, Request $request)
    {
        $validator = Validator::make($request->input(),
        [
            'quantity' => 'required|numeric|min:1'
        ]);

        if (!$validator->fails()) {
            $product = Product::find($product_id);
            if (is_null($product)) {
                $this->alertAndRedirect('商品不存在', route('products'));
                return;
            }

            $member = Auth::guard('member')->user();

            $exist_cart = Cart::where('member_id', $member->member_id)
            ->where('product_id', $product_id)
            ->take(1)
            ->get();

            if (count($exist_cart) > 0) {
                $new_quantity = $exist_cart[0]->quantity + $request->input('quantity');
                Cart::find($exist_cart[0]->cart_id)->update([
                    'quantity' => $new_quantity
                ]);
            } else {
                Cart::create([
                    'member_id' => $member->member_id,
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'product_img' => $product->product_img,
                    'price' => $product->price,
                    'quantity' => $request->input('quantity')
                ]);
            }

            $this->alertAndRedirect('加入購物車成功', route('product', $product_id));
        } else {
            $this->alertAndRedirect('請輸入正確商品數量', route('product', $product_id));
        }
    }

    public function getItems()
    {
        $member = Auth::guard('member')->user();
        $cart = Cart::where('member_id', $member->member_id)->get();
        
        return view('cart', [
            'cart' => $cart
        ]);
    }

    public function deleteCart($cart_id)
    {
        $member = Auth::guard('member')->user();
        Cart::where('member_id', $member->member_id)->find($cart_id)->delete();

        $this->alertAndRedirect('已移除商品', route('cart'));
    }

    public function alertAndRedirect($message, $redirect_route = null)
    {
        $js_script = '<script>alert("'. $message .'");';
        if (!is_null($redirect_route)) $js_script .= 'window.location.href="' . $redirect_route . '";';
        $js_script .= '</script>';
        echo $js_script;
    }
}
