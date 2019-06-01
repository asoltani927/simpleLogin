<!DOCTYPE>
<html lang="fa">
<head>
    <title>Sign in</title>

    <link rel="stylesheet" href="<?= $app->getUrl() ?>assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= $app->getUrl() ?>assets/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="<?= $app->getUrl() ?>assets/css/style.css"/>

</head>

<body>

<div class="container">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="<?= $app->getUrl() ?>assets/images/user.png" id="icon" alt="User Icon" />
            </div>

            <div class="wrapper ">

                <div class="alert alert-danger" id="errorMessage" style="display: none">
                    please enter email address,
                </div>
            </div>

            <!-- Login Form -->
            <form id="signInForm" method="post">
                <input type="text" id="email" class="fadeIn second" name="email" placeholder="email address">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="<?= $app->getUrl() ?>forget.php">Forgot Password?</a> -
                <a class="underlineHover" href="<?= $app->getUrl() ?>signup.php">Sign up</a>
            </div>

        </div>
    </div>
</div>

</body>

<script src="<?= $app->getUrl() ?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?= $app->getUrl() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= $app->getUrl() ?>assets/js/npm.js" type="text/javascript"></script>

<script src="<?= $app->getUrl() ?>assets/js/scripts.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $("#signInForm").on("submit", function (event) {
            event.preventDefault();

            var email = $("#email").val();
            var password = $("#password").val();
            if (validate_email(email) === false) {
                show_message("email address is not valid...");
            } else {

                $.post("<?= $app->getUrl() ?>signin.php", {email: email,password: password,submit: 'login'}, function (data) {
                    if (data.ok === true) {
                        document.location.href = '<?= $app->getUrl() ?>'
                    }
                    show_message(data.message, data.class);
                }, 'json');
            }

        });


    });
</script>

</html>