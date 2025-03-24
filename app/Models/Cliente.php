<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'tblCliente';
    protected $primaryKey = 'ClienteId';
    public $timestamps = true;

    protected $fillable = ['nombre', 'telefono', 'TipoClienteId'];

    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class, 'TipoClienteId', 'tblTipoClienteId');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'ClienteId', 'ClienteId');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'ClienteId', 'ClienteId');
    }
}
