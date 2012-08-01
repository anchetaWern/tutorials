<?php
$things = [
			'blogs'=>['smashing magazine', 'codrops', 'sixrevisions', 'nettuts', 'coding horror'],
			'people'=>['john resig', 'jeffrey way', 'chris coyier', 'paul irish']
		];
$json_things = json_encode($things);
echo $json_things;
?>