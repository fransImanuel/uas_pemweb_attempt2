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

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {
        load_data();
        localStorage.setItem('sort', 'ASC');
        localStorage.setItem('filter', '');
        localStorage.setItem('search', '');

        function load_data(search, filter, sort) {
            $.ajax({
                url: "<?php echo base_url(); ?>user/fetch",
                method: "POST",
                data: {
                    search: search,
                    filter: filter,
                    sort: sort
                },
                success: function(data) {
                    $('#result').html(data);
                }
            })
        }


        $('#search_text').keyup(function() {
            var search = $(this).val();
            localStorage.setItem('search', search);
            var filter = localStorage.getItem('filter');
            var sort = localStorage.getItem('sort');
            if (search != '') {
                load_data(search, filter, sort);
            } else {
                load_data('', filter, sort);
            }
        });

        $('.filter').click(function() {
            var filter = $(this).val();
            var search = localStorage.getItem('search');
            var sort = localStorage.getItem('sort');
            if (filter == localStorage.getItem('filter')) {
                localStorage.setItem('filter', '');
            } else {
                localStorage.setItem('filter', filter);
            }

            filter = localStorage.getItem('filter');

            filter = localStorage.getItem('filter');

            load_data(search, filter, sort);

        })

        $('#sort').click(function() {
            var search = localStorage.getItem('search');
            var filter = localStorage.getItem('filter');
            if ($('#sort').data('flag') == 1) {
                localStorage.setItem('sort', 'ASC');
                load_data(search, filter, 'ASC');
            } else {
                localStorage.setItem('sort', 'DESC');
                load_data(search, filter, 'DESC');
            }
        })


    });

    function sorting() {
        //flag 0 = asc, flag 1 = desc
        $('#sort').data('flag');

        // console.log($('#sort').html())
        if ($('#sort').data('flag') == 1) {
            $('#sort').data('flag', 2)
            $('.sortIcon').removeClass('fa-sort-alpha-down')
            $('.sortIcon').addClass('fa-sort-alpha-up')
            // $.ajax buat desc
        } else {
            $('#sort').data('flag', 1)
            $('.sortIcon').removeClass('fa-sort-alpha-up')
            $('.sortIcon').addClass('fa-sort-alpha-down')
            // $.ajax buat asc
        }
    }

    function addToCart($itemId) {
        // var x = $('#totalItemOnCart').text()
        // console.log($(document).scrollTop());
        var x = $(document).scrollTop();
        $.ajax({
            url: '<?= base_url('product/addtocart') ?>',
            method: 'post',
            data: {
                'itemId': $itemId
            },
            success: function() {
                location.reload()
            }
        })
    }
</script>
</body>

</html>