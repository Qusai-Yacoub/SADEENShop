<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") ;
   header('location:admin-contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <style>
      <?php include 'assets/css-admin/admin_style.css'; ?>
   </style>
   <style>
      <?php include 'assets/css-admin/style.css'; ?>
   </style>
<script src="jquery-3.4.1.min.js"></script>


</head>
<body>
   
<?php include 'admin-header.php'; ?>

<section class="messages">

   <h1 class="title"> Messages </h1>

   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
   <div class="box">
      <p> User Id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
      <p> Name : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> Number : <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> Message : <span><?php echo $fetch_message['message']; ?></span> </p>
      <a href="admin-contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Delete This Message?');" class="delete-btn">Delete Message</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">You Have No Messages!</p>';
   }
   ?>
   </div>

</section>
</body>
</html>