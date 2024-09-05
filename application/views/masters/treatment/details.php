<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block"><?=$title?></h3>
                <div class="breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?=base_url()?>">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <?=$title?>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Base style table -->
            <section id="base-style">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            <!-- <h3 class="float-left">Date : <?=$currentdate;?></h3> -->
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                   
                                </div>
                            </div>
                            <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <?php 
                                      $rs = $this->model->getRow('clinics',['id'=>$treatment->clinic_id]);
                                      if ($treatment->photos != null) {
                                          $result =  '<img src="' . IMGS_URL.$treatment->photos . '" height="200px" width="70%" >';
                                      } else {
                                          $result = '<h1 style="height:70px;width:70px;border-radius:10px;padding-top:15px;font-size:3rem;text-align:center;text-transform:capitalize;background:#7271CF;color:#FFF">' . substr($treatment->title, 0, 1) . '</h1>';
                                      }
                                       echo $result;
                                      ?>
                                </div>
                                <div class="col-8 card ">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive ">
                                        <table class="table table-bordered base-style" id="mytable">
                                        <thead>
                                        <tr>
                                            <th>Title </th>
                                            <th>Duration </th>
                                            <th>Video URL</th>
                                            <th>Advance Amount for Appointment</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><b><?=$treatment->title;?></b></td>
                                            <td><?=$treatment->duration;?> min</b></td>
                                            <td> <b><a href="<?=$treatment->video_url;?>" target="_blank"><?=$treatment->video_url;?></a></b></td>
                                            <td><b><?=$treatment->appointment_advance;?></b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                </div>
                                <hr>
                                <div class="col-12 mt-3">
                                    <h4 style="text-transform: uppercase;"><u>Description</u></h4>
                                     <?=$treatment->description;?>
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


