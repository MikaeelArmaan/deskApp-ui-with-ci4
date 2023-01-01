<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CategoriesModel extends Eloquent
{
    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'short_description',
        'description',
        'status',
    ];
    protected $fillable = [
        'name',
        'short_description',
        'description',
        'status',
    ];

    // Validation
    protected $validationRules      = [
        'name' => 'required|is_unique[categories.name,id,{id}]',
        'short_description' => 'required',
        'description' => 'required',
    ];

    protected $validationMessages   = [
        'name' => [
            'is_unique' => 'This Category name is already taken.',
            'required' => 'Category Name is required',
        ],
        'description' => [
            'required' => 'Category Description is required',
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
            'mime_in' => 'Brand Logo should be of Type jpg,jpeg,png',
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
