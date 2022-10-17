<!--**********************************
            Footer start
        ***********************************-->
<div class="footer">
    <div class="copyright">
        <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
        <p>Distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a></p>
    </div>
</div>
<!--**********************************
            Footer end
        ***********************************-->

<!--**********************************
           Support ticket button start
        ***********************************-->

<!--**********************************
           Support ticket button end
        ***********************************-->


</div>
<!--**********************************
        Main wrapper end
    ***********************************-->

<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="<?= base_url(); ?>public/vendor/global/global.min.js"></script>
<script src="<?= base_url(); ?>public/js/quixnav-init.js"></script>
<script src="<?= base_url(); ?>public/js/custom.min.js"></script>


<!-- Vectormap -->
<script src="<?= base_url(); ?>public/vendor/raphael/raphael.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/morris/morris.min.js"></script>


<script src="<?= base_url(); ?>public/vendor/circle-progress/circle-progress.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/chart.js/Chart.bundle.min.js"></script>

<script src="<?= base_url(); ?>public/vendor/gaugeJS/dist/gauge.min.js"></script>

<!--  flot-chart js -->
<script src="<?= base_url(); ?>public/vendor/flot/jquery.flot.js"></script>
<script src="<?= base_url(); ?>public/vendor/flot/jquery.flot.resize.js"></script>

<!-- Owl Carousel -->
<script src="<?= base_url(); ?>public/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<!-- Counter Up -->
<script src="<?= base_url(); ?>public/vendor/jqvmap/js/jquery.vmap.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
<script src="<?= base_url(); ?>public/vendor/jquery.counterup/jquery.counterup.min.js"></script>


<script src="<?= base_url(); ?>public/js/dashboard/dashboard-1.js"></script>

<!-- Datatable -->
<script src="<?= base_url(); ?>public/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>public/js/plugins-init/datatables.init.js"></script>

<!-- Daterangepicker -->
<!-- momment js is must -->
<script src="<?= base_url(); ?>public/vendor/moment/moment.min.js"></script>
<!-- Material color picker -->
<script src="<?= base_url(); ?>public/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>


<!-- Material color picker init -->
<script src="<?= base_url(); ?>public/js/plugins-init/material-date-picker-init.js"></script>

<script src="<?= base_url(); ?>public/vendor/select2/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>public/js/plugins-init/select2-init.js"></script>

<!-- Clockpicker init -->
<script src="<?= base_url(); ?>public/js/plugins-init/clock-picker-init.js"></script>

<!-- Summernote -->
<script src="<?= base_url(); ?>public/vendor/summernote/js/summernote.min.js"></script>
<!-- Summernote init -->
<script src="<?= base_url(); ?>public/js/plugins-init/summernote-init.js"></script>
<!-- <script type="text/javascript">
    $(document).ready(function() {

        $('#ruang').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url('pengawas/get_kelas'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    var html = '<option value="">Pilih Kelas</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].kelas + '>' + data[i].kelas + '</option>';
                    }
                    $('#kelas').html(html);

                }
            });
            return false;
        });

    });
</script> -->
</body>

</html>