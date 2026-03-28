<?php
//بنبدأ الجلسة عشان نقدر نستخدم بيانات تسجيل الدخول للمستخدم.
session_start();
//لربط الكود بقاعدة البيانات.
include "connection.php";
//بنجيب رقم المستخدم  اللي عامل تسجيل دخول من الـسيشين
$doctor_actor_id = $_SESSION["authUser"]["id"];
//بنجهز استعلام عشان نجيب رقم الدكتور من جدول الدكتور بناءً على رقم المستخدم اكتور اي دي
$doctorQuery = "SELECT id FROM doctors WHERE actor_id = ?";
//هنا بنحضر الكويري تعت الدكتور
$stmt = $con->prepare($doctorQuery);
//بنربط المتغير  مع الاستعلام
$stmt->bind_param("i", $doctor_actor_id);
$stmt->execute();
//هنا بنجيب نتيجة الاستعلام
$doctorResult = $stmt->get_result();
//هنا بنعمل لف على المصفوفة
$doctorData = $doctorResult->fetch_assoc();
//بنجيب من هادي المصفوفة الاي دي وبنخزنها بمتغير
$doctor_id = $doctorData['id'];
//سيقوم هذا الاستعلام بإرجاع قائمة المرضى (رقمهم واسـمهم) المرتبطين بالدكتور الذي يمتلك رقم 
//الذي سيتم تمريره لاحقًا.doctor_id
$patientQuery = "SELECT p.id, p.name FROM patients p 
                 INNER JOIN patientdoctor pd ON p.id = pd.patient_id
                 WHERE pd.doctor_id = ?";
                 //وهنا بنحضر هذا الاستعلام تع المريض 
$stmt = $con->prepare($patientQuery);
//هان بنربط رقم الدكتور في الاستعلام
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$patientResult = $stmt->get_result();
//هنا بنروح نجيب الاي دي من جدول الدرج وبنحطه بمتغير
$drugQuery = "SELECT id, name FROM drugs";
//هان بنجيب نتيجة الكويري
$drugResult = $con->query($drugQuery);
//اذا ضغطنا على زر الاساين 
if (isset($_POST['assign'])) {
    //بنروح بنخزن اقيمة الي اخترناها من البيشنت  في متغير
    $selected_patient = $_POST['patient'];
    //وهنا ايضا القيمة اللي اخترناها من الدرج بنخزنها في متغير
    $selected_drug = $_POST['drug'];
   //هنا بنقوم باضافة البيشنت اي دي والدرج اي دي للجدول الوسيط يعني كل مريض ايش الو دوا
    $assignQuery = "INSERT INTO patientdrug (patient_id, drug_id) VALUES (?, ?)";
    //هنا بنجهز الكويري
    $stmt = $con->prepare($assignQuery);
    //وهان بنعمل ربط بين رقم المريض ورقم المريض
    $stmt->bind_param("ii", $selected_patient, $selected_drug);
   //اذا تنفذ هاده الاستعلام
    if ($stmt->execute()) {
        //بيطلع مسج نجاح انه نجحت عملية اسناد الدوا للمريض
        $success_message = "Drug assigned successfully.";
        //وبعديها بيروح على صفحة الفيو لما نعمل اساين
        header("Location:viewPatients.php");


    } else {
        $error_message = "Error assigning drug: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Assign Drug</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/addA.webp');
            background-size: cover;
            background-position: right;
            background-repeat: no-repeat;
            height: 99vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .container {
            max-width: 550px;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            margin-left: 50px;
            margin-bottom: -150px;


        }
        h1 {
            color:rgb(8, 50, 157);
            font-weight: bold;
        }
        .btn-success {
            width: 100%; 
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center;
    background-color:rgb(3, 5, 116);

        }
        .btn-success:hover {
            background-color:rgb(2, 32, 52);
        }
        .form-select {
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .btn-info{
            width: 100%; 
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center; 
    background-color:rgb(3, 5, 116);
    color:rgb(253, 254, 255);


            } .btn-info:hover {
            background-color:rgba(9, 41, 135, 0.95);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Assign Drug to Patient</h1>

        <?php 
        // إذا فيه رسالة نجاح متوفرة بيعرضها 
        if (isset($success_message)): ?>
            <div class="alert alert-success text-center"> <?php echo $success_message; ?> </div>
        <?php endif; ?>

        <?php 
        // إذا فيه رسالة خطأ، بيعرضها 
        if (isset($error_message)): ?>
            <div class="alert alert-danger text-center"> <?php echo $error_message; ?> </div>
        <?php endif; ?>

        <form action="" method="POST" class="needs-validation" novalidate>
            <div class="mb-4">
                <label for="patient" class="form-label">Select Patient</label>
                <select name="patient" id="patient" class="form-select" required>
                    <option value="">Select Patient </option>
                    
                    <?php
                    //هذا المتغير بيحتوي على بيانات المرضى اللي تم جلبها من قاعدة البيانات وكل خيار بيظهر اسم المريض للمستخدم ويخزن رقم المريض عند الإرسال.
                    while ($row = $patientResult->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="drug" class="form-label">Select Drug</label>
                <select name="drug" id="drug" class="form-select" required>
                    <option value=""> Select Drug </option>
                    <?php
                    //هذا المتغير بيحتوي على بيانات الدواء اللي تم جلبها من قاعدة البيانات وكل خيار بيظهر اسم الدواء  ويخزن رقم الدواء عند الإرسال.

                    while ($row = $drugResult->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" name="assign" class="btn btn-success w-100">Add Assign Drug</button>
</form>

<a href="dashboardUi.php" class="btn btn-info mt-3">
    <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
</a>

    </div>
</body>
</html>
