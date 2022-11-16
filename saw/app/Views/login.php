<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Aplikasi SPK Metode SAW CodeIgniter 4</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>">

    <link rel="shortcut icon" href="<?= base_url('assets/images/icon.png') ?>" type="image/x-icon">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-box-body">
            <div class="text-center">
                <img src="<?php echo base_url('assets/images/icon.png'); ?>" alt="Logo" width="150">
            </div>
            <br>
            <?php echo session()->getFlashdata('pesan'); ?>
            <form action="<?php echo base_url('login/cek'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username" required value="<?= old('username') ?>">
                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <a href="<?= base_url('register') ?>" class="btn btn-default btn-block btn-flat">Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jQuery-2.1.4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>