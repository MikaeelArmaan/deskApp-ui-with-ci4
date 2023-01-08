<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrdersModel;
use Irsyadulibad\DataTables\DataTables;
use Illuminate\Database\Capsule\Manager as DB;

class OrderProductsController extends BaseController
{
    protected $model;

    function __construct()
    {
        $this->model = new OrdersModel();
    }

    public function index()
    {
        defender('api')->canDo('modules.orders.index');

        return render('modules.orders.index');
    }

    public function getData()
    {
        defender('api')->canDo('modules.orders.index');

        return DataTables::use('orders')
            ->addIndexColumn()
            ->addColumn('button', function ($data) {
                return render('modules.orders.partials._table_button', compact('data'));
            })
            ->editColumn('status', function ($item) {
                return ($item == 1) ? 'Active' : 'Inactive';
            })
            // ->editColumn('status', function ($item) {
            //     return render('partials.statusButton', compact('item'));
            // })
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
