<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi-vn" xml:lang="vi-vn" >
    <head>
        <?php
        $sql = "select * from setting ";
        $setting = $this->db->query($sql);
        $kqsetting = $setting->row();
        ?>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="content-language" content="vi" />
<title><?php if (isset($title)) { echo ucfirst(($title));} else { echo ucfirst(($kqsetting->site_name));} ?></title>
<meta name="description" content="<?php if (isset($description)) { echo $description; } else { echo $kqsetting->meta_desc;  } ?>" />
<meta name="robots" content="index, follow" />
<meta name="geo.placename" content="Trung Hoa Nhan Chinh, Ha Noi, Viet Nam" />
<meta name="geo.region" content="VN-HN" />
<meta name="geo.position" content="21.010153;105.798835" />
<meta name="ICBM" content="21.010153, 105.798835" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Dịch vụ dọn vệ sinh văn phòng tại Hà Nội - TP.HCM" />
<meta property="og:description" content="Công ty dịch vụ vệ sinh văn phòng theo giờ tại Hà Nội, dịch vụ vệ sinh công ty theo giờ Hà Nội. L/H: 096996.3553" />
<meta property="og:url" content="http://zupviec.com/" />
<meta property="og:site_name" content="Dịch vụ vệ sinh văn phòng Hà Nội, L/H dịch vụ vệ sinh công ty: 096996.3553" />
<meta property="og:image" content="http://zupviec.com/images/slide/dich-vu-ve-sinh-van-phong.jpg"/>
<meta property="article:publisher" content="https://plus.google.com/u/0/+ThangPV/posts/" />
<meta property="article:author" content="https://www.facebook.com/thangpv1279" />
<meta name="DC.Title" content="Dịch vụ vệ sinh văn phòng, công ty dịch vụ vệ sinh Hà Nội HCM" />
<meta name="DC.Creator" content="Công ty dịch vụ vệ sinh VHE" />
<meta name="DC.Date" content="2014-13-13" />
<meta name="DC.Format" scheme="DCMIType" content="Text" /> 
<meta name="DC.Identifier" content="http://zupviec.com" />
<meta name="DC.Type" content="text/html" />
<meta name="DC.Description" content="Công ty VHE cung cấp dịch vụ vệ sinh văn phòng theo giờ tại Hà Nội, dịch vụ vệ sinh theo giờ Hà Nội. LH: 09.69963553" />
<link rel="shortcut icon" href="http://zupviec.com/favicon.ico" />
<link href="http://www.zupviec.com/rss" rel="alternate" type="application/rss+xml" title="RSS 2.0" />
<link type="text/css" href=" http://zupviec.com/css/style.css?binh=123456" rel="stylesheet"  />
<link rel="canonical" href="http://zupviec.com/" />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-53577835-1', 'auto');
  ga('send', 'pageview');
</script>
    </head>
    <body>
        <?php $this->load->view('layout/menu') ?>
        <div id="wrapper">
            <div id="fixBody">
                <?php $this->load->view('layout/header') ?>
                <div id="MainBody">
                    <?php $this->load->view($content) ?>
                    <?php $this->load->view('layout/menufooter') ?>
                </div>
                <div class="clearFix"></div>
                <div id="footer">
                    <?php $this->load->view('layout/footer') ?>
                    <div style="line-height: 36px;position: fixed; right: 0px; bottom: 0px;z-index:9999;background:#0f4e77;border-radius: 5px 5px 0px 0px;margin-right:50px;">
                        <center><a href="tel:0969963553" style="color:white;line-height: 30px;padding:10px;font-size:16px;">Hà Nội: 0969963553 HCM: 0938061114</a></center>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src=" <?php echo base_url(); ?>js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.bxslider.min.js"></script>
        <script type="text/javascript">
             $('.bxslider').bxSlider({
                 auto: true,
                 captions: true
             });
        </script>
    </body>
</html>