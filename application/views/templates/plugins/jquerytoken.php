<? 	
$delimit=":";
if(@$tokensetting['delimit']){
	$delimit=$tokensetting['delimit'];
}
?>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/token/jquery.tokeninput.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/token/token-input-facebook.css" type="text/css" />

<script type="text/javascript">
	$(document).ready(function() {
		$("#adminid").tokenInput("<?=base_url($tokensetting['url'])?>",{theme: "facebook",preventDuplicates: true,tokenDelimiter: "<?=$delimit?>",hintText: "<?=$tokensetting['searchtitle']?>",noResultsText: "No Match Was Found",searchingText: "Searching..."
		}); 
	});
</script>