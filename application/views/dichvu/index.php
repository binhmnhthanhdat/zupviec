<div class="clearFix" ></div>
<?php
if ($laygroupproject->num_rows() > 0) {
    $sorecord = 1;
    foreach ($laygroupproject->result() as $kqlaygroupproject) {
        ?>
        <div class="boxtin <?php if ($sorecord % 3 == 0) echo "right"; ?> boxtin_dichvu">
            <h2><a class="moduleItemTitle" href="<?php echo base_url(); ?><?php echo $kqlaygroupproject->alias; ?>" title="<?php echo $kqlaygroupproject->name; ?>"><?php echo $kqlaygroupproject->name; ?></a></h2>
            <p>
                <img class="caption" src="<?php echo base_url();
        echo $kqlaygroupproject->images; ?>" alt="<?php echo $kqlaygroupproject->title; ?>" title="<?php echo $kqlaygroupproject->title; ?>" border="0" height="100" width="100" />
                <?php echo $kqlaygroupproject->content; ?>
            </p>
        </div>
        <?php
        $sorecord++;
    }
}
?>
<div class="clearFix"></div>