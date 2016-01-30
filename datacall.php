<?php
// 검색결과를 호출하고/파싱할 수 있는 파일은 Include 한다. 
require_once 'datastore.php';
$shop = new datastore();
$result = $shop->getData();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ko">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Content-Script-Type" content="text/javascript">
        <meta http-equiv="Content-Style-Type" content="text/css">
        <title>ConMaps Test Page</title>
</head>

<body>
	<div id="map" style="width:100%;height:350px;"></div>
	<script type="text/javascript" src="http://apis.daum.net/maps/maps3.js?apikey=f9142c3e42b1a984d55e6700933523d4" charset="utf-8">
	</script>
	<script>
		var mapContainer = document.getElementById('map'), // 지도를 표시할 div  
		    mapOption = { 
		        center: new daum.maps.LatLng(37.544769, 126.971681), // 지도의 중심좌표
		        level: 3 // 지도의 확대 레벨
		    }; 
		var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
			
		// 마커를 표시할 위치와 title 객체 배열입니다 
		var positions = [
		<?php
			$i = 1;
			foreach ($result as $data) {
				if($i > 1) echo ",";
				echo "{title:'" . $data['PJT_NAME'] . "',";
				echo "latlng:new daum.maps.LatLng(" . $data['LAT'] . "," . $data['LNG'] . ")}";
				$i = $i+1;
			}
		?>
		];

		
		// 마커 이미지의 이미지 주소입니다
		var imageSrc = "http://i1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png"; 
		    
		for (var i = 0; i < positions.length; i ++) {
		    
		    // 마커 이미지의 이미지 크기 입니다
		    var imageSize = new daum.maps.Size(24, 35); 
		    
		    // 마커 이미지를 생성합니다    
		    var markerImage = new daum.maps.MarkerImage(imageSrc, imageSize); 
		    
		    // 마커를 생성합니다
		    var marker = new daum.maps.Marker({
		        map: map, // 마커를 표시할 지도
		        position: positions[i].latlng, // 마커를 표시할 위치
		        title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
		        image : markerImage // 마커 이미지 
		    });
		}
		

		</script>

		<!--  
		<table cellspacing="0" border="1" summary="쇼핑 검색 API 결과" class="tbl_type">
        <caption>API Result</caption>
                <colgroup>
                        <col width="10%">
                        <col width="20%">
                        <col width="15%">
                </colgroup>
                <thead>
                        <tr>
                        <th scope="col">PJT_NAME</th>
                        <th scope="col">LAT</th>
                        <th scope="col">LNG</th>
                        </tr>
                </thead>
                <tbody id="list">
<?php
 // 결과를 반복문(foreach)를 사용하여 페이지에 표현한다. 
	foreach ($result as $data) {
?>
                        <tr>
                                <td><?php echo $data['PJT_NAME'];?></td>
                                <td><?php echo $data['LAT'];?></td>
                                <td><?php echo $data['LNG'];?></td>
                        </tr>
                        <?php } ?>
                </tbody>
        </table> -->
        
        
</body>
</html>