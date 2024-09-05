<div class="card-body card-dashboard">
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
            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                <label>
                    <input type="search" class="form-control form-control-sm static-tb-search" tbtarget="#mytable"  placeholder="Search" aria-controls="DataTables_Table_0" >
                </label>
            </div>
        </div>
    </div>
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr>
                   <th>Sr. no.</th>
                   <th>Title</th>
                   <th class="text-center">Order</th>
                   <th class="text-center">Status</th>
                   <th style="width: 180px;">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=0;
               foreach ($rows as $row) { 
                if ($row->is_parent==0) { ?>
               <tr >
                   <td class="sr_no"><?=++$i?></td>
                   <td><?=$row->name?></td>
                   <td class="text-center">
                        <input type="number" value="<?=$row->order?>" data="<?=$row->id?>,products_category,id,order" class="change-indexing" min="0">
                    </td>
                   
                   <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($row->active==1) ? 0 : 1?>" data="<?=$row->id?>,products_category,id,active" ><i class="<?=($row->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                  
                   <td>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Category - <?=$row->name?>" data-url="<?=$update_url?><?=$row->id?>" title="Update">
                           <i class="la la-pencil-square"></i>
                       </a>

                       <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->id?>" title="Delete" >
                           <i class="la la-trash"></i>
                       </a>
                   </td>
               </tr> 

                   <?php $j=0;
                   foreach ($rows as $c_row) { 
                    if ($c_row->is_parent==$row->id) { ?>
                    <tr class="sr_no">
                       <td class="text-right"><?=++$j?></td>
                       <td><?=nbs(5)?><?=$c_row->name?></td>
                       <td class="text-center">
                            <input type="number" value="<?=$c_row->order?>" data="<?=$c_row->id?>,products_category,id,order" class="change-indexing" min="0">
                        </td>
                       <!-- <td><?=$c_row->indexing?></td> -->
                       
                       <td class="text-center">
                           <span class="changeStatus" data-toggle="change-status" value="<?=($c_row->active==1) ? 0 : 1?>" data="<?=$c_row->id?>,products_category,id,active" ><i class="<?=($c_row->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                       </td>
                      
                       <td>
                           <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Category - <?=$c_row->name?>" data-url="<?=$update_url?><?=$c_row->id?>" title="Update">
                               <i class="la la-pencil-square"></i>
                           </a>

                           <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$c_row->id?>" title="Delete" >
                               <i class="la la-trash"></i>
                           </a>
                       </td>
                   </tr> 
                   <?php } } ?>


               <?php } } ?>
               
               
           </tbody>
           
       </table>

   </div>

 
<!-- </div> -->
