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
		
	}

    //Create Database
        $strSql = "CREATE DATABASE $dbName";
        $queryResult = @mysql_query($strSql, $dbConnection);
        if($queryResult === FALSE){
            
        }else{
            echo "<p>Database \”$dbName\” successfully created</p>";
        }


	// Select database.
	if(mysql_select_db($dbName, $dbConnection) === FALSE){
			echo "<p>The database is not created.</p>";
		}	

    /*Check and Create table*/
    $tableName2 = 'sales_record';
    $strSql2 = "SHOW TABLES LIKE '$tableName2' ";
    $queryResult2 = @mysql_query($strSql2, $dbConnection);	

    if (mysql_num_rows(($queryResult2)) == 0){
        $strSql2 = "CREATE TABLE $tableName2 (
                        sale_id VARCHAR(255) NOT NULL,
                        sale_date DATE NOT NULL,
                        stock_code int(8) NOT NULL,
                        stock_name varchar(255) NOT NULL,
                        amount DECIMAL(10,2) NOT NULL,
                        quantity int(4) NOT NULL,
                        PRIMARY KEY(sale_id))";
        $queryResult2 = @mysql_query($strSql2, $dbConnection);
        if($queryResult2){
            echo "<p>Table: '$tableName2' has been succesfully created.</p>";
        }/*else{

        }*/
    }/*else*/
        
    // populate drop down list
    $options = '';
    $options .="<option></option>";
    $filter=mysql_query("select distinct stock_code from stock_item");
    while($row = mysql_fetch_array($filter)) {
        $options .="<option>" . $row['stock_code'] . "</option>";
    }
    $menu=" . $options . ";
?>

<!DOCTYPE html>
<html lang="en" data-ng-app="myApp">
<head>
	 <title>SRS System</title>
	 <meta charset="utf-8" />
	 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
<body>
    <header>
        <h1 id="shopname">People Health Pharmacy</h1>
    </header>
    <?php
        if(isset($_POST['BSubmit']))	
        {
            $Sid = $_POST['sid'];
            $Sdate = $_POST['date'];
            $Sname = $_POST['sname'];
            $Samount = $_POST['amount'];
            $Squantity = $_POST['sq']; // first row
            $Scode = $_POST['scode']; // first rows
            
            echo"<br><br>";
            //validate the data
            /*
            if (empty($Sid)){
			
            echo "<p>Please enter the Sales ID!</p>";

            }else */if (empty($Sdate)){

            echo "<p>Please enter the Stock Code!</p>";

            }else if (empty($Scode)){

            echo "<p>Please enter the Stock Name!</p>";	

            }else{ 

            //insert the data into stock_item table
            $sql = "INSERT INTO sales_record (sale_id, sale_date, stock_code, stock_name, amount, quantity)
            VALUES ('$Sid', '$Sdate', '$Scode', '$Sname', '$Samount', '$Squantity')";

            // only edit for first row
            $sql_update = "UPDATE stock_item SET quantity=(quantity-$Squantity) WHERE stock_code=$Scode";

            $sqlResult = @mysql_query($sql, $dbConnection);
            if ($sqlResult === TRUE) {
                echo "<font color='red'>New sale insert successfully</font>";
            } else {
                echo "<p>Unable to insert data. Error Code ". mysql_errno($dbConnection).":". mysql_error($dbConnection)."</p>";
            }

            $sqlResult = @mysql_query($sql_update, $dbConnection);
            if ($sqlResult === TRUE) {
                echo "<br/><font color='red'>Stock update successfully</font>";
            } else {
                echo "<p>Unable to update stock.</p>";
            }

            }
        }

            
    ?> 
    
    <div class="container">
        <?php
			include("header.php");
		?>
        <div class="row">
            <div class="col-sm-12">
                <h1>Cash Sales</h1>
            </div>
        </div>
        <form action="index.php" method="post">
            <div class="row">
                <div class="col-sm-6">
                    <p>Sales ID: <input type="text" name="sid" id="sid" required="true"/></p>
                </div>
                <div class="col-sm-6">
                    <p>Date: <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" /></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="table-responsive">
                        <table class="table table-striped" border="5" cellpadding="5" cellspacing="0" style="border-collapse: collapse" bordercolor="grey">
                            <thead>
                                <tr>
                                    <th>Stock Code</th>
                                    <th>Stock Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price (RM)</th>
                                    <th>Discount (%)</th>
                                    <th>Total Price (RM)</th>
                                </tr>
                            </thead>
                            <tbody>    
                                <tr>
                                    <td>
                                        <select name='scode' id='scode' style="width: 100%">
                                            <?php echo $menu ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="sname" id="sname">
                                    </td>
                                    <td>
                                        <input type="number" name="sq" id="quantity" data-ng-model="num1" />
                                    </td>
                                    <td>
                                        <input type="number" id="uprice" data-ng-model="num2" />
                                    </td>
                                    <td>
                                        <input type="number" id="discount" data-ng-model="num3" data-ng-init="num3=0"/>
                                    </td>
                                    <td>
                                        <p>{{num1 * num2 | number:2}}</p>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>    
                                <tr>
                                    <td>
                                        <select name='scode2' id='scode2' style="width: 100%">
                                            <?php echo $menu ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="sname2" id="sname">
                                    </td>
                                    <td>
                                        <input type="number" name="sq2" id="quantity" data-ng-model="num4" />
                                    </td>
                                    <td>
                                        <input type="number" id="uprice2" data-ng-model="num5" />
                                    </td>
                                    <td>
                                        <input type="number" id="discount" data-ng-model="num6" data-ng-init="num6=0"/>
                                    </td>
                                    <td>
                                        <p>{{num4 * num5 | number:2}}</p>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>    
                                <tr>
                                    <td>
                                        <select name='scode3' id='scode3' style="width: 100%">
                                            <?php echo $menu ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="sname3" id="sname">
                                    </td>
                                    <td>
                                        <input type="number" name="sq3" id="quantity" data-ng-model="num7" />
                                    </td>
                                    <td>
                                        <input type="number" id="uprice3" data-ng-model="num8" />
                                    </td>
                                    <td>
                                        <input type="number" id="discount" data-ng-model="num9" data-ng-init="num9=0"/>
                                    </td>
                                    <td>
                                        <p>{{num7 * num8 | number:2}}</p>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>    
                                <tr>
                                    <td>
                                        <select name='scode4' id='scode4' style="width: 100%">
                                            <?php echo $menu ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="sname4" id="sname">
                                    </td>
                                    <td>
                                        <input type="number" name="sq4" id="quantity" data-ng-model="num10" />
                                    </td>
                                    <td>
                                        <input type="number" id="uprice4" data-ng-model="num11" />
                                    </td>
                                    <td>
                                        <input type="number" id="discount" data-ng-model="num12" data-ng-init="num12=0"/>
                                    </td>
                                    <td>
                                        <p>{{num10 * num11 | number:2}}</p>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>    
                                <tr>
                                    <td>
                                        <select name='scode5' id='scode5' style="width: 100%">
                                            <?php echo $menu ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="sname6" id="sname">
                                    </td>
                                    <td>
                                        <input type="number" name="sq5" id="quantity" data-ng-model="num13" />
                                    </td>
                                    <td>
                                        <input type="number" id="uprice5" data-ng-model="num14" />
                                    </td>
                                    <td>
                                        <input type="number" id="discount" data-ng-model="num15" data-ng-init="num15=0"/>
                                    </td>
                                    <td>
                                        <p>{{num13 * num14 | number:2}}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="btn" type="submit" name="BSubmit" value="Submit">
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="btn" type="reset" value="Reset"> 
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="btn" type="button" value="Print"> 
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="record.php"><input class="btn" type="button" value="Delete"></a> 
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="record.php"><input class="btn" type="button" value="Search"></a>
                        </div>
                    </div>            
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <small id="tamount">Total Amount:</small><p id="amount">{{num1 * num2|number:2}}</p>
                            <input type="hidden" name="amount" value='{{num1 * num2|number:2}}'>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
	        <!-- jQuery – required for Bootstrap plugins) --> 
            <script src="js/jquery.min.js"></script> 
            <!-- All Bootstrap  plug-ins  file --> 
            <script src="js/bootstrap.min.js"></script> 
            <!-- Basic AngularJS --> 
            <script src="js/angular.min.js"></script> 
            <script src="js/angular-route.min.js"></script>
            <!-- Your Controller --> 
            <script src="js/script.js"></script>
</body>
</html>