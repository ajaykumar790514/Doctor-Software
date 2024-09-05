<div class="card-body card-dashboard">
   <p class="card-text text-danger">Please do not modify</p>
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
                    <input type="search" class="form-control form-control-sm" id="tb-search" placeholder="Search" aria-controls="DataTables_Table_0" >
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
                   <th>Description</th>
                   <th>Menus & Permissions</th>
                   <th class="text-center">Status</th>
                   <th style="width: 180px;">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=0;
               foreach ($rows as $row) { 
                if ($row->name!='developer') { ?>
               <tr>
                   <td><?=++$i?></td>
                   <td><?=$row->name?></td>
                   <td><?=$row->description?></td>
                   <td>
                       <!-- <ol>
                        <?php foreach ($row->propnames as $propnames) {
                          echo "<li>";
                          echo $propnames;
                          echo "</li>";
                        }
                        ?>
                        </ol> -->

                        <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Menu Access - <?=$row->name?>" data-url="<?=$m_access_url?><?=$row->id?>" class="btn btn-primary btn-sm"> Manage </a>
                   </td>
                   <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($row->status==1) ? 0 : 1?>" data="<?=$row->id?>,tb_user_role,id,status" ><i class="<?=($row->status==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                  
                   <td>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Admin Menu - <?=$row->name?>" data-url="<?=$update_url?><?=$row->id?>" title="Update">
                           <i class="la la-pencil-square"></i>
                       </a>
                   </td>
               </tr> 

                   


               <?php } } ?>
               
               
           </tbody>
           
       </table>

   </div>

 
<!-- </div> -->
