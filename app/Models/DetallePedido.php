<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = 'detalle_pedido';
    protected $primaryKey = 'id_detalle';
    public $timestamps = false;

    protected $fillable = [
        'id_pedido',
        'id_producto',
        'id_presentacion',
        'cantidad',
        'monto',
    ];
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id_pedido');
    }

    public function producto()
    {
        return $this->belongsTo(
            Producto::class, 
            'id_producto', 
            'id_producto');
    }

    public function presentacion()
    {
        return $this->belongsTo(
            Presentacion::class, 
            'id_presentacion', 
            'id_presentacion');
    }
}
