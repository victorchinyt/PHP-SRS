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
<body data-ng-controller = "postCtrl">
    <div class="container">
        
        <?php
			include("header.php");
		?>
        
        <div class="row">
            <div class="col-md-12">
                <h1>Sale Record</h1>
                <div class="row">
                    <div class="col-sm-1">
                        <p><strong>Sale ID: </strong></p>
                    </div>
                    <div class="col-sm-11">
                        <input type="text" name="sid" data-ng-model="#ID" />
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-sm-1">
                        <p><strong>Date: </strong></p>
                    </div>
                    <div class="col-sm-11">
                        <input type="date" name="date" data-ng-model="#date" />
                    </div>
                </div><br/>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Sale ID</th>
                            <th>Date</th>
                            <th>Amount(RM)</th>
                        </tr>
                        <tr data-ng-repeat="s in sales | filter:sale">
                            <td>{{#sid}}</td>
                            <td>{{#date}}</td>
                            <td>RM{{amount | number:2}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div> 
    </div>
	<script src="js/angular.min.js"></script>
	<script src="js/angular-route.min.js"></script>
	<script src="js/appmenu.js"></script>
    <script src="js/script.js"></script>
</body>
</html>

