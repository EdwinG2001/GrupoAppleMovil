<?php

namespace App\Models;

use CodeIgniter\Model;

class DireccionModel extends Model
{
    protected $table            = 'direccion';
    protected $primaryKey       = 'iddireccion';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['idpersona', 'direccion', 'ciudad', 'referencia'];

    // Validación
    protected $validationRules = [
        'idpersona'  => 'required|integer',
        'direccion'  => 'required|max_length[255]',
        'ciudad'     => 'required|max_length[100]',
        'referencia' => 'permit_empty|max_length[255]',
    ];

    protected $validationMessages = [
        'idpersona' => [
            'required' => 'La persona es obligatoria.',
            'integer'  => 'El ID de persona debe ser un número entero.',
        ],
        'direccion' => [
            'required'   => 'La dirección es obligatoria.',
            'max_length' => 'La dirección no puede exceder 255 caracteres.',
        ],
        'ciudad' => [
            'required'   => 'La ciudad es obligatoria.',
            'max_length' => 'La ciudad no puede exceder 100 caracteres.',
        ],
    ];

    /**
     * Obtener direcciones por persona
     */
    public function getByPersona($idpersona)
    {
        return $this->where('idpersona', $idpersona)->findAll();
    }
}
