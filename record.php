<?php
if(isset($_POST['search']))
{
    $saleToSearch = $_POST['saleToSearch'];
    // search in all table columns
    // using concat mysql function
    // $query = "SELECT * FROM `sales_record` WHERE CONCAT(`sale_id`, `sale_date`, `stock_code`, `stock_name`, `amount`) LIKE '%".$saleToSearch."%'";
    $query = "SELECT * FROM sales_record WHERE sale_id LIKE '%".$saleToSearch."%'";
    $search_result = filterTable($query);
    // search for medicine
    $medicinequery = "SELECT stock_code, stock_name, SUM(quantity) AS med_quantity FROM sales_record WHERE sale_id LIKE '%".$saleToSearch."%' GROUP BY stock_code";
    $medicine_sales = filterTable($medicinequery);
}
 else {
    // search for sales
    $query = "SELECT * FROM `sales_record`";
    $search_result = filterTable($query);
    // search for medicine
    $medicinequery = "SELECT stock_code, stock_name, SUM(quantity) AS med_quantity FROM sales_record GROUP BY stock_code";
    $medicine_sales = filterTable($medicinequery);
}

if(isset($_POST['searchByDate']))
{
    $date1 = $_POST['toCal1'];
    $date2 = $_POST['toCal2'];
    // search for sales
    $query = "SELECT * FROM `sales_record` WHERE `sale_date` BETWEEN '$date1' AND '$date2'";
    $search_result = filterTable($query);
    // search for medcine
    $medicinequery = "SELECT stock_code, stock_name, SUM(quantity) AS med_quantity FROM sales_record WHERE `sale_date` BETWEEN '$date1' AND '$date2' GROUP BY stock_code";
    $medicine_sales = filterTable($medicinequery);
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
            <!-- div of row inside form -->
            <div class="row">
                <!-- div of col inside form -->
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
                    <div id="dvData">
                    <table id="salesrecord" class="table table-striped table-hover" border="5" cellpadding="5" cellspacing="0" style="border-collapse: collapse" bordercolor="#808080" width="100&#37">
                        <div class="yesPrint">
                            <tr>
                                <th>Sale ID</th>
                                <th>Date</th>
                                <th>Stock Code</th>
                                <th>Stock Name</th>
                                <th>Amount</th>
                            </tr>

                            <?php
                                $sum = 0; $days=0; $date=0;
                                while($row = mysqli_fetch_array($search_result)):
                            ?>
                            <tr>
                                <td><?php 
                                    echo $row['sale_id'];
                                ?></td>
                                <td><?php 
                                    echo $row['sale_date'];
                                    if ($date != $row['sale_date'])
                                         $days += 1;
                                    $date=$row['sale_date'];
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
                                ?></td>
                            </tr>
                            <?php
                                endwhile;
                            ?>
                        </div>
                    </table>
                    </div>
                    
                    <!-- first row at bottom section -->
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
                        <div class="col-sm-2">
                            <input type="button" name="printTable" id="printTable" value="Print" onClick="printData()"/>
                        </div>
                         <div class='col-sm-2 button'>
                            <button><a href="#" id ="export" role='button'>Export</a></button>
                        </div>
                    </div>
                    <br/><br/>
                    
                    <!-- second row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <p><strong>Calculate Total Sales:</strong></p>
                        </div>
                        <!-- calculate average -->
                        <div class="col-sm-4">
                            <!-- if there are two same date separated by a different date, the day will + -->
                            <p><strong>Calculate Average Amount per Day:</strong></p>
                        </div>
                    </div>
                    
                    <!-- third row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div ng-show="showme1">
                                <p>RM <?php echo $sum;?></p>
                            </div>
                            <div class="col-sm-4" ng-hide="showme1">
                                <input type="button" value="Calculate" ng-click="showme1 = 1"/>
                            </div>
                        </div>
                        
                        <!-- calculate average -->
                        <div class="col-sm-4">
                            <div ng-show="showme2">
                                <p>RM {{<?php echo $sum;?>/<?php echo $days;?>}}/day</p>
                            </div>
                            <div class="col-sm-4" ng-hide="showme2">
                                <input type="button" value="Calculate" ng-click="showme2 = 1"/>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    
                    <!-- fourth row -->
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Total quantity of medicine sold thus far</strong></p>
                            <table id="quantitysold" class="table-striped table-hover" border="5" cellpadding="5" cellspacing="0" bordercolor="#808080" width="50%">
                            <tr>
                                <th>Stock Code</th>
                                <th>Stock Name</th>
                                <th>Quantity</th>
                            </tr>
                            <?php
                                while($row = mysqli_fetch_array($medicine_sales)):
                            ?>
                            <tr>
                                <td><?php 
                                    echo $row['stock_code'];
                                ?></td>
                                <td><?php 
                                    echo $row['stock_name'];
                                ?></td>
                                <td><?php 
                                    echo $row['med_quantity'];
                                ?></td>
                            </tr>
                            <?php
                                endwhile;
                            ?>
                            </table><br/>
                            <div class="col-sm-2">
                                <input type="button" name="printTable" id="printTable" value="Print" onClick="printDatas()"/>
                            </div>
                        </div>
                    </div> <!-- end of fourth row -->
                </div> <!-- end of col div in form -->
            </div> <!-- end of row div in form -->
        </form>
    </div>
    
    <script>
        function printData(){
            var divToPrint=document.getElementById("salesrecord");
            newWin=window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>
    <script>
        function printDatas(){
            var divToPrint=document.getElementById("quantitysold");
            newWin=window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.min.js'></script>
        <!-- If you want to use jquery 2+: https://code.jquery.com/jquery-2.1.0.min.js -->
        <script type='text/javascript'>
        $(document).ready(function () {
            console.log("HELLO")
            function exportTableToCSV($table, filename) {
                var $headers = $table.find('tr:has(th)')
                    ,$rows = $table.find('tr:has(td)')
                    // Temporary delimiter characters unlikely to be typed by keyboard
                    // This is to avoid accidentally splitting the actual contents
                    ,tmpColDelim = String.fromCharCode(11) // vertical tab character
                    ,tmpRowDelim = String.fromCharCode(0) // null character
                    // actual delimiter characters for CSV format
                    ,colDelim = '","'
                    ,rowDelim = '"\r\n"';
                    // Grab text from table into CSV formatted string
                    var csv = '"';
                    csv += formatRows($headers.map(grabRow));
                    csv += rowDelim;
                    csv += formatRows($rows.map(grabRow)) + '"';
                    // Data URI
                    var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
                $(this)
                    .attr({
                    'download': filename
                        ,'href': csvData
                        //,'target' : '_blank' //if you want it to open in a new window
                });
                //------------------------------------------------------------
                // Helper Functions 
                //------------------------------------------------------------
                // Format the output so it has the appropriate delimiters
                function formatRows(rows){
                    return rows.get().join(tmpRowDelim)
                        .split(tmpRowDelim).join(rowDelim)
                        .split(tmpColDelim).join(colDelim);
                }
                // Grab and format a row from the table
                function grabRow(i,row){
                     
                    var $row = $(row);
                    //for some reason $cols = $row.find('td') || $row.find('th') won't work...
                    var $cols = $row.find('td'); 
                    if(!$cols.length) $cols = $row.find('th');  
                    return $cols.map(grabCol)
                                .get().join(tmpColDelim);
                }
                // Grab and format a column from the table 
                function grabCol(j,col){
                    var $col = $(col),
                        $text = $col.text();
                    return $text.replace('"', '""'); // escape double quotes
                }
            }
            // This must be a hyperlink
            $("#export").click(function (event) {
                // var outputFile = 'export'
                var outputFile = window.prompt("What do you want to name your output file") || 'export';
                outputFile = outputFile.replace('.csv','') + '.csv'
                 
                // CSV
                exportTableToCSV.apply(this, [$('#dvData>table'), outputFile]);
                
                // IF CSV, don't do event.preventDefault() or return false
                // We actually need this to be a typical hyperlink
            });
        });
    </script>
    
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


