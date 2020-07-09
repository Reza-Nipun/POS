<!DOCTYPE html>
<html>
<body>


<div id="cl_no" style="width: auto; height: auto;">
    <table style="">
        <tr>
            <td align="center">
                <h3>Receipt</h3>
            </td>
        </tr>
        <tr>
            <td align="center">
                Invoice No:<?php echo $invoice_detail[0]['invoice_no'];?>
            </td>
        </tr>
        <tr>
            <td align="center">
                Purchase Date:<?php 
                $date = date_create($invoice_detail[0]['sale_date_time']);
                echo date_format($date, 'Y-m-d H:i:s');
                ?>
            </td>
        </tr>
    </table>
    <table border="1">
        <thead>
            <tr>
                <th align="center">
                    Brand
                </th>
                <th align="center">
                    Item - Size
                </th>
                <th align="center">
                    Price
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoice_detail as $v){ ?>
            <tr>
                <td align="center">
                    <?php echo $v['brand_name'];?>
                </td>
                <td align="center">
                    <?php echo $v['item_name'].' - '.$v['size'];?>
                </td>
                <td align="center">
                    <?php echo $v['sale_price'];?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th align="center" colspan="2">
                    Total
                </th>
                <td align="center">
                    <?php echo ($invoice_detail[0]['total_price'] != '' ? $invoice_detail[0]['total_price'] : 0);?>
                </td>
            </tr>
            <tr>
                <th align="center" colspan="2">
                    Discount(%)
                </th>
                <td align="center">
                    <?php echo ($invoice_detail[0]['discount_percentage'] != '' ? $invoice_detail[0]['discount_percentage'] : 0);?>
                </td>
            </tr>
            <tr>
                <th align="center" colspan="2">
                    Net Price
                </th>
                <td align="center">
                    <?php echo ($invoice_detail[0]['net_price'] != '' ? $invoice_detail[0]['net_price'] : 0);?>
                </td>
            </tr>
        </tfoot>   
    </table>
    <table>
        <tr>
            <td>
                <?php echo $user_info[0]['shop']?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo ($user_info[0]['address'] != '' ? $user_info[0]['address'] : '');?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo ($user_info[0]['mobile'] != '' ? $user_info[0]['mobile'] : '');?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo ($user_info[0]['phone'] != '' ? $user_info[0]['phone'] : '');?>
            </td>
        </tr>
    </table>
</div>
<span onclick="printDiv('cl_no');" class="print_cl_btn" style="display: none; border-style: none; width: 80px; height: 30px; background-color: green; color: white; border-radius: 5px;">Print CL</span>


<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

        setTimeout(function() {
            '<?php
                $length = sizeof($invoice_detail);
                if($length != 0){ ?>'

            $(".print_cl_btn").click();


            '<?php } ?>'
        }, 1000);

    }).delay(3000);


    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

        window.location.href = '<?php echo base_url();?>access/sale_product';
    }

</script>

</body>
</html>
