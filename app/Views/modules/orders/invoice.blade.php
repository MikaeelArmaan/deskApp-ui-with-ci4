<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td valign="top">
                {{-- <img src="{{ asset('images/meteor-logo.png') }}" alt="" width="150" /></td> --}}
            <td align="right">
                <h3>Shinra Electric power company</h3>
                <pre>
                Company representative name
                Company address
                Tax ID
                phone
                fax
            </pre>
            </td>
        </tr>

    </table>

    <table width="100%">
        <tr>
            <td align="left">
                <pre><strong>To:</strong>
                Name : {{ $customerDetail->firstname . ' ' . $customerDetail->firstname }},
                Email : {{ $customerDetail->email }},
                Mobile : {{ $customerDetail->telephone }}
            </pre>
            </td>
            <td align="left"><strong>Shipping Address:</strong>
                <pre>{{ $shippingAddress->address1 }},
                @if ($shippingAddress->address2)
{{ $shippingAddress->address2 }},
@endif
                {{ $shippingAddress->locality }},
                {{ $shippingAddress->city . ' - ' . $shippingAddress->pincode }},
                {{ $shippingAddress->state . ' ' . $shippingAddress->country }}
                </pre>
            </td>
            <td align="left"><strong>Billing Address:</strong>
                <pre>{{ $billingAddress->address1 }},
                @if ($billingAddress->address2)
{{ $billingAddress->address2 }},
@endif
                {{ $billingAddress->locality }},
                {{ $billingAddress->city . ' - ' . $billingAddress->pincode }},
                {{ $billingAddress->state . ' ' . $billingAddress->country }}
              </pre>
            </td>
            <td align="left"><strong>Order:</strong>
                <pre>Invoice Number : {{ $orderDetail->invoice_no }},
                Invoice Date : {{ $orderDetail->invoice_date }},
                Est. Delivery Date: {{ $orderDetail->delivery_date }}
                </pre>
            </td>
        </tr>

    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>HSN</th>
                <th>Quantity</th>
                <th>GST %</th>
                <th>Unit Price </th>
                <th>GST Price </th>
                <th>Discount Price </th>
                <th>Total </th>
            </tr>
        </thead>
        <tbody>
            @if ($orderedProducts)
                @foreach ($orderedProducts as $key => $product)
                    <tr>
                        <th scope="row">{{ 1 + $key }}</th>
                        <td>{{ $product->name }}</td>
                        <td align="right">{{ $product->hsn }}</td>
                        <td align="right">{{ $product->gst }}</td>
                        <td align="right">{{ $product->quantity }}</td>
                        <td align="right">{{ $product->unitprice }}</td>
                        <td align="right">{{ $product->gst_price }}</td>
                        <td align="right">{{ $product->discount_price }}</td>
                        <td align="right">{{ $product->price }}</td>
                    </tr>
                @endforeach
            @endif

        </tbody>

        <tfoot>
            <tr class="gray">
                <td colspan="7"></td>
                <td align="right">Subtotal &#8377;</td>
                <td align="right">{{ $orderDetail->product_total }}</td>
            </tr>
            <tr>
                <td colspan="7"></td>
                <td align="right">GST </td>
                <td align="right">{{ $orderDetail->gst_total }}</td>
            </tr>
            <tr>
                <td colspan="7"></td>
                <td align="right">Discount </td>
                <td align="right" class="gray">{{ $orderDetail->discount_amount }}</td>
            </tr>
            <tr>
                <td colspan="7"></td>
                <td align="right">Total </td>
                <td align="right" class="gray">{{ $orderDetail->grand_total }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
