<div class="tin_gioithieu">
    <div class="menuM">        
    </div>
    <div class="ContentMain">
        <div class="fixTopContent"></div>
            <?php
            if ($laygioithieu->num_rows() > 0) {
                foreach ($laygioithieu->result() as $kqlaygioithieu) {
                ?>
                <div class="fixTopContent2"  style="padding-top: 20px;">
                    <p class="bold padL15" style="font-size: 16px;"> <?php echo $kqlaygioithieu->title; ?></p>
                </div>
                <div class="fixTopContent3 padL35 padR35">
                    <div align="justify" class="justify">
                <?php echo $kqlaygioithieu->content; ?>
                    </div>
                    <div class="gocRight"></div>
                </div>
    <?php } ?>
<?php } ?>
    </div>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=152357978806990&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="<? echo base_url().uri_string();?>" data-width="1024" data-numposts="5"></div>
	<div class="comment_google" style="margin-left:0px;">
                <script type="text/javascript"  src="https://apis.google.com/js/plusone.js">
                </script>
                <div id="google_comments"></div>
                <script type="text/javascript" >
                    gapi.comments.render('google_comments', {
                        href: window.location,
                        width: '1024',
                        height: '210',
                        first_party_property: 'BLOGGER',
                        view_type: 'FILTERED_POSTMOD'
                    });
                </script>
            </div>
</div>

