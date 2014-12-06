<?php
require_once('class.freebase.php');

$freebase = new Freebase();
$result = $freebase->search('Dragon ball z', 'all type:manga');

foreach($result as $entity){

  $id = $entity['mid'];
  $name = $entity['name'];

  $image = $freebase->image($id);
  $text = $freebase->text($id);
?>
<li>
  <h3><?php echo $name; ?></h3>
  <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
  <p>
  <?php echo $text; ?> 
  </p>  
</li>
<?php
}
?>