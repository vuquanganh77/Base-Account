<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng nhập - Base Account</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name='AUTHOR' content='vqanh77'>
    <link rel="shortcut icon" href="https://static-gcdn.basecdn.net/account/image/fav.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../css/authen.css">
</head>

<body>
    <div class='container'>
        <div class='left scroll'>
            <div class="scroll-wrap">
                <div class='box-wrap'>
                    <div class='logo'>
                        <a href="/">
                            <img src="https://share-gcdn.basecdn.net/brand/logo.full.png" alt="logo">
                        </a>
                    </div>

                    <form action="/forget_password" method="POST">
                        <div class='title'>
                            <h1>Quên mật khẩu</h1>
                        </div>

                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger">
                                <?php foreach ($errors as $error) : ?>
                                    <div class='error'><?php echo $error; ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class='sub-title'></div>

                        <div class='form'>

                            <div class='row'>
                                <div class='label'>Email</div>
                                <div class='input'>
                                    <input type="text" name="email" placeholder="Email của bạn" value="">
                                </div>
                            </div>

                            <button class='submit' type="submit">Gửi Link Reset Password</button>

                            <?php if (!empty($notices)) : ?>
                                <div class="notice">
                                    <?php foreach ($notices as $notice) : ?>
                                        <div class='error'><?php echo $notice; ?></div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class='right'></div>
    </div>
</body>

</html>