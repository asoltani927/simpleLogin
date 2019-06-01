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


        Hi <strong><?= htmlentities($app->auth->user_name) ?></strong>;Welcome to dashboard, <a href="<?= $app->getUrl() ?>logout.php">logout</a>


    </div>
</div>

</body>

<script src="<?= $app->getUrl() ?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?= $app->getUrl() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= $app->getUrl() ?>assets/js/npm.js" type="text/javascript"></script>
</html>