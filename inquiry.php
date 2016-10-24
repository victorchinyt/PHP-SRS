<?php
if(isset($_POST['search']))
{
    $stockToSearch = $_POST['stockToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `stock_item` WHERE CONCAT(`stock_code`, `stock_name`, `description`, `location`, `quantity`, `costing`, `selling`) LIKE '%".$stockToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `stock_item`";
    $search_result = filterTable($query);
}

if(isset($_POST['delete']))
{
    // sql to delete a record
    $del = $_POST['toDelete'];
    
    $sql_del = "DELETE FROM stock_item WHERE stock_code=$del";
    
    $connect = mysqli_connect("localhost", "root", "", "srs_db");
    $sqlResult = mysqli_query($connect, $sql_del);
    if ($sqlResult === TRUE) {
        echo "Stock deleted successfully";
    } else {
        echo "<p>Error deleting stock.</p>";
    }
    $query = "SELECT * FROM `stock_item`";
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
<html lang="en" data-ng-app='myApp'>
<head>
	 <title>SRS System : Stock Inquiry</title>
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
    <div class="container">
    <!-- div of navbar -->
	
        <?php
			include("header.php");
		?>
    <form action="inquiry.php" method="post">        
    <!-- div of inquiry -->
    <div>
        <h1>Stock Inquiry</h1>
        
        <!-- div of search input -->
		<div class="row">
            <div class="col-sm-6">
                <p>Med. Code <input type="text" name="stockToSearch" placeholder="Search"></p>
                <p><input type="submit" name="search" value="Filter" /></p>
            </div>
			<div class="col-sm-6">
                <p>Med. Code <input type="text" name="toDelete" placeholder="Delete"></p>
                <p><input type="submit" name="delete" value="Delete" /></p>
            </div>
			<div class="col-sm-4">
                <!-- filter supposedly here -->
            </div>
        </div> <!-- end of search input div -->
		
        <!-- row containing whole table -->
		<div class="row">
            <!-- the only column inside row -->
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-striped table-hover" border="5" cellpadding="5" cellspacing="0" style="border-collapse: collapse" bordercolor="#808080" width="100&#37">
							<tr>
								<th>Stock Code</th>
								<th>Stock Name</th>
								<th>Description</th>
								<th>Location</th>
								<th>Quantity</th>
								<th>Unit Price (RM)</th>
								<th>Selling Price (RM)</th>
							</tr>
						<?php
                            $qty = 0;
                            while($row = mysqli_fetch_array($search_result)):
                        ?>
							<tr>
								<td><?php 
                                echo $row['stock_code'];
                            ?></td>
                            <td><?php 
                                echo $row['stock_name'];
                            ?></td>
                            <td><?php 
                                echo $row['description'];
                            ?></td>
                                <td><?php 
                                echo $row['location'];
                            ?></td>
                            <td><?php 
                                echo $row['quantity'];
                                if (($row['quantity']) > 5 ?: $qty += 2)
                                ?>
                                </td>
                            <td><?php 
                                echo $row['costing'];
                            ?></td>
                                <td><?php 
                                echo $row['selling'];
                            ?></td>
							</tr>
                        <?php
                            endwhile;
                        ?>
					</table>
				</div>
			</div> <!-- end of the only column inside table row -->
		</div> <!-- end of whole table row -->			
    </div> <!-- end of inquiry div -->
    </form> 
    </div> <!-- end of container div -->
    <?php
        if($qty != 0)
        echo '<script> alert("Some medicines are running out. (5 or lower)\nPlease restock !"); </script>';
    ?>
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