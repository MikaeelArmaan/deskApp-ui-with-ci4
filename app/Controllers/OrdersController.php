<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AddressModel;
use App\Models\CustomersModel;
use App\Models\OrderProductsModel;
use App\Models\OrdersModel;
use App\Models\ProductsModel;
use Irsyadulibad\DataTables\DataTables;
use Illuminate\Database\Capsule\Manager as DB;

use Dompdf\Dompdf;
use Dompdf\Options;
// Reference the Font Metrics namespace 
use Dompdf\FontMetrics;

class OrdersController extends BaseController
{
    protected $model;
    protected $productsmodel;
    protected $orderproductsmodel;
    protected $customersmodel;
    protected $addressmodel;

    function __construct()
    {
        $this->model = new ordersModel();
        $this->productsmodel = new ProductsModel();
        $this->customersmodel = new CustomersModel();
        $this->addressmodel = new AddressModel();
        $this->orderproductsmodel = new OrderProductsModel();
    }

    public function index()
    {
        defender('api')->canDo('modules.orders.index');

        return render('modules.orders.index');
    }

    public function create($id = null)
    {
        defender('api')->canDo('modules.orders.create');
        $data['customers'] = $this->customersmodel->all()->pluck('firstname', 'id');
        $data['products'] = $this->productsmodel->all($this->productsmodel->getColumns());
        $data['url'] = $id ? route_to('orders.update', $id) : route_to('orders.create');
        $data['method'] = $id ? 'PUT' : 'POST';
        $data['order'] = $id ? $this->model->find($id) : null;
        $data['customerAddress'] = $id ? $this->addressmodel->getAddress(['belongsto_id' => $data['order']->customer_id, 'type' => 1]) : null;
        $data['orderProducts'] = $id ? $this->orderproductsmodel->getOrderedProductsByOrderId($id) : null;
        return render('modules.orders.create', $data);
    }


    public function getData()
    {
        defender('api')->canDo('modules.orders.index');

        return DataTables::use('orders')
            ->join('customers', 'customers.id = orders.customer_id', 'left')
            ->join('address', 'address.id = orders.billing_address_id', 'left')
            // ->where(['orders.deleted_at' => null])
            ->addIndexColumn()
            ->addColumn('button', function ($data) {
                return render('modules.orders.partials._table_button', compact('data'));
            })
            ->editColumn('status', function ($item) {
                return ($item == 1) ? 'Active' : 'Inactive';
            })
            // ->editColumn('customer_id', function ($item) {
            //     return ($item == 1) ? 'Active' : 'Inactive';
            // })
            ->editColumn('notes', function ($item) {
                return mb_strimwidth($item, 0, 25, '...');;
            })

            // ->editColumn('status', function ($item) {
            //     return render('partials.statusButton', compact('item'));
            // })
            ->filter(function ($query) {
                return $query->select('orders.*,concat(customers.firstname," ",customers.lastname) as customer_name,concat(SUBSTR(address.address1,1,10),",", SUBSTR(address.address2,1,10),"," , SUBSTR(address.locality,1,10),"...") as order_address')
                    ->orderBy('orders.updated_at', 'ASC');
            })
            ->rawColumns(['button'])
            ->make();
    }

    public function store($id = null)
    {
        if ($this->request->getMethod() === 'post')
            defender('api')->canDo('modules.orders.create');
        if (
            !$this->validate(
                $this->model->getValidationRules(),
                $this->model->getValidationMessages()
            )
        ) {
            return $this->fail($this->validator->getErrors());
        }
        $input =  $this->request->getRawInput();
        $addressArrayData = [];
        $inputOrderData = [];
        $orderProductsInputData = [];

        if ($this->request->getMethod() === 'put')
            defender('api')->canDo('modules.orders.update');

        // if we found new address, we validate the address fields    
        if ($input['address'] == "new") {
            // validating the address fields
            if (!$this->validate(
                $this->addressmodel->getValidationRules(),
                $this->addressmodel->getValidationMessages()
            )) {
                return $this->fail($this->validator->getErrors());
            }
            // creating the address data and saving it
            $addressArrayData = $this->createAddressDataInput($input);
        }

        $inputOrderData = $this->createOrderDataInput($input);

        if ($this->request->getMethod() === 'put') {
            $inputOrderData['id']  = $id;
            $message = 'order data was updated';
        }

        DB::beginTransaction();
        try {
            if (count($addressArrayData) > 0) {
                $response = $this->addressmodel->save($addressArrayData);
                if (!$response)
                    return $this->fail("Address not added", 400);
            }
            $neworder = $this->model->save($inputOrderData);
            if (!$neworder)
                return $this->fail("order insert error", 400);
            /**
             *  validating the order products and saving them
             */
            if (isset($input['product']) && count($input['product']) > 0) {
                $orderProductsInputData = $this->createOrderProducts($input['product']);

                $response = $this->orderproductsmodel->insertBatch($orderProductsInputData);
                if (!$response)
                    return $this->fail("order product insert error", 400);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->fail(['error' => $e->getMessage()]);
        }

        return $this->respondCreated([
            'status'  => $this->codes['created'],
            'message' => $message ?? 'order data was created'
        ]);
    }

    private function createAddressDataInput($inputArrayData)
    {
        $arrayData['belongsto_id'] =   $inputArrayData['customer_id'];
        $arrayData['type']         =   1;
        $arrayData['address1']    =   $inputArrayData['address1'];
        $arrayData['address2']    =   $inputArrayData['address2'] ?? "";
        $arrayData['delivery_date'] =   $arrayData['delivery_date'] ?? $arrayData['invoice_date'];
        $arrayData['locality']    =   $inputArrayData['locality'];
        $arrayData['city']        =   $inputArrayData['city'];
        $arrayData['pincode']     =   $inputArrayData['pincode'];
        $arrayData['state']       =   $inputArrayData['state'];
        $arrayData['country']     =   INDIA;
        // $arrayData['created_at']  =   date('Y-m-d H:i:s');
        // $arrayData['updated_at']  =   date('Y-m-d H:i:s');

        return $arrayData;
    }

    private function createOrderDataInput($arrayData)
    {
        $orderedProductDiscount = 0;
        if (is_array($arrayData['product']) && count($arrayData['product'])) {
            $orderedProductDiscount = array_sum(array_column($arrayData['product'], 'discount'));
        }
        $objOrderData['invoice_no']          =   $arrayData['invoice_number'] ?? rand(rand(1000, 10000), rand(10000, 99999));
        $objOrderData['invoice_date']        =   date('Y-m-d', strtotime($arrayData['invoice_date']));
        $objOrderData['delivery_date']       =   $arrayData['delivery_date'] ? date('Y-m-d', strtotime($arrayData['delivery_date'])) : date('Y-m-d', strtotime($arrayData['invoice_date']));
        $objOrderData['customer_id']         =   $arrayData['customer_id'];
        $objOrderData['shipping_address_id'] =   $objOrderData['billing_address_id'] = $arrayData['order_addres'] ?? $this->addressmodel->getInsertID();
        $objOrderData['gst_number']          =   $arrayData['gst_number'] ?? '';
        $objOrderData['currently_paid']      =   $arrayData['currently_paid'];
        $objOrderData['current_balance']     =   $arrayData['current_balance'];
        $objOrderData['product_total']       =   $arrayData['order_total'];
        $objOrderData['gst_total']           =   $arrayData['order_gst'];
        $objOrderData['discount_amount']     =   ($arrayData['order_discount'] >= $orderedProductDiscount) ? $arrayData['order_discount'] : $orderedProductDiscount;
        $objOrderData['grand_total']         =   $arrayData['grand_total'];
        $objOrderData['notes']               =   $arrayData['notes'] ?? "";
        $objOrderData['status']              =   $arrayData['status'] ?? 0;
        return $objOrderData;;
    }

    private function createOrderProducts($arrayData)
    {
        $objOrderData = [];
        if (count($arrayData) > 0) {
            foreach ($arrayData as $key => $orderProduct) {
                $objOrderData[$key]['order_id']            =   $this->model->getInsertID();
                $objOrderData[$key]['product_id']          =   $orderProduct['product'];
                $objOrderData[$key]['quantity']            =   $orderProduct['qnty'];
                $objOrderData[$key]['price']               =   $orderProduct['productamount'];
                $objOrderData[$key]['discount_price']      =   $orderProduct['discount'];
                $objOrderData[$key]['gst_price']           =   $orderProduct['gstamount'];
                $objOrderData[$key]['unitprice']           =   $orderProduct['unitprice'];
            }
        }

        return $objOrderData;;
    }

    public function destroy($id)
    {
        defender('api')->canDo('modules.orders.delete');

        $order = $this->model->find($id);

        $order->delete();

        return $this->respondDeleted([
            'status'  => $this->codes['deleted'],
            'message' => 'order data was deleted',
        ]);
    }

    public function orderPDF($id)
    {
        defender('api')->canDo('modules.orders.create');
        if ($id > 0) {
            $orderDetail     = $this->model->find($id);
            $customerDetail  = $orderDetail ? $this->customersmodel->find($orderDetail->customer_id) : null;
            $shippingAddress = $this->addressmodel->find($orderDetail->shipping_address_id);
            $billingAddress  = $this->addressmodel->find($orderDetail->billing_address_id);
            $orderedProducts = $orderDetail ? $this->orderproductsmodel->getOrderedProductsByOrderId($id) : null;
            $invoiceData     = [
                'orderDetail' => $orderDetail,
                'customerDetail' => $customerDetail,
                'shippingAddress' => $shippingAddress,
                'billingAddress' => $billingAddress,
                'orderedProducts' => $orderedProducts,
                'companyDetail' => [],
            ];
            
            $options = new Options();
            $options->setIsRemoteEnabled(true);
           // $options->setIsPhpEnabled(true);
           // $options->setIsJavascriptEnabled(true);
            $dompdf = new Dompdf($options);
            $html = render('modules.orders.invoice', $invoiceData);
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            // $dompdf->setPaper($customPaper, 'portrait');
            // Render the HTML as PDF
            $dompdf->render();

            // Instantiate canvas instance 
            // $canvas = $dompdf->getCanvas();
            // Instantiate font metrics class 
            // $fontMetrics = new FontMetrics($canvas, $options);

            // // Get height and width of page 
            // $w = $canvas->get_width();
            // $h = $canvas->get_height();

            // // Get font family file 
            // $font = $fontMetrics->getFont('times');
            // // Specify watermark text 
            // $text = "Ziya Trading Company";
            // // Set text opacity 
            // $canvas->set_opacity(.2);

            // // Writes text at the specified x and y coordinates 
            // $canvas->text($tx, $ty, $text, $font, 40, $color = array(255, 0, 0), $word_space = 0.0, $char_space = 0.0, $angle = 35.0);

            // // Instantiate canvas instance 
            // // Specify watermark image 
            // $imageURL = image_url('logo.png');
            // $imgWidth = 200;
            // $imgHeight = 200;

            // // Set image opacity 
            // $canvas->set_opacity(.15);

            // // Add an image to the pdf 
            // $canvas->image($imageURL, $ix, $iy, $imgWidth, $imgHeight, $resolution = "normal");
            $dompdf->stream('OrderNumber-' . $id . '.pdf', array("Attachment" => 0));
            //return true;
            // return render('modules.orders.invoice');
        }
    }
}
