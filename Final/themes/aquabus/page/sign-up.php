<div class="loginArea">
	<br>
	<p>ชื่อผู้ใช้ :</p> <div class="input"><i class="fas fa-user"></i><input type = "text" name = "first_name" value = "" maxlength = "100" /></div>
	<p>อีเมล :</p> <div class="input"><i class="fas fa-lock"></i><input type = "text" name = "e_mail" value = "" maxlength = "100" /></div>
	<p>รหัสผ่าน :</p> <div class="input"><i class="fas fa-lock"></i><input type = "password" name = "password_" value = "" maxlength = "100" /></div>
	<p>ยืนยันรหัสผ่าน :</p> <div class="input"><i class="fas fa-lock"></i><input type = "password" name = "password_con" value = "" maxlength = "100" /></div>
	<button onclick="toHome();">สมัครสมาชิก</button>
	<script>
		$('body').css('background-image', 'url(themes/aquabus/img/bgsingup.png)');
		$('#btnBack').css('display', '');
		function toHome() {
			$('#container').css('animation', 'fadeOutLeft .5s forwards');
				setTimeout(function() {
					$('#appBar').css('animation', 'fadeInDown .5s');
					loadComponent('https://ycc.wasumi.site/' ,'#container', function() {
						$('body').css('background-image', '');
					$('#container').css('animation', 'fadeInRight .5s forwards');
				});
			}, 500);
			
			
		}
	</script>
</div>