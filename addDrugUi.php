<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Drug</title>
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
            background-image: url('images/AddD.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 600px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            margin-left: 150px;
        }
        h1 {
            color:rgb(70, 210, 220);
            font-weight: bold;
            text-align: center;
        }
        .form-control, .btn {
            height: 45px;
            font-size: 16px;
        }
        .btn-primary {
            background-color:rgb(70, 210, 220);
            width: 100%; 
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center; 
    border-color:white;
        }
        .btn-primary:hover {
            background-color:rgb(12, 155, 168);
            border-color:white;

        }
        .btn-info{
            background-color:rgb(70, 210, 220);
            width: 100%; 
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center; 
                color: white; 
                border-color:white;


            } .btn-info:hover {
            background-color:rgb(12, 155, 168);
            color:white;
            }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Drug</h1>
        <form action="addDrug_logic.php" method="POST" class="mt-4">
            <div class="mb-3">
                <input type="text" name="name" placeholder="Enter Drug Name" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="number" name="dosage" placeholder="Enter Dosage" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="date" name="productionDate" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="date" name="expiryDate" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="submit" value="Add Drug" name="add_drug" class="btn btn-primary w-100">
            </div>
        </form>
        <a href="dashboardUi.php" class="btn btn-info">
    <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
</a>
    </div>
</body>
</html>
