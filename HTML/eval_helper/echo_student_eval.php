<?php
/////////////////////////////////////////////////////////////////////
///// Defines variables $rubric_1 and $rubric_2 which contains the //
///// values of DB's rubric_1 and rubric_2 contained in a string   //
/////////////////////////////////////////////////////////////////////

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
if (count($_REQUEST) == 3) {
    $student = $_REQUEST['name'];
    $class = $_REQUEST['class'];
    $assignment = $_REQUEST['assignment'];
} else {
    exit("[FATAL ERROR]");
}
/*$sql_1 = "SELECT `citation`, `analysis`, `thesis`, `topic`, `written`
 FROM `rubric_1` 
 WHERE `student_name`='$student' AND `class_name`='$class' AND assignment_name='$assignment'";*/
//$response = @mysqli_query($dbc, $sql_1);

$sql_1 = "SELECT `citation`, `analysis`, `thesis`, `topic`, `written`
 FROM `rubric_1` 
 WHERE `student_name`=? AND `class_name`=? AND assignment_name=?";
$stmt = mysqli_prepare($dbc, $sql_1);
mysqli_stmt_bind_param($stmt, 'sss', $student, $class, $assignment);
mysqli_stmt_execute($stmt);
$response = mysqli_stmt_get_result($stmt);

$rubric_1 = '';
#If there is data and shit, tim is lost
if($response) {
    #Queries all the data and puts it in the row
    while ($row = mysqli_fetch_array($response)) {
        $citation = $row["citation"];
        $analysis = $row["analysis"];
        $thesis = $row["thesis"];
        $topic = $row["topic"];
        $written = $row["written"];

        $rubric_1 .= "$citation : $analysis : $thesis : $topic : $written , ";
    }
}

echo $rubric_1;

/*$sql_2 = "SELECT
 `agreements`, `commas`, `fragments`, `misplaced`, 
 `apostrophes`, `duplicate`, `hypotheticals`, `run_on`, 
`capitalization`, `formatting`, `pronouns`, `verb`,
 `spelling` 
 FROM `rubric_2` 
 WHERE `student_name`='$student' AND `class_name`='$class' AND assignment_name='$assignment'";*/

$sql_2 = "SELECT
 `agreements`, `commas`, `fragments`, `misplaced`, 
 `apostrophes`, `duplicate`, `hypotheticals`, `run_on`, 
`capitalization`, `formatting`, `pronouns`, `verb`,
 `spelling` 
 FROM `rubric_2` 
 WHERE `student_name`=? AND `class_name`=? AND assignment_name=?";
$stmt = mysqli_prepare($dbc, $sql_2);
mysqli_stmt_bind_param($stmt, 'sss', $student, $class, $assignment);
mysqli_stmt_execute($stmt);
$response = mysqli_stmt_get_result($stmt);

$rubric_2 = '';
if($response) {
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

        $rubric_2 .= "$agreements : $commas : $fragments : $misplaced : $apostrophes : $duplicate : $hypotheticals : $run_on : $capitalization : $formatting : $pronouns : $verb : $spelling";
    }
}

echo $rubric_2;
