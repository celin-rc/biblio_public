<?php 
ob_start();
?>

<ol class="breadcrumb">
  <li class="breadcrumb-item active">Accueil</li>
</ol>



<?php 
$title = "Bibliothèque PUBLIC";
$content = ob_get_clean();
require "template.php";

?>