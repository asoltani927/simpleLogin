<!DOCTYPE>
<html lang="fa">
<head>
    <title>Sign up</title>

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
                <img src="<?= $app->getUrl() ?>assets/images/user.png" id="icon" alt="User Icon"/>
            </div>
            <div class="wrapper ">

                <div class="alert alert-danger" id="errorMessage" style="display: none">
                    please enter email address,
                </div>
            </div>
            <!-- Login Form -->
            <form id="signUpForm" method="post" action="">
                <input type="email" class="fadeIn second" maxlength="255" name="email" id="email"
                       placeholder="please enter email ....">
                <input type="submit" class="fadeIn fourth" value="Sign up">
            </form>
            <form id="signUpCode" method="post" action="" style="display: none">
                <input type="text" class="fadeIn second" maxlength="6" name="code" id="code"
                       placeholder="please enter code ....">
                <input type="submit" class="fadeIn fourth" value="Send Code">
            </form>
            <form id="signUpFinished" method="post" action="" style="display: none">
                <input type="text" class="fadeIn second" maxlength="255" name="name" id="name"
                       placeholder="please enter name ....">
                <input type="text" class="fadeIn second" maxlength="255" name="password" id="password"
                       placeholder="please enter password ....">
                <input type="submit" class="fadeIn fourth" value="Finished">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="<?= $app->getUrl() ?>signin.php">Sign in</a>
            </div>

        </div>
    </div>
</div>

</body>

<script src="<?= $app->getUrl() ?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?= $app->getUrl() ?>assets/js/scripts.js" type="text/javascript"></script>
<script src="<?= $app->getUrl() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= $app->getUrl() ?>assets/js/npm.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $("#signUpForm").on("submit", function (event) {
            event.preventDefault();

            var email = $("#email").val();
            if (validate_email(email) === false) {
                show_message("email address is not valid...");
            } else {

                $.post("<?= $app->getUrl() ?>signup.php", {email: email,submit: 'email'}, function (data) {
                    if (data.ok === true) {
                        $("#signUpCode").show('fast');
                        $("#signUpForm").hide();
                        $("#signUpFinished").hide();
                    }
                    show_message(data.message, data.class);
                }, 'json');
            }

        });

        $("#signUpCode").on("submit", function (event) {
            event.preventDefault();

            var email = $("#email").val();
            var code = $("#code").val();
            if (code.length !== 6) {
                show_message("code is not valid");
            } else {

                $.post("<?= $app->getUrl() ?>signup.php", {email: email,code: code,submit: 'code'}, function (data) {
                    if (data.ok === true) {
                        $("#signUpCode").hide('fast');
                        $("#signUpForm").hide();
                        $("#signUpFinished").show('fast');
                    }
                    show_message(data.message, data.class);
                }, 'json');
            }

        });

        $("#signUpFinished").on("submit", function (event) {
            event.preventDefault();

            var email = $("#email").val();
            var code = $("#code").val();
            var name = $("#name").val();
            var password = $("#password").val();
            if (name.length === 0) {
                show_message("name is very small!!!!");
            }else if (password.length < 6) {
                show_message("passwod is very small(min: 6 char)!!!!");
            } else {

                $.post("<?= $app->getUrl() ?>signup.php", {email: email,code: code,name: name,password: password,submit: 'finished'}, function (data) {
                    if (data.ok === true) {
                        document.location.href = '<?= $app->getUrl().'signin.php' ?>'
                    }
                    show_message(data.message, data.class);
                }, 'json');
            }

        });


    });
</script>
</html>