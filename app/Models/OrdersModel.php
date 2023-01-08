<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class OrdersModel extends Eloquent
{
    protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'invoice_no',
        'invoice_date',
        'customer_id ',
        'shipping_address_id',
        'billing_address_id',
        'billing_address_id',
        'gst_number',
        'currently_paid',
        'current_balance',
        'product_total',
        'gst_total',
        'discount_amount',
        'grand_total',
        'notes',
        'status',
        'created_by',
        'updated_by',
    ];
    protected $fillable = [
        'id',
        'invoice_no',
        'invoice_date',
        'customer_id ',
        'shipping_address_id',
        'billing_address_id',
        'billing_address_id',
        'gst_number',
        'currently_paid',
        'current_balance',
        'current_balance',
        'product_total',
        'gst_total',
        'discount_amount',
        'grand_total',
        'notes',
        'status',
        'created_by',
        'updated_by',
    ];

    // Validation
    protected $validationRules      = [
        'customer_id' => 'required',
        'billing_address_id' => 'required',
    ];

    protected $validationMessages   = [
        'customer_id' => [
            'required' => 'Customer is required',
        ],
        'billing_address_id' => [
            'required' => 'Billing address is required',
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

    public function customer()
    {
        return $this->hasOne(CustomersModel::class, 'id', 'customer_id');
    }

    public function billingAddress()
    {
        return $this->hasOne(AddressModel::class, 'id', 'billing_address_id');
    }
}
