<div class="loginArea">
	<center><img id="loginLogo" src="themes/aquabus/img/textrodeway.png"></center>
	<p>ชื่อผู้ใช้ :</p> <div class="input"><i class="fas fa-user"></i><input type = "text" name = "first_name" value = "Admin" maxlength = "100" /></div>
	<p>รหัสผ่าน :</p> <div class="input"><i class="fas fa-lock"></i><input type = "password" name = "last_name" value = "password" maxlength = "100" /></div>
	<button onclick="toHome();">ลงชื่อเข้าใช้</button>
	<button onclick="toSign();" style="background-color: #4c4c4c;    margin-top: 20px;">สมัครสมาชิก</button>
	<script>
		$('#appBar').hide();
		$('body').css('background-image', 'url(themes/aquabus/img/bglogin.png)');
		function toHome() {
				setTimeout(function() {
					$('#appBar').css('animation', 'fadeInDown .5s');
					$('#container').css('animation', 'fadeOutLeft .5s forwards');
					loadComponent('https://ycc.wasumi.site/' ,'#container', function() {
						$('#appBar').show();
						$('body').css('background-image', '');
						$('#container').css('animation', 'fadeInRight .5s forwards');
				});
			}, 500);
			
			
		}
		
		function toSign() {
				setTimeout(function() {
					$('#appBar').css('animation', 'fadeInDown .5s');
					$('#container').css('animation', 'fadeOutLeft .5s forwards');
					loadComponent('https://ycc.wasumi.site/signup' ,'#container', function() {						
						$('#appBar').show();
						$('body').css('background-image', 'url(themes/aquabus/img/bgsingup.png)');
						$('#container').css('animation', 'fadeInRight .5s forwards');
				});
			}, 500);
			
			
		}
	</script>
</div>