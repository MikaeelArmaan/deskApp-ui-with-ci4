<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BrandsModel;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use Irsyadulibad\DataTables\DataTables;
use Illuminate\Database\Capsule\Manager as DB;

class ProductsController extends BaseController
{
    protected $model;

    function __construct()
    {
        $this->model = new ProductsModel();
        $this->categorymodel = new CategoriesModel();
        $this->brandsmodel = new BrandsModel();
    }

    public function index()
    {
        defender('api')->canDo('modules.products.index');

        return render('modules.products.index');
    }

    public function create($id = null)
    {
        defender('api')->canDo('modules.products.create');
        $data['category'] = $this->categorymodel->all()->pluck('name', 'id');
        $data['brand'] = $this->brandsmodel->all()->pluck('name', 'id');
        $data['url'] = $id ? route_to('products.update', $id) : route_to('products.create');
        $data['method'] = $id ? 'PUT' : 'POST';
        $data['product'] = $id ? $this->model->find($id) : null;
        return render('modules.products.detail', $data);
    }


    public function getData()
    {
        defender('api')->canDo('modules.products.index');

        return DataTables::use('products')
            ->select('products.*,brands.name as brand_name, categories.name as category_name')
            ->join('brands', 'products.brand_id = brands.id', 'left')
            ->join('categories', 'products.category_id = categories.id', 'left')
            ->where(['products.deleted_at' => null])
            ->addIndexColumn()
            ->addColumn('button', function ($data) {
                return render('modules.products.partials._table_button', compact('data'));
            })
            ->editColumn('status', function ($item) {
                return ($item == 1) ? 'Active' : 'Inactive';
            })
            ->editColumn('short_description', function ($item) {
                return mb_strimwidth($item, 0, 25, '...');;
            })
            ->editColumn('description', function ($item) {
                return mb_strimwidth($item, 0, 50, '...');;
            })
            // ->editColumn('status', function ($item) {
            //     return render('partials.statusButton', compact('item'));
            // })
            ->filter(function ($query) {
                return $query->orderBy('products.sequence','ASC');
            })
            ->rawColumns(['button'])
            ->make();
    }

    public function store($id = null)
    {

        if ($this->request->getMethod() === 'post')
            defender('api')->canDo('modules.products.create');
        if (
            !$this->validate(
                $this->model->getValidationRules(),
                $this->model->getValidationMessages()
            )
        ) {
            return $this->fail($this->validator->getErrors());
        }
        if ($this->request->getMethod() === 'put')
            defender('api')->canDo('modules.products.update');


        // If Product logo uploaded validation check
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
        //         WRITEPATH . '/uploads/Products/' . strtolower($data['name']),
        //         $this->model->getValidationRulesForImage(),
        //         $this->model->getValidationMessageForImage()
        //     )) {

        //     };   
        //  }
        if ($this->request->getMethod() === 'put') {
            $data = (array) $this->request->getRawInput();
            $message = 'Product data was updated';
        }
        $data['status'] = (array_key_exists('status', $data)) ? 1 : 0;

        DB::beginTransaction();
        try {
            $newProduct = $this->model->updateOrCreate(['id' => $id], $data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->fail(['error' => $e->getMessage()]);
        }

        return $this->respondCreated([
            'status'  => $this->codes['created'],
            'message' => $message ?? 'Product data was created',
            'data'    => $newProduct
        ]);
    }

    public function destroy($id)
    {
        defender('api')->canDo('modules.products.delete');

        $product = $this->model->find($id);

        $product->delete();

        return $this->respondDeleted([
            'status'  => $this->codes['deleted'],
            'message' => 'Product data was deleted',
        ]);
    }
}
