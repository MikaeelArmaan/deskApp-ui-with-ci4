<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BrandsModel;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Capsule\Manager as DB;
use Irsyadulibad\DataTables\DataTables;

class BrandsController extends BaseController
{
    protected $brandsmodel;
    use FileUploadTrait;

    function __construct()
    {
        $this->brandsmodel = new BrandsModel();
    }

    public function index()
    {
        defender('api')->canDo('modules.brands.index');

        return render('modules.brands.index');
    }

    public function getData()
    {
        defender('api')->canDo('modules.brands.index');

        return DataTables::use('brands')
            ->addIndexColumn()
            ->addColumn('button', function ($data) {
                return render('modules.brands.partials._table_button', compact('data'));
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
            defender('api')->canDo('modules.brands.create');
        if (
            !$this->validate(
                $this->brandsmodel->getValidationRules(),
                $this->brandsmodel->getValidationMessages()
            )
        ) {
            return $this->fail($this->validator->getErrors());
        }
        if ($this->request->getMethod() === 'put')
            defender('api')->canDo('modules.brands.update');


        // If brand logo uploaded validation check
        $data = (array) $this->request->getPost();


        // if (
        //     !$this->validate(
        //         $this->brandsmodel->getValidationRulesForImage(),
        //         $this->brandsmodel->getValidationMessageForImage()
        //     )
        // ) {
        //     return $this->fail($this->validator->getErrors());
        // } else {
        //     $image = $this->request->getFile('image');

        //     if ($uploadedFileData = $this->doFileUpload(
        //         $image,
        //         WRITEPATH . '/uploads/brands/' . strtolower($data['name']),
        //         $this->brandsmodel->getValidationRulesForImage(),
        //         $this->brandsmodel->getValidationMessageForImage()
        //     )) {

        //     };   
        //  }
        if ($this->request->getMethod() === 'put') {
            $data = (array) $this->request->getRawInput();
            $message = 'Brand data was updated';
        }
        $data['status'] = (array_key_exists('status', $data)) ? 1 : 0;

        DB::beginTransaction();
        try {
            $newBrand = $this->brandsmodel->updateOrCreate(['id' => $id], $data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->fail(['error' => $e->getMessage()]);
        }

        return $this->respondCreated([
            'status'  => $this->codes['created'],
            'message' => $message ?? 'Brand data was created',
            'data'    => $newBrand
        ]);
    }

    public function destroy($id)
    {
        defender('api')->canDo('modules.brands.delete');

        $brand = $this->brandsmodel->find($id);

        $brand->delete();

        return $this->respondDeleted([
            'status'  => $this->codes['deleted'],
            'message' => 'Brand data was deleted',
        ]);
    }
}
