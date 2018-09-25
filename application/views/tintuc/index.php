<div class="tintuc">
    <div class="menu_tin">
        <ul>
            <?php
            if ($laygrouptintuc->num_rows() > 0) {
                $i = 0;
                if ($this->uri->segment(3) != "" && !is_numeric($this->uri->segment(3))) {
                    $url = $this->uri->segment(3);
                } else if ($this->uri->segment(2) != "" && !is_numeric($this->uri->segment(2))) {
                    $url = $this->uri->segment(2);
                } else if ($this->uri->segment(1) != "" && !is_numeric($this->uri->segment(1))) {
                    $url = $this->uri->segment(1);
                }
                foreach ($laygrouptintuc->result() as $kqlaygrouptintuc) {
                    $i++;
                    ?>
                    <li><h2><a href="<?php echo base_url(); ?>tin-tuc/<?php echo $kqlaygrouptintuc->alias; ?>" class="color51  <?php if ($url == $kqlaygrouptintuc->alias) { echo "active"; $groupnameactive = $kqlaygrouptintuc->title; } ?>" title=" <?php echo $kqlaygrouptintuc->title; ?>"><span></span> <?php echo $kqlaygrouptintuc->title; ?></a></h2></li>
                <?php
                }
            }
            ?>
        </ul>
    </div>
    <div class="content">
        <div class="box_dau">
            <div class="breadcrumb">
                <a class = "bread" href="<?php echo base_url(); ?>">Dịch vụ vệ sinh văn phòng</a>
                <span class="breadcrumb-separator">»</span>
                <a class = "bread"  href="<?php echo base_url() . "tin-tuc/" . $this->uri->segment(2); ?>"><?php echo $groupnameactive; ?></a>
            </div>
            <?php
            $id_tindau = 0;
            if (($laytinmoi->num_rows() > 0)) {
                $kqlaytinmoi = $laytinmoi->row();
                $id_tindau = $kqlaytinmoi->id;
                $id_group_new = $kqlaytinmoi->id_group_new;
                $function = $this->db->query("select alias from group_new where type=1 and id=\"" . $id_group_new . "\"   limit 0,1")->row()->alias;
                ?>
                <div class="box_dau_left">
                    <div class="anh">
                        <a href="<?php echo base_url(); ?><?php echo $function; ?>/<?php echo $kqlaytinmoi->alias; ?>" title="<?php echo $kqlaytinmoi->title; ?>"><img src="<?php echo base_url();
                              echo $kqlaytinmoi->img; ?>" alt="<?php echo $kqlaytinmoi->title; ?>"  /></a>
                    </div>
                    <div class="noidung">
                        <div class="tieude">
                            <a class="title_hidden fontsize16 bold"  href="<?php echo base_url(); ?><?php echo $function; ?>/<?php echo $kqlaytinmoi->alias; ?>" title="<?php echo $kqlaytinmoi->title; ?>" ><?php echo $kqlaytinmoi->title; ?></a>
                        </div>
                        <div class="tomtat">
                            <p class="dongdo"></p>
                             <?php echo $kqlaytinmoi->description; ?>
                        </div>
                    </div>
                </div>
                <div class="box_dau_right">
                    <p class="tinnoibat" style="font-size: 16px;" >Tin tức nổi bật</p>
                    <p class="dongdo"></p>
                    <ul style="margin-top: 7px;">
                <?php
                if ($laytinmoi->num_rows() > 0) {
                    foreach ($laytinmoi->result() as $kqlaytinmoi) {
                        if ($kqlaytinmoi->id != $id_tindau) {
                            ?>
                                    <li><a class="title_hidden"  href="<?php echo base_url(); ?><?php echo $function; ?>/<?php echo $kqlaytinmoi->alias; ?>" class="fontsize13" title=" <?php echo $kqlaytinmoi->title; ?>"> <?php echo $kqlaytinmoi->title; ?></a></li>
                            <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                        <?php
                    }
                    ?>
            <div style="clear: both;"></div>
        </div>
        <div class="box_chinh">
            <?php
            if ($laytinmoi->num_rows() > 0) {
                $chanle = 0;
                foreach ($laytinmoi->result() as $kqlaytinmoi) {
                    if ($kqlaytinmoi->id != $id_tindau) {
                        $chanle++;
                        ?>
                        <div class="box_tin <?php if ($chanle % 2 == 0) echo "box_tin2"; ?>">
                            <div class="anh">
                                <a href="<?php echo base_url(); ?><?php echo $function; ?>/<?php echo $kqlaytinmoi->alias; ?>" title=" <?php echo $kqlaytinmoi->title; ?>"><img src="<?php echo base_url();
                                    echo $kqlaytinmoi->img; ?>" alt="<?php echo $kqlaytinmoi->title; ?>"  /></a>
                            </div>
                            <div class="noidung">
                                <div class="tieude">
                                    <h3><a class="title_hidden"   href="<?php echo base_url(); ?><?php echo $function; ?>/<?php echo $kqlaytinmoi->alias; ?>" title="<?php echo $kqlaytinmoi->title; ?>" class="fontsize16 bold"><?php echo $kqlaytinmoi->title; ?></a></h3>
                                </div>
                                <div class="tomtat">
                                    <p class="dongdo"></p>
                        <?php echo $kqlaytinmoi->description; ?>
                                </div>
                            </div>
                        </div>
            <?php if ($chanle % 2 == 0) { ?> <div class="clearFix"></div> <?php } ?>
            <?php
        }
    }
}
?>
    </div>
        <div class="phantrang">
            <ul class="pageNews padR35">
                <?     echo $this->pagination->create_links();  ?>
            </ul>
        </div>
    </div>
 </div>
<div class="clearFix"></div>
