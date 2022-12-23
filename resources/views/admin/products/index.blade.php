@extends('layouts.admin')

@section('page_title','Productd')

@section('css')
<link href="{{asset('admin-assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card card-custom" style="background-color: e4e0e3">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </span>
                <h3 class="card-label">
                   Create product
                </h3>
            </div>
           
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{route('products.create')}}" class="btn btn-primary font-weight-bolder">
                    <i class="la la-plus"></i>
                    Create Product
                </a>
                <!--end::Button-->
            </div>
            <div class="card-toolbar">
                <form class="form" method="POST" action="{{route('products.pullData')}}" enctype="multipart/form-data">
                    @csrf

                    <button type="submit" class="btn btn-primary mr-2">Pull Now</button>
                </form>
                <!--begin::Button-->
                </a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body card-body-main">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom collapsed" id="requests_table">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('SKU') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Main Image') }}</th>
                        <th style="width:10%">Actions</th>
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
    <script src="{{ asset('admin-assets/js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>

    <script>
        let table;
        function initDatatable(url) {
            return $('#requests_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: url,
                    type: 'GET',
                },
                order: [
                    [2, 'desc']
                ],
                lengthMenu: [
                    [10, 20, 30, 40, 50, 100, 1000],
                    [10, 20, 30, 40, 50, 100, 1000]
                ],
                pageLength: 10,
                dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager row'lp>>`,
                buttons: [
                ],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                order: [],
                columns: [{
                        data: "id",
                        name: "id",
                        searchable: true,
                        className: 'dt-center'
                    },
                    {
                        data: "name",
                        render: function(data, type, row) {
                            return row.name ?? '-';
                        }
                    },
                    {
                        data: "sku",
                        render: function(data, type, row) {
                            return row.sku ?? '-';
                        }
                    },
                    {
                        data: "price",
                        render: function(data, type, row) {
                            return row.price ?? '-';
                        }
                    },
                  
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        'searchable':false,
                        "defaultContent": '',
                        'render': function (data){
                            return '<img class="h-50px w-115px align-self-end rounded" src="' + data.main_image + '">';
                        }
                    },
                    {
                        "className":      'details-control',
                        "orderable":      true,
                        "data":           'Need_approved',
                        'searchable':false,
                        "defaultContent": '',
                        'render': function (a,b,data){
                            let edit_url = "{{ route('products.edit', 0) }}" + data.id;
                            let delete_url = "{{ route('products.delete') }}";
                            let response = '';

                            response += '<a href="' + edit_url + '" class="btn btn-light btn-circle btn-sm btn-shadow mr-2"> <i class="flaticon2-gear text-warning"></i> Edit </a>';
                            response += '<a href="#" class="btn btn-danger btn-circle btn-sm btn-shadow mr-2" onclick="deleteData(`' +  delete_url + '`,' + data.id +')" > <i class="flaticon2-trash"></i> Delete </a>';
                            
                            return response;
                        }
                    },
                ],
            });
        }
        $(document).ready(function() {
            
            table = initDatatable("{{ route('products.data') }}");
        });

    </script>
@endsection