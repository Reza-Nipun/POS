 <table class="display table table-bordered table-striped" id="dynamic-table">
   <thead>
    <tr>
      <th class="hidden-phone center">Product Code</th>
      <th class="hidden-phone center">Brand</th>
      <th class="hidden-phone center">Category</th>
      <th class="hidden-phone center">Item</th>
      <th class="hidden-phone center">Size</th>
  <?php if($access_level == 1){ ?>
      <th class="hidden-phone center">Purchase Date</th>
      <th class="hidden-phone center">Purchase Price</th>
  <?php } ?>
      <th class="hidden-phone center">Sale Price</th>
<!--                      <th class="hidden-phone center">Picture</th>-->
      <th class="hidden-phone center">Updated</th>
<!--                      <th class="hidden-phone center">Status</th>-->
  <?php if($access_level == 1){ ?>
      <th class="hidden-phone center">Shop</th>
  <?php } ?>
      <th class="hidden-phone center">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($products as $v){?>
    <tr>
        <td class="center"><?php echo $v['product_code'];?></td>
        <td class="center"><?php echo $v['brand_name'];?></td>
        <td class="center"><?php echo $v['category_name'];?></td>
        <td class="center"><?php echo $v['item_name'];?></td>
        <td class="center"><?php echo $v['size'];?></td>
    <?php if($access_level == 1){ ?>
        <td class="center"><?php echo $v['purchase_date'];?></td>
        <td class="center"><?php echo $v['purchase_price'];?></td>
    <?php } ?>
        <td class="center"><?php echo $v['sale_price'];?></td>
        <td class="center" title="<?php echo $v['updated_by_user'];?>">
            <?php
            if($v['update_date'] != '0000-00-00 00:00:00'){
                echo $v['update_date'];
            }
            ?>
        </td>
<!--                        <td class="center">--><?php //echo $v['picture_url'];?><!--</td>-->
<!--                        <td class="center">-->
<!--                            --><?php
//                            if($v['status'] == 1){
//                                echo "Active";
//                            }
//                            if($v['status'] == 0){
//                                echo "Inactive";
//                            }
//                            ?>
<!--                        </td>-->
    <?php if($access_level == 1){ ?>
        <td class="hidden-phone center"><?php echo $v['shop'];?></td>
    <?php } ?>
        <td class="center">
            <?php
            if($access_level == 1){
            if($v['status'] == 0){ ?>
                <!--<a href="<?php echo base_url();?>access/updateProductStatus/<?php echo $v['id']?>/1" class="btn btn-success" style="cursor: pointer;">Active</a>-->
            <?php } ?>
            <?php if($v['status'] == 1){ ?>
                <!--<a href="<?php echo base_url();?>access/updateProductStatus/<?php echo $v['id']?>/0" class="btn btn-danger" style="cursor: pointer;">Inactive</a>-->
            <?php } ?>
            <a href="<?php echo base_url();?>access/editProduct/<?php echo $v['id'];?>" class="btn btn-primary" style="cursor: pointer;">Edit</a>
            <a target="_blank" href="<?php echo base_url();?>access/print_sticker/<?php echo $v['product_code'];?>" class="btn btn-warning" style="cursor: pointer;">Print Sticker</a>
            <?php } ?>
            <?php if($v['shop'] == 'RUPNAGAR'){ ?>
                <a href="<?php echo base_url();?>access/transfer_shop/<?php echo $v['product_code'];?>/<?php echo $v['shop'];?>/LOLONA" onclick="return confirm('Do You Want To Transfer This Product?');" class="btn btn-success" style="cursor: pointer;">Send To LOLONA</a>
            <?php } ?>
            <?php if($v['shop'] == 'LOLONA'){ ?>
                <a href="<?php echo base_url();?>access/transfer_shop/<?php echo $v['product_code'];?>/<?php echo $v['shop'];?>/RUPNAGAR" onclick="return confirm('Do You Want To Transfer This Product?');" class="btn btn-success" style="cursor: pointer;">Send To RUPNAGAR</a>
            <?php } ?>
        </td>
    </tr>
  <?php } ?>
  </tbody>
</table>