<!DOCTYPE html>
<html>
<form id="form-login" action=" {{ Route('login') }}" method="post" name="{{ rand() }}">
    @csrf
    <div class="form-group">
        <div class="placeholder">Email</div>
        <input class="form-control" type="text" name="username" placeholder="">
    </div>
    <div class="form-group">
        <div class="placeholder">Password</div>
        <input class="form-control" type="password" name="password" placeholder="">

    </div>
    <div class="text-center form-group">
        <button class="btn btn-main btn-block" type="submit">Đăng nhập</button>
    </div>
</form>
</html>
