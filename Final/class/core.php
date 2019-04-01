<?php
class SystemCore {

	public function getSiteSetting($suser){
		include('config.php');
		$objCon = $conn;
		$output = array();
		$strSQL = "SELECT * FROM `settings` WHERE user='".mysqli_real_escape_string($objCon,$suser)."'";
		//die($strSQL);
		$objQuery = mysqli_query($objCon,$strSQL);
		while($objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC)){
			$output[$objResult["setting_name"]] = $objResult["value"];
		}
		return $output;
	}
	
	public function getSiteMenu($type) {
		include('config.php');
		$array = array();
			
    	$objCon = $conn;
		$strSQL = "SELECT * FROM `site_menu` WHERE type = '".$type."' ORDER BY `position` ASC";
        $objQuery = mysqli_query($objCon,$strSQL);
		while($objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC)){
			if(!$objResult) return null;
			$arr_result['name'] = $objResult["name"];
			$arr_result['action'] = $objResult["action"];
			$arr_result['mustLog'] = $objResult["must_login"];
			array_push($array ,$arr_result);
		}
		return $array;
	}
	
	function getTopRank($count) {
		include('config.php');
		$array = array();
			
    	$objCon = $conn;
		$strSQL = "SELECT memberlist.id, memberlist.name, memberlist.gen, ranking.platform, ranking.count, ranking.date, ranking.time
					FROM memberlist
					INNER JOIN ranking ON ranking.name = memberlist.name AND ranking.platform = memberlist.platform
					ORDER BY ranking.count DESC LIMIT ".mysqli_real_escape_string(''.($count * 2));
		
		$objQuery = mysqli_query($objCon,$strSQL);
		
		$output = array();
		while($objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC)){
			if(!$objResult) return $array;
		}
		
	}
	
	function getTopGraph($count, $platform, $gen) {
		$count--; //ลบ 1 ให้ count เพื่อเอาไปใช้กับ array
		include('config.php');
		$objCon = $conn;
		
		if($platform) $cusPlat = " AND memberlist.platform = '".$platform."'"; //เช็คเงื่อนไข Platform
		if($gen) $cusGen = " AND memberlist.gen = ".$gen; //เช็คเงื่อนไข Gen
		
		$strSQL = "SELECT memberlist.id, memberlist.name, memberlist.gen, graph.platform, graph.count, graph.date, graph.time
					FROM memberlist
					INNER JOIN graph ON graph.name = memberlist.name AND graph.platform = memberlist.platform
					WHERE graph.date >= graph.date - INTERVAL 1 DAY".$cusPlat.$cusGen."
					ORDER BY graph.date ASC, graph.time ASC";
		
		$objQuery = mysqli_query($objCon,$strSQL);
		$arr_p = array(); // Array ที่จะใช้เก็บข้อมูลทั้งหมด Query
		while($objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC)){ //ขั้นตอนนี้จะเก็บ data เป็น Array key ที่มาจาก name (เพื่อรวม Data ไว้ในจุดเดียว)
			if(!$objResult) return $array;
			$arr_p[$objResult['name']]['name'] = $objResult['name'];
			$arr_p[$objResult['name']]['gen'] = $objResult['gen'];
			$arr_p[$objResult['name']]['allSum'] = (int)$arr_p[$objResult['name']]['allSum'];
			$arr_p[$objResult['name']][$objResult['platform']]['sum'] = (int)$arr_p[$objResult['name']][$objResult['platform']]['sum'];
			
			if(isset($arr_p[$objResult['name']][$objResult['platform']]['data']['stats'])){  // ถ้ายังไม่เคยมี Data มาก่อน ก็ให้ประกาศตัวแปรสำหรับ Array
				$lenght = (count($arr_p[$objResult['name']][$objResult['platform']]['data']['stats']) - 1); // Get จำนวน array ที่มี (เอาไปใช้กับการหา array
				
				if($lenght >= 0) { //ถ้าเคยมี Data แล้ว ก็ทำขั้นตอนข้างล่าง
					$prv = ((int)$objResult['count'] - $arr_p[$objResult['name']][$objResult['platform']]['data']['stats'][$lenght]); // $prv = ค่าล่าสุด - ค่าก่อนหน้า
					
					$arr_p[$objResult['name']]['allSum'] = $arr_p[$objResult['name']]['allSum'] + $prv;
					$arr_p[$objResult['name']][$objResult['platform']]['sum'] = $arr_p[$objResult['name']][$objResult['platform']]['sum'] + $prv;
					
					array_push($arr_p[$objResult['name']][$objResult['platform']]['data']['value'] , (int)$prv);
				} else { // ถ้ายังไม่เคยมี Data มาก่อน ก็ให้ประกาศตัวแปรสำหรับ Array
					$arr_p[$objResult['name']][$objResult['platform']]['data']['value'] = array();
				}
				array_push($arr_p[$objResult['name']][$objResult['platform']]['data']['stats'] , (int)$objResult['count']); //เก็บ Data
			} else {  // ถ้ายังไม่เคยมี Data มาก่อน ก็ให้ประกาศตัวแปรสำหรับ Array
				$arr_p[$objResult['name']][$objResult['platform']]['data']['stats'] = array();
			}
		}
		$fOutput = array();
		foreach ($arr_p as $key => $value){ //จัดเก็บ Array ใหม่ โดยไม่ใช้ Array key
			array_push($fOutput, $value);
		}
		
		//เริ่มต้นการเรียงข้อมูล
		$j=0;
		$flag = true;
		$temp=0;
		while($flag){	//เรียงอันดับของข้อมูลตาม Array
  			$flag = false;
  			for( $j=0;  $j < count($fOutput)-1; $j++){
    			if($fOutput[$j]["allSum"] < $fOutput[$j+1]["allSum"]){
      				$temp = $fOutput[$j];
      				
					//สับเปลี่ยนข้อมูลไปมาแบบ ปิ้วๆ
      				$fOutput[$j] = $fOutput[$j+1];
      				$fOutput[$j+1]=$temp;
					
      				$flag = true; //บอกว่าข้อมูลยังไม่หมดนะ
    			}
  			}
		}
		$output = array();
		for( $i=0;  $i <= $count; $i++) { //กรองข้อมูล Top จาก $count
			$output[$i] = $fOutput[$i];
		}
		return $output;
	}
	
	public function getMemberDetail($condition, $rTurn, $order) {
		include('config.php');
		$array = array();
		$objCon = $conn;
		
		$selectSQL = '';
		if($rTurn != null && is_array($rTurn)) {
			$iS = 0;
			foreach($rTurn as $structure) {
				if($iS > 0) $selectSQL = $selectSQL.", ";
				$selectSQL = $selectSQL."`".mysqli_real_escape_string($objCon,$structure)."`";
				$iS++;
			}
		} else if ($rTurn != null) {
			$selectSQL = " `".$structure."`";
		} else {
			$selectSQL = '*';
		}
		$iC = 0;
		$whereSQL = '';
		foreach($condition as $key => $item){
			if($iC > 0) $whereSQL = $whereSQL." AND ";
			$whereSQL = $whereSQL."`".$key."` = '".mysqli_real_escape_string($objCon,$item)."'";
			$iC++;
		}
		if($order != null) {
			$orderSQL = "ORDER BY `".mysqli_real_escape_string($objCon,$order[0])."` ".mysqli_real_escape_string($objCon,$order[1])."";
		}
		
		$strSQL = "SELECT $selectSQL FROM bnk_member WHERE $whereSQL $orderSQL";
        $objQuery = mysqli_query($objCon,$strSQL);
		while($objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC)){
			if(!$objResult) return null;
			array_push($array ,$objResult);
		}
		return $array;
	}
}
?>