<header class="header">

   <div class="flex">

      <a href="admin-home.php" class="logo">SADEEN<span>ADMIN</span></a>

      <nav class="navbar">
         <a href="admin-home.php">Home</a>
         <a href="add-products.php">Products</a>
         <a href="admin-orders.php">Orders</a>
         <a href="admin-users.php">Users</a>
         <a href="admin-contacts.php">Messages</a>
      </nav>
      <div class="icons">
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Username :
            <span><?php echo $_SESSION['admin_name']; ?></span>
         </p>
         <p>Email :
            <span><?php echo $_SESSION['admin_email']; ?></span>
         </p>
         <a href="logout.php" class="delete-btn">Logout</a>
         <div>New <a href="login.php">Login</a> |
            <a href="login.php">Register</a>
         </div>
      </div>
   </div>
   <script>

      $(document).ready(function () {
         $("#user-btn").click(function () {
            $(".account-box").slideToggle(500);
         });
      });

   </script>
</header>