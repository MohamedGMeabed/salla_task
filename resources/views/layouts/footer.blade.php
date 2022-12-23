@yield('footer-copyrights')
<!--end::Demo Panel-->
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/file-upload/image-input.js') }}"></script>
    <!--end::Page Vendors-->
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/pages/crud/datatables/basic/basic.js')}}"></script>
    <script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-switch.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>

    <!--end::Page Scripts-->
    @yield('js')

    <script>
          $('.editor').each(function(e) {
            CKEDITOR.replace(this.id, {
                height: 180,
                baseFloatZIndex: 10005,
                removeButtons: 'PasteFromWord'
            });
            });

        function deleteData(url, id, div = '') {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "<i class='fa fa-check'></i> Yes, Delete it!",
                cancelButtonText: "<i class='fa fa-times'></i> No, Cancel!",
                reverseButtons: true,
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-success"
                }
            }).then(function(result) {
                if (result.value) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            id: id,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            if (data == 'success') {
                                Swal.fire(
                                    "Deleted !!",
                                    "Your Data Has Been Deleted.",
                                    "success"
                                ).then(function() {
                                    location.reload();
                                })
                            } else {
                                Swal.fire(
                                    "Sorry !!",
                                    "Cannot delete Data",
                                    "error"
                                )
                            }
                        },
                        error: function(data) {
                            Swal.fire(
                                "Sorry !!",
                                data,
                                "error"
                            )
                        }
                    });

                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelled !!",
                        "",
                        "info"
                    )
                }
            });
        }
    
        function changeStatus(url, id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Change Status !!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "<i class='fa fa-check'></i> Yes, Change it!",
                cancelButtonText: "<i class='fa fa-times'></i> No, Cancel!",
                reverseButtons: true,
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                }
            }).then(function(result) {
                if (result.value) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            id: id,
                            isActive: 1
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            if (data == 'success') {
                                Swal.fire(
                                    "Changed !!",
                                    "Status Has Been Changed.",
                                    "success"
                                ).then(function() {
                                    location.reload();
                                })
                            }
                            else if (data == 'wantConfirmation') {
                                Swal.fire(
                                    "Changed !!",
                                    "Please Wait For Confirmation Until Your Transaction Is Processed",
                                    "success"
                                ).then(function() {
                                    location.reload();
                                })
                            }
                            else {
                                Swal.fire(
                                    "Sorry !!",
                                    "Cannot Change Status",
                                    "error"
                                )
                            }
                        },
                        error: function(data) {
                            Swal.fire(
                                "Sorry !!",
                                data,
                                "error"
                            )
                        }
                    });

                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelled !!",
                        "",
                        "info"
                    )
                }
            });
        }

    </script>
    <script>
        @if (Session::has('success'))
            Swal.fire("Success", "{{ Session::get('success') }}", "success");
        @endif
        @if (Session::has('error'))
            Swal.fire("error", "{{ Session::get('error') }}", "error");
        @endif
    </script>
</body>
<!--end::Body-->
</html>
