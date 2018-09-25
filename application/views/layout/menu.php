<?php
$sql = "select * from setting ";
$setting = $this->db->query($sql);
$kqsetting = $setting->row();
?>
<div class="clearFix"></div>
<div style="background:#0b5384;" >
    <div class="menuBar" id="ddtopmenubar">
        <a href="<?php echo base_url(); ?>" class="nav-btn">DỊCH VỤ VỆ SINH VĂN PHÒNG<span></span></a>
        <span class="top-nav-shadow"></span>
        <ul id="ulmenuBar">
           <li class="active"><a  style="padding-top: 10px;"  href="<?php echo base_url(); ?>" title="Dịch vụ vệ sinh văn phòng" class="upcase fontsize11"><img src="<?php echo base_url(); ?>/images/dich-vu-ve-sinh-van-phong.png" alt='dich-vu-ve-sinh-van-phong' style="padding: 0 10px;"/></a></li>
            <?php
            $sql = "select * from cat_new where active=1 and parent=0 order by ord asc";
            $laymenu = $this->db->query($sql);
            if ($laymenu->num_rows() > 0) {
                foreach ($laymenu->result() as $kqlaymenu) {
                    ?>
                    <li><a  href="<?php
                    if ($kqlaymenu->type == 1) {
                        echo base_url('cong-ty');
                    } else if ($kqlaymenu->type == 2) {
                        echo base_url('bang-gia');                    
                    }
                    ?>"  title="<?php echo $kqlaymenu->name; ?>" class="upcase fontsize11"><span> <?php echo $kqlaymenu->name; ?></span></a></li>
                            <?php
                        }
                    }
                    ?>
        </ul>
        <div class="group_tieude">
            <h1 style = " padding-right: 10px;" class="tieude" title="<?php if (isset($title)) {
                        echo $title;
                    } else {
                        echo $kqsetting->site_name;
                    } ?>"><?php if (isset($title)) {
                        echo $title;
                    } else {
                        echo $kqsetting->site_name;
                    } ?></h1>
            <div style="clear:both" >
                <p  style = "display: block; padding-right: 20px;" >Liên hệ tại Hà Nội: 0969963553 - HCM: 0938061114</p>
            </div>
        </div>
    </div>
</div>