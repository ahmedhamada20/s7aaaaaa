<!-- Bootstrap core JavaScript-->
<script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('admin/js/demo/chart-pie-demo.js')}}"></script>

<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>

<script src="{{asset('admin/vendor/boorstarp-fileUpdload/js/plugins/piexif.min.js')}}"></script>
<script src="{{asset('admin/vendor/boorstarp-fileUpdload/js/plugins/sortable.min.js')}}"></script>
<script src="{{asset('admin/vendor/boorstarp-fileUpdload/js/fileinput.min.js')}}"></script>
<script src="{{asset('admin/vendor/boorstarp-fileUpdload/themes/fa5/theme.min.js')}}"></script>
<script src="{{asset('admin/type/bootstrap3-typeahead.js')}}"></script>
<script src="{{asset('admin/select/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin/textarea/summernote-bs4.js')}}"></script>



<script src="{{asset('admin/data/picker.js')}}"></script>
<script src="{{asset('admin/data/picker.date.js')}}"></script>

<script>
    // The date picker (read the docs)
    $('#start_data').pickadate();
    $('#end_data').pickadate();
</script>
<script>

    $(document).ready(function () {
        $('#summernote').summernote({
            placeholder: 'Text Notes',
            tabsize: 2,
            height: 100,
            rows: 20
        });
    });

    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>
<!-- Page level plugins -->

<!-- Page level custom scripts -->
@yield('js')
