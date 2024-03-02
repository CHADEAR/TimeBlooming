<?php

$objCon = mysqli_connect("sql101.infinityfree.com", "if0_35967055", "mYNKlaJeRTKDA","if0_35967055_user");

if ($objCon -> connect_errno){
    echo "Failed " . $objCon -> connect_error;
    exit();
}
else
echo "connect success";
?>