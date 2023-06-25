<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Repositories\RoleRepository;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Custom\Response;
/**
 * @group Roles
 *
 */
class RoleController extends Controller
{
    private $roleRepository = null;
    private $response = null;


    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->response = new Response();
    }

    /**
     * List Role
     *
     * List the roles of the user.
     *
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function index(RoleRepository $roleRepository)
    {
        return $this->response->withData(
            true,
            "Role list is fetched successfully.",
            [
                'roles'  => RoleResource::collection($roleRepository->all())
            ]
        );

    }

    /**
     * Create Role
     *
     * Create a roles for user with given parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function store(Request $request,  RoleRepository $roleRepository)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $role     = $roleRepository->create($data);


        return $this->response->withData(
            true,
            "'Role is successfully created.",
            [
                'role'  => RoleResource::make($role)
            ]
        );
    }

    /**
     * View Roles
     *
     * View the roles details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function show( Role $role)
    {
        return $this->response->withData(
            true,
            'Role is fetched successfully.',
            [
                'role'   => new RoleResource($role),
            ]
        );
    }

    /**
     * Update Role
     *
     * Update the roles with given paramaters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function update(Role $role, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $role = $this->roleRepository->update($role->id, $data);

        return $this->response->withData(
            true,
            "Role successfully updated.",
            [
                'roles'  => RoleResource::make($role)
            ]
        );
    }

    /**
     * Delete Role
     *
     * Delete the given role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function destroy(Role $role,  RoleRepository $roleRepository)
    {
        $roleRepository->delete($role->id);

        return $this->response->withoutData(
            true,
            "Role is successfully deleted.",
        );
    }
}
