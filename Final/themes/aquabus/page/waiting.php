<div id="waitingArea">
	<div id="waitingView">
		<img style="height: 50%; transform: translate(20px, 80px);" src="https://ycc.wasumi.site/themes/aquabus/img/busstop.png"> 
		<img id="busProgress" style="position:absolute; height: 50%; transform: translate(200px, 80px);" src="https://ycc.wasumi.site/themes/aquabus/img/bus.png">
	</div>
	<script>
		$('#waitFrom').html('เดินทางจาก ' + locatS);
			$('#waitTarget').html('เดินทางจาก ' + locatD);
	</script>
	<div id="waitingDetail">
		<h1>รถเมล์สาย 187</h1>
		<img class="subTitle" src="https://ycc.wasumi.site/themes/aquabus/img/big.png">
		<div class="detail-colume">
			<div class="leftSide">
				<p><img src="https://ycc.wasumi.site/themes/aquabus/img/circle.png"><span>ราคา</span></p>
				<p><img src="https://ycc.wasumi.site/themes/aquabus/img/circle.png"><span>รถเมล์จะมาถึงป้ายนี้ภายใน</span></p>
				<p><img src="https://ycc.wasumi.site/themes/aquabus/img/circle.png"><span>ใช้ระยะเวลาทั้งหมด</span></p>
			</div>
			<div class="colume-right">
				<p id="waitingPrice">15 บาท</p>
				<p id="waiting-cur">8 วินาที</p>
				<p id="waiting-all">20 นาที</p>
			</div>
		</div>
		<div class="pBorder">
			<p id="waitFrom">เดินทางจาก......</p>
			<p id="waitTarget">ไปยัง......</p>
		</div>
	</div>
	<button onclick="chBtn($(this))">กำลังรอ</button>
</div>

<script>
	var ff = false;
	function chBtn(obj) {
		if(obj.html() == 'กำลังรอ') {
			obj.html('ยกเลิก');
			obj.css('background-color', '#676767');
			$('#btnBack').hide();
		} else {
			obj.html('กำลังรอ');
			obj.css('background-color', '');
			$('#btnBack').show();
		}
	}
	setTimeout(function() {$('#busProgress').css('transform', 'translate(-40px, 110px)');}, 1000);
	var countdown = 0,
		ci = 0;
		$('#busProgress').css('transition-duration', '10s'),
			cInt = setInterval(function() {
			if(countdown >= 100 && ff == false) {
				ff = true;
				$('#container').css('animation', 'fadeOutLeft .5s forwards');
				setTimeout(function() {
					$('#appBar').css('animation', 'fadeInDown .5s');
						loadComponent('https://ycc.wasumi.site/nfc' ,'#container', function() {
							$('body').css('background-image', '');
						$('#container').css('animation', 'fadeInRight .5s forwards');
					});
				}, 500);
				cInt.clearInterval();
			}
				
			
			countdown += 10;
			ci++;
			$('#waiting-cur').html((10 - ci) + ' วินาที');
		}, 1000)
</script>