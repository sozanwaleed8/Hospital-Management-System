<?php
//بنشغل الجلسة
session_start();
////لربط الكود بقاعدة البيانات.
include "connection.php";
//هنا بيشوف اذا في اي دي جاي من الفورم
if (isset($_GET['id'])) {
    //بيروح بياخد هاده الاي دي وبخزنو في متغير
    $drug_id = $_GET['id'];
    //بعدين بيروح بجيب كل بيانات الدرج من جدول الدرج بناء على الاي دي تاعو
    $sql = "SELECT * FROM drugs WHERE id = ?";
    //هنا بنجهز الاستعلام عشان نشغلو
    $stmt = $con->prepare($sql);
    //بيربط المتغير الدرج اي دي بالاستعلام.
    $stmt->bind_param("i", $drug_id);
    //بيشغل الاستعلام على قاعدة البيانات.
    $stmt->execute();
    //بياخد النتيجة الناتجة عن الاستعلام.
    $result = $stmt->get_result();

    //بيتأكد إذا فيه بيانات للدواء في النتيجة (يعني عدد الصفوف أكبر من صفر).
    if ($result->num_rows > 0) {
        //بياخد أول صف من النتيجةوبيخزن بياناته في متغير  كمصفوفة.
        $drug = $result->fetch_assoc();
    } else {
        //لو ما فيه صفوف، بيعرض رسالة الدواء مش موجود

        die("drug not found.");
    }
} else {
    die("Invalid request.");
}
   //بياخد بيانات الدواء اللي جابها من قاعدة البيانات وبيحطها في متغيرات 
$name=$drug['name'];
$dosage=$drug['dosage'];
$proDate=$drug['productionDate'];
$expDate=$drug['expiryDate'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Drug</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
            body {
                margin: 0;
                padding: 0;
                font-family: 'Poppins', sans-serif;
                background-image: url('images/ud.webp'); 
                background-size: cover;
                background-position: left;
                background-repeat: no-repeat;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container {
                max-width: 500px;
                background: rgba(255, 255, 255, 0.95);
                padding: 40px;
                border-radius: 15px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                margin-left: 100px; 

            }
            h1 {
                color:rgb(221, 120, 125);
                font-weight: 600;
                text-align: center;
                margin-bottom: 20px;
            }
            .form-control {
                height: 45px;
                font-size: 16px;
            }
            .btn-primary {
                background-color:rgb(221, 120, 125);
            width: 100%; 
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center; 
    border-color:white;
            }
            .btn-primary:hover {
                background-color:rgb(196, 60, 85);
                border-color:white;

            }
            ::placeholder {
                color: #999;
                font-size: 14px;
            }
            
                .mt-3 {
                    background-color:rgb(221, 120, 125);
            width: 100%; 
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center; 
    border-color:white;
    color:white;

}.mt-3:hover {
    background-color:rgb(196, 60, 85);
    border-color:white;
    color:white;


}
            
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Update Drug</h1>
            <form action="updateDrug_logic.php" method="POST" class="mt-4">
            <input type="hidden" name="drug_id" value="<?php echo $drug['id']; ?>">
            <div class="mb-3">
                    <input type="text" name="new_drug_name" placeholder="Enter Drug Name" value="<?php echo $name; ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="number" name="new_dosage" placeholder="Enter Dosage" value="<?php echo $dosage; ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="date" name="new_productionDate" placeholder="Enter Production Date" value="<?php echo $proDate; ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="date" name="new_expiryDate" placeholder="Enter Expiry Date" value="<?php echo $expDate; ?>" class="form-control">
                </div>
                <button type="submit" name="update_drug" class="btn btn-primary w-100">Update Drug</button>
            </form>
            <a href="dashboardUi.php" class="btn btn-info mt-3">
    <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
</a>
        </div>
    </body>
</html>
