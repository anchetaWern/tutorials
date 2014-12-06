<?php
class Freebase{
	
	private $api_key = ''; //put your API key here


	public function search($query = 'nirvana', $filter = '', $start = 0, $limit = 10, $exact = 'false'){

		$query = urlencode($query);
		$url 	= 'https://www.googleapis.com/freebase/v1/search?query='. $query;
		$url .= '&filter=(' . urlencode($filter) . ')';
		$url .= '&start=' . $start;
		$url .= '&limit=' . $limit;
		$url .= '&exact=' . $exact;
		$url .= '&lang=fr';
		$url .= '&key=' . $this->api_key;
		

		return json_decode(file_get_contents($url), true)['result'];
	}

	public function image($entity_id, $max_width = 150, $max_height = 150){

		$url = 'https://usercontent.googleapis.com/freebase/v1/image' . $entity_id;
		$url .= '?maxwidth=' . $max_width;
		$url .= '&maxheight=' . $max_height;
		$url .= '&key=' . $this->api_key;
	
		return $url;
	}

	public function text($entity_id, $max_length = '0'){

		$url 	= 'https://www.googleapis.com/freebase/v1/text/' . $entity_id;
		$url .= '?maxlength=' . $max_length;
		$url .= '&lang=fr';
		$url .= '&key=' . $this->api_key;
		

		return json_decode(file_get_contents($url), true)['result'];
	}

	public function topic($entity_id){

		$url = 'https://www.googleapis.com/freebase/v1/topic' . $entity_id;
		return json_decode(file_get_contents($url), true);
	}
}
?>
