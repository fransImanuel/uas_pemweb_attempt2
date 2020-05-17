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
                     <h5 class="card-category"></h5>
                     <h4 class="card-title">Registered User</h4>
                 </div>
                 <div class="card-body m-4">

                     <?= $this->session->flashdata('message'); ?>
                     <table class="table">
                         <thead class="thead-dark">
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">User Email</th>
                                 <th scope="col">Activated</th>
                                 <th scope="col">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $i = 1;
                                foreach ($users as $u) : ?>
                                 <tr>
                                     <th scope="row"><?= $i++ ?></th>
                                     <td><?= $u['email'] ?></td>

                                     <?php if ($u['is_active'] == 1) : ?>
                                         <td class="text-success">Email Activated</td>
                                     <?php else : ?>
                                         <td class="text-black-50">Email Is Not Activated</td>
                                     <?php endif; ?>
                                     <td>
                                         <!-- Button trigger modal -->
                                         <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#details<?= $u['user_id'] ?>">
                                             <i class="fas fa-fw fa-info-circle"></i>
                                         </button>
                                     </td>
                                     <!-- Modal Details -->
                                     <div class="modal fade " id="details<?= $u['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="details<?= $u['user_id'] ?>Label">
                                         <div class="modal-dialog modal-xl">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <h5 class="modal-title" id="details<?= $u['user_id'] ?>Label"><?= $u['email'] ?></h5>
                                                     <button type="button" class="close" data-dismiss="modal">
                                                         <span>&times;</span>
                                                     </button>
                                                 </div>
                                                 <div class="modal-body">
                                                     <div class="container">
                                                         <div class="row">
                                                             <div class="col-md">
                                                                 <img src="<?= base_url(); ?>assets/img/profile/<?= $u['profile_picture'] ?>" class="img-fluid my-auto m-auto mx-auto" alt="">
                                                             </div>
                                                             <div class="col col-md text-center">
                                                                 <h3>Nama : <?= $u['first_name'] . ' ' . $u['last_name'] ?></h3>
                                                                 <p>Gender : <?= $u['gender'] ?></p>
                                                                 <p>Phone Number : <?= $u['phone_number'] ?></p>
                                                                 <p>Email : <?= $u['email'] ?></p>
                                                                 <p>City : <?= $u['city'] ?></p>
                                                                 <p>Post Code : <?= $u['post_code'] ?></p>
                                                                 <p>Birthday : <?= $u['birthday'] ?></p>
                                                                 <p>Address : <?= $u['address'] ?></p>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="modal-footer  mt-4">
                                                         <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
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