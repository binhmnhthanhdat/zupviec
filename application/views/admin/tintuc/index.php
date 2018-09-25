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
            	<h1><img src="<?=base_url();?>admin_template/image/category.png" /><?=@$heading_title;?></h1>
                <div class="buttons">
                	<a href="javascript:void(0);" onclick="location.href='<?=$url_create;?>';" class="button">Insert</a>
                    <a href="javascript:void(0);" onclick="$('#form_list').submit();" class="button">Delete</a>
                </div>
            </div><!--End heading-->
            <div class="content">
                 
				<div style="clear: both;"></div>
            	<form id="form_list" method="post" action="<?=base_url();?>admin/tintuc-ad/home">
                <input type="hidden" id="act_del" name="act_del" value="act_del" />
               
                	<table class="list">
                    	<thead>
                        	<tr>
                            	<td width="1" style="text-align:center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                                
                                <td class="left"><a href="#">Tiêu  đề</a></td>
                              
                                <td class="left"><a href="#">Hình ảnh</a></td>
                                <td class="left"><a href="#">Mô tả</a></td>
                                <td class="left"><a href="#">Tag</a></td>
                                <td class="left"><a href="#">Danh mục tin</a></td>
                                <td class="left"><a href="#">Danh mục dịch vụ</a></td>
                                <td class="left"><a href="#">Trạng thái</a></td>
                               
                                <td class="right">Action</td>
                            </tr>
                            
                        </thead>
                        <tbody>
							<tr class="filter">
                            	<td></td>
                                <td><input type="text" id="title" name="title"  value="<?php echo $_title; ?>" /></td>
								<td></td>
								<td><input type="text" id="des" name="des"  value="<?php echo $_des; ?>" /></td>
								<td><input type="text" id="tag" name="tag"  value="<?php echo $_tag; ?>" /></td>
                                <td>
                                	<select id="news_group" name="news_group">
                                    	<option value=""></option>
                                        <?php if(!empty($news_group)) : ?>
												<?php foreach($news_group as $kqnews_group) : ?>
                                                    <option value="<?=$kqnews_group->id;?>" <?php if(@$_news_group == $kqnews_group->id) echo "selected";?>><?=$kqnews_group->name;?></option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                    </select>
                                </td>
								<td>
                                	<select id="project_group" name="project_group">
                                    	<option value=""></option>
                                        <?php if(!empty($project_group)) : ?>
												<?php foreach($project_group as $kqproject_group) : ?>
                                                    <option value="<?=$kqproject_group->id;?>" <?php if(@$_project_group == $kqproject_group->id) echo "selected";?>><?=$kqproject_group->name;?></option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                    </select>
                                </td>
                                <td>
                                	<select id="status" name="status">
                                    	<option value="" selected></option>
                                        <option value="1" <?php if($_status == 1) { echo "selected"; } ?>>Enbale</option>
                                        
                                        <option value="0" <?php if($_status == 0) { echo "selected"; };?>>Disable</option>
										
                                         
                                    </select>
                                </td>
                                <td class="right"><a class="button" onclick="do_search();">Lọc sản phẩm</a></td>
                            </tr>
							
							
							
                        	<?php if(!empty($lists)) : ?>
							<?php foreach($lists as $user) : ?>
                            <tr>
                                <?// echo count($lists);?>
                                <td style="text-align:center;width: 5%;"><input type="checkbox" name="selected[]" value="<?=$user['id'];?>" /></td>
                                <td class="left" style="width: 10%;"><?=$user['title'];?></td>
                                
                                <td class="left" style="width: 10%;"><img src="<? echo base_url().$user['img'];?>" alt="tin tuc"  width="100" height="100" /></td>
                                 
                               
                               <td class="left" style="width: 25%;"><? echo mb_substr($user['description'], 0,200, 'UTF-8');;?></td>
                             
                              <td class="left" style="width: 10%;"><?=$user['tag'];?></td>
                                <td class="left"  style="width: 10%;"><?
                              
                                $idgroupnew=$user['id_group_new'];
                                 $sql="select * from group_new where id=\"".$idgroupnew."\"";	
                                 $laytengroupnew= $this->db->query($sql);
                                 if($laytengroupnew->num_rows()>0)
                                 {
                                     $kqlaytengroupnew=$laytengroupnew->row();
                                    echo $kqlaytengroupnew->name;
                                 }
                                 else
                                 {
                                    echo "None";
                                 }
                                
                                ?></td>
                                  <td class="left" style="width: 10%;"><?
								  
								  //id_group_project
                                    $id_group_project=$user['id_group_project'];
									 $sql="select * from group_project where id=\"".$id_group_project."\"";	
									 $laygroup_project= $this->db->query($sql);
									 if($laygroup_project->num_rows()>0)
									 {
										 $kqlaygroup_project=$laygroup_project->row();
										echo $kqlaygroup_project->name;
									 }
									 else
									 {
										echo "None";
									 }
                                        ?></td>
                                <td class="right" style="width: 10%;">
                                	<?if($user['display']==1)
                                		echo "Hiển thị";
                                	else
                                		echo "Không";
                                	?>
                                </td>
                                
                                
                                 
                                <td class="right" style="width: 10%;">
                                    <a href="<?=$user['url_edit'];?>">Edit</a> :: <a href="<?=$user['url_del'];?>" title="Xóa User này" id="action_del_<?=$user['id'];?>" onclick="do_del(<?=$user['id'];?>); return false;">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </form><!--End form-->
                
                <div class="pagination">
                	<div class="link">
                    	 <? 
                           echo $this->pagination->create_links(); // tạo link phân trang 
                         ?>
                    </div>
                    <div class="result">Có <b><? echo $sobanghi ; ?></b> bản tin được tìm thấy</div>
                </div><!--End pagination-->
                
            </div><!--End content-->
        </div><!--End box-->
        
    </div><!--End content-->

<script type="text/javascript">
	// Action delete record
	function do_del(id) {
		
			var ok = confirm('Bạn có chắc muốn xóa bản tin này hay không?');
			var url = $('#action_del_' + id).attr('href');
			if(ok) {
				window.location.href = url;
			}
		//});
	};
	
	// Function change group
	function doi_nhom(id) {
		var _group_id = $('#change_group_' + id).val();
		var _user_id = $('#user_id_' + id).val();
		var url = index_url + 'admin/user/change_group';
		//alert(_user_id);
		
		if(_group_id !='') {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: url,
				data: "group_id=" + _group_id + "&user_id=" + _user_id,
				success: function(data) {
					if(data == 'ok') {
						alert('Cập nhật nhóm thành công');
						location.reload(true);
					} else {
						alert('Không thể cập nhật nhóm');
					}
				}
			}); 
		} 
	}
	
	// Function search
	function do_search() {
		var _title = $('#title').val();
		var _des = $('#des').val();
		var _tag = $('#tag').val();
        var _news_group= $('#news_group').val();
        var _project_group = $('#project_group').val();//hot
        var _status = $('#status').val();//hot
		var url = '<?php echo base_url();?>' + 'admin/tintuc-ad/home/';
		
		url = url + '?title=' + _title + '&des=' + _des + '&tag=' + _tag+ '&news_group=' + _news_group+ '&project_group=' + _project_group+ '&status=' + _status;
		
		window.location.href = url;
		
	}
	
</script>