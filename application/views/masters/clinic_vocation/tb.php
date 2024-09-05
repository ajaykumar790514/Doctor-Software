<div class="card-body card-dashboard">
    <div class="table-responsive">
        <table class="table table-striped table-bordered base-style" id="myTable">
            <thead>
                <tr>
                    <th>Sr. no.</th>
                    <th>Clinic </th>
                    <th>Date</th>
                    <th>Day</th>
                    <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=$page;
                foreach ($rows as $row) { ?>
                <tr>
                    <td><?=++$i?></td>
                    <td><?=$row->name?>  (  <?=$row->code?> )</td>
                    <td><?=date('d-m-Y',strtotime($row->date))?></td>
                    <td><?=date('l',strtotime($row->date))?></td>
                    <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Vocation - <?=$row->name?>  (  <?=$row->code?> )" data-url="<?=$update_url?><?=$row->id?>" title="Update Vocation">
                           <i class="la la-pencil-square"></i>
                       </a>
                        <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->id?>" title="Delete Vocation" >
                           <i class="la la-trash"></i>
                       </a></td>
                </tr> 
                <?php
                }
                ?>
            </tbody>
            
        </table>

    </div>
    <div class="row">
        <div class="col-md-6 text-left">
            <span>Showing <?= (@$rows) ? $page+1 : 0 ?> to <?=$i?> of <?=$total_rows?> entries</span>
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

