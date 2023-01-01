<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use Illuminate\Database\Capsule\Manager as DB;
use Irsyadulibad\DataTables\DataTables;

class CompanyController extends BaseController
{
    protected $model;

    function __construct()
    {
        $this->model = new CompanyModel();
    }

    public function index()
    {
        defender('api')->canDo('modules.company.index');

        return render('modules.company.index');
    }

    public function getData()
    {
        defender('api')->canDo('modules.company.index');

        return DataTables::use('company')
            ->addIndexColumn()
            ->addColumn('button', function ($data) {
                return render('modules.company.partials._table_button', compact('data'));
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
            defender('api')->canDo('modules.company.create');
        if (
            !$this->validate(
                $this->model->getValidationRules(),
                $this->model->getValidationMessages()
            )
        ) {
            return $this->fail($this->validator->getErrors());
        }
        if ($this->request->getMethod() === 'put')
            defender('api')->canDo('modules.company.update');


        // If Company logo uploaded validation check
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
        //         WRITEPATH . '/uploads/Company/' . strtolower($data['name']),
        //         $this->model->getValidationRulesForImage(),
        //         $this->model->getValidationMessageForImage()
        //     )) {

        //     };   
        //  }
        if ($this->request->getMethod() === 'put') {
            $data = (array) $this->request->getRawInput();
            $message = 'Company data was updated';
        }
        $data['status'] = (array_key_exists('status', $data)) ? 1 : 0;

        DB::beginTransaction();
        try {
            $newCompany = $this->model->updateOrCreate(['id' => $id], $data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->fail(['error' => $e->getMessage()]);
        }

        return $this->respondCreated([
            'status'  => $this->codes['created'],
            'message' => $message ?? 'Company data was created',
            'data'    => $newCompany
        ]);
    }

    public function destroy($id)
    {
        defender('api')->canDo('modules.companies.delete');

        $category = $this->model->find($id);

        $category->delete();

        return $this->respondDeleted([
            'status'  => $this->codes['deleted'],
            'message' => 'Company data was deleted',
        ]);
    }
}
