<?php

namespace App\Models;

use CodeIgniter\Model;

class TelefonoModel extends Model
{
    protected $table            = 'telefono';
    protected $primaryKey       = 'idtelefono';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['idpersona', 'telefono', 'tipo'];

    // Validación
    protected $validationRules = [
        'idpersona' => 'required|integer',
        'telefono'  => 'required|max_length[20]',
        'tipo'      => 'permit_empty|max_length[50]',
    ];

    protected $validationMessages = [
        'idpersona' => [
            'required' => 'La persona es obligatoria.',
            'integer'  => 'El ID de persona debe ser un número entero.',
        ],
        'telefono' => [
            'required'   => 'El teléfono es obligatorio.',
            'max_length' => 'El teléfono no puede exceder 20 caracteres.',
        ],
    ];

    /**
     * Obtener teléfonos por persona
     */
    public function getByPersona($idpersona)
    {
        return $this->where('idpersona', $idpersona)->findAll();
    }
}
