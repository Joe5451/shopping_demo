<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

const SORT_METHOD = ['default', 'price_high_to_low', 'price_low_to_high'];

class ProductController extends Controller
{
    public function getItems(Request $request)
    {
        $page = (int) $request->query('page', 1);
        $product_name = $request->query('product_name', '');
        $sort = $request->query('sort', 'default');
        $limit = 4;

        if (!in_array($sort, SORT_METHOD)) {
            $sort = 'default';
            $request->instance()->query->set('sort', $sort);
        }

        $query = Product::query();

        $query->when($sort == 'price_high_to_low', function ($q) {
            return $q->orderBy('price', 'desc');
        })
        ->when($sort == 'price_low_to_high', function ($q) {
            return $q->orderBy('price', 'asc');
        })
        ->orderBy('product_id', 'asc');

        $data = $query
        ->where('product_name','LIKE','%'.$product_name.'%')
        ->paginate($limit)->withQueryString();

        $data = json_decode(json_encode($data));
        // return $data;
        
        return view('products', [
            'products' => $data->data,
            'links' => $data->links,
            'sort' => $sort,
            'product_name' => $product_name
        ]);
    }

    public function getItem($product_id)
    {
        $product = Product::find($product_id);

        if (is_null($product)) die('查無商品!');

        return view('product', [
            'product' => $product
        ]);
    }
}
