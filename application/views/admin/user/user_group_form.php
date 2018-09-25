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
                    <a href="javascript:void(0);" onclick="location.href='<?=$this->index_url;?>admin/user_group';" class="button">Cancel</a>
                </div>
            </div><!--End heading-->
            <div class="content">
            	<div id="tabs" class="htabs">
                	<a href="#tab_1" class="selected">Quyền người dùng</a>
                    <!--<a href="#tab_2">Tab 2</a>
                    <a href="#tab_3">Tab 3</a>-->
                </div><!--End tabs-->
                
                <form action="<?=$action;?>" method="post" enctype="multipart/form-data" id="frm_add">
                	<div id="tab_1" style="display:block;">
                    	<table class="form">
                        	<tbody>
                            	<tr>
                                  	<td width="129"><label>Tên nhóm:</label></td>
                              <td width="446">
                                        <?php if(@$group_name != NULL) { ?>
                        				<input type="text" id="group_name" name="group_name" size="100" value="<?php echo @$group_name;?> " />
                                        <?php } else { ?>
                                        <input type="text" id="group_name" name="group_name" size="100" value="<?php echo set_value('group_name');?> " />
                                        <?php } ?>
                                        <?php echo form_error('group_name');?>
                                    </td>
                              </tr>
            					<tr>
                                      <td valign="top"><label>Quyền xem trên trang:</label> <?=form_error('permis_view[]');?></td>
                                      <td>
                                            <div style="overflow-y:scroll; width:250px; height:150px;">
                                                <?php foreach($permissions as $per):?>
                                                      <?php if(@$permission_view > 0) { ?>
                                                      <input type="checkbox" name="permis_view[]" value="<?=$per;?>" <?php if(in_array($per, @$permission_view)) echo "checked"; ?> >&nbsp;<?=$per;?><br>
                                                      <?php } else { ?>
                                                       <input type="checkbox" name="permis_view[]" value="<?=$per;?>" <?php echo set_checkbox('permis_view[]', $per);?>>&nbsp;<?=$per;?><br>
                                                       <?php } ?>
                                                 <?php endforeach;?>
                                            </div>
                                      </td>
                                </tr>
            
                                <tr>
                                      <td valign="top"><label>Quyền xóa và sửa trên trang:</label> <?=form_error('permis_edit_delete[]');?></td>
                                      <td>
                                            <div style="overflow-y:scroll; width:250px; height:150px;">
                                                <?php foreach($permissions as $per):?>
                                                      <?php if(@$permission_edit_delete > 0) { ?>
                                                      <input type="checkbox" name="permis_edit_delete[]" value="<?=$per;?>" <?php if(in_array($per, @$permission_edit_delete)) echo "checked"; ?> >&nbsp;<?=$per;?><br>
                                                      <?php } else { ?>
                                                       <input type="checkbox" name="permis_edit_delete[]" value="<?=$per;?>" <?php echo set_checkbox('permis_edit_delete[]', $per);?>>&nbsp;<?=$per;?><br>
                                                       <?php } ?>
                                                 <?php endforeach;?>
                                            </div>
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