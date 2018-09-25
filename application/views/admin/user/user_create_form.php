<div id="content">
    	<div class="breadcrumb">
        	<?php if($render_path) : ?>
            <?php foreach($render_path as $key => $val) :?>
            <a href="<?=$val;?>"><?=$key;?></a> ::
            <?php endforeach;?>
            <?php endif;?>
        </div><!--End breadcrumb-->
        <div class="warning" style="display:none;"><?php if($this->session->flashdata('warning')) echo $this->session->flashdata('warning');?></div>
        <div class="box">
        	<div class="heading">
            	<h1><img src="<?=base_url();?>admin_template/image/category.png" /><?=$heading_title;?></h1>
                <div class="buttons">
                	<a href="javascript:void(0);" onclick="$('#frm_add').submit();" class="button">Save</a>
                    <a href="javascript:void(0);" onclick="location.href='<?=$this->index_url;?>admin/user';" class="button">Cancel</a>
                </div>
            </div><!--End heading-->
            <div class="content">
            	<div id="tabs" class="htabs">
                	<a href="#tab_1" class="selected">Thêm mới user</a>
                    <!--<a href="#tab_2">Tab 2</a>
                    <a href="#tab_3">Tab 3</a>-->
                </div><!--End tabs-->
                
                <form action="<?=$action;?>" method="post" enctype="multipart/form-data" id="frm_add">
               	  <div id="tab_1" style="display:block;">
                   	  <table width="100%" class="form">
<tbody>
                           	  <tr>
           	  <td width="169" align="left"><label>Tên đăng nhập:</label></td>
          		<td width="922">
            	<input name="username" type="text" id="username" value="<?php echo set_value('username');?>" size="100" />
                <?=form_error('username');?>
            </td>
            </tr>
            <tr>
           	  <td align="left"><label>Mật khẩu:</label></td>
          		<td>
            	<input name="password" type="password" id="password" size="100" />
                <?=form_error('password');?>
            </td>
            </tr>
            <tr>
           	  <td align="left"><label>Nhập lại mật khẩu:</label></td>
          		<td>
            	<input name="confirm_password" type="password" id="confirm_password" size="100" />
                <?=form_error('confirm_password');?>
            </td>
            </tr>
            <tr>
           	  <td align="left"><label>Địa chỉ Email:</label></td>
          		<td>
            	<input name="user_email" type="text" id="user_email" value="<?php echo set_value('user_email');?>" size="100" />
                <?=form_error('user_email');?>
            </td>
            </tr>
            
            <tr>
           	  <td align="left"><label>Tên dầy đủ:</label></td>
          		<td>
            	<input name="user_fullname" type="text" id="user_fullname" value="<?php echo set_value('fullname');?>" size="100" />
               
            </td>
            </tr>
            <tr>
           	  <td align="left"><label>Kích hoạt:</label></td>
          		<td>
            	<input type="checkbox" name="active" checked="checked"  />
                <?=form_error('active');?>
            </td>
            </tr>
            
           
                            </tbody>
                        </table>
                  </div>
                    <!--<div id="tab_2" style="display:none;">Noi dung tabs 2</div>
                    <div id="tab_3" style="display:none;">Noi dung tabs 3</div>-->
                    <input type="hidden" id="id" name="id" value="<?=@$group_id;?>">
                </form>
                
            </div><!--End content-->
        </div><!--End box-->
        
    </div><!--End content-->