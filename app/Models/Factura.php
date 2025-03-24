<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'tblFactura';
    protected $primaryKey = 'FacturaId';
    public $timestamps = true;

    protected $fillable = ['PedidoId', 'ClienteId', 'nombreArticulo', 'unidadesCompradas'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'PedidoId', 'PedidoId');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ClienteId', 'ClienteId');
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'nombreArticulo', 'nombreArticulo');
    }
}
