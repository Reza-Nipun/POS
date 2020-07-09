<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>
<button type="submit" onclick="printDiv('print_area');" class="print_cl_btn">Print Sticker</button>
<br />
<br />

<div id="print_area">
<?php
$s = 1;
foreach ($array_product as $k => $v){

        ?>
        <div style="float:left; width: 130px; height: 100px; margin-right: 8px; border: 1px; border-color: #000; border-style: solid; text-align: center; margin-top: 15px; margin-left: 15px;">
            <p style="font-size: 12px; margin-top: -1px;"><?php echo $shop;?></p>
            <p style="font-size: 12px; margin-top: -10px;"><?php echo $array_item[$k].'-'.$array_size[$k]?></p>
            <?php
            $code = $v . '.png';
            $code = '<center><img style="margin-top: -5px;" src="' . base_url() . 'barcode/' . $code . '" width="90" height="40" title="Barcode!"></center>';
            echo $code;
            ?>
            <p style="font-size: 12px; margin-top: -5px;"><b>Price: <?php echo $array_price[$k];?> BDT</b></p>
        </div>
        <?php
    if($s % 5 == 0) {
        echo '<br />';
        echo '<br />';
        echo '<br />';
        echo '<br />';
        echo '<br />';
        echo '<br />';
    }

    if($s % 45 == 0) {
        echo '<br />';
        echo '<br />';
        echo '<br />';
        echo '<br />';
        echo '<br />';
        echo '<br />';
        echo '<br />';
        echo '<br />';
    }

    $s++;
}
?>
</div>
</body>
</html>

<script type="text/javascript">

    window.addEventListener('keydown', function(event) {
        if (event.keyCode === 80 && (event.ctrlKey || event.metaKey) && !event.altKey && (!event.shiftKey || window.chrome || window.opera)) {
            event.preventDefault();
            if (event.stopImmediatePropagation) {
                event.stopImmediatePropagation();
            } else {
                event.stopPropagation();
            }
            return;
        }
    }, true);

    function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

        var status_command = '<?php echo $status_command?>'

        if(status_command == 1){
            window.location.href = '<?php echo base_url();?>access/add_new_product';
        }

        if(status_command == 2){
            window.close();
        }

    }
</script>