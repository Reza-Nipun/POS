<!DOCTYPE html>
<html>
<body>
<style>
#product_tbl {
    border-collapse: collapse;
}

#product_tbl td th {
    border: 1px solid black;
}
</style>

<div id="cl_no" style="width: 100%; height: auto;">
    <table style="width: 90%;">
        <tr>
            <td align="center">
                <h3><?php echo $user_info[0]['shop']?></h3>
            </td>
        </tr>
        <tr>
            <td align="center">
                <?php echo ($user_info[0]['address'] != '' ? $user_info[0]['address'] : '');?>
            </td>
        </tr>
        <tr>
            <td align="center">
                <?php echo ($user_info[0]['mobile'] != '' ? $user_info[0]['mobile'] : '');?>
            </td>
        </tr>
        <tr>
            <td align="center">
                <?php echo ($user_info[0]['phone'] != '' ? $user_info[0]['phone'] : '');?>
            </td>
        </tr>
        <tr>
            <td align="center">
                <h4>INVOICE</h4>
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
//                echo date_format($date, 'Y-m-d H:i:s');
                echo date_format($date, 'Y-m-d');
                ?>
            </td>
        </tr>
    </table>
    <table style="width: 90%; border-collapse: collapse;">
        <thead>
            <tr>
                <th align="center" style="border-bottom: 1px solid black;">
                    Code
                </th>
                <th align="center" style="border-bottom: 1px solid black;">
                    Item
                </th>
                <th align="center" style="border-bottom: 1px solid black;">
                    Price
                </th>
                <th align="center" style="border-bottom: 1px solid black;">
                    Dis(%)
                </th>
                <th align="center" style="border-bottom: 1px solid black;">
                    Net
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            foreach ($invoice_detail as $v){
            $count = $count+1;
            ?>
            <tr>
                <td align="center" style="">
                    <?php echo $v['product_code'];?>
                </td>
                <td align="center" style="">
                    <?php echo $v['item_name'];?>
                </td>
                <td align="center" style="">
                    <?php echo $v['sale_price'];?>
                </td>
                <td align="center" style="">
                    <?php echo $v['discount_percentage'];?>
                </td>
                <td align="center" style="">
                    <?php echo $v['net_price'];?>
                </td>
            </tr>
            
            <?php } ?>
            <tr>
                <th align="center" colspan="6" style="border-bottom: 1px solid black;">
                    
                </th>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td align="left" style="border-bottom: 1px solid black;" colspan="2">
                    <b>VAT(%)</b>
                </td>
                <td align="center" style="border-bottom: 1px solid black;">
                    <b><?php echo 0;?></b>
                </td>
                <td align="center" style="border-bottom: 1px solid black;" colspan="2"></td>
            </tr>
            <tr>
                <td align="left" colspan="2" style="border-bottom: 1px solid black;">
                    <b>Total</b>
                </td>
                <td align="center" style="border-bottom: 1px solid black;">
                    <b><?php echo ($invoice_detail[0]['total_price'] != '' ? $invoice_detail[0]['total_price'] : 0);?></b>
                </td>
                <td align="center" style="border-bottom: 1px solid black;"></td>
                <td align="center" style="border-bottom: 1px solid black;">
                    <b><?php echo ($invoice_detail[0]['total_net_price'] != '' ? $invoice_detail[0]['total_net_price'] : 0);?></b>
                </td>
            </tr>
            
        </tfoot>   
    </table>
    <table style="width: 90%;">
        
        <tr>
            <th align="center" colspan="5" style="border-bottom: 1px solid black;">
                
            </th>
        </tr>
        <tr>
            <td align="center">
                <h3>Thank You</h3>
            </td>
        </tr>
        <tr>
            <td align="center">
                Visit Again
            </td>
        </tr>
        <tr>
            <td align="center">
                <span style="font-size: 10px;">N.B. - Returnable within 3 Days.</span>
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
