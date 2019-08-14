<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/user-question-answers'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.iquiz.user-question-answers.create',
    'uses' => 'UserQuestionAnswerApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.iquiz.user-question-answers.index',
    'uses' => 'UserQuestionAnswerApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.iquiz.user-question-answers.update',
    'uses' => 'UserQuestionAnswerApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.iquiz.user-question-answers.delete',
    'uses' => 'UserQuestionAnswerApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.iquiz.user-question-answers.show',
    'uses' => 'UserQuestionAnswerApiController@show',
  ]);

});