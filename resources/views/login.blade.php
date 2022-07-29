@include('head')

<?php
    if (isset($message)) {
        echo <<<AlertMessage
        <script>
            alert('$message');
        </script>
AlertMessage;
    }
?>


<div class="d-flex justify-content-center align-items center">
    <form action="{{ route('do_login') }}" method="post">
        <div class="mb-4">
            <label for="account" class="form-label">帳號</label>
            <input type="text" name="account" class="form-control" id="account">
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">密碼</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>

        @csrf

        <div class="d-flex justify-content-center">
            <input type="submit" class="btn btn-primary" value="登入">
        </div>
    </form>
</div>

@include('foot')
