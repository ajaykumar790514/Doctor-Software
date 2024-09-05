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
                           
                           
                            <div class="card-content collapse show" id="tb">
                                <div class="row justify-content-center p-1">
                                    <div class="col-md-12">
                                        <form class="form ajaxsubmit reload-page" action="<?=base_url()?>notification/send" method="POST" enctype="multipart/form-data">
                                          
                                            <div class="form-group">
                                                <label for="template_id">Template</label>
                                                <select id="template_id" name="template_id" class="form-control input-sm ">
                                                <?php
                                                foreach ($templates as $key => $value) {
                                                    echo optionStatus($key,$value);
                                                }
                                                ?>
                                                </select>
                                            </div>
                                            

                                            <div class="form-group col-md-6 pl-0">
                                                <label for="individual_topic">Individual/Topic</label>
                                                <select id="individual_topic" name="individual_topic" class="form-control input-sm ">
                                                <?php
                                                $array = array('topic'=>'Topic','individual'=>'Individual');
                                                foreach ($array as $key => $value) {
                                                    echo optionStatus($key,$value);
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6 pr-0 topic">
                                                <label for="topic">Topic</label>
                                                <select id="topic" name="topic" class="form-control input-sm ">
                                                <?php
                                                $array = array('mylastwishall'=>'mylastwishall');
                                                foreach ($array as $key => $value) {
                                                    echo optionStatus($key,$value);
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6 pr-0 collapse app_user">
                                                <label for="app_user">App User</label>
                                                <select id="app_user" name="app_user" class="form-control input-sm ">
                                                <?php
                                                
                                                foreach ($app_users as $key => $value) {
                                                    echo optionStatus($key,$value);
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="template">
                                                
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

<script type="text/javascript">
    $('body').on('change','[name=individual_topic]',function(){
        var $this = $(this);
        $('.topic').toggle();
        $('.app_user').toggle();
    })

    $('body').on('change','[name=template_id]',function(){
        $('.template').html('');
        var id = $(this).val();
        $('.template').load('<?=base_url()?>notification/template-details/'+id);
    })
</script>