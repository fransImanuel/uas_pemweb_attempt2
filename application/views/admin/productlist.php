<div class="main-panel" id="main-panel">



    <div class="row ">
        <div class="col-lg-11 col-md mt-4 ml-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Global Sales</h5>
                    <h4 class="card-title">Add Products</h4>
                </div>
                <div class="card-body m-4">

                    <div class="container">
                        <br><br><br>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="search_text" id="search_text" class="form-control" placeholder="SearchBar">
                            </div>
                        </div>

                    </div>
                    <div id="result">

                    </div>
                    <?= $this->session->flashdata('message'); ?>


                    </tbody>
                    </table>

                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            load_data();

            function load_data(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/fetch",
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
    </script>