<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "370_summer23", "blood_donation_services");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_view_campaign_list</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@3.6.1/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" type="text/css" href="admin_view.css">

</head>

<body>


    <div id="page_wrapper">
        <div id="sidenav" class="sidenav">
            <div class="logo_section">

                <h3>BLOOD DONATION</br>SERVICES</h3>
            </div>

            <div class="sidenav_header">
                <a href="admin_view_donor_list.php" class="active_color">
                    <div class="sidenav_link">

                        <h3>DONOR LIST</h3>

                    </div>

                </a>
                <a href="admin_view_user_list.php">
                    <div class="sidenav_link">
                        <h3>USER LIST</h3>
                    </div>
                </a>
                <a href="admin_view_request_list.php">
                    <div class="sidenav_link">
                        <h3>REQUEST LIST</h3>
                    </div>
                </a>
                <a href="admin_view_trusted_hospitals.php">
                    <div class="sidenav_link">
                        <h3>TRUSTED HOSPITALS</h3>
                    </div>
                </a>
                <a href="">
                    <div class="sidenav_link active">
                        <h3>CAMPAIGN LIST</h3>
                    </div>
                </a>
                <a href="admin_view_report_box.php">
                    <div class="sidenav_link">
                        <h3>REPORT BOX</h3>
                    </div>
                </a>
                <a href="admin_view_response_list.php">
                    <div class="sidenav_link">
                        <h3>RESPONSE LIST</h3>
                    </div>
                </a>
            </div>

            <form action="logout.php" method="post">
                <button type="submit">Log Out</button>
            </form>

        </div>
        <main>
            <header>
                <div class="text">
                    <h2 class="head_tran"><span>CAMPAIGNS LIST</span></h2>
                    <p class="head_head">ALL CAMPAIGNS HERE</p>
                </div>
            </header>
            <section class="List">

                <div class="tbl-header">
                    <table>
                        <thead>
                            <tr>
                                <th>Venue Hospital</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Location</th>
                                <th>Ended</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content">
                    <table>
                        <tbody>

                            <?php                                
                                $currentDate = date("Y-m-d");
                                $query = "SELECT c.venue, c.start_date, c.end_date, h.location
                                            FROM campaigns c
                                            JOIN trusted_hospitals h ON c.venue = h.hospital_name
                                            ORDER BY c.end_date ASC";
                                $result = mysqli_query($conn, $query);
                                
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                    echo "<td>". $row['venue'] ."</td>";
                                    echo "<td>". $row['start_date'] ."</td>";
                                    echo "<td>". $row['end_date'] ."</td>";
                                    echo "<td><a href='" . $row['location'] . "' target='_blank'>View on Map</a></td>";
                                    echo "<td>". ($row['end_date'] < $currentDate ? 'Yes' : 'No') ."</td>";
                                    echo "</tr>";
                                }
                            ?>

                        </tbody>
                    </table>
                </div>
            </section>

            <p></br></p>
            <form action="admin_add_campaign.php" method="GET">
                <input class="add" type="submit" value="Add Campaign">
            </form>

        </main>



    </div>



</body>

</html>