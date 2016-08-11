<?php
require_once('../mysqli_connector.php');

$student = urldecode($_GET['name']);
$class = urldecode($_GET['class']);

//$sql = "SELECT assignment_name FROM rubric_1 WHERE student_name='$student' AND class_name='$class'";

$query = "SELECT assignment_name FROM rubric_1 WHERE student_name=? AND class_name=?";
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'ss', $student, $class);
mysqli_stmt_execute($stmt);
$response = mysqli_stmt_get_result($stmt);

//$response = @mysqli_query($dbc, $sql);

#If there is data and shit
if($response) {
    #Queries all the data and puts it in the row
    $table = '&*&*';
    while ($row = mysqli_fetch_array($response)) {
        $assignment_name = $row["assignment_name"];

        $table .= "$assignment_name&*&*";
    }
}
$assignment_list = explode("&*&*", $table);
array_pop($assignment_list);
array_shift($assignment_list);


?>

<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $student?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

    <script src="../sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
    <script src="jquery.js"></script>
</head>
<body>

<!-- Header -->
<header id="header">
    <a class="title">Edit Student Evaluations</a>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="evaluate_students.php" >Evaluate students</a></li>
            <li><a href="add_students.html" >Add students</a></li>
            <li><a href="javascript:void(0)">Add classes</a></li>
            <li><a href="assignment_index.html">Add Assignments</a></li>
        </ul>
    </nav>
</header>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <section id="main" class="wrapper">
        <div class="inner">
            <h1 class="major">
                Name: <?php echo $student?> <br/>
                Class: <?php echo $class?>
            </h1>

            <script>
                function push_data() {
                    $.post("classes_php/add_class.php", $("#class").serializeArray() , function(data) {
                        // document.write(data);
                        $("#class_name").val("");
                        update_table();
                    });
                }

                function update_table() {
                    $.get("classes_php/show_classes.php", function (data){
                        document.getElementById("classes_table").innerHTML = data;
                    });
                }

                function delete_row(assignment, student, class_name) {
                    var url = "eval_php/delete_entry.php?class="+class_name+"&student="+student+"&assignment="+assignment;
                    //alert(url);
                    $.get(encodeURI(url), function (){
                        //update_table();
                    });
                    //alert(assignment + student)
                }

                function delete_all() {
                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to undo this!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, clear it!",
                        closeOnConfirm: false
                    }, function(){
                        $.post("classes_php/delete_all.php", function (){
                            update_table();
                            swal("Deleted!", "You asked for it.", "success");
                        });
                    });
                }

                $(document).ready(function() {
                    $("#class").submit(function(e) {
                        e.preventDefault();
                        push_data();
                    });
                });

            </script>

            <table id="classes_table">
                <?php
                if(count($assignment_list) <=0){
                    $table =
                        "<tr>
                               <td>
                                   No evaluations to edit for $student
                               </td>
                           </tr>";
                    echo $table;
                }
                $student_enc = rawurlencode($student);
                $class_enc = rawurlencode($class);
                foreach ($assignment_list as $assignment){
                    $assignment_enc = rawurlencode($assignment);
                    $url = "evaluate_students.php?name=$student_enc&class=$class_enc&assignment=$assignment_enc";
                    $table =
                        "<tr>
                               <td width='10%'>
                                   <a style='color:#ff7800; cursor: pointer;' onclick=\"delete_row('$assignment', '$student', '$class')\"> 
                                       X 
                                    </a>
                               </td>
                               <td>
                                   <a href='$url'>$assignment</a>
                               </td>
                           </tr>";
                    echo $table;
                        
                        
                    }
                ?>
            </table>

            <button onclick="delete_all();">Clear All</button>

        </div>
    </section>
</div>
<!-- Footer -->
<footer id="footer" class="wrapper alt">
    <div class="inner">
        <ul class="menu">
            <li>&copy; Timothy Samson and Casey Lee 2016</li>
        </ul>
    </div>
</footer>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
<script src="assets/js/main.js"></script>

</body>
<iframe name="hiddenFrame" width="0" height="0" border="0" style="display: none;"></iframe>
</html>