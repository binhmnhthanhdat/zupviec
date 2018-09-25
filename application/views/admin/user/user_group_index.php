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
            	<form id="form_list" method="post" action="<?=$this->index_url;?>admin/user_group">
                <input type="hidden" id="act" name="act" value="act_del" />
                	<table class="list">
                    	<thead>
                        	<tr>
                            	<td width="1" style="text-align:center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                                <td class="left"><a href="#">Tên nhóm</a></td>
                                <td class="right">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if(!empty($nhom)) : ?>
							<?php foreach($nhom as $n) : ?>
                            <tr>
                                <td style="text-align:center"><input type="checkbox" name="selected[]" /></td>
                                <td class="left"><?=$n['group_name'];?></td>
                                <td class="right">
                                    <a href="<?=$n['url_edit'];?>">Edit</a> :: <a href="<?=$n['url_del'];?>" title="Xóa User này" id="action_del_<?=$n['group_id'];?>" onclick="do_del(<?=$n['group_id'];?>); return false;">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </form><!--End form-->
                
                <div class="pagination">
                	<div class="link">
                    	<a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                    </div>
                    <div class="result">Hiển thị từ 1 đến 20 của 190 bản tin (86 trang)</div>
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