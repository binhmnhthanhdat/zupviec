<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "trangchu";
    $route['bang-gia'] = "gioithieu/banggia";
    $route['cong-ty'] = "gioithieu/index";
    $route['du-an'] = "duan/index";
     
	//begin rewwrite box tin ở đây thì anh chỉ thay url
    $route['meo-giu-nha-sach/(:any)'] = "tintuc/chitiettintuc1/$1";//box 1
    $route['tin-tuc-tong-hop/(:any)'] = "tintuc/chitiettintuc2/$1";//box 2
    $route['ky-nang-chuyen-nghanh/(:any)'] = "tintuc/chitiettintuc3/$1";//box 3
       
        $route['dich-vu-ve-sinh/(:any)'] = "tintuc/chitietdichvu1/$1";
        $route['ve-sinh-van-phong/(:any)'] = "tintuc/chitietdichvu2/$1";
        $route['giup-viec-theo-gio/(:any)'] = "tintuc/chitietdichvu3/$1";
        $route['ve-sinh-cong-nghiep/(:any)'] = "tintuc/chitietdichvu4/$1";
        $route['ve-sinh-dinh-ky/(:any)'] = "tintuc/chitietdichvu5/$1";
        $route['ve-sinh-xay-dung/(:any)'] = "tintuc/chitietdichvu6/$1";
        //endrewwrite box dich vu ở đây thì anh chỉ thay url
      
        //endtindichvu
		//admin/user/login
			$route['admincp'] = "admin/user/login";
			 $route['admin/user/(:any)'] = "admin/user/login";
			 $route['admin/trangchu/home'] = "admin/home/index";
			 //begin setting thanh cong tot dep
			 //$route['admin/menu-ad/add_edit/(:any)'] = "admin/menu/add_edit/$1";
			 $route['admin/setting-ad/add_edit'] = "admin/setting/add_edit";
			 $route['admin/setting-ad/home'] = "admin/setting/index";
			 //end setting  thanh cong tot dep
			 //begin menu thanh cong tot dep
			 $route['admin/menu-ad/delete/(:any)'] = "admin/menu/delete/$1";
			 $route['admin/menu-ad/add_edit/(:any)'] = "admin/menu/add_edit/$1";
			 $route['admin/menu-ad/add_edit'] = "admin/menu/add_edit";
			 $route['admin/menu-ad/home'] = "admin/menu/index";
			 //end begin menu thanh cong tot dep
			 //begin groupmenufooter thanh cong tot dep
			 $route['admin/groupmenufooter-ad/delete/(:any)'] = "admin/groupmenufooter/delete/$1";
			 $route['admin/groupmenufooter-ad/add_edit/(:any)'] = "admin/groupmenufooter/add_edit/$1";
			 $route['admin/groupmenufooter-ad/add_edit'] = "admin/groupmenufooter/add_edit";
			 $route['admin/groupmenufooter-ad/home'] = "admin/groupmenufooter/index";
			 //end begingroupmenufootermenu thanh cong tot dep
			 //begin menufooter-ad thanh cong tot dep
			 $route['admin/menufooter-ad/delete/(:any)'] = "admin/menufooter/delete/$1";
			 $route['admin/menufooter-ad/add_edit/(:any)'] = "admin/menufooter/add_edit/$1";
			 $route['admin/menufooter-ad/add_edit'] = "admin/menufooter/add_edit";
			 $route['admin/menufooter-ad/home'] = "admin/menufooter/index";
			 //end menufooter-ad thanh cong tot dep
			 //begin grouphoidap-ad thanh cong tot dep
			 $route['admin/grouphoidap-ad/delete/(:any)'] = "admin/grouphoidap/delete/$1";
			 $route['admin/grouphoidap-ad/add_edit/(:any)'] = "admin/grouphoidap/add_edit/$1";
			 $route['admin/grouphoidap-ad/add_edit'] = "admin/grouphoidap/add_edit";
			 $route['admin/grouphoidap-ad/home'] = "admin/grouphoidap/index";
			 //end grouphoidap-ad thanh cong tot dep
			 //begin listhoidap-ad thanh cong tot dep
			 $route['admin/listhoidap-ad/delete/(:any)'] = "admin/listhoidap/delete/$1";
			 $route['admin/listhoidap-ad/add_edit/(:any)'] = "admin/listhoidap/add_edit/$1";
			 $route['admin/listhoidap-ad/add_edit'] = "admin/listhoidap/add_edit";
			 $route['admin/listhoidap-ad/home'] = "admin/listhoidap/index";
			 //end listhoidap-ad thanh cong tot dep
			 //begin user-ad thanh cong tot dep
			 $route['admin/user-ad/delete/(:any)'] = "admin/user/delete/$1";
			 $route['admin/user-ad/add_edit/(:any)'] = "admin/user/add_edit/$1";
			 $route['admin/user-ad/add_edit'] = "admin/user/add_edit";
			 $route['admin/user-ad/home'] = "admin/user/index";
			 //end user-ad thanh cong tot dep
			  //begin danhmucdichvu-ad thanh cong tot dep
			 $route['admin/danhmucdichvu-ad/delete/(:any)'] = "admin/danhmucdichvu/delete/$1";
			 $route['admin/danhmucdichvu-ad/add_edit/(:any)'] = "admin/danhmucdichvu/add_edit/$1";
			 $route['admin/danhmucdichvu-ad/add_edit'] = "admin/danhmucdichvu/add_edit";
			 $route['admin/danhmucdichvu-ad/home'] = "admin/danhmucdichvu/index";
			 //end danhmucdichvu-ad thanh cong tot dep
			 //begin duan-ad thanh cong tot dep
			 $route['admin/duan-ad/delete/(:any)'] = "admin/duan/delete/$1";
			 $route['admin/duan-ad/add_edit/(:any)'] = "admin/duan/add_edit/$1";
			 $route['admin/duan-ad/add_edit'] = "admin/duan/add_edit";
			 $route['admin/duan-ad/home'] = "admin/duan/index";
			 //end duan-ad thanh cong tot dep
			 //begin grouptin-ad thanh cong tot dep
			 $route['admin/grouptin-ad/delete/(:any)'] = "admin/grouptin/delete/$1";
			 $route['admin/grouptin-ad/add_edit/(:any)'] = "admin/grouptin/add_edit/$1";
			 $route['admin/grouptin-ad/add_edit'] = "admin/grouptin/add_edit";
			 $route['admin/grouptin-ad/home'] = "admin/grouptin/index";
			 //end grouptin-ad thanh cong tot dep
			  //begin tintuc-ad thanh cong tot dep
			 $route['admin/tintuc-ad/delete/(:any)'] = "admin/tintuc/delete/$1";
			 $route['admin/tintuc-ad/add_edit/(:any)'] = "admin/tintuc/add_edit/$1";
			 $route['admin/tintuc-ad/add_edit'] = "admin/tintuc/add_edit";
			 $route['admin/tintuc-ad/home/(:any)'] = "admin/tintuc/index/$1";
			 $route['admin/tintuc-ad/home'] = "admin/tintuc/index";
			 //end tintuc-ad thanh cong tot dep
			 
			 
			 
			 
			 
			  //begin tinhienthi-ad thanh cong tot dep
			 $route['admin/tinhienthi-ad/delete/(:any)'] = "admin/tinhienthi/delete/$1";
			 $route['admin/tinhienthi-ad/add_edit/(:any)'] = "admin/tinhienthi/add_edit/$1";
			 $route['admin/tinhienthi-ad/add_edit'] = "admin/tinhienthi/add_edit";
			 $route['admin/tinhienthi-ad/home'] = "admin/tinhienthi/index";
			 //end tinhienthi-ad thanh cong tot dep
			 
			  //begin gioithieu-ad thanh cong tot dep
			 $route['admin/listgioithieu-ad/delete/(:any)'] = "admin/listgioithieu/delete/$1";
			 $route['admin/listgioithieu-ad/add_edit/(:any)'] = "admin/listgioithieu/add_edit/$1";
			 $route['admin/listgioithieu-ad/add_edit'] = "admin/listgioithieu/add_edit";
			 $route['admin/listgioithieu-ad/home'] = "admin/listgioithieu/index";
			 //end gioithieu-ad thanh cong tot dep
			 //begin slide-ad thanh cong tot dep
			 $route['admin/slide-ad/delete/(:any)'] = "admin/slide/delete/$1";
			 $route['admin/slide-ad/add_edit/(:any)'] = "admin/slide/add_edit/$1";
			 $route['admin/slide-ad/add_edit'] = "admin/slide/add_edit";
			 $route['admin/slide-ad/home'] = "admin/slide/index";
			 //end slide-ad thanh cong tot dep
			  
			 //begin parttent-ad thanh cong tot dep
			 $route['admin/parttent-ad/delete/(:any)'] = "admin/parttent/delete/$1";
			 $route['admin/parttent-ad/add_edit/(:any)'] = "admin/parttent/add_edit/$1";
			 $route['admin/parttent-ad/add_edit'] = "admin/parttent/add_edit";
			 $route['admin/parttent-ad/home'] = "admin/parttent/index";
			 //end parttent-ad thanh cong tot dep
			 //begin maillienhe-ad thanh cong tot dep
			 $route['admin/maillienhe-ad/delete/(:any)'] = "admin/maillienhe/delete/$1";
			 $route['admin/maillienhe-ad/add_edit/(:any)'] = "admin/maillienhe/add_edit/$1";
			 $route['admin/maillienhe-ad/add_edit'] = "admin/maillienhe/add_edit";
			 $route['admin/maillienhe-ad/home'] = "admin/maillienhe/index";
			 //end maillienhe-ad thanh cong tot dep
		//admin
		
		//end admin
    $route['tag/(:any)']  = "tintuc/tag/$1";
    $route['tin-tuc/(:any)'] = "tintuc/index/$1";
    $route['tin-tuc'] = "tintuc/index";
//end tintuc
//dich vu admin/home
     $route['send-lien-he']  = "lienhe/guilienhe";
     $route['send-thanh-cong']  = "lienhe/sendthanhcong";
     $route['du-an/(:any)']  = "dichvu/duan/$1";
     $route['chi-tiet-du-an/(:any)']  = "dichvu/chitietduan/$1";
      $route['chi-tiet-tuyen-dung/(:any)'] = "tuyendung/chitiettuyendung/$1";
     // $route['admin'] = "admin/user/login";
     // $route['admin'] = "admin/home";
     // $route['([a-zA-Z_-]+)']  = "dichvu/chitietthicongvanphong/$1";//rewirt
        $route['(:any)'] = "dichvu/chitietthicongnoithat/$1";
        // $route['(:any)']  = "dichvu/chitietthicongvanphong/$1";
        // $route['(:any)']  = "dichvu/chitietthicongmang/$1";
        // $route['(:any)']  = "dichvu/chitietcongtynoithat/$1";
        // $route['(:any)']  = "dichvu/chitietsuachuanhacua/$1";
        // $route['(:any)']  = "dichvu/chitietdichvusonnha/$1";   
            

    $route['dich-vu'] = "dichvu/index";
//end dich vu tuyendung/chitiettuyendung

 $route['tuyen-dung'] = "tuyendung/index";
 $route['lien-he'] = "lienhe/index";


/* End of file routes.php */
/* Location: ./application/config/routes.php */