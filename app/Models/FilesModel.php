<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilesModel extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $primaryKey = 'id_file';
    protected $fillable = ['nombre', 'fecha_subida', 'archivo'];
    public $timestamps = false;

    public function setUpdatedAtAttribute($value)
    {
        // to Disable updated_at
    }
    public function setCreatedAtAttribute($value)
    {
        // to Disable updated_at
    }
}
