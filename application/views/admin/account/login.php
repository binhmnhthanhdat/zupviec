<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login page</title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>admin_template/stylesheet/style_admin.css">
<script type="text/javascript" src="<?=base_url();?>js/jquery.js"></script>
<?php if($this->session->flashdata('error')) : ?>
<script type="text/javascript">
	$(function() {
		$('#error').fadeIn(500).delay(2000).fadeOut(500);	
	});
</script>
<?php endif;?>
</head>
<body>

<div id="container">
	<div id="header">
    	<div class="div1">
        	<div class="div2"><img src="<?=base_url();?>admin_template/image/logo_admin.png" /></div>
        </div>
    </div><!--End header-->
    <div id="content">
    	<div class="box_login">
        	<div class="heading"><h1><img src="<?=base_url();?>admin_template/image/lockscreen.png" />Vui lòng nhập thông tin đăng nhập</h1></div>
            <div class="content">
            	<form action="<?=$action;?>" method="post" id="frm_login">
                	<table style="width:100%;">
                    	<tbody>
                        	<tr>
                            	<td colspan="2" align="center">
									<div id="error" style=" width:100%; padding:10px 0px; background-color:#f2f2f2; color:#ff0000; font-size:16px; display:none;"><?php if($this->session->flashdata('error') !='') echo $this->session->flashdata('error'); ?></div>
                                </td>
                            </tr>
                           
                        	<tr>
                            	<td rowspan="4" style="text-align:center;">
                                	<img src="<?=base_url();?>admin_template/image/login.png" />
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	Username: <br />
                                    <input type="text" style="margin-top:4px;" value="" name="username"/><br /><br />
                                    Password: <br />
                                    <input type="password" style="margin-top:4px;" value="" name="password" /><br />
                                    <a href="#" title="Quên mật khẩu">Quên mật khẩu</a>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                            	<td style="text-align:right;">
                                	<a href="#" onclick="$('#frm_login').submit();" class="button">Đăng nhâp</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div><!--End content-->
    <div id="footer">Nettina &copy;Copyright 2011. All rights reserved</div><!--End footer-->
</div><!--End container-->

</body>
</html>
