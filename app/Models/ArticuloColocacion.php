<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloColocacion extends Model
{
    use HasFactory;

    protected $table = 'tblArticuloColocacion';
    protected $primaryKey = 'ArticuloColocacionId';
    public $timestamps = true;

    protected $fillable = ['ArticuloId', 'ColocacionId', 'nombreArticulo', 'precioArticulo'];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'ArticuloId', 'ArticuloId');
    }

    public function colocacion()
    {
        return $this->belongsTo(Colocacion::class, 'ColocacionId', 'ColocacionId');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'ArticuloColocacionId', 'ArticuloColocacionId');
    }
}
