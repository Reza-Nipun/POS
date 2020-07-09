<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Edit Brand</h1>
          <h2 class="">Edit Brand...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li class="active">Edit Brand</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row center">
        <div class="col-lg-12 ">
        <section class="panel default green_title h2">
        <div class="panel-heading border"></div>
        <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>access/update_brand_info" method="post">
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
                    <label class="col-md-2"><b>Brand Name</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                      <input type="text" name="brand_name" id="brand_name" value="<?php echo $brand_info[0]['brand_name']?>" class="form-control" required />
                      <input type="hidden" name="id" id="id" value="<?php echo $brand_info[0]['id']?>" class="form-control" required readonly />
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>Brand Description</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                      <input type="text" name="brand_description" id="brand_description" value="<?php echo $brand_info[0]['brand_description']?>" class="form-control" required />
                  </div>
                </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Status</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Select Status...</option>
                                <option value="1" <?php if($brand_info[0]['status'] == 1){ ?> selected="selected" <?php } ?>>Active</option>
                                <option value="0" <?php if($brand_info[0]['status'] == 0){ ?> selected="selected" <?php } ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

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
        </form>
        </section>
        </div>
            
        </div>
        
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    
    <script type="text/javascript">
        $('select').select2();

        function isUserExist() {
            var user_name = $("#user_name").val();
            var string_spaces = user_name.split(" ");
            var string_spaces_length = string_spaces.length;

            if(user_name != '' && string_spaces_length == 1){
                $("#user_name").css('border-color', '');

                $.ajax({
                    url: "<?php echo base_url();?>access/isUserExist/",
                    type: "POST",
                    data: {user_name: user_name},
                    dataType: "json",
                    success: function (data) {
                        if(data.length > 0){
                            alert(user_name+ " Already Exist!");
                            $("#user_name").css('border-color', 'red');
                            $("#user_name").val('');

                            $("#submit_btn").attr('disabled', true);
                        }else{
                            $("#user_name").css('border-color', '');
                            $("#submit_btn").attr('disabled', false);
                        }
                    }
                });
            }else{
                $("#user_name").css('border-color', 'red');
                $("#user_name").val('');
            }
        }
        
        function isPasswordMatched() {
            var password = $("#password").val();
            var re_password = $("#re_password").val();

            if((password == re_password) && (password != '') && (re_password != '')){
                $("#password").css('border-color', '');
                $("#re_password").css('border-color', '');

                $("#submit_btn").attr('disabled', false);

            }else{
                $("#password").css('border-color', 'red');
                $("#re_password").css('border-color', 'red');

                $("#submit_btn").attr('disabled', true);
            }
        }
    </script>