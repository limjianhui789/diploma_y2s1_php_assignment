    
    <!-- Side Phone Menu -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="phone_menu" >
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">

            <!-- Logo -->
            <div class="row mt-3 mb-3">
                <img src="image/transparent-logo.png" class="logo-cropped mx-auto d-block img-fluid" alt="Logo"/>
            </div>

            <!-- Logo -->

            <!-- Name Card -->
            <div class="row d-flex justify-content-center">
                <div class="col-3 d-flex justify-content-center px-0 align-self-center">
                    <i class="bi bi-person-circle fs-2"></i>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col px-0">
                            <p class="fw-bold mb-0 px-2">
                                <?php    
                                    if(isset($_SESSION['username'])){
                                        echo $_SESSION['username'];
                                    }else{
                                        session_start();
                                        echo $_SESSION['username'];
                                    }
                                    
                                ?>
                            </p>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-auto px-0">
                            <p class="fw-light mb-0 px-2"><span class="badge bg-secondary">Administrator</span></p>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Name Card -->

            <hr>

            <!-- Dashboard Btn -->
            <div class="row d-flex mb-3">
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="button" class="btn btn-primary" onclick="document.location='./#dashboard';return false;">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                Dashboard
                            </div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-house"></i>
                            </div>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Events Btn -->
            <div class="row d-flex mb-3">
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#events">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                Event Management
                            </div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-calendar2-event"></i>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
            <!-- Events Btn -->

            <!-- Hidden Events Btn -->
            <div class="row collapse mb-1" id="events">
                <div class="col d-grid mx-auto gap-2">
                    <button type="button" class="btn btn-secondary" onclick="document.location='./event-list.php';return false;">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <i class="bi bi-arrow-right"></i> Manage Events
                            </div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-list"></i>
                            </div>
                        </div>
                    </button>
                </div>
            </div>

            <div class="row collapse mb-1" id="events">
                <div class="col d-grid mx-auto gap-2">
                    <button type="button" class="btn btn-secondary"  onclick="document.location='./event-add.php';return false;">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <i class="bi bi-arrow-right"></i> Add New Event
                            </div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-plus-lg"></i>
                            </div>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Hidden Events Btn End -->

            <!-- Category Management Btn -->
            <div class="row d-flex mb-3">
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="button" class="btn btn-primary" onclick="location.href = './category-management.php'">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                Category Management
                            </div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-bookmarks"></i>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
            <!-- Category Management Btn -->

            <!-- Venue Management Btn -->
            <div class="row d-flex mb-3">
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="button" class="btn btn-primary" onclick="location.href = './venue-management.php'">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                Venue Management
                            </div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-building"></i>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
            <!-- Venue Management Btn -->

            <!-- Booking Management Btn -->
            <div class="row d-flex mb-3">
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="button" class="btn btn-primary" onclick="location.href = './booking-management.php'">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                Booking Management
                            </div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-layout-text-window-reverse"></i>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
            <!-- Booking Management Btn -->

            <!-- User Management Btn -->
            <div class="row d-flex mb-3">
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="button" class="btn btn-primary" onclick="location.href = './user-management.php'">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                User Management
                            </div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-person-square "></i>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
            <!-- User Management Btn -->

            <!-- Logout Btn -->
            <form action="includes/logout.php" method="POST">
                <div class="row d-flex mb-3">
                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn btn-primary" name="logout" id="logout">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <label for="logout">Logout</label>
                                </div>
                                <div class="col-auto align-self-center">
                                    <i class="bi bi-box-arrow-left"></i>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    <div class="position-fixed start-0 top-0 ps-3 pt-3" style="z-index: 999;">
        <button class="btn bg-secondary opacity-75" type="button" data-bs-toggle="offcanvas" data-bs-target="#phone_menu">
            <i class="bi bi-three-dots fs-5 text-white"></i>
        </button>
    </div>