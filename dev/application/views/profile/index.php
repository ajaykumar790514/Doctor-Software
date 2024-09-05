<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block"><?=$title?></h3>
            </div>
        </div>
        <div class="content-body">
            <!-- Base style table -->
            <section id="base-style">
                <div class="row">

                    <style type="text/css">
                        .profile-pic{
                            position: relative;
                            width: 150px;
                            height: 150px;
                            margin-bottom: 15px;
                            border-radius: 50%;
                            border: 2px solid blueviolet ;

                        }

                        .profile-pic input{
                            display: none;
                            
                        }
                        .profile-pic img{
                            position: absolute;
                            width: 100%;
                            max-width: 150px;
                            height: 100%;
                            max-height: 150px;
                            border-radius: 50%;
                            border: 2px solid blueviolet ;

                        }
                        .profile-pic label{
                                position: absolute;
                                bottom: 0;
                                margin: auto;
                                text-align: center;
                                height: 22%;
                                color: white;
                                /* background: #80808075; */
                                width: 100%;
                                cursor: pointer;
                                z-index: 0;
                        }
                    </style>

                    <div class="col-md-12">
                        <form class="form ajaxsubmit reload-page" action="<?=base_url()?>profile/update" method="POST" enctype="multipart/form-data">
                            <div class="profile-pic">
                                <div></div>
                                <input id="profile-pic" type="file" class="onchange-submit" accept="image/*" name="photo">
                                <img  src="<?=img_base_url()?><?=$user->photo?>" alt="<?=$user->name?>">
                                <label for="profile-pic">Change</label>
                            </div>

                        </form>
                       
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                           
                           
                            <div class="card-content collapse show" id="tb">
                                <div class="row justify-content-center p-1">
                                    <div class="col-md-12">
                                        <form class="form ajaxsubmit reload-page" action="<?=base_url()?>profile/update" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="duration">Name <sup>*</sup></label>
                                                <input type="text" class="form-control" placeholder="Name" name="name" value="<?=$user->name?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="duration">Email <sup>*</sup></label>
                                                <input type="text" class="form-control" placeholder="Email" name="email" value="<?=$user->email?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="duration">Username <sup>*</sup></label>
                                                <input type="text" class="form-control" placeholder="Username" name="username" value="<?=$user->username?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="duration"><br></label>
                                                <input type="submit" class="btn btn-primary btn-sm" placeholder="Duration" name="name" value="Update">
                                            </div>
                                        </form>
                                    </div>

                                    
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                           
                           
                            <div class="card-content collapse show" id="tb">
                                <div class="row justify-content-center p-1">
                                    

                                    <div class="col-md-12">

                                        <form class="form ajaxsubmit reload-page" action="<?=base_url()?>profile/change-password" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="duration">Old Password <sup>*</sup></label>
                                                <input type="password" class="form-control" placeholder="Old Password" name="old_password" >
                                            </div>

                                            <div class="form-group">
                                                <label for="duration">New Password <sup>*</sup></label>
                                                <input type="password" class="form-control" placeholder="New Password" name="password" >
                                            </div>

                                            <div class="form-group">
                                                <label for="duration">Confirm password <sup>*</sup></label>
                                                <input type="password" class="form-control" placeholder="Confirm password" name="conf_password" >
                                            </div>

                                            <div class="form-group">
                                                <label for="duration"><br></label>
                                                <input type="submit" class="btn btn-primary btn-sm" placeholder="Duration" name="name" value="Change Password">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Base style table -->
        </div>
    </div>
</div>
<!-- END: Content-->

