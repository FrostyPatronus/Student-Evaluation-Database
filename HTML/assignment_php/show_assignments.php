<?php
//SHOWS ALL THE ASSIGNMENTS
//Connects to the database
require_once('../../mysqli_connector.php'); //Queries the data from the MySQL DB
//$query = 'SELECT * FROM assignments ORDER BY date_due DESC ';
$query = "
SELECT `class_name`, assignments.assignment_name, `class_id`, assignments.assignment_id, assignments.date_due 
FROM `assignment_group`, assignments 
WHERE assignment_group.assignment_id = assignments.assignment_id 
ORDER BY class_id, assignments.date_due DESC ";
$response = @mysqli_query($dbc, $query);

#If there is data and shit
if($response){
    #Queries all the data and puts it in the row
    $table = '
            <tr>
				<th></th>
				<th>Assignment Name</th>
				<th>Assignment Due (YYYY-MM-DD)</th>
			</tr>
			';
    $cur_class = '';
    while($row = mysqli_fetch_array($response)){
        $assign_id = $row["assignment_id"];
        $class_id = $row["class_id"];

        $class_name = $row["class_name"];
        $assign_name = $row["assignment_name"];
        $date_due = $row["date_due"];

        if ($cur_class != $class_name){
            $table.= "<tr>
                        <td><h2><a style=\"color:#690000; cursor: pointer;\" onclick='delete_group(\"$class_name\")'>X</a></h2></td>
                        <td align=\"center\" >
                            <h2>&nbsp;$class_name</h2>
                        </td><td></td>
                      </tr>";
        }

        $cur_class = $class_name;

        $table .= "
            <tr id='table_$assign_id'>
                <td>
                    <a style='color:#ff7800; cursor: pointer' title='Delete assignment \"$assign_name\" in THIS CLASS'
                     onclick=\"delete_row('$assign_id', '$class_id')\"> X </a>
                </td>
                <td>$assign_name <a style='color:#ff7800; cursor: pointer' title='Delete assignment \"$assign_name\" from EVERY CLASS' 
                onclick=\"delete_instance('$assign_name')\"> X </a></td>
                <td>$date_due</td>    
            </tr>";
    }
    echo $table;
} ?>