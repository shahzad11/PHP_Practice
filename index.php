<?php

@session_start();

if($_SESSION['is_user_logged_in']!==1){
  header("Location:login.php");
}
$user_id  = $_SESSION['user_id'];


require_once("loader.php");

if(isset($_GET['action'])){
  $id = $_GET['id'];

  switch($_GET['action']){
    case "delete":
        mysqli_query($conn, "delete from users where id='$id'");
    break;
    case "edit":

        if(isset($_POST['first_name'])){

            $first_name     = $_POST['first_name'];
            $last_name      = $_POST['last_name'];
            $email_address  = $_POST['email_address'];
            $password       = $_POST['password'];

            mysqli_query($conn, "update users set first_name='$first_name', last_name='$last_name', email_address='$email_address', password='$password' where id='$id'");
        }
        $my_edit_query = mysqli_query($conn, "select * from users where id='$id'");
        $edit_res = mysqli_fetch_assoc($my_edit_query);
    break;
  }

}

$my_query = mysqli_query($conn, "select * from users order by id desc limit 10");

?>


<?php include_once("includes/top.php"); ?>

<form method="post" action="" enctype="multipart/form-data">

  Email Address
  <input type="text" name="email_address" value="<?php echo $edit_res['email_address']; ?>"/><br>

  Password
  <input type="text" name="password" value="<?php echo $edit_res['password']; ?>"/><br>

  First Name
  <input type="text" name="first_name" value="<?php echo $edit_res['first_name']; ?>"/><br>

  Last
  <input type="text" name="last_name" value="<?php echo $edit_res['last_name']; ?>"/><br>

<input type="submit" name="submit" value="EDIT Record"/>
</form>

<table border="1" cellpadding="10" cellspacing="0">
  <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Password</th>
      <th>Actions</th>
  </tr>

<?php while($res = mysqli_fetch_assoc($my_query)) { ?>
  <tr>
      <td><?php echo $res['first_name']; ?></td>
      <td><?php echo $res['last_name']; ?></td>
      <td><?php echo $res['password']; ?></td>
      <td>
        <a href="index.php?action=delete&id=<?php echo $res['id']; ?>">Delete</a> | <a href="index.php?action=edit&id=<?php echo $res['id']; ?>">Edit</a>
      </td>
  </tr>
<?php } ?>
</table>
