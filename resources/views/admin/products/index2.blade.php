@extends('layouts.admin_main_page')

@section('page_title', 'Developers')

@section('css')
    <link href="{{ asset('admin-assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content')
    <!--begin::Card-->
    <div id="cardd" class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fas fa-hard-hat "></i>
                </span>
                <h3 class="card-label">
                    Developers
                </h3>
            </div>

            <div id="successMessage" style="text-align:center; width:40%" class="mt-5">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('developer.create') }}" class="btn btn-primary font-weight-bolder">
                    <i class="la la-plus"></i>
                    Add New Developer
                </a>
                <!--end::Button-->
            </div>
        </div>
    </div>
    <div class="card-body card-body-main">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom collapsed" id="datatable_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
    </div>
    <!--end::Card-->
@endsection


@section('js')

    <script src="{{ asset('admin-assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{-- <script src="{{asset('admin-assets/js/pages/crud/datatables/extensions/responsive.js')}}"></script> --}}

    <script>
        $(document).ready(function(){
            var table;
            var url = '{{ route("developer.data") }}';
            setTimeout(function()
            {
                table   = initDatatable(url);
            }, 1000);
        });

        function initDatatable(url)
        {
            return $('#datatable_table').DataTable({
                processing: true,
                responsive: true,// اكتبوا السطر دا فى كل الجداول اذا تكرمتم
                serverSide: true,
                ajax: url,
                dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'row col-sm-12 col-md-7 dataTables_pager row'lp>>`,
                buttons: [
                ],
                columns: [
                    { data: 'id', name: 'id' },
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        'searchable':false,
                        "defaultContent": '',
                        'render': function (data){
                            return '<img class="h-50px w-115px align-self-end rounded" src="' + data.logo_url + '">';
                        }
                    },
                    { data: 'name', name: 'name' },
                    {
                        "className":      'details-control',
                        "orderable":      true,
                        "data":           'is_active',
                        'searchable':true,
                        "defaultContent": '',
                        'render': function (a,b,data){
                            let status_url = "{{ route('developer.status') }}";
                            if (data.is_active == 1){
                                return '<span class="badge badge-success cursor-pointer" onclick="@if (Auth::user()->haspermission("developers-status")) changeStatus(`' + status_url + '` , ' + data.id + ' , `datatable_table` ) @endif ">Active</span>';
                            }else{
                               return '<span class="badge badge-danger cursor-pointer" onclick="@if (Auth::user()->haspermission("developers-status")) changeStatus(`' + status_url + '` , ' + data.id + ' , `datatable_table` ) @endif ">Not-Active</span>';
                            }
                        }
                    },
                    {
                        "className":      'details-control',
                        "orderable":      true,
                        "data":           'order',
                        'searchable':true,
                        "defaultContent": '',
                        'render': function (a,b,data){
                            let response = '';
                            return '<span>' + data.order ?? data.id + '</span>';
                        }
                    },
                    {
                        "className":      'details-control',
                        "orderable":      true,
                        "data":           'Need_approved',
                        'searchable':false,
                        "defaultContent": '',
                        'render': function (a,b,data){
                            let edit_url = "{{ route('developer.edit', 0) }}" + data.id;
                            let delete_url = "{{ route('developer.delete') }}";
                            let response = '';

                            if (!data.Need_approved){
                                @if (Auth::user()->haspermission('developers-update'))
                                   response += '<a href="' + edit_url + '" class="btn btn-light btn-circle btn-sm btn-shadow mr-2"> <i class="flaticon2-gear text-warning"></i> Edit </a>';
                                @endif
                                @if (Auth::user()->haspermission('developers-delete'))
                                    response += '<a href="#" class="btn btn-danger btn-circle btn-sm btn-shadow mr-2" onclick="deleteData(`' +  delete_url + '`,' + data.id +',`datatable_table`)" > <i class="flaticon2-trash"></i> Delete </a>';
                                @endif
                            }else if (data.approve_btn){
                                response += '<a href="' + data.approve_btn + '" class="btn btn-warning btn-circle btn-sm btn-shadow mr-2" > <i class="fa fa-eye"></i>Review & Approve </a>';
                            }else{
                                response += '<span class="font-weight-bolder btn btn-warning btn-circle btn-sm btn-shadow mr-2"> Wait For Admin Action </span>';
                            }
                            if (data.reply){
                                response += '<span class="dot" title="Last changes on this Item is rejected becaues '+ data.reply +'"></span>';
                            }
                            return response;
                        }
                    },


                ],
                'createdRow': function( row, data, dataIndex)
                {
                    if( data.reply)
                    {
                        $(row).addClass('bg-light-danger');
                    }
                },
            });
        }

    </script>

@endsection
