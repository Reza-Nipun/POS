<table class="table table-scroll table-striped" id="profit_loss" border="1">
    <thead>
    <tr>
        <th class="hidden-phone center" colspan="3"><h4>Report Generation Date: <?php echo date('Y-m-d');?></h4></th>
        <th class="hidden-phone center" colspan="2">G. Total Purchase</th>
        <th class="hidden-phone center" colspan="3">G. Total Sold</th>
        <th class="hidden-phone center" colspan="3">G. Total Balance</th>
        <th class="hidden-phone center" rowspan="2">Shop</th>
    </tr>
    <tr>
        <th class="hidden-phone center">Brand</th>
        <th class="hidden-phone center">Category</th>
        <th class="hidden-phone center">Item</th>
        <th class="hidden-phone center">QTY</th>
        <th class="hidden-phone center">Price</th>
        <th class="hidden-phone center">QTY</th>
        <th class="hidden-phone center">Purchase Price</th>
        <th class="hidden-phone center">Net Price</th>
        <th class="hidden-phone center">QTY</th>
        <th class="hidden-phone center">Purchase Price</th>
        <th class="hidden-phone center">Sale Price</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $total_purchase_qty = 0;
    $total_purchase_price = 0;
    $total_sold_qty = 0;
    $total_sold_price = 0;
    $total_sold_purchase_price = 0;
    $total_net_sold_price = 0;
    $total_balance_qty = 0;
    $total_balance_purchase_qty = 0;
    $total_balance_sale_qty = 0;

    foreach ($summary_report as $k => $v){

        $total_purchase_qty += $v['total_purchase_qty'];
        $total_purchase_price += $v['total_purchase_price'];
        $total_sold_qty += $v['total_sold_qty'];
        $total_sold_price += $v['total_sold_price'];
        $total_sold_purchase_price += $v['total_sold_purchase_price'];
        $total_net_sold_price += $v['total_sold_net_price'];
        $total_balance_qty += $v['total_balance_qty'];
        $total_balance_purchase_qty += $v['total_balance_purchase_price'];
        $total_balance_sale_qty += $v['total_balance_sale_price'];
    ?>
        <tr>
            <td class="center"><?php echo $v['brand_name'];?></td>
            <td class="center"><?php echo $v['category_name'];?></td>
            <td class="center"><?php echo $v['item_name'];?></td>
            <td class="hidden-phone center"><?php echo $v['total_purchase_qty'];?></td>
            <td class="hidden-phone center"><?php echo $v['total_purchase_price'];?></td>
            <td class="hidden-phone center"><?php echo $v['total_sold_qty'];?></td>
            <td class="hidden-phone center"><?php echo $v['total_sold_purchase_price'];?></td>
            <td class="hidden-phone center"><?php echo number_format($v['total_sold_net_price'], 2, '.', '');?></td>
            <td class="hidden-phone center"><?php echo $v['total_balance_qty'];?></td>
            <td class="hidden-phone center"><?php echo $v['total_balance_purchase_price'];?></td>
            <td class="hidden-phone center"><?php echo $v['total_balance_sale_price'];?></td>
            <td class="hidden-phone center"><?php echo $v['shop'];?></td>
        </tr>
    <?php
        }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td class="right" align="right" colspan="3"><h4><b>Total</b></h4></td>
            <td class="center"><h4><b><?php echo $total_purchase_qty;?></b></h4></td>
            <td class="center"><h4><b><?php echo $total_purchase_price;?></b></h4></td>
            <td class="center"><h4><b><?php echo $total_sold_qty;?></b></h4></td>
            <td class="center"><h4><b><?php echo $total_sold_purchase_price;?></b></h4></td>
            <td class="center"><h4><b><?php echo number_format($total_net_sold_price, 2, '.', '');?></b></h4></td>
            <td class="center"><h4><b><?php echo $total_balance_qty;?></b></h4></td>
            <td class="center"><h4><b><?php echo $total_balance_purchase_qty;?></b></h4></td>
            <td class="center"><h4><b><?php echo $total_balance_sale_qty;?></b></h4></td>
            <td class="center"></td>
        </tr>
    </tfoot>
</table>