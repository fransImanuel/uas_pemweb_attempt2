<body>
    <div class="wrapper ">
        <div class="sidebar" data-color="yellow">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    <i class="fas fa-fw fa-users-cog"></i>
                </a>
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    Admin
                </a>
            </div>
            <div class="sidebar-wrapper" id="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="<?= base_url('admin') ?>">
                            <i class="now-ui-icons design_app"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/create') ?>">
                            <i class="now-ui-icons ui-1_simple-add"></i>
                            <p>Add Product</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/productlist') ?>">
                            <i class="now-ui-icons location_map-big"></i>
                            <p>Product List</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/userlist') ?>">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>Registered List</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="<?= base_url('admin/transactionHistory'); ?>">
                            <i class="now-ui-icons arrows-1_minimal-left"></i>
                            <p>Transaction History</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="<?= base_url('user'); ?>">
                            <i class="now-ui-icons arrows-1_minimal-left"></i>
                            <p>Back to User Page</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>