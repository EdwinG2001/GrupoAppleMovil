<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApiController;
use App\Models\EstadoCivilModel;

class EstadoCivil extends BaseApiController
{
    protected $model;

    public function __construct()
    {
        $this->model = new EstadoCivilModel();
    }

    // GET /api/estadocivil
    public function index()
    {
        $data = $this->model->findAll();
        return $this->successResponse($data, 'Lista de estados civiles');
    }

    // GET /api/estadocivil/{id}
    public function show($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->errorResponse('Estado civil no encontrado', 404);
        }

        return $this->successResponse($data, 'Estado civil encontrado');
    }

    // POST /api/estadocivil
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

    // PUT /api/estadocivil/{id}
    public function update($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Estado civil no encontrado', 404);
        }

        $input = $this->request->getJSON(true) ?? $this->request->getRawInput();

        if (!$this->model->validate($input)) {
            return $this->errorResponse('Error de validación', 400, $this->model->errors());
        }

        $this->model->update($id, $input);
        $data = $this->model->find($id);

        return $this->successResponse($data, 'Estado civil actualizado exitosamente');
    }

    // DELETE /api/estadocivil/{id}
    public function delete($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Estado civil no encontrado', 404);
        }

        $this->model->delete($id);

        return $this->successResponse(null, 'Estado civil eliminado exitosamente');
    }
}
