<div id="container">
	<div class="render_path">
    	<?php if($render_path) : ?>
			<?php foreach($render_path as $key => $url) : ?>
            <a href="<?=$url;?>"><?=$key;?></a> &raquo;
            <?php endforeach;?>
        <?php endif;?>
    </div>
    <form action="<?=$action;?>" method="post" id="frm">
    <div class="heading_top">
 
        <div class="info_title">
        	<img src="<?=$this->index_url;?>layout/admin/images/info-16.png" align="absmiddle" /> &nbsp;
        	<?php echo $heading_top;?>    
        </div>
        <div class="div_action">
        	<a href="#" title="Nhấn vào đây để cập nhật" onclick="$('#frm').submit(); return false;">
            	<img src="<?=$this->index_url;?>layout/admin/images/update.png" width="12" height="12" border="0" align="absmiddle" />&nbsp;Cập nhật
            </a>
        </div>
       
    </div>
    <div id="content">
        <table cellpadding="0" cellspacing="20" id="table_content">
<tr>
           	  <td align="left"><label>Mật khẩu cũ:</label></td>
          	<td>
            	<input type="password" id="oldpass" name="oldpass" />
                <?php echo form_error('oldpass');?>
            </td>
            </tr>
            <tr>
           	  <td align="left"><label>Mật khẩu mới:</label></td>
              <td><input type="password" id="newpass" name="newpass" />
              <?php echo form_error('newpass');?>
              </td>
            </tr>
            <tr>
           	  <td align="left"><label>Xác nhận lại mật khẩu:</label></td>
              <td><input type="password" id="comfirm_pass" name="comfirm_pass" />
              	<?php echo form_error('comfirm_pass');?>
              </td>
            </tr>
        </table>
              
    </div>
    </form>
</div>
