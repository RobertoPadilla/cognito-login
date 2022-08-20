<?php

namespace App\Models;

use CodeIgniter\Model;

class Image extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'images';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'object_key'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getByUser($userId)
    {
        $builder = $this->db->table($this->table)
            ->where('user_id', $userId)
            ->get()->getResultObject();
        
        return $builder;
    }
}
