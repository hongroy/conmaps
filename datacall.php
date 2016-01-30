<?php
// �˻������ ȣ���ϰ�/�Ľ��� �� �ִ� ������ Include �Ѵ�. 
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
        <link rel="stylesheet" type="text/css" href="http://api.typolink.co.kr/css?family=RixSGo+L:400" />
        <style>
        body {
          font-family: 'RixSGo L';
          font-size: 11px;
        }
      	</style>

      	
      	
        <title>ConMaps Test Page</title>
</head>

<body>
	<div id="map" style="width:100%;height:600px;"></div>
	<script type="text/javascript" src="http://apis.daum.net/maps/maps3.js?apikey=f9142c3e42b1a984d55e6700933523d4" charset="utf-8">
	</script>
	<script>
		var home_contents = '<HOME>';
		var home_position = new daum.maps.LatLng(37.544769, 126.971681); //�̾����η°��� ��ġ(���α׷� �⺻ ��ġ)
		var mapContainer = document.getElementById('map'), // ������ ǥ���� div  
		    mapOption = { 
		        center: home_position,
		        level: 5 // ������ Ȯ�� ����
		    }; 
		var map = new daum.maps.Map(mapContainer, mapOption); // ������ �����մϴ�
		 
		var markers = [];
		// ��Ŀ�� �����ϰ� �������� ǥ���ϴ� �Լ��Դϴ�
		
 		// Ŀ���� �������̸� �����մϴ�.(Ȩ ǥ��)
		var customOverlay = new daum.maps.CustomOverlay({
		    position: home_position,
		    content: home_contents   
		});

		// Ŀ���� �������̸� ������ ǥ���մϴ�.(Ȩ ǥ��)
		customOverlay.setMap(map);


		daum.maps.event.addListener(map, 'click', function(mouseEvent) {        
		    // Ŭ���� ��ġ�� ��Ŀ�� ǥ���մϴ� 
		    addMarker(mouseEvent.latLng);             
		});
		// ������ ǥ�õ� ��Ŀ ��ü�� ������ ���� �迭�Դϴ�
		    
		showConmap(map);


		





		
		// ���������츦 ǥ���ϴ� Ŭ������ ����� �Լ��Դϴ� 
		function makeOverListener(map, marker, infowindow) {
		    return function() {
		        infowindow.open(map, marker);
		    };
		}
		
		// ���������츦 �ݴ� Ŭ������ ����� �Լ��Դϴ� 
		function makeOutListener(infowindow) {
		    return function() {
		        infowindow.close();
		    };
		}

		function addMarker(position) {
		    
		    // ��Ŀ�� �����մϴ�
		    var marker = new daum.maps.Marker({
		        position: position
		    });

		    // ��Ŀ�� ���� ���� ǥ�õǵ��� �����մϴ�
		    marker.setMap(map);
		    
		    // ������ ��Ŀ�� �迭�� �߰��մϴ�
		    markers.push(marker);
		}

		// �迭�� �߰��� ��Ŀ���� ������ ǥ���ϰų� �����ϴ� �Լ��Դϴ�
		function setMarkers(map) {
		    for (var i = 0; i < markers.length; i++) {
		        markers[i].setMap(map);
		    }            
		}

		function showConmap(map) {
			// ��Ŀ �̹����� �̹��� �ּ��Դϴ�
			var imageSrc = "http://i1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";
			// ��Ŀ�� ǥ���� ��ġ�� title ��ü �迭�Դϴ� 
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
			for (var i = 0; i < positions.length; i ++) {
			    
			    // ��Ŀ �̹����� �̹��� ũ�� �Դϴ�
			    var imageSize = new daum.maps.Size(24, 35); 
			    
			    // ��Ŀ �̹����� �����մϴ�    
			    var markerImage = new daum.maps.MarkerImage(imageSrc, imageSize); 
			    
			    // ��Ŀ�� �����մϴ�
			    var marker = new daum.maps.Marker({
			        map: map, // ��Ŀ�� ǥ���� ����
			        position: positions[i].latlng, // ��Ŀ�� ǥ���� ��ġ
			        //title : positions[i].title, // ��Ŀ�� Ÿ��Ʋ, ��Ŀ�� ���콺�� �ø��� Ÿ��Ʋ�� ǥ�õ˴ϴ�
			        image : markerImage // ��Ŀ �̹��� 
			    });

			    var infowindow = new daum.maps.InfoWindow({
			        content: '<p style="margin:7px 22px 7px 12px;font:12px/1.5 sans-serif">' + positions[i].title // ���������쿡 ǥ���� ����
			    });
			    daum.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
			    daum.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
			}
			
		}

















		
		</script>



		<!--  
		<table cellspacing="0" border="1" summary="���� �˻� API ���" class="tbl_type">
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
 // ����� �ݺ���(foreach)�� ����Ͽ� �������� ǥ���Ѵ�. 
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