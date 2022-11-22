<?php include("config.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="robots" content="noindex">
    <title>Chatphet - System</title>
    <link rel="icon" href="favicon.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    .modal_load {
        display:    none;
        position:   fixed;
        z-index:    1000;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: rgba( 255, 255, 255, .8 )
                    url('https://chatphet.com/system/image/loading.gif')
                    50% 50%
                    no-repeat;
    }
    body.loading {
        overflow: hidden;
    }
    body.loading .modal_load {
        display: block;
    }
    </style>
    <!-- Custom styles for this template -->
    <link href="dist/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
<div class="modal_load"></div>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Chatphet System</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="overflow-y: auto;">
      <div class="position-sticky pt-3">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>ออเดอร์</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <?php
              $result=mysqli_query($con,"SELECT * FROM order_table WHERE status=0");
              $num=mysqli_num_rows($result);
             ?>
            <a class="nav-link" href="main.php?page=4">
              <span data-feather="file-text"></span>
              ออเดอร์ใหม่ <font color='#dc3545'>(<?php echo $num; ?>)</font>
            </a>
          </li>
          <li class="nav-item">
            <?php
              $result=mysqli_query($con,"SELECT * FROM order_table WHERE status=1");
              $num=mysqli_num_rows($result);
             ?>
            <a class="nav-link" href="main.php?page=7">
              <span data-feather="file-text"></span>
              ที่ต้องแพ็ค <font color='#dc3545'>(<?php echo $num; ?>)</font>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=23">
              <span data-feather="file-text"></span>
              รายการสินค้าที่ต้องสั่ง
            </a>
          </li>
          <!--<li class="nav-item">
            <?php
              /*$result=mysqli_query($con,"SELECT * FROM order_table WHERE status=2");
              $num=mysqli_num_rows($result);*/
             ?>
            <a class="nav-link" href="main.php?page=10">
              <span data-feather="file-text"></span>
              รอบันทึกลงบัญชี <font color='#dc3545'>(<?php //echo $num; ?>)</font>
            </a>
          </li>-->
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>สินค้า</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=1">
              <span data-feather="file-text"></span>
              รายการสินค้า
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=24">
              <span data-feather="file-text"></span>
              หมวดหมู่สินค้า
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=18">
              <span data-feather="file-text"></span>
              สินค้าแบบกลุ่ม
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=12">
              <span data-feather="file-text"></span>
              รายงานวันหมดอายุ
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=13">
              <span data-feather="file-text"></span>
              รายงานสินค้าหมดสต๊อก
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=14">
              <span data-feather="file-text"></span>
              สินค้าขายดี
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=16">
              <span data-feather="file-text"></span>
              สินค้าขายไม่ได้
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=21">
              <span data-feather="file-text"></span>
              สินค้าเข้าใหม่
            </a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link" href="main.php?page=11">
              <span data-feather="file-text"></span>
              ตรวจนับสินค้า
            </a>
          </li>-->
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>รายงาน</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=17">
              <span data-feather="file-text"></span>
              Run stock
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="main.php?page=3">
              <span data-feather="file-text"></span>
              Upload stock
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.allkaset.com/Include_Resale2/excel_new.php" target="_blank">
              <span data-feather="file-text"></span>
             Stock Allkaset
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="excel_new.php" target="_blank">
              <span data-feather="file-text"></span>
              Export stock Shopee
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="excel_new_group.php" target="_blank">
              <span data-feather="file-text"></span>
              Export Shopee Group
            </a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link" href="excel_newlz.php" target="_blank">
              <span data-feather="file-text"></span>
              Export stock Lazada
            </a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="excel_newlz2.php" target="_blank">
              <span data-feather="file-text"></span>
              Export stock Lazada (New Version)
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?page=22">
              <span data-feather="file-text"></span>
              คำนวณค่าธรรมเนียม
            </a>
          </li>
        </ul>

      </div>

    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <?php
        switch ($_REQUEST['page']) {
          case 1: require("Product/index.php"); break;
          case 2: require("Product/stock.php"); break;
          case 3: require("Product/outsource_stock.php"); break;
          case 4: require("Order/index.php"); break;
          case 5: require("Order/new_order.php"); break;
          case 6: require("Order/order_detail.php"); break;
          case 7: require("Order/pack.php"); break;
          case 8: require("Order/pack_detail.php"); break;
          case 9: require("Product/upload_pic.php"); break;
          case 10: require("Order/ordertoaccount.php"); break;
          case 11: require("Product/liststock.php"); break;
          case 12: require("Product/report_exp.php"); break;
          case 13: require("Product/report_outstock.php"); break;
          case 14: require("Product/report_hotitem.php"); break;
          case 15: require("Product/report_hotitem_detail.php"); break;
          case 16: require("Product/report_nosale.php"); break;
          case 17: require("Product/runstock.php"); break;
          case 18: require("Product/product_group.php"); break;
          case 19: require("Product/product_group_detail.php"); break;
          case 20: require("Product/report_hotitem_all.php"); break;
          case 21: require("Product/import_product.php"); break;
          case 22: require("Report/fee.php"); break;
          case 23: require("Order/list_ordering.php"); break;
          case 24: require("Product/category.php"); break;
          default: require("dashboard.php"); break;
        }
       ?>
    </main>
  </div>
</div>

  <script src="dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="" crossorigin="anonymous"></script>
  <script src="dist/js/jquery-3.6.0.min.js"></script>
  <script src="dist/js/dashboard.js"></script>
  <script src="dist/js/myfunction.js?v=3.9"></script>
  </body>
</html>
