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
          <h1>Product Inventory</h1>
          <h2 class="">Product Inventory...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li class="active">Product Inventory</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions">
                  <?php if($access_level == 1){ ?>
                      <a class="btn btn-success" style="color: #ffffff;" href="<?php echo base_url();?>access/add_new_product">+ Add Product</a><br />
                  <?php } ?>
              </div>
              <h3 class="content-header">Product List</h3>
            </div>

              <div style="padding-top:10px">
                  <h6 style="color:red">
                      <?php
                      $exc = $this->session->userdata('exception');
                      if (isset($exc)) {
                          echo $exc;
                          $this->session->unset_userdata('exception');
                      }
                      ?>
                  </h6>

                  <h6 style="color:green">
                      <?php
                      $msg = $this->session->userdata('message');
                      if (isset($msg)) {
                          echo $msg;
                          $this->session->unset_userdata('message');
                      }
                      ?>
                  </h6>
              </div>

       <div class="porlets-content">
           <div class="row">
               <div class="form-group">
                   <div class="col-md-2">
                       <select name="shop" id="shop" class="form-control" required>
                           <option value="">Select Shop...</option>
                           <?php foreach ($shops as $s){ ?>
                               <option value="<?php echo $s['shop_name']?>"><?php echo $s['shop_name']?></option>
                           <?php } ?>
                       </select>
                       <span><b>Select Shop</b></span>
                   </div>
                   <div class="col-md-2">
                       <input type="text" placeholder="Product Code" name="product_code" id="product_code" class="form-control" required />
                       <span><b>Enter Product Code</b></span>
                   </div>
                   <div class="col-md-2">
                       <button class="btn btn-primary" onclick="searchProductInfo();">Search</button>
                   </div>
                   <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
               </div>
           </div>
           <br />
           <div class="row">
                 <sec class="table-responsive">
                     <section class="panel default blue_title h2">

                         <div class="panel-body" id="product_info">

                         <table class="display table table-bordered table-striped" id="dynamic-table">
                           <thead>
                            <tr>
                              <th class="hidden-phone center">Product Code</th>
                              <th class="hidden-phone center">Brand</th>
                              <th class="hidden-phone center">Category</th>
                              <th class="hidden-phone center">Item</th>
                              <th class="hidden-phone center">Size</th>
                          <?php if($access_level == 1){ ?>
                              <th class="hidden-phone center">Purchase Date</th>
                              <th class="hidden-phone center">Purchase Price</th>
                          <?php } ?>
                              <th class="hidden-phone center">Sale Price</th>
        <!--                      <th class="hidden-phone center">Picture</th>-->
                              <th class="hidden-phone center">Updated</th>
        <!--                      <th class="hidden-phone center">Status</th>-->
                          <?php if($access_level == 1){ ?>
                              <th class="hidden-phone center">Shop</th>
                          <?php } ?>
                              <th class="hidden-phone center">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($products as $v){?>
                            <tr>
                                <td class="center"><?php echo $v['product_code'];?></td>
                                <td class="center"><?php echo $v['brand_name'];?></td>
                                <td class="center"><?php echo $v['category_name'];?></td>
                                <td class="center"><?php echo $v['item_name'];?></td>
                                <td class="center"><?php echo $v['size'];?></td>
                            <?php if($access_level == 1){ ?>
                                <td class="center"><?php echo $v['purchase_date'];?></td>
                                <td class="center"><?php echo $v['purchase_price'];?></td>
                            <?php } ?>
                                <td class="center"><?php echo $v['sale_price'];?></td>
                                <td class="center" title="<?php echo $v['updated_by_user'];?>">
                                    <?php
                                    if($v['update_date'] != '0000-00-00 00:00:00'){
                                        echo $v['update_date'];
                                    }
                                    ?>
                                </td>
        <!--                        <td class="center">--><?php //echo $v['picture_url'];?><!--</td>-->
        <!--                        <td class="center">-->
        <!--                            --><?php
        //                            if($v['status'] == 1){
        //                                echo "Active";
        //                            }
        //                            if($v['status'] == 0){
        //                                echo "Inactive";
        //                            }
        //                            ?>
        <!--                        </td>-->
                            <?php if($access_level == 1){ ?>
                                <td class="hidden-phone center"><?php echo $v['shop'];?></td>
                            <?php } ?>
                                <td class="center">
                                    <?php
                                    if($access_level == 1){
                                    if($v['status'] == 0){ ?>
                                        <!--<a href="<?php echo base_url();?>access/updateProductStatus/<?php echo $v['id']?>/1" class="btn btn-success" style="cursor: pointer;">Active</a>-->
                                    <?php } ?>
                                    <?php if($v['status'] == 1){ ?>
                                        <!--<a href="<?php echo base_url();?>access/updateProductStatus/<?php echo $v['id']?>/0" class="btn btn-danger" style="cursor: pointer;">Inactive</a>-->
                                    <?php } ?>
                                    <a href="<?php echo base_url();?>access/editProduct/<?php echo $v['id'];?>" class="btn btn-primary" style="cursor: pointer;">Edit</a>
                                    <a target="_blank" href="<?php echo base_url();?>access/print_sticker/<?php echo $v['product_code'];?>" class="btn btn-warning" style="cursor: pointer;">Print Sticker</a>
                                    <?php } ?>
                                    <?php if($v['shop'] == 'RUPNAGAR'){ ?>
                                        <a href="<?php echo base_url();?>access/transfer_shop/<?php echo $v['product_code'];?>/<?php echo $v['shop'];?>/LOLONA" onclick="return confirm('Do You Want To Transfer This Product?');" class="btn btn-success" style="cursor: pointer;">Send To LOLONA</a>
                                    <?php } ?>
                                    <?php if($v['shop'] == 'LOLONA'){ ?>
                                        <a href="<?php echo base_url();?>access/transfer_shop/<?php echo $v['product_code'];?>/<?php echo $v['shop'];?>/RUPNAGAR" onclick="return confirm('Do You Want To Transfer This Product?');" class="btn btn-success" style="cursor: pointer;">Send To RUPNAGAR</a>
                                    <?php } ?>
                                </td>
                            </tr>
                          <?php } ?>
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
    
    function searchProductInfo() {
        var shop = $("#shop").val();
        var product_code = $("#product_code").val();

        $("#loader").css("display", "block");

        $("#product_info").empty();

        $.ajax({
            url: "<?php echo base_url();?>access/searchProductInfo/",
            type: "POST",
            data: {shop: shop, product_code: product_code},
            dataType: "html",
            success: function (data) {
                $("#product_info").append(data);
                $("#loader").css("display", "none");
            }
        });
    }
</script>