@extends('theme.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i
                            class="fa fa-pencil"></i></a>
                    <img src="vendors/images/photo1.jpg" alt="" class="avatar-photo">
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body pd-5">
                                    <div class="img-container">
                                        <img id="image" src="vendors/images/photo2.jpg" alt="Picture">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="text-center h5 mb-0">Ross C. Lopez</h5>
                <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
                <div class="profile-info">
                    <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                    <ul>
                        <li>
                            <span>Email Address:</span>
                            FerdinandMChilds@test.com
                        </li>
                        <li>
                            <span>Phone Number:</span>
                            619-229-0054
                        </li>
                        <li>
                            <span>Country:</span>
                            America
                        </li>
                        <li>
                            <span>Address:</span>
                            1807 Holden Street<br>
                            San Diego, CA 92115
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#setting" role="tab">Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#appearance" role="tab">Appearance</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Setting Tab start -->
                            <div class="tab-pane fade height-100-p show active" id="setting" role="tabpanel">
                                <div class="profile-setting">
                                    <form id="frm-site" name="frm-site" method="{{ $method }}"
                                        action="{{ $url }}">
                                        <ul class="profile-edit-list row">
                                            <li class="weight-500 col-md-6">
                                                <h4 class="text-blue h5 mb-20">Edit Your Site Setting</h4>
                                                <div class="form-group">
                                                    <label>Site Name</label>
                                                    <input name="site_name" id="site_name"
                                                        placeholder="Enter your Site here"
                                                        value="{{ isset($sitesetting) ? $sitesetting->site_name : '' }}"
                                                        class="form-control form-control-lg" type="text">
                                                </div>
                                                @if (auth()->id() == 1)
                                                    <div class="form-group">
                                                        <label>Site Admin</label>
                                                        <select class="selectpicker form-control form-control-lg"
                                                            name="site_admin" id="site_admin"
                                                            data-style="btn-outline-secondary btn-lg" title="Not Chosen">
                                                            @foreach ($admins as $admin)
                                                                <option value="{{ $admin->id }}"
                                                                    {{ isset($sitesetting) && $sitesetting->site_admin == $admin->id ? 'selected="selected"' : '' }}>
                                                                    {{ $admin->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @else
                                                    <input type="hidden" name="site_admin" id="site_admin"
                                                        value="{{ $sitesetting->site_admin }}">
                                                @endif

                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input id="email" name="email" placeholder="Enter your email"
                                                        value="{{ isset($sitesetting) ? $sitesetting->email : '' }}"
                                                        class="form-control form-control-lg" type="email">
                                                </div>

                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input id="mobiles" name="mobiles" placeholder="Enter your mobile"
                                                        value="{{ isset($sitesetting) ? $sitesetting->mobiles : '' }}"
                                                        class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>GST Number</label>
                                                    <input id="gst_number" name="gst_number"
                                                        placeholder="Enter your GST number here"
                                                        value="{{ isset($sitesetting) ? $sitesetting->gst_number : '' }}"
                                                        class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>PAN Number</label>
                                                    <input id="pan_number" name="pan_number"
                                                        placeholder="Enter your PAN number here"
                                                        value="{{ isset($sitesetting) ? $sitesetting->pan_number : '' }}"
                                                        class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>TAN Number</label>
                                                    <input id="tan_number" name="tan_number"
                                                        placeholder="Enter your TAN here"
                                                        value="{{ isset($sitesetting) ? $sitesetting->tan_number : '' }}"
                                                        class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control" placeholder="Enter your address here" id="address" name="address">{{ isset($sitesetting) ? $sitesetting->address : '' }}</textarea>
                                                </div>

                                                <div class="form-group mb-0">
                                                    <input type="submit" class="btn btn-primary"
                                                        value="Update Information">
                                                </div>
                                            </li>
                                            <li class="weight-500 col-md-6">
                                                <h4 class="text-blue h5 mb-20">Edit Bank Detail</h4>
                                                <div class="form-group">
                                                    <label>Bank Name:</label>
                                                    <input class="form-control form-control-lg" name="bank_name"
                                                        id="bank_name"
                                                        value="{{ isset($sitesetting) ? $sitesetting->bank_name : '' }}"
                                                        type="text" placeholder="Paste your link here">
                                                </div>

                                                <div class="form-group">
                                                    <label>Bank Account Number</label>
                                                    <input class="form-control form-control-lg" name="bank_account"
                                                        id="bank_account"
                                                        value="{{ isset($sitesetting) ? $sitesetting->bank_account : '' }}"
                                                        type="text" placeholder="Enter Bank Account here">
                                                </div>
                                                <div class="form-group">
                                                    <label>IFSC Code:</label>
                                                    <input class="form-control form-control-lg" name="ifsc"
                                                        id="ifsc"
                                                        value="{{ isset($sitesetting) ? $sitesetting->ifsc : '' }}"
                                                        type="text" placeholder="Enter Bank ifsc here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Branch:</label>
                                                    <input class="form-control form-control-lg" name="branch"
                                                        id="branch"
                                                        value="{{ isset($sitesetting) ? $sitesetting->branch : '' }}"
                                                        type="text" placeholder="Enter Bank branch here">
                                                </div>

                                            </li>

                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <!-- Setting Tab End -->
                            <!-- Appearance Tab start -->
                            <div class="tab-pane fade height-100-p" id="appearance" role="tabpanel">
                                <div class="profile-setting">
                                    <form id="frm-appearance" name="frm-appearance" method="{{ $method }}"
                                        action="{{ $url }}">
                                        <ul class="profile-edit-list row">
                                            <li class="weight-500 col-md-12">
                                                <h4 class="text-blue h5 mb-20">Edit Your Site Appearance</h4>
                                                <div class="right-sidebar-body ">
                                                    <div class="right-sidebar-body-content">
                                                        <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                                                        <div class="sidebar-radio-group pb-10 mb-10">
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="header-white"
                                                                    name="headercolor"
                                                                    class="custom-control-input btn btn-outline-primary header-white"
                                                                    value="1" checked="">
                                                                <label class="custom-control-label"
                                                                    for="header-white">White</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="header-dark" name="headercolor"
                                                                    class="custom-control-input btn btn-outline-primary header-dark"
                                                                    value="2" checked="">
                                                                <label class="custom-control-label"
                                                                    for="header-dark">Dark</label>
                                                            </div>

                                                        </div>

                                                        <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                                                        <div class="sidebar-radio-group pb-10 mb-10">
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebar-light"
                                                                    name="sidebarcolor"
                                                                    class="custom-control-input btn btn-outline-primary sidebar-light"
                                                                    value="1" checked="">
                                                                <label class="custom-control-label"
                                                                    for="sidebar-light">White</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebar-dark"
                                                                    name="sidebarcolor"
                                                                    class="custom-control-input btn btn-outline-primary sidebar-dark"
                                                                    value="2" checked="">
                                                                <label class="custom-control-label"
                                                                    for="sidebar-dark">Dark</label>
                                                            </div>
                                                        </div>

                                                        <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
                                                        <div class="sidebar-radio-group pb-10 mb-10">
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebaricon-1" name="menu_icon"
                                                                    class="custom-control-input" value="1"
                                                                    checked="">
                                                                <label class="custom-control-label" for="sidebaricon-1"><i
                                                                        class="fa fa-angle-down"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebaricon-2" name="menu_icon"
                                                                    class="custom-control-input" value="2">
                                                                <label class="custom-control-label" for="sidebaricon-2"><i
                                                                        class="ion-plus-round"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebaricon-3" name="menu_icon"
                                                                    class="custom-control-input" value="3">
                                                                <label class="custom-control-label" for="sidebaricon-3"><i
                                                                        class="fa fa-angle-double-right"></i></label>
                                                            </div>
                                                        </div>

                                                        <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                                                        <div class="sidebar-radio-group pb-30 mb-10">
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebariconlist-1"
                                                                    name="menu_icon_list" class="custom-control-input"
                                                                    value="1" checked="">
                                                                <label class="custom-control-label"
                                                                    for="sidebariconlist-1"><i
                                                                        class="ion-minus-round"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebariconlist-2"
                                                                    name="menu_icon_list" class="custom-control-input"
                                                                    value="2">
                                                                <label class="custom-control-label"
                                                                    for="sidebariconlist-2"><i class="fa fa-circle-o"
                                                                        aria-hidden="true"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebariconlist-3"
                                                                    name="menu_icon_list" class="custom-control-input"
                                                                    value="3">
                                                                <label class="custom-control-label"
                                                                    for="sidebariconlist-3"><i
                                                                        class="dw dw-check"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebariconlist-4"
                                                                    name="menu_icon_list" class="custom-control-input"
                                                                    value="4" checked="">
                                                                <label class="custom-control-label"
                                                                    for="sidebariconlist-4"><i
                                                                        class="icon-copy dw dw-next-2"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebariconlist-5"
                                                                    name="menu_icon_list" class="custom-control-input"
                                                                    value="5">
                                                                <label class="custom-control-label"
                                                                    for="sidebariconlist-5"><i
                                                                        class="dw dw-fast-forward-1"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="sidebariconlist-6"
                                                                    name="menu_icon_list" class="custom-control-input"
                                                                    value="6">
                                                                <label class="custom-control-label"
                                                                    for="sidebariconlist-6"><i
                                                                        class="dw dw-next"></i></label>
                                                            </div>
                                                        </div>

                                                        <div class="reset-options pt-30 text-center">
                                                            <input type="submit" class="btn btn-primary"
                                                                value="Update Appearance">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <!-- Appearance Tab End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- add sweet alert js & css in footer -->
    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>

    <script type="text/javascript">
        function showAlert(type, message) {
            $('#status').collapse('show')
                .find('.alert')
                .addClass(type)
                .html(message);
        }

        $('#frm-appearance,#frm-site').submit(function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            let url = $(this).attr('action');
            let method = $(this).attr('method')
            swal({
                title: 'Are you sure?',
                text: "You want to save this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yes, save it!'
            }).then(function() {
                $.ajax({
                    url: url,
                    type: method,
                    data: data,
                    beforeSend: () => {
                        $(".pre-loader").show();
                    },
                    success: (response) => {

                        return setTimeout(() => {
                            $(".pre-loader").hide();
                            showAlert('alert-success', response.message);
                            //window.location = '{{ route_to('products.index') }}';
                        }, 5000);

                    },
                    error: ({
                        responseJSON
                    }) => {
                        $(".pre-loader").hide();
                        console.log(responseJSON)
                        // $.each(responseJSON.messages, (key, val) => {
                        //     $('#' + key).addClass('is-invalid')
                        //         .after('<small class="invalid-feedback">' +
                        //             val +
                        //             '</small>');

                        //     if (key === 'error') {
                        //         showAlert('alert-danger', val);
                        //     }
                        // });

                        // if (responseJSON.message) {
                        //     showAlert('alert-danger', responseJSON.message);
                        // }
                    }
                })


            });
        });
        // $('#frm-site').submit(function(e) {
        //     e.preventDefault();
        //     let data = $(this).serialize();
        //     let url = $(this).attr('action');
        //     let method = $(this).attr('method')
        //     swal({
        //         title: 'Are you sure?',
        //         text: "You want to save this!",
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonClass: 'btn btn-success',
        //         cancelButtonClass: 'btn btn-danger',
        //         confirmButtonText: 'Yes, save it!'
        //     }).then(function() {
        //         $.ajax({
        //             url: url,
        //             type: method,
        //             data: data,
        //             beforeSend: () => {
        //                 $(".pre-loader").show();
        //             },
        //             success: (response) => {

        //                 return setTimeout(() => {
        //                     $(".pre-loader").hide();
        //                     showAlert('alert-success', response.message);
        //                     //window.location = '{{ route_to('products.index') }}';
        //                 }, 5000);

        //             },
        //             error: ({
        //                 responseJSON
        //             }) => {
        //                 $(".pre-loader").hide();
        //                 console.log(responseJSON)
        //                 // $.each(responseJSON.messages, (key, val) => {
        //                 //     $('#' + key).addClass('is-invalid')
        //                 //         .after('<small class="invalid-feedback">' +
        //                 //             val +
        //                 //             '</small>');

        //                 //     if (key === 'error') {
        //                 //         showAlert('alert-danger', val);
        //                 //     }
        //                 // });

        //                 // if (responseJSON.message) {
        //                 //     showAlert('alert-danger', responseJSON.message);
        //                 // }
        //             }
        //         })


        //     });
        // });
    </script>
@endpush
