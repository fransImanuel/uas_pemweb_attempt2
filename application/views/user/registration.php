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
                                <h1 class="h4 text-gray-900 mb-4">Login Page!</h1>
                            </div>

                            <?= $this->session->flashdata('message') ?>
                            <form class="user" method="post" action="<?= base_url('user/registration') ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email') ?>">
                                    <?php echo form_error('email', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?php echo form_error('password1', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                    <?php echo form_error('password2', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="firstname" name="firstname" placeholder="First Name.." value="<?= set_value('firstname') ?>">
                                    <?php echo form_error('firstname', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="lastname" name="lastname" placeholder="Last Name.." value="<?= set_value('lastname') ?>">
                                    <?php echo form_error('lastname', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user" id="date" name="date" placeholder="Date of Birth" value="<?= set_value('date') ?>">
                                    <?php echo form_error('date', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="gender" name="gender" value="<?= set_value('gender') ?>">
                                        <option value="">Choose Gender..</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                    <?php echo form_error('gender', '<small class="text-danger ">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Create Account!
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('user/login') ?>">Already Have An Account? Login Here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>