<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSisdeckUserRequest;
use App\Http\Requests\UpdateSisdeckUserRequest;
use App\Repositories\SisdeckUserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SisdeckUserController extends AppBaseController
{
    /** @var  SisdeckUserRepository */
    private $sisdeckUserRepository;

    public function __construct(SisdeckUserRepository $sisdeckUserRepo)
    {
        $this->middleware('sisdeck.auth');
        $this->sisdeckUserRepository = $sisdeckUserRepo;
    }

    /**
     * Display a listing of the SisdeckUser.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sisdeckUsers = $this->sisdeckUserRepository->all();

        return view('sisdeck/users/index')
            ->with('sisdeckUsers', $sisdeckUsers);
    }

    /**
     * Show the form for creating a new SisdeckUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('sisdeck/users/create');
    }

    /**
     * Store a newly created SisdeckUser in storage.
     *
     * @param CreateSisdeckUserRequest $request
     *
     * @return Response
     */
    public function store(CreateSisdeckUserRequest $request)
    {
        $input = $request->all();

        $sisdeckUser = $this->sisdeckUserRepository->create($input);

        Flash::success('User saved successfully.');

        return redirect(route('sisdeck.users.index'));
    }

    /**
     * Display the specified SisdeckUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sisdeckUser = $this->sisdeckUserRepository->find($id);

        if (empty($sisdeckUser)) {
            Flash::error('User not found.');

            return redirect(route('sisdeck.users.index'));
        }

        return view('sisdeck/users/show')->with('sisdeckUser', $sisdeckUser);
    }

    /**
     * Show the form for editing the specified SisdeckUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sisdeckUser = $this->sisdeckUserRepository->find($id);

        if (empty($sisdeckUser)) {
            Flash::error('User not found.');

            return redirect(route('sisdeck.users.index'));
        }

        return view('sisdeck/users/edit')->with('sisdeckUser', $sisdeckUser);
    }

    /**
     * Update the specified SisdeckUser in storage.
     *
     * @param int $id
     * @param UpdateSisdeckUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSisdeckUserRequest $request)
    {
        $sisdeckUser = $this->sisdeckUserRepository->find($id);

        if (empty($sisdeckUser)) {
            Flash::error('User not found.');

            return redirect(route('sisdeck.users.index'));
        }

        $sisdeckUser = $this->sisdeckUserRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('sisdeck.users.index'));
    }

    /**
     * Remove the specified SisdeckUser from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sisdeckUser = $this->sisdeckUserRepository->find($id);

        if (empty($sisdeckUser)) {
            Flash::error('User not found.');

            return redirect(route('sisdeck.users.index'));
        }

        $this->sisdeckUserRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('sisdeck.users.index'));
    }
}