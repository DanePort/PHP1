<?php
    use App\Config;

    require 'header.php';
?>

<body>
<div class="content">
<div class="container">
    <div class="form" id="login">
        <H1 class="text-center">Log in</H1>

        <form action="login/create" method="post">

            <div class="form-group">
                <label for="inputEmail">Email address:</label>
                <input type="text" name="email" placeholder="Email address" autofocus value="<?php if (isset($email)) echo ($email);?>" class="form-control <?php if (isset($email)) if ($email == "") echo "is-invalid";?>" />
                <span class="invalid-feedback">please fill in Email adress</span>
            </div>

            <div class="form-group">
                <label for="inputPassword">Password:</label>
                <input type="password" id="inputPassword" name="password" placeholder="Password" class="form-control <?php if (isset($email)) echo "is-invalid";?>" />
                <span class="invalid-feedback">password is incorrect!!</span>
            </div>

            <div class="checkbox">
            <label>
                <input type="checkbox" name="remember_me" <?php if (isset($remember_me) && $remember_me) {echo ('checked="checked"');} ?> /> Remember me
            </label>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary text-center">Log in</button>
            </div>

            <div class="form-group">
                <a href="#" class="float-left">Forgot password?</a>
                <a href="register" class="float-right">No account? Register</a>
            </div>
            
        </form>
    </div>

    <div class="form" id="forgotPass" hidden>
        <H1 class="text-center">Log in</H1>

        <form action="/login/login" method="post">

            <div class="form-group">
                <label for="inputEmail">Email address:3</label>
                <input type="text" name="email" placeholder="Email address" autofocus value="<?php if (isset($username)) echo ($username);?>" class="form-control" />
            </div>

            <div class="form-group">
                <label for="inputPassword">Password:</label>
                <input type="password" id="inputPassword2" name="password" placeholder="Password" class="form-control" />
            </div>

            <div class="checkbox">
            <label>
                <input type="checkbox" name="remember_me" <?php if (isset($remember_me) && $remember_me) {echo ('checked="checked"');} ?> /> Remember me
            </label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary text-center">Log in</button>
            </div>
            <a href="/password/forgot" class="float-left">Forgot password?</a>
            <a href="/password/forgot" class="float-right">No account? Register</a>
        </form>
    </div>
</div>
</div>

</body>

<script>
    function login() {
        setAllHidden();
        document.getElementById("login").style.visibility = visible;
    }

    function register(){
        setAllHidden();
        document.getElementById("register").style.visibility = visible;
    }

    function forgot(){
        setAllHidden();
        document.getElementById('forgotPass').style.visibility = visible;
    }

    function setAllHidden(){
        document.getElementById("login").style.visibility = hidden;
        document.getElementById("register").style.visibility = hidden;
        document.getElementById("forgotPass").style.visibility = hidden;
    }
</script>


