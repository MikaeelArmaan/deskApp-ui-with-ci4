<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SitesettingsModel;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Capsule\Manager as DB;

class SitesettingsController extends BaseController
{
    protected $model;
    protected $usermodel;

    use FileUploadTrait;

    function __construct()
    {
        $this->model = new SitesettingsModel();
        $this->usermodel = new User();
    }

    public function index()
    {
        defender('api')->canDo('modules.sitesettings.index');
        $sitesetting = $this->model->find(1);
        $data = [
            'sitesetting' => $sitesetting,
            'form' => (object)['method' => "POST", "action" => route_to('sitesettings.create')],
        ];
        return render('modules.sitesettings.setting', $data);
    }

    public function create($id = null)
    {
        defender('api')->canDo('modules.sitesettings.index');
        $data['url'] = $id ? route_to('sitesettings.update', $id) : route_to('sitesettings.create');
        $data['method'] = $id ? 'PUT' : 'POST';
        $data['admins'] = $this->usermodel->get();
        $data['sitesetting'] =  $id ? $this->model->find($id) : null;
        return render('modules.sitesettings.setting', $data);
    }


    public function store($id = null)
    {
        if ($this->request->getMethod() === 'post')
            defender('api')->canDo('modules.sitesettings.create');
        // if (
        //     !$this->validate(
        //         $this->model->getValidationRules(),
        //         $this->model->getValidationMessages()
        //     )
        // ) {
        //     return $this->fail($this->validator->getErrors());
        // }
        if ($this->request->getMethod() === 'put')
            defender('api')->canDo('modules.sitesettings.update');


        // If Site Setting logo uploaded validation check
        $data = (array) $this->request->getRawInput();

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
        //         WRITEPATH . '/uploads/sitesettings/' . strtolower($data['name']),
        //         $this->model->getValidationRulesForImage(),
        //         $this->model->getValidationMessageForImage()
        //     )) {

        //     };   
        //  }

        if ($this->request->getMethod() === 'put') {
            $data['id']  = $id;
            $message = 'Site Setting data was updated';
        }

        DB::beginTransaction();
        try {
            $siteSetting = $this->model->save($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->fail(['error' => $e->getMessage()]);
        }

        return $this->respondCreated([
            'status'  => $this->codes['created'],
            'message' => $message ?? 'Site Setting data was created',
            'data'    => $siteSetting
        ]);
    }

    public function destroy($id)
    {
        defender('api')->canDo('modules.sitesettings.delete');

        $siteSetting = $this->model->find($id);

        $siteSetting->delete();

        return $this->respondDeleted([
            'status'  => $this->codes['deleted'],
            'message' => 'Site Setting data was deleted',
        ]);
    }
}
