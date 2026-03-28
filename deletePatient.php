<?php
//لربط الكود بقاعدة البيانات.
include "connection.php";
// يتم التأكد من وجود اي دي المريض في المتغير جيت
if (isset($_GET["id"])) {
    //إذا كان موجودًا، يتم تخزينه في المتغير 
    $id = $_GET["id"];
//هنا بجيب الاكتور اي دي من جدول البيشنت يلي كان مفتاح اجنبي بهاده الجدول لما يكون الاي دي يلي بالبيشنت المفتاح الاساسي يساوي الاي دي اللي بالصمفوفة جيت
    $fetchActorIdSql = "SELECT actor_id FROM patients WHERE id = $id";
    //يحتوي على نتيجة الاستعلام.
    $actorResult = $con->query($fetchActorIdSql);
    //إذا تم العثور على صف (المريض موجود)، يتم استخراج الاكتور اي دي المرتبط به.
    if ($actorResult->num_rows > 0) {
        $actorData = $actorResult->fetch_assoc();
        $actorId = $actorData["actor_id"];
        //يتم حذف كل العلاقات المرتبطة بالمريض في الجدول الوسيط 
        $deleteRelationSql = "DELETE FROM patientdoctor WHERE patient_id = $id";
        $relationResult = $con->query($deleteRelationSql);
  //إذا تم حذف العلاقات بنجاح، يتم حذف المريض من جدول البيشنت بناء على الاي دي 
        if ($relationResult == true) {
            $deletePatientSql = "DELETE FROM patients WHERE id = $id";
            $patientResult = $con->query($deletePatientSql);
// اذا تم حذف المريض بنجاح، يتم حذف الاكتورالمرتبط به من جدول الاكتور بناء على الاي دي
            if ($patientResult == true) {
                $deleteActorSql = "DELETE FROM actors WHERE id = $actorId";
                $actorResult = $con->query($deleteActorSql);
//إذا تم الحذف بنجاح، يتم إعادة توجيه المستخدم لصفحة الفيو بيشنت مع رسالة نجاح.
                if ($actorResult == true) {
                    header("Location:viewPatients.php?deleted=true");
                } else {
                    //اذا فشلت عملية الحذف من جدول الاكتورز بيطبع هادي الرسالة
                    echo "Failed to delete from actors table.";
                }
            } else {
          //اذا فشلت عملية الحذف من جدول البيشنت بيطبع هادي الرسالة
                echo "Failed to delete from patients table.";
            }
        } else {
 //اذا فشلت عملية الحذف من جدول الوسيط بيطبع هادي الرسالة

            echo "Failed to delete from patientdoctor table.";
        }
    } else {
        echo "Patient not found.";
    }
}
?>

