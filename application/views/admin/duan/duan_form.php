<?php
        
        //tat ca cai nay dung de cau hinh cho ckeditter
        $config_mini = array();  
 
        $config_mini['toolbar'] = array(
            array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ,'-', 'Link', 'Unlink', 'Anchor','Image')
        );
         
// B?n có th? dùng m?ng full tùy ch?n
 $config_mini =array(
            array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' ));
//---- Ho?c tùy bi?n kích thu?c
//  $this->ckeditor->config['width'] = '730px';
//        $this->ckeditor->config['height'] = '300px';

        /* Y la configuración del kcfinder, la debemos poner así si estamos trabajando en local */
                                    $config_mini['filebrowserBrowseUrl'] = base_url()."ckeditor/ckfinder/ckfinder.html";
                                    $config_mini['filebrowserImageBrowseUrl'] = base_url()."ckeditor/ckfinder/ckfinder.html?type=Images";
                                    $config_mini['filebrowserUploadUrl'] = base_url()."ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files";
                                    $config_mini['filebrowserImageUploadUrl'] = base_url()."ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";
 
        //ket thuc cau hinh cho ckediter
?>
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
                    <a href="javascript:void(0);" onclick="location.href='<?=base_url();?>admin/duan-ad/home';" class="button">Cancel</a>
                </div>
            </div><!--End heading-->
            <div class="content">
            	<div id="tabs" class="htabs">
                	<a href="#tab_1" class="selected">Thông tin Danh mục</a>
                    <!--<a href="#tab_2">Tab 2</a>
                    <a href="#tab_3">Tab 3</a>-->
                </div><!--End tabs-->
                
                <form action="<?=$action;?>" method="post" enctype="multipart/form-data" id="frm_add">
               	  <div id="tab_1" style="display:block;">
                   	  <table width="100%" class="form">
						<tbody>
                           	  <tr>
                                  <td width="169" align="left"><label>Tên dự án:</label></td>
                                    <td width="922">
                                    	<?php if(@$article->title !='') :?>
                                        <input name="name" type="text" id="name" value="<?php echo @$article->title;?>" size="100" />
                                        <?php else : ?>
                                        <input name="name" type="text" id="name" value="<?php echo set_value('title');?>" size="100" />
                                        <?php endif;?>
                                    	<?=form_error('name');?>
                                	</td>
                                </tr>
                                
                 
                                <tr>
                                  <td width="169" align="left"><label>Khách hàng:</label></td>
                                    <td width="922">
                                    	<?php if(@$article->customer !='') :?>
                                        <input name="customer" type="text" id="customer" value="<?php echo @$article->customer;?>" size="100" />
                                        <?php else : ?>
                                        <input name="customer" type="text" id="customer" value="<?php echo set_value('customer');?>" size="100" />
                                        <?php endif;?>
                                    	<?=form_error('customer');?>
                                	</td>
                                </tr>
                                <tr>
                                  <td width="169" align="left"><label>Dịch vụ:</label></td>
                                    <td width="922">
                                    	<select name="id_group_project">
                                        	<option value="-------"></option>
                                            <?php if(!empty($cat)) : ?>
												<?php foreach($cat as $c) : ?>
													<?php if(@$article->id_group_project !='' ) : ?>
                                                  
                                                    <option value="<?=$c->id;?>" <?php if(@$article->id_group_project == $c->id) echo "selected";?>><?=$c->name;?></option>
                                                    <?php else : ?>
                                                    <option value="<?=$c->id;?>" <?php echo set_select('cat', $c->id);?>><?=$c->name;?></option>
                                                    <?php endif;?>
                                                    
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    	<?=form_error('id_group_project');?>
                                	</td>
                                </tr>
                                <tr>
                                  <td width="169" align="left"><label>Hinh anh:</label></td>
                                    <td width="922">
                                         <?    echo form_upload('userfile'); ?> <br>
                                        <?php if(@$article->img !='') : ?>
                                        <img src="<?=base_url();?><?=@@$article->img;?>" width="200" height="200">
                                        <?php endif;?>   
                                    </td>
                                </tr>
                                 <tr>
                                  <td width="169" align="left"><label>Mô tả chi tiết:</label><br><span class="help">Mô tả thông tin chi tiết về sản phẩm cần bán: Thông số, chức năng,...</span></td>
                                    <td width="922">
                                        <?php if(@$article->introduction !='') { 
                                      
                                            echo $this->ckeditor->editor("detail", @$article->introduction, $config_mini);
                                        
                                          } else { 
                                            //echo $this->ckeditor->editor("content", "", $config_mini);
                                            echo $this->ckeditor->editor("detail", "", $config_mini);
                                        } ?>
                                        <?=form_error('detail');?>
                                    </td>
                                </tr>
                                <tr>
                                  <td width="169" align="left"><label>Meta keyword:</label><br><span class="help"></span></td>
                                    <td width="922">
                                        <?php if(@$article->metakeyword !='') { 
                                      ?>
									  <textarea cols="100" rows="3" id="metakeyword" name="metakeyword">
                                        <?php echo @$article->metakeyword;?>
                                      </textarea>
									  <?php
                                            } else { 
                                            ?>
                                             <textarea cols="100" rows="3" id="metakeyword" name="metakeyword">
                                        
                                             </textarea>                                            
                                            <?php                                            
                                        } ?>
                                        <?=form_error('metakeyword');?>
                                    </td>
                                </tr>
                                <tr>
                                <td width="169" align="left"><label>Meta description:</label><br><span class="help"></span></td>
                                    <td width="922">
                                        <?php if(@$article->metadescription !='') { 
                                      ?>
                                      <textarea cols="100" rows="3" id="metadescription" name="metadescription">
                                        <?php echo @$article->metadescription;?>
                                      </textarea>   
                                           
                                        <?php  } else { 
                                            ?>
                                          <textarea cols="100" rows="3" id="metadescription" name="metadescription">
                                            
                                          </textarea>   
                                           
                                        <?php 
                                        } ?>
                                        <?=form_error('metadescription');?>
                                    </td>
                                </tr>
                                <tr>
                                  <td align="left"><label>Trang thai:</label><br /><span class="help">Nếu muốn hiển thị thì Click chọn</span></td>
                                    <td>
                                    <input type="checkbox" name="active" <?php if(@$article->display == 1) echo "checked=checked"; else "";?>/>
                                    <?=form_error('active');?>
                                </td>
                                <tr>
                                
            		     </tbody>
                        </table>
                  </div>
                    <!--<div id="tab_2" style="display:none;">Noi dung tabs 2</div>
                    <div id="tab_3" style="display:none;">Noi dung tabs 3</div>-->
                    <input type="hidden" id="id" name="id" value="<?=@$article->id;?>">
                    <input type="hidden" name="oldImage" value="<?=@$article->img;?>">
                </form>
                
            </div><!--End content-->
        </div><!--End box-->
        
    </div><!--End content-->