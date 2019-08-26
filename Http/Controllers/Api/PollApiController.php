<?php

namespace Modules\Iquiz\Http\Controllers\Api;

// Requests & Response
use Modules\Iquiz\Http\Requests\CreatePollRequest;
use Modules\Iquiz\Http\Requests\UpdatePollRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Iquiz\Transformers\PollTransformer;

// Entities
use Modules\Iquiz\Entities\Poll;

// Repositories
use Modules\Iquiz\Repositories\PollRepository;

//Support
use Illuminate\Support\Facades\Auth;

class PollApiController extends BaseApiController
{

  private $poll;
  
  public function __construct(
    PollRepository $poll
    )
  {
    $this->poll = $poll;
    
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    try {
      //Request to Repository
      $polls = $this->poll->getItemsBy($this->getParamsRequest($request));

      //Response
      $response = ['data' => PollTransformer::collection($polls)];
      
      //If request pagination add meta-page
      $request->page ? $response['meta'] = ['page' => $this->pageTransformer($polls)] : false;

    } catch (\Exception $e) {
      
      \Log::error($e);
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];

    }
    return response()->json($response, $status ?? 200);
  }

  /** SHOW
   * @param Request $request
   *  URL GET:
   *  &fields = type string
   *  &include = type string
   */
  public function show($criteria, Request $request)
  {
    try {
      //Request to Repository
      $poll = $this->poll->getItem($criteria,$this->getParamsRequest($request));

      //Break if no found item
      if (!$poll) throw new \Exception('Item not found', 204);

      $response = [
        'data' => $poll ? new PollTransformer($poll) : '',
      ];

    } catch (\Exception $e) {
      \Log::error($e);
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create(Request $request)
  {

    \DB::beginTransaction();

    try{

      //Get data
      $data = $request['attributes'] ?? [];

      //Validate Request
      $this->validateRequestApi(new CreatePollRequest($data));

      //Create
      $poll = $this->poll->create($data);

      //Response
      $response = ["data" => new PollTransformer($poll)];

      \DB::commit(); //Commit to Data Base

    } catch (\Exception $e) {

        \Log::error($e);
        \DB::rollback();//Rollback to Data Base
        $status = $this->getStatusError($e->getCode());
        $response = ["errors" => $e->getMessage()];
    }

    return response()->json($response, $status ?? 200);

  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update($criteria, Request $request)
  {
    try {

      \DB::beginTransaction();

      //Get data
      $data = $request['attributes'] ?? [];

      //Validate Request
      $this->validateRequestApi(new UpdatePollRequest($data));

      $params = $this->getParamsRequest($request);
      
      // Search entity
      $entity = $this->poll->getItem($criteria,$params);

      //Break if no found item
      if (!$entity) throw new \Exception('Item not found', 204);

      $poll = $this->poll->update($entity,$data);

      $response = ['data' => new PollTransformer($poll)];

      \DB::commit(); //Commit to Data Base

    } catch (\Exception $e) {

      \Log::error($e);
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
      
    }

    return response()->json($response, $status ?? 200);

  }


  /**
   * Remove the specified resource from storage.
   * @return Response
   */
  public function delete($criteria, Request $request)
  {
    try {

      //Get params
      $params = $this->getParamsRequest($request);

      // Search entity
      $entity = $this->poll->getItem($criteria,$params);

      //Break if no found item
      if (!$entity) throw new \Exception('Item not found', 204);

      $this->poll->destroy($entity);

      $response = ['data' => 'Item deleted'];

    } catch (\Exception $e) {

      \Log::Error($e);
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    return response()->json($response, $status ?? 200);
    
  }

}
