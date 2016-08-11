<?php
require_once('../../mysqli_connector.php');

$sql = "SELECT * FROM students ORDER BY class_name, student_name";
$response = @mysqli_query($dbc, $sql);

#If there is data and shit
if ($response) {
    #Queries all the data and puts it in the row
    $table = '
            <tr>
				<th width="10%"></th>
				<th>Student Name</th>
				<th>Class Name</th>
			</tr>
			';
    $current_class = '';
    while ($row = mysqli_fetch_array($response)) {
        $student_id = $row["student_id"];
        $student_name = $row["student_name"];
        $class_name = $row["class_name"];

        $student_name_en = rawurlencode($student_name);
        $class_name_en = rawurlencode($class_name);

        $boole = $current_class != $class_name;
        if ($boole) {
            $table .= "<tr>
                        <td><h2><a style=\"color:#690000; cursor: pointer;\" onclick='delete_group(\"$class_name\")'>X</a></h2></td>
                        <td align=\"center\" >
                            <a href='eval_php/eval_class.php?class=$class_name_en'><h2>$class_name</h2></a>
                        </td><td></td>
                      </tr>";
        }

        $current_class = $class_name;

        $query = "name=$student_name_en&class=$class_name_en";
        $url = "edit_eval.php?name=$student_name_en&class=$class_name_en";
        //eval_php/eval.php?name=$student_name&class=$class_name
        $table .= "
                <tr id=\"table_$student_id\">
                <td width=\"10%\">
                    <a style=\"color:#ff7800; cursor: pointer;\" onclick=\"delete_row($student_id)\" 
                    title='Delete $student_name from this class'> X </a>
                </td>
                <td>
                    <a style=\"color:#0066ff\" href='$url' class='hover-white' title='Edit evaluations for $student_name'> EDIT </a>
                    
                    <a href='eval_php/eval.php?$query' 
                    title='Look at evaluations for $student_name'>$student_name</a>
                </td>
                <td>
                    $class_name
                </td>
            </tr>";
    }

    echo $table;
}
?>