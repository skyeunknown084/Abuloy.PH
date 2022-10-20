<?php
require 'database.php';
$stmt = $mysqli->query("SELECT * FROM abuloy_accounts ORDER BY id DESC");

if($images = $stmt->fetch_assoc()){
?>
<div style="background-image: url('uploads/<?= $images['avatar'] ?>');
  background-repeat:no-repeat;">
  <img src="uploads/<?=$images['avatar']?>" height="200px" width="200px">
</div>
<?php    
}
?>