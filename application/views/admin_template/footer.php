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
<!-- Chart JS -->
<script src="<?= base_url() ?>vendor/nowui/assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?= base_url() ?>vendor/nowui/assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url() ?>vendor/nowui/assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });

    var bigDashBoardData = [];
    var bigDashBoardLabel = [];
    $bigDashBoardData = <?= json_encode($product)  ?>;
    $bigDashBoardData = JSON.parse(<?= json_encode($product)  ?>);

    for ($i = 0; $i < $bigDashBoardData.length; $i++) {
        bigDashBoardData.push($bigDashBoardData[$i].sum);
        bigDashBoardLabel.push($bigDashBoardData[$i].category_name);

    }

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function deleteProduct($id, $is_active) {
        $.ajax({
            url: "<?= base_url('admin/deleteProduct') ?>",
            type: 'post',
            data: {
                'id': $id,
                'is_active': $is_active
            },
            success: function($e) {
                document.location.href = "<?= base_url('admin/productlist') ?>";
            }
        })
    }

    function editProduct($id) {
        event.preventDefault();
        $.ajax({
            url: "<?= base_url('admin/productlist') ?>",
            type: 'post',
            data: {
                'id': $id
            },
            success: function($e) {
                document.location.href = "<?= base_url('admin/productlist') ?>";
            }
        })
    }
</script>
<script src="<?= base_url() ?>vendor/nowui/assets/demo/demo.js"></script>
</body>

</html>