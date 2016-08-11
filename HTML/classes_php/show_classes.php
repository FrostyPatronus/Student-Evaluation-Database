<?php
require_once('../../mysqli_connector.php');

$sql = "SELECT * FROM classes ORDER BY class_id DESC";
$response = @mysqli_query($dbc, $sql);
#If there is data and shit
if($response) {
    #Queries all the data and puts it in the row
    $table = '
            <tr>
				<th width="10%"></th>
				<th>Class Name</th>
				<th>Instructor</th>
			</tr>
			';

    while ($row = mysqli_fetch_array($response)) {
        /*$table .= '<tr id="table_' . $row["class_id"] . '"><td width="10%">' .
            '<a style="color:#ff7800; cursor: pointer;" onclick="delete_row(' . $row["class_id"] . ')"> X </a></td><td>' .
            $row["class_name"] . '</td></td>';*/

        $class_id = $row["class_id"];
        $class_name = $row["class_name"];
        $instructor = $row["instructor"];

        $table .=
            "<tr id='table_$class_id'>
                <td width='10%'>
                    <a style='color:#ff7800; cursor: pointer;' onclick=\"delete_row('$class_id')\"> 
                        X 
                    </a>
                </td>
                <td>
                    $class_name
                </td>
                <td>
                    $instructor
                </td>
            </tr>";
    }
    echo $table;
}
?>