
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <!-- <div class="masthead-subheading">Your Cart</div>
            <div class="masthead-heading text-uppercase">Your Information Will Be Kept A Secret </div> -->
            <div class="masthead-heading text-uppercase">Your Cart </div>
        </div>
    </header>
    <!-- Outer Row -->
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
                                    <th>QTY</th>
                                    <th>Item Description</th>
                                    <th style="text-align:right">Item Price</th>
                                    <th style="text-align:right">Sub-Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>

                                <?php foreach ($this->cart->contents() as $items) : ?>

                                    <?php echo form_open('product/updatecart'); ?>
                                    <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                                    <?php echo form_hidden($i . '[itemid]', $items['id']); ?>



                                    <tr>
                                        <td><?php echo form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '1', 'class' => "form-control")); ?></td>
                                        <td>
                                            <?php if ($this->cart->has_options($items['rowid']) == TRUE) : ?>
                                                <div class="row">
                                                    <div class="col-lg col-md col-sm">
                                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) : ?>

                                                            <?php if ($option_name == 'Image') : ?>
                                                                <img src="<?= base_url() ?>assets/img/product/<?= $option_value ?>" alt="Product Image" class="img-thumbnail" style="
                                                                width: 200px;
                                                                margin: 0;
                                                                padding: 0;
                                                                object-fit:cover;
                                                            ">
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="col-lg col-md col-sm">

                                                        <h5>
                                                            Name : <?php echo ucwords($items['name']); ?>
                                                        </h5>
                                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) : ?>
                                                            <?php if ($option_name != 'Image') : ?>
                                                                <p>Weight: <?= $option_value ?> Ons</p>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>

                                                <?php endif; ?>

                                        </td>
                                        <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
                                        <td style="text-align:right">Rp. <?= $this->cart->format_number($items['subtotal']) ?></td>
                                        <td><a href="<?= base_url('product/removeproduct') ?>/<?= $items['rowid'] ?>"><i class="fas fa-fw fa-trash-alt"></i></a></td>
                                    </tr>

                                    <?php $i++; ?>

                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="float-right"><strong>Total</strong></td>
                                    <td>Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></td>
                                </tr>
                            </tbody>



                        </table>


                    </div>
                </div>
                <div class="card-footer text-muted">
                    <?php echo form_hidden('numberOfProducts', $i) ?>
                    <p><?php echo form_submit('update', 'Update your Cart', ['class' => 'btn btn-primary float-left']); ?></p>
                    <?= form_close(); ?>
                    <a href="<?= base_url('product/checkout') ?>" class="float-right btn btn-success text-white">Checkout</a>
                </div>
            </div>

        </div>

    </div>