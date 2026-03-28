<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
    background-image: url('images/doctor2.jpeg');
    background-position:right;
    background-repeat: no-repeat;
    background-size: cover; 
    height: 100vh; 
    display: flex;
    align-items: center;
    justify-content: center;
}


.container {
    max-width: 600px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transform: translateX(-400px);
}

        h1 {
            color: #1DA1F2;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control, .btn {
            height: 50px;
            font-size: 16px;
        }
        .btn-primary {
            background-color: #1DA1F2;
            width: 100%; 
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center; 
        }
        .btn-primary:hover {
            background-color: #007ACC;
            border-color: #007ACC;
        }
        .form-label {
            font-weight: 500;
        }
    
        .btn-info{
            background-color: #1DA1F2;
            width: 100%; 
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center; 
                color: white; 


            } .btn-info:hover {
            background-color:rgba(61, 166, 246, 0.45);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Patient</h1>
        <form action="addPatient_logic.php" method="POST" class="mt-4">
            <div class="mb-3">
                <input type="text" name="name" placeholder="Enter Patient Name" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="email" name="email" placeholder="Enter Patient Email" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Enter Password" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="number" name="age" placeholder="Enter Age" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="text" name="problem" placeholder="Enter Problem" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="date" name="intranceDate" placeholder="Enter Entrance Date" lang="en" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" name="phonenumber" placeholder="Enter Phone Number" class="form-control" >
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="Male" id="male" >
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="Female" id="female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" value="Add Patient" name="add_patient" class="btn btn-primary w-100">
            </div>

        </form>
        <a href="dashboardUi.php" class="btn btn-info">
    <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
</a>
    </div>
</body>
</html>
