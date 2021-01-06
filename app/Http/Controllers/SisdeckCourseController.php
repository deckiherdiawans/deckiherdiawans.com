<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSisdeckCourseRequest;
use App\Http\Requests\UpdateSisdeckCourseRequest;
use App\Repositories\SisdeckCourseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SisdeckCourseController extends AppBaseController
{
    /** @var  SisdeckCourseRepository */
    private $sisdeckCourseRepository;

    public function __construct(SisdeckCourseRepository $sisdeckCourseRepo)
    {
        $this->middleware('sisdeck.auth');
        $this->sisdeckCourseRepository = $sisdeckCourseRepo;
    }

    /**
     * Display a listing of the SisdeckCourse.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sisdeckCourses = $this->sisdeckCourseRepository->all();

        return view('/sisdeck/courses/index')
            ->with('sisdeckCourses', $sisdeckCourses);
    }

    /**
     * Show the form for creating a new SisdeckCourse.
     *
     * @return Response
     */
    public function create()
    {
        return view('/sisdeck/courses/create');
    }

    /**
     * Store a newly created SisdeckCourse in storage.
     *
     * @param CreateSisdeckCourseRequest $request
     *
     * @return Response
     */
    public function store(CreateSisdeckCourseRequest $request)
    {
        $input = $request->all();

        $sisdeckCourse = $this->sisdeckCourseRepository->create($input);

        Flash::success('Course saved successfully.');

        return redirect(route('sisdeck.courses.index'));
    }

    /**
     * Display the specified SisdeckCourse.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sisdeckCourse = $this->sisdeckCourseRepository->find($id);

        if (empty($sisdeckCourse)) {
            Flash::error('Course not found.');

            return redirect(route('sisdeck.courses.index'));
        }

        return view('/sisdeck/courses/show')->with('sisdeckCourse', $sisdeckCourse);
    }

    /**
     * Show the form for editing the specified SisdeckCourse.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sisdeckCourse = $this->sisdeckCourseRepository->find($id);

        if (empty($sisdeckCourse)) {
            Flash::error('Course not found.');

            return redirect(route('sisdeck.courses.index'));
        }

        return view('/sisdeck/courses/edit')->with('sisdeckCourse', $sisdeckCourse);
    }

    /**
     * Update the specified SisdeckCourse in storage.
     *
     * @param int $id
     * @param UpdateSisdeckCourseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSisdeckCourseRequest $request)
    {
        $sisdeckCourse = $this->sisdeckCourseRepository->find($id);

        if (empty($sisdeckCourse)) {
            Flash::error('Course not found.');

            return redirect(route('sisdeck.courses.index'));
        }

        $sisdeckCourse = $this->sisdeckCourseRepository->update($request->all(), $id);

        Flash::success('Course updated successfully.');

        return redirect(route('sisdeck.courses.index'));
    }

    /**
     * Remove the specified SisdeckCourse from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sisdeckCourse = $this->sisdeckCourseRepository->find($id);

        if (empty($sisdeckCourse)) {
            Flash::error('Course not found.');

            return redirect(route('sisdeck.courses.index'));
        }

        $this->sisdeckCourseRepository->delete($id);

        Flash::success('Course deleted successfully.');

        return redirect(route('sisdeck.courses.index'));
    }
}
