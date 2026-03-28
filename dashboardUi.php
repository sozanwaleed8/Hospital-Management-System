<?php
session_start();
//هنا لو ما كان المستخدم يلي عامل تسجيل دخول مخزن بياناتو في السيشن
if(isset($_SESSION["authUser"]) != true){
    //بيضل بصفحة اللوج ان
    header("Location:login.php");
} 
//بنخزن  اسم المستحدم اللي عمل تسجيل دخول اللي كان مخزن في السيشن في متغير 
$name = $_SESSION["authUser"]["name"];
//نفس الاشي بنخزن التايب تاعه المخزن في السيشن في متغير
$type = $_SESSION["authUser"]["type"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .container {
            width: 100%;
            max-width: 1000px;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 180px; 



        }

        h1 {
            color:rgb(0, 0, 0);
            font-weight: bold;
            text-align: center;
        }

        .btn {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: bold;
            white-space: nowrap;


}


        .btn-success {
            background-color:rgb(39, 105, 197);

        }

        .btn-success:hover {
            background-color:rgb(20, 85, 159);
        }

        .btn-info {
            background-color:rgb(97, 94, 94);
            color:rgb(255, 255, 255);
        }

        .btn-info:hover {
            background-color:rgb(61, 63, 63);
            color:white;
        }

        .btn-danger {
            background-color:rgb(95, 1, 9);
        }

        .btn-danger:hover {
            background-color:rgb(160, 80, 68);
        }

        .d-flex {
            gap: 15px;
        }

        form {
            margin-top: 20px;
        }
        .btn-assign-drug {
        background-color:rgb(1, 18, 100);
        border: none;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-assign-drug:hover {
        background-color:rgb(7, 1, 82);
        color: white;
    }
    .btn-delete-assign-drug{
        background-color:rgb(174, 13, 13);
        border: none;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    } .btn-delete-assign-drug:hover {
        background-color:rgb(215, 121, 121);
        color: white;
    }

        <?php
        //هان كنت افحص انه المستخدم يلي عمل تسجيل دخول كان نوعه دكتور 
         if ($type == "doctor") { ?>
        body {
            background-image: url('images/dotor.webp');
            background-size:cover;
            background-repeat: no-repeat; 
            background-position: left center;
    }
    .container {
        max-width: 1000px; 
        background:  rgba(246, 246, 246, 0.9);  
        padding: 40px; 
        transform: translateY(100px); 
        margin-left: 350px; 


    }
        
        <?php } 
        //وكنت افحص انه المستخدم يلي مسجل دخول كان نوعه صيدلي
        else if ($type == "pharmacist") { ?>
        body {
            background-image: url('images/ph2.webp');
            background-size:cover;
            background-repeat: no-repeat; 
            background-position:  top;
    }
    .container {
        max-width: 1070px; 
        background: rgba(246, 246, 246, 0.9);  
        padding: 30px; 
        transform: translateX(100px); 
        transform: translateY(80px); 

    }
        
        <?php } 
        //واذا كان المتسخدم يلي عامل تسجيل دخول نوعه مريض
        else if ($type == "patient") { ?>
    body {
        background-image: url('images/dr5.webp');
        background-size:cover;
        background-repeat: no-repeat; 
        background-position: top;
    }
    .container {
        max-width: 1000px; 
        background: rgba(246, 246, 246, 0.9);  
        padding: 20px; 
        margin-left:400px; 
        margin-top:500px; 



    }
    .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    color: #fff;
    width: 120px; 
    padding: 10px 20px; 
    font-size: 16px; 
    border-radius: 6px; 
    transition: background-color 0.3s ease; 
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

<?php } ?>


    </style>
</head>
<body>
    <div class="container">
        <h1>Hello <span><?php echo $type; ?></span> <?php echo $name; ?>, Welcome to Dashboard</h1>
        <div class="d-flex justify-content-center gap-3">
    <?php
    //هنا بفحص انه المستخدم يلي عامل تسجيل دخول نوعه دكتور حيدخل على الواجهة الخاصة بالدكتور وخيعرض الازرار الخاصة بالدكتور 
     if($type == "doctor") { ?>
        <a href="addPatientUi.php" class="btn btn-success">Add Patient</a>
        <a href="viewPatients.php" class="btn btn-info">View Patients</a>
        <a href="assignDrug.php" class="btn btn-assign-drug">Add Assign Drug</a>
        <a href="deleteAssignedDrug.php" class="btn btn-delete-assign-drug">Delete Assign Drug</a>
    <?php } 
    //هنا بفحص انه الستحدم يلي عامل تسجيل دخول نوعه صيدلي حيعرضلو الواجهة الخاصة فيه والازرار الخاصة فيه
    else if($type == "pharmacist") { ?>
        <a href="addDrugUi.php" class="btn btn-success">Add Drug</a>
        <a href="viewDrugs.php" class="btn btn-info">View Drugs</a>
    <?php }
    //ولو كان المستخدم يلي عامل تسجيل دخول نوعه مريض حيعرضلو الواجهة الخاصة فيه والازرار الخاصة فيه
    else if($type == "patient") { ?>
        <a href="viewPatients.php" class="btn btn-info">View Patients</a>
    <?php } ?>
    
    <form action="logout.php" method="POST" class="m-0">
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>

        </form>
    </div>
</body>
</html>
