<div class="div_tag">
    <div class="clearFix"></div>
    <div class="menuM">
        <ul>
            <li><h2><a href=""  class="color51 active"><span></span>Tìm kiếm</a></h2></li>
        </ul>
    </div>
    <div class="ContentMain" >
        <div class="box_tag" >
            <?php
            if ($laytinproject->num_rows() > 0) {
                foreach ($laytinproject->result() as $kqlaytinproject) {
                    $sql = "select alias from group_new where type=1 and id=\"" . $kqlaytinproject->id_group_new . "\"   limit 0,1";
                    $function = $this->db->query($sql)->row()->alias;
                    if ($function == "") {
                        $sql = "select alias from group_project where id=\"" . $kqlaytinproject->id_group_project . "\"   limit 0,1";
                        $function = $this->db->query($sql)->row()->alias;
                    }
                    ?>
                    <div class="list_tag">
                        <a href="<?php echo base_url(); ?><?php echo $function ?>/<?php echo $kqlaytinproject->alias; ?>" title="<?php echo $kqlaytinproject->title; ?>" class="image_tag"><img src="<?php echo base_url();
            echo $kqlaytinproject->img; ?>" alt="<?php echo $kqlaytinproject->title; ?>" class="flLeft" /></a>
                        <div class="content" >
                            <a href="<?php echo base_url(); ?><?php echo $function ?>/<?php echo $kqlaytinproject->alias; ?>" title="<?php echo $kqlaytinproject->title; ?>"><span class="title"><?php echo $kqlaytinproject->title; ?></span></a>
                            <div class="description"> <?php echo $kqlaytinproject->description; ?></p>
                            </div>
                            <div class="clearFix"></div>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
    <?php
    }
}
?>
            <div class="phantrang" style="margin-bottom: 20px;;">
                <ul class="pageNews padR35">
                    <?      echo $this->pagination->create_links();  ?>
                </ul>
            </div>
        </div>
        <div class="clearFix"></div>
        <div class="gocRight"></div>
    </div>
</div>
</div>
