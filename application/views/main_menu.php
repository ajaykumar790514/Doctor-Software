<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true" data-img="<?=base_url()?>static/app-assets/images/backgrounds/04.jpg">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row position-relative">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="<?=base_url()?>"><img class="brand-logo" alt="Chameleon admin logo" src="<?=$logo?>" style="width: 80%;max-height: 50px;" />
                    <!-- <h3 class="brand-text"><?=$comp?></h3> -->
                </a></li>
            <li class="nav-item d-none d-md-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-disc font-medium-3" data-ticon="ft-disc"></i></a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="navigation-background"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <?=$menu?>


           <!--  <li class="nav-item has-sub hover">
                <a href="#">
                    <i class="la la-building"></i>
                    <span class="menu-title" data-i18n="">Accounts</span>
                </a>
                <ul class="menu-content" style="">
                    <li class="">
                        <a class="menu-item" href="http://localhost/sites/mrs/account">
                            Dashbord
                        </a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="http://localhost/sites/mrs/expenses">
                            Manage Expanses  
                        </a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>
<!-- END: Main Menu-->