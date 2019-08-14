<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/questions'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.iquiz.questions.create',
    'uses' => 'QuestionApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.iquiz.questions.index',
    'uses' => 'QuestionApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.iquiz.questions.update',
    'uses' => 'QuestionApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.iquiz.questions.delete',
    'uses' => 'QuestionApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.iquiz.questions.show',
    'uses' => 'QuestionApiController@show',
  ]);

});