<?php

namespace Modules\Iquiz\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iquiz\Entities\Answer;
use Modules\Iquiz\Http\Requests\CreateAnswerRequest;
use Modules\Iquiz\Http\Requests\UpdateAnswerRequest;
use Modules\Iquiz\Repositories\AnswerRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class AnswerController extends AdminBaseController
{
    /**
     * @var AnswerRepository
     */
    private $answer;

    public function __construct(AnswerRepository $answer)
    {
        parent::__construct();

        $this->answer = $answer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$answers = $this->answer->all();

        return view('iquiz::admin.answers.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iquiz::admin.answers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAnswerRequest $request
     * @return Response
     */
    public function store(CreateAnswerRequest $request)
    {
        $this->answer->create($request->all());

        return redirect()->route('admin.iquiz.answer.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iquiz::answers.title.answers')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Answer $answer
     * @return Response
     */
    public function edit(Answer $answer)
    {
        return view('iquiz::admin.answers.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Answer $answer
     * @param  UpdateAnswerRequest $request
     * @return Response
     */
    public function update(Answer $answer, UpdateAnswerRequest $request)
    {
        $this->answer->update($answer, $request->all());

        return redirect()->route('admin.iquiz.answer.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iquiz::answers.title.answers')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Answer $answer
     * @return Response
     */
    public function destroy(Answer $answer)
    {
        $this->answer->destroy($answer);

        return redirect()->route('admin.iquiz.answer.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iquiz::answers.title.answers')]));
    }
}
