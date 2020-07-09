<table class="display table table-bordered table-striped" id="profit_loss">
    <thead>
    <?php
    $total_result_found = 0;
    foreach ($inventory_report as $k => $v){
        $total_result_found++;
    }
    ?>
    <tr>
        <th class="hidden-phone center"><h4><b>Total Found</b></h4></th>
        <th class="hidden-phone" colspan="8"><h4><b><?php echo $total_result_found;?></b></h4></th>
    </tr>
    <tr>
        <th class="hidden-phone center">Product Code</th>
        <th class="hidden-phone center">Brand</th>
        <th class="hidden-phone center">Category</th>
        <th class="hidden-phone center">Item</th>
        <th class="hidden-phone center">Size</th>
        <th class="hidden-phone center">Purchase Date</th>
        <th class="hidden-phone center">Purchase Price</th>
        <th class="hidden-phone center">Sale Price</th>
        <th class="hidden-phone center">Shop</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $total_purchase_price = 0;
    $total_sale_price = 0;

    foreach ($inventory_report as $k => $v){

        $total_purchase_price += $v['purchase_price'];
        $total_sale_price += $v['sale_price'];
    ?>
        <tr>
            <td class="center"><?php echo $v['product_code'];?></td>
            <td class="center"><?php echo $v['brand_name'];?></td>
            <td class="center"><?php echo $v['category_name'];?></td>
            <td class="center"><?php echo $v['item_name'];?></td>
            <td class="center"><?php echo $v['size'];?></td>
            <td class="center"><?php echo $v['purchase_date'];?></td>
            <td class="center"><?php echo $v['purchase_price'];?></td>
            <td class="center"><?php echo $v['sale_price'];?></td>
            <td class="center"><?php echo $v['shop'];?></td>
        </tr>
    <?php
        }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td class="right" align="right" colspan="6"><h4><b>Total</b></h4></td>
        <td class="center"><h4><b><?php echo $total_purchase_price;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_sale_price;?></b></h4></td>
        <td class="center"></td>
    </tr>
    </tfoot>
</table>