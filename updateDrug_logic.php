<?php
//هنا بنقوم بتشغيل الجلسة
session_start();
//لربط الكود بقاعدة البيانات.
include "connection.php";
//بيتأكد إذا المستخدم ضغط على الزر الي اسمه ابديت درج، يعني فيه بيانات جاية من الفورم.
if (isset($_POST['update_drug'])) {
    //بنجيب الاي دي يلي بالفورم دخلناه وبنخزن القيمه في متغير
    $drug_id = $_POST['drug_id']; 
    //وايضا النيم تبع الدوا يلي دخلناه بالفورم بنخزن قيمته في متغير
    $new_drug_name = $_POST['new_drug_name'];
    //وايضا الدوسيج تبع الدوا يلي دخلناه بالفورم بنخزن قيمته في متغير 
    $new_dosage = $_POST['new_dosage'];
    //وايضا البرودكشين ديت يلي دخلنا قيمته في الفورم بنجييب هادي القيمه بنخزنها في متغير
    $new_productionDate = $_POST['new_productionDate'];
    //وايضا الاكسبيري ديت يلي دخلنا قيمته بالفورم بنجيبها وبنخزنها في متغير
    $new_expiryDate = $_POST['new_expiryDate'];
    //هنا بنفحص لو كانت كل القيم مدخلة يعني مش فاضية حيروح على جدول الدوا يلي بالداتا بيز ويعمل ابديت للقيم يلي عملنالها ابديت بناء على اي دي الدوا
    if (!empty($drug_id) && !empty($new_drug_name) && !empty($new_dosage) && !empty($new_productionDate) && !empty($new_expiryDate)) {
        $sql = "UPDATE drugs 
                SET name = ?, dosage = ?, productionDate = ?, expiryDate = ? 
                WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sdssi", $new_drug_name, $new_dosage, $new_productionDate, $new_expiryDate, $drug_id);
      //اذا كان الاستعلام شغال 
        if ($stmt->execute()) {
            //يروح يعيد توجيه المستخدم لصفحة الفيو درج مع رسالة نجاح.
            header("Location: viewDrugs.php?updated=true");
        } else {
            echo "Error updating drug: " . $con->error;
        }
    } else {
        //لو فيه أي حقل ناقص، بيظهر رسالة للمستخدم إنه لازم يعبي كل الحقول.
        echo "All fields are required.";
    }
}
?>
