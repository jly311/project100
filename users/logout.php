<?php
// *** Logout the current user.
$logoutGoTo = "login.php";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
$_SESSION['MM_UserID'] = NULL;
$_SESSION['MM_DisplayName'] = NULL;
$_SESSION['MM_profile_img'] = NULL;
$_SESSION['MM_UID'] = NULL;
$_SESSION['MM_LoggedInTime'] = NULL;
$_SESSION['MM_ProfileUID'] = NULL;
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
unset($_SESSION['MM_UserID']);
unset($_SESSION['MM_DisplayName']);
unset($_SESSION['MM_profile_img']);
unset($_SESSION['MM_UID']);
unset($_SESSION['MM_LoggedInTime']);
unset($_SESSION['MM_ProfileUID']);

if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>
