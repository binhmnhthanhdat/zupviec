 <div class="vcard" >
    <?php
    $sql = "select * from setting ";
    $setting = $this->db->query($sql);
    $kqsetting = $setting->row();
    ?>
    <?php echo $kqsetting->address; ?>
</div>