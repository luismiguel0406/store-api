<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'tblArticulo';
    protected $primaryKey = 'ArticuloId';
    public $timestamps = true;

    protected $fillable = ['codigoBarras', 'descripcion', 'nombreFabricante'];

    public function articuloColocaciones()
    {
        return $this->hasMany(ArticuloColocacion::class, 'ArticuloId', 'ArticuloId');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'nombreArticulo', 'nombreArticulo');
    }
}
