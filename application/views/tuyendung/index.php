<!-- begin tuyendung-->
<div class="tintuyendung" >
	<div class="menuM">
		<ul>
			<li><h2><a href="" class="color51 active"><span></span>Tuyển dụng Nhân viên</a></h2></li>
		</ul>
	</div>
	<div class="ContentMain">
		<div class="fixTopContent"></div>
		<div class="fixTopContent2">
		</div>
		<div class="detai_tin_tuyendung">
		<?php 
		   if($laytintuyendung->num_rows()>0)
			{
		?>
			<ul class="list_tin_tuyendung">
				<?php 
				  foreach($laytintuyendung->result() as $kqlaytintuyendung)
				  { 
			   ?>
				  <li class="li_list">
					   <div class="image_tin">
						   <a href=" <?php  echo base_url();?>chi-tiet-tuyen-dung/<?php  echo $kqlaytintuyendung->alias;?>" title=" <?php  echo $kqlaytintuyendung->title; ?>">
							 <img src="<?php  echo base_url();?><?php  echo $kqlaytintuyendung->img; ?>" alt=" <?php  echo $kqlaytintuyendung->title; ?>" />
						   </a>
					   </div>
						<div class="content">
							<h3><a href=" <?php  echo base_url();?>chi-tiet-tuyen-dung/<?php  echo $kqlaytintuyendung->alias;?>" title="<?php  echo $kqlaytintuyendung->title; ?>" class="bold"> <?php  echo $kqlaytintuyendung->title; ?></a></h3>
							<p class="rulerRed70"></p>
							<p> <?php  echo $kqlaytintuyendung->description; ?></p>
						</div>
						<div class="clearFix"></div>
					</li>
							
					 <?php 
					}
					?>
			
			</ul>
			<?php 
			}
			?>
			<div class="clearFix"></div>
			<p class="clearFix"></p>
			<div class="gocRight"></div>
		</div>
	</div>
</div>
<div class="clearFix"></div>
<!--end tuyendung-->