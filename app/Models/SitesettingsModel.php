<?php

namespace App\Models;

use CodeIgniter\Model;

class SitesettingsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sitesettings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'site_name', 'site_admin', 'headercolor', 'sidebarcolor',
        'menu_icon', 'menu_icon_list', 'gst_number', 'pan_number',
        'tan_number', 'email', 'mobiles', 'address', 'bank_name', 'bank_account',
        'ifsc', 'branch', 'logo', 'bill_watermark'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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

    public function getSiteSettingByUserId($adminId)
    {
        return $this->select($this->allowedFields)
            ->where('site_admin', $adminId)
            ->get();
    }
}
