<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class BaseApiController extends ResourceController
{
    protected $format = 'json';

    /**
     * Respuesta de éxito estándar
     */
    protected function successResponse($data = null, string $message = 'Éxito', int $code = 200)
    {
        return $this->respond([
            'status'  => $code,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    /**
     * Respuesta de error estándar
     */
    protected function errorResponse(string $message = 'Error', int $code = 400, $errors = null)
    {
        return $this->respond([
            'status'  => $code,
            'message' => $message,
            'errors'  => $errors,
        ], $code);
    }

    /**
     * Respuesta de creación exitosa
     */
    protected function createdResponse($data = null, string $message = 'Registro creado exitosamente')
    {
        return $this->successResponse($data, $message, 201);
    }
}
