<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Sale Product</h1>
          <h2 class="">Sale Product...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li class="active">Sale Product</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row center">
        <div class="col-lg-12 ">
        <section class="panel default green_title h2">
        <div class="panel-heading border"></div>
        <form role="form" class="form-horizontal" action="<?php echo base_url();?>access/selling_product" method="post">
<!--        <div style="padding-top:10px">-->
<!--                <h6 style="color:red">-->
<!--                    --><?php
//                    $exc = $this->session->userdata('exception');
//                    if (isset($exc)) {
//                        echo $exc;
//                        $this->session->unset_userdata('exception');
//                    }
//                    ?>
<!--                </h6>-->
<!---->
<!--                <h6 style="color:green">-->
<!--                    --><?php
//                    $msg = $this->session->userdata('message');
//                    if (isset($msg)) {
//                        echo $msg;
//                        $this->session->unset_userdata('message');
//                    }
//                    ?>
<!--                </h6>-->
<!--        </div>-->
        <div class="porlets-content">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                      <input type="text" name="code" id="code" class="form-control" autofocus onkeyup="checkCodeValidity();" />
                      <span>* Input Code Here</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div  id="reload_div">
                    <div class="col-md-12" id="tableWrap">
                        <table class="table table-scroll table-striped" border="1" id="prod_code_tbl">
                            <thead>
                                <tr>
                                    <th class="center">Product Code</th>
                                    <th class="center">Brand</th>
                                    <th class="center">Category</th>
                                    <th class="center">Item</th>
                                    <th class="center">Size</th>
                                    <th class="center">Price</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                           <tfoot>
                               <tr>
                                   <td colspan="4"></td>
                                   <td class="center">Total</td>
                                   <td class="center" align="center"><input class="form-control" style="width: 180px;" readonly type="text" name="total_price" id="total_price" value="" /></td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td colspan="4"></td>
                                   <td class="center">Discount(%)</td>
                                   <td class="center"><input type="text" class="form-control" onblur="calculatDiscountedPrice();" style="width: 180px;" name="discount" id="discount" value="" /></td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td colspan="4"></td>
                                   <td class="center">Discount Reference</td>
                                   <td class="center"><input type="text" class="form-control" style="width: 180px;" name="discount_reference" id="discount_reference" value="" /></td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td colspan="4"></td>
                                   <td class="center">Net Price</td>
                                   <td class="center"><input class="form-control" style="width: 180px;" readonly type="text" name="net_price" id="net_price" value="" /></td>
                                   <td></td>
                               </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-8"></div>
                    <div class="col-md-1">
                        <button type="submit" name="submit_btn" id="submit_btn" class="btn btn-success">Sale Product</button>
                    </div>
                    <div class="col-md-1">
                        <a href="<?php echo base_url();?>access/sale_product" name="submit_btn" id="submit_btn" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </section>

            
        </div>
        
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    </div>

<script type="text/javascript">
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

    $('select').select2();

//    $("#product_code").blur(function(){
//        $("#product_code").focus();
//    });

    function checkCodeValidity() {
        var cd = $("#code").val();
        var code = cd.trim();

        var code_length = code.length;
        var last_variable = code.slice(-1);

        var values = [];
        $("input[name='product_code[]']").each(function() {
              values.push($(this).val());
        });

        if(code != '' && code_length == 10 && last_variable == '.'){
            var find_data = values.indexOf(code);
            if(find_data < 0){
               $.ajax({
                    async: false,
                    type: "POST",
                    url: "<?php echo base_url();?>access/getProductInfoByCode/",
                    data: {product_code: code},
                    dataType: "html",
                    success: function (data) {
                        if(data == 'NA'){
                            alert('Sorry, Not Available!');
                            $("#code").val('');
                        }else{
                            $("#prod_code_tbl").append(data);
                            $("#code").val('');

                            var sum = 0;
                            $(".price").each(function(){
                                sum += +$(this).val();
                            });
                            $("#total_price").val(sum);
                            $("#net_price").val(sum);
                        }

                    }
                });
            }else{
                alert('Product Already Added!');
                $("#code").val('');
            }

        }
        $("#discount").blur();

    }

    function addNewRow() {
        var rowCount = $('#prod_code_tbl tbody tr').length;

        var res = $("#prod_code_tbl tbody tr:last input:first").attr('id');
//        console.log($("#defect_code_tbl tbody tr:last input:first").attr('id'));

//        console.log(res);
//        console.log(rowCount);
//
//            console.log(res);

            var rowPlus = rowCount + 1;

            $("#prod_code_tbl > tbody").append('<tr><td>'+rowPlus+'</td><td>A</td><td>B</td><td>C</td><td>D</td><td>E</td><td><span class="btn btn-danger" id="remove" onclick="deleteRow(this);">REMOVE</span></td></tr>');

    }

    function deleteRow(row)
    {
        var i = row.parentNode.parentNode.rowIndex;
        document.getElementById('prod_code_tbl').deleteRow(i);

        var sum = 0;
        $(".price").each(function(){
            sum += +$(this).val();
        });
        $("#total_price").val(sum);
        $("#net_price").val(sum);

        $("#discount").blur();

        $("#code").focus();

    }

    function calculatDiscountedPrice() {
        var total_price = $("#total_price").val();
        total_price = (total_price != '' ? total_price : 0);

        var discount = $("#discount").val();
        discount = (discount != '' ? discount : 0);

        var discount_amount = (discount/100)*total_price;
        discount_amount = (discount_amount != '' ? discount_amount : 0);

        var net_price = total_price-discount_amount;
        net_price = (net_price != '' ? net_price : 0);

        $("#net_price").val(net_price);

        if(discount_amount > 0 && discount_amount != 0){
            $("#discount_reference").attr('required', true);
        }else{
            $("#discount_reference").attr('required', false);
        }

    }
</script>