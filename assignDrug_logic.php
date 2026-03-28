<?php
//هنا بنبدا الجلسة
session_start();
//لربط الكود بقاعدة البيانات.
include "connection.php";
//اذا كانت الميثود بوست اللي بالفورم
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //بتروح بتجيب البيشنت اي دي يلي دخلناها بالفورم هي بتكون مخفية يعني وبتخزنها بمتغير
    $patient_id = $_POST["patient_id"];
    //وهنا نفس الاشي بنجيب ال درج اي دي يلي خزناها بالفورم وكانت مخفية في متغير 
    $drug_id = $_POST["drug_id"];
    //هنا  بنجيب الاي دي من جدول البيشنت
    $checkPatientSql = "SELECT id FROM patients WHERE id = ?";
    //عشان نتأكد إذا المريض موجود ولا لأ في قاعدة البياناتSQL هان بنجهز استعلام .
    $stmt = $con->prepare($checkPatientSql);
    //  بنربط البيشنت اي دي مع الاستعلام عشان نتحقق من المريض المحدد
    $stmt->bind_param("i", $patient_id);
    //بننفذ الاستعلام اللي جهزناه عشان نتحقق إذا المريض موجود.
    $stmt->execute();
    //بنجيب نتيجة الاستعلام ونتأكد إذا فيه مريض بالـاي دي
    $patientResult = $stmt->get_result();
  //بنجهز استعلام جديد عشان نشوف إذا الدواء موجود في قاعدة البيانات.
    $checkDrugSql = "SELECT id FROM drugs WHERE id = ?";
    //SQL نفس الحركة اللي عملناها فوق، بنجهز استعلام الـ 
    $stmt = $con->prepare($checkDrugSql);
    //  مع الاستعلام$drug_idبنربط رقم الدواء 
    $stmt->bind_param("i", $drug_id);
    //بننفذ الاستعلام اللي يشيك إذا الدواء موجود.
    $stmt->execute();
    //بنجيب النتيجة ونشوف إذا فيه دواء برقم الادي دي
    $drugResult = $stmt->get_result();
    //هان بنشيك: إذا كان المريض والدواء موجودين، بنكمل.
    if ($patientResult->num_rows > 0 && $drugResult->num_rows > 0) {
        //هنا بنعمل اضافة على قاعدة البيانات على جدول الوسيط تع المريض والدوا وبيحط فيه رقم المريض ورقم الدوا يعني كل مريض شو الو ادوية وهيك
        $assignSql = "INSERT INTO patientdrug (patient_id, drug_id) VALUES (?, ?)";
        //   اللي هيضيف العلاقة بين المريض والدواء.SQLبنجهز استعلام الـ 
        $stmt = $con->prepare($assignSql);
        //بنربط المتغيرين: رقم المريض  ورقم الدواء مع الاستعلام.
        $stmt->bind_param("ii", $patient_id, $drug_id);
//إذا الاستعلام نفذ بنجاح (يعني أضفنا العلاقة).
        if ($stmt->execute()) {
           //assignDrug.php بنرجع المستخدم على صفحة 
            header("Location:assignDrug.php?success=true");
        } else {
            //هنا لو ما نجح الاضافة على الداتا بيز حيطلع ايرور
            echo "Error: " . $con->error;
        }
    } else {
        //غير كدة رقم المستحدم او رقم الدوا غير موجود
        echo "Invalid patient or drug.";
    }
}
?>
