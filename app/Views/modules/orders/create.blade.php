@extends('theme.main')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="src/plugins/switchery/switchery.min.css">

    <link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/jquery.steps.css">
    {{-- Custom css  --}}
    <link rel="stylesheet" type="text/css" href="src/styles/custom.css">
@endpush
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div id="alert" class="collapse">
                <div class="alert" role="alert"></div>
            </div>

            <div class="pd-20 card-box mb-30">
               
                <form>

                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <h4 class="text-blue h4 pull-left">Order Create</h4>
                            <a href="#" class="btn btn-primary btn-sm scroll-click pull-right" rel="content-y" data-toggle="collapse"
                                role="button"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                        <div class="wizard-content">
                            <div class="tab-wizard wizard-circle wizard vertical">
                                <h5>Order Info</h5>
                                <section>
                                    <div class="dropdown-divider"></div>
                                    <div class="row  mb-20">
                                        <div class="col-md-4 col-sm-12">
                                            <label for="invoice_number" class="col-sm-2">
                                                <span
                                                    class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Invoice_Number</span></label>
                                            <input type="text" class="form-control mt-n3 " id="invoice_number">
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <label for="invoice_date" class="col-sm-2">
                                                <span
                                                    class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Invoice_Date</span></label>
                                            <input type="text" class="form-control mt-n3 " id="invoice_date">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label for="delivery_date" class="col-sm-2">
                                                <span
                                                    class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Delivery_Date</span></label>
                                            <input type="text" class="form-control mt-n3" id="delivery_date">
                                        </div>
                                    </div>
                                    <div class="row mb-20">
                                        <div class="col-md-12 col-sm-12">
                                            <select class="form-control custom-select2" id="customer_id" aria-label="">
                                                @if ($customers)
                                                    <option selected="selected">{{ 'Select Partner' }}</option>
                                                    @foreach ($customers as $key => $item)
                                                        <option value="{{ $key }}"
                                                            {{ $order !== null && $key == $order->customer_id ? 'selected' : '' }}>
                                                            {{ $item }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </section>
                                <!-- Step 2 -->
                                <h5>Order Items</h5>
                                <section>
                                    <div class="dropdown-divider"></div>
                                    <div class="row">
                                        <div class="clearfix">
                                            <h6 class="text-blue h6">Add Items/Product</h6>
                                        </div>
                                        <div class="col-md-12 col-sm-12 table-responsive">
                                            <table class="table table-bordered " id="items">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Item</th>
                                                        <th scope="col">HSN Code</th>
                                                        <th scope="col">Qnty</th>
                                                        <th scope="col">
                                                            Price/Unit<br /><small>Sale/Retailer/Distributor/Purchase</small>
                                                        </th>
                                                        <th scope="col">Discount</th>
                                                        <th scope="col">GST</th>
                                                        <th scope="col">Amount</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="items-body"></tbody>

                                                <tfoot>
                                                    <tr scope="row" id="items-footer">
                                                        <td scope="col"></td>
                                                        <td scope="col">
                                                            <span class="btn btn-block btn-light btn-outline-success btn-sm"
                                                                id="add-item" onclick="addRow()">Add
                                                                item
                                                            </span>
                                                        </td>
                                                        <td scope="col"></td>
                                                        <td scope="col" data-totalQnty="" class="totalQnty">
                                                        </td>
                                                        <td scope="col" data-totalUnitPrice="" class="totalUnitPrice">
                                                        </td>
                                                        <td scope="col" data-totalDiscount="" class="totalDiscount"></td>
                                                        <td scope="col" data-totalGstAmount="" class="totalGstAmount">
                                                        </td>
                                                        <td scope="col" data-totalAmount="" class="totalAmount"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <div class="clearfix">
                                            <h6 class="text-blue h6">Grand Total Adjustment</h6>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label for="order_total" class="col-sm-2">
                                                <span
                                                    class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Order_total</span></label>
                                            <input type="text" name="order_total" readonly class="form-control mt-n3 "
                                                id="order_total">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label for="order_gst" class="col-sm-2">
                                                <span
                                                    class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Order_gst</span></label>
                                            <input type="text" name="order_gst" class="form-control mt-n3 "
                                                id="order_gst">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label for="order_discount" class="col-sm-2">
                                                <span
                                                    class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Order_discount</span></label>
                                            <input type="text" name="order_discount" class="form-control mt-n3 "
                                                id="order_discount">
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <label for="currently_paid" class="col-sm-2">
                                                <span
                                                    class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Currently_paid</span></label>
                                            <input type="text" name="currently_paid" class="form-control mt-n3 "
                                                id="currently_paid">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label for="current_balance" class="col-sm-2">
                                                <span
                                                    class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Current_balance</span></label>
                                            <input type="text" name="current_balance" class="form-control mt-n3 "
                                                id="current_balance">
                                        </div>

                                </section>
                                <!-- Step 3 -->
                                <h5>Order Address</h5>
                                <section>
                                    <div class="dropdown-divider"></div>
                                    <div class="row mt-5">

                                        <div class="col-md-12 form-group custom-control custom-radio ml-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="addressNew" name="address" value="new"
                                                    class="custom-control-input form-check-input">

                                                <label class="custom-control-label form-check-label" for="addressNew">New
                                                    Address</label>
                                            </div>
                                            <div class="form-check form-check-inline">

                                                <input type="radio" id="addressExist" name="address" value="exist"
                                                    class="custom-control-input form-check-input">
                                                <label class="custom-control-label form-check-label"
                                                    for="addressExist">Existing
                                                    Address</label>

                                            </div>

                                        </div>
                                        <div class="col-md-12 form-group addressExist">
                                            <select class="form-control custom-select2" id="address" aria-label="">
                                                <option value="">{{ 'Select Address' }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 addressNew">
                                            <div class="form-group">
                                                <label>address1</label>
                                                <input type="text" class="form-control" name="address1">
                                            </div>

                                        </div>
                                        <div class="col-md-6 addressNew">
                                            <div class="form-group">
                                                <label>address2 <small>(Optional)</small></label>
                                                <input type="text" class="form-control" name="address2">
                                                <input type="hidden" class="form-control" name="type">
                                            </div>
                                        </div>
                                        <div class="col-md-6 addressNew">
                                            <div class="form-group">
                                                <label>Locality <small>*</small></label>
                                                <input type="text" class="form-control" name="locality">
                                            </div>
                                        </div>
                                        <div class="col-md-6 addressNew">
                                            <div class="form-group">
                                                <label>city <small>*</small></label>
                                                <input type="text" class="form-control" name="city">
                                            </div>
                                        </div>

                                        <div class="col-md-6 addressNew">
                                            <div class="form-group">
                                                <label>Pincode <small>*</small></label>
                                                <input type="text" class="form-control" name="pincode">
                                            </div>
                                        </div>

                                        <div class="col-md-6 addressNew">
                                            <div class="form-group">
                                                <label>State <small>*</small></label>
                                                <input type="text" class="form-control" name="state">
                                            </div>
                                        </div>

                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- success Popup html Start -->
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Form Submitted!</h3>
                    <div class="mb-30 text-center"><img src="vendors/images/success.png"></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html End -->
@endsection

@push('scripts')
    <!-- switchery js -->
    <script src="src/plugins/switchery/switchery.min.js"></script>
    <script src="vendors/scripts/advanced-components.js"></script>
    <!-- add sweet alert js & css in footer -->
    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>

    <script src="src/plugins/jquery-steps/jquery.steps.js"></script>
    <script src="vendors/scripts/steps-setting.js"></script>

    <script type="text/javascript">
        $("#invoice_date,#delivery_date").datepicker({
            language: 'en',
            autoClose: true,
            dateFormat: 'dd/mm/yyyy',
        });

        $("#addressExist").on('click', () => {
            $(".addressExist").css('display', 'block');
            $(".addressNew").css('display', 'none');
        });

        $("#addressNew").on('click', () => {
            $(".addressNew").css('display', 'block');
            $(".addressExist").css('display', 'none');
        });

        let calculateProductAmount = (id) => {
            const selectedRowId = id;
            const row = $(`#${selectedRowId}`);
            const qnty = row.find('.qnty input').val();
            const unitPrice = row.find('.price input').val();
            const discountPrice = row.find('.discount input').val() == '' ? 0 : row.find('.discount input').val();
            const gst = row.find('.gst')
                .data('gst');
            let currentProductPrice = (unitPrice * qnty) - discountPrice;
            gstAmount = currentProductPrice * (gst / 100)
            currentProductPrice += gstAmount;
            row.find('.productamount').empty()
                .attr('data-productamount', currentProductPrice)
                .append(currentProductPrice);
            row.find('.gst small').empty()
                .attr('data-gstAmount', gstAmount)
                .append(gstAmount);
            setTimeout(() => {
                calculateTotal();
            }, 1000);
        }

        let calculateTotal = () => {
            const row = $('#items-body tr');
            let totalQnty = 0;
            let totalUnitPrice = 0;
            let totalDiscount = 0;
            let totalGstAmount = 0;
            let totalAmount = 0;
            for (i = 0; i < row.length; i++) {
                totalQnty += parseFloat(row.eq(i).find('.qnty input').val());
                totalUnitPrice += parseFloat(row.eq(i).find('.price input').val());
                totalDiscount += parseFloat(row.eq(i).find('.discount input').val());
                totalGstAmount += parseFloat(row.eq(i).find('.gst small').data('gstamount'));
                totalAmount += parseFloat(row.eq(i).find('.productamount').data('productamount'));
            }
            totalQnty = totalQnty.toFixed(2);
            totalUnitPrice = totalUnitPrice.toFixed(2);
            totalDiscount = totalDiscount.toFixed(2);
            totalGstAmount = totalGstAmount.toFixed(2);
            totalAmount = totalAmount.toFixed(2);

            const itemFooter = $('#items-footer');
            itemFooter.find('.totalQnty').empty().data('totalQnty', totalQnty).append(totalQnty);
            itemFooter.find('.totalUnitPrice').empty().data('totalUnitPrice', totalUnitPrice).append(totalUnitPrice);
            itemFooter.find('.totalDiscount').empty().data('totalDiscount', totalDiscount).append(totalDiscount);
            itemFooter.find('.totalGstAmount').empty().data('totalGstAmount', totalGstAmount).append(totalGstAmount);
            itemFooter.find('.totalAmount').empty().data('totalAmount', totalAmount).append(totalAmount);
        }
        const $products = {!! json_encode($products->toArray()) !!};
        let itemSelected = (id) => {
            const selectedRowId = id;
            const product = $(`#product_${selectedRowId} :selected`).data('product');
            const row = $(`tr#${selectedRowId}`);
            row.find('.hsn').empty().append(product.hsn);
            row.find('.qnty small').empty().append('Remaining :' + product.quantity);
            row.find('.price input').empty().val(product.sale_price);
            let priceInfo = product.sale_price + '/' + product.retailer_price +
                '/' + product.distributor_price + '/' + product.purchase_price;
            row.find('.price small').empty().append(priceInfo);
            row.find('.discount input').empty().val(0);
            row.find('.gst').empty().append(product.gst + '<br/><small data-gstAmount=""></small>').attr('data-gst',
                product.gst);
        }

        let itemRowId = 1;

        let addRow = () => {
            var $tableBody = $('#items-body');
            $tableBody.append(rowTrIndex(itemRowId));
            $trLast = $tableBody.find("tr:last");
            $(".custom-select2").select2();
            itemRowId += 1;
        };

        let rowTrIndex = (id) => {
            $itemRow = `<tr class="form-group" scope="row" id="${id}">`;
            $itemRow +=
                `<td class="" scope="col"><i class="fa fa-remove text-danger" onclick="remove(${id})"></i></td>`;
            $itemRow += '<td class="product " scope="col">';
            $itemRow +=
                `<select id='product_${id}' onChange='itemSelected(${id})'  class="custom-select2 form-control-sm">`;
            let $option = "<option value=''>Select Item</option>";
            if ($products.length > 0) {
                for ($i = 0; $i < $products.length; $i++) {
                    $option +=
                        `<option value="${$products[$i].id}" data-product='${JSON.stringify($products[$i])}'>${$products[$i].name}`;
                }
            }
            $itemRow += $option;
            $itemRow += '</select></td>';
            $itemRow += '<td scope="col" class="hsn" data-hsn=""></td>';
            $itemRow += '<td scope="col" class="qnty col-xs-2" data-qnty="">';
            $itemRow += '<input name="qnty" class="form-control" onkeyup="calculateProductAmount(' + id +
                ')" /><small></small></td>';
            $itemRow += '<td scope="col" class="price col-xs-2" data-price="">';
            $itemRow += '<input name="price" onkeyup="calculateProductAmount(' + id +
                ')" class="form-control" /><small></small></td>';
            $itemRow += '<td scope="col" class="discount col-xs-2"  data-discount="">';
            $itemRow += '<input name="discount" onkeyup="calculateProductAmount(' + id +
                ')"  class="form-control" /><small></small></td>';
            $itemRow += '<td scope="col" class="gst" data-gst=""></td>';
            $itemRow += '<td scope="col" class="productamount" data-productamount=""></td>';
            $itemRow += '</tr>';
            return $itemRow;
        }

        let remove = (rowId) => {
            let elementRowId = rowId;
            $(`#row_${elementRowId}`).remove();
        }

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
