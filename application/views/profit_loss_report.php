<style>
    .loader {
        border: 20px solid #f3f3f3;
        border-radius: 50%;
        border-top: 20px solid #3498db;
        width: 35px;
        height: 35px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<div class="pull-left breadcrumb_admin clear_both">
    <div class="pull-left page_title theme_color">
        <h1>Profit-Loss Report</h1>
        <h2 class="">Profit-Loss...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Profit-Loss Report</li>
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
                    <h3 class="content-header">Profit-Loss</h3>
                </div>

                <div class="porlets-content">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <select name="shop" id="shop" class="form-control" required>
                                    <option value="">Shop...</option>
                                    <?php foreach ($shops as $s){ ?>
                                        <option value="<?php echo $s['shop_name']?>"><?php echo $s['shop_name']?></option>
                                    <?php } ?>
                                </select>
                                <span><b>* Select Shop</b></span>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="purchase_date" id="from_date" placeholder="From Date: mm-dd-yyyy" class="form-control form-control-inline input-medium default-date-picker" required />
                                <span><b>* Sale From Date</b></span>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="purchase_date" id="to_date" placeholder="To Date: mm-dd-yyyy" class="form-control form-control-inline input-medium default-date-picker" required />
                                <span><b>* Sale To Date</b></span>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="submit_btn" onclick="getProfitLossReport();">Search</button>
                            </div>
                            <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
                        </div>
                    </div>
                    <br />

                    <div class="row">
                        <sec class="table-responsive">
                            <section class="panel default blue_title h2">

                                <div class="panel-body" id="table_content">

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

                                        $count=0;

                                        foreach ($profit_loss_report as $v){
                                            $total_purchase_price += $v['purchase_price'];
                                            $total_sale_price += $v['sale_price'];
                                            $total_discount_percentage += $v['discount_percentage'];

//                                            $discount_price = ($v['sale_price'] - (($v['discount_percentage']/100)*$v['sale_price']));
//                                            $total_discount_price += $discount_price;
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
    
    function getProfitLossReport() {
        var shop = $("#shop").val();
        var from_dt = $("#from_date").val();
        var to_dt = $("#to_date").val();

        var res1 = from_dt.split("-");
        var res2 = to_dt.split("-");

        var from_date = res1[2]+'-'+res1[0]+'-'+res1[1];
        var to_date = res2[2]+'-'+res2[0]+'-'+res2[1];

        $("#loader").css("display", "block");

        if(shop != '' && from_date != '' && to_date != ''){
            $("#table_content").empty();

            $.ajax({
                url: "<?php echo base_url();?>access/getProfitLossReport/",
                type: "POST",
                data: {shop: shop, from_date: from_date, to_date: to_date},
                dataType: "html",
                success: function (data) {
                    $("#table_content").empty();
                    $("#table_content").append(data);
                    $("#loader").css("display", "none");
                }
            });
        }else{
            alert("Please Select Required Fields!");
        }
    }
</script>