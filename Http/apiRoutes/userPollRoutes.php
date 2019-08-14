<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/user-polls'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.iquiz.user-polls.create',
    'uses' => 'UserPollApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.iquiz.user-polls.index',
    'uses' => 'UserPollApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.iquiz.user-polls.update',
    'uses' => 'UserPollApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.iquiz.user-polls.delete',
    'uses' => 'UserPollApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.iquiz.user-polls.show',
    'uses' => 'UserPollApiController@show',
  ]);

});