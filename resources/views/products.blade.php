@include('head')

<div class="container mb-5">
    <form action="{{ route('products') }}" class="d-flex justify-content-end mb-5">
        <input type="text" name="product_name" value="{{ $product_name }}" class="form-control w-auto me-3" placeholder="搜尋產品名稱">

        <select name="sort" class="form-select w-auto me-3">
            <option value="default">預設排序</option>
            <option value="price_high_to_low">價格由高到低</option>
            <option value="price_low_to_high">價格由低到高</option>
        </select>

        <script>
            $('select[name=sort]').val('{{ $sort }}');
        </script>
        
        <button class="btn btn-primary">搜尋</button>
    </form>
    
    <div class="row">
        @foreach ($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('product', $product->product_id) }}" class="card mb-4 text-decoration-none text-dark">
                    <img src="{{ asset($product->product_img) }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text text-end">${{ number_format($product->price) }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<ul class="pagination flex-wrap justify-content-center">
    @foreach ($links as $link)
        <li class="page-item 
        @if (is_null($link->url))
            disabled
        @elseif ($link->active)
            active
        @endif
        "><a class="page-link" href="{{ $link->url }}">
            @if ($link->label == '&laquo; Previous')
                <
            @elseif ($link->label == 'Next &raquo;')
                >
            @else
                {{ $link->label }}
            @endif
        </a></li>
    @endforeach
</ul>

@include('foot')
