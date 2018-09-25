    <div class="clearFix"></div>
    <?php
    $alias_menu = $this->session->userdata('anh');
    if ($alias_menu != "") {
        $sql = "select * from cat_new where alias='$alias_menu' limit 0,1";
        $lay_url_anh = $this->db->query($sql);
        if ($lay_url_anh->num_rows() > 0) {
            $kq_lay_url_anh = $lay_url_anh->row();
    ?>
            <img src="<?php echo base_url(); echo $kq_lay_url_anh->image; ?>" width="1024px;" height="220px;" class="image_banner" style="margin-top: 10px; " alt="<?php echo $kq_lay_url_anh->name; ?>" title="<?php echo $kq_lay_url_anh->name; ?>" />
    <?php
        }
    } else {
   ?>
    <div class="clearFix"></div>
    <div class="header_slide"  >
        <ul class="bxslider">
            <?php
            $sql="select * from slide where active=1 order by ord desc limit 0,3";
            $layslide=$this->db->query($sql);
            if($layslide->num_rows()>0)
            {
                foreach($layslide->result() as $kqlayslide)
                {
                ?>
                <li><img src="<?echo base_url();?><? echo $kqlayslide->img;?>" title="<? echo $kqlayslide->contents;?>"  width="1024px" height="350px"/></li>
                <?php
                }
            }
            ?>
        </ul>
    </div>
    <?php
    }
    ?>