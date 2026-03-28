<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>
   <style>
      body {
         margin: 0;
         padding: 0;
         font-family: 'Poppins', sans-serif;
         background-image: url('images/login.webp');
         background-size: cover;
         background-position: center;
         height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
      }
      .container {
         width: 300px;
         background: white;
         padding: 40px;
         border-radius: 10px;
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
         margin-top:200px;
      }
      .container header {
         font-size: 24px;
         font-weight: bold;
         text-align: center;
         margin-bottom: 20px;
         color:rgba(119, 118, 68, 0.94);
      }
      .input-field {
         margin-bottom: 20px;
      }
      .input-field input {
         width: 100%;
         padding: 10px;
         font-size: 14px;
         border: 1px solid #ddd;
         border-radius: 5px;
         outline: none;
      }
      .button button {
         width: 100%;
         padding: 10px;
         background: rgba(119, 118, 68, 0.94);
         border: none;
         color: white;
         font-size: 16px;
         border-radius: 5px;
         cursor: pointer;
      }
      .button button:hover {
         background:rgb(120, 116, 55);
      }
      .signup, .back {
         text-align: center;
         margin-top: 10px;
         font-size: 14px;
      }
      .signup a, .back a {
         color:rgba(144, 143, 89, 0.94);
         text-decoration: none;
         font-weight: bold;
      }
      .back a {
         display: inline-block;
         margin-top: 10px;
         background:rgba(179, 177, 116, 0.94);
         color: white;
         padding: 10px 20px;
         border-radius: 5px;
         text-decoration: none;
         transition: background-color 0.3s ease;
      }
      .back a:hover {
         background:rgb(172, 181, 3);
      }
   </style>
</head>
<body>
   <div class="container">
      <header>Login</header>
      <?php 
      if (isset($_GET["statusCode"]) && $_GET["statusCode"] == 201) {
         echo "<div style='color: green; text-align: center;'>Account Created Successfully</div>";
      }
      ?>
      <form action="login_logic.php" method="POST">
         <div class="input-field">
            <input type="email" name="email" placeholder="Enter Email" >
         </div>
         <div class="input-field">
            <input type="password" name="password" placeholder="Enter Password" >
         </div>
         <div class="button">
            <button type="submit" name="login">LOGIN</button>
         </div>
      </form>
      <div class="signup">
         Not a member? <a href="register.php">Sign up now</a>
      </div>
      <div class="back">
         <a href="index.html">Back</a>
      </div>
   </div>
</body>
</html>
