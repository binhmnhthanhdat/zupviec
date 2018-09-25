<!-- begin chitiettintuc-->
<div class=" flLeft">
	<div class="menuM">
		<ul>
			<li><h2><a href="" class="color51 active"><span></span>Tuyển dụng Nhân viên zupViec.com</a></h2></li>
		</ul>
	</div>
	<div class="ContentMain ">
		<div class="fixTopContent"></div>
		  <?php 
			 if($chitiettintuc->num_rows()>0)
						
			   
				
					$kqchitiettintuc=$chitiettintuc->row() ;
						
							   
				?>
		<div class="fixTopContent2" style="padding-top: 20px;">
		
			<p class="fontsize16 bold padL15"><?php  echo $kqchitiettintuc->title; ?></p>
		</div>
	   
		<div class="fixTopContent3 content_tintuyendung">
			<div class="padR35">
				<p class="rulerRed280"></p>
				<p class="bold" align="justify"> <?php  echo $kqchitiettintuc->description; ?></p>
				<div class="padT20" align="justify">
				 <?php  echo $kqchitiettintuc->content; ?>
				</div>
				<div class="comment_google">
                <script type="text/javascript"  src="https://apis.google.com/js/plusone.js">
                </script>
                <div id="google_comments"></div>
                <script type="text/javascript" >
                    gapi.comments.render('google_comments', {
                        href: window.location,
                        width: '955',
                        height: '210',
                        first_party_property: 'BLOGGER',
                        view_type: 'FILTERED_POSTMOD'
                    });
                </script>
            </div>
			<div class="padL35 padR35 padT20">
				<p class="bold fontsize16">Các tin tức khác</p>
				<p class="rulerRed"></p>
				<ul class=" listHotNews padT10">
					 <?php 
						$idtinlienquan=$kqchitiettintuc->id_group_project; 
						$sql="select * from news where type=2 limit 0,10";	
						$tinlienquan=$this->db->query($sql);
						 if($tinlienquan->num_rows()>0)
						
						{
						  
							foreach($tinlienquan->result() as $kqtinlienquan)
						   // $kqlaytintuchot=$laytintuchot->row() ;
							{ 
							   
				?>
					
					<li><h3 style="font-weight: normal;"><a href="<?php  echo base_url();?>chi-tiet-tuyen-dung/<?php  echo $kqtinlienquan->alias;?>" class="fontsize13" title=" <?php  echo $kqtinlienquan->title;?>"> <?php  echo $kqtinlienquan->title;?></a></h3></li>
					   <?php  
							  }
				} //end so group 
		  ?> 
				</ul>
			</div>
				
			<div class="gocRight"></div>
		</div>
	</div>
</div>
</div>
<div class="clearFix"></div>



<!--end chitiettintuc-->