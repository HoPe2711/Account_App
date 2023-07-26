<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="shortcut icon" href="https://static-gcdn.basecdn.net/account/image/fav.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<div id="page">
    <div id="auth">
        <div class="box-wrap">
            <div class="auth-logo">
                <a href="https://base.vn/"><img src="image/logo.full.png"></a>
            </div>
            <div class="box register">
                <?php $form = Form::begin('', 'register', "post") ?>
                <h1>Sign-up</h1>
                <div class="auth-sub-title">Welcome back. Sign-up to start working.</div>
                <div class="form">
                    <?php echo $form->field($model, 'first_name', '', 'First name') ?>
                    <?php echo $form->field($model, 'last_name', '', 'Last name') ?>
                    <?php echo $form->field($model, 'email', '', 'Your email') ?>
                    <?php echo $form->field($model, 'password', '', 'Password')->passwordField() ?>
                    <?php echo $form->field($model, 'confirm_password', '', 'Confirm password')->passwordField() ?>
                    <div class="row relative overflow">
                        <button type="submit" class="submit register">
                            Submit
                        </button>
                        <div class="extra overflow">
                            <div class="simple">
                                <a href="/login">Login</a>
                            </div>
                        </div>
                    </div>
                    <?php echo Form::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
