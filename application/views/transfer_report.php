<div class="pull-left breadcrumb_admin clear_both">
    <div class="pull-left page_title theme_color">
        <h1>Shop Transfer Report</h1>
        <h2 class="">Shop Transfer...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Shop Transfer Report</li>
        </ol>
    </div>
</div>
<div class="container clear_both padding_fix">
    <!--\\\\\\\ container  start \\\\\\-->
    <div class="row">
        <div class="col-md-12">
            <div class="block-web">
                <div class="header">
                    <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                    <h3 class="content-header">Shop Transfer</h3>
                </div>

                <div class="porlets-content">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <select name="shop" id="shop" class="form-control" required>
                                    <option value="">From Shop...</option>
                                    <?php foreach ($shops as $s){ ?>
                                        <option value="<?php echo $s['shop_name']?>"><?php echo $s['shop_name']?></option>
                                    <?php } ?>
                                </select>
                                <span><b>* Select From Shop</b></span>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="purchase_date" id="from_date" placeholder="From Date: mm-dd-yyyy" class="form-control form-control-inline input-medium default-date-picker" required />
                                <span><b>* Enter From Date</b></span>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="purchase_date" id="to_date" placeholder="To Date: mm-dd-yyyy" class="form-control form-control-inline input-medium default-date-picker" required />
                                <span><b>* Enter To Date</b></span>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="submit_btn" onclick="getTransferReport();">Search</button>
                            </div>
                        </div>
                    </div>
                    <br />

                    <div class="row">
                        <sec class="table-responsive">
                            <section class="panel default blue_title h2">

                                <div class="panel-body" id="table_content">

                                    <table class="display table table-bordered table-striped" id="transfer_products">
                                        <thead>
                                        <tr>
                                            <th class="hidden-phone center">Product Code</th>
                                            <th class="hidden-phone center">Brand</th>
                                            <th class="hidden-phone center">Category</th>
                                            <th class="hidden-phone center">Item</th>
                                            <th class="hidden-phone center">Size</th>
                                            <th class="hidden-phone center">Invoice No</th>
                                            <th class="hidden-phone center">From</th>
                                            <th class="hidden-phone center">To</th>
                                            <th class="hidden-phone center">Transfer Date</th>
                                            <th class="hidden-phone center">Transferred By</th>
                                            <th class="hidden-phone center">Purchase Price</th>
                                            <th class="hidden-phone center">Sale Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $total_price = 0;

                                        foreach ($trans_report as $v){
                                            $total_purchase_price += $v['purchase_price'];
                                            $total_sale_price += $v['sale_price'];
                                        ?>
                                            <tr>
                                                <td class="center"><?php echo $v['product_code'];?></td>
                                                <td class="center"><?php echo $v['brand_name'];?></td>
                                                <td class="center"><?php echo $v['category_name'];?></td>
                                                <td class="center"><?php echo $v['item_name'];?></td>
                                                <td class="center"><?php echo $v['size'];?></td>
                                                <td class="center"><?php echo $v['invoice_no'];?></td>
                                                <td class="center"><?php echo $v['previous_shop'];?></td>
                                                <td class="center"><?php echo $v['present_shop'];?></td>
                                                <td class="center"><?php echo $v['transfer_date'];?></td>
                                                <td class="center"><?php echo $v['transferred_by_user'];?></td>
                                                <td class="center"><?php echo $v['purchase_price'];?></td>
                                                <td class="center"><?php echo $v['sale_price'];?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="" colspan="10" align="right"><h4><b>Total</b></h4></td>
                                                <td class="center"><h4><b><?php echo $total_purchase_price;?></b></h4></td>
                                                <td class="center"><h4><b><?php echo $total_sale_price;?></b></h4></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </section>
                        </sec>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $('select').select2();
    
    function getTransferReport() {
        var shop = $("#shop").val();
        var from_dt = $("#from_date").val();
        var to_dt = $("#to_date").val();

        var res1 = from_dt.split("-");
        var res2 = to_dt.split("-");

        var from_date = res1[2]+'-'+res1[0]+'-'+res1[1];
        var to_date = res2[2]+'-'+res2[0]+'-'+res2[1];

        if(shop != '' && from_date != '' && to_date != ''){
            $("#table_content").empty();

            $.ajax({
                url: "<?php echo base_url();?>access/getTransferReport/",
                type: "POST",
                data: {shop: shop, from_date: from_date, to_date: to_date},
                dataType: "html",
                success: function (data) {
                    $("#table_content").empty();
                    $("#table_content").append(data);
                }
            });
        }else{
            alert("Please Select Required Fields!");
        }
    }
</script>