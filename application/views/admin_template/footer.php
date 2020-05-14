<footer class="footer">
    <div class=" container-fluid ">
        <nav>
            <ul>
                <li>
                    <a href="https://www.creative-tim.com">
                        Creative Tim
                    </a>
                </li>
                <li>
                    <a href="http://presentation.creative-tim.com">
                        About Us
                    </a>
                </li>
                <li>
                    <a href="http://blog.creative-tim.com">
                        Blog
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright" id="copyright">
            &copy; <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
        </div>
    </div>
</footer>
</div>
</div>
<!--   Core JS Files   -->
<script src="<?= base_url() ?>vendor/nowui/assets/js/core/jquery.min.js"></script>
<script src="<?= base_url() ?>vendor/nowui/assets/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>vendor/nowui/assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url() ?>vendor/nowui/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="<?= base_url() ?>vendor/nowui/assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?= base_url() ?>vendor/nowui/assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url() ?>vendor/nowui/assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="<?= base_url() ?>vendor/nowui/assets/demo/demo.js"></script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function deleteProduct($id) {
        $.ajax({
            url: "<?= base_url('admin/deleteProduct') ?>",
            type: 'post',
            data: {
                'id' : $id
            },
            success: function($e) {
                console.log('ini E = '+$e);
                document.location.href = "<?= base_url('admin/productlist') ?>";
            }
        })
        alert('id lo ' + $id);
    }
</script>
<script>

</script>
</body>

</html>