<div class="card-content collapse show">
    <div class="card-body">
    <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr>
                <th>Sr.No.</th>
                <th>Attatchment File.</th>
               </tr>
           </thead>  
           <tbody>
            <?php $i=1;foreach($attach as $a):?>
            <tr>
                <td><?=$i;?></td>
                <td>
                    <a href="<?=IMGS_URL.$a->file;?>" target="_blank"><?=$a->file;?></a>
                </td>
            </tr>
            <?php $i++ ; endforeach;?>  
           </tbody>
       </table>
    </div>       
       
    </div>
    </div>