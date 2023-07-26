<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Base Account</title>
    <link rel="shortcut icon" href="https://static-gcdn.basecdn.net/account/image/fav.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="js/login.js"></script>
    <script src="js/icon.js"></script>
</head>
<body>
<div id="page">
    <div id="auth">
        <div class="box-wrap">
            <div class="auth-logo">
                <a href="https://base.vn/"><img src="image/logo.full.png"></a>
            </div>
            <div class="box login">
                <?php $form = Form::begin('authform', 'login', "post") ?>
                <h1>Login</h1>
                <div class="auth-sub-title">Welcome back. Login to start working.</div>
                <div class="form">
                    <?php
                        echo $form->field($model, 'email', '', 'Your Email');
                        echo $form->field($model, 'password', '<a class="a right normal url">Forget your password?</a>', 'Your Password')->passwordField();
                        Alert::notify($model);
                    ?>

                    <div class="row relative overflow">
                        <div class="checkbox">
                            <input type="checkbox" checked="" name="saved">
                            &nbsp; Keep me logged in
                        </div>
                        <button type="submit" class="submit">Login to start working</button>
                        <div class="oauth">
                            <div class="label">
                                <span>Or, login via single sign-on</span>
                            </div>
                            <a class="oauth-login left" href="">Login with Google</a>
                            <a class="oauth-login right" href="">Login with Microsoft</a>
                            <a class="oauth-login left" href="">Login with AppleID</a>
                            <a class="oauth-login right" href="">Login with SAML</a>
                        </div>
                    </div>
                </div>
                <div class="extra overflow">
                    <div class="simple">
                        <a href="/register">Sign-up</a>
                    </div>
                </div>
                <?php echo Form::end() ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>