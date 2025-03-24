<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSangre extends Model
{
    use HasFactory;

    protected $table = 'tblTipoSangre';
    protected $primaryKey = 'TipoSangreId';
    public $timestamps = true;

    protected $fillable = ['descripcion'];

    public function pY1s()
    {
        return $this->hasMany(PY1::class, 'TipoSangreId', 'TipoSangreId');
    }
}
