<?php
ob_start();
require("suggestions.php");
$students = explode("&*&*", ob_get_contents());
ob_end_clean();

$students[0] = substr($students[0], 2);
array_pop($students);

require_once('../eval_helper/fpdf_multiline.php');

$pdf = new PDF_Multiline();

$dupable = true;
foreach ($students as $student) {
    $_REQUEST['name'] = $student;
    require('eval.php');
}

$pdf->Output();

del_temp_pics();


?>