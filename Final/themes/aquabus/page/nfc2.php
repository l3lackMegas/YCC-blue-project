<div onclick="goDestination()">
	<h1 style="     margin-bottom: 0;   text-align: center;
    font-size: 60px;">แตะเพื่อจ่ายเงิน</h1>
	<img style="    width: 100%;" src="<?php echo $themePath; ?>/img/nfc.png">
</div>

<script>
	function goDestination() {
		$('#container').css('animation', 'zoomOutIn .5s forwards');
					setTimeout(function() {
						loadComponent('https://ycc.wasumi.site/' ,'#container', function() {
							$('#container').css('animation', 'zoomIn 1s forwards');
						});
					}, 500);
	}
</script>