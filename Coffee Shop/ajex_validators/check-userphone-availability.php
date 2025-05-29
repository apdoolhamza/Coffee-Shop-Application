<?php 
require_once('../admin/components/config.php');

if(!empty($_POST["userphone"])) {
$result = mysqli_query($con,"SELECT count(*) FROM users WHERE userphone='" . $_POST["userphone"] . "'");
$row = mysqli_fetch_row($result);
if($row[0] > 0) {
    echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>User with this phone already exit!";
}
};
?>
