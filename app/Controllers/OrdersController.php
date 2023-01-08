<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomersModel;
use App\Models\OrdersModel;
use App\Models\ProductsModel;
use Irsyadulibad\DataTables\DataTables;
use Illuminate\Database\Capsule\Manager as DB;

class OrdersController extends BaseController
{
    protected $model;
    protected $productsmodel;
    protected $customersmodel;

    function __construct()
    {
        $this->model = new ordersModel();
        $this->productsmodel = new ProductsModel();
        $this->customersmodel = new CustomersModel();
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
        return render('modules.orders.create', $data);
    }


    public function getData()
    {
        defender('api')->canDo('modules.orders.index');

        return DataTables::use('orders')
            // ->select('orders.*,brands.name as brand_name, categories.name as category_name')
            // ->join('brands', 'orders.brand_id = brands.id', 'left')
            // ->join('categories', 'orders.category_id = categories.id', 'left')
            // ->where(['orders.deleted_at' => null])
            ->addIndexColumn()
            ->addColumn('button', function ($data) {
                return render('modules.orders.partials._table_button', compact('data'));
            })
            ->editColumn('status', function ($item) {
                return ($item == 1) ? 'Active' : 'Inactive';
            })
            ->editColumn('notes', function ($item) {
                return mb_strimwidth($item, 0, 25, '...');;
            })

            // ->editColumn('status', function ($item) {
            //     return render('partials.statusButton', compact('item'));
            // })
            ->filter(function ($query) {
                return $query->orderBy('orders.updated_at', 'ASC');
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
        if ($this->request->getMethod() === 'put')
            defender('api')->canDo('modules.orders.update');


        // If order logo uploaded validation check
        $data = (array) $this->request->getPost();


        // if (
        //     !$this->validate(
        //         $this->model->getValidationRulesForImage(),
        //         $this->model->getValidationMessageForImage()
        //     )
        // ) {
        //     return $this->fail($this->validator->getErrors());
        // } else {
        //     $image = $this->request->getFile('image');

        //     if ($uploadedFileData = $this->doFileUpload(
        //         $image,
        //         WRITEPATH . '/uploads/orders/' . strtolower($data['name']),
        //         $this->model->getValidationRulesForImage(),
        //         $this->model->getValidationMessageForImage()
        //     )) {

        //     };   
        //  }
        if ($this->request->getMethod() === 'put') {
            $data = (array) $this->request->getRawInput();
            $message = 'order data was updated';
        }
        $data['status'] = (array_key_exists('status', $data)) ? 1 : 0;

        DB::beginTransaction();
        try {
            $neworder = $this->model->updateOrCreate(['id' => $id], $data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->fail(['error' => $e->getMessage()]);
        }

        return $this->respondCreated([
            'status'  => $this->codes['created'],
            'message' => $message ?? 'order data was created',
            'data'    => $neworder
        ]);
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
}
