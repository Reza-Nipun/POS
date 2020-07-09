<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>New User</h1>
          <h2 class="">New User...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li class="active">New User</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row center">
        <div class="col-lg-12 ">
        <section class="panel default green_title h2">
        <div class="panel-heading border"></div>
        <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>access/save_new_user" method="post">
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
                    <label class="col-md-2"><b>User Name</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                      <input type="text" name="user_name" id="user_name" onblur="isUserExist();" class="form-control" required autofocus />
                      <span style="color: #ffb32f;"> Plz, Don't Use Any Space </span>
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>Password</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                      <input type="password" name="password" id="password" onblur="isPasswordMatched();" class="form-control" required />
                  </div>
                </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Re-Enter Password</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="password" name="re_password" id="re_password" onblur="isPasswordMatched();" class="form-control" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Email Address</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="email" name="email" id="email" class="form-control" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Phone No.</b></label>
                        <div class="col-md-2">
                            <input type="text" name="phone" id="phone" placeholder="02XXXXXXX" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Mobile No.</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="mobile" id="mobile" placeholder="017XXXXXXXX" class="form-control" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Address</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <textarea name="address" id="address" class="form-control" cols="4" rows="4" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>Access Level</b> <span style="color: red;">*</span></label>
                  <div class="col-md-2">
                      <select name="access_level" id="access_level" class="form-control" required onchange="getShopList();">
                          <option value="">Select Access Level...</option>
                          <option value="1">Super Admin</option>
                          <option value="2">User</option>
                      </select>
                  </div>
                </div>
                </div>
            <div class="row" id="shop_list">
                    
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Status</b> <span style="color: red;">*</span></label>
                        <div class="col-md-2">
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Select Status...</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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

        function getShopList(){
            var access_level = $("#access_level").val();
            
            $("#shop_list").empty();
            
            if(access_level == 2){
                $.ajax({
                    url: "<?php echo base_url();?>access/getShopList/",
                    type: "POST",
                    data: {},
                    dataType: "html",
                    success: function (data) {
                        $("#shop_list").append(data);
                    }
                });
            }
            
        }

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