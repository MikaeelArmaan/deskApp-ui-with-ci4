<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model as Eloquent;
use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'address';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'belongsto_id',
        'type',
        'address1',
        'address2',
        'locality',
        'city',
        'pincode',
        'state',
        'country',
        'status',
        // 'created_at',
        // 'updated_at',
        // 'deleted_at',
    ];
    protected $fillable = [
        'id',
        'belongsto_id',
        'type',
        'address1',
        'address2',
        'locality',
        'city',
        'pincode',
        'state',
        'country',
        'status',
    ];
    protected $datamap = [
        // property_name => db_column_name
        'customer_ids' => 'belongsto_id',
    ];

    // Dates
    protected $useTimestamps = TRUE;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'customer_id' => 'required',
        'address1' => 'required',
        'locality' => 'required',
        'city' => 'required',
        'pincode' => 'required',
    ];

    protected $validationMessages   = [
        'customer_id' => [
            'required' => 'Customer is not selected',
        ],
        'address1' => [
            'required' => 'Address1 is required',
        ],
        'locality' => [
            'required' => 'Locality is required',
        ],
        'city' => [
            'required' => 'City is required',
        ],
        'pincode' => [
            'required' => 'Pincode is required',
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


    public function getAddress($where = "", $columns = "")
    {
        $columns = $columns != "" ? $columns : "id,concat(SUBSTR(address1,1,10),',',SUBSTR(address2,1,10),',',SUBSTR(locality,1,10),'...') as address, pincode,locality";
        $query = $this->select($columns);

        if ($where !== "")
            $query->where($where);
        return $query->findAll();
    }
}
