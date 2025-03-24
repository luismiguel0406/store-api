<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colocacion extends Model
{
    use HasFactory;

    protected $table = 'tblColocacion';
    protected $primaryKey = 'ColocacionId';
    public $timestamps = true;

    protected $fillable = ['descripcion'];

    public function articuloColocaciones()
    {
        return $this->hasMany(ArticuloColocacion::class, 'ColocacionId', 'ColocacionId');
    }
}
