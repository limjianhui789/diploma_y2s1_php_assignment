<?php
    require_once("sql_connection.php");
    if(isset($_GET['search']) && isset($_GET['type'])){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if($_GET['search'] == "@active"){
            
            $query = "
            SELECT first_name, last_name, U.username, emailAddress, is_admin, count(B.username) As 'TotalBooking'
            FROM nitro_user U LEFT JOIN nitro_booking B
            ON U.username = B.username
            WHERE U.is_banned = 0
            GROUP BY first_name, last_name, U.username, emailAddress, is_admin
            ORDER BY is_admin DESC, count(B.username) DESC";
            $result = $conn->query($query);
            
            printf('
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="row justify-content-between px-5">
                        <div class="col-lg-auto align-self-center">
                            <p class="m-0 fs-4 fw-semibold text-black">Active Users (%d)</p>
                        </div>
                        <div class="col-lg-7">
                            <div class="form">
                                <i class="bi bi-search"></i>
                                <input type="text" id="search_bar_active" class="form-control form-input" placeholder="Search By Username / Name" onmouseout="searchEvent(\'active-user-table\',this.value, \'@active\');$(this).blur();$(\'#active-user-table\').focus();">
                                <span class="left-pan"><i class="bi bi-calendar3-event"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-11 px-5">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead>
                                <tr class="rec_head" style="color: #A9A9A9;">
                                    <td class="rec_head">Name</td>
                                    <td class="rec_head">Username</td>
                                    <td class="rec_head">Email</td>
                                    <td class="rec_head">Total Bookings</td>
                                    <td class="rec_head text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody id="active-user-table">
                ',$result->num_rows);
                if($result->num_rows > 0){
                    while($row = $result->fetch_object()){
                        printf('
                            <tr class="rec fw-semibold %s shadow-sm">
                                <td>%s %s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td class="text-center">
                                    <form class="mb-0" method="GET" action="user-details.php">
                                        <div class="d-grid">
                                            
                                                <input type="hidden" name="username" value="%s">
                                                <input class="btn btn-manage" type="submit" value="Manage">
                                        
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        ',$row->is_admin == 1 ? "bg-info bg-opacity-25" : "bg-white", $row->first_name, $row->last_name, $row->username, $row->emailAddress,$row->TotalBooking, $row->username);
                    }
                } else {
                    echo '
                    <tr class="rec fw-semibold bg-white shadow-sm">
                        <td colspan="5">Users Not Found</td>
                    </tr>
                    ';
                }
                $result->free();
                
                        printf('
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>');
        }else if($_GET['search'] == "@inactive"){
            $query = "
            SELECT first_name, last_name, U.username, emailAddress, is_admin, count(B.username) As 'TotalBooking'
            FROM nitro_user U LEFT JOIN nitro_booking B
            ON U.username = B.username
            WHERE U.is_banned = 1
            GROUP BY first_name, last_name, U.username, emailAddress, is_admin
            ORDER BY is_admin DESC, count(B.username) DESC";
            $result = $conn->query($query);

            printf('
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="row justify-content-between px-5">
                            <div class="col-lg-auto align-self-center">
                                <p class="m-0 fs-4 fw-semibold text-black">Inactive Users (%d)</p>
                            </div>
                            <div class="col-lg-7">
                                <div class="form">
                                    <i class="bi bi-search"></i>
                                    <input type="text" id="search_bar_inactive" class="form-control form-input" placeholder="Search By Username / Name" onmouseout="searchEvent(\'inactive-user-table\',this.value, \'@inactive\'); $(this).blur(); $(\'#inactive-user-table\').focus();">
                                    <span class="left-pan"><i class="bi bi-calendar3-event"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-11 px-5">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <thead>
                                    <tr class="rec_head" style="color: #A9A9A9;">
                                        <td class="rec_head">Name</td>
                                        <td class="rec_head">Username</td>
                                        <td class="rec_head">Email</td>
                                        <td class="rec_head">Total Bookings</td>
                                        <td class="rec_head text-center">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="inactive-user-table">
            ', $result->num_rows);

            if($result->num_rows > 0){
                while($row = $result->fetch_object()){
                    printf('
                        <tr class="rec fw-semibold %s shadow-sm">
                            <td>%s %s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td class="text-center">
                                <form class="mb-0" method="GET" action="user-details.php">
                                    <div class="d-grid">
                                        
                                            <input type="hidden" name="username" value="%s">
                                            <input class="btn btn-manage" type="submit" value="Manage">
                                    
                                    </div>
                                </form>
                            </td>
                        </tr>
                    ',$row->is_admin == 1 ? "bg-secondary bg-opacity-25" : "bg-white", $row->first_name, $row->last_name, $row->username, $row->emailAddress,$row->TotalBooking, $row->username);
                }
            } else {
                echo '
                <tr class="rec fw-semibold bg-white shadow-sm">
                    <td colspan="5">Users Not Found</td>
                </tr>
                ';
            }

            printf('
                        </tbody>
                    </table>
                </div>
            </div>
            ');
        }else{
            if($_GET['type'] == "@active"){
                $query = "
                SELECT first_name, last_name, U.username, emailAddress, is_admin, count(B.username) As 'TotalBooking'
                FROM nitro_user U LEFT JOIN nitro_booking B
                ON U.username = B.username
                WHERE U.is_banned = 0 AND (U.username LIKE '%{$_GET['search']}%' OR (first_name LIKE '%{$_GET['search']}%' OR last_name LIKE '%{$_GET['search']}%'))
                GROUP BY first_name, last_name, U.username, emailAddress, is_admin
                ORDER BY is_admin DESC, count(B.username) DESC";
            }else{
                $query = "
                SELECT first_name, last_name, U.username, emailAddress, is_admin, count(B.username) As 'TotalBooking'
                FROM nitro_user U LEFT JOIN nitro_booking B
                ON U.username = B.username
                WHERE U.is_banned = 1 AND (U.username LIKE '%{$_GET['search']}%' OR (first_name LIKE '%{$_GET['search']}%' OR last_name LIKE '%{$_GET['search']}%'))
                GROUP BY first_name, last_name, U.username, emailAddress, is_admin
                ORDER BY is_admin DESC, count(B.username) DESC";
            }
            
            $result = $conn->query($query);

            if($result->num_rows > 0){
                while($row = $result->fetch_object()){
                    if($row->is_admin == 1){
                        if($_GET['type'] == "@active"){
                            $bg_color = "bg-info bg-opacity-25";
                        }else{
                            $bg_color = "bg-secondary bg-opacity-25";
                        }
                    } else {
                        $bg_color = "bg-white";
                    }
                    printf('
                        <tr class="rec fw-semibold %s shadow-sm">
                            <td>%s %s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td class="text-center">
                                <form class="mb-0" method="GET" action="user-details.php">
                                    <div class="d-grid">
                                        
                                            <input type="hidden" name="username" value="%s">
                                            <input class="btn btn-manage" type="submit" value="Manage">
                                    
                                    </div>
                                </form>
                            </td>
                        </tr>
                    ',$bg_color, $row->first_name, $row->last_name, $row->username, $row->emailAddress,$row->TotalBooking, $row->username);
                }
            } else {
                echo '
                <tr class="rec fw-semibold bg-white shadow-sm">
                    <td colspan="5">Users Not Found</td>
                </tr>
                ';
            }
        }
        $conn->close();
    }
?>