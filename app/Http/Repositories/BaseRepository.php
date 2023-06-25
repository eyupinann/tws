<?php
namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Http\Repositories\RepositoryInterface;

class BaseRepository implements RepositoryInterface
{
    protected $model = null;

    /**
     * __construct function
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Setter for model
     *
     * @param Model $model Model object
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get by ID
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function get($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get all
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Deletes a record.
     *
     * @param integer $id
     */
    public function delete($id)
    {
        $this->model->destroy($id);
    }

    /**
     * Create an object and save
     *
     * @param array $input Input data
     *
     * @return Model
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Updates a post.
     *
     * @param integer $id
     * @param array   $data
     *
     * @return Model
     */
    public function update($id, array $data)
    {
        $object = $this->model->find($id);

        $object->update($data);

        return $object;
    }

    /**
     * Get paganiated data with simple interface
     *
     * @param integer $itemPerPage The number of items per page
     *
     * @return mixed
     */
    public function getSimplePaginatedData($itemPerPage = 50)
    {
        return $this->model->orderBy('id', 'ASC')->simplePaginate($itemPerPage);
    }

    /**
     * Get paganiated data
     *
     * @param integer $itemPerPage The number of items per page
     *
     * @return mixed
     */
    public function getPaginatedData($itemPerPage = 50)
    {
        return $this->model->orderBy('id', 'ASC')->paginate($itemPerPage);
    }

    /**
     * Get data
     *
     * @param array $params The query parameter array with field names as keys
     *
     * @return mixed
     */
    public function getData($params = [], $with = [])
    {
        $model = $this->model->orderBy('id', 'ASC');

        foreach ($params as $field => $value) {
            $model->where($field, $value);
        }

        return $model->with($with)->get();
    }

    /**
     * Get latest
     *
     * @param array $params The query parameter array with field names as keys
     *
     * @return mixed
     */
    public function getLatest($params = [], $with = [])
    {
        $model = $this->model->orderBy('id', 'ASC');

        foreach ($params as $field => $value) {
            $model->where($field, $value);
        }

        return $model->with($with)->first();
    }

    /**
     * Rules configuration
     *
     * @param string $type   Type of the rules
     * @param Model  $object Object of the model
     *
     * @return array
     */
    public function rules($type = '', Model $object = null)
    {
        $rules = [];

        return $rules;
    }
}
