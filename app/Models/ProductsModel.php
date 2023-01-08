<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ProductsModel extends Eloquent
{
    protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'name',
        'category_id',
        'brand_id',
        'image',
        'quantity',
        'retailer_price',
        'distributor_price',
        'purchase_price',
        'sale_price',
        'short_description',
        'description',
        'hsn',
        'gst',
        'sequence',
        'status',
    ];
    protected $fillable = [
        'name',
        'category_id',
        'brand_id',
        'image',
        'quantity',
        'retailer_price',
        'distributor_price',
        'purchase_price',
        'sale_price',
        'short_description',
        'description',
        'hsn',
        'gst',
        'sequence',
        'status',
    ];

    public function getColumns()
    {
        return $this->allowedFields;
    }
    // Validation
    protected $validationRules      = [
        'name' => 'required|is_unique[products.name,id,{id}]',
    ];

    protected $validationMessages   = [
        'name' => [
            'is_unique' => 'This Product name is already taken.',
            'required' => 'Product Name is required',
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
            'mime_in' => 'Product Logo should be of Type jpg,jpeg,png',
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
    //protected $appends = array('brand_name');

    // public function getBrandNameAttribute()
    // {
    //     return $this->brand->pluck('id', 'name as brand_name');
    // }
    public function brand()
    {
        return $this->hasOne(BrandsModel::class, 'id', 'brand_id');
    }

}
