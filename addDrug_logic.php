<?php
//بنبدأ الجلسة عشان نقدر نستخدم بيانات تسجيل الدخول للمستخدم.
session_start();
//هنا بنجيب الاي دي للمستخدم يلي قام بتسجيل الدخول 
$authId=$_SESSION["authUser"]["id"];
//لربط الكود بقاعدة البيانات.
include "connection.php";
//هنا بنشوف اذا ما ايرور في الاتصال مع الداتا بيز يعني نجحت عملية الاتصال 
if($con->error==false){
    //هنا لما نضغط على زر الادد درج 
if (isset($_POST["add_drug"])){
    //بنجيب الاسم يلي دخلناه بالفورم لهذا الدواء وبنخزنه في متغير
$drug_name=$_POST["name"];
//وهنا كذلك بنجيب ال دوسيج الي ادخلناها في الفورم وبنخزنها في متغير 
$drug_dosage=(double)$_POST["dosage"];
//وهنا كذلك بنجيب ال برودكشين ديت يلي دخلناها في الفورم بنخزنها في متغير 
$drug_productionDate=$_POST["productionDate"];
//وهنا كذلك بنخزن القيمة يلي دخلناها بالفورم بمتغير
$drug_expiryDate=$_POST["expiryDate"];
//هنا بنفحص اذا ما كنا مدخلين اي قيمة منهم يعني لسه فارغين بيرجع على نفس الصفحة وما بضيفو ع الداتا بيز
if(empty($drug_name)||empty($drug_dosage)||empty($drug_productionDate)||empty($drug_expiryDate)){
    header("Location:addDrugUi.php");
}else{
    //هنا لو ادخلنا كل القيم تمام وعملنا ادد درج بيروح يضيفها على جدول الدرج الموجود في الداتا بيز 
$sql="INSERT INTO drugs (name,dosage,productionDate,expiryDate)VALUES('$drug_name','$drug_dosage','$drug_productionDate','$drug_expiryDate')";
//وهنا بنشغل الكو يري 
$result=$con->query($sql);
//اذا تنفذت وتمام بيروح على صفحة الفيو بيعرض الي ضفناه 
if($result==true){
    header("Location:viewDrugs.php?created=true");
}else{
    //غير هيك فشل 
    echo "Faile";
}
}
}
}
?>