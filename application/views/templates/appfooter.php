
<script type="text/javascript">//<![CDATA[
	function numbersonly(e) {
		var unicode = e.charCode ? e.charCode : e.keyCode
		if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9 && unicode != 13) { //if the key isn't the backspace key or the enter key (which we should allow)
			if (unicode < 48 || unicode > 57)
				return false
		}
	}
</script>


<script src="<?=base_url("assets/public/assets/scrolltop/jquery.gotop.js")?>"></script>
<div id="gotop"></div>
<script>
$('#gotop').gotop({
  customHtml: '<i class="fa fa-angle-up fa-2x"></i>',
  bottom: '2em',
  right: '2em',
  windowScrollShow: 200, 
});
</script>
</body>
</html>
