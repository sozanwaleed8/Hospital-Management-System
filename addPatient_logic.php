<?php
//بنبدأ الجلسة عشان نقدر نستخدم بيانات تسجيل الدخول للمستخدم.
session_start();
//لربط الكود بقاعدة البيانات.
include "connection.php";
//اذا ما كان في خطا بالاتصال بالداتا بيز
if ($con->error == false) {
    //اذا ضغطنا على ادد بيشنت اللي بالفورم
    if (isset($_POST["add_patient"])) {
        //حيروح يخزن النيم يلي دخلناها في الفورم في متغير 
        $patient_name = $_POST["name"];
        //وحيخزن الايميل يلي دخلناها بالفورم في متغير ايضا
        $patient_email = $_POST["email"];
        //وحيخزن الباسوورد اللي  دخلناها بالفورم في متغير
        $patient_password = $_POST["password"];
        //هنا بدو يشفرها لما ندخلها بالفورم ولما تتخزن بالداتا بيز ويخزنها في نفس المتغير السابق
        $patient_password = password_hash($patient_password, PASSWORD_BCRYPT);
        //وهنا ايضا حيخزن العمر يلي دخلناه بالفورم في متغير وحيعمل كاستنج ل انتجر 
        $patient_age = (int)$_POST["age"];
        //وهنا ايضا قيمة الجندر يلي اخترناها في الفورم حيخزنها بمتغير
        $patient_gender = $_POST["gender"];
        //وايضا المشكله يلي دخلناها بالفورم حيخزنها بمتغير
        $patient_problem = $_POST["problem"];
        //وهنا ايضا الانترنس ديت اللي دخلناه بالفورم حيخزنها بمتغير
        $patient_intranceDate = $_POST["intranceDate"];
        //وهنا ايضا الفون نمبر يلي دخلناها بالفورم حيحزنها بمتغير 
        $patient_phonenumber = $_POST["phonenumber"];
        //هنا بيفحص اذا كانت كل القيم بالفورم فارغه يعني ما دخلنا قيم حرفيا حيضل بنفس الصفحة تعت الادد بيشنت ومش حيضيفو على الداتا بيز في جدول البيشنت والاكتور
        if (empty($patient_name) || empty($patient_email) || empty($patient_age) || empty($patient_gender) || empty($patient_problem) || empty($patient_intranceDate) || empty($patient_phonenumber)) {
            header("Location:addPatientUi.php");
        } else {
            //اما لو كانت كل االقيم مدخلة راح يقوم بتخزين هذه البيانات في الداتا بيز اولا في جدول الاكتورز حسب الحقول الموجودة فيه وهكذا 
            $actorSql = "INSERT INTO actors (name, email, password, phone_number, type) VALUES ('$patient_name', '$patient_email', '$patient_password', '$patient_phonenumber', 'patient')";
            //هنا بنشغل الكويري
            $actorResult = $con->query($actorSql);
             //اذا تخزنت القيم بجدول الاكتور وتمام
            if ($actorResult == true) {
                //حيروح يجيب الاكتور اي دي اللي بجدول الاكتور لهذا المريض ويخزنه ايضا في جدول المريض لانه الاكتور اي دي عبارة عن مفتاح اجنبي في جدول البيشنت ومفتاخ اساسي في الاكتورز
                $actorId = $con->insert_id;
                 //وهنا حيخزن القيم في جدول المريض تمام ويقوم برضو بتخزين نفس الاكتور اي دي  اللي موجود في الاكتور في جدول المريض 
                $sql = "INSERT INTO patients (name, email, password, age, gender, problem, entranceDate, phone_number, actor_id) 
                        VALUES ('$patient_name', '$patient_email', '$patient_password', '$patient_age', '$patient_gender', '$patient_problem', '$patient_intranceDate', '$patient_phonenumber', '$actorId')";
                        //هنا بنشغل الكويري
                $result = $con->query($sql);
                //اذا اشتغلت وتمام وضاف على جدول المريض هادي القيم
                if ($result == true) {
                    //وهان نفس الاشي حيجيب البيشنت اي دي يلي بجدول البيشنت هو عبارة عن مفتاح اساسي في جدول البيشنت واجنبي في الجدول الوسيط
                    $patientId = $con->insert_id;
                  //هنا بنجيب الاي دي للمستخدم يلي عمل تسجيل دخول
                    $actor_id = $_SESSION["authUser"]["id"];
                    //وهنا بنجيب الاي دي من جدول الدكتور اذا كان المستخدم اللي عمل تسجيل دخول هو نفسه اي دي الدكتور 
                    $doctorQuery = "SELECT id FROM doctors WHERE actor_id = $actor_id";
                    //هنا بنشغل الكويري
                    $doctorResult = $con->query($doctorQuery);
                   //هنا بنشوف لو عدد الصفوف اكبر من صفر في هادي الكويري
                    if ($doctorResult && $doctorResult->num_rows > 0) {
                        //وهان بنخزن عدد الاعمدة تمام في متغير بعد منعمل فيتش للاراي 
                        $doctorRow = $doctorResult->fetch_assoc();
                        //وبنحط الاي دي تع هذا الصف اللي بجدول الدكتور في متغير 
                        $doctor_id = $doctorRow["id"];
                        //وهان بدنا نضيف على الداتا بيز على الجدول الوسيط لبن الدكتور والمريض رقم الدكتور ورقم كل مريض خاص فيه وهكذا لكل الدكاترة رقم الدكتور ورقم المرضى تعونو
                        $relationSql = $con->prepare("INSERT INTO patientdoctor (patient_id, doctor_id) VALUES ($patientId, $doctor_id )");
                        $relationResult = $relationSql->execute();
                        //اذا نجحت عملية الاضافة حينتقل على الفيو بيشنت 
                        if ($relationResult == true) {
                            header("Location:viewPatients.php?created=true");
                        } else {
                            //واذا ما نجحت عملية الاضافة على الداتا بيز راح يطلع ايرور
                            die("Error adding relation to patientdoctor: " . $con->error);
                        }
                    } else {
                        //لو ما نجحت عملية الاضافة على الجدول الوسيط حيقولي انه رقم الدكتور غير موجود
                        die("Doctor ID not found.");
                    }
                } else {
                    //ولو ما نجحت الاضافة على جدول البيشنت حيطلع ايرور
                    die("Error adding patient: " . $con->error);
                }
            } else {
                //ولو ما نجحت الاضافة على الاكتور راح يطلع ايرور
                die("Error adding actor: " . $con->error);
            }
        }
    }
}
?>