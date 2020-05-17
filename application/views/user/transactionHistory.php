<!-- Masthead-->
<header class="masthead">
    <div class="container">
        <div class="masthead-heading text-uppercase">Transaction History</div>
    </div>
</header>

<div class="row justify-content-center mt-5">

    <div class="col-lg-11 col-md col-sm mt-4 ml-4">
        <?= $this->session->flashdata('message'); ?><strong><?= $this->session->flashdata('keterangan'); ?></strong>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <table class="table table-hover m-3">
                        <thead class="thead-dark">
                            <tr>
                                <th>Queue</th>
                                <th>Transaction Date</th>
                                <th>Total Weight</th>
                                <th>Total Price</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($transaction as $t) : ?>
                                <tr>
                                    <th><?= $i + 1; ?></th>
                                    <th>
                                        <p class="font-weight-normal"> <?= $transaction[$i]['transaction_date'] ?></p>
                                    </th>
                                    <th>
                                        <p class="font-weight-normal">
                                            <?= $transaction[$i]['total_weight'] ?> <span class="font-weight-lighter"> Ons..</span>
                                        </p>
                                    </th>
                                    <th>
                                        <p class="font-weight-normal">
                                            Rp. <?= number_format($transaction[$i]['total_price'], 2, ",", ".")  ?>
                                        </p>
                                    </th>
                                    <th>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#details<?= $i ?>">
                                            <i class="fas fa-fw fa-info-circle"></i>
                                        </button>
                                        <!-- Modal Details<?= $i ?> -->
                                        <div class="modal fade " id="details<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="details<?= $i ?>Label">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="details<?= $i ?>Label">Header</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-striped table-hover ">
                                                            <thead class="">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Name</th>
                                                                    <th>Category</th>
                                                                    <th>Quantity</th>
                                                                    <th>Weight</th>
                                                                    <th>Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $t = 1;
                                                                foreach ($transaction[$i]['details' . $i] as $a) : ?>
                                                                    <tr>
                                                                        <th><?= $t++; ?></th>
                                                                        <th><?= ucwords($a['item_name']) ?></th>
                                                                        <th><?= $a['category_name'] ?></th>
                                                                        <th><?= $a['item_quantity'] ?></th>
                                                                        <th class="font-weight-lighter"><?= $a['weight'] ?> Ons..</th>
                                                                        <th>Rp. <?= number_format($a['price'], 2, ",", ".") ?></th>
                                                                    </tr>
                                                                <?php endforeach;
                                                                $t = 0; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Understood</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </th>

                                </tr>
                            <?php $i++;
                            endforeach; ?>
                        </tbody>



                    </table>


                </div>
            </div>
            <div class="card-footer text-muted">
                cARD FOOTER
            </div>
        </div>

    </div>

</div>