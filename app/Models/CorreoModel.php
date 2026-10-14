<?php

namespace App\Models;

use CodeIgniter\Model;

class CorreoModel extends Model
{
    protected $table            = 'correo';
    protected $primaryKey       = 'idcorreo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['idpersona', 'correo'];

    // Validación
    protected $validationRules = [
        'idpersona' => 'required|integer',
        'correo'    => 'required|valid_email|max_length[150]',
    ];

    protected $validationMessages = [
        'idpersona' => [
            'required' => 'La persona es obligatoria.',
            'integer'  => 'El ID de persona debe ser un número entero.',
        ],
        'correo' => [
            'required'    => 'El correo es obligatorio.',
            'valid_email' => 'El correo no tiene un formato válido.',
            'max_length'  => 'El correo no puede exceder 150 caracteres.',
        ],
    ];

    /**
     * Obtener correos por persona
     */
    public function getByPersona($idpersona)
    {
        return $this->where('idpersona', $idpersona)->findAll();
    }
}
