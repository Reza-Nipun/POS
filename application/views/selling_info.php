<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Selling Info</h1>
          <h2 class="">Selling Info...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li class="active">Selling Info</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row center">
        <div class="col-lg-12 ">
        <section class="panel default green_title h2">
        <div class="panel-heading border"></div>
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
                      <input type="text" name="invoice_code" id="invoice_code" class="form-control" autofocus />
                      <span>* Enter Invoice No</span>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success" onclick="getInvoiceDetail();">Search</button>
                    </div>
                </div>
            </div>
            <div id="invoice_detail"></div>
        </div>
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

    function getInvoiceDetail() {
        var invoice_code = $("#invoice_code").val();

        $("#invoice_detail").empty();

        if(invoice_code != ''){
            $.ajax({
                    async: false,
                    type: "POST",
                    url: "<?php echo base_url();?>access/getInvoiceDetail/",
                    data: {invoice_code: invoice_code},
                    dataType: "html",
                    success: function (data) {
                        $("#invoice_detail").append(data);
                    }
                });
        }
        $("#invoice_code").val('');
        $("#invoice_code").focus();
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