<table class="display table table-bordered table-striped" id="profit_loss">
    <thead>
    <tr>
        <th class="hidden-phone center">Sale Date</th>
        <th class="hidden-phone center">Product Code</th>
        <th class="hidden-phone center">Brand</th>
        <th class="hidden-phone center">Category</th>
        <th class="hidden-phone center">Item</th>
        <th class="hidden-phone center">Size</th>
        <th class="hidden-phone center">Invoice No</th>
        <th class="hidden-phone center">Sold By</th>
        <th class="hidden-phone center">Purchase Price</th>
        <th class="hidden-phone center">Sale Price</th>
        <th class="hidden-phone center">Discount(%)</th>
        <th class="hidden-phone center">Net Price</th>
        <th class="hidden-phone center">Discount Reference</th>
        <th class="hidden-phone center">Shop</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $total_purchase_price = 0;
    $total_sale_price = 0;
    $total_discount_percentage = 0;
    $discount_price = 0;
    $total_discount_price = 0;
    $average_discount_percentage = 0;

    $count = 0;

    foreach ($profit_loss_report as $v){
        $total_purchase_price += $v['purchase_price'];
        $total_sale_price += $v['sale_price'];
        $total_discount_percentage += $v['discount_percentage'];

//        $discount_price = ($v['sale_price'] - (($v['discount_percentage']/100)*$v['sale_price']));
//        $total_discount_price += $discount_price;
        $total_discount_price += $v['net_price'];

        ?>
        <tr>
            <td class="center"><?php echo $v['sale_date'];?></td>
            <td class="center"><?php echo $v['product_code'];?></td>
            <td class="center"><?php echo $v['brand_name'];?></td>
            <td class="center"><?php echo $v['category_name'];?></td>
            <td class="center"><?php echo $v['item_name'];?></td>
            <td class="center"><?php echo $v['size'];?></td>
            <td class="center"><?php echo $v['invoice_no'];?></td>
            <td class="center"><?php echo $v['user_name'];?></td>
            <td class="center"><?php echo $v['purchase_price'];?></td>
            <td class="center"><?php echo $v['sale_price'];?></td>
            <td class="center"><?php echo $v['discount_percentage'];?></td>
            <td class="center"><?php echo $v['net_price'];?></td>
            <td class="center"><?php echo $v['discount_reference'];?></td>
            <td class="center"><?php echo $v['shop'];?></td>
        </tr>
    <?php
        $count++;
    }
    $average_discount_percentage = $total_discount_percentage/$count;
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td class="" colspan="8" align="right"><h4><b>Total</b></h4></td>
        <td class="center"><h4><b><?php echo $total_purchase_price;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_sale_price;?></b></h4></td>
        <td class="center"><h4></h4></td>
        <!--<td class="center"><h4><b><?php // echo number_format((float)$average_discount_percentage, 2, '.', '');?></b></h4></td>-->
        <td class="center"><h4><b><?php echo number_format((float)$total_discount_price, 2, '.', '');?></b></h4></td>
        <td class="center"></td>
        <td class="center"></td>
    </tr>
    </tfoot>
</table>