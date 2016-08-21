<?php
///////////////////////////////////////////////////////////////////////////////////
///// Defines variables $rubric_1 and $rubric_2 and due dates which contains the //
///// values of DB's rubric_1 and rubric_2 contained in a string //////////////////
///////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////
// RUBRIC 1 TEMPLATE VALUE PACKET ///////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////
// ($citation : $analysis : $thesis : $topic) ///
/////////////////////////////////////////////////

#=-=-=-=-=-=-=-=-=-=-=-==-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

/////////////////////////////////////////////////////////////////////////
// RUBRIC 2 TEMPLATE VALUE PACKET ///////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////
// ($agreements : $commas : $fragments : $misplaced : $apostrophes : ///////
// $duplicate : $hypotheticals : $run_on : $capitalization : $formatting : /
// $pronouns : $verb : $spelling) //////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////

require_once('../../mysqli_connector.php');

$student = Null;
$class = Null;
// echo count($_REQUEST);
if (count($_REQUEST) == 2) {
    $student = $_REQUEST['name'];
    $class = $_REQUEST['class'];
} else {
    exit("[FATAL ERROR]");
}
//$sql_1 = "SELECT `citation`, `analysis`, `thesis`, `topic`, `written` FROM `rubric_1` WHERE `student_name`='$student' AND `class_name`='$class'";
//$response = @mysqli_query($dbc, $sql_1);

$sql_1 = "SELECT `citation`, `analysis`, `thesis`, `topic`, `written` FROM `rubric_1` WHERE `student_name`=? AND `class_name`=?";
$stmt = mysqli_prepare($dbc, $sql_1);
mysqli_stmt_bind_param($stmt, 'ss', $student, $class);
mysqli_stmt_execute($stmt);
$response = mysqli_stmt_get_result($stmt);

$rubric_1 = '';
#If there is data and shit
if ($response) {
    #Queries all the data and puts it in the row
    while ($row = mysqli_fetch_array($response)) {
        $citation = $row["citation"];
        $analysis = $row["analysis"];
        $thesis = $row["thesis"];
        $topic = $row["topic"];
        $written = $row["written"];

        $rubric_1 .= "($citation : $analysis : $thesis : $topic : $written),";
    }
}

//////////////////////////////////
// RUBRIC 2 //////////////////////
//////////////////////////////////

//$sql_2 = "SELECT
// `agreements`, `commas`, `fragments`, `misplaced`,
// `apostrophes`, `duplicate`, `hypotheticals`, `run_on`,
//`capitalization`, `formatting`, `pronouns`, `verb`,
// `spelling` FROM `rubric_2`
// WHERE `student_name`='$student'
// AND `class_name`='$class'";
//$response = @mysqli_query($dbc, $sql_2);

//$sql_2 = "SELECT
// `agreements`, `commas`, `fragments`, `misplaced`,
// `apostrophes`, `duplicate`, `hypotheticals`, `run_on`,
//`capitalization`, `formatting`, `pronouns`, `verb`,
// `spelling` FROM `rubric_2`
// WHERE `student_name`=?
// AND `class_name`=?";

# This will all the rubric_2 values for a certain student in a cetrain class
$sql_2 = "
    SELECT `agreements`, `commas`, `fragments`, `misplaced`, `apostrophes`, 
    `duplicate`, `hypotheticals`, `run_on`, `capitalization`, `formatting`,
     `pronouns`, `verb`, `spelling`, assignments.date_due 
     FROM `rubric_2`, assignments, assignment_group   
     WHERE rubric_2.assignment_id = assignment_group.rel_id 
     AND assignment_group.assignment_id = assignments.assignment_id
     AND `student_name`=?
     AND rubric_2.class_name=?
     ORDER BY assignments.date_due ASC
";
$stmt = mysqli_prepare($dbc, $sql_2);
mysqli_stmt_bind_param($stmt, 'ss', $student, $class);
mysqli_stmt_execute($stmt);
$response = mysqli_stmt_get_result($stmt);

$rubric_2 = '';
$due_dates = '';
#If there is data and shit
if ($response) {
    #Queries all the data and puts it in the row
    while ($row = mysqli_fetch_array($response)) {
        $agreements = $row['agreements'];
        $commas = $row['commas'];
        $fragments = $row['fragments'];
        $misplaced = $row['misplaced'];
        $apostrophes = $row['apostrophes'];
        $duplicate = $row['duplicate'];
        $hypotheticals = $row['hypotheticals'];
        $run_on = $row['run_on'];
        $capitalization = $row['capitalization'];
        $formatting = $row['formatting'];
        $pronouns = $row['pronouns'];
        $verb = $row['verb'];
        $spelling = $row['spelling'];
        $date_due = $row['date_due'];

        $rubric_2 .= "($agreements : $commas : $fragments : $misplaced : $apostrophes : $duplicate : $hypotheticals : $run_on : $capitalization : $formatting : $pronouns : $verb : $spelling),";
        $due_dates .= ":$date_due";
    }
}

/*$sql_3 = "
SELECT date_due FROM `rubric_1`, assignments 
WHERE rubric_1.assignment_id = assignments.assignment_id 
AND student_name = ?
AND class_name = ?
ORDER BY date_due ASC
";
$stmt = mysqli_prepare($dbc, $sql_3);
mysqli_stmt_bind_param($stmt, 'ss', $student, $class);
mysqli_stmt_execute($stmt);
$response = mysqli_stmt_get_result($stmt);

$assignments = '';
if ($response) {
    while ($row = mysqli_fetch_array($response)){
        $date = $row['date_due'];
        $assignments .= " : $date";
    }
}*/

//echo $assignments;
//echo "<br>";
//echo $rubric_1;
//echo "<br>";
//echo $rubric_2;


?>