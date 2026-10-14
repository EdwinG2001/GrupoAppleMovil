<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApiController;
use App\Models\GeneroModel;

class Genero extends BaseApiController
{
    protected $model;

    public function __construct()
    {
        $this->model = new GeneroModel();
    }

    // GET /api/genero
    public function index()
    {
        $data = $this->model->findAll();
        return $this->successResponse($data, 'Lista de géneros');
    }

    // GET /api/genero/{id}
    public function show($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->errorResponse('Género no encontrado', 404);
        }

        return $this->successResponse($data, 'Género encontrado');
    }

    // POST /api/genero
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

    // PUT /api/genero/{id}
    public function update($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Género no encontrado', 404);
        }

        $input = $this->request->getJSON(true) ?? $this->request->getRawInput();

        if (!$this->model->validate($input)) {
            return $this->errorResponse('Error de validación', 400, $this->model->errors());
        }

        $this->model->update($id, $input);
        $data = $this->model->find($id);

        return $this->successResponse($data, 'Género actualizado exitosamente');
    }

    // DELETE /api/genero/{id}
    public function delete($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Género no encontrado', 404);
        }

        $this->model->delete($id);

        return $this->successResponse(null, 'Género eliminado exitosamente');
    }
}
