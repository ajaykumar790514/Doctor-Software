<div class="card-body card-dashboard">
    <p class="card-text">............</p>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <!-- <div class="dataTables_length" id="DataTables_Table_0_length">
                <label>
                    Show 
                    <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control form-control-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> 
                    entries
                </label>
            </div> -->
        </div>
        <div class="col-sm-12 col-md-6">
           <!--  <div id="DataTables_Table_0_filter" class="dataTables_filter">
                <label>
                    <input type="search" class="form-control form-control-sm" id="tb-search" placeholder="Search" aria-controls="DataTables_Table_0" >
                </label>
            </div> -->
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered base-style" id="myTable">
            <thead>
                <tr>
                    <th>Sr. no.</th>
                    <th>Name</th>
                    <th int>Actual Price</th>
                    <th int>Discounted Price</th>
                    <th int>Duration</th>
                    <th int>Space</th>
                    <th class="text-center">Status</th>
                    <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=$page;
                foreach ($rows as $row) { ?>
                <tr>
                    <td><?=++$i?></td>
                    <td><?=$row->name?></td>
                    <td int> ₹ <?=$row->actual_price?></td>
                    <td int> ₹ <?=$row->discounted_price?></td>
                    <td int><?=$row->duration?> Days</td>
                    <td int> <?=$row->space?> Mb</td>
                    <td class="text-center">
                        <span class="changeStatus" onclick='changeStatus(this)' value="<?=($row->status==1) ? 0 : 1?>" data="<?=$row->id?>,plan_master"><i class="<?=($row->status==1) ? 'la la-check-circle' : 'icon-close'?>"></i></span>
                    </td>
                   
                    <td>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Plan Details" data-url="<?=$details_url[0]?><?=$row->id?>">
                            <i class="la la-info"></i>
                        </a>

                        <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal-xl" data-whatever="Update <?=$index_url[1]?>" data-url="<?=$create_url[0]?>/<?=$row->id?>">
                            <i class="la la-pencil-square"></i>
                        </a>
                        
                    </td>
                </tr> 
                <?php
                }
                ?>
            </tbody>
            
        </table>

    </div>
    <div class="row">
        <div class="col-md-6 text-left">
            <span>Showing <?=$page+1?> to <?=$i?> of <?=$total_rows?> entries</span>
        </div>
        <div class="col-md-6 text-right">
            <?=$links?>
        </div>
    </div>
    
</div>

<script type="text/javascript">
    if ('<?=$search?>'!='') {
        $('#tb-search').val('<?=$search?>').focus();
    }
</script>

