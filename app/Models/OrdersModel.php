<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'invoice_no',
        'invoice_date',
        'delivery_date',
        'customer_id',
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
        'delivery_date',
        'customer_id',
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
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'customer_id' => 'required',
        'address' => 'required',
        'invoice_date' => 'required',
        'delivery_date' => 'required',
    ];

    protected $validationMessages   = [
        'customer_id' => [
            'required' => 'Customer is required',
        ],
        'invoice_date' => [
            'required' => 'Invoice Date is required',
        ],
        'delivery_date' => [
            'required' => 'Delivery Date is required',
        ],
        'address' => [
            'required' => 'Address is required',
        ],
    ];

    protected $skipValidation       = true;
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

}
