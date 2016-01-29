<?php
class datastore {
	private $key = "635a4b6371686f6e38314a6c505178";
	private $searchUrl = "http://openAPI.seoul.go.kr:8088/";
	private $searchUrl2 = "/xml/ListConstructionWorkService/1/5/";
	
	/**
	 * API ����� �޾ƿ��� ���Ͽ� ����API ������ Request �� �ϰ� ����� XML Object �� ��ȯ�ϴ� �޼ҵ�
	 * @return object
	 */
	
	private function datacall() {
		$url = sprintf('%s%s%s', $this->searchUrl, $this->key, $this->searchUrl2);
		$data = file_get_contents($url);
		$xml = simplexml_load_string($data);
		//$xml = simplexml_load_string(iconv("EUC-KR","UTF-8//IGNORE", $data));
		return $xml;
	}
	
	/**
	 * API�� ����� Array ���·� ��ȯ�ϴ� ����� Ŀ���͸���¡ �޼ҵ�
	 * XML�� ���� parsing �Ͽ� Array���·� ��ȯ�Ѵ�
	 */
	public function getData() {
		$xml = $this->datacall();
		$result = array();
		$shop = array();
		if(!empty($xml)) { 
			//foreach($xml->ListConstructionWorkService->row as $data) 
			foreach($xml->row as $data)
			{
				$result['PJT_NAME'] = (string)$data->PJT_NAME;
				$result['PJT_BGN_DATE'] = (int)$data->PJT_BGN_DATE;
				$result['PJT_DATE'] = (string)$data->PJT_DATE;
				$result['PJT_END_DIV'] = (int)$data->PJT_END_DIV;
				$result['LAT'] = (float)$data->LAT;
				$result['LNG'] = (float)$data->LNG;
				$result['SITE_ADDR'] = (string)$data->SITE_ADDR;
				$shop[] = $result;
			}
		}
		
		return $shop;
	}
}
?>