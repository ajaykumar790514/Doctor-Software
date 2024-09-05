      
             <label for="">Select Treatment</label>
            <select name="treatment" id="treatment" class="form-control treatment" required>
                <option value="">--Select Treatment --</option>
                <?php foreach($treatment as $t):?>
                <option value="<?=$t->id;?>"><?=$t->title;?> ( <?=$t->duration;?>min )</option>
                <?php  endforeach;?>
            </select>
            <div id="treatment_btn"></div>
            <input type="hidden" id="treatment_id" class="treatment_id">