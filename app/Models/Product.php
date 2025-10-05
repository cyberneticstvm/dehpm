<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function hsn()
    {
        return $this->belongsTo(Hsn::class, 'hsn_id', 'id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(ManufactureSupplier::class, 'manufacturer_id', 'id');
    }

    public function deleteStatus()
    {
        return ($this->deleted_at) ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
    }
}
