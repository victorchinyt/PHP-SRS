<?php
	$dbServer = 'localhost';
	$dbUserName = 'root';
	$dbPassword = '';
	$dbName = 'srs_db';

	// Connect to server.
	$dbConnection = @mysql_connect($dbServer,$dbUserName,$dbPassword);
		if($dbConnection === FALSE){
			echo "<p>Unable to connect to the database server.<br /> Error Code ". mysql_errno().":". mysql_error()."</p>";
		}else {
		echo "<p>Successfully connect to the database server.</p>";
	}

    //Create Database
        $strSql = "CREATE DATABASE $dbName";
        $queryResult = @mysql_query($strSql, $dbConnection);
        if($queryResult === FALSE){
            echo "<p>Unable to create the database.</p>" . "<p>Error code " . mysql_errno($dbConnection) . ": " . mysql_error($dbConnection) . "</p>";
        }else{
            echo "<p>Database \”$dbName\” successfully created</p>";
        }

	// Select database.
	if(mysql_select_db($dbName, $dbConnection) === FALSE){
			echo "<p>The database is not created.</p>";
		}

    /*Check and Create table*/
        $tableName1 = 'stock_item';
        $strSql1 = "SHOW TABLES LIKE '$tableName1' ";
        $queryResult1 = @mysql_query($strSql1, $dbConnection);	

        if (mysql_num_rows(($queryResult1)) == 0){
            $strSql1 = "CREATE TABLE $tableName1 (
                            stock_code int(8) NOT NULL PRIMARY KEY,
                            stock_name varchar(255) NOT NULL,
                            description text NOT NULL,
                            location text NOT NULL,
                            quantity int(4) NOT NULL,
                            costing decimal(10,2) NOT NULL,
                            selling decimal(10,2) NOT NULL)";
            $queryResult1 = @mysql_query($strSql1, $dbConnection);
            if($queryResult1){
                echo "<p>Table: '$tableName1' has been succesfully created.</p>";
            }else{
                echo "<p>Unable to create table. Error Code ". mysql_errno().":".mysql_error()."</p>";
            }
        }else echo "<p>Sorry, table '$tableName1' already exist!<p>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" data-ng-app="myApp" xmlns="http://www.w3.org/1999/xhtml">
<head>
	 <title>Stock Item</title>
	 <meta charset="utf-8" />
	 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	 <!-- Bootstrap -->
	 <link href="css/bootstrap.min.css" rel="stylesheet" />
	 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	 <!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
	 <![endif]-->
    <link href="css/style.css" rel="stylesheet" />
</head>
<body data-ng-controller="myCtrl">
    <div class="container">
        <!-- div of navbar -->
        
        <?php
			include("header.php");
		?>
        
        <!-- div of form -->
        <div>        
        <form action="item.php" method="post">
            <h1>Stock Item</h1>
            <!-- row containing whole form -->
            <div class="row">

                <!-- 1st column containing label and boxes -->
                <div class="col-sm-9">
                    <!-- row with med name -->
                    <div class="row">
                        <!-- 1st column with label -->
                        <div class="col-sm-4">
                            <p>Med. Code:</p>
                        </div>
                        <!-- 2nd column with textbox -->
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="stockcode" id="stockcode" maxlength="8" />
                        </div>
                    </div><br/>

                    <!-- row with med code -->
                    <div class="row">
                        <!-- 1st column with label -->
                        <div class="col-sm-4">
                            <p>Med. Name:</p>
                        </div>
                        <!-- 2nd column with textbox -->
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="stockname" id="stockname"/>
                        </div>
                    </div><br/>

                    <!-- row with med description -->
                    <div class="row">
                        <!-- 1st column with label -->
                        <div class="col-sm-4">
                            <p>Description:</p>
                        </div>
                        <!-- 2nd column with textbox -->
                        <div class="col-sm-8">
                            <textarea name="description"  class="form-control" id="desc" rows="8"></textarea>
                        </div>
                    </div><br/>

                    <!-- row with med physical location -->
                    <div class="row">
                        <!-- 1st column with label -->
                        <div class="col-sm-4">
                            <p>Location:</p>
                        </div>
                        <!-- 2nd column with textbox -->
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="location" id="location" maxlength="30" />
                        </div>
                    </div><br/>

                    <!-- row with med quantity -->
                    <div class="row">
                        <!-- 1st column with label -->
                        <div class="col-sm-4">
                            <p>Quantity:</p>
                        </div>
                        <!-- 2nd column with textbox -->
                        <div class="col-sm-8">
                            <input type="number" class="form-control" min="0" name="mbal" />
                        </div>
                    </div><br/>

                    <!-- row with med buying cost -->
                    <div class="row">
                        <!-- 1st column with label -->
                        <div class="col-sm-4">
                            <p>Cost:</p>
                        </div>
                        <!-- 2nd column with textbox -->
                        <div class="col-sm-8">
                            <span class="input-group">
                            <div class="input-group-addon">RM</div>
                            <input type="text" class="form-control" name="mcost" id="mcost" placeholder="Amount"/>
                            </span>
                        </div>
                    </div><br/>

                    <!-- row with med selling price -->
                    <div class="row">
                        <!-- 1st column with label -->
                        <div class="col-sm-4">
                            <p>Selling Price:</p>
                        </div>
                        <!-- 2nd column with textbox -->
                        <div class="col-sm-8">
                            <span class="input-group">
                            <div class="input-group-addon">RM</div>
                            <input type="text" class="form-control" name="mprice" id="mprice" placeholder="Amount"/>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end of 1st column -->

                <!-- 2nd column containing buttons -->
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="btn" type="submit" name="BSubmit" value="Submit">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="btn" type="reset" name="BReset" value="Reset"> 
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-sm-12">  
                            <input class="btn" type="reset" name="BDelete" value="Delete"> 
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="btn" type="reset" name="BNew" value="New"> 
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="btn" type="reset" name="BSearch" value="Search"> 
                        </div>
                    </div>
                </div>
                <!-- end of 2nd column -->
            </div>
            <!-- end of row containing whole form -->

        </form>
        </div> <!-- end of form div -->
    </div> <!-- end of container div -->
    
	        <!-- jQuery – required for Bootstrap plugins) --> 
            <script src="js/jquery.min.js"></script> 
            <!-- All Bootstrap  plug-ins  file --> 
            <script src="js/bootstrap.min.js"></script> 
            <!-- Basic AngularJS --> 
            <script src="js/angular.min.js"></script> 
            <script src="js/angular-route.min.js"></script>
            <!-- Your Controller --> 
            <script src="js/script.js"></script>
    
<?php
	if(isset($_POST['BSubmit']))	
	{
		$Scode= $_POST['stockcode']; 
		$Sname= $_POST['stockname']; 
		$Desc= $_POST['description'];
        $Location= $_POST['location']; 
		$Mbal= $_POST['mbal']; 
		$Mcost= $_POST['mcost'];
        $Mprice= $_POST['mprice'];
	
        //insert the data into stock_item table
        $sql = "INSERT INTO stock_item (stock_code, stock_name, description, location, quantity, costing, selling)
        VALUES ('$Scode', '$Sname', '$Desc', '$Location', '$Mbal', '$Mcost','$Mprice')";

        $sqlResult = @mysql_query($sql, $dbConnection);
        if ($sqlResult === TRUE) {
            echo "New stock insert successfully";
        } else {
            echo "<p>Unable to insert data. Error Code ". mysql_errno($dbConnection).":". mysql_error($dbConnection)."</p>";
        }
	}
?>  
</body>
</html>