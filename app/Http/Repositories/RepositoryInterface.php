<?php

namespace App\Http\Repositories;

interface RepositoryInterface
{
    /**
     * Get's a model by it's ID
     *
     * @param integer $id
     */
    public function get($id);

    /**
     * Get's all model.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a model.
     *
     * @param integer $id
     */
    public function delete($id);

    /**
     * Updates a model.
     *
     * @param integer $id
     * @param array   $data
     */
    public function update($id, array $data);
}
