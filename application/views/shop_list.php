<div class="form-group">
    <label class="col-md-2"><b>Shop</b> <span style="color: red;">*</span></label>
    <div class="col-md-2">
        <select name="shop" id="shop" class="form-control" required>
            <option value="">Select Shop</option>
            <?php foreach ($shops as $s){ ?>
                <option value="<?php echo $s['shop_name'];?>"><?php echo $s['shop_name'];?></option>
            <?php } ?>
        </select>
    </div>
</div>