<?php

namespace Modules\Iquiz\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iquiz\Entities\UserPoll;
use Modules\Iquiz\Http\Requests\CreateUserPollRequest;
use Modules\Iquiz\Http\Requests\UpdateUserPollRequest;
use Modules\Iquiz\Repositories\UserPollRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class UserPollController extends AdminBaseController
{
    /**
     * @var UserPollRepository
     */
    private $userpoll;

    public function __construct(UserPollRepository $userpoll)
    {
        parent::__construct();

        $this->userpoll = $userpoll;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$userpolls = $this->userpoll->all();

        return view('iquiz::admin.userpolls.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iquiz::admin.userpolls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserPollRequest $request
     * @return Response
     */
    public function store(CreateUserPollRequest $request)
    {
        $this->userpoll->create($request->all());

        return redirect()->route('admin.iquiz.userpoll.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iquiz::userpolls.title.userpolls')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  UserPoll $userpoll
     * @return Response
     */
    public function edit(UserPoll $userpoll)
    {
        return view('iquiz::admin.userpolls.edit', compact('userpoll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserPoll $userpoll
     * @param  UpdateUserPollRequest $request
     * @return Response
     */
    public function update(UserPoll $userpoll, UpdateUserPollRequest $request)
    {
        $this->userpoll->update($userpoll, $request->all());

        return redirect()->route('admin.iquiz.userpoll.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iquiz::userpolls.title.userpolls')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UserPoll $userpoll
     * @return Response
     */
    public function destroy(UserPoll $userpoll)
    {
        $this->userpoll->destroy($userpoll);

        return redirect()->route('admin.iquiz.userpoll.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iquiz::userpolls.title.userpolls')]));
    }
}
