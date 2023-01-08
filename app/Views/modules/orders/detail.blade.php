@extends('theme.main')
@push('styles')
    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="src/plugins/switchery/switchery.min.css">
@endpush
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Detail</h1>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div id="alert" class="collapse">
                <div class="alert" role="alert"></div>
            </div>

            <div class="card shadow-sm h-100 py-4">
                <form id="form">
                    <div class="row col-md-12">
                        @csrf
                        <input type="hidden" id="id" name="id"
                            value="{{ $product !== null ? $product->id : '' }}">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name" class="form-control-label">{{ 'Product Name ' }}</label>
                            <input id="name" type="text" class="form-control" name="name"
                                value="{{ $product !== null ? $product->name : '' }}" autofocus>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="category" class="form-control-label">{{ 'Category' }}</label>
                            <select id="category" class="form-control custom-select2 " name="category" autofocus>
                                @if ($category)
                                    <option value="">{{ 'Please Select Category' }}</option>
                                    @foreach ($category as $key => $item)
                                        <option value="{{ $key }}"
                                            selected="{{ $product !== null && $key == $product->category_id ? 'selected' : '' }}">
                                            {{ $item }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="brand_id" class="form-control-label">{{ 'Brand' }}</label>
                            <select id="brand_id" class="form-control custom-select2" name="brand_id" autofocus>
                                @if ($brand)
                                    <option value="">{{ 'Please Select Brand' }}</option>
                                    @foreach ($brand as $key => $item)
                                        <option value="{{ $key }}"
                                            selected="{{ $product !== null && $key == $product->brand_id ? 'selected' : '' }}">
                                            {{ $item }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="retailer_price" class="form-control-label">{{ 'Retailer Price' }}</label>
                            <input id="retailer_price" type="text" class="form-control" name="retailer_price"
                                value="{{ $product !== null ? $product->retailer_price : '' }}" autofocus>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="distributor_price" class="form-control-label">{{ 'Distributor Price' }}</label>
                            <input id="distributor_price" type="text" class="form-control" name="distributor_price"
                                value="{{ $product !== null ? $product->distributor_price : '' }}" autofocus>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="purchase_price" class="form-control-label">{{ 'Purchase Price' }}</label>
                            <input id="purchase_price" type="text" class="form-control" name="purchase_price"
                                value="{{ $product !== null ? $product->purchase_price : '' }}" autofocus>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="sale_price" class="form-control-label">{{ 'Sale Price' }}</label>
                            <input id="sale_price" type="text" class="form-control" name="sale_price"
                                value="{{ $product !== null ? $product->sale_price : '' }}" autofocus>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="hsn" class="form-control-label">{{ 'HSN' }}</label>
                            <input id="hsn" type="text" class="form-control" name="hsn"
                                value="{{ $product !== null ? $product->hsn : '' }}" autofocus>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="gst" class="form-control-label">{{ 'GST' }}</label>
                            <select id="gst" class="form-control custom-select2" name="gst" autofocus>
                                <option value="">Please select GST </option>
                                @foreach (GST as $key => $item)
                                    <option value="{{ $key }}"
                                        {{ $product !== null && $key == $product->gst ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="short_description" class="form-control-label">{{ 'Short Description' }}</label>
                            <input id="short_description" type="text" class="form-control" name="short_description"
                                value="{{ $product !== null ? $product->short_description : '' }}" autofocus>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="description" class="form-control-label">{{ 'Description' }}</label>
                            <textarea autofocus id="description" class="form-control" name="description"
                                placeholder="Enter Description">{{ $product !== null ? $product->description : '' }}</textarea>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="sequence" class="form-control-label">{{ 'order Number' }}</label>
                            <input id="sequence" type="number" class="form-control" name="sequence"
                                value="{{ $product !== null ? $product->sequence : 9999 }}" autofocus>
                        </div>
                        <div class=" form-group col-md-6 col-sm-12">
                            <label for="status" class="col-form-label">Activate:</label>
                            <input id="status" type="checkbox"
                                {{ $product !== null && $product->status ? 'checked' : '' }} data-size="small"
                                class="switch-btn" data-color="#0099ff" data-secondary-color="#28a745" name="status"
                                autofocus placeholder="Enter description...">
                        </div>

                        <hr>
                    </div>
                    <div class="row col-md-12">
                        <div class=" form-group col-md-6 col-sm-12">
                            <a href="{{ route_to('products.index') }}"
                                class="btn btn-secondery btn-outline-dark ">Cancel</a>
                            <button type="submit" id="save" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- switchery js -->
    <script src="src/plugins/switchery/switchery.min.js"></script>
    <script src="vendors/scripts/advanced-components.js"></script>
    <!-- add sweet alert js & css in footer -->
    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>

    <script type="text/javascript">
        function showAlert(type, message) {
            $('#alert').collapse('show')
                .find('.alert')
                .addClass(type)
                .html(message);
        }

        $('#form').submit(function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            let url = '{{ $url }}';
            let method = '{{ $method }}';
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
                            window.location = '{{ route_to('products.index') }}';
                        }, 5000);

                    },
                    error: ({
                        responseJSON
                    }) => {
                        $(".pre-loader").hide();
                        $.each(responseJSON.messages, (key, val) => {
                            $('#' + key).addClass('is-invalid')
                                .after('<small class="invalid-feedback">' + val +
                                    '</small>');

                            if (key === 'error') {
                                showAlert('alert-danger', val);
                            }
                        });

                        if (responseJSON.message) {
                            showAlert('alert-danger', responseJSON.message);
                        }
                    }
                })


            });
        });
    </script>
@endpush
