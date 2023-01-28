<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AddressModel;
use Irsyadulibad\DataTables\DataTables;
use Illuminate\Database\Capsule\Manager as DB;

class AddressController extends BaseController
{
    protected $model;

    function __construct()
    {
        $this->model = new AddressModel();
    }

    public function index()
    {
        defender('api')->canDo('modules.address.index');

        return render('modules.address.index');
    }

    public function getData()
    {
        defender('api')->canDo('modules.address.index');
        return DataTables::use('address')
            ->select('concat(customers.firstname," ", customers.lastname) customer_name,concat(address.address1,", ", address.address2) address,address.id,address.city,address.state,address.status,address.pincode,address.locality')
            ->join('customers', 'customers.id = address.belongsto_id')
            ->where(['address.status' => 1, 'customers.status' => 1, 'customers.type' => 1])
            ->addIndexColumn()
            ->addColumn('button', function ($data) {
                return render('modules.address.partials._table_button', compact('data'));
            })
            ->editColumn('status', function ($item) {
                return ($item == 1) ? 'Active' : 'Inactive';
            })
            ->rawColumns(['button'])
            ->make();
    }

    public function store($id = null)
    {
        if ($this->request->getMethod() === 'post')
            defender('api')->canDo('modules.address.create');
        if (
            !$this->validate(
                $this->model->getValidationRules(),
                $this->model->getValidationMessages()
            )
        ) {
            return $this->fail($this->validator->getErrors());
        }
        if ($this->request->getMethod() === 'put')
            defender('api')->canDo('modules.address.update');


        // If address logo uploaded validation check
        $data = (array) $this->request->getPost();

        if ($this->request->getMethod() === 'put') {
            $data = (array) $this->request->getRawInput();
            $message = 'address data was updated';
        }
        $data['status'] = (array_key_exists('status', $data)) ? 1 : 0;

        DB::beginTransaction();
        try {
            $newaddress = $this->model->updateOrCreate(['id' => $id], $data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->fail(['error' => $e->getMessage()]);
        }

        return $this->respondCreated([
            'status'  => $this->codes['created'],
            'message' => $message ?? 'address data was created',
            'data'    => $newaddress
        ]);
    }

    public function destroy($id)
    {
        defender('api')->canDo('modules.address.delete');

        $address = $this->model->find($id);

        $address->delete();

        return $this->respondDeleted([
            'status'  => $this->codes['deleted'],
            'message' => 'Address data was deleted',
        ]);
    }

    public function getAddress()
    {
        defender('api')->canDo('modules.address.index');
        //dd($this->model->getAddress(['id' => 3]));
        $requestVar = $this->request->getRawInput();
        if (isset($requestVar['id']) && $requestVar['id'] !== "") {
            $where = ['id' => $requestVar['id']];
            $address = $this->model->find($where);
        } elseif (isset($requestVar['belongsto']) && $requestVar['belongsto'] !== "" && $requestVar['type']) {
            $where = ['belongsto_id' => $requestVar['belongsto'], 'type' => $requestVar['type']];
            $address = $this->model->getAddress($where);
        } else
            return $this->respondDeleted([
                'status'  => 404,
                'message' => 'Address not found',
            ]);

        return $this->respond([
            'status'  => $this->codes['updated'],
            'data'  => $address,
            'message' => 'Address data',
        ]);
    }
}
