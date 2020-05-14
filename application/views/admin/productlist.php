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
         <div class="col-lg-11 col-md mt-4 ml-4">
             <div class="card card-chart">
                 <div class="card-header">
                     <h5 class="card-category">Global Sales</h5>
                     <h4 class="card-title">Add Products</h4>
                 </div>
                 <div class="card-body m-4">

                     <?= $this->session->flashdata('message'); ?>
                     <table class="table">
                         <thead class="thead-dark">
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Product Name</th>
                                 <th scope="col">Category</th>
                                 <th scope="col">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $i = 1;
                                foreach ($product as $p) : ?>
                                 <tr>
                                     <th scope="row"><?= $i++ ?></th>
                                     <td><?= $p['item_name'] ?></td>
                                     <td><?= $p['category_name'] ?></td>
                                     <td>
                                         <!-- Button trigger modal -->
                                         <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#details<?= $p['item_id'] ?>">
                                             <i class="fas fa-fw fa-info-circle"></i>
                                         </button>
                                         <a href="<?= base_url('admin/editProduct/') . $p['item_id'] ?>" class="btn btn-primary"><i class="fas fa-fw fa-edit text-light"></i></a>
                                         <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $p['item_id'] ?>">
                                             <i class="fas fa-fw fa-trash-alt"></i>
                                         </button>
                                     </td>
                                     <!-- Modal Details -->
                                     <div class="modal fade " id="details<?= $p['item_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="details<?= $p['item_id'] ?>Label">
                                         <div class="modal-dialog modal-xl">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <h5 class="modal-title" id="details<?= $p['item_id'] ?>Label"><?= $p['item_name'] ?></h5>
                                                     <button type="button" class="close" data-dismiss="modal">
                                                         <span>&times;</span>
                                                     </button>
                                                 </div>
                                                 <div class="modal-body">
                                                     <div class="container">
                                                         <div class="row">
                                                             <div class="col col-md">
                                                                 <img src="<?= base_url(); ?>assets/img/product/<?= $p['item_image'] ?>" class="img-fluid" alt="">
                                                             </div>
                                                             <div class="col col-md text-center">
                                                                 <h1><?= $p['item_name'] ?></h1>
                                                                 <h3 class="mt">Category : <?= $p['category_name'] ?></h3>
                                                                 <p class="mb-0"><?= $p['item_short_desc'] ?></p>
                                                                 <p class="blockquote-footer"><?= $p['item_long_desc'] ?></p>
                                                                 <div class="container">
                                                                     <div class="row blockquote">
                                                                         <div class="col-sm">
                                                                             Rp. <?= $p['item_price'] ?>
                                                                         </div>
                                                                         <div class="col-sm">
                                                                             Stock : <?= $p['item_stock'] ?>
                                                                         </div>
                                                                         <div class="col-sm">
                                                                             Weight : <?= $p['item_weight'] ?>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <button type="button" class="btn btn-primary">OK</button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                     <!-- Modal Delete -->
                                     <div class="modal fade " id="delete<?= $p['item_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="delete<?= $p['item_id'] ?>Label">
                                         <div class="modal-dialog modal-xl">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <h5 class="modal-title" id="delete<?= $p['item_id'] ?>Label"><?= $p['item_name'] ?></h5>
                                                     <button type="button" class="close" data-dismiss="modal">
                                                         <span>&times;</span>
                                                     </button>
                                                 </div>
                                                 <div class="modal-body">
                                                     <div class="container">
                                                         <div class="row">
                                                             <div class="col-md">
                                                                 <img src="<?= base_url(); ?>assets/img/product/<?= $p['item_image'] ?>" class="img-fluid" alt="">
                                                             </div>
                                                             <div class="col col-md text-center">
                                                                 <h1 class="text-danger">Are you Sure Want to Delete??</h1>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <button type="button" class="btn btn-primary " data-dismiss="modal" onclick="deleteProduct(<?= $p['item_id'] ?>)">Delete</button>
                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>


                                 </tr>
                             <?php endforeach; ?>
                         </tbody>
                     </table>

                 </div>
                 <div class="card-footer">

                 </div>
             </div>
         </div>
     </div>