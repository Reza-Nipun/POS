<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Edit Product</h1>
          <h2 class="">Edit Product...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li><a href="<?php echo base_url();?>access/products">Product List</a></li>
              <li class="active">New Product</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row center">
        <div class="col-lg-12 ">
        <section class="panel default green_title h2">
        <div class="panel-heading border"></div>
        <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>access/update_product" method="post">
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
                    <label class="col-md-2"><b>Product Code</b> <span style="color: red;">*</span></label>
                    <div class="col-md-2">
                        <input type="text" readonly value="<?php echo $prod_info[0]['product_code'];?>" name="product_code" id="product_code" class="form-control" required />
                        <input type="hidden" readonly value="<?php echo $prod_info[0]['id'];?>" name="product_id" id="product_id" class="form-control" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>Shop</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                      <select name="shop" disabled="disabled" id="shop" class="form-control" required>
                            <option value="">Select Shop...</option>
                          <?php
                                $prod_shop = $prod_info[0]['shop'];
                                foreach ($shops as $s){
                                $shop = $s['shop_name'];
                                if($shop == $prod_shop){
                            ?>
                                <option value="<?php echo $s['shop_name']?>" selected="selected"><?php echo $s['shop_name']?></option>
                            <?php
                                }else{ ?>
                                    <option value="<?php echo $s['shop_name']?>"><?php echo $s['shop_name']?></option>
                            <?php    }
                            }
                            ?>
                      </select>
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>Brand</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                      <select name="brand" id="brand" class="form-control" required="">
                        <?php
                            $prod_brand_id = $prod_info[0]['brand_id'];
                            foreach ($brands as $b){
                            $brand_id = $b['id'];
                            if($brand_id == $prod_brand_id){
                        ?>
                            <option value="<?php echo $b['id']?>" selected="selected"><?php echo $b['brand_name']?></option>
                        <?php
                            }else{ ?>
                                <option value="<?php echo $b['id']?>"><?php echo $b['brand_name']?></option>
                        <?php    }
                        }
                        ?>
                        </select>
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>Category</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                        <select name="category" id="category" class="form-control" required="">
                        <?php
                            $prod_category_id = $prod_info[0]['category_id'];
                            foreach ($categories as $cat){
                            $category_id = $cat['id'];
                            if($category_id == $prod_category_id){
                        ?>
                            <option value="<?php echo $cat['id']?>" selected="selected"><?php echo $cat['category_name']?></option>
                        <?php
                            }else{ ?>
                                <option value="<?php echo $cat['id']?>"><?php echo $cat['category_name']?></option>
                        <?php    }
                        }
                        ?>
                        </select>
                  </div>
                </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Item</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <select name="item" id="item" class="form-control" required="">
                            <?php
                                $prod_item_id = $prod_info[0]['item_id'];
                                foreach ($items as $itm){
                                $item_id = $itm['id'];
                                if($item_id == $prod_item_id){
                            ?>
                                <option value="<?php echo $itm['id']?>" selected="selected"><?php echo $itm['item_name']?></option>
                            <?php
                                }else{ ?>
                                    <option value="<?php echo $itm['id']?>"><?php echo $itm['item_name']?></option>
                            <?php    }
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Size</b></label>
                        <div class="col-md-2">
                            <select name="size" id="size" class="form-control">
                            <?php
                                $prod_size = $prod_info[0]['size_id'];
                                foreach ($sizes as $sz){
                                $size = $sz['id'];
                                if($size == $prod_shop){
                            ?>
                                <option value="<?php echo $sz['id']?>" selected="selected"><?php echo $sz['size']?></option>
                            <?php
                                }else{ ?>
                                    <option value="<?php echo $sz['id']?>"><?php echo $sz['size']?></option>
                            <?php    }
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Purchase Date</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" readonly name="purchase_date" readonly id="purchase_date" value="<?php echo $prod_info[0]['purchase_date'];?>" class="form-control" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Purchase Price</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" readonly name="purchase_price" id="purchase_price" value="<?php echo $prod_info[0]['purchase_price']?>" class="form-control" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Sale Price</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="sale_price" id="sale_price" value="<?php echo $prod_info[0]['sale_price']?>" class="form-control" required />
                        </div>
                    </div>
                </div>
                
<!--                <div class="row">-->
<!--                    <div class="form-group">-->
<!--                        <label class="col-md-2"><b>Status</b> <span style="color: red;">*</span></label>-->
<!--                        <div class="col-md-2">-->
<!--                            <select name="status" id="status" class="form-control" required>-->
<!--                                <option value="">Select Status...</option>-->
<!--                                <option value="1">Active</option>-->
<!--                                <option value="0">Inactive</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->


            <br />

         
        <div class="row">
            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-1">
                    <button class="btn btn-primary" id="submit_btn">SAVE</button>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-warning" id="reset_btn" type="reset">RESET</button>
                </div>
            </div>
        </div><br />
        </div>
        </form>
        </section>

            
        </div>
        
      <!--\\\\\\\ container  end \\\\\\-->
    </div>

<script type="text/javascript">
    $('select').select2();
</script>