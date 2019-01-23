<?php
$themecolor="default";
if(isset($_SESSION['userDetails'])){
	$u = $_SESSION['userDetails'];
	$theme = explode("::",$u->colourcode);
	if($theme[0]!=""){
		$themecolor=$theme[0];
	}
}
if(isset($page_css)){
	for($i=0;$i<count($page_css);$i++){ 
		echo '
		<link href="'.base_url("assets/global/plugins/bower_components/".$page_css[$i]).'" rel="stylesheet">'; 
	}
}
if(isset($direct_css)){
	for($i=0;$i<count($direct_css);$i++){ 
		echo '
		<link href="'.base_url($direct_css[$i]).'" rel="stylesheet">'; 
	}
}
if(isset($theme_css)){
	for($i=0;$i<count($theme_css);$i++){ 
		$ver = "";
		if($theme_css[$i]=="components.css"){
			$ver = "?ver=1.2";
		}
		echo '
		<link href="'.base_url("assets/admin/css/".$theme_css[$i].$ver).'" rel="stylesheet">'; 
	}
}
?>
<link id="base-style" href="<?php echo base_url()?>assets/user/print.css" rel="stylesheet" type="text/css" media="print">		