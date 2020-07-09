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
        <h1>Summary Report</h1>
        <h2 class="">Summary...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Summary Report</li>
        </ol>
    </div>
</div>
<div class="container clear_both padding_fix">
    <!--\\\\\\\ container  start \\\\\\-->
    <div class="row">
        <div class="col-md-12">
            <div class="block-web">
                <div class="header">
                    <div class="actions"> <button class="btn btn-primary" style="color: #FFF;" id="btnExport"><b>Export Excel</b></button> </div>
                    <h3 class="content-header">Summary</h3>
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
<!--                            <div class="col-md-2">-->
<!--                                <select name="brand" id="brand" class="form-control" required>-->
<!--                                    <option value="">Brand...</option>-->
<!--                                    --><?php //foreach ($brands as $b){ ?>
<!--                                        <option value="--><?php //echo $b['id']?><!--">--><?php //echo $b['brand_name']?><!--</option>-->
<!--                                    --><?php //} ?>
<!--                                </select>-->
<!--                                <span><b>* Select Brand</b></span>-->
<!--                            </div>-->
<!--                            <div class="col-md-2">-->
<!--                                <select name="category" id="category" class="form-control" required>-->
<!--                                    <option value="">Category...</option>-->
<!--                                    --><?php //foreach ($categories as $c){ ?>
<!--                                        <option value="--><?php //echo $c['id']?><!--">--><?php //echo $c['category_name']?><!--</option>-->
<!--                                    --><?php //} ?>
<!--                                </select>-->
<!--                                <span><b>* Select Category</b></span>-->
<!--                            </div>-->
<!--                            <div class="col-md-2">-->
<!--                                <select name="item" id="item" class="form-control" required>-->
<!--                                    <option value="">Item...</option>-->
<!--                                    --><?php //foreach ($items as $i){ ?>
<!--                                        <option value="--><?php //echo $i['id']?><!--">--><?php //echo $i['item_name']?><!--</option>-->
<!--                                    --><?php //} ?>
<!--                                </select>-->
<!--                                <span><b>* Select Item</b></span>-->
<!--                            </div>-->
                            <div class="col-md-2">
                                <input type="text" name="sale_till_date" id="till_date" placeholder="Till Date: mm-dd-yyyy" class="form-control form-control-inline input-medium default-date-picker" required />
                                <span><b>* Till Date</b></span>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary" id="submit_btn" onclick="getSummaryReport();">Search</button>
                            </div>
                            <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
                        </div>
                    </div>
                    <br />

                    <div class="row">
                        <sec class="table-responsive">
                            <section class="panel default blue_title h2">

                                <div class="panel-body" id="table_content">

                                    <table class="table table-scroll table-striped" id="profit_loss" border="1">
                                        <thead>
                                            <tr>
                                                <th class="hidden-phone center" colspan="3"></th>
                                                <th class="hidden-phone center" colspan="2">G. Total Purchase</th>
                                                <th class="hidden-phone center" colspan="3">G. Total Sale</th>
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

                                        </tbody>
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

    $(function(){
        $('#btnExport').click(function(){
            var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#table_content').html())
            location.href=url
            return false
        })
    })

    function getSummaryReport() {
        var shop = $("#shop").val();
        var brand = $("#brand").val();
        var category = $("#category").val();
        var item = $("#item").val();

        var till_dt = $("#till_date").val();

        var res1 = till_dt.split("-");

        var till_date = res1[2]+'-'+res1[0]+'-'+res1[1];

        $("#loader").css("display", "block");

            $("#table_content").empty();

            $.ajax({
                url: "<?php echo base_url();?>access/getSummaryReport/",
                type: "POST",
                data: {shop: shop, brand: brand, category: category, item: item, till_date: till_date},
                dataType: "html",
                success: function (data) {
                    $("#table_content").empty();
                    $("#table_content").append(data);
                    $("#loader").css("display", "none");
                }
            });

    }
</script>