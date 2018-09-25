<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi-vn" xml:lang="vi-vn" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>404 Page Not Found</title>
<style type="text/css">

* { 
	margin:0;
	padding:0;
}
html, body { 
	height:100%;
}
body { 
	background:#fff;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size:100%; 
	line-height:1.25em;
	color:#b2b3c4;
	font-style:italic;
}

img {
	border:0; 
	vertical-align:top; 
	text-align:left;
}

ul, ol { 
	list-style:none;
}


.wrapper { 
	width:100%;
	overflow:hidden;
}


/*==== GLOBAL =====*/
#main {
	width:1000px; 
	margin:0 auto;
	background:url(<? echo base_url();?>images/main-bg.jpg) no-repeat left top;
	font-size:1.125em;
	overflow:hidden;
	position:relative;
}

#header {
	height:190px;
}
#content {
	min-height:457px;
	height:auto !important;
	height:457px;
}
#footer {
	font-family:Tahoma, Geneva, sans-serif;
	color:#d9daed;
	font-size:12px;
	text-align:center;
	padding:8px 0 15px 0;
	font-style:normal;
}
	#footer a {
		color:#d9daed;
	}

p {
	margin-bottom:8px;
	text-align:center;
	padding:0 20px;
	letter-spacing:-1px;
}

/*----- txt, links, lines, titles -----*/
a {
	color:#8e8fc9; 
	outline:none;
}
a:hover{
	text-decoration:none;
}

h1 {
	font-size:40px;
	line-height:1.2em;
	font-weight:normal;
	color:#8e8fc9;
	text-align:center;
	padding:80px 0 0 0;
	text-transform:capitalize;
	letter-spacing:-2px;
}
	h1 span {
		display:block;
		font-size:24px;
		line-height:25px;
		font-variant:normal;
		text-transform:none;
		letter-spacing:-1px;
		font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	}


/*===== content =====*/
#content .nav {
	position:relative;
	height:360px;
}
	#content .nav li {
		position:absolute;
		font-size:24px;
		line-height:1.2em;
		font-weight:bold;
		text-transform:uppercase;
		font-weight:normal;
		letter-spacing:-1px;
		text-transform:capitalize;
	}
	#content .nav li.home {
		left:445px;
		top:270px;
	}
	#content .nav li.site_map {
		left:120px;
		top:65px;
	}
	#content .nav li.search {
		right:90px;
		top:65px;
	}
		#content .nav li a {
			color:#a8a9d4;
			text-decoration:none;
		}
		#content .nav li a:hover {
			text-decoration:underline;
		}

/*==========================================*/

</style>

</head>
<body>
        
        <div id="main">
		<!-- header -->
		<div id="header">
			<h1>
           
            Yêu cầu của bạn hệ thống chưa kịp xử lý hoặc nội dung không được tìm thấy !
           <span>404 Error - Not Found </span></h1>
		</div>
		<!-- content -->
		<div id="content">
			<ul class="nav">
         	<li class="home"><a href="<? echo base_url();?>">Click vào đây để về trang chủ.</a></li>
            
         </ul>
         <p>Hey, you're early! You don't belong here - at least not today. Besides, what you're looking for is not here anyways.<br />
         So why don't you go to our <a href="<? echo base_url();?>">homepage</a>.</p>
		</div>
		<!-- footer -->
		<div id="footer">
      	
      </div>
	</div>
     
</body>
</html>