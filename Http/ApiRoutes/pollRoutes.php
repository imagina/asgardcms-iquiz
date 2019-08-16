<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/polls'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.iquiz.polls.create',
    'uses' => 'PollApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.iquiz.polls.index',
    'uses' => 'PollApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.iquiz.polls.update',
    'uses' => 'PollApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.iquiz.polls.delete',
    'uses' => 'PollApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.iquiz.polls.show',
    'uses' => 'PollApiController@show',
  ]);

});