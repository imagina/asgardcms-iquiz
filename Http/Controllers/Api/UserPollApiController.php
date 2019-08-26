<?php

namespace Modules\Iquiz\Http\Controllers\Api;

// Requests & Response
use Modules\Iquiz\Http\Requests\CreateUserPollRequest;
use Modules\Iquiz\Http\Requests\UpdateUserPollRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Iquiz\Transformers\UserPollTransformer;

// Entities
use Modules\Iquiz\Entities\UserPoll;

// Repositories
use Modules\Iquiz\Repositories\UserPollRepository;

//Support
use Illuminate\Support\Facades\Auth;

class UserPollApiController extends BaseApiController
{

  private $userPoll;
  
  public function __construct(
    UserPollRepository $userPoll
    )
  {
    $this->userPoll = $userPoll;
    
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    try {
      //Request to Repository
      $userPolls = $this->userPoll->getItemsBy($this->getParamsRequest($request));

      //Response
      $response = ['data' => UserPollTransformer::collection($userPolls)];
      
      //If request pagination add meta-page
      $request->page ? $response['meta'] = ['page' => $this->pageTransformer($userPolls)] : false;

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
      $userPoll = $this->userPoll->getItem($criteria,$this->getParamsRequest($request));

      //Break if no found item
      if (!$userPoll) throw new \Exception('Item not found', 204);

      $response = [
        'data' => $userPoll ? new UserPollTransformer($userPoll) : '',
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
      $this->validateRequestApi(new CreateUserPollRequest($data));

      //Create
      $userPoll = $this->userPoll->create($data);

      //Response
      $response = ["data" => new UserPollTransformer($userPoll)];

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
      $this->validateRequestApi(new UpdateUserPollRequest($data));

      $params = $this->getParamsRequest($request);

      // Search entity
      $entity = $this->userPoll->getItem($criteria,$params);

      //Break if no found item
      if (!$entity) throw new \Exception('Item not found', 204);

      $userPoll = $this->userPoll->update($entity,$data);

      $response = ['data' => new UserPollTransformer($userPoll)];

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
      $entity = $this->userPoll->getItem($criteria,$params);

      //Break if no found item
      if (!$entity) throw new \Exception('Item not found', 204);

      $this->userPoll->destroy($entity);

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
