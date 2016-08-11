<?php
require('define_eval.php');
require_once('../eval_helper/functions.php');

if(count($_REQUEST) == 2){
    $name = $_REQUEST['name'];
    $class = $_REQUEST['class'];
}else {
    exit("FATAL ERROR. Insufficient values passed to URL");
}

$student_id = get_id_from_name($name, $class)[0];
$class_id = get_id_from_name($name, $class)[1];

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Capturing the output of Student PHP to check if the student and class name provided by the URL exists in the database //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

ob_start();
require("../students_php/echo_students.php");
$students_blob = ob_get_contents();
ob_end_clean();

$search_string = "($name : $class)";
$student_exists = strrpos($students_blob, $search_string) !== FALSE;

// IF STUDENT EXISTS IN THE DATABASE, IT EXECUTES.

if (!defined('PTS')){
    define('PTS', 16); //Define PTS to have value 14
}
if (!defined('LBREAK')){
    define('LBREAK', 10); //Define BREAK to have value 8
}

if(!$student_exists){
    exit("FATAL ERROR. Error. Student '$name' does not exist <br>");
}

///////////////////////////////////////////////////////
// If the student exists, create a new FPDF Document //
///////////////////////////////////////////////////////

$pdf->AddPage();

// DEFINE rub_1_array = The individual evaluations of the student
$rub_1_array = explode(",", $rubric_1);
array_pop($rub_1_array);

// DEFINE rub_1_count = number of evaluations for a student
$rub_1_count = count($rub_1_array);

// IF no assignments for a person, then print a pdf with this on
if($rub_1_count == 0){
    $pdf->SetFont("Helvetica");
    $pdf->Write(PTS, "No assignments evaluated for $name of class $class.");
    $pdf->Output();
    exit();
}

// DEFINE count_assigns = Number of total assignments for a particular class
require_once ("../eval_helper/fecho_all_assign.php");
$count_assigns = count(explode("&*&*",f_echo($class))) - 1;

// Creates the PDF Header
create_pdf_header();

/////////////////////////////////////////////////////////////////////////
// Makes an image of the radar graph and displays it accordingly  ///////
/////////////////////////////////////////////////////////////////////////

require_once ("../eval_helper/generate_img.php");

$count = $rub_1_count * 6;
img_gen("$student_id.$class_id", data_points(), $count);

$pdf->SetY(16);
$pdf->SetX(120);
$pdf->Image("../eval_helper/temp_pics/$student_id.$class_id.png");

//////////////////////////////////////////////
// Creating the Table ////////////////////////
//////////////////////////////////////////////

//$header = array("----","1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
$data = array(
    array("============="),
    array("Agreements"),
    array("Commas"),
    array("Fragments"),
    array("Misplaced\nModifiers"),
    array("Apostrophes"),
    array("Duplicate\nSubjects"),
    array("Hypotheticals"),
    array("Run-on\nSentences"),
    array("Capitalization"),
    array("Formatting"),
    array("Pronouns"),
    array("Verb"),
    array("Spelling")
);

$widths = array(45);

$raw_points = explode(",", $rubric_2);
array_pop($raw_points);
$sentry = 1;
$sentry_2 = 1;
foreach ($raw_points as $column){
    $points_str = substr($column, 1, -1);
    $points = explode(" : ", $points_str);

    $widths[] = 10;
    $data[0][] = $sentry_2;

    foreach ($points as $point){
        $string = '';
        if ($point === '1'){
            $string = 'X';
        }

        $data[$sentry][] = $string;
        $sentry++;
    }
    $sentry = 1;
    $sentry_2++;
}

//Table with 20 rows and 4 columns
$pdf->Ln(15);
$pdf->SetWidths($widths);

foreach ($data as $col){
    $pdf->Row($col);
}

$pdf->Ln(3);
$pdf->SetFontSize(10);
$pdf->Cell(15, 0, "The Xs mean you did something wrong.");
$pdf->Ln(4);
$pdf->Cell(15, 0, "For comments and suggestions, Talk to Mr. Hsu");
$pdf->Ln(4);
$pdf->Cell(15, 0, "Created by Timothy Samson @ (Instagram) tim.gab.sam");
