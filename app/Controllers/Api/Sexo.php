<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApiController;
use App\Models\SexoModel;

class Sexo extends BaseApiController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SexoModel();
    }

    // GET /api/sexo
    public function index()
    {
        $data = $this->model->findAll();
        return $this->successResponse($data, 'Lista de sexos');
    }

    // GET /api/sexo/{id}
    public function show($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->errorResponse('Sexo no encontrado', 404);
        }

        return $this->successResponse($data, 'Sexo encontrado');
    }

    // POST /api/sexo
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

    // PUT /api/sexo/{id}
    public function update($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Sexo no encontrado', 404);
        }

        $input = $this->request->getJSON(true) ?? $this->request->getRawInput();

        if (!$this->model->validate($input)) {
            return $this->errorResponse('Error de validación', 400, $this->model->errors());
        }

        $this->model->update($id, $input);
        $data = $this->model->find($id);

        return $this->successResponse($data, 'Sexo actualizado exitosamente');
    }

    // DELETE /api/sexo/{id}
    public function delete($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Sexo no encontrado', 404);
        }

        $this->model->delete($id);

        return $this->successResponse(null, 'Sexo eliminado exitosamente');
    }
}
