@extends('theme.main')
@push('styles')
    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="src/plugins/switchery/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">

    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
    <!-- Page Heading -->

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800 mb-n1">Products</h1>
        <a class="btn btn-sm btn-primary" href='{{ route_to('products.create') }}'>Create product</a>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div id="status" class="collapse">
                <div class="alert" role="alert"></div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-10"> </div>
                <div class="pb-20 table-responsive" style="font-size: 11pt">
                    <table class="table hover table-striped data-table-export nowrap datatable" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Qnty</th>
                                <th>Retailer Price</th>
                                <th>Distributor Price</th>
                                <th>Purchase Price</th>
                                <th>Sale Price</th>
                                <th>Short Desc</th>
                                <th>Desc</th>
                                <th>HSN</th>
                                <th>GST</th>
                                <th>sequence</th>
                                <th>Status</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
@endsection

@push('scripts')
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <!-- buttons for Export datatable -->
    <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
    <!-- switchery js -->
    <script src="src/plugins/switchery/switchery.min.js"></script>
    <script src="vendors/scripts/advanced-components.js"></script>
    {{-- sweet alert --}}
    <script src="{{ 'vendors/plugins/sweetalert2/sweet-alert.init.js' }}"></script>

    <script type="text/javascript">
        let table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            language: {
                processing: '<div class="loading-text">Loading...</div>',
            },
            //responsive: true,
            ajax: {
                url: '{{ route_to('products.data') }}',
                type: 'GET'
            },
            //order: [[ 13, 'asc' ]],
            columns: [{
                    data: 'index',
                    name: 'index'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'brand_name',
                    name: 'brand_name'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'retailer_price',
                    name: 'retailer_price'
                },
                {
                    data: 'distributor_price',
                    name: 'distributor_price'
                },
                {
                    data: 'purchase_price',
                    name: 'purchase_price'
                },
                {
                    data: 'sale_price',
                    name: 'sale_price'
                },
                {
                    data: 'short_description',
                    name: 'short_description'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'hsn',
                    name: 'hsn'
                },
                {
                    data: 'gst',
                    name: 'gst'
                },

                {
                    data: 'sequence',
                    name: 'sequence'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'button',
                    name: 'button'
                },
            ]
        });
       

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            let url = $(this).data('url');

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {
                $.ajax({
                        url: url,
                        type: 'DELETE',
                        beforeSend: () => {
                            $(".pre-loader").show();
                        },
                        success: (response) => {
                            $(".pre-loader").hide();
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            return setTimeout(() => {
                                showAlert('alert-warning', response.message);
                            }, 500);
                        }
                    })
                    .always(function() {
                        table.ajax.reload();

                        return setTimeout(() => {
                            hideAlert();
                        }, 3200);
                    });
            });
        });

        $('#product-form').submit(function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            let url = $(this).attr('action');
            let method = $(this).attr('method');

            $.ajax({
                    url: url,
                    type: method,
                    data: data,
                    beforeSend: () => {
                        $(".pre-loader").show();
                    },
                    success: (response) => {
                        $('#productModal').modal('hide');
                        $(".pre-loader").hide();
                        return setTimeout(() => {
                            showAlert('alert-success', response.message);
                        }, 500);
                    },
                    error: ({
                        responseJSON
                    }) => {
                        $(".pre-loader").hide();
                        $.each(responseJSON.messages, (key, val) => {
                            $('#' + key).addClass('is-invalid')
                                .after('<small class="invalid-feedback">' + val + '</small>');

                            if (key === 'error') {
                                $('#productModal').modal('hide');

                                showAlert('alert-danger', val);
                            }
                        });

                        if (responseJSON.message) {
                            $('#productModal').modal('hide');

                            showAlert('alert-danger', responseJSON.message);
                        }
                    }
                })
                .always(function() {
                    table.ajax.reload();
                });
        });

        $('#productModal').on('show.bs.modal', function(e) {
            $('.form-control')
                .removeClass('is-invalid')
                .find('.invalid-feedback')
                .remove();

            $('#password').attr('required', false);

            $('#repeat_password').attr('required', false);
        });

        $('#productModal').on('hidden.bs.modal', function(e) {
            $('#product-form').trigger('reset');

            return setTimeout(() => {
                hideAlert();
            }, 3200);
        });
    </script>
    <!-- add sweet alert js & css in footer -->
    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>
@endpush
