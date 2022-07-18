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
    case "add":

        if(isset($_POST['description'])){

            $description      = $_POST['description'];
            $credit           = $_POST['credit'];
            $debit            = $_POST['debit'];
            $balance          = $_POST['credit']-$_POST['debit'];

            $add_query = mysqli_query($conn, "insert into ledger(user_id,description, credit, debit, balance)  values('$user_id','$description','$credit','$debit','$balance')");
            if($add_query){
                echo "record added successfully";
            }else{
                echo mysqli_error($conn);
            }
        }
        $my_edit_query = mysqli_query($conn, "select * from ledger where id='$id'");
        $edit_res = mysqli_fetch_assoc($my_edit_query);
    break;
  }

}

$my_query = mysqli_query($conn, "select * from ledger where user_id=$user_id order by id desc limit 10");

?>


<?php include_once("includes/top.php"); ?>

<p>&nbsp; </p>
<p>&nbsp; </p>
<p>&nbsp; </p>

<form method="post" action="?action=add" enctype="multipart/form-data">

  Transaction Description
  <input type="text" name="description" value=""/><br>

  Credit
  <input type="text" name="credit" value="0"/><br>

  Debit
  <input type="text" name="debit" value="0"/><br>



<input type="submit" name="submit" value="Add transaction"/>
</form>

<table border="1" cellpadding="10" cellspacing="0">
  <tr>
      <th>Description</th>
      <th>Credit</th>
      <th>Debit</th>
      <th>Balance</th>
  </tr>

<?php while($res = mysqli_fetch_assoc($my_query)) { ?>
  <tr>
      <td><?php echo $res['description']; ?></td>
      <td><?php echo $res['credit']; ?></td>
      <td><?php echo $res['debit']; ?></td>
      <td><?php echo $res['balance']; ?></a>
      </td>
  </tr>
<?php } ?>
</table>
