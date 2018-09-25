<div class="detai_new_service">
    <div class="menuM">
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
            $sql = "select * from group_project where id=( select id_group_project from news where alias=\"" . $url . "\" limit 0,1)";
            $name = $this->db->query($sql);
            $kqame = $name->row();
            $idgroup_project = $kqame->id;
            $group_name = $kqame->name;
            if ($chitiettintuc->num_rows() > 0) {
                $kqchitiettintuc = $chitiettintuc->row();
                ?>
                <div class="breadcrumb">
                    <h2 style = "display:inline"><a class = "bread" href="<?php echo base_url(); ?>">Dịch vụ vệ sinh văn phòng</a></h2>
                    <span class="breadcrumb-separator">»</span>
                    <h2 style = "display:inline"><a class = "bread" href="<?php echo base_url();
                         echo $kqame->alias; ?>"><?php echo $group_name; ?></a>
                    </h2>
                    <span class="breadcrumb-separator">»</span>
                    <h2 style = "display:inline"><a class = "bread" href="<?php echo base_url();echo $kqame->alias; ?>/<?php echo $this->uri->segment(2);?>">
                            <?php echo $kqchitiettintuc->title; ?></a>
                    </h2>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="ContentMain ">
        <div class="fixTopContent"></div>
            <?php
            if ($chitiettintuc->num_rows() > 0) {
                $kqchitiettintuc = $chitiettintuc->row();
                ?>
            <div class="fixTopContent2"  style="padding-top: 21px;">
                <h3 class="title_content_service"><?php echo $kqchitiettintuc->title; ?></h3>
            </div>
            <div class="fixTopContent3">
                <div class="content_service">
                    <p class="rulerRed280"></p>
                    <div  class="description_service"><? echo $description;?> </div>
                    <p class="bold" > <?php echo $kqchitiettintuc->description; ?></p>
                    <div class="detai_service">
                       <?php echo $kqchitiettintuc->content; ?>
                    </div>
                </div>
                <div class="tagNews">
                    <p class="flLeft"><span class="fontsize13">Vệ sinh:</span>
                        <?php
                        $mangtag = explode(",", $kqchitiettintuc->tag);
                        for ($itag = 0; $itag < count($mangtag); $itag++) {
                        ?>
                            <a href="<? echo base_url();?>tag/<?php echo $this->util->alias(trim($mangtag[$itag])); ?>" title="<?php echo trim($mangtag[$itag]); ?>"> <?php echo trim($mangtag[$itag]); ?></a>,
                        <?php
                        }
                        ?>
                    </p>
                </div>
					<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=152357978806990&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="<? echo base_url().uri_string();?>" data-width="990" data-numposts="5"></div>
                <div class="comment_google">
                    <style type="text/css">
                        #google_comments iframe{height:210px;}
                    </style>
                    <script src="https://apis.google.com/js/plusone.js">
                    </script>
                    <div id="google_comments"></div>
                    <script>
                        gapi.comments.render('google_comments', {
                            href: window.location,
                            width: '955',
                            height: '210',
                            first_party_property: 'BLOGGER',
                            view_type: 'FILTERED_POSTMOD'
                        });
                    </script>
                </div>
            <div class="service_other">
             <?php
            $idtinlienquan = $kqchitiettintuc->id_group_new;
            $sql = "select * from news where id_group_project=$idgroup_project and alias!='$url' order by id desc limit 0,10";
            $tinlienquan = $this->db->query($sql);
            if ($tinlienquan->num_rows() > 0) {
            ?>
                <div class="service_other_left">
                    <div class="service_other_left_title">Vệ sinh văn phòng | Giúp việc theo giờ:</div>
                    <?php
                    foreach ($tinlienquan->result() as $kqtinlienquan) {
                        ?>
                            <div class="new_dichvu_lienquan">
                                <a class="image_new" href="<?php echo base_url(); ?><?php echo $kqame->alias; ?>/<?php echo $kqtinlienquan->alias; ?>" title="<?php echo $kqtinlienquan->title; ?>"><img src="<?php echo base_url();
                                        echo $kqtinlienquan->img; ?>" width="73" height="75" alt="<?php echo $kqtinlienquan->title; ?>" class="flLeft" /></a>
                                <div  class="content_news_dichvu">
                                    <h3  class="title_hidden"  > <a  href="<?php echo base_url(); ?><?php echo $kqame->alias; ?>/<?php echo $kqtinlienquan->alias; ?>" title="<?php echo $kqtinlienquan->title; ?>" style="font-size: 15px;color:#045E93;"> <?php echo $kqtinlienquan->title; ?></a> </h3>
                                    <div class="description_dichvu"> <?php echo $kqtinlienquan->description; ?></div>
                                </div>
                                <div class="clearFix"></div>
                            </div>

                    <?php }
                    ?>
                </div>
        <?php }
        ?>
            
            <div class="clearFix"></div>
            </div>
            <div class="gocRight"></div>
        </div>
         <?php
        }
        ?>
    </div>
</div>
<div class="clearFix"></div>