<?php
require_once('../../mysqli_connector.php');

//FIND AVERAGE CONTENT SCORE. 0=>Summation, 1=>out of 'x', 2=>percentage
function average_content()
{
    global $rub_1_count;
    $data = data_points();

    $sum = $data[0] + $data[1];
    $limit = $rub_1_count * 12;

    return array($sum, $limit, number_format($sum * 100 / $limit));
}

// FIND AVERAGE WRITING SCORE. 0=>Summation, 1=>out of 'x', 2=>percentage
function average_writing()
{
    global $rub_1_count;
    $data = data_points();

    $sum = $data[2] + $data[3] + $data[4];
    $limit = $rub_1_count * 18;

    return array($sum, $limit, number_format($sum * 100 / $limit));
}

// RETURNS THE INSTRUCTOR OF THE CLASS
function find_instructor()
{
    global $class;
    require_once('../classes_php/echo_instructor.php');

    return instructor($class);
}

////////////////////////////////////////
// The topleft header of the document //
////////////////////////////////////////

ob_start();
require("../index_php/echo_semester.php");
$sem = ob_get_contents();
ob_end_clean();

function create_pdf_header()
{
    global $pdf;
    global $name;
    global $class;
    global $rub_1_count;
    global $count_assigns;
    global $sem;

    $pdf->SetFont('Helvetica', '', PTS);

    $pdf->Cell(0, 0, 'STUDENT WRITING OVERVIEW', 0, 0, 'C');
    $pdf->Ln(3);

    $pdf->Cell(0, PTS, "Name: $name");
    $pdf->Ln(LBREAK);
    $pdf->Cell(0, PTS, "Class: $class");
    $pdf->Ln(LBREAK);

    $instructors = find_instructor();
    $pdf->Cell(0, PTS, "Instructor: $instructors");
    $pdf->Ln(LBREAK);

    $count = $rub_1_count;
    $pdf->Cell(0, PTS, "Assignments Done: $count out of $count_assigns");
    $pdf->Ln(LBREAK);

    $avg_content = average_content()[0];
    $content_lim = average_content()[1];
    $percent_content = average_content()[2];
    $pdf->Cell(0, PTS, "Content score: $avg_content / $content_lim = $percent_content%");
    $pdf->Ln(LBREAK);

    $avg_writing = average_writing()[0];
    $writing_lim = average_writing()[1];
    $percent_writing = average_writing()[2];
    $pdf->Cell(0, PTS, "Writing score: $avg_writing / $writing_lim = $percent_writing%");
    $pdf->Ln(LBREAK);

    $pdf->Cell(0, PTS, "Current Semester: $sem");
    $pdf->Ln(LBREAK);

    $pdf->Cell(0, PTS, "Date created: " . date("m-d-Y"));
    $pdf->Ln(LBREAK);

    date_default_timezone_set("America/Los_Angeles");
    $pdf->Cell(0, PTS, "Time created: " . date("h:i a"));
    $pdf->Ln(LBREAK);
}

/////////////////////////////////////////////////////////////////////////
// Returns an array with the accumulative score of each of the indeces //
/////////////////////////////////////////////////////////////////////////

function data_points()
{
    global $rub_1_array;

    $data_points = array(0, 0, 0, 0, 0);
    foreach ($rub_1_array as $item) {
        $formatted = substr($item, 1, -1);

        $data = explode(" : ", $formatted);

        $sentry = 0;
        foreach ($data as $point) {
            $data_points[$sentry] += $point;
            $sentry++;
        }
    }
    return $data_points;
}

///////////////////////////////////
// Delete all files in temp_pics //
///////////////////////////////////

function del_temp_pics()
{
    $path = '\xampp\htdocs\Database\HTML\eval_helper\temp_pics';
    $files = glob($path . '/*');
    foreach ($files as $file) {
        unlink($file);
    }
    return;
}

function get_id_from_name($student, $class)
{
    global $dbc;
    $array = array();

    //$sql = "SELECT student_id FROM `students` WHERE class_name='$class' AND student_name='$student' ";
    //$response = @mysqli_query($dbc, $sql);

    $query = "SELECT student_id FROM `students` WHERE class_name=? AND student_name=? ";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $class, $student);
    mysqli_stmt_execute($stmt);
    $response = mysqli_stmt_get_result($stmt);

    #If there is data and shit
    if ($response) {
        #Queries all the data and puts it in the row
        $student_id = '';
        while ($row = mysqli_fetch_array($response)) {
            $student_id .= $row['student_id'];
        }
        $array[0] = $student_id;
    }

    // CLASS ID PART
    //$sql = "SELECT `class_id` FROM `classes` WHERE class_name='$class'";
    //$response = @mysqli_query($dbc, $sql);

    $query = "SELECT `class_id` FROM `classes` WHERE class_name=?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 's', $class);
    mysqli_stmt_execute($stmt);
    $response = mysqli_stmt_get_result($stmt);

    #If there is data and shit
    if ($response) {
        #Queries all the data and puts it in the row
        $student_id = '';
        while ($row = mysqli_fetch_array($response)) {
            $student_id .= $row['class_id'];
        }
        $array[1] = $student_id;
    }
    return $array;
}