<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'tblPedido';
    protected $primaryKey = 'PedidoId';
    public $timestamps = true;

    protected $fillable = ['ClienteId', 'ArticuloColocacionId'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ClienteId', 'ClienteId');
    }

    public function articuloColocacion()
    {
        return $this->belongsTo(ArticuloColocacion::class, 'ArticuloColocacionId', 'ArticuloColocacionId');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'PedidoId', 'PedidoId');
    }
}
