<form action="/" method="post" accept-charset="utf-8" class="login-form">
    <input type="hidden" name="form_type" value="login"  />
    <input type="text" name="identity" value="" class="login op-place" placeholder="Your email or login"  />
    <input type="password" name="password" value="" class="password op-place" placeholder="Your password"  />
    <button type="submit" class="btn login-btn">Log In</button>
    <a href="/forgot_password/">Forgot you password?</a>
    <hr>
    <p>Don’t have an account?</p>
    <button type="button" class="btn reg-btn" onclick="window.location='/registration/';">Register!</button>
</form>