<div id="container">
	<div class="render_path">
    	<img src="<?=$this->index_url;?>layout/admin/images/home.png" align="absmiddle" /> &nbsp;
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
            	<img src="<?=$this->index_url;?>layout/admin/images/update.png" width="12" height="12" border="0" align="absmiddle" />&nbsp;Cập nhật</a>
            </a>
        </div>
       
    </div>
    <div id="content">
        <table cellpadding="0" cellspacing="20" id="table_content">
<tr>
           	  <td align="left"><label>Tên đầy đủ:</label></td>
          	<td>
            	<input type="text" id="fullname" name="fullname" value="<?=$user->user_fullname;?>" />
                <?php echo form_error('fullname');?>
            </td>
            </tr>
            <tr>
           	  <td align="left"><label>Địa chỉ Email:</label></td>
              <td><input type="text" id="email" name="email" value="<?=$user->user_email;?>" />
              <?php echo form_error('email');?>
              </td>
            </tr>
            
        </table>
              
    </div>
    </form>
</div>
