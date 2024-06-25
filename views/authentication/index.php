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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../login.js"></script>
</head>

<body>
    <div class='container'>
        <div class='left scroll'>
            <div class="overlay"></div>
            <div class="spinner"></div>
            <div class="scroll-wrap">
                <div class='box-wrap'>
                    <div class='logo'>
                        <a href="/">
                            <img src="https://share-gcdn.basecdn.net/brand/logo.full.png" alt="logo">
                        </a>
                    </div>
                    <form action="/" method="POST">
                        <div class='title'>
                            <h1>Đăng nhập</h1>
                        </div>
                        <div class='sub-title'>Chào mừng trở lại. Đăng nhập để bắt đầu làm việc.</div>

                        <div class="alert alert-danger " style="display: none;">

                        </div>

                        <div class='form'>

                            <div class='row'>
                                <div class='label'>Email</div>
                                <div class='input'>
                                    <input type="text" name="email" placeholder="Email của bạn">
                                </div>
                            </div>

                            <div class="row">
                                <div class='label'>Mật khẩu<a href="/forget_password" class='forget-pw'>Quên mật khẩu?</a></div>
                                <div class='input'><input type="password" name="password" placeholder="Mật khẩu của bạn"></div>
                            </div>


                            <div class="row xo ">
                                <div class='checkbox'><input id="rememberme" type='checkbox' checked name='saved'> &nbsp; Giữ tôi luôn đăng nhập</div>
                                <button class='submit'>Đăng nhập để bắt đầu làm việc</button>


                                <!-- Spinner Container -->
                            
                                
                                <!-- Captcha -->

                                <div class="g-recaptcha captcha-form" style="display: none;" data-sitekey=<?php echo $recaptcha_site_key ?>></div>

                                <!-- End Captcha -->

                                <div class="oauth">
                                    <div class='label'>
                                        <div class="line"></div>
                                        <span>Hoặc, đăng nhập thông qua SSO</span>
                                    </div>
                                    <div class="oauth-left">
                                        <button class="gg-button" onclick="location.href='https://sso.base.vn/google'" type="button">
                                            <div class="gg-button-content-wrapper">
                                                <div class="gg-button-icon">
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                                                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                                                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                                                        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                                                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                                                        <path fill="none" d="M0 0h48v48H0z"></path>
                                                    </svg>
                                                </div>
                                                <span class="gg-button-contents">Đăng nhập bằng Google</span>
                                            </div>
                                        </button>
                                    </div>

                                    <div class="oauth-right">
                                        <button class="gg-button" onclick="location.href='https://sso.base.vn/ms'" type="button">
                                            <div class="gg-button-content-wrapper">
                                                <div class="gg-button-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21">
                                                        <title>MS-SymbolLockup</title>
                                                        <rect x="1" y="1" width="9" height="9" fill="#f25022" />
                                                        <rect x="1" y="11" width="9" height="9" fill="#00a4ef" />
                                                        <rect x="11" y="1" width="9" height="9" fill="#7fba00" />
                                                        <rect x="11" y="11" width="9" height="9" fill="#ffb900" />
                                                    </svg>
                                                </div>
                                                <span class="gg-button-contents">Đăng nhập bằng Microsoft</span>
                                            </div>
                                        </button>
                                    </div>

                                    <div class='oauth-left'>
                                        <button class="gg-button" onclick="location.href='https://sso.base.vn/apple'" type="button">
                                            <div class="gg-button-content-wrapper">
                                                <div class="gg-button-icon">

                                                    <svg width="18" height="24" viewBox="0 2 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_209_2)">
                                                            <path d="M15.0331 11.1566C15.0641 14.3346 17.9678 15.3922 18 15.4056C17.9754 15.4802 17.536 16.9128 16.4702 18.3925C15.5488 19.6717 14.5925 20.9463 13.0861 20.9727C11.6059 20.9986 11.13 20.1389 9.43767 20.1389C7.7459 20.1389 7.21708 20.9463 5.81591 20.9986C4.36184 21.0509 3.25458 19.6153 2.32554 18.3407C0.427169 15.7335 -1.02358 10.9733 0.92441 7.76014C1.89213 6.16447 3.62152 5.15402 5.49862 5.12811C6.92648 5.10223 8.27421 6.04065 9.14707 6.04065C10.0194 6.04065 11.6572 4.91212 13.3789 5.07786C14.0997 5.10636 16.1229 5.35444 17.4221 7.16093C17.3174 7.22257 15.0079 8.49974 15.0331 11.1566ZM12.2512 3.35296C13.0232 2.46528 13.5427 1.22955 13.401 0C12.2883 0.0424842 10.9427 0.704394 10.1446 1.59159C9.42926 2.37724 8.80283 3.63472 8.97185 4.83994C10.2121 4.93109 11.4792 4.24121 12.2512 3.35296Z" fill="black" />
                                                        </g>
                                                    </svg>

                                                </div>
                                                <span class="gg-button-contents">Đăng nhập bằng Apple</span>
                                            </div>
                                        </button>
                                    </div>

                                    <div class='oauth-right'>
                                        <button class="gg-button" onclick="SAML.login();" type="button">
                                            <div class="gg-button-content-wrapper">
                                                <div class="gg-button-icon">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <mask id="mask0_6162_32439" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                                            <rect width="24" height="24" fill="#D9D9D9" />
                                                        </mask>
                                                        <g mask="url(#mask0_6162_32439)">
                                                            <path d="M12 15.6154C12.2288 15.6154 12.4207 15.538 12.5754 15.3832C12.7303 15.2284 12.8077 15.0366 12.8077 14.8077C12.8077 14.5789 12.7303 14.3871 12.5754 14.2322C12.4207 14.0774 12.2288 14 12 14C11.7711 14 11.5793 14.0774 11.4245 14.2322C11.2697 14.3871 11.1923 14.5789 11.1923 14.8077C11.1923 15.0366 11.2697 15.2284 11.4245 15.3832C11.5793 15.538 11.7711 15.6154 12 15.6154ZM12.0003 12.2116C12.2129 12.2116 12.391 12.1397 12.5346 11.996C12.6782 11.8522 12.7499 11.6741 12.7499 11.4616V8.13466C12.7499 7.92216 12.6781 7.74404 12.5343 7.60029C12.3904 7.45655 12.2122 7.38469 11.9997 7.38469C11.7871 7.38469 11.609 7.45655 11.4654 7.60029C11.3218 7.74404 11.25 7.92216 11.25 8.13466V11.4616C11.25 11.6741 11.3219 11.8522 11.4657 11.996C11.6095 12.1397 11.7877 12.2116 12.0003 12.2116ZM12 21.3712C11.8961 21.3712 11.7942 21.3628 11.6942 21.3462C11.5942 21.3295 11.4973 21.3045 11.4036 21.2712C9.29479 20.5212 7.61698 19.1914 6.3702 17.2817C5.1234 15.3721 4.5 13.3116 4.5 11.1V6.59621C4.5 6.21636 4.60922 5.8745 4.82765 5.57061C5.04608 5.26673 5.32853 5.04642 5.675 4.90969L11.3673 2.78469C11.5814 2.70777 11.7923 2.66931 12 2.66931C12.2077 2.66931 12.4186 2.70777 12.6327 2.78469L18.325 4.90969C18.6714 5.04642 18.9539 5.26673 19.1723 5.57061C19.3907 5.8745 19.5 6.21636 19.5 6.59621V11.1C19.5 13.3116 18.8765 15.3721 17.6297 17.2817C16.383 19.1914 14.7052 20.5212 12.5963 21.2712C12.5026 21.3045 12.4057 21.3295 12.3057 21.3462C12.2057 21.3628 12.1038 21.3712 12 21.3712ZM12 19.9C13.7333 19.35 15.1666 18.25 16.3 16.6C17.4333 14.95 18 13.1167 18 11.1V6.58659C18 6.52249 17.9823 6.4648 17.9471 6.41351C17.9118 6.36221 17.8621 6.32374 17.798 6.29811L12.1057 4.17311C12.0737 4.16029 12.0384 4.15389 12 4.15389C11.9615 4.15389 11.9263 4.16029 11.8942 4.17311L6.20192 6.29811C6.13781 6.32374 6.08812 6.36221 6.05287 6.41351C6.01761 6.4648 5.99997 6.52249 5.99997 6.58659V11.1C5.99997 13.1167 6.56664 14.95 7.69997 16.6C8.83331 18.25 10.2666 19.35 12 19.9Z" fill="#1C1B1F" />
                                                        </g>
                                                    </svg>

                                                </div>
                                                <span class="gg-button-contents">Đăng nhập bằng SAML</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='extra'>
                            <div class='guest'>
                                <a class='a'>Đăng nhập với quyền truy cập của tài khoản Khách?</a>
                            </div>
                        </div>
                    </form>

                    <div class="language-switch">
                        <button id="english-btn">English</button>
                        <button id="vietnamese-btn">Tiếng Việt</button>
                    </div>

                    <div class="sign-up"><a href="/signup">Đăng ký</a> </div>
                </div>
            </div>
        </div>

        <div class='right'></div>
    </div>
</body>

</html>