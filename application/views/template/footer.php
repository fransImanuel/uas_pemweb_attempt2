<!-- Footer-->
<footer class="footer py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-left">Copyright © Your Website 2020</div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-right"><a class="mr-3" href="#!">Privacy Policy</a><a href="#!">Terms of Use</a></div>
        </div>
    </div>
</footer>
<!-- Portfolio Modals-->
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Contact form JS-->
<script src="<?= base_url('vendor/agency/'); ?>assets/mail/jqBootstrapValidation.js"></script>
<script src="<?= base_url('vendor/agency/'); ?>assets/mail/contact_me.js"></script>
<!-- Core theme JS-->
<script src="<?= base_url('vendor/agency/'); ?>js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

</body>

</html>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {

        load_data();

        function load_data(query) {
            $.ajax({
                url: "<?php echo base_url(); ?>user/fetch",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#result').html(data);
                }
            })
        }

        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });


    });

    function sorting() {
        //flag 0 = asc, flag 1 = desc
        $('#sort').data('flag');

        if ($('#sort').data('flag') == 1) {
            $('#sort').data('flag', 2)
            // $.ajax buat desc
        } else {
            $('#sort').data('flag', 1)
            // $.ajax buat asc
        }
    }
</script>