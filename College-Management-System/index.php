<?php
    session_start();

    require("conection/connect.php");

    $msg = "";

    if (isset($_POST['btn_log'])) {
        $uname = $_POST['unametxt'];
        $pwd = $_POST['pwdtxt'];

        // Using mysqli and prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($con, "SELECT * FROM users_tbl WHERE username=? AND password=?");
        mysqli_stmt_bind_param($stmt, "ss", $uname, $pwd);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $row = mysqli_fetch_array($result);

            if ($row['type'] == 'admin') {
                $msg = "Login successful!...";
            } else {
                header("location: everyone.php");
            }
        } else {
            $msg = "Invalid login authentication, try again!";
        }

        mysqli_close($con);
    }
?>

<!-- Your HTML code remains unchanged -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css.map"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css"/>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/login1.css" />
<title>Jyothy Institute of Technology | College management System.</title>
</head>

<body>
	<div class="container">
    	<div class="container2">
    		<div class="h1_pos">
    			<h1  style="text-align: center; font-weight: 900">Only staff members. </h1>
    		</div><br><br><br>
    		<form method="post">
                    <input type="text" class="form-control" name="unametxt" placeholder="Username" title="Enter username here" /><br>
                    <input type="password" class="form-control" name="pwdtxt" placeholder="Password" title="Enter username here" /><br>
    		<input type="submit" href="#" class="btn btn-default" name="btn_log" value="Sign in" style="float: right;"/>
    		<div class="about_pos">
                    <a href="AboutManagement.php" style="text-decoration:none; color:Red; font-size: 15px">About management</a>
    		</div>
    		</form>
    	</div>
    </div>
	
        <h2 style="color: #3a28a5; text-align: center;">
            <?php echo $msg; ?>
        </h2>  
        <!DOCTYPE html>
<html>
<head>
    <title>Like Button</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <button id="smileButton">LIKES</button>

    <script>
    $(document).ready(function() {
        $('#smileButton').click(function() {
            $.ajax({
                url: 'increase_likes.php',
                type: 'POST',
                success: function(response) {
                    alert('Like count increased!');
                },
                error: function(xhr, status, error) {
                    alert('Error occurred while increasing like count.');
                }
            });
        });
    });
    </script>
</body>
</html>  
</body>
</html>