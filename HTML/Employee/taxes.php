<?php
	include("../../Config.php");
		$error = "";
	include("../../Include/Employee_p_check.php");
	include("../../Include/finances.php");
?>

<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>My Taxes</title>
        <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../CSS/homepage.css">
    </head>
    <body>
        <div class="container-fluid full-page">
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Home')" id="Home">Home</button>
                <button class="tablinks" onclick="openTab(event, 'My Info')" id="My Info">My Info</button>
                <button class="tablinks" onclick="openTab(event, 'My Benefits')" id="My Benefits">My Benefits</button>
                <button class="tablinks currentPage" onclick="openTab(event, 'My Taxes')" id="My Taxes">My Finances</button>
                <button class="tablinks" onclick="openTab(event, 'Contact')" id="Contact">Contact</button>
                <button class="tablinks" onclick="logOut()" id="Log Out">Log Out</button>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <img src="../../Images/Employee_Pictures/<?php echo $_SESSION['ID']?>.jpg" class="profile-pic">
                </div>
                <div class="col-sm-10 ">
                    <h1>Welcome Back, <?php echo $_SESSION['First_Name'] . " " . $_SESSION['Last_Name'] . "<br>"; ?></h1>
                    <h5>Employee at Blah Hospital</h5>
                </div>
            </div>
            <div class="row">
                <div id="My Taxes" class="tabcontent">
                    <h5 style="padding-top: 10px;">My Paycheck</h5>
                    <table class="table table-bordered table-active">
                        <tbody>
                            <tr>
                                <td style="padding-top: 10px;">Express Medical</td>
                                <td><?php echo $_SESSION['First_Name'] . " " . $_SESSION['Last_Name'] ?></td>
                            </tr>
                            <tr>
                                <td>5500 Hylan Blvd</td>
                                <td><?php echo $_SESSION['Address'] ?></td>
                            </tr>
                            <tr>
                                <td>Staten Island, NY, 10306</td>
                                <td><?php echo $_SESSION['City'] . " " . $_SESSION['State'] . " " . $_SESSION['Zip_Code'] ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row" id="ele">
                        <div class="col-4">
                            <table class="table table-bordered table-active" id="printTable">
                                <thead>
                                    <tr>
                                        <th class="bg-primary" scope="colgroup" colspan="2">Payments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                    $sql_pay = ' SELECT * FROM Employee_Finance WHERE ID  = "' . $_SESSION['ID'] . ' " ';
                                    $result = mysqli_query($dbc,$sql_pay);
                                    $row_cnt = mysqli_num_rows($result);
                                    $row = mysqli_fetch_assoc($result);


                                    if ($row_cnt > 0)
                                    {
                                        $gross_income = $row["Gross_Pay"];
                                    }
                                    else
                                    {
                                        echo "0 results";
                                    }

                                    $sql = ' SELECT * FROM Healthcare WHERE ID = " ' . $_SESSION['ID'] . ' " ';
                                    $result = mysqli_query($dbc,$sql);
                                    $row_cnt = mysqli_num_rows($result);
                                    $row = mysqli_fetch_assoc($result);

                                    if ($row_cnt > 0)
                                    {
                                        $married = $row['Marital_Status'];
                                        $children = $row['Children'];
                                        $k401 = $row['401k'];
                                        $health = $row['Healthcare_Plan'];
                                        $dental = $row['Dental'];
                                        $optical = $row['Optical'];
                                        $lifeInsurance = $row['Life_Insurance_Plan'];
                                    }
                                    else
                                    {
                                        echo "0 results";
                                    }

                                    list($finances,$benefits) = generate_finances($gross_income,$married,$children,$k401,$health,$dental,$optical,$lifeInsurance); ?>

                                    <tr>
                                        <td>Regular Pay</td>
                                        <?php
                                            $gross = number_format($benefits["gross_income"], 2);
                                            echo "<td>" . $gross . "</td>";
                                        ?>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-4">
                            <table class="table table-bordered table-active" id="printTable1">
                                <thead>
                                    <tr>
                                        <th class="bg-primary" scope="colgroup" colspan="2">Benefits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $totalbenefits = 0;
                                        foreach($benefits as $k => $v) {
                                            if($k != "gross_income" && $k != "taxable_income") {
                                                $v = number_format($v, 2);
                                                $totalbenefits += $v;
                                                echo "<tr>";
                                                echo "<td>" . $k . "</td>";
                                                echo "<td>" . $v ."</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-4">
                            <table class="table table-bordered table-active" id="printTable2">
                                <thead>
                                    <tr>
                                        <th class="bg-primary" scope="colgroup" colspan="2">Deductions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $totaldeductions = 0;
                                        foreach($finances as $k => $v) {
                                            if($k != "PRETAXbiweeklypay" && $k != "NETbiweeklypay") {
                                                $v = number_format($v, 2);
                                                $totaldeductions += $v;
                                                echo "<tr>";
                                                echo "<td>" . $k . "</td>";
                                                echo "<td>" . $v . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <table class="table table-bordered table-active" id="printTable3">
                        <thead>
                            <tr class="bg-primary">
                                <th>Gross Pay</th>
                                <th>Benefits</th>
                                <th>Deductions</th>
                                <th>Net Pay</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    echo "<td>" . $gross . "</td>";
                                    echo "<td>" . $totalbenefits . "</td>";
                                    echo "<td>" . $totaldeductions . "</td>";
                                    $netpay = number_format($finances["NETbiweeklypay"], 2);
                                    echo "<td>" . $netpay . "</td>";
                                ?>
                            </tr>
                        </tbody>
                    <table>                                
                </div>
            </div><a href="#" onclick="printData()">Print</a>
        </div>
		
		<script type ="">
				function printData()
				{
					var divToPrint=document.getElementById("printTable");
					var divToPrint1=document.getElementById("printTable1");
					var divToPrint2=document.getElementById("printTable2");
					var divToPrint3=document.getElementById("printTable3");
					newWin= window.open("");
					newWin.document.write(divToPrint.outerHTML, divToPrint1.outerHTML, divToPrint2.outerHTML, divToPrint3.outerHTML);
					newWin.print();
					newWin.close();
				}
		</script>
        
        <script type="text/javascript">
            document.getElementById("Home").onclick = function () {
                location.href = "./homepage.php";
            };
            document.getElementById("My Info").onclick = function () {
                location.href = "./info.php";
            };
            document.getElementById("My Benefits").onclick = function () {
                location.href = "./benefits.php";
            };
            document.getElementById("My Taxes").onclick = function () {
                location.href = "./taxes.php";
            };
            document.getElementById("Contact").onclick = function () {
                location.href = "./contact.php";
            };

            function logOut() {
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = '../../index.php';
                } 
            }
        </script>
    </body>
</html>