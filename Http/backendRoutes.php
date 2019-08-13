<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/iquiz'], function (Router $router) {
    $router->bind('poll', function ($id) {
        return app('Modules\Iquiz\Repositories\PollRepository')->find($id);
    });
    $router->get('polls', [
        'as' => 'admin.iquiz.poll.index',
        'uses' => 'PollController@index',
        'middleware' => 'can:iquiz.polls.index'
    ]);
    $router->get('polls/create', [
        'as' => 'admin.iquiz.poll.create',
        'uses' => 'PollController@create',
        'middleware' => 'can:iquiz.polls.create'
    ]);
    $router->post('polls', [
        'as' => 'admin.iquiz.poll.store',
        'uses' => 'PollController@store',
        'middleware' => 'can:iquiz.polls.create'
    ]);
    $router->get('polls/{poll}/edit', [
        'as' => 'admin.iquiz.poll.edit',
        'uses' => 'PollController@edit',
        'middleware' => 'can:iquiz.polls.edit'
    ]);
    $router->put('polls/{poll}', [
        'as' => 'admin.iquiz.poll.update',
        'uses' => 'PollController@update',
        'middleware' => 'can:iquiz.polls.edit'
    ]);
    $router->delete('polls/{poll}', [
        'as' => 'admin.iquiz.poll.destroy',
        'uses' => 'PollController@destroy',
        'middleware' => 'can:iquiz.polls.destroy'
    ]);
    $router->bind('question', function ($id) {
        return app('Modules\Iquiz\Repositories\QuestionRepository')->find($id);
    });
    $router->get('questions', [
        'as' => 'admin.iquiz.question.index',
        'uses' => 'QuestionController@index',
        'middleware' => 'can:iquiz.questions.index'
    ]);
    $router->get('questions/create', [
        'as' => 'admin.iquiz.question.create',
        'uses' => 'QuestionController@create',
        'middleware' => 'can:iquiz.questions.create'
    ]);
    $router->post('questions', [
        'as' => 'admin.iquiz.question.store',
        'uses' => 'QuestionController@store',
        'middleware' => 'can:iquiz.questions.create'
    ]);
    $router->get('questions/{question}/edit', [
        'as' => 'admin.iquiz.question.edit',
        'uses' => 'QuestionController@edit',
        'middleware' => 'can:iquiz.questions.edit'
    ]);
    $router->put('questions/{question}', [
        'as' => 'admin.iquiz.question.update',
        'uses' => 'QuestionController@update',
        'middleware' => 'can:iquiz.questions.edit'
    ]);
    $router->delete('questions/{question}', [
        'as' => 'admin.iquiz.question.destroy',
        'uses' => 'QuestionController@destroy',
        'middleware' => 'can:iquiz.questions.destroy'
    ]);
    $router->bind('answer', function ($id) {
        return app('Modules\Iquiz\Repositories\AnswerRepository')->find($id);
    });
    $router->get('answers', [
        'as' => 'admin.iquiz.answer.index',
        'uses' => 'AnswerController@index',
        'middleware' => 'can:iquiz.answers.index'
    ]);
    $router->get('answers/create', [
        'as' => 'admin.iquiz.answer.create',
        'uses' => 'AnswerController@create',
        'middleware' => 'can:iquiz.answers.create'
    ]);
    $router->post('answers', [
        'as' => 'admin.iquiz.answer.store',
        'uses' => 'AnswerController@store',
        'middleware' => 'can:iquiz.answers.create'
    ]);
    $router->get('answers/{answer}/edit', [
        'as' => 'admin.iquiz.answer.edit',
        'uses' => 'AnswerController@edit',
        'middleware' => 'can:iquiz.answers.edit'
    ]);
    $router->put('answers/{answer}', [
        'as' => 'admin.iquiz.answer.update',
        'uses' => 'AnswerController@update',
        'middleware' => 'can:iquiz.answers.edit'
    ]);
    $router->delete('answers/{answer}', [
        'as' => 'admin.iquiz.answer.destroy',
        'uses' => 'AnswerController@destroy',
        'middleware' => 'can:iquiz.answers.destroy'
    ]);
    $router->bind('userquestionanswer', function ($id) {
        return app('Modules\Iquiz\Repositories\UserQuestionAnswerRepository')->find($id);
    });
    $router->get('userquestionanswers', [
        'as' => 'admin.iquiz.userquestionanswer.index',
        'uses' => 'UserQuestionAnswerController@index',
        'middleware' => 'can:iquiz.userquestionanswers.index'
    ]);
    $router->get('userquestionanswers/create', [
        'as' => 'admin.iquiz.userquestionanswer.create',
        'uses' => 'UserQuestionAnswerController@create',
        'middleware' => 'can:iquiz.userquestionanswers.create'
    ]);
    $router->post('userquestionanswers', [
        'as' => 'admin.iquiz.userquestionanswer.store',
        'uses' => 'UserQuestionAnswerController@store',
        'middleware' => 'can:iquiz.userquestionanswers.create'
    ]);
    $router->get('userquestionanswers/{userquestionanswer}/edit', [
        'as' => 'admin.iquiz.userquestionanswer.edit',
        'uses' => 'UserQuestionAnswerController@edit',
        'middleware' => 'can:iquiz.userquestionanswers.edit'
    ]);
    $router->put('userquestionanswers/{userquestionanswer}', [
        'as' => 'admin.iquiz.userquestionanswer.update',
        'uses' => 'UserQuestionAnswerController@update',
        'middleware' => 'can:iquiz.userquestionanswers.edit'
    ]);
    $router->delete('userquestionanswers/{userquestionanswer}', [
        'as' => 'admin.iquiz.userquestionanswer.destroy',
        'uses' => 'UserQuestionAnswerController@destroy',
        'middleware' => 'can:iquiz.userquestionanswers.destroy'
    ]);
    $router->bind('userpoll', function ($id) {
        return app('Modules\Iquiz\Repositories\UserPollRepository')->find($id);
    });
    $router->get('userpolls', [
        'as' => 'admin.iquiz.userpoll.index',
        'uses' => 'UserPollController@index',
        'middleware' => 'can:iquiz.userpolls.index'
    ]);
    $router->get('userpolls/create', [
        'as' => 'admin.iquiz.userpoll.create',
        'uses' => 'UserPollController@create',
        'middleware' => 'can:iquiz.userpolls.create'
    ]);
    $router->post('userpolls', [
        'as' => 'admin.iquiz.userpoll.store',
        'uses' => 'UserPollController@store',
        'middleware' => 'can:iquiz.userpolls.create'
    ]);
    $router->get('userpolls/{userpoll}/edit', [
        'as' => 'admin.iquiz.userpoll.edit',
        'uses' => 'UserPollController@edit',
        'middleware' => 'can:iquiz.userpolls.edit'
    ]);
    $router->put('userpolls/{userpoll}', [
        'as' => 'admin.iquiz.userpoll.update',
        'uses' => 'UserPollController@update',
        'middleware' => 'can:iquiz.userpolls.edit'
    ]);
    $router->delete('userpolls/{userpoll}', [
        'as' => 'admin.iquiz.userpoll.destroy',
        'uses' => 'UserPollController@destroy',
        'middleware' => 'can:iquiz.userpolls.destroy'
    ]);
// append





});
