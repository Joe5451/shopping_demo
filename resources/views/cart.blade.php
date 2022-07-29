@include('head')

<div class="container">
    <div class="mb-5 table-responsive">
        <table class="table table-bordered table-striped align-middle mb-0" style="min-width: max-content;">
            <thead>
                <tr>
                    <td width="60">項次</td>
                    <td width="120">商品圖片</td>
                    <td>商品名稱</td>
                    <td class="text-end" width="80">單價</td>
                    <td class="text-end" width="80">數量</td>
                    <td class="text-end" width="120">金額</td>
                    <td width="70">操作</td>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @if (count($cart) == 0)
                    <tr>
                        <td colspan="7" class="text-center">
                            無資料
                        </td>
                    </tr>
                @endif

                @foreach ($cart as $item)
                    <tr>
                        <td class="text-end">{{ $loop->index + 1 }}</td>
                        <td class="text-center">
                            <img src="{{ asset($item->product_img) }}" style="width:100px;height:100px;object-fit:cover;">
                        </td>
                        <td>{{ $item->product_name }}</td>
                        <td class="text-end">${{ number_format($item->price) }}</td>
                        <td class="text-end">{{ $item->quantity }}</td>
                        <td class="text-end">${{ number_format($item->quantity*$item->price) }}</td>
                        <td class="text-center">
                            <a href="{{ route('delete_cart', $item->cart_id) }}" onclick="deleteCart(event);" class="btn btn-sm btn-danger">刪除</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="" id="delete_form" method="post">@csrf</form>

        <script>
            function deleteCart(e) {
                e.preventDefault();
                $('#delete_form').attr('action', e.target.href);
                $('#delete_form').submit();
            }
        </script>
    </div>
</div>

@include('foot')
