<div class="row">
    <div  id="reload_div">
        <div class="col-md-12" id="tableWrap">
            <table class="table table-scroll table-striped" border="1" id="prod_code_tbl">
                <thead>
                    <tr>
                        <td class="center" colspan="9"><h3>INVOICE NO: <?php echo $invoice_detail[0]['invoice_no'];?></h3>
                            <a target="_blank" href="<?php echo base_url();?>access/print_invoice_again/<?php echo $invoice_detail[0]['invoice_id'];?>" class="btn btn-success btn-md">
                                <span class="glyphicon glyphicon-print"></span> Print
                            </a>
                            <a target="" href="<?php echo base_url();?>access/editInvoice/<?php echo $invoice_detail[0]['invoice_no'];?>/<?php echo $invoice_detail[0]['invoice_id'];?>" class="btn btn-primary btn-md">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th class="center">Product Code</th>
                        <th class="center">Brand</th>
                        <th class="center">Category</th>
                        <th class="center">Item</th>
                        <th class="center">Size</th>
                        <th class="center">Price</th>
                        <th align="center">Discount(%)</th>
                        <th align="center">Net Price</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($invoice_detail as $v){ ?>

                    <tr>
                        <td class="center"><?php echo $v['product_code'];?></td>
                        <td class="center"><?php echo $v['brand_name'];?></td>
                        <td class="center"><?php echo $v['category_name'];?></td>
                        <td class="center"><?php echo $v['item_name'];?></td>
                        <td class="center"><?php echo $v['size'];?></td>
                        <td class="center"><?php echo $v['sale_price'];?></td>
                        <td align="center">
                            <?php echo $v['discount_percentage'];?>
                        </td>
                        <td align="center">
                            <?php echo $v['net_price'];?>
                        </td>
                    </tr>

                    <?php } ?>

                </tbody>
               <tfoot>
                   <tr>
                       <td colspan="4"></td>
                       <td class="center">Total</td>
                       <td class="center" align="center"><?php echo $invoice_detail[0]['total_price'];?></td>
                       <td></td>
                       <td class="center" align="center"><?php echo $invoice_detail[0]['total_net_price'];?></td>
                   </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php
$array_size = sizeof($invoice_return);
if($array_size > 0){
?>
<div class="row">
    <div  id="reload_div">
        <div class="col-md-12" id="tableWrap">
            <table class="table table-scroll table-striped" border="1" id="prod_code_tbl">
                <thead>
                <tr>
                    <td class="center" colspan="7"><h3>Returned Products</h3></td>
                </tr>
                <tr>
                    <th class="center">Product Code</th>
                    <th class="center">Brand</th>
                    <th class="center">Category</th>
                    <th class="center">Item</th>
                    <th class="center">Size</th>
                    <th class="center">Price</th>
                    <th class="center">Discount</th>
                    <th class="center">Net Price</th>

                </tr>
                </thead>
                <tbody>

                <?php foreach ($invoice_return as $r){ ?>

                    <tr>
                        <td class="center"><?php echo $r['product_code'];?></td>
                        <td class="center"><?php echo $r['brand_name'];?></td>
                        <td class="center"><?php echo $r['category_name'];?></td>
                        <td class="center"><?php echo $r['item_name'];?></td>
                        <td class="center"><?php echo $r['size'];?></td>
                        <td class="center"><?php echo $r['sale_price'];?></td>
                        <td class="center"><?php echo $r['return_discount_percentage'];?></td>
                        <td class="center"><?php echo $r['return_net_price'];?></td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>