<?php
if(isset($_POST['search']))
{
    $saleToSearch = $_POST['saleToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `sales_record` WHERE CONCAT(`sale_id`, `sale_date`, `stock_code`, `stock_name`, `amount`) LIKE '%".$saleToSearch."%'";
    $search_result = filterTable($query);
}
 else {
    $query = "SELECT * FROM `sales_record`";
    $search_result = filterTable($query);
}

if(isset($_POST['searchByDate']))
{
    $date1 = $_POST['toCal1'];
    $date2 = $_POST['toCal2'];
    $query = "SELECT * FROM `sales_record` WHERE `sale_date` BETWEEN '$date1' AND '$date2'";
    $search_result = filterTable($query);
}
 else {
    $query = "SELECT * FROM `sales_record`";
    $search_result = filterTable($query);
}

if(isset($_POST['delete']))
{
    // sql to delete a record
    $del = $_POST['toDelete'];
    
    $sql_del = "DELETE FROM sales_record WHERE sale_id=$del";
    
    $connect = mysqli_connect("localhost", "root", "", "srs_db");
    $sqlResult = mysqli_query($connect, $sql_del);
    if ($sqlResult === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "<p>Error deleting record.</p>";
    }
    $query = "SELECT * FROM `sales_record`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "srs_db");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html lang="en" data-ng-app="myApp">
<head>
	 <title>Sale Record</title>
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
    <div class="container" >
        
        <?php
			include("header.php");
		?>
        <form action="record.php" method="post">
            <div class="row">
                <div class="col-md-12">
                    <h1>Sale Record</h1>
                    <div class="row">
                        <div class="col-sm-1">
                            <p><strong>Sale ID: </strong></p>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="saleToSearch" placeholder="Sale ID to Search" />
                            <input type="submit" name="search" value="Filter" />
                        </div>
                        <div class="col-sm-5" >
                            <input type="text" name="toDelete" placeholder="Sale ID to Delete" />
                            <input type="submit" name="delete" value="Delete" />
                        </div>
                    </div><br/>
                    
                    <table class="table table-striped table-hover" border="5" cellpadding="5" cellspacing="0" style="border-collapse: collapse" bordercolor="#808080" width="100&#37">
                        <tr>
                            <th>Sale ID</th>
                            <th>Date</th>
                            <th>Stock Code</th>
                            <th>Stock Name</th>
                            <th>Amount</th>
                        </tr>

                        <?php
                            $sum = 0; $days=0;
                            while($row = mysqli_fetch_array($search_result)):
                        ?>
                        <tr>
                            <td><?php 
                                echo $row['sale_id'];
                            ?></td>
                            <td><?php 
                                echo $row['sale_date'];
                            ?></td>
                            <td><?php 
                                echo $row['stock_code'];
                            ?></td>
                            <td><?php 
                                echo $row['stock_name'];
                            ?></td>
                            <td><?php 
                                echo $row['amount'];
                                $sum += $row['amount'];
                                $days += 1;
                            ?></td>
                        </tr>
                        <?php
                            endwhile;
                        ?>
                    </table>
                    
                    <div class="row">
                        <div class="col-sm-2">
                            <p><strong>Search by Date:</strong></p>
                        </div>
                        <div class="col-sm-2">
                            <input type="date" name="toCal1" value="<?php echo date('Y-m-d'); ?>"/>
                        </div>
                        <div class="col-sm-2">
                            <input type="date" name="toCal2" value="<?php echo date('Y-m-d'); ?>"/>
                        </div>
                        <div class="col-sm-2">
                            <input type="submit" name="searchByDate" value="Search"/>
                        </div>
                    </div>
                    <br/><br/>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <p><strong>Calculate Total Sales:</strong></p>
                        </div>
                        <!-- calculate average
                        <div class="col-sm-4">
                            #comment out - not per day but per entry based on the code
                            <p><strong>Calculate Average Amount per Day:</strong></p>
                        </div> -->
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div ng-show="showme1">
                                <p>RM <?php echo $sum;?></p>
                            </div>
                            <div class="col-sm-4" ng-hide="showme1">
                                <input type="button" value="Calculate" ng-click="showme1 = 1"/>
                            </div>
                        </div>
                        
                        <!-- calculate average
                        <div class="col-sm-4">
                            <div ng-show="showme2">
                                <p>RM {{<?php echo $sum;?>/<?php echo $days;?>}}/day</p>
                            </div>
                            <div class="col-sm-4" ng-hide="showme2">
                                <input type="button" value="Calculate" ng-click="showme2 = 1"/>
                            </div>
                        </div> -->
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


