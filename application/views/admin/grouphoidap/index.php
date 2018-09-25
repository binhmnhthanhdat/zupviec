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
            	<form id="form_list" method="post" action="<?=base_url();?>admin/grouphoidap-ad/home">
                <input type="hidden" id="act_del" name="act_del" value="act_del" />
                	<table class="list">
                    	<thead>
                        	<tr>
                            	<td width="1" style="text-align:center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                                <td class="left"><a href="#">Tên danh mục</a></td>
                                <td class="left"><a href="#">Trạng thái</a></td>
                               <td class="right"><a href="#">Vị trí</a></td>
                                <td class="right">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if(!empty($lists)) : ?>
							<?php foreach($lists as $user) : ?>
                            <tr>
                                <td style="text-align:center"><input type="checkbox" name="selected[]" value="<?=$user['id'];?>" /></td>
                                <td class="left"><?=$user['name'];?></td>
                                 <td class="right"><? if($user['active']==1) { echo "Hiển thị"; } else { echo "Không"; } ?></td>
                                  <td class="right"><?=$user['ord'];?></td>
                                <td class="right">
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
                    	
                    </div>
                    <div class="result">Có <b></b> bản tin được tìm thấy</div>
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
		var _status = $('#status').val();
		var _group = $('#group').val();
		var url = index_url + 'admin/user/index/';
		if(_status !='' && _group !='') {
			url = url + '?trangthai=' + _status + '&group=' + _group;
		} else if(_status =='' && _group !='') {
			url = url + '?group=' + _group;
		} else if(_status !='' && _group =='') {
			url = url + '?trangthai=' + _status;
		}
		
		window.location.href = url;
		
	}
	
</script>