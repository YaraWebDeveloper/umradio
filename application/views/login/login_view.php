<!DOCTYPE html>
<?php
$Color = $this->color_library->getRandomColor();
?>
<html class="bg-<?php echo $Color ?>">
    <head>
        <meta charset="UTF-8">
        <title>AdminRYM | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url('themes/admin') ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('themes/admin') ?>/css/font_awesome/font-awesome.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('themes/admin') ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-<?php echo $Color ?>">
        <?php if (validation_errors() != null || $mensaje_error != ''): ?>
            <div class="alert fade in">
                <?php
                echo validation_errors();
                if ($mensaje_error != ''):
                    echo $mensaje_error;
                endif;
                ?>
            </div>
        <?php endif; ?>
        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <?php echo form_open("login/iniciarSesion"); ?>
            <div class="body bg-gray">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Usuario" name="text_user" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contraseña" name="text_contrasena" />
                </div>          
                <!--div class="form-group">
                    <input type="checkbox" name="remember_me"/> Remember me
                </div-->
            </div>
            <div class="footer">  
                <input type="submit" class="btn bg-olive btn-block" value="Entrar" name="ingresar">
                <!--p><a href="#">I forgot my password</a></p>
                <a href="register.html" class="text-center">Register a new membership</a-->
            </div>
            <?php echo form_close(); ?>
        </div>

        <script src="<?php echo base_url('themes/admin') ?>/js/jquery.min.js"></script>
        <script src="<?php echo base_url('themes/admin') ?>/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>

