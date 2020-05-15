 <div class="main-panel" id="main-panel">
     <!-- Navbar -->
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
                 <a class="navbar-brand" href="#pablo">Dashboard</a>
             </div>
         </div>
     </nav>

     <div class="row ">
         <div class="col-lg-10 col-md mt-4 ml-4">
             <div class="card card-chart">
                 <div class="card-header">
                     <h5 class="card-category">Global Sales</h5>
                     <h4 class="card-title">Add Products</h4>
                 </div>
                 <div class="card-body m-4">
                     <div class="chart-area">
                         <?= $this->session->flashdata('message'); ?>
                         <form action="<?= base_url('admin/editProduct/') . $id ?>" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <label for="productname">Product Name</label>
                                 <?php echo form_error('productname', '<small class="text-danger "> *', '</small>'); ?>
                                 <input name="productname" type="text" class="form-control" id="productname" value="<?= $product['item_name'] ?>">
                             </div>
                             <label for="productimage">Product Image</label>
                             <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="productimage" name="productimage" value="<?= $product['item_image'] ?>">
                                 <label class="custom-file-label" for="productimage">Choose Image</label>
                             </div>
                             <div class="form-group">
                                 <label for="productprice">Product Price</label>
                                 <?php echo form_error('productprice', '<small class="text-danger "> *', '</small>'); ?>
                                 <input name="productprice" type="text" class="form-control" id="productprice" value="<?= $product['item_price'] ?>">
                             </div>
                             <div class="form-group">
                                 <label for="productstock">Stock</label>
                                 <?php echo form_error('productstock', '<small class="text-danger "> *', '</small>'); ?>
                                 <input name="productstock" type="text" class="form-control" id="productstock" value="<?= $product['item_stock'] ?>">
                             </div>
                             <div class="form-group">
                                 <label for="productweight">Weight</label>
                                 <?php echo form_error('productweight', '<small class="text-danger "> *', '</small>'); ?>
                                 <input name="productweight" type="text" class="form-control" id="productweight" placeholder="In Gram..." value="<?= $product['item_weight'] ?>">

                             </div>
                             <div class="form-group">
                                 <label for="shortproductdesc">Short Product Desc</label>
                                 <?php echo form_error('shortproductdesc', '<small class="text-danger "> *', '</small>'); ?>
                                 <input name="shortproductdesc" type="text" class="form-control" id="shortproductdesc" value="<?= $product['item_short_desc'] ?>">
                             </div>
                             <div class="form-group">
                                 <label for="longproductdesc">Detail Product Desc</label>
                                 <?php echo form_error('longproductdesc', '<small class="text-danger "> *', '</small>'); ?>
                                 <textarea placeholder="<?= $product['item_long_desc'] ?>" name="longproductdesc" type="text" class="form-control" id="longproductdesc" rows="3"></textarea>
                             </div>
                             <div class="form-group">
                                 <label for="category">Product Category</label>
                                 <?php echo form_error('category', '<small class="text-danger ">   *', '</small>'); ?>
                                 <select class="form-control" id="category" name="category">
                                     <option value="<?= $product['item_Category']   ?>">
                                         <?= $product['category_name'] ?>
                                     </option>
                                     <?php foreach ($category as $c) : ?>
                                         <?php if ($c['category_id'] == $product['item_category']) : ?>
                                             <?php continue; ?>
                                         <?php else : ?>
                                             <option value="<?= $c['category_id'] ?>"><?= $c['category_name'] ?></option>
                                         <?php endif; ?>
                                     <?php endforeach; ?>

                                 </select>

                             </div>
                             <button type="submit" class="btn btn-primary float-right">Submit</button>
                         </form>
                     </div>
                 </div>
                 <div class="card-footer">

                 </div>
             </div>
         </div>
     </div>