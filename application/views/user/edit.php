<!-- Outer Row -->
<div class="row justify-content-center mt-5">

    <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Update Information</h1>
                            </div>

                            <?= $this->session->flashdata('message') ?>
							<?php foreach($userDetails as $detail){
                                $link_url = "user/editUser/" . $detail['user_id'];
							?>
                            <img src="<?= base_url($detail['profile_picture']); ?>" width="300" height="300" alt="Image not found!"> 
                            <br>
                            <form class="user" method="post" action="<?= base_url($link_url) ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="user_id" name="user_id" placeholder="Enter Email Address..." value="<?= $detail['user_id'] ?>" readonly hidden>
                                    <?php echo form_error('id', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="First Name.." value="<?= $detail['first_name'] ?>">
                                    <?php echo form_error('first_name', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="last_name" name="last_name" placeholder="Last Name.." value="<?= $detail['last_name'] ?>">
                                    <?php echo form_error('last_name', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user" id="birthday" name="birthday" placeholder="Date of Birth" value="<?= $detail['birthday'] ?>">
                                    <?php echo form_error('birthday', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Choose Gender..</option>
                                        <option value="M" <?php if ($detail['gender'] == "M") echo "selected";?>>Male</option>
                                        <option value="F" <?php if ($detail['gender'] == "F") echo "selected";?>>Female</option>
                                    </select>
                                    <?php echo form_error('gender', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="profile_picture">Profile Picture</label><br>
                                    <input type="file" id="profile_picture" name="profile_picture" value="<?= $detail['profile_picture']; ?>">
                                    <small class="form-text text-danger"><?= form_error('profile_picture'); ?></small>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Update Data
                                </button>
                            </form>
							<?php } ?>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>