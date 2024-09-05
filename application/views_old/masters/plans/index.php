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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                               <h4 class="card-title"><a href="javascript:void(0)" data-toggle="modal" data-target="#showModal-xl" data-whatever="New <?=$index_url[1]?>" data-url="<?=$create_url[0]?>" class="btn btn-primary btn-sm"><i class="ft-plus"></i> <?=$create_url[1]?></a></h4>

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

                            <div class="card-header p-1">
                               

                                <form autocomplete="off" class="form dynamic-tb-search" action="<?=$tb_url?>" 
                                          method="POST" enctype="multipart/form-data" tagret-tb="#tb" >
                                        
                                        <div class="row justify-content-center">
                                            
                                            <div class="col-md-2">
                                                    <div class="form-group mb-0">
                                                        <label for="status">Status</label>
                                                        <select id="status" name="status" class="form-control input-sm ">
                                                        <?php
                                                            echo optionStatus('',' All ');
                                                            echo optionStatus('active',' Active  ');
                                                            echo optionStatus('inactive',' Inactive  ');
                                                            
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                
              

                                            <div class="col-md-3">
                                                <div class="form-group mb-0">
                                                    <label for="discount_amount">Search</label>
                                                    <input autocomplete="false"  name="search" id="search" class="form-control input-sm" placeholder="Name" />
                                                </div>

                                            </div>


                                            <div class="col-auto">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm mt-2 mr-1"> Filter</button>
                                                    <button type="reset" class="btn btn-danger btn-sm mt-2"> Reset</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </form>
                            </div>
                           
                            <div class="card-content collapse show" id="tb">
                                

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

