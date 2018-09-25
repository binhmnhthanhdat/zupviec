<div id="header">
    	<div class="div1">
            <div class="div3">
            	<img src="<?=base_url();?>admin_template/image/lock.png" />
                Tài khoản <span><?php echo $this->session->userdata('username');?> | <a href="<?= base_url();?>admin/user/logout" style="color:#ffffff; text-decoration:none;">Thoát</a></span>
            </div>
        </div>
        <div id="menu">
        	<ul class="left">
            	<li id="dashboard"><a href="<?= base_url();?>admin/trangchu/home" class="top">Admin page</a></li>
                <li><a href="#" class="top">Hệ thống</a>
                	<ul>
                    	<li><a href="<?= base_url();?>admin/setting-ad/home">Cài đặt chung</a>
                        <li><a href="<?= base_url();?>admin/menu-ad/home">Menu</a>
						<li><a href="<?= base_url();?>admin/groupmenufooter-ad/home">Nhóm tin Footer</a>
                        <li><a href="<?= base_url();?>admin/menufooter-ad/home">List tin Footer</a>
						<li><a href="<?= base_url();?>admin/grouphoidap-ad/home">Nhóm tin hỏi đáp</a>
                        <li><a href="<?= base_url();?>admin/listhoidap-ad/home">List tin hỏi đáp</a>
                    	<li><a href="<?= base_url();?>admin/user-ad/home">Thành viên</a></li>
                        
                    </ul>
                </li>
                <li><a href="#" class="top">Dịch vụ</a>
                	<ul>
                    	<li><a href="<?= base_url();?>admin/danhmucdichvu-ad/home">Danh mục dịch vụ</a></li>
                       
                    </ul>
                </li>
                <li><a href="#" class="top">Dự án </a>
                	<ul>
                    	<li><a href="<?= base_url();?>admin/duan-ad/home">Quản lí dự án</a></li>
                        
                    </ul>
                </li>
                <li><a href="#" class="top">Tin tức </a>
                	<ul>
                        <li><a href="<?= base_url();?>admin/grouptin-ad/home">Nhóm tin tức</a></li>
                    	<li><a href="<?= base_url();?>admin/tintuc-ad/home">List tin tức</a></li>
                        <li><a href="<?= base_url();?>admin/tinhienthi-ad/home">Tin hiển thị</a></li>
                       
                    </ul>
                </li>
                <li><a href="#" class="top">Khác</a>
                	<ul>
                    
                        <li><a href="<?= base_url();?>admin/listgioithieu-ad/home">Giới thiệu</a></li>
                       <li><a href="<?= base_url();?>admin/slide-ad/home">Quản Lí slide</a></li>
					    <li><a href="<?= base_url();?>admin/parttent-ad/home">Quản Lí Partner</a></li>
                        <li><a href="<?= base_url();?>admin/maillienhe-ad/home">Mail Liên hệ</a></li>
                         
                    </ul>
                </li>
                
            </ul>
        </div><!--End menu-->
    </div><!--End header-->