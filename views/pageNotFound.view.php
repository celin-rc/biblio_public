<?php 
ob_start();
?>

<?= $messageErreur; ?>

<?php 
$title = "Page Introuvable";
$content = ob_get_clean();
require "template.php";

?>