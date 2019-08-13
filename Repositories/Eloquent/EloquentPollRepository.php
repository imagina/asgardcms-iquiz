<?php

namespace Modules\Iquiz\Repositories\Eloquent;

use Modules\Iquiz\Repositories\PollRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentPollRepository extends EloquentBaseRepository implements PollRepository
{

    public function getItemsBy($params)
    {

      // INITIALIZE QUERY
      $query = $this->model->query();

      // RELATIONSHIPS
      $defaultInclude = ['translations'];
      if (isset($params->include))//merge relations with default relationships
        $includeDefault = array_merge($defaultInclude, $params->include);
      $query->with(array_merge($defaultInclude, $params->include));

      // FILTERS
      if($params->filter) {
        $filter = $params->filter;

        //add filter by search
        if (isset($filter->search)) {
            //find search in columns
            $query->where(function ($query) use ($filter) {
              $query->whereHas('translations', function ($query) use ($filter) {
                $query->where('locale', $filter->locale)
                  ->where('title', 'like', '%' . $filter->search . '%');
              })->orWhere('id', 'like', '%' . $filter->search . '%');
            });
        }
        
        //add filter by date
        if (isset($filter->date)) {
          $date = $filter->date;//Short filter date
          $date->field = $date->field ?? 'created_at';
          if (isset($date->from))//From a date
              $query->whereDate($date->field, '>=', $date->from);
          if (isset($date->to))//to a date
              $query->whereDate($date->field, '<=', $date->to);
        }
          
        //add filter by status id
        if (isset($filter->status)){
            $query->where('status', $filter->status);
        }

      }

      /*== FIELDS ==*/
      if (isset($params->fields) && count($params->fields))
        $query->select($params->fields);

      /*== REQUEST ==*/
      if (isset($params->page) && $params->page) {
        return $query->paginate($params->take);
      } else {
        $params->take ? $query->take($params->take) : false;//Take
        return $query->get();
      }
    
    }

    public function getItem($criteria, $params)
    {
      // INITIALIZE QUERY
      $query = $this->model->query();

      $query->where('id', $criteria);

      // RELATIONSHIPS
      $includeDefault = [];
      $query->with(array_merge($includeDefault, $params->include));

      // FIELDS
      if ($params->fields) {
        $query->select($params->fields);
      }
      return $query->first();

    }

    public function create($data)
    {

        $poll = $this->model->create($data);

        //event(new EventWasCreated($event, $data));

        return $poll;
    }
    
    public function updateBy($criteria, $data, $params){

        // INITIALIZE QUERY
        $query = $this->model->query();
    
        // FILTER
        if (isset($params->filter)) {
          $filter = $params->filter;
    
          if (isset($filter->field))//Where field
            $query->where($filter->field, $criteria);
          else//where id
            $query->where('id', $criteria);
        }
    
        // REQUEST
        $model = $query->first();
    
        if($model){
    
          $model->update($data);
          
          // Event 
         // event(new EventWasUpdated($model, $data));
        
        }
    
        return $model;
    }

    public function deleteBy($criteria, $params)
    {
      // INITIALIZE QUERY
      $query = $this->model->query();
  
      // FILTER
      if (isset($params->filter)) {
        $filter = $params->filter;
  
        if (isset($filter->field)) //Where field
          $query->where($filter->field, $criteria);
        else //where id
          $query->where('id', $criteria);
      }
  
      // REQUEST
      $model = $query->first();
  
      if($model) {

        //event(new EventWasDeleted($model));

        $model->delete();

      }
    }

}
