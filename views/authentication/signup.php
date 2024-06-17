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

                    <form action="/signup" method="POST">
                        <div class='title'>
                            <h1>Đăng ký</h1>
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
                                <div class='label'>Họ và tên</div>
                                <div class='input'>
                                    <input type="text" name="name" placeholder="Tên của bạn" value="<?php echo $account['name'] ?>">
                                </div>
                            </div>

                            <div class='row'>
                                <div class='label'>Email</div>
                                <div class='input'>
                                    <input type="text" name="email" placeholder="Email của bạn" value="<?php echo $account['email'] ?>">
                                </div>
                            </div>

                            <div class='row'>
                                <div class='label'>Tên đăng nhập</div>
                                <div class='input'>
                                    <input type="text" name="username" placeholder="Tên đăng nhập của bạn" value="<?php echo $account['username'] ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class='label'>Mật khẩu</div>
                                <div class='input'><input type="password" name="password" placeholder="Mật khẩu của bạn" value="<?php echo $account['password'] ?>"></div>
                            </div>

                            <div class="row">
                                <div class='label'> Nhập lại mật khẩu</div>
                                <div class='input'><input type="password" name="re_enter_password" placeholder="Nhập lại mật khẩu của bạn" value="<?php echo $account['re_enter_password'] ?>"></div>
                            </div>
                            <button class='submit' type="submit">Đăng ký</button>
                        </div>
                    </form>

                    <div class="language-switch">
                        <button id="english-btn">English</button>
                        <button id="vietnamese-btn">Tiếng Việt</button>
                    </div>

                </div>
            </div>
        </div>
        <div class='right'></div>
    </div>
</body>

</html>