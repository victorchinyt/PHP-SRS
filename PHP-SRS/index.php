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


	// Select database.
	if(mysql_select_db($dbName, $dbConnection) === FALSE){
			echo "<p>The database is not created.</p>";
		}	

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
    <div class="container">
        
        <?php
			include("header.php");
		?>
        
        <div class="row">
            <div class="col-sm-12">
                <h1>Cash Sales</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>Sales ID: <input type="text" name="sid" id="sid" /></p>
            </div>
            <div class="col-sm-6">
                <p>Date: <input type="date" id="date" name="date" id="date" /></p>
            </div>
        </div>
        <form>
            <div class="row">
                <div class="col-sm-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
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
                                        <input type="text" name="input" id="scode">
                                    </td>
                                    <td>
                                        <input type="text" name="input" id="sname">
                                    </td>
                                    <td>
                                        <input type="number" id="quantity" data-ng-model="num1" />
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
                                        <input type="text" name="input" id="scode">
                                    </td>
                                    <td>
                                        <input type="text" name="input" id="sname">
                                    </td>
                                    <td>
                                        <input type="number" id="quantity" data-ng-model="num4" />
                                    </td>
                                    <td>
                                        <input type="number" id="uprice" data-ng-model="num5" />
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
                                        <input type="text" name="input" id="scode">
                                    </td>
                                    <td>
                                        <input type="text" name="input" id="sname">
                                    </td>
                                    <td>
                                        <input type="number" id="quantity" data-ng-model="num7" />
                                    </td>
                                    <td>
                                        <input type="number" id="uprice" data-ng-model="num8" />
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
                                        <input type="text" name="input" id="scode">
                                    </td>
                                    <td>
                                        <input type="text" name="input" id="sname">
                                    </td>
                                    <td>
                                        <input type="number" id="quantity" data-ng-model="num10" />
                                    </td>
                                    <td>
                                        <input type="number" id="uprice" data-ng-model="num11" />
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
                                        <input type="text" name="input" id="scode">
                                    </td>
                                    <td>
                                        <input type="text" name="input" id="sname">
                                    </td>
                                    <td>
                                        <input type="number" id="quantity" data-ng-model="num13" />
                                    </td>
                                    <td>
                                        <input type="number" id="uprice" data-ng-model="num14" />
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
                            <input class="btn" type="button" value="Add">
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="btn" type="reset" value="Reset"> 
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="btn" type="submit" name="BSubmit" value="Submit">
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="btn" type="button" value="Print"> 
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="#stockinquiry"><input class="btn" type="button" value="Search"></a> 
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
                            <small id="tamount">Total Amount:</small><p id="amount" name="amount">{{num1 * num2|number:2}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
	<script src="js/angular.min.js"></script>
	<script src="js/angular-route.min.js"></script>
	<script src="js/appmenu.js"></script>
    <script src="js/script.js"></script>
    
<?php
	if(isset($_POST['BSubmit']))	
	{
		$Sid= $_POST['sid']; 
		$Sdate= $_POST['date']; 
		$Samount= $_POST['amount'];        
       
	}	
	
    //insert the data into stock_item table
	$sql = "INSERT INTO sales_record (sale_id, sale_date, amount)
	VALUES ('$Sid', '$SDate', '$Samount')";

	$sqlResult = @mysql_query($sql, $dbConnection);
	if ($sqlResult === TRUE) {
		echo "New stock insert successfully";
	} else {
		echo "<p>Unable to insert data. Error Code ". mysql_errno($dbConnection).":". mysql_error($dbConnection)."</p>";
	}
    
?>  
    
    
</body>
</html>

