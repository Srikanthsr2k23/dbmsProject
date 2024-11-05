<?php
// Your database connection code using mysqli
$host = "localhost";
$user = "root";
$password = "";
$database = "assignment";

$con = mysqli_connect($host, $user, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Code for deleting a record
$msg = "";
$opr = "";
if (isset($_GET['opr'])) {
    $opr = $_GET['opr'];
}

if (isset($_GET['rs_id'])) {
    $id = $_GET['rs_id'];
}

if ($opr == "del") {
    $del_sql = mysqli_query($con, "DELETE FROM stu_tbl WHERE stu_id=$id");

    if ($del_sql) {
        $msg = "<div style='background-color: white;padding: 20px;border: 1px solid black;margin-bottom: 25px;'>"
            . "<span class='p_font'>"
            . "1 Record Deleted... !"
            . "</span>"
            . "</div>";
    } else {
        $msg = "Could not Delete :" . mysqli_error($con);
    }
}

echo $msg;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/style_view.css" />
</head>

<body>
    <div class="btn_pos">
        <form method="post">
            <input type="text" name="searchtxt" class="input_box_pos form-control" placeholder="Search name.." />
            <div class="btn_pos_search">
                <input type="submit" class="btn btn-primary btn-large" name="btnsearch" value="Search" />&nbsp;&nbsp;
                <a href="?tag=student_entry"><input type="button" class="btn btn-large btn-primary" value="Register new" name="butAdd" /></a>
            </div>
        </form>
    </div><br><br>

    <div class="table_margin">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">No.</th>
                    <th style="text-align: center;">Student Name</th>
                    <th style="text-align: center;">Gender</th>
                    <th style="text-align: center;">Date of Birth</th>
                    <th style="text-align: center;">Place of Birth</th>
                    <th style="text-align: center;">Address</th>
                    <th style="text-align: center;">Phone</th>
                    <th style="text-align: center;">E-mail</th>
                    <th style="text-align: center;">Note</th>
                    <th style="text-align: center;" colspan="2">Operation</th>
                </tr>
            </thead>

            <?php
            $key = "";
            if (isset($_POST['searchtxt'])) {
                $key = $_POST['searchtxt'];
            }

            if ($key != "") {
                $sql_sel = mysqli_query($con, "SELECT * FROM stu_tbl WHERE f_name  like '%$key%' or l_name like '%$key%'");
            } else {
                $sql_sel = mysqli_query($con, "SELECT * FROM stu_tbl");
            }

            $i = 0;
            while ($row = mysqli_fetch_array($sql_sel)) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['f_name'] . "    " . $row['l_name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['pob']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['note']; ?></td>
                    <td><a href="?tag=student_entry&opr=upd&rs_id=<?php echo $row['stu_id']; ?>" title="Update"><img style="-webkit-box-shadow: 0px 0px 0px 0px rgba(50, 50, 50, 0.75);-moz-box-shadow: 0px 0px 0px 0px rgba(50, 50, 50, 0.75);box-shadow: 0px 0px 0px 0px rgba(50, 50, 50, 0.75);" src="picture/update.png" height="20" alt="Update" /></a></td>
                    <td><a href="?tag=view_students&opr=del&rs_id=<?php echo $row['stu_id']; ?>" title="Delete"><img style="-webkit-box-shadow: 0px 0px 0px 0px rgba(50, 50, 50, 0.75);-moz-box-shadow: 0px 0px 0px 0px rgba(50, 50, 50, 0.75);box-shadow: 0px 0px 0px 0px rgba(50, 50, 50, 0.75);" src="picture/delete.jpg" height="20" alt="Delete" /></a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
