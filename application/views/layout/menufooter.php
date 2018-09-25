<div class="clearFix"></div>
<div class="quangcao">
    <?php
    if ($laypartner->num_rows() > 0) {
        ?>
        <ul class="listPatner">
        <?php
        foreach ($laypartner->result() as $kqlaypartner) {
        ?>
                <li>
                <?php if ($kqlaypartner->url != "#") { ?>
                        <a href="<?php echo $kqlaypartner->url; ?>" title=" <?php echo $kqlaypartner->name; ?>">
                <?php } ?>
                        <img src=" <?php echo base_url();echo $kqlaypartner->path; ?>" alt=" <?php echo $kqlaypartner->name; ?>" height="50" />

                <?php if ($kqlaypartner->url != "#") { ?>
                        </a>
                <?php } ?>
                </li>
        <?php
        }
        ?>
        </ul>
    <?php
    }
    ?>
</div>
<div class="menufooter">
    <?php
    $sql = "select * from group_menufooter where active=1 order by ord asc limit 0,4";
    $menufooter = $this->db->query($sql);
    $i = 0;
    if ($menufooter->num_rows() > 0) {
        foreach ($menufooter->result() as $kqmenufooter) {
            $i++;
            if ($i != 4) {
                ?>
                <div class="listBoxSearvice  <?php if ($i == 4) echo "timkiem"; ?>">
                    <p  class="title" style="text-transform: uppercase ;padding-top:15px;font-size:14px;font-weight:bold;padding-left:15px;color:#0a4e7b;">
                <?php if ($kqmenufooter->link != "#") { ?>
                            <a  href="<?php echo $kqmenufooter->link; ?>"  title="<?php echo $kqmenufooter->name; ?>" style="color: #011e34;text-transform: uppercase ;font-size:14px;font-weight:bold;">
                <?php } ?>
                <?php echo $kqmenufooter->name; ?>
                <?php if ($kqmenufooter->link != "#") { ?>
                            </a>
                <?php } ?>
                    </p>
                        <?php
                        $sql = "select * from menufooter where parent=\"" . $kqmenufooter->id . "\" order by ord asc limit 0,10";
                        $danhmucfooter = $this->db->query($sql);
                        if ($danhmucfooter->num_rows() > 0) {
                        ?>
                        <ul>
                            <?php
                            foreach ($danhmucfooter->result() as $kqdanhmucfooter) {
                                ?>
                                <li><p style="font-weight: normal;"><a  href="<?php echo $kqdanhmucfooter->link; ?>"  title=" <?php echo $kqdanhmucfooter->name; ?>"><?php echo $kqdanhmucfooter->name; ?> </a></p></li>
                            <?php
                        }
                        ?>
                        </ul>
                    <?php } ?>
                </div>
                    <?php
                    }
                    else {
                        ?>
                <div class="timkiem">
                    <p  class="title colorRed" style="text-transform: uppercase ;padding-top:15px;font-size:14px;font-weight:bold;padding-left:15px;">
                        <?php if ($kqmenufooter->link != "#") { ?>
                            <a  href="<?php echo $kqmenufooter->link; ?>"  title="<?php echo $kqmenufooter->name; ?>" style="color: #011e34;text-transform: uppercase ;font-size:14px;font-weight:bold;">
                        <?php } ?>
                        <?php echo $kqmenufooter->name; ?>
                        <?php if ($kqmenufooter->link != "#") { ?>
                            </a>
                        <?php } ?>
                    </p>
                    <div class="box_timkiem">
                    <?php
                    $sql = "select * from menufooter where parent=\"" . $kqmenufooter->id . "\" order by ord asc limit 0,10";
                    $danhmucfooter = $this->db->query($sql);

                    if ($danhmucfooter->num_rows() > 0) {

                        foreach ($danhmucfooter->result() as $kqdanhmucfooter) {
                            ?>
                                <h6><a  href="<?php echo $kqdanhmucfooter->link; ?>"  title=" <?php echo $kqdanhmucfooter->name; ?>"><?php echo $kqdanhmucfooter->name; ?> </a></h6>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
                   }
                }
            }
            ?>
    <div class="clearFix"></div>
</div>