<?php
ob_start();
session_start();
include("admin/config.php");
include("includes/functions.php");
$error_message = '';
$success_message = '';
?>
<?php
// Getting the basic data for the website from database
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
    $logo = $row['logo'];
    $favicon = $row['favicon'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
     <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
        foreach ($result as $row) 
        {
            echo '<meta name="description" content="'.$row['meta_description_home'].'">';
            echo '<meta name="keywords" content="'.$row['meta_keyword_home'].'">';
            echo '<title>'.$row['meta_title_home'].'</title>';
        }
    ?>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/uploads/<?php echo $favicon; ?>">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="<?php echo BASE_URL; ?>">
                                    <img src="assets/uploads/<?php echo $logo; ?>" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="<?php echo BASE_URL; ?>">home</a></li>
                                        <li><a href="my-arts.php">My Arts</a></li>
                                        <li><a href="blog.php">blog <i class="ti-angle-down"></i></a>
                                        <li><a href="mailto:contact.rf.gd">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->