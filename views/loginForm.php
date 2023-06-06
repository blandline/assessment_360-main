<? include_once 'config/config.php'; ?>
<? include_once 'header.php'; ?>

<?
$user = @$_COOKIE['cid'];
$userpsw = @$_COOKIE['cpass'];
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

<link rel="stylesheet" href="css/login.css">

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <div class="wrap d-md-flex">
                    <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                        <div class="text w-100">
                            <h2><?= $language['login_welcome'] ?></h2>
                            <p><?= $language['login_have_account'] ?></p>
                            <a href="./#contact" class="btn btn-white btn-outline-white"><?= $language['login_sign_up'] ?></a>
                        </div>
                    </div>
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4"><?= $language['login_sign_in'] ?></h3>
                            </div>
                        </div>
                        <form action="login" name="loginform" class="form-login" method="post">
                            <div class="form-group mb-3">
                                <label class="label" for="name"><?= $language['login_username'] ?></label>
                                <input type="text" name="username" id="username" placeholder="<?= $language['login_username2'] ?>" class="input form-control" value="<? echo $user;?>" autocomplete="off" required autofocus oninput="setCustomValidity('')" oninvalid="setCustomValidity('<?= $language['general_fill_in_field']; ?>')">
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password"><?= $language['login_password'] ?></label>
                                <span class="loginShowPassword"><i class="material-icons">visibility_off</i></span>
                                <input type="password" name="password" id="password" placeholder="<?= $language['login_password2'] ?>" class="input form-control" value="<? echo $userpsw; ?>" autocomplete="off" required oninput="setCustomValidity('')" oninvalid="setCustomValidity('<?= $language['general_must_email']; ?>')">
                            </div>
                            <? if (!empty($_SESSION[$session_message])) : ?>
                                <div class="alert alert-danger alert-container" id="alert">
                                    <strong>
                                        <center><? echo htmlentities($_SESSION[$session_message]); ?></center>
                                    </strong>
                                    <? unset($_SESSION[$session_message]); ?>
                                </div>
                            <? endif; ?>
                            <div class="form-group loginSubmit">
                                <button type="submit" name="login" class="form-control btn btn-primary submit px-3"><?= $language['login_sign_in'] ?></button>
                            </div>
                            <br>
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-left">
                                    <label class="checkbox-wrap checkbox-primary mb-0"><?= $language['login_remember_me'] ?>
                                        <input type="checkbox" id="remember" name="remember" value="1" <?= $user != "" ? "checked" : ""; ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right" style="text-align: right;">
                                    <a href="forgot"><?= $language['login_forgot_password'] ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- footer -->
                <div class="container py-4">
                    <div class="copyright">
                        &copy; <?= $language["index_copyright"]; ?> <script>
                            document.write(new Date().getFullYear());
                        </script>
                        <strong><span><?= $language["index_copyright2"]; ?></span></strong><?= $language["index_copyright3"]; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="lib/jquery/jquery.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="<?= $jspath; ?>/login.js?v=<?= $jsVersion; ?>"></script>
<script>
    var login = new Login();
</script>