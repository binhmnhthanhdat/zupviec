<div class="duan_thicong">
    <div class="menuM">
        <ul>
            <li><h2><a href=" " title="Dự án thi công mạng Lan" class="color51 active" ><span></span>Dự án đã thực hiện</a></h2></li>
        </ul>
    </div>
    <div class="ContentMain">
        <div class="fixTopContent"></div>
        <div class="fixTopContent2"  style="padding-top: 20px;padding-bottom:10px;">
            <p class="bold padL15">Dự án đã thực hiện</p>
        </div>
        <div class="fixTopContent3 padL35">
            <?php
            if ($layallproject->num_rows() > 0) {
                ?>
                <ul class="listProject">
    <?php
    foreach ($layallproject->result() as $kqlayallproject) {
        ?>
                        <li>
                            <p><a href="<?php echo base_url(); ?>chi-tiet-du-an/<?php echo $kqlayallproject->alias; ?>" title="<?php echo $kqlayallproject->title; ?>"><img src="<?php echo base_url();
                echo $kqlayallproject->img; ?>" alt="<?php echo $kqlayallproject->title; ?>"  class="img_duan" /></a></p>
                            <p class="padT7">
                            <h3><a href="<?php echo base_url(); ?>chi-tiet-du-an/<?php echo $kqlayallproject->alias; ?>" title="<?php echo $kqlayallproject->title; ?>" class="fontsize13  bold"> <?php echo $kqlayallproject->title; ?></a> </h3>
                            </p>
                        </li>
        <?php
    }
    ?>
                </ul>
                    <?php
                }
                ?>

            <div class="clearFix"></div>
            <div class="clearFix"></div>
            <div class="gocRight"></div>
        </div>
    </div>
</div>
