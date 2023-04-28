<?php
    session_start();
 
                
    if(!isset($_SESSION['username'])){
         die("Illegal Access");
    } 
    
    //echo $_SESSION['username'];

    $username = $_POST['username'];
    $eventID = $_POST['eventID'];
    $eventName = $_POST['eventName'];
    $eventPrice = $_POST['eventPrice'];
    $eventStartDate = $_POST['bookingDate'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="image/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.min.js" integrity="sha512-8Y8eGK92dzouwpROIppwr+0kPauu0qqtnzZZNEF8Pat5tuRNJxJXCkbQfJ0HlUG3y1HB3z18CSKmUo7i2zcPpg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Animation PlugIn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://kendo.cdn.telerik.com/2017.1.223/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2017.1.223/js/jszip.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2017.1.223/js/kendo.all.min.js"></script>

    <!-- Swiper JS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
    <!--Extention for export the html-->
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.1.118/styles/kendo.common-material.min.css"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.1.118/styles/kendo.material.min.css"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.1.118/styles/kendo.material.mobile.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js"></script>

    <link rel="stylesheet" href="css/invoice.css" type="text/css"/>

    <title>Invoice</title>
<script type="text/javascript">
    window.html2canvas = html2canvas;
    window.jsPDF = window.jspdf.jsPDF;

    function makePDF(){

        html2canvas(document.querySelector(".pdf-page"),{
            allowTaint:true,
            userCORS:true,
            scale: 1
        }).then(canvas =>{
            var img = canvas.toDataURL("image/png");
            var doc = new jsPDF();
            doc.addImage(img,'PNG',10,10,195,280) //left right padding , top bottom padding , center left right, center top bottom
            doc.save("Nitro_Society_Invoice");
    });

}
</script>

</head>
<body>
    
<div class="container mt-5 mb-5 pt-5 whole-container">
    <div class="page-container hidden-on-narrow container">
        <div class="pdf-page size-a4">
          <div class="container mt-3 invoice-all-content">
            <div class="row header-content">
                <div class="col-lg-6 m-3">
                    <div class="header">
                        <h1>INVOICE</h1>
                    </div>
                </div>
                <div class="col-lg-5  d-flex align-self-end justify-content-end">
                    <div class="inv-num">
                        <p>Invoice.Num <span>#</span><span>12345</span></p>
                    </div>
                </div>
                <div class="row">
                    <hr>
                </div>
            </div>
            <div class="row company-information mt-2 ">
                <div class="row society-img">
                    <img id="imageLogo" src="./clientImage/clientLogo/transparentBlackText.png" alt="">
                </div>
                <div class="col-lg-5">
                   <div class="society-content">
                        <div class="society-address">
                            <h3 id="societyName">Nitro TAR UC Society</h3>
                            <p class="address">
                                77, Lorong Lembah Permai<br />
                                11200 Tanjung Bungah <br />
                                Pulau Pinang
                            </p>
                        </div>
                   </div>
                </div>

                <div class="col-lg-2 d-flex justify-content-end">
                    <div class="user-content">
                        <div class="row list-title">Username</div>
                        <div class="row list-title">Name</div>
                        <div class="row list-title">Contact Number</div>
                        <div class="row list-title">Email</div>
                        <div class="row list-title">Role</div>
                   </div>
                </div>

                <div class="col-lg-1 d-flex justify-content-end">
                    <div class="user-content">
                        <div class="row dot">:</div>
                        <div class="row dot">:</div>
                        <div class="row dot">:</div>
                        <div class="row dot">:</div>
                        <div class="row dot">:</div>
                   </div>
                </div>

<?php
            require_once('./includes/database-connector.php');

            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($con->connect_error);
            $query = "  SELECT username, password, emailAddress, contactNum, first_name,last_name, gender,
                        CASE
                          WHEN is_admin = 1 THEN 'Admin'
                          ELSE 'Client'
                        END AS is_admin,is_banned
                        FROM nitro_user
                        WHERE username = '{$username}' AND is_banned = 0
                        ";

            $result = $conn->query($query);
            while($row = $result->fetch_object()){
              //print_r($row);

              $username = $row->username;
              $emailAddress = $row->emailAddress;
              $contactNum = $row->contactNum;
              $first_name = $row->first_name;
              $last_name = $row->last_name;
              $is_admin = $row->is_admin;

              printf('
              <div class="col-lg-4">
                <div class="user-content">
                  <div class="row info">%s</div>
                  <div class="row info">%s</div>
                  <div class="row info">%s</div>
                  <div class="row info">%s</div>
                  <div class="row info">%s</div>
                </div>
              </div>
              ',$last_name,$username,$contactNum,$emailAddress,$is_admin);

            }

            $result->free();

?>
                
            </div>


            <div class="row company-information mt-3">
                <div class="col-lg-3">
                    
                </div>

                <div class="col-lg-4 d-flex">
                    <div class="invoice-content">
                        <div class="row list-invoice">invoice</div>
                        <div class="row list-invoice">Booking Date</div>
                   </div>
                </div>

                <div class="col-lg-1 d-flex justify-content-end">
                    <div class="user-content">
                        <div class="row dot">:</div>
                        <div class="row dot">:</div>
                   </div>
                </div>

                <div class="col-lg-4">
                    <div class="user-content">
                        <div class="row info-invoice">#12345</div>
<?php
$query = "SELECT *
         FROM nitro_event
         WHERE eventID = '{$eventID}'
        ";
        
$result = $conn->query($query);

while($row = $result->fetch_object()){
  //print_r($row);

  $eventStartDate = $row->eventStartDate;

  printf('<div class="row info-invoice">%s</div>',$eventStartDate);
}
?>
                   </div>
                </div>
            </div>

            
          </div>
          

          <div class="pdf-footer" style="z-index: 5;" >
            <p>Nitro TAR UC Society<br />
                77, Lorong Lembah Permai<br />
                11200 Tanjung Bungah <br />
                Pulau Pinang
            </p>
          </div>

          <div class="pdf-body" ">
            <div id="grid" data-role="grid" class="k-grid k-widget" style>

            </div>
    
            <div class="kakao"></div>
          </div>

    
        </div>
      </div>
      <div class="responsive-message"></div>

      <div id="button-invoice" class="container mt-3 d-flex justify-content-end">
        <div class="box wide hidden-on-narrow">
            <div class="box-col m-3">
              <button class="export-pdf k-button" onclick="makePDF()">Export</button>
            </div>
        </div>
      </div>
</div>



<script src="js/invoice.js"></script>
<!--Swiper JS-->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<!-- Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</script>
<script>
    function getPDF(selector) {
    kendo.drawing.drawDOM($(selector)).then(function(group){
      kendo.drawing.pdf.saveAs(group, "Invoice.pdf");
    });
  }
  
  function getPrint(selector) {
    w = window.open();
    w.document.write($(selector).html());
    w.print();
    w.close();
  }
  
  $(document).ready(function() {
    var eventName = "<?php echo"$eventName"?>";
    var eventPrice = "<?php echo"$eventPrice" ?>";
    
    var data = [
      { productName: eventName , unitPrice: eventPrice, qty: 1 },
    ];
    var schema = {
      model: {
        productName: { type: "string" },
        unitPrice: { type: "number", editable: false },
        qty: { type: "number" }
      },
      parse: function (data) {
        $.each(data, function(){
          this.total = this.qty * this.unitPrice;


        });
        return data;
      }
    };
    var aggregate = [
      { field: "qty", aggregate: "sum" },
      { field: "total", aggregate: "sum" }
    ];
    var columns = [
      { field: "productName", title: "Event", footerTemplate: "Total"},
      { field: "unitPrice", title: "Price (RM)", width: 120},
      { field: "qty", title: "Quantity", width: 120, aggregates: ["sum"], footerTemplate: "#=sum#" },
      { field: "total", title: "Total (RM)", width: 120, aggregates: ["sum"], footerTemplate: "#=sum#" }
    ];
    var grid = $("#grid").kendoGrid({
      editable: false,
      sortable: true,
      dataSource: {
        data: data,
        aggregate: aggregate,
        schema: schema,
      },
      columns: columns
    });
  
    $("#paper").kendoDropDownList({
      change: function() {
        $(".pdf-page")
          .removeClass("size-a4")
          .removeClass("size-letter")
          .removeClass("size-executive")
          .addClass(this.value());
      }
    });
  });
</script>
</body>
</html>