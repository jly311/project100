<?php require_once('../Connections/conn.php'); ?>
<?php
$colname_rsReligion = "1";
if (isset($_GET['religion_id'])) {
  $colname_rsReligion = (get_magic_quotes_gpc()) ? $_GET['religion_id'] : addslashes($_GET['religion_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsReligion = sprintf("SELECT * FROM religions WHERE religion_id = %s", $colname_rsReligion);
$rsReligion = mysql_query($query_rsReligion, $conn) or die(mysql_error());
$row_rsReligion = mysql_fetch_assoc($rsReligion);
$totalRows_rsReligion = mysql_num_rows($rsReligion);
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/myReligions.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Religions</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>          </button>
          <a class="navbar-brand" href="#">Bootstrap theme</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<!-- InstanceBeginEditable name="EditRegion3" -->
<div class="container">
	<h1 class="page-header"><?php echo $row_rsReligion['religion_name']; ?></h1>
	<!-- Religion Content -->
	<div class="row">
		<div class="col-md-5"><img src="<?php echo $row_rsReligion['religion_image']; ?>" class="img-responsive img-thumbnail" /></div>
		<div class="col-md-7">
			<div><?php echo $row_rsReligion['religion_description']; ?></div>
			<div>
			  <p>&nbsp;</p>
			  <p><strong>Religion Type:</strong> <?php echo ucfirst($row_rsReligion['religion_type']); ?></p>
			  <p><a href="views_new.php?religion_id=<?php echo $row_rsReligion['religion_id']; ?>">Add New Verse</a> </p>
			</div>
		</div>
	</div>	
<!-- InstanceEndEditable -->

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsReligion);
?>