<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Agency - Start Bootstrap Theme</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url(); ?>/vendor/agency/css/styles.css" rel="stylesheet" />
</head>

<body id="page-top" data-numberOfItem="<?= $this->cart->total_items() ?>">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <!-- <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="<?= base_url('vendor/agency/'); ?>assets/img/navbar-logo.svg" /></a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fas fa-bars ml-1"></i></button> -->
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Explore</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Shipment</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
                    <?php if ($this->session->userdata('email')) : ?>

                        <a class="nav-link js-scroll-trigger mr-3" href="<?= base_url('product') ?>"><i class="fas fa-fw fa-shopping-cart"></i>
                            <p class="badge badge-pill badge-warning" id="totalItemOnCart"><?= $this->cart->total_items() ?></p>
                        </a>
                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-warning " data-toggle="dropdown">
                                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">Hello, <?= $name ?></a></li>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item " href="<?= base_url('user/edit') ?>"><i class="fas fa-user-edit"></i> Edit Profile</a>
                                <?php if ($this->session->userdata('role_id') == 1) : ?>
                                    <a class="dropdown-item " href="<?= base_url('admin') ?>"><i class="fas fa-users-cog"></i> Admin Menu</a>
                                <?php else : ?>
                                <?php endif; ?>
                                <hr>
                                <a class="dropdown-item" href="<?= base_url('user/logout') ?>"><i class="fas fa-sign-in-alt"></i> Log Out</a>
                            </div>
                        </div>

                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?= base_url('user/login'); ?>"><i class="fas fa-sign-in-alt"></i> Log In</a></li>

                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>