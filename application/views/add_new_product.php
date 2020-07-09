<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>New Product</h1>
          <h2 class="">New Product...</h2>
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
        <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>access/save_new_product" method="post">
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
                    <label class="col-md-2"><b>Shop</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                      <select name="shop" id="shop" class="form-control" required>
                            <option value="">Select Shop...</option>
                          <?php foreach ($shops as $s){ ?>
                            <option value="<?php echo $s['shop_name']?>"><?php echo $s['shop_name']?></option>
                          <?php } ?>
                      </select>
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>Brand</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                      <select name="brand" id="brand" class="form-control" required>
                            <option value="">Select Brand...</option>
                          <?php foreach ($brands as $b){ ?>
                            <option value="<?php echo $b['id']?>"><?php echo $b['brand_name']?></option>
                          <?php } ?>
                      </select>
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>Category</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                      <select name="category" id="category" class="form-control" required>
                          <option value="">Select Category...</option>
                          <?php foreach ($categories as $c){ ?>
                              <option value="<?php echo $c['id']?>"><?php echo $c['category_name']?></option>
                          <?php } ?>
                      </select>
                  </div>
                </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Item</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <select name="item" id="item" class="form-control" required>
                                <option value="">Select Item...</option>
                                <?php foreach ($items as $i){ ?>
                                    <option value="<?php echo $i['id']?>"><?php echo $i['item_name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Size</b></label>
                        <div class="col-md-2">
                            <select name="size" id="size" class="form-control">
                                <option value="">Select Size...</option>
                                <?php foreach ($sizes as $s){ ?>
                                    <option value="<?php echo $s['id']?>"><?php echo $s['size']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Purchase Date</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="purchase_date" id="purchase_date" placeholder="mm-dd-yyyy" class="form-control form-control-inline input-medium default-date-picker" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Purchase Price</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="purchase_price" id="purchase_price" class="form-control" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Sale Price</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="sale_price" id="sale_price" class="form-control" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Quantity</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="number" name="quantity" id="quantity" class="form-control" required />
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

    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
</script>