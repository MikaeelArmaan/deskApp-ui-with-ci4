<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CompanyModel extends Eloquent
{
    protected $DBGroup          = 'default';
    protected $table            = 'companies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'gst',
        'email',
        'telephone',
        'image',
        'default_address',
        'status',
    ];
    protected $fillable = [
        'name',
        'gst',
        'email',
        'telephone',
        'image',
        'default_address',
        'status',
    ];

    // Validation
    protected $validationRules      = [
        'name' => 'required|is_unique[company.name,id,{id}]',
    ];

    protected $validationMessages   = [
        'name' => [
            'is_unique' => 'This Company name is already taken.',
            'required' => 'Company Name is required',
        ],
    ];

    protected $validationRulesForImage      = [
        'image' => [
            'uploaded[image]',
            'mime_in[image,image/jpg,image/jpeg,image/png]'
        ]
    ];

    protected $validationMessageForImage  = [
        'image' => [
            'uploaded' => 'Already Uploaded.',
            'mime_in' => 'Company Logo should be of Type jpg,jpeg,png',
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function getValidationRules()
    {
        return $this->validationRules;
    }

    function getValidationMessages()
    {
        return $this->validationMessages;
    }

    function getValidationRulesForImage()
    {
        return $this->validationRulesForImage;
    }

    function getValidationMessageForImage()
    {
        return $this->validationMessageForImage;
    }
}
