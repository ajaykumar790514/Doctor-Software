


<div class="content-wrapper">
    <!-- <div class="content-wrapper-before"></div> -->
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section id="minimal-statistics-bg">
            <div class="row">
                <div class="col-12 mt-3 mb-1">
                    <!-- <h4 class="text-uppercase">Statistics</h4> -->
                    <!-- <p></p> -->
                </div>
            </div>
            <div class="row">
                <?php $clinics = $this->model->getData('clinics',['is_deleted'=>'NOT_DELETED','active'=>'1']);$i=0; foreach($clinics as $clinic):?>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card <?php if($i==0){ echo "bg-gradient-x-purple-blue"; }elseif($i==1){ echo "bg-gradient-x-purple-red";}elseif($i==2){ echo "bg-gradient-x-blue-green";}elseif($i==3){ echo " bg-gradient-x-orange-yellow";}elseif($i==4){ echo "bg-gradient-x-purple-blue";}elseif($i==5){ echo "bg-gradient-x-blue-green";}else{ echo "bg-gradient-x-purple-red";}?>">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-top">
                                        <i class="icon-users icon-opacity text-white font-large-4 float-left"></i>
                                    </div>
                                    <div class="media-body text-white text-right align-self-bottom mt-3">
                                        <span class="d-block mb-1 font-medium-1"><?=$clinic->name.'  ( '.$clinic->code;?></span>
                                        <h1 class="text-white mb-0"><?=PatCount($clinic->id);?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; endforeach;?> 
            </div>
            <div class="row">
                
                

              
            </div>
        </section>
    </div>
</div>

