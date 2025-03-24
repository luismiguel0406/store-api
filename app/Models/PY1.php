<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PY1 extends Model
{
    use HasFactory;

    protected $table = 'tblPY1';
    protected $primaryKey = 'UserId';
    public $timestamps = true;

    protected $fillable = ['contrasena', 'cedula', 'telefono', 'TipoSangreId'];

    public function tipoSangre()
    {
        return $this->belongsTo(TipoSangre::class, 'TipoSangreId', 'TipoSangreId');
    }
}
