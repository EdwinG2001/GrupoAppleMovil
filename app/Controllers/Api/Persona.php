<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApiController;
use App\Models\PersonaModel;

class Persona extends BaseApiController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PersonaModel();
    }

    // GET /api/persona
    public function index()
    {
        $data = $this->model->getPersonaConRelaciones();
        return $this->successResponse($data, 'Lista de personas');
    }

    // GET /api/persona/{id}
    public function show($id = null)
    {
        $data = $this->model->getPersonaConRelaciones($id);

        if (!$data) {
            return $this->errorResponse('Persona no encontrada', 404);
        }

        return $this->successResponse($data, 'Persona encontrada');
    }

    // POST /api/persona
    public function create()
    {
        $input = $this->request->getJSON(true) ?? $this->request->getPost();

        if (!$this->model->validate($input)) {
            return $this->errorResponse('Error de validación', 400, $this->model->errors());
        }

        $id = $this->model->insert($input);
        $data = $this->model->getPersonaConRelaciones($id);

        return $this->createdResponse($data);
    }

    // PUT /api/persona/{id}
    public function update($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Persona no encontrada', 404);
        }

        $input = $this->request->getJSON(true) ?? $this->request->getRawInput();

        if (!$this->model->validate($input)) {
            return $this->errorResponse('Error de validación', 400, $this->model->errors());
        }

        $this->model->update($id, $input);
        $data = $this->model->getPersonaConRelaciones($id);

        return $this->successResponse($data, 'Persona actualizada exitosamente');
    }

    // DELETE /api/persona/{id}
    public function delete($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Persona no encontrada', 404);
        }

        $this->model->delete($id);

        return $this->successResponse(null, 'Persona eliminada exitosamente');
    }
}
