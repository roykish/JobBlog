<?php
include 'config/init.php';
?>


<?php
$template = new Template('templates/frontPage.php');
$template->title = 'latest job';
echo $template;
?>