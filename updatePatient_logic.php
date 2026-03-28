<?php
//لربط الكود بقاعدة البيانات.
include "connection.php";
//هنا لو ما في ايرور بالاتصال على قاعده البيانات
if ($con->error == false) {
    //هنا لو ضغطنا على زر ابديت بيشنت 
    if (isset($_POST["update_patient"])) {
        //بنجيب الاي دي المدخلة في الفورم وبنخزنها في متغير
        $patient_id = $_POST["patient_id"];
        //ونفس الاشي بنجيب النيم اللي دخلناه بالفورم وبنخزنها بمتغير
        $patient_name = $_POST["new_patient_name"];
        //نفس الاشي بنجيب قيمة الايميل الي دخلناها بالفورم وبنخزنها بمتغير
        $patient_email = $_POST["new_email"];
        //ونفس الاشي بنجيب العمر اللي دخلناه في الفورم وبنعمله كاستنج ل انتجر وبنخزنه بمتغير
        $patient_age = (int)$_POST["new_age"];
        //ونفس الاشي الجندر اللي اخترناه في الفورم بناخد قيمته بنخزنها بمتغير
        $patient_gender = $_POST["new_gender"];
        //ونص الاشي المشكلة اللي دخلناها باالفورم بنخزن قيمتها بمتغير
        $patient_problem = $_POST["new_problem"];
        //ونفس الاشي الانترنس ديت اللي دخلناها بالفورم بنخزنها بمتغير
        $patient_intranceDate = $_POST["new_intranceDate"];
        //ونفس الاشي الفون نمبر اللي دخلناه بالفورم بنخزنه في متغير
        $patient_phonenumber = $_POST["new_phonenumber"];
        //هان لو ما دخلنا اشي بالفورم يعني القيم فاضية 
        if (empty($patient_name) || empty($patient_email) || empty($patient_age) || empty($patient_gender) || empty($patient_problem) || empty($patient_intranceDate) || empty($patient_phonenumber)) {
           //بيضل بنفس الصفحة 
            header("Location:updatePatient.php");
        } else {
//اما لو كانت كل القيم مدخلة بنروح نخزن هدول القيم في جدول البيشنت بالداتا بيز يعني بنعدل القيم الموجودة للقيم الجديدة 
        $sql = "UPDATE patients SET name='$patient_name', email='$patient_email', age='$patient_age', gender='$patient_gender', problem='$patient_problem', entranceDate='$patient_intranceDate', phone_number='$patient_phonenumber' WHERE id='$patient_id'";
        //هان بنشغل الاستعلام
        $result = $con->query($sql);
//اذا كانت نتيجة الاستعلام صحيحة 
        if ($result == true) {
            //بيروح بجيب الاكتور اي دي المرتبط بمريض معين من جدول البيشنت بناء على اي دي المريض
            $fetchActorIdSql = "SELECT actor_id FROM patients WHERE id='$patient_id'";
            //يُرسل الاستعلام إلى قاعدة البيانات.
            $actorResult = $con->query($fetchActorIdSql);
           
            //actor_id.لو فيه عدد صفوف أكبر من صفر، بنعرف إنه فيه 
            if ($actorResult->num_rows > 0) {
                //بيجيب أول صف من نتيجة الاستعلام كمصفوفة.
                $actorData = $actorResult->fetch_assoc();
                //بنخزن قيمة الاكتور اي دي في متغير اسمه اكتور اي دي
                $actor_id = $actorData["actor_id"];
                //بنعدل القيم اللي بجدول الاكتور للقيم الجديدة اللي حطيناها بعد التعديل
                $updateActorSql = "UPDATE actors SET name='$patient_name', email='$patient_email', phone_number='$patient_phonenumber' WHERE id='$actor_id'";
                       //هان بنشغل الاستعلام
                $actorUpdateResult = $con->query($updateActorSql);
                   //اذا اشتغل وتمام وتعدلت البيانات في قاعدة البيانات في جدول الاكتور
                if ($actorUpdateResult == true) {
                    //بينتقل للفيو بيشنت 
                    header("Location:viewPatients.php?updated=true");
                } else {
                    echo "Failed to update actors table.";
                }
            } else {
                echo "Actor ID not found.";
            }
        } else {
            echo "Failed to update patients table.";
        }
    }
}
}
?>
