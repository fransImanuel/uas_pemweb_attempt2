<div class="main-panel" id="main-panel">

    <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <div class="navbar-toggle">
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="row ">
        <div class="col-lg-11 col-md mt-4 ml-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Anjay Gurinjay!</h5>
                    <h4 class="card-title">Transaction History</h4>
                </div>
                <div class="card-body m-4">
                    <div class="container">
                        <div class="form-group">
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Delivery Address</th>
                                <th scope="col">Delivery Post</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($history as $h) : ?>
                                <tr>
                                    <th scope="row"><?= $h['email'] ?></th>
                                    <td><?= $h['transaction_date'] ?></td>
                                    <td><?= $h['total_price'] ?></td>
                                    <td><?= $h['delivery_address'] ?></td>
                                    <td><?= $h['delivery_post'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    </tbody>
                    </table>

                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>