<?php
if(isset($core_js)){
	for($i=0;$i<count($core_js);$i++){ 
		echo '
		<script src="'.base_url("assets/global/plugins/bower_components/".$core_js[$i]).'"></script>'; 
	}
}

if(isset($direct_js)){
	for($i=0;$i<count($direct_js);$i++){ 
		echo '
		<script src="'.base_url($direct_js[$i]).'"></script>'; 
	}
}

if(isset($page_js)){
	for($i=0;$i<count($page_js);$i++){ 
		echo '
		<script src="'.base_url("assets/admin/js/".$page_js[$i]).'"></script>'; 
	}
}
?>
