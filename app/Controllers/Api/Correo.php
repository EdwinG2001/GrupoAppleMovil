<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApiController;
use App\Models\CorreoModel;

class Correo extends BaseApiController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CorreoModel();
    }

    // GET /api/correo
    public function index()
    {
        $data = $this->model->findAll();
        return $this->successResponse($data, 'Lista de correos');
    }

    // GET /api/correo/{id}
    public function show($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->errorResponse('Correo no encontrado', 404);
        }

        return $this->successResponse($data, 'Correo encontrado');
    }

    // GET /api/correo/persona/{id}
    public function byPersona($idpersona)
    {
        $data = $this->model->getByPersona($idpersona);
        return $this->successResponse($data, 'Correos de la persona');
    }

    // POST /api/correo
    public function create()
    {
        $input = $this->request->getJSON(true) ?? $this->request->getPost();

        if (!$this->model->validate($input)) {
            return $this->errorResponse('Error de validación', 400, $this->model->errors());
        }

        $id = $this->model->insert($input);
        $data = $this->model->find($id);

        return $this->createdResponse($data);
    }

    // PUT /api/correo/{id}
    public function update($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Correo no encontrado', 404);
        }

        $input = $this->request->getJSON(true) ?? $this->request->getRawInput();

        if (!$this->model->validate($input)) {
            return $this->errorResponse('Error de validación', 400, $this->model->errors());
        }

        $this->model->update($id, $input);
        $data = $this->model->find($id);

        return $this->successResponse($data, 'Correo actualizado exitosamente');
    }

    // DELETE /api/correo/{id}
    public function delete($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Correo no encontrado', 404);
        }

        $this->model->delete($id);

        return $this->successResponse(null, 'Correo eliminado exitosamente');
    }
}
