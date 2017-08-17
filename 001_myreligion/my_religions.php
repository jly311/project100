<?php require_once('../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../users/login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsmy_religions = 10;
$pageNum_rsmy_religions = 0;
if (isset($_GET['pageNum_rsmy_religions'])) {
  $pageNum_rsmy_religions = $_GET['pageNum_rsmy_religions'];
}
$startRow_rsmy_religions = $pageNum_rsmy_religions * $maxRows_rsmy_religions;

$colname_rsmy_religions = "-1";
if (isset($_GET['MM_UserId'])) {
  $colname_rsmy_religions = (get_magic_quotes_gpc()) ? $_GET['MM_UserId'] : addslashes($_GET['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsmy_religions = sprintf("SELECT * FROM religions WHERE user_id = %s", $colname_rsmy_religions);
$query_limit_rsmy_religions = sprintf("%s LIMIT %d, %d", $query_rsmy_religions, $startRow_rsmy_religions, $maxRows_rsmy_religions);
$rsmy_religions = mysql_query($query_limit_rsmy_religions, $conn) or die(mysql_error());
$row_rsmy_religions = mysql_fetch_assoc($rsmy_religions);

if (isset($_GET['totalRows_rsmy_religions'])) {
  $totalRows_rsmy_religions = $_GET['totalRows_rsmy_religions'];
} else {
  $all_rsmy_religions = mysql_query($query_rsmy_religions);
  $totalRows_rsmy_religions = mysql_num_rows($all_rsmy_religions);
}
$totalPages_rsmy_religions = ceil($totalRows_rsmy_religions/$maxRows_rsmy_religions)-1;

$queryString_rsmy_religions = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsmy_religions") == false && 
        stristr($param, "totalRows_rsmy_religions") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsmy_religions = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsmy_religions = sprintf("&totalRows_rsmy_religions=%d%s", $totalRows_rsmy_religions, $queryString_rsmy_religions);
?>My Religions
<?php
mysql_free_result($rsmy_religions);
?>
<?php if ($totalRows_rsmy_religions > 0) { // Show if recordset not empty ?>
  <table border="1">
    <tr>
      <td>religion_id</td>
      <td>user_id</td>
      <td>religion_name</td>
      <td>religion_description</td>
      <td>religion_creation_dt</td>
      <td>religion_status</td>
      <td>religion_type</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsmy_religions['religion_id']; ?></td>
        <td><?php echo $row_rsmy_religions['user_id']; ?></td>
        <td><?php echo $row_rsmy_religions['religion_name']; ?></td>
        <td><?php echo $row_rsmy_religions['religion_description']; ?></td>
        <td><?php echo $row_rsmy_religions['religion_creation_dt']; ?></td>
        <td><?php echo $row_rsmy_religions['religion_status']; ?></td>
        <td><?php echo $row_rsmy_religions['religion_type']; ?></td>
      </tr>
      <?php } while ($row_rsmy_religions = mysql_fetch_assoc($rsmy_religions)); ?>
      </table>
  <p> Records <?php echo ($startRow_rsmy_religions + 1) ?> to <?php echo min($startRow_rsmy_religions + $maxRows_rsmy_religions, $totalRows_rsmy_religions) ?> of <?php echo $totalRows_rsmy_religions ?> 
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_rsmy_religions > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsmy_religions=%d%s", $currentPage, 0, $queryString_rsmy_religions); ?>">First</a>
            <?php } // Show if not first page ?>
      </td>
      <td width="31%" align="center"><?php if ($pageNum_rsmy_religions > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsmy_religions=%d%s", $currentPage, max(0, $pageNum_rsmy_religions - 1), $queryString_rsmy_religions); ?>">Previous</a>
            <?php } // Show if not first page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsmy_religions < $totalPages_rsmy_religions) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsmy_religions=%d%s", $currentPage, min($totalPages_rsmy_religions, $pageNum_rsmy_religions + 1), $queryString_rsmy_religions); ?>">Next</a>
            <?php } // Show if not last page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsmy_religions < $totalPages_rsmy_religions) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsmy_religions=%d%s", $currentPage, $totalPages_rsmy_religions, $queryString_rsmy_religions); ?>">Last</a>
            <?php } // Show if not last page ?>
      </td>
    </tr>
  </table>
  <?php } // Show if recordset not empty ?></p>
<?php if ($totalRows_rsmy_religions == 0) { // Show if recordset empty ?>
  <p>No Religion Found </p>
  <?php } // Show if recordset empty ?>