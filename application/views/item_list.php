<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Manage Items</h1>
          <h2 class="">Manage Items...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li class="active">Manage Items</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Item List</h3>
            </div>
         <a class="btn btn-success" href="<?php echo base_url();?>access/add_new_item">+ Add Item</a><br />

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
         <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="sample_3">
                  <thead>
                    <tr>
                      <th class="hidden-phone center">Item Name</th>
                      <th class="hidden-phone center">Description</th>
                      <th class="hidden-phone center">Status</th>
                      <th class="hidden-phone center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $sl = 1;
                      
                      foreach ($items as $v) { ?>
                        <tr>
<!--                            <td class="center">--><?php //echo $sl; $sl++;?><!--</td>-->
                            <td class="center"><?php echo $v['item_name'];?></td>
                            <td class="center"><?php echo $v['item_description'];?></td>
                            <td class="center">
                                <?php
                                if($v['status'] == 1){
                                    echo "Active";
                                }
                                if($v['status'] == 0){
                                    echo "Inactive";
                                }
                                ?>
                            </td>
                            <td class="center">
                                <?php if($v['status'] == 0){ ?>
                                <a href="<?php echo base_url();?>access/updateItemStatus/<?php echo $v['id']?>/1" class="btn btn-success" style="cursor: pointer;">Active</a>
                                <?php } ?>
                                <?php if($v['status'] == 1){ ?>
                                <a href="<?php echo base_url();?>access/updateItemStatus/<?php echo $v['id']?>/0" class="btn btn-danger" style="cursor: pointer;">Inactive</a>
                                <?php } ?>
                                <a href="<?php echo base_url();?>access/editItemInfo/<?php echo $v['id']?>" class="btn btn-warning" style="cursor: pointer;">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div><!--/table-responsive-->
              </div>
         
           </div><!--/porlets-content-->  
          </div><!--/block-web--> 
        </div><!--/col-md-12--> 
      </div>