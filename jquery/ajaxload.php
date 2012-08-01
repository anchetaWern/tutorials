<h1>
<?php echo "Im loaded via ajax"; ?>
</h1>
<?php
foreach($_POST['names']['names'] as $row){
?>
<li><?php echo $row; ?></li>
<?php
}
?>