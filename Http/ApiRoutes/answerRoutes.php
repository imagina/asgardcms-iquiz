<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/answers'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.iquiz.answers.create',
    'uses' => 'AnswerApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.iquiz.answers.index',
    'uses' => 'AnswerApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.iquiz.answers.update',
    'uses' => 'AnswerApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.iquiz.answers.delete',
    'uses' => 'AnswerApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.iquiz.questions.show',
    'uses' => 'AnswerApiController@show',
  ]);

});