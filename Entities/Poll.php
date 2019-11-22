<?php

namespace Modules\Iquiz\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;
use Modules\Iquiz\Presenters\PollPresenter;

class Poll extends Model
{
    use Translatable,PresentableTrait;

    protected $table = 'iquiz__polls';

    protected $presenter = PollPresenter::class;

    public $translatedAttributes = [
        'title',
        'description'
    ];
    protected $fillable = [
        'start_date',
        'end_date',
        'logged',
        'status',
        'store_id'
    ];

    protected $casts = [
        'logged' => 'boolean',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function userPolls()
    {
        return $this->hasMany(UserPoll::class);
    }


    /**
     * Magic Method modification to allow dynamic relations to other entities.
     * @var $value
     * @var $destination_path
     * @return string
     */
    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['asgard.iquiz.config.relations.polls', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

}
