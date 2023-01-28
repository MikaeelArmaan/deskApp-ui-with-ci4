@extends('theme.main')
@push('styles')
    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="src/plugins/switchery/switchery.min.css">

    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
    <!-- Page Heading -->

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800 mb-n1">Address</h1>
        <button class="btn btn-sm btn-primary btn-create">Create Address</button>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div id="status" class="collapse">
                <div class="alert" role="alert"></div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-20"> </div>
                <div class="pb-20 table-responsive" style="font-size: 11pt">
                    <table class="table hover table-striped data-table-export nowrap datatable" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Locality</th>
                                <th>Pincode</th>
                                <th>City</th>
                                <th>State</th>
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

@section('modal')
    <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="address-form" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Name:</label>
                            <input id="name" type="text" class="form-control" name="name" required
                                autocomplete="name" autofocus autofocus placeholder="Enter Address name...">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Short Description:</label>
                            <input id="short_description" type="text" class="form-control" name="short_description"
                                required autocomplete="short_description" autofocus
                                placeholder="Enter Short Description...">
                        </div>


                        <div class="form-group">
                            <label for="description" class="col-form-label">Description:</label>
                            <input id="description" type="text" class="form-control" name="description" autofocus
                                placeholder="Enter description...">

                        </div>
                        {{-- <div class="form-group">
                            <div class="custom-file">
                                <label for="image" class="col-form-label">Address Logo:</label>
                                <input id="image" type="file" class="form-control" name="image" autofocus
                                    placeholder="Enter description...">
                            </div>
                        </div> --}}

                        <div class=" form-group">
                            <label for="status" class="col-form-label">Actuvate:</label>
                            <input id="status" type="checkbox" data-size="small" class="switch-btn" data-color="#0099ff"
                                data-secondary-color="#28a745" name="status" autofocus placeholder="Enter description...">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

    <script type="text/javascript">
        let table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route_to('address.data') }}',
                type: 'GET'
            },
            columns: [{
                    data: 'index',
                    name: 'index'
                },
                {
                    data: 'customer_name',
                    name: 'customer_name'
                },
                {
                    data: 'address',
                    name: 'address'
                },

                {
                    data: 'locality',
                    name: 'locality'
                },

                {
                    data: 'pincode',
                    name: 'pincode'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'state',
                    name: 'state'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'button',
                    name: 'button'
                }
            ]
        });

        function openModal(title) {
            $('#addressModal').modal('show')
                .find('#addressModalLabel')
                .html(title);
        }

        function showAlert(type, message) {
            $('#status').collapse('show')
                .find('.alert')
                .addClass(type)
                .html(message);
        }

        function hideAlert() {
            $('#status').collapse('hide')
                .find('div')
                .attr('class', 'address.createalert')
                .html('');
        }

        $(document).on('click', '.btn-create', function(e) {
            e.preventDefault();

            openModal('Create Address');

            $('#address-form').attr({
                action: '{{ route_to('address.create') }}',
                method: 'POST'
            });

            $('#name').attr('required', true);
        });

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();

            openModal('Update Address');

            let address = $(this).data('address');
            $.each(address, function(key, val) {
                if (key == "status")
                    (val == 1) ? $('#' + key).attr('checked') : $('#' + key).removeAttr('checked');

                $('#' + key).val(val);
            });

            $('#address-form').attr({
                action: $(this).data('url'),
                method: 'PUT'
            });
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

        $('#address-form').submit(function(e) {
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
                        $('#addressModal').modal('hide');
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
                                $('#addressModal').modal('hide');

                                showAlert('alert-danger', val);
                            }
                        });

                        if (responseJSON.message) {
                            $('#addressModal').modal('hide');

                            showAlert('alert-danger', responseJSON.message);
                        }
                    }
                })
                .always(function() {
                    table.ajax.reload();
                });
        });

        $('#addressModal').on('show.bs.modal', function(e) {
            $('.form-control')
                .removeClass('is-invalid')
                .find('.invalid-feedback')
                .remove();

            $('#password').attr('required', false);

            $('#repeat_password').attr('required', false);
        });

        $('#addressModal').on('hidden.bs.modal', function(e) {
            $('#address-form').trigger('reset');

            return setTimeout(() => {
                hideAlert();
            }, 3200);
        });
    </script>
    <!-- add sweet alert js & css in footer -->
    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>
@endpush
