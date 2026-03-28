<?php
//لربط الكود بقاعدة البيانات.
include "connection.php";
//هنا بنجيب الاي دي من المصفوفة جيت 
if($_GET["id"]){
    //وبنخزن هذا الاي دي في متغير 
    $id=$_GET["id"];
    //وبعدين هان بنحذف الدوا من قاعدة البيانات بناء على الاي دي تاعو 
    $sql="DELETE FROM drugs WHERE id=$id";
    //وهنا بنجيب نتيجة الكويري
    $result=$con->query($sql);
    //لو تمام وحذف ف حيروح على صفحة الفيو درج
if ($result==true){
    header("Location:viewDrugs.php?deleted=true");
}

}
?>