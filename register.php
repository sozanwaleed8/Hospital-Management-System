<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            background-image: url('images/re.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: 100%;
            max-width: 600px; 
            background: white;
            padding: 40px; 
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-left: 600px; 
        }
        h1 {
            color: rgb(115, 185, 229);
            font-weight: bold;
            text-align: center;
        }
        .form-control, .btn {
            height: 50px; 
            font-size: 18px; 
        }
        .btn-primary {
            background-color:rgb(115, 185, 229);
            border-color: #1DA1F2;
        }
        .btn-primary:hover {
            background-color: #007ACC;
            border-color: #007ACC;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #1DA1F2;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .back a {
         display: inline-block;
         margin-top: 10px;
         background:rgb(114, 195, 245);
         color: white;
         padding: 10px 20px;
         border-radius: 5px;
         text-decoration: none;
         transition: background-color 0.3s ease;
         margin-left: 230px; 

      }
      .back a:hover {
         background: #007acc;
      }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Account</h1>
        <form action="register_logic.php" method="POST" class="mt-4">
            <div class="mb-3">
                <input type="text" name="name" placeholder="Enter Name" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="email" name="email" placeholder="Enter Email" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Enter Password" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="text" name="phonenumber" placeholder="Enter Phone Number" class="form-control" >
            </div>
            <div class="mb-3">
                <label class="form-label d-block">Select Your Type:</label>
                <input type="radio" name="type" value="doctor" class="form-check-input" id="doctor" >
                <label for="doctor" class="form-check-label">Doctor</label>
                <input type="radio" name="type" value="pharmacist" class="form-check-input ms-3" id="pharmacist" >
                <label for="pharmacist" class="form-check-label">Pharmacist</label>
            </div>
            <div class="mb-3">
                <input type="submit" value="Create" name="create_account" class="btn btn-primary w-100">
            </div>
            <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
        </form>
        <div class="back">
         <a href="index.html">Back</a>
      </div>
    </div>
</body>
</html>
