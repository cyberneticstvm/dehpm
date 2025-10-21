<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = ['pdate' => 'datetime'];

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class, 'purchase_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(ManufactureSupplier::class, 'supplier_id', 'id');
    }

    public function deleteStatus()
    {
        return ($this->deleted_at) ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
    }
}
