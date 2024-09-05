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
                            <li class="breadcrumb-item">
                                <a href="<?=$back_url?>"> Website Properties</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Update Sub Property
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><a href="<?=$back_url?>" class="btn btn-primary btn-sm"><i class="ft-list"></i>  Website Properties</a></h4>
                                <a class="heading-elements-toggle">
                                    <i class="la la-ellipsis-v font-medium-3"></i>
                                </a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="collapse">
                                                <i class="ft-minus"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-action="reload">
                                                <i class="ft-rotate-cw"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-action="expand">
                                                <i class="ft-maximize"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-action="close">
                                                <i class="ft-x"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="card-text">
                                        <p>...........</p>
                                    </div>
    <!-- form -->
    <form class="form ajaxsubmit update-form reload-page" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body">
            <h4 class="form-section">
                <i class="la la-building"></i> Website Property</h4>
            <div class="form-group">
                <label for="heading">Heading</label>
                <input type="text" id="heading" class="form-control" placeholder="Heading" name="heading" value="<?=$row->heading?>">
            </div>

             <div class="form-group">
                <label for="subHeading">Sub. Heading</label>
                <input type="text" id="subHeading" class="form-control" placeholder="Sub. Heading" name="subHeading" value="<?=$row->subHeading?>">
            </div>
            <div class="row">
                <div class="col-md-12">
                   <label for="managername">Salected Flats</label>
                </div>

                <div class="col-md-12">
                    <div class="form-group" id="selected_flats">
                        <?=$selected_flats?>
                    </div>
                </div>
                <input type="hidden" name="flat_idsss" id="flat_idsss" value="<?=$row->flat_ids?>," >
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Properties</label><br>
                            <select class="propChange filter" id="state" textAddon="s">
                                <?=$states?>
                            </select>

                            <select class="propChange filter" id="city" textAddon="c">
                                <?php echo optionStatus('','-- Select --',1); ?>
                            </select>
                            <input id="propInput" class="filter" type="text" placeholder="Search..">
                        <ul id="propList">
                            
                        <?php
                        foreach ($properties as $row) {
                            echo "<li>";
                            echo checkbox('properties',$row->id,$row->propname,$row->status);
                            echo "</li>";
                        }
                        ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 flat">
                    <div class="form-group">
                        <label for="flat_no">Flat</label>
                        <ul>
                            <?php
                        foreach ($flats as $row) {
                        echo "<li class='collapse pro-$row->propid' >";
                            $fname = $row->flat_name.' ( '.$row->flat_no.' )';
                            echo checkbox('flat_ids[]',$row->flat_id,$fname,$row->status,$row->checked);
                        echo "</li>";

                        }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions text-right">
            <button type="reset" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary mr-1">
                <i class="ft-check"></i> Save
            </button>
        </div>
    </form>
    <!-- End: form -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>

    </div>
</div>
<!-- END: Content -->
<script type="text/javascript">
    $('#state').change(function() {
        var id = $(this).val();
        $('#city').load('<?=base_url()?>getCities/'+id);
    })

    $(document).on('change keyup','.filter',function(event) {
        var state  = $('#state').val();
        var city   = $('#city').val();
        var search = $('#propInput').val();
        $.post('<?=base_url()?>website/properties/propmasters',{state:state,city:city,search:search})
        .done(function(data) {
            $('#propList').html(data);
        })
    })
</script>
