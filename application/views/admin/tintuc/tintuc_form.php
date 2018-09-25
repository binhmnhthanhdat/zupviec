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
                    <a href="javascript:void(0);" onclick="location.href='<?= base_url();?>admin/tintuc-ad/home';" class="button">Cancel</a>
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
                                  <td width="169" align="left"><label>Tiêu đề tin tuc:</label></td>
                                    <td width="922">
                                    	<?php if(@$article->title !='') :?>
                                        <input name="title" type="text" id="title" value="<?php echo @$article->title;?>" size="100" />
                                        <?php else : ?>
                                        <input name="title" type="text" id="title" value="<?php echo set_value('title');?>" size="100" />
                                        <?php endif;?>
                                    	<?=form_error('title');?>
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
                                  <td width="169" align="left"><label>Loại tin:</label></td>
                                    <td width="922">
                                    	<select name="id_group_new">
                                            <option value="0" selected >Chọn</option>
                                            <?php if(!empty($cat)) : ?>
												<?php foreach($cat as $c) : ?>
													<?php if(@$article->id_group_new !='' ) : ?>
                                                  
                                                    <option value="<?=$c->id;?>" <?php if(@$article->id_group_new == $c->id) echo "selected";?>><?=$c->name;?></option>
                                                    <?php else : ?>
                                                    <option value="<?=$c->id;?>" <?php echo set_select('cat', $c->id);?>><?=$c->name;?></option>
                                                    <?php endif;?>
                                                    
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    	<?=form_error('id_group_new');?>
                                	</td>
                                </tr>
                               <tr>
                                 <tr>
                                  <td width="169" align="left"><label>Tin project:</label></td>
                                    <td width="922">
                                    	<select name="id_group_project">
                                            <option value="0" selected >Chọn</option>
                                            <?php if(!empty($project)) : ?>
												<?php foreach($project as $p) : ?>
													<?php if(@$article->id_group_project !='' ) : ?>
                                                  
                                                    <option value="<?=$p->id;?>" <?php if(@$article->id_group_project == $p->id) echo "selected";?>><?=$p->name;?></option>
                                                    <?php else : ?>
                                                    <option value="<?=$p->id;?>" <?php echo set_select('id_group_project', $p->id);?>><?=$p->name;?></option>
                                                    <?php endif;?>
                                                    
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    	<?=form_error('id_group_project');?>
                                	</td>
                                </tr>
                                
                                <tr>
                                   <td align="left"><label>Hiển thị Tin tuyển dụng </label><br /><span class="help">Nếu muốn hiển thị là tin tuyển dụng thì Click chọn</span></td>
                                     <td>
                                    <input type="checkbox" name="tin_tuyen_dung" <?php if(@$article->tin_tuyen_dung == 1) echo "checked=checked"; else "";?>/>
                                    <?=form_error('tin_tuyen_dung');?>
                                </td>
                                </tr>
                                 <tr>
                                  <td align="left"><label>Hiển thị đầu tiên trong Box Tin </label><br /><span class="help">Nếu muốn hiển thị thì Click chọn</span></td>
                                    <td>
                                    <input type="checkbox" name="tin_box_chinh" <?php if(@$article->tin_box_chinh == 1) echo "checked=checked"; else "";?>/>
                                    <?=form_error('tin_box_chinh');?>
                                </td>
                                </tr>
                                <tr>
                                  <td width="169" align="left"><label>Tag:</label></td>
                                    <td width="922">
                                    	<?php if(@$article->tag !='') :?>
                                        <input name="tag" type="text" id="tag" value="<?php echo @$article->tag;?>" size="100" />
                                        <?php else : ?>
                                        <input name="tag" type="text" id="tag" value="<?php echo set_value('tag');?>" size="100" />
                                        <?php endif;?>
                                    	<?=form_error('tag');?>
                                	</td>
                                </tr>
                                 <tr>
                                  <td width="169" align="left"><label>Thứ tự:</label></td>
                                    <td width="922">
                                    	<?php if(@$article->ord !='') :?>
                                        <input name="ord" type="text" id="ord" value="<?php echo @$article->ord;?>" size="100" />
                                        <?php else : ?>
                                        <input name="ord" type="text" id="ord" value="<?php echo set_value('ord');?>" size="100" />
                                        <?php endif;?>
                                    	<?=form_error('ord');?>
                                	</td>
                                </tr>
                                
                                <tr>
                                  <td width="169" align="left"><label>Ngày sửa:</label></td>
                                    <td width="922">
                                    	<?php if(@$article->modified !='') :?>
                                        <input name="modified" type="text" id="modified" value="<?php echo @$article->modified;?>" size="100" />dd/mm/yy                                        <?php else : ?>
                                        <input name="modified" type="text" id="modified" value="<?php echo set_value('modified');?>" size="100" />dd/mm/yy  
                                        <?php endif;?>
                                    	<?=form_error('modified');?>
                                	</td>
                                </tr>
                                <tr>
                                  
                                  <td width="169" align="left"><label>Giới thiệu :</label><br><span class="help">Mô tả thông tin chi tiết về sản phẩm cần bán: Thông số, chức năng,...</span></td>
                                    <td width="922">
                                        <?php if(@$article->description !='') { 
                                      
                                            echo $this->ckeditor->editor("description", @$article->description, $config_mini);
                                        
                                          } else { 
                                            //echo $this->ckeditor->editor("content", "", $config_mini);
                                            echo $this->ckeditor->editor("description", "", $config_mini);
                                        } ?>
                                        <?=form_error('description');?>
                                    </td>
                                </tr>
                                </tr>
                                
                                  
                                 <tr>
                                  <td width="169" align="left"><label>Hình ảnh:</label></td>
                                    <td width="922">
                                        
                                        <?    echo form_upload('userfile'); ?> <br>
                                        <?php if(@$article->img !='') : ?>
                                        <img src="<?=base_url();?><?=@$article->img;?>"  width="100" height="100" >
                                        <?php endif;?>                                      
                                    </td>
                                </tr>
                                <tr>
                                  <td width="169" align="left"><label>Mô tả chi tiết:</label><br><span class="help">Mô tả thông tin chi tiết về sản phẩm cần bán: Thông số, chức năng,...</span></td>
                                    <td width="922">
                                        <?php if(@$article->content !='') { 
                                      
                                            echo $this->ckeditor->editor("detail", @$article->content, $config_mini);
                                        
                                          } else { 
                                            //echo $this->ckeditor->editor("content", "", $config_mini);
                                            echo $this->ckeditor->editor("detail", "", $config_mini);
                                        } ?>
                                        <?=form_error('detail');?>
                                    </td>
                                </tr>
                                <tr>
                                  <td align="left"><label>Trang thai:</label><br /><span class="help">Nếu muốn hiển thị thì Click chọn</span></td>
                                    <td>
                                    <input type="checkbox" name="display" <?php if(@$article->display == 1) echo "checked=checked"; else "";?>/>
                                    <?=form_error('display');?>
                                </td>
                                </tr>
                                
                                
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