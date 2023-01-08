<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CustomersModel extends Eloquent
{
    protected $DBGroup          = 'default';
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'firstname',
        'lastname',
        'email',
        'telephone',
        'default_address',
        'status',
    ];
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'telephone',
        'default_address',
        'status',
    ];

    // Validation
    protected $validationRules      = [
        'name' => 'required|is_unique[customers.email,id,{id}]',
        'telephone' => 'required',
        'default_address' => 'required',
    ];

    protected $validationMessages   = [
        'email' => [
            'is_unique' => 'This Email is already taken.',
            'required' => 'Email is required',
        ],
        'telephone' => [
            'required' => 'Phone NUmber is required',
        ],
        'default_address' => [
            'required' => 'Address is required',
        ],
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
}
