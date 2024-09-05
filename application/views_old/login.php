<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Login </title>
    <link rel="apple-touch-icon" href="<?=base_url()?>static/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>static/app-assets/images/ico/favicon.ico">
    <!-- <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet"> -->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/pages/login-register.css">
   
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-color="bg-gradient-x-purple-red" data-col="1-column">
    <style type="text/css">
        form .error{
            width: 100%;
            text-align: center;
            color: red;
        }
        form .success{
            width: 100%;
            text-align: center;
        }
    </style>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="text-center mb-1">
                                        <img src="<?=base_url()?>static/app-assets/images/logo/logo.png" alt="branding logo" style="width: 80%;">
                                    </div>
                                    <div class="font-large-1  text-center">
                                        Member Login
                                    </div>
                                </div>
                                <div class="card-content">
                                    <!-- <div class="row">
                                        <div class="col-md-6">
                                            <button data-toggle="collapse-login" data-target-show="#admin-login" data-target-hide="#host-login" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue">Admin</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button data-toggle="collapse-login" data-target-show="#host-login" data-target-hide="#admin-login"  class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue">Host</button>
                                        </div>
                                    </div> -->
                                    <?php if(@$type=='admin') : ?>
                                    <div class="card-body pt-0 collapse show" id="admin-login">
                                        <form class="form-horizontal" id="login" action="<?=base_url()?>login" novalidate method="POST">
                                            <label class="error"></label> 
                                            <label class="success"></label> 
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control round" id="username" name="username" placeholder="Your Username"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control round" id="password" name="password" placeholder="Enter Password"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-lock"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-sm-left">

                                                </div>
                                                <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>

                                            </div>
                                            <div class="form-group text-center">
                                                <input type="hidden" name="type" value="admin">
                                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Login</button>
                                            </div>

                                        </form>
                                    </div>
                                    <?php else : ?>
                                    <div class="card-body pt-0 collapse show" id="host-login">
                                        <form class="form-horizontal" id="login2" action="<?=base_url()?>login" novalidate method="POST">
                                            <label class="error"></label> 
                                            <label class="success"></label> 
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control round" id="username" name="username" placeholder="Your Username"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control round" id="password" name="password" placeholder="Enter Password"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-lock"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-sm-left">

                                                </div>
                                                <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>

                                            </div>
                                            <div class="form-group text-center">
                                                <input type="hidden" name="type" value="host">

                                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Login</button>
                                            </div>

                                        </form>
                                    </div>
                                    <?php endif; ?>

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?=base_url()?>static/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url()?>static/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url()?>static/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/core/app.js" type="text/javascript"></script>

    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?=base_url()?>static/app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).on('click','[data-toggle="collapse-login"]',function(){
            var data_target_show = $(this).attr('data-target-show');
            var data_target_hide = $(this).attr('data-target-hide');

            $(data_target_show).removeClass('show');
            $(data_target_show).addClass('show');
            $(data_target_hide).removeClass('show');
            

            return false;
        })
        $(document).ready(function(){
            $('#login').submit(function(){
                $.post($(this).attr('action'),$(this).serialize())
                .done(function(data){
                    data = JSON.parse(data);
                    $('.'+data.res).html(data.msg);
                    if (data.res=='success') {
                        setTimeout(function() {
                            window.location.href = data.redirect_url;
                            // window.open(data.redirect_url,'_self');
                        }, 500);
                    }
                })

                return false;
            })
        })
    </script>
    
    <!-- END: Page JS-->
</body>
<!-- END: Body-->

</html>