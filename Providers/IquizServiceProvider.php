<?php

namespace Modules\Iquiz\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Iquiz\Events\Handlers\RegisterIquizSidebar;

class IquizServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIquizSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('polls', array_dot(trans('iquiz::polls')));
            $event->load('questions', array_dot(trans('iquiz::questions')));
            $event->load('answers', array_dot(trans('iquiz::answers')));
            $event->load('userquestionanswers', array_dot(trans('iquiz::userquestionanswers')));
            $event->load('userpolls', array_dot(trans('iquiz::userpolls')));
            // append translations





        });
    }

    public function boot()
    {
        $this->publishConfig('iquiz', 'permissions');
        $this->publishConfig('iquiz', 'settings');
        $this->publishConfig('iquiz', 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Iquiz\Repositories\PollRepository',
            function () {
                $repository = new \Modules\Iquiz\Repositories\Eloquent\EloquentPollRepository(new \Modules\Iquiz\Entities\Poll());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iquiz\Repositories\Cache\CachePollDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iquiz\Repositories\QuestionRepository',
            function () {
                $repository = new \Modules\Iquiz\Repositories\Eloquent\EloquentQuestionRepository(new \Modules\Iquiz\Entities\Question());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iquiz\Repositories\Cache\CacheQuestionDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iquiz\Repositories\AnswerRepository',
            function () {
                $repository = new \Modules\Iquiz\Repositories\Eloquent\EloquentAnswerRepository(new \Modules\Iquiz\Entities\Answer());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iquiz\Repositories\Cache\CacheAnswerDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iquiz\Repositories\UserQuestionAnswerRepository',
            function () {
                $repository = new \Modules\Iquiz\Repositories\Eloquent\EloquentUserQuestionAnswerRepository(new \Modules\Iquiz\Entities\UserQuestionAnswer());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iquiz\Repositories\Cache\CacheUserQuestionAnswerDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iquiz\Repositories\UserPollRepository',
            function () {
                $repository = new \Modules\Iquiz\Repositories\Eloquent\EloquentUserPollRepository(new \Modules\Iquiz\Entities\UserPoll());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iquiz\Repositories\Cache\CacheUserPollDecorator($repository);
            }
        );
// add bindings





    }
}
