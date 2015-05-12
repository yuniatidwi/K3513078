<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Log in - Septiancheepy.esy.es</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url().'assets/';?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/';?>font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url().'assets/';?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="nim" class="form-control" placeholder="NIM"/>
                    </div>
                </div>
                <div class="footer">
		            	<?php if (isset($_GET['fail'])) {?>
			            <div class="callout callout-danger">
			            	<p>Nim salah, nim yang benar <span>K3513064</span></p>
			            </div>
			            <?php } ?>
                        <?php if (isset($_GET['warning'])) {?>
                        <div class="callout callout-danger">
                            <p>Anda harus login terlebih dahulu </p>
                        </div>
                        <?php } ?>
                    <button type="submit" class="btn bg-olive btn-block" name="submit" value="submit">Sign me in</button>
                </div>
            </form>

            <div class="margin text-center">
                <span>Septiancheepy.esy.es @ 2015</span>

            </div>
        </div>

        <script src="<?php echo base_url().'assets/';?>js/jquery.min.js"></script>
        <script src="<?php echo base_url().'assets/';?>js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
