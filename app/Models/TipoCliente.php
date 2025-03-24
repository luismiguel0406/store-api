<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    use HasFactory;

    protected $table = 'tblTipoCliente';
    protected $primaryKey = 'TipoClienteId';
    public $timestamps = true;

    protected $fillable = ['descripcion'];

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'TipoClienteId', 'TipoClienteId');
    }
}
