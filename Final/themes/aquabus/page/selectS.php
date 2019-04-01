<center>
	<div class="titleBar" style="width: 85%;">
	<p style="margin: 0;">ตำแหน่งของคุณ</p><div class="input"><i class="fas fa-map-marker-alt"></i><input id="origin-input" type = "text" name = "first_name" value = "" maxlength = "100" /></div>
	<p style="margin: 5px 0;">จุดหมายปลายทาง</p> <div class="input" style=""><i class="fas fa-map-marked-alt"></i><input id="destination-input" type = "text" name = "last_name" value = "" maxlength = "100" /></div>
</div>
	<script>
		$('#origin-input').val(locatS);
			$('#destination-input').val(locatD);
		function waitPage() {
			$('#container').css('animation', 'fadeOutLeft .5s forwards');
					setTimeout(function() {
						loadComponent('https://ycc.wasumi.site/waiting' ,'#container', function() {
						$('#container').css('animation', 'fadeInRight .5s forwards');
					});
				}, 500);
		}
	</script>
	</center>
<div id="optionArea" style="margin-top: 20px;">
	<div class="case" onclick="waitPage()">
		<div class="colume">
			<div class="title">รถเมล์ปรับอากาศ เอ</div>
			<p>รถเมลจะมาถึงในอีก <span style="font-size: 40px;">3</span> นาที</p>
			<p><span class="destiny">เส้นทาง</span> จาก สนามหลวง ถึง ปากเกร็ด</p>
		</div>
		<div class="colume" style="width: 90px; margin-left: 5px;text-align: center;">
			<div class="title" style="text-align: center;">ราคา</div>
			<p style="font-size: 40px">40</p>
			<p>บาท</p>
		</div>
	</div>
	<div class="case" onclick="waitPage()">
		<div class="colume">
			<div class="title">รถเมล์ปรับอากาศ บี</div>
			<p>รถเมลจะมาถึงในอีก <span style="font-size: 40px;">4</span> นาที</p>
			<p><span class="destiny">เส้นทาง</span> จาก สนามหลวง ถึง ปากเกร็ด</p>
		</div>
		<div class="colume" style="width: 90px; margin-left: 5px;text-align: center;">
			<div class="title" style="text-align: center;">ราคา</div>
			<p style="font-size: 40px">40</p>
			<p>บาท</p>
		</div>
	</div>
	<div class="case" onclick="waitPage()">
		<div class="colume">
			<div class="title">รถเมล์ปรับอากาศ ซี</div>
			<p>รถเมลจะมาถึงในอีก <span style="font-size: 40px;">7</span> นาที</p>
			<p><span class="destiny">เส้นทาง</span> จาก สนามหลวง ถึง ปากเกร็ด</p>
		</div>
		<div class="colume" style="width: 90px; margin-left: 5px;text-align: center;">
			<div class="title" style="text-align: center;">ราคา</div>
			<p style="font-size: 40px">40</p>
			<p>บาท</p>
		</div>
	</div>
</div>