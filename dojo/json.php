<?php
$things = [
			'blogs'=>['smashing magazine', 'codrops', 'sixrevisions', 'nettuts', 'coding horror'],
			'people'=>['john resig', 'jeffrey way', 'chris coyier', 'jamison dance']
		];
$json_things = json_encode($things);
echo $json_things;
?>