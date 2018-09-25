<!-- begin gioi thieu-->
<div class="chitiet_duan">
  	<div class="menuM">
  		<ul>
             <?php 
            
            
            if($this->uri->segment(3)!="" && !is_numeric($this->uri->segment(3)))
            {
                 $url=$this->uri->segment(3);
            } else if($this->uri->segment(2)!="" && !is_numeric($this->uri->segment(2)))
            {
                 $url=$this->uri->segment(2);
            }else if($this->uri->segment(1)!="" && !is_numeric($this->uri->segment(1)))
            {
                 $url=$this->uri->segment(1);
            }
            //echo $url;exit;
            if($url){
                 
                   $sql="select * from group_project where id=( select id_group_project from project where alias=\"".$url."\" limit 0,1)";
                   $laytengroup=$this->db->query($sql);
                   $kqlaytengroup=$laytengroup->row();
            }
           
            ?>
        		<li><h2><a href="<?php  echo base_url();?>du-an/<?php  echo $kqlaytengroup->alias;?>" title="Dự án thi công" class="color51 active" ><span></span>Dự án  <?php  echo $kqlaytengroup->name;?></a></h2></li>                           
        </ul>
  	</div>
    <div class="ContentMain">
      	<div class="hinhanh_mota">
          	<div class="name_hinhanh_mota" >Hình ảnh dự án đã thực hiện</div>
        </div>
        <div class="name_chitiet">
        	<p class="name_thicong">Chi tiết thi công dự án</p>
        </div>
        <div class="content_chitiet_duan">
          <?php 
                    $sql="select * from project where alias=\"".$url."\"";
                   $laychitietduan=$this->db->query($sql);
                    if($laychitietduan->num_rows()>0)
				
        {
            $kqlaychitietduan=$laychitietduan->row();
            ?>
            <div class="infoProject">
            	<p class="title"> <?php  echo $kqlaychitietduan->title;?></p>
                
             
                <div class="suviec">Sự việc: </div>
                <div class="khachhang">  <?php  echo $kqlaychitietduan->customer;?></div>
                <div class="clearFix padT5"></div>
                
                <div class="suviec">Mô tả:</div>
                <div class="khachhang"> <?php  echo $kqlaychitietduan->introduction;?></div>
                <div class="clearFix padT5"></div>
                
                
                <div class="clearFix padT5"></div>
                <div class="rulerDup"></div>
               
                <div class="clearFix"></div>
            </div>
            <div class="DetailImg" ><img src=" <?php  echo base_url();echo $kqlaychitietduan->img;?>"  alt="<?php  echo $kqlaychitietduan->title;?>" /></div>
            <?php 
           }
           ?>
            <div class="clearFix"></div>
			 
				 
            <div class="gocRight"></div>
        </div>
    </div>
</div>
<!--end gioi thieu-->