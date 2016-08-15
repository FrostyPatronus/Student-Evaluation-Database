<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>Evaluate Students</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!--[if lte IE 8]>
    <script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css"/>
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ie9.css"/><![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="assets/css/ie8.css"/><![endif]-->

    <script src="../sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
    <script src="jQuery/jQuery1"></script>
    <script src="jQuery/jQuery2"></script>
    <script src="../setOps.js"></script>


    <?php // PHP CODE. Checks if it is in a edit eval mode
    $is_edit = count($_REQUEST) == 3;

    if ($is_edit) {
        $name = $_REQUEST['name'];
        $class = $_REQUEST['class'];
        $assignment = $_REQUEST['assignment'];

        $script = "
        <script>
            $(document).ready(function() {
               edit_assign('$name', '$class', '$assignment');
               class_options('$class');
               window.history.pushState('object or string', 'Title', 'http://localhost/Database/HTML/evaluate_students.php');
            })
        </script>";
        echo $script;
    } else {
        $script = "
        <script>
             $(document).ready(function() {
                class_options();
             })
         </script>";
        echo $script;
    }
    ?>

</head>
<body>

<!-- Header -->
<header id="header">
    <a href="index.html" class="title">Humanities Database</a>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="evaluate_students.php" class="active">Evaluate students</a></li>
            <li><a href="add_students.html">Add students</a></li>
            <li><a href="add_classes.html">Add classes</a></li>
            <li><a href="assignment_index.html">Add Assignments</a></li>
        </ul>
    </nav>
</header>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <section id="main" class="wrapper">
        <div class="inner">
            <h1 class="major"><?php
                if ($is_edit) {
                    echo "$name<br/>$class";
                } else {
                    echo 'Evaluate Students';
                }
                ?></h1>
            <!--<span class="image fit"><img src="images/pic04.jpg" alt="" /></span>-->
            <a href="javascript:void(0)" onclick="delete_recent()">
                <img style="max-width: 20px; max-height: 20%" src="images/Arrows-Undo-icon.png"></a>
            <h3 id="recent" style="color: #768b95;display: inline-block"> &nbsp;Recently Added:
                <span style="color: white" id="name_student"></span></h3>


            <script>
                function recently_added (student_val, class_val, assignment_val){
                    var rec_student = $("#name_student");

                    var url = "edit_eval.php?name="+encodeURIComponent(student_val)+"+&class="+encodeURIComponent(class_val);

                    var html = "<a href='"+url+"'>";
                    html += student_val + " From " + class_val + ": '" + assignment_val +"'";
                    html += "</a>";

                    rec_student.html(html);
                }
            </script>


            <script>
                function edit_assign(name, class_name, assignment) {
                    $("#student_name").val(name);
                    $("#class").val(class_name);
                    $("#assignment").val(assignment);

                    name = encodeURIComponent(name);
                    class_name = encodeURIComponent(class_name);
                    assignment = encodeURIComponent(assignment);

                    var url = "eval_helper/echo_student_eval.php?name=" + name + "&class=" + class_name + "&assignment=" + assignment;
                    $.get(url, function (data) {
                        data = data.split(" , ");

                        var rubric_1 = data[0];
                        var rubric_2 = data[1];

                        rubric_1 = rubric_1.split(" : ").map(Number);
                        rubric_2 = rubric_2.split(" : ").map(Number);

                        var radios = ['citation', 'analysis', 'thesis', 'topic', 'written'];
                        for (var i = 0; i < radios.length; i++) {
                            $("input[name=" + radios[i] + "][value=" + rubric_1[i] + "]").prop('checked', true);
                        }

                        var checkboxes = [`agreements`, `commas`, `fragments`, `misplaced`,
                            `apostrophes`, `duplicate`, `hypotheticals`, `run_on`,
                            `capitalization`, `formatting`, `pronouns`, `verb`,
                            `spelling`];
                        for (var x = 0; x < checkboxes.length; x++) {
                            if (rubric_2[x] == 1) {
                                $("#" + checkboxes[x]).prop('checked', true);
                            }
                        }
                    });
                }
            </script>

            <form id="eval_form">
                <div class="table-wrapper">
                    <table>
                        <tbody>
                        <tr>
                            <td style="vertical-align:middle;width:20%;"><h3>Student Name: </h3></td>
                            <td>
                                <input type="text"
                                       id="student_name" name="student_name" placeholder="'Trump, Donald John'"
                                       onclick="select()" required/>
                                <script>
                                    var availableTags = [];

                                    $("#student_name").autocomplete({
                                        delay: 0,
                                        source: availableTags
                                    });

                                    var suggest_students = function (str) {
                                        $.get("eval_php/suggestions.php?class=" + str, function (data) {
                                            availableTags.length = 0;
                                            var x = data.split("&*&*", data.split("&*&*").length - 1);
                                            for (var i = 0; i < x.length; i++) {
                                                availableTags.push(x[i]);
                                            }
                                            //suggest_assign(str);

                                        });
                                    }
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;width:20%;"><h3>Class: </h3></td>
                            <td>
                                <select form="eval_form" name="class" id="class" required>
                                    <script>
                                        /*
                                         $.get("students_php/options.php", function(data) {
                                         //  document.write(data);
                                         var x = $("#class");
                                         x.html(data);
                                         suggest_students(x.val());

                                         var student_value = $("#student_name").val();
                                         suggest_assign(x.val(), student_value, true);

                                         });
                                         */
                                        function class_options(select) {
                                            $.get("students_php/options.php", function (data) {
                                                //  document.write(data);
                                                var x = $("#class");
                                                x.html(data);

                                                if (typeof  select != 'undefined')
                                                    x.val(select);

                                                suggest_students(x.val());

                                                var student_value = $("#student_name").val();
                                                suggest_assign(x.val(), student_value, true);

                                            });
                                        }

                                        var class_selector = $("#class");
                                        class_selector.change(function () {
                                            //alert(class_selector.val());

                                            var student_value = $("#student_name").val();
                                            var complement = $("#complement").prop("checked");

                                            suggest_students(class_selector.val());
                                            suggest_assign(class_selector.val(), student_value, complement)
                                        });
                                        var student = $("#student_name");
                                        student.blur(function () {
                                            var class_value = $("#class").val();
                                            var student_value = $("#student_name").val();
                                            var complement = $("#complement").prop("checked");

                                            suggest_assign(class_value, student_value, complement)
                                        })

                                    </script>
                                </select>
                                <label for="class"></label>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;width:20%;"><h3>Assignment: </h3></td>
                            <td>
                                <input type="text"
                                       id="assignment" name="assignment" placeholder="Quiz #1" onclick="select()"
                                       required/>
                                <script>
                                    var assignments = [];

                                    $("#assignment").autocomplete({
                                        delay: 0,
                                        source: assignments
                                    });

                                    var suggest_assign = function (the_class, student, is_complement) {
                                        assignments.length = 0;
                                        $.get("eval_helper/echo_all_assign.php?class=" + the_class, function (data) {
                                            var x = data.split("&*&*");
                                            x.shift();
                                            x.pop();

                                            if (is_complement) {
                                                $.get("eval_php/assign_complete.php?student=" + student + "&class=" + the_class, function (data) {
                                                    //document.write(data);
                                                    var explode = data.split("&*&*");
                                                    explode.shift();
                                                    explode.pop();
                                                    var ops = setOps;

                                                    var complement = ops.complement(x, explode);

                                                    for (var i = 0; i < complement.length; i++) {
                                                        assignments.push(complement[i]);
                                                    }

                                                })
                                            } else {
                                                for (var i = 0; i < x.length; i++) {
                                                    assignments.push(x[i]);
                                                }
                                            }
                                        });
                                    };

                                </script>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <input id="complement" type="checkbox" checked/>
                    <label for="complement">Only suggest unevaluated assignments</label>

                    <script>
                        $("#complement").change(function () {
                            var class_value = $("#class").val();
                            var student_value = $("#student_name").val();
                            var complement = $("#complement").prop("checked");

                            suggest_assign(class_value, student_value, complement)
                        })
                    </script>

                    <table>

                        <thead>
                        <h2>Written Communication</h2>
                        </thead>

                        <tr>
                            <td style="vertical-align:middle;width:20%;"><h3><u>Criteria</u></h3></td>
                            <td style="vertical-align:middle;width:20%;"><h3>Unsatisfactory</h3></td>
                            <td style="vertical-align:middle;width:20%;"><h3>Basic</h3></td>
                            <td style="vertical-align:middle;width:20%;"><h3>Proficient</h3></td>
                            <td style="vertical-align:middle;width:20%;"><h3>Advanced</h3></td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;width:20%;"><h3>Citations</h3></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="citation_2"
                                                                                name="citation" value="3" required>
                                <label for="citation_2">3</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="citation_3"
                                                                                name="citation" value="4">
                                <label for="citation_3">4</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="citation_4"
                                                                                name="citation" value="5">
                                <label for="citation_4">5</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="citation_5"
                                                                                name="citation" value="6">
                                <label for="citation_5">6</label></td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;width:20%;"><h3>Analysis</h3></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="analyisis_2"
                                                                                name="analysis" value="3" required>
                                <label for="analyisis_2">3</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="analyisis_3"
                                                                                name="analysis" value="4">
                                <label for="analyisis_3">4</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="analyisis_4"
                                                                                name="analysis" value="5">
                                <label for="analyisis_4">5</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="analyisis_5"
                                                                                name="analysis" value="6">
                                <label for="analyisis_5">6</label></td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;width:20%;"><h3>Thesis Statement</h3></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="thesis_2" name="thesis"
                                                                                value="3" required>
                                <label for="thesis_2">3</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="thesis_3" name="thesis"
                                                                                value="4">
                                <label for="thesis_3">4</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="thesis_4" name="thesis"
                                                                                value="5">
                                <label for="thesis_4">5</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="thesis_5" name="thesis"
                                                                                value="6">
                                <label for="thesis_5">6</label></td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;width:20%;"><h3>Topic Sentence</h3></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="topic_2" name="topic"
                                                                                value="3" required>
                                <label for="topic_2">3</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="topic_3" name="topic"
                                                                                value="4">
                                <label for="topic_3">4</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="topic_4" name="topic"
                                                                                value="5">
                                <label for="topic_4">5</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="topic_5" name="topic"
                                                                                value="6">
                                <label for="topic_5">6</label></td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;width:20%;"><h3>Writing Mechanics</h3></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="written_2"
                                                                                name="written" value="3" required>
                                <label for="written_2">3</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="written_3"
                                                                                name="written" value="4">
                                <label for="written_3">4</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="written_4"
                                                                                name="written" value="5">
                                <label for="written_4">5</label></td>
                            <td style="vertical-align:middle;width:20%;"><input type="radio" id="written_5"
                                                                                name="written" value="6">
                                <label for="written_5">6</label></td>
                        </tr>
                    </table>

                    <table style="align-items: center;">
                        <thead>
                        <h2>Writing Mechanics</h2>
                        </thead>

                        <tr>
                            <td>
                                <input type="checkbox" id="agreements" name="agreements">
                                <label for="agreements">Agreements</label>
                            </td>
                            <td>
                                <input type="checkbox" id="commas" name="commas">
                                <label for="commas">Commas</label>
                            </td>
                            <td>
                                <input type="checkbox" id="fragments" name="fragments">
                                <label for="fragments">Fragments</label>
                            </td>
                            <td>
                                <input type="checkbox" id="misplaced" name="misplaced">
                                <label for="misplaced">Misplaced Modifiers</label>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="checkbox" id="apostrophes" name="apostrophes">
                                <label for="apostrophes">Apostrophes</label>
                            </td>
                            <td>
                                <input type="checkbox" id="duplicate" name="duplicate">
                                <label for="duplicate">Duplicate Subjects</label>
                            </td>
                            <td>
                                <input type="checkbox" id="hypotheticals" name="hypotheticals">
                                <label for="hypotheticals">Hypotheticals</label>
                            </td>
                            <td>
                                <input type="checkbox" id="run_on" name="run_on">
                                <label for="run_on">Run-on Sentences</label>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="checkbox" id="capitalization" name="capitalization">
                                <label for="capitalization">Capitalization</label>
                            </td>
                            <td>
                                <input type="checkbox" id="formatting" name="formatting">
                                <label for="formatting">Formatting</label>
                            </td>
                            <td>
                                <input type="checkbox" id="pronouns" name="pronouns">
                                <label for="pronouns">Personal Pronouns</label>
                            </td>
                            <td>
                                <input type="checkbox" id="verb" name="verb">
                                <label for="verb">Shifting Verb Tense</label>
                            </td>
                        </tr>

                        <tr>

                            <td colspan="4" style="text-align: center">
                                <input type="checkbox" id="spelling" name="spelling">
                                <label for="spelling">Spelling / Word Choice</label>
                            </td>
                        </tr>
                    </table>


                </div>

                <input type="submit" value="Submit">

            </form>

            <script>
                function is_checked(id) {
                    return $("#" + id).prop('checked') ? 1 : 0;
                }

                function get_button(id) {
                    return {name: id, value: is_checked(id)}
                }

                function push_all(data) {

                    var x = document.forms[0].elements;
                    var names = [];
                    for (var i = 18; i < x.length; i++) {
                        names.push(x[i].name);
                    }
                    //document.write(names);

                    for (var k = 0; k < names.length; k++) {
                        data.push(get_button(names[k]))
                    }
                }

                function delete_recent() {
                    $.post("students_php/delete_recent.php", function (data) {
                        update_table();
                        document.getElementById("name_student").innerHTML = "";
                        document.getElementById("name_class").innerHTML = "";
                    });
                }

                function after_submit() {
                    //$("input:checkbox").prop('checked', false);
                    var x = document.forms[0].elements;
                    var names = [];
                    var student = $("#student_name");

                    var class_value = $("#class").val();
                    var student_value = student.val();
                    var assignment_val = $("#assignment").val();

                    var complement = $("#complement").prop("checked");

                    suggest_assign(class_value, student_value, complement);

                    for (var i = 24; i < x.length - 1; i++) {
                        var checkbox_id = x[i].id;
                        $("#" + checkbox_id).prop('checked', false);
                    }
                    $("html, body").animate({scrollTop: 0}, "slow");

                    recently_added(student_value, class_value, assignment_val);

                    student.val("");
                }

                function validate() {
                    var class_val = $("#class").val();
                    var student_val = $("#student_name").val();
                    var assignment_val = $("#assignment").val();

                    var stud_ex;
                    var ass_ex;

                    $.get("students_php/echo_students.php", function (data) {
                        var check = "(" + student_val.trim() + " : " + class_val + ")";
                        stud_ex = data.indexOf(check) >= 0;

                        //var old_get = "assignment_php/echo_assignments.php?class="+class_val;
                        $.get("eval_helper/echo_all_assign.php?class=" + class_val, function (data) {
                            ass_ex = data.indexOf("&*&*" + assignment_val) >= 0;

                            if (!(ass_ex && stud_ex)) {
                                $("html, body").animate({scrollTop: 0}, "slow");
                                var x = ass_ex ? student_val : assignment_val;
                                if (ass_ex == stud_ex) {
                                    swal({
                                        title: "ERROR",
                                        text: "<span style='color:#ff9500'>\'" + assignment_val + "\' and \'" + student_val +
                                        "\' does not exist in the database</span>",
                                        html: true
                                    }, function () {
                                        $("html, body").animate({scrollTop: 0}, "slow");
                                    });
                                }
                                else {
                                    swal({
                                        title: "ERROR",
                                        text: "<span style='color:#ff9500'>\'" + x + "\' does not exist in the database</span>",
                                        html: true
                                    }, function () {
                                        $("html, body").animate({scrollTop: 0}, "slow");
                                    })
                                }
                            }
                            else {
                                swal({
                                    title: "<span style='color: #9b74ff'>SUCCESS</span>",
                                    text: "Add " + student_val + "\'s evaluation for \'" + assignment_val +
                                    "?",
                                    html: true,
                                    showCancelButton: true
                                }, function () {
                                    push_data();
                                });


                            }
                        });
                    });

                }

                function push_data() {
                    var form = $("#eval_form").serializeArray();
                    form.push({name: 'top', value: form[6].value});
                    form.push({name: 'write', value: form[7].value});

                    push_all(form);

                    $.post("eval_php/push_data.php", form, function (data) {
                        //document.write(data);
                        $("html, body").animate({scrollTop: 0}, "slow");
                        after_submit()
                    });
                }

                function update_table() {
                    $.get("students_php/show_students.php", function (data) {
                        document.getElementById("students_table").innerHTML = data;
                    });
                }

                function delete_row(row) {
                    $.get("students_php/delete_student.php?row=" + row, function () {
                        update_table();
                    });
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
                    }, function () {
                        $.post("students_php/delete_all.php", function () {
                            update_table();
                            swal("Deleted!", "You asked for it.", "success");
                        });
                    });
                }

                function delete_group(class_name) {
                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to undo this!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, clear it!",
                        closeOnConfirm: false
                    }, function () {
                        $.post("students_php/delete_group.php?class_name=" + class_name, function (data) {
                            update_table();
                            swal("Deleted!", "You asked for it.", "success");
                        });
                    });
                }

                $(document).ready(function () {
                    $("#eval_form").submit(function (e) {
                        e.preventDefault();
                        /*var student = $("#student_name");
                         document.getElementById("name_student").innerHTML = student.val();
                         document.getElementById("name_class").innerHTML =
                         "<span style='color: #768b95'> from </span>"
                         + $("#class").val();*/
                        //validate();
                        already_exist();
                        //student.val("");
                    });
                });

                function already_exist() {
                    $.get("eval_php/echo_entries.php", function (data) {
                        //document.write(data);
                        var class_val = $("#class").val();
                        var student_val = $("#student_name").val();
                        var assignment_val = $("#assignment").val();

                        var search = "(" + student_val + " : " + class_val + " : " + assignment_val + ")";
                        var in_data = data.indexOf(search) >= 0;
                        if (in_data) {
                            swal({
                                    title: "Duplicate Entry",
                                    text: student_val + "\'s evaluation for \'" + assignment_val + "\' already exists",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Overwrite it!",
                                    closeOnConfirm: false
                                },
                                function () {
                                    var form = [];
                                    form.push({name: "student", value: student_val});
                                    form.push({name: "class", value: class_val});
                                    form.push({name: "assignment", value: assignment_val});

                                    $.post("eval_php/delete_entry.php", form, function () {
                                        swal("Success!", student_val + "'s evaluation for " + assignment_val + " overwritten", "success");
                                        push_data();
                                        //$("html, body").animate({ scrollTop: 0 }, "slow");
                                        //after_submit()
                                    });

                                });
                        } else {
                            validate()
                        }
                    });
                }

            </script>

            <table id="students_table">
                <script>
                    update_table();
                </script>
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
<!--[if lte IE 8]>
<script src="assets/js/ie/respond.min.js"></script><![endif]-->
<script src="assets/js/main.js"></script>

</body>
<iframe name="hiddenFrame" width="0" height="0" style="display: none;"></iframe>
</html>