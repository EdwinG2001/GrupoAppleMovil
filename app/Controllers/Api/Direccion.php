<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApiController;
use App\Models\DireccionModel;

class Direccion extends BaseApiController
{
    protected $model;

    public function __construct()
    {
        $this->model = new DireccionModel();
    }

    // GET /api/direccion
    public function index()
    {
        $data = $this->model->findAll();
        return $this->successResponse($data, 'Lista de direcciones');
    }

    // GET /api/direccion/{id}
    public function show($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->errorResponse('Dirección no encontrada', 404);
        }

        return $this->successResponse($data, 'Dirección encontrada');
    }

    // GET /api/direccion/persona/{id}
    public function byPersona($idpersona)
    {
        $data = $this->model->getByPersona($idpersona);
        return $this->successResponse($data, 'Direcciones de la persona');
    }

    // POST /api/direccion
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

    // PUT /api/direccion/{id}
    public function update($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Dirección no encontrada', 404);
        }

        $input = $this->request->getJSON(true) ?? $this->request->getRawInput();

        if (!$this->model->validate($input)) {
            return $this->errorResponse('Error de validación', 400, $this->model->errors());
        }

        $this->model->update($id, $input);
        $data = $this->model->find($id);

        return $this->successResponse($data, 'Dirección actualizada exitosamente');
    }

    // DELETE /api/direccion/{id}
    public function delete($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->errorResponse('Dirección no encontrada', 404);
        }

        $this->model->delete($id);

        return $this->successResponse(null, 'Dirección eliminada exitosamente');
    }
}
