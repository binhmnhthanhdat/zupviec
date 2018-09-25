<div class="box_lienhe">
    <div class="menuM">
        <ul>
            <li><a href="javascript:void();" class="color51 active"><span></span>Liên hệ</a></li>
        </ul>
    </div>
    <div class="ContentMain" >
        <div class="fixTopContent relatibe"  style="padding-top: 0px;">
            <div class="bgGendi fontsize16 bold title">Thông tin liên hệ</div>
        </div>
        <div class="fixTopContent2" style="padding-top: 20px;">
            <h2 class="bold padL15 fontsize16">Liên hệ trực tuyến</h2>
        </div>
        <div class="fixTopContent3 padB0">
            <div class="infoProject">
                <form action=" <?php echo base_url(); ?>send-lien-he" method="post" name="lienhe">
                    <div class="w80 flLeft fontsize13 bold">Họ tên:</div>
                    <div class="w265 flLeft fontsize13"><input type="text" value="" class="txtContact" name="hoten" /> <?php form_error('hoten'); ?></div>
                    <div class="w80 flLeft fontsize13 bold"></div>
                    <div class="clearFix padT10"></div>
                    <div class="w80 flLeft fontsize13 bold">Email:</div>
                    <div class="w265 flLeft fontsize13"><input type="text" value="" class="txtContact" name="email" /> <?php form_error('email'); ?></div>
                    <div class="w80 flLeft fontsize13 bold"></div>
                    <div class="clearFix padT10"></div>
                    <div class="w80 flLeft fontsize13 bold">Tiêu đề:</div>
                    <div class="w265 flLeft fontsize13"><input type="text" value="" class="txtContact" name="tieude" /> <?php form_error('tieude'); ?></div>
                    <div class="w80 flLeft fontsize13 bold"></div>
                    <div class="clearFix padT10"></div>
                    <div class="w80 flLeft fontsize13 bold">Nội dung:</div>
                    <div class="w265 flLeft fontsize13">
                        <textarea name="noidung"   class="txtASearch" cols="5" rows="5"></textarea>
                        <?php form_error('noidung'); ?>
                    </div>
                    <div class="w80 flLeft fontsize13 bold"></div>
                    <div class="clearFix padT10"></div>
                    <div class="w80 flLeft fontsize13 bold"><font color="red"> <?php echo "  " . $this->session->userdata('security_code'); ?></font></div>
                    <div class="w265 flLeft fontsize13"><input type="text" value="" class="txtContact" name="capcha" />  <?php form_error('capcha'); ?></div>
                    <div class="w80 flLeft fontsize13 bold"></div>
                    <div class="clearFix padT10"></div>
                    <div class="w80 flLeft fontsize13 bold"></div>
                    <div class=" padR30"><input type="submit" class="btnSend flRight" value="Send" /></div>
                    <div class="clearFix"></div>
                </form>
            </div>
            <div class="thongtinlienhe" >
                <p class="honghab">Công ty dịch vụ vệ sinh công ty Hà Nội Sài Gòn</p>
                <p class="fontsize13">Hotline: 09.69963553</p>
            </div>
            <div class="clearFix"></div>
            <div class="gocRight"></div>
        </div>
    </div>
</div>
