<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>admin_template/stylesheet/style_admin.css">
<script type="text/javascript" src="<?=base_url();?>admin_template/javascript/jquery/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?=base_url();?>admin_template/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url();?>admin_template/javascript/jquery/tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		// Tabs
		$('#tabs a').tabs();
		
		// Menu
		$('#menu > ul').superfish({
			hoverClass	 : 'sfHover',
			pathClass	 : 'overideThisToUse',
			delay		 : 0,
			animation	 : {height: 'show'},
			speed		 : 'normal',
			autoArrows   : false,
			dropShadows  : false, 
			disableHI	 : false, /* set to true to disable hoverIntent detection */
			onInit		 : function(){},
			onBeforeShow : function(){},
			onShow		 : function(){},
			onHide		 : function(){}
		});
	
		$('#menu > ul').css('display', 'block');
		
		
		$('#dashboard').addClass('selected');
		
		// Check all or uncheck
		
			$('#check_all').toggle(
			function() {
			$('#content').find('input[type=checkbox]').attr('checked', true);
			},
			function() {
			$('#content').find('input[type=checkbox]').attr('checked', false);
			});
		

		

	});
</script>
<script type="text/javascript">
	var index_url = '<?=$this->index_url;?>';
</script>
<?php if($body_tinymce != "") { ?>
<script language="javascript" type="text/javascript">
    	
tinyMCE.init({
		// General options
		mode : "exact",
		elements : "<?=$body_tinymce;?>",
		theme : "advanced",
		skin : "o2k7",
		relative_urls : false,
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,pastetext,pasteword,bullist,numlist,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect,forecolor,backcolor,blockquote,|,undo,redo,|,link,unlink,anchor",
        theme_advanced_buttons2 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,image,media,|,fullscreen,preview",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
		file_browser_callback: "ajaxfilemanager",

		/* Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		*/
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
		});
    
    	function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = "<?=base_url();?>tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
			switch (type) {
				case "image":
					break;
				case "media":
					break;
				case "flash": 
					break;
				case "file":
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: "<?=base_url();?>tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
                width: 782,
                height: 400,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
            
			/* return false;			
			var fileBrowserWindow = new Array();
			fileBrowserWindow["file"] = ajaxfilemanagerurl;
			fileBrowserWindow["title"] = "Ajax File Manager";
			fileBrowserWindow["width"] = "782";
			fileBrowserWindow["height"] = "440";
			fileBrowserWindow["close_previous"] = "no";
			tinyMCE.openWindow(fileBrowserWindow, {
			  window : win,
			  input : field_name,
			  resizable : "yes",
			  inline : "yes",
			  editor_id : tinyMCE.getWindowArg("editor_id")
			});
			
			return false;*/
			}
    
</script>
<?php } ?>

<?php //echo $this->util->tiny_mce_basic();?>
<style type="text/css">
	.error {color:red; font-size:12px;}
</style>
<?php if($this->session->flashdata('warning') !='') { ?>
<script type="text/javascript">
	$(function() {
		$('.warning').fadeIn(500).delay(2000).fadeOut(500);
	});			
</script>
<?php } ?>
</head>

<body>
	<div id="container">
        <?php echo $header;?>
        <?php echo $content;?>
        <?php echo $footer;?>
        
    </div><!--End #wrapper-->

</body>
</html>
