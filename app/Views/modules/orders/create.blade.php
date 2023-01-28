@extends('theme.main')
@push('styles')
    <link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/jquery.steps.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="src/plugins/switchery/switchery.min.css">
    {{-- Custom css  --}}
    <link rel="stylesheet" type="text/css" href="src/styles/custom.css">
@endpush
@section('content')
    <div class="min-height-200px">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <h4 class="text-blue h4 pull-left">Order Create</h4>
                <a href="#" class="btn btn-primary btn-sm scroll-click pull-right" rel="content-y"
                    data-toggle="collapse" role="button"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <div id="alert" class="collapse">
                <div class="alert" role="alert"></div>
            </div>
            <div class="wizard-content">

                <form class="tab-wizard2 wizard-circle wizard vertical">
                    <h5>Order Info</h5>
                    <section>
                        <div class="dropdown-divider"></div>
                        <div class="row  mb-20">
                            <div class="col-4 col-md-4 col-sm-12">
                                <label for="invoice_number" class="col-sm-2">
                                    <span class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Invoice_Number</span></label>
                                <input type="text" class="form-control mt-n3"
                                    value="{{ $order ? $order->invoice_no : '' }}" name="invoice_number"
                                    id="invoice_number">
                            </div>

                            <div class="col-4 col-md-4 col-sm-12">
                                <label for="invoice_date" class="col-sm-2">
                                    <span class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Invoice_Date</span></label>
                                <input type="text" value="{{ $order ? $order->invoice_date : '' }}"
                                    class="form-control mt-n3" name="invoice_date" id="invoice_date">
                            </div>
                            <div class="col-4 col-md-4 col-sm-12">
                                <label for="delivery_date" class="col-sm-2">
                                    <span class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Delivery_Date</span></label>
                                <input type="text" class="form-control mt-n3"
                                    value="{{ $order ? $order->delivery_date : '' }}" name="delivery_date"
                                    id="delivery_date">
                            </div>
                        </div>
                        <div class="row mb-20">
                            <div class="col-md-6 col-sm-6">
                                <select class="custom-select2 form-control" onChange="customerSelected(this.value);"
                                    name="customer_id" id="customer_id" aria-label="">
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
                            <div class="form-group col-md-6 col-sm-12">
                                <select class="custom-select2 form-control" class="form-control" name="status"
                                    id="status" aria-label="">
                                    @foreach (ORDERSTATUS as $key => $status)
                                        <option value="{{ $key }}"
                                            {{ $order !== null && $order->status == $key ? 'selected' : '' }}>
                                            {{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-20">
                            <div class="col-md-12 col-sm-12 form-group ">
                                <label for="notes" class="col-sm-2">
                                    <span class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Notes</span></label>
                                <textarea rows="2" cols="50" class="form-control  mt-n3" id="notes" name="notes"
                                    placeholder="Add comment">{{ $order !== null && $order->notes ? $order->notes : '' }}</textarea>
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
                                <table class="table table-bordered table-sm" id="items">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">HSN Code</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">
                                                Price/Unit<br /><small>Sale/Retailer/Distributor/Purchase</small>
                                            </th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">GST</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>

                                    <tbody id="items-body">
                                        @if ($orderProducts)
                                            @foreach ($orderProducts as $key => $orderedProduct)
                                                @php
                                                    $qnty = $orderedProduct->quantity;
                                                    $price = $orderedProduct->price;
                                                    $selectedProduct = [];
                                                    $unitPrice = $orderedProduct->unitprice;
                                                @endphp
                                                <tr class="form-group" scope="row" id="{{ $key }}">
                                                    <td class="" scope="col">
                                                        <i class="fa fa-remove text-danger" onclick="remove($key)"></i>
                                                    </td>

                                                    <td class="product col-auto" scope="col">
                                                        <select id='product_{{ $key }}'
                                                            name='product[{{ $key }}][product]'
                                                            onChange='itemSelected({{ $key }})'
                                                            class="custom-select2 form-control-sm">
                                                            <option value=''>Select Item</option>
                                                            @if (count($products) > 0)
                                                                @foreach ($products as $k => $product)
                                                                    @if ($orderedProduct->product_id == $product->id)
                                                                        @php $selectedProduct = $product @endphp
                                                                    @endif
                                                                    <option value="{{ $product->id }}"
                                                                        {{ $orderedProduct->product_id == $product->id ? 'selected=selected' : '' }}
                                                                        data-product='{{ $product->id }}'>
                                                                        {{ $product->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </td>

                                                    <td scope="col" class="hsn col-auto"
                                                        data-hsn="{{ $selectedProduct->hsn }}">
                                                        {{ $selectedProduct->hsn }}</td>
                                                    <td scope="col" class="qnty col-xs-2 col-auto"
                                                        data-qnty="{{ $orderedProduct->quantity }}">
                                                        <input type="number" name="product[{{ $key }}][qnty]"
                                                            class="form-control" value="{{ $orderedProduct->quantity }}"
                                                            onkeyup="calculateProductAmount({{ $key }})" />
                                                        <small>Rem : {{ $selectedProduct->quantity }}</small>
                                                    </td>

                                                    <td scope="col" class="unitprice col-xs-2 col-auto"
                                                        data-unitprice="{{ $unitPrice }}">
                                                        <input type="number"
                                                            name="product[{{ $key }}][unitprice]"
                                                            onkeyup="calculateProductAmount({{ $key }})"
                                                            value="{{ $unitPrice }}" class="form-control" />
                                                        <small>{{ $selectedProduct->sale_price .
                                                            '/' .
                                                            $selectedProduct->retailer_price .
                                                            '/' .
                                                            $selectedProduct->distributor_price .
                                                            '/' .
                                                            $selectedProduct->purchase_price }}</small>
                                                    </td>
                                                    <td scope="col" class="discount col-xs-2 col-auto"
                                                        data-discount="{{ $orderedProduct->discount_price }}">
                                                        <input type="number"
                                                            name="product[{{ $key }}][discount]"
                                                            value="{{ $orderedProduct->discount_price }}"
                                                            onkeyup="calculateProductAmount({{ $key }})"
                                                            class="form-control" /><small>{{ $selectedProduct->discount_price }}</small>
                                                    </td>
                                                    <td scope="col" class="gst col-auto"
                                                        data-gst="{{ $orderedProduct->gst_price }}">
                                                        <input type="hidden"
                                                            name="product[{{ $key }}][gstamount]"
                                                            value='{{ $orderedProduct->gst_price }}'>
                                                        {{ $selectedProduct->gst }}<br /><small>{{ $orderedProduct->gst_price }}</small>
                                                    </td>
                                                    <td scope="col" class="productamount col-auto"
                                                        data-productamount="{{ $price }}">
                                                        <input type="hidden" value="{{ $price }}"
                                                            name='product[{{ $key }}][productamount]'>
                                                        {{ $price }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>

                                    <tfoot id="items-footer">

                                        <td scope="col"></td>
                                        <td scope="col">
                                            <span class="btn btn-block btn-light btn-outline-success btn-sm"
                                                id="add-item" onclick="addRow()">Add
                                                item
                                            </span>
                                        </td>
                                        <td scope="col"></td>
                                        <td scope="col" data-totalqnty="" class="totalQnty">
                                        </td>
                                        <td scope="col" data-totalunitprice="" class="totalUnitPrice">
                                        </td>
                                        <td scope="col" data-totaldiscount="" class="totalDiscount"></td>
                                        <td scope="col" data-totalgstamount="" class="totalGstAmount">
                                        </td>
                                        <td scope="col" data-totalamount="a" class="totalAmount"></td>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="clearfix">
                                <h6 class="text-blue h6">Grand Total Adjustment</h6>
                            </div>
                            <div class="col-6 col-md-4 col-sm-12">
                                <label for="grand_total" class="col-sm-2">
                                    <span class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Grand_total</span></label>
                                <input type="text" value="{{ $order ? $order->grand_total : '' }}" name="grand_total"
                                    readonly class="form-control mt-n3 " id="grand_total">
                            </div>
                            <div class="col-6 col-md-4 col-sm-12">
                                <label for="order_total" class="col-sm-2">
                                    <span class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Order_total</span></label>
                                <input type="text" value="{{ $order ? $order->grand_total : '' }}" name="order_total"
                                    readonly class="form-control mt-n3 " id="order_total">
                            </div>
                            <div class="col-6 col-md-4 col-sm-12">
                                <label for="order_gst" class="col-sm-2">
                                    <span class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Order_gst</span></label>
                                <input type="text" name="order_gst" value="{{ $order ? $order->gst_total : '' }}"
                                    readonly class="form-control mt-n3 " id="order_gst">
                            </div>
                            <div class="col-6 col-md-4 col-sm-12">
                                <label for="current_balance" class="col-sm-2">
                                    <span
                                        class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Current_balance</span></label>
                                <input type="text" value="{{ $order ? $order->current_balance : '' }}"
                                    name="current_balance" readonly class="form-control mt-n3 " id="current_balance">
                            </div>
                            <div class="col-6 col-md-4 col-sm-12">
                                <label for="order_discount" class="col-sm-2">
                                    <span class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Order_discount</span></label>
                                <input type="text" value="{{ $order ? $order->discount_amount : '' }}"
                                    name="order_discount" class="form-control mt-n3 " id="order_discount">
                            </div>

                            <div class="col-6 col-md-4 col-sm-12 mb-20">
                                <label for="currently_paid" class="col-sm-2">
                                    <span class="h6 small bg-white text-muted pt-1 pl-2 pr-2">Currently_paid</span></label>
                                <input type="text" value="{{ $order ? $order->currently_paid : '' }}"
                                    name="currently_paid" class="form-control mt-n3 " id="currently_paid">
                            </div>
                    </section>
                    <!-- Step 3 -->
                    <h5>Order Address</h5>
                    <section>
                        <div class="dropdown-divider"></div>
                        <div class="row  clearfix">

                            <div class="col-md-12 form-group custom-radio ml-2">
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="addressNew" name="address" value="new"
                                        class="custom-control-input form-check-input">

                                    <label class="custom-control-label form-check-label" for="addressNew">New
                                        Address</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="addressExist" name="address" value="exist"
                                        {{ $customerAddress ? 'checked' : '' }}
                                        class="custom-control-input form-check-input">
                                    <label class="custom-control-label form-check-label" for="addressExist">Existing
                                        Address</label>

                                </div>

                            </div>
                        </div>

                        <div class="row clearfix  addressExist" style="{{ $customerAddress ? 'display:flex' : '' }}">
                            @if ($customerAddress)
                                {{-- <select class="custom-select2 form-control-sm" id="address"> --}}
                                @foreach ($customerAddress as $k => $address)
                                    <div class="col-md-4 col-sm-12 mb-30 address-card">
                                        <div class="card card-box">
                                            <div class="card-header">
                                                <div class="form-check form-check-inline custom-radio">
                                                    <input type="radio" name="order_addres"
                                                        {{ $address->id == $order->shipping_address_id ? 'checked' : '' }}
                                                        id="order_address_{{ $address->id }}"
                                                        value="{{ $address->id }}"
                                                        class="custom-control-input form-check-input">
                                                    <label class="custom-control-label form-check-label"
                                                        for="order_address_{{ $address->id }}">
                                                        Pincode : {{ $address->pincode }}</label>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title ">{{ $address->locality }}</h5>
                                                <p class="card-text">
                                                    {{ $address->address }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- </select> --}}
                            @endif
                            {{-- <select class="form-control" id="address" aria-label="">
                                            <option value="">{{ 'Select Address' }}</option>
                                        </select> --}}
                        </div>
                        <div class="row clearfix">
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
                </form>
            </div>
        </div>
    </div>

    <!-- success Popup html Start -->
    {{-- <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
    </div> --}}
    <!-- success Popup html End -->
@endsection

@push('scripts')
    <script src="src/plugins/jquery-steps/jquery.steps.js"></script>
    <script src="vendors/scripts/steps-setting.js"></script>
    <!-- switchery js -->
    <script src="src/plugins/switchery/switchery.min.js"></script>
    <script src="vendors/scripts/advanced-components.js"></script>
    <!-- add sweet alert js & css in footer -->
    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // $("select").select2();
            $('.switch-btn').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
            jQuery("#invoice_date,#delivery_date").datepicker({
                language: "en",
                autoClose: !0,
                dateFormat: "dd-mm-yyyy"
            });

            $("#addressExist").on('click', () => {
                $(".addressExist").css('display', 'flex');
                $(".addressNew").css('display', 'none');
            });
            $("#addressNew").on('click', () => {
                $(".addressNew").css('display', 'block');
                $(".addressExist").css('display', 'none');
            });
            $("#order_discount").on('keyup', function() {
                let totalDiscount = $(this).val();
                let currentPaid = Number($('#currently_paid').val());
                let newOrderTotal = 0;
                let newBalance = 0;
                if (Number(productsDiscount) != Number(orderDiscount)) {
                    orderTotal = Number($('.totalAmount').data('totalamount'))
                    newBalance = orderTotal - currentPaid - orderDiscount;

                    newOrderTotal = orderTotal - totalDiscount;
                    newBalance = newOrderTotal - currentPaid;
                }

                $('#order_total').empty().val(newOrderTotal);
                $('#current_balance').empty().val(newBalance);
            })
            $("#currently_paid").on('keyup', function() {
                let currentPaid = $(this).val();
                let productsDiscount = $(".totalDiscount").data('totaldiscount');
                let orderDiscount = Number($('#order_discount').val());
                let newBalance = 0;

                if (Number(productsDiscount) != Number(orderDiscount)) {
                    orderTotal = Number($('.totalAmount').data('totalamount'))
                    newBalance = orderTotal - currentPaid - orderDiscount;
                } else
                    newBalance = orderTotal - currentPaid;
                $('#current_balance').empty().val(Number(newBalance.toFixed()));
            })
        });


        let grandTotal = 0;
        let orderTotal = 0;
        let calculateProductAmount = (id) => {
            const selectedRowId = id;
            const row = $(`#${selectedRowId}`);
            const qnty = row.find('.qnty input').val();
            const unitPrice = row.find('.unitprice input').val();
            const discountPrice = (qnty != 0 || qnty != "") ? (row.find('.discount input').val() == '' ? 0 : row.find(
                '.discount input').val()) : 0;
            const gst = row.find('.gst').data('gst');
            let currentProductPrice = (qnty != 0 || qnty != "") ? ((Number(unitPrice) * Number(qnty)) - Number(
                discountPrice)) : 0;

            gstAmount = (qnty != 0 || qnty != "") ? Number(currentProductPrice * (gst / 100)) : 0;
            currentProductPrice += gstAmount;

            row.find('.productamount')
                .removeData('productamount')
                .attr('data-productamount', currentProductPrice)
                .empty()
                .append(`<input type="hidden" name="product[${id}][productamount]" value='${currentProductPrice}'>` +
                    currentProductPrice);

            row.find('.gst small')
                .removeData('gstAmount')
                .attr('data-gstAmount', gstAmount)
                .empty()
                .append(`<input type="hidden" name="product[${id}][gstamount]" value='${gstAmount.toFixed(2)}'>` +
                    gstAmount.toFixed(2));
            $('#order_discount').attr('readonly', (discountPrice != "" && discountPrice != 0) ? true : false);
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
                totalUnitPrice += parseFloat(row.eq(i).find('.unitprice input').val());
                totalDiscount += parseFloat(row.eq(i).find('.discount input').val());
                totalGstAmount += parseFloat(row.eq(i).find('.gst small').removeData().data('gstamount'));
                totalAmount += parseFloat(row.eq(i).find('.productamount').removeData().data(
                    'productamount'));
            }
            totalQnty = isNaN(totalQnty) ? 0 : totalQnty.toFixed(2);
            totalUnitPrice = totalUnitPrice.toFixed(2);
            totalDiscount = isNaN(totalDiscount) ? 0 : totalDiscount.toFixed(2);
            totalGstAmount = isNaN(totalGstAmount) ? 0 : totalGstAmount.toFixed(2);
            totalAmount = isNaN(totalAmount) ? 0 : totalAmount.toFixed(2);

            const itemFooter = $('#items-footer');
            itemFooter.find('.totalQnty')
                .removeData('totalqnty')
                .attr('data-totalqnty', totalQnty)
                .empty()
                .append(totalQnty);
            itemFooter.find('.totalUnitPrice')
                .removeData('totalunitprice')
                .attr('data-totalunitprice', totalUnitPrice)
                .empty()
                .append(totalUnitPrice);
            itemFooter.find('.totalDiscount')
                .removeData('totaldiscount')
                .attr('data-totaldiscount', totalDiscount)
                .empty()
                .append(totalDiscount);
            itemFooter.find('.totalGstAmount')
                .removeData('totalgstamount')
                .attr('data-totalgstamount', totalGstAmount)
                .empty()
                .append(totalGstAmount);
            itemFooter.find('.totalAmount')
                .removeData('totalamount')
                .attr('data-totalamount', totalAmount)
                .empty()
                .append(totalAmount);

            grandTotal = orderTotal = Number(totalAmount);
            $('#grand_total').val(grandTotal);
            $('#order_total')
                .val(orderTotal);
            $('#order_gst').val(totalGstAmount);
            $('#order_discount').val(totalDiscount);
            $(
                '#currently_paid').val(0);
            $('#current_balance').val(orderTotal);
        }

        const $products = {!! json_encode($products->toArray()) !!};
        let itemSelected = (id) => {
            const selectedRowId = id;
            const product = $(`#product_${selectedRowId} :selected`).data('product');
            const row = $(`tr#${selectedRowId}`);
            row.find('.hsn')
                .empty()
                .append(product.hsn);
            row.find('.qnty small')
                .empty()
                .append('Rem :' + product.quantity);
            row.find('.unitprice input')
                .empty()
                .val(product.sale_price);
            let priceInfo = product.sale_price + '/' + product.retailer_price +
                '/' + product.distributor_price + '/' + product.purchase_price;
            row.find('.unitprice small')
                .empty()
                .append(priceInfo);
            row.find('.discount input')
                .empty()
                .val(0);
            row.find('.gst')
                .removeData('gst')
                .attr('data-gst', product.gst)
                .empty()
                .append(product.gst + '<br/><small data-gstAmount=""></small>');
        }

        let itemRowId = '{{ $orderProducts ? count($orderProducts) : 1 }}';;

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
                `<select id='product_${id}' name='product[${id}][product]' onChange='itemSelected(${id})'  class="custom-select2 form-control-sm">`;
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
            $itemRow +=
                `<input type="number" name="product[${id}][qnty]" class="form-control" onkeyup="calculateProductAmount(${id})" /><small></small></td>`;
            $itemRow += '<td scope="col" class="unitprice col-xs-2" data-unitprice="">';
            $itemRow +=
                `<input type="number" name="product[${id}][unitprice]" onkeyup="calculateProductAmount(${id})" class="form-control" /><small></small></td>`;
            $itemRow += '<td scope="col" class="discount col-xs-2"  data-discount="">';
            $itemRow +=
                `<input type="number" name="product[${id}][discount]" onkeyup="calculateProductAmount(${id})"  class="form-control" /><small></small></td>`;
            $itemRow += '<td scope="col" class="gst" data-gst=""></td>';
            $itemRow += '<td scope="col" class="productamount" data-productamount="" >';
            $itemRow += `<input type="hidden" name='product[${id}][productamount]'></td>`;
            $itemRow += '</tr>';
            return $itemRow;
        }

        let customerSelected = (id) => {
            if (id) {
                let customerId = id;
                let url = "{{ route_to('address.by') }}";
                // let type = 'GET';
                let _data = {
                    belongsto: id,
                    type: 1,
                };
                $.ajax({
                        data: _data,
                        url: url,
                        type: "POST",
                        datatype: "json",
                        success: (response) => {
                            if (response.status == 200) {
                                let option = "";
                                const addresses = response.data;
                                $(".addressExist").html("");
                                let existCard = "";
                                for (i = 0; i < addresses.length; i++) {
                                    existCard +=
                                        '<div class="col-md-4 col-sm-12 mb-30 address-card">';
                                    existCard += '<div class="card card-box">';
                                    existCard += '<div class="card-header">';
                                    existCard +=
                                        '<div class="form-check form-check-inline custom-radio">';
                                    existCard +=
                                        '<input type="radio" name="order_addres" id="order_address_' +
                                        addresses[i].id + '" value="' + addresses[i].id +
                                        '" class="custom-control-input form-check-input">';
                                    existCard +=
                                        '<label class="custom-control-label form-check-label" for="order_address_' +
                                        addresses[i].id + '">';
                                    existCard += addresses[i].pincode + '</label>';
                                    existCard += '</div></div>';
                                    existCard += '<div class="card-body">';
                                    existCard += '<h5 class="card-title ">';
                                    existCard += addresses[i].locality + '</h5>';
                                    existCard += '<p class="card-text">';
                                    existCard += addresses[i].address +
                                        '</p>';
                                    existCard += '</div></div></div>';


                                };
                                $(".addressExist").append(existCard);
                            }
                        },
                        error: (response) => {
                            console.log(response)
                        }
                    })
                    .always(() => {
                        //$(this).prop('disabled', false);
                    });
            }
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

        $(".tab-wizard2").steps({
            headerTag: "h5",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Submit"
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
                $('.steps .current').prevAll().addClass('disabled');
            },
            onFinished: function(event, currentIndex) {
                event.preventDefault();
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
                                window.location = '{{ route_to('orders.index') }}';
                            }, 3000);

                        },
                        error: ({
                            responseJSON
                        }) => {
                            $(".pre-loader").hide();
                            $.each(responseJSON.messages, (key, val) => {
                                $('#' + key).addClass('is-invalid')
                                    .after(
                                        '<small class="invalid-feedback">' +
                                        val +
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
            }
        });

        $('form').submit(function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            let url = '{{ $url }}';
            let method = '{{ $method }}';
            Swal({
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
                            window.location =
                                '{{ route_to('products.index') }}';
                        }, 5000);

                    },
                    error: ({
                        responseJSON
                    }) => {
                        $(".pre-loader").hide();
                        $.each(responseJSON.messages, (key, val) => {
                            $('#' + key).addClass('is-invalid')
                                .after('<small class="invalid-feedback">' +
                                    val +
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
