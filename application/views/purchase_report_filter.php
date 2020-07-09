<table class="display table table-bordered table-striped" id="profit_loss">
    <thead>
    <tr>
        <th class="hidden-phone center">Purchase Date</th>
        <th class="hidden-phone center">Brand</th>
        <th class="hidden-phone center">Category</th>
        <th class="hidden-phone center">Item</th>
        <th class="hidden-phone center">Quantity</th>
        <th class="hidden-phone center">Purchase Price</th>
        <th class="hidden-phone center">Shop</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $total_purchase_price = 0;
    $total_purchase_qty = 0;

    $count=0;

    foreach ($purchase_report as $v){
        $total_purchase_price += $v['total_purchase_price'];
        $total_purchase_qty += $v['total_purchase_qty'];

        ?>
        <tr>
            <td class="center"><?php echo $v['purchase_date'];?></td>
            <td class="center"><?php echo $v['brand_name'];?></td>
            <td class="center"><?php echo $v['category_name'];?></td>
            <td class="center"><?php echo $v['item_name'];?></td>
            <td class="center"><?php echo $v['total_purchase_qty'];?></td>
            <td class="center"><?php echo $v['total_purchase_price'];?></td>
            <td class="center"><?php echo $v['shop'];?></td>
        </tr>
        <?php
        $count++;
    }

    ?>
    </tbody>
    <tfoot>
    <tr>
        <td class="" colspan="4" align="right"><h4><b>Total</b></h4></td>
        <td class="center"><h4><b><?php echo $total_purchase_qty;?></b></h4></td>
        <td class="center"><h4><b><?php echo $total_purchase_price;?></b></h4></td>
        <td class="center" colspan="2"></td>
    </tr>
    </tfoot>
</table>