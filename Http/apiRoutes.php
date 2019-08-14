<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/iquiz/v1'], function (Router $router) {

  //======  POLLS
  require('ApiRoutes/pollRoutes.php');

  //======  QUESTIONS
  require('ApiRoutes/questionRoutes.php');

  //======  ANSWER
  require('ApiRoutes/answerRoutes.php');

  //======  USER QUESTION ANSWER
  require('ApiRoutes/userQuestionAnswerRoutes.php');

  //======  USERS POLLS
  require('ApiRoutes/userPollRoutes.php');

});
