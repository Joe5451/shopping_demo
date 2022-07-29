@include('head')

<form action="{{ route('add_cart', $product->product_id) }}" method="post">
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{ asset($product->product_img) }}" style="width:100%;object-fit:cover;">
            </div>
            <div class="col-md-8 d-flex flex-column align-items-start">
                <div class="fs-4 mb-auto">{{ $product->product_name }}</div>
                <div class="fs-5 mb-3">${{ number_format($product->price) }}</div>
                <div class="d-flex mb-3">
                    <button type="button" class="btn border shadow-sm minus">-</button>
                    <input type="number" name="quantity" class="form-control mx-3" value="1">
                    <button type="button" class="btn border shadow-sm plus">+</button>
                </div>
                <button class="btn btn-primary w-auto">加入購物車</button>
                @csrf
            </div>
        </div>    
        
        <script>
            $('.minus').click(function() {
                var current_qty = $('input[name=quantity]').val();
                if (current_qty > 1) {
                    current_qty--;
                    $('input[name=quantity]').val(current_qty);
                } else {
                    alert('購買數量不可小於 1');
                }
            });

            $('.plus').click(function() {
                var current_qty = $('input[name=quantity]').val();
                current_qty++;
            
                $('input[name=quantity]').val(current_qty);
            });

            $('input[name=quantity]').change(function() {
                var current_quantity = $('input[name=quantity]').val();

                if (current_quantity < 1) {
                    $('input[name=quantity]').val(1);
                    alert('購買數量不可小於 1');
                }
            });
        </script>
    </div>
</form>


@include('foot')
