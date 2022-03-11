<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
  * @Postman collection - https://www.getpostman.com/collections/2988072cc864f6e7a8d2
*/

class MemberController extends Controller
{

  /**
    * @api {get} http://localhost:8000/api/members ( using php -S localhost:8000 -t public )
    * @apiSampleWebRequest https://localhost/laravel/fitpass/public/api/members ( /laravel/fitpass/ is folders name on local machine )
    * @apiName Get All members
    * @return json
  */
  public function index()
  {
      $members = Member::all();
      if(count($members) == 0){
          return response()->json([ 'status' => 'OK','data' => array('msg' => "Member list is empty !")], 200);
      }else{
          return response()->json([ 'status' => 'OK','data' => $members], 200);
      }
  }



  /**
    * @api {post} http://localhost:8000/api/reception( Postman - body form )
    * @apiName Add member
    * @return json
  */
  public function create(Request $request)
  {
      $member = Member::where(['id_card_number' => $request->id_card_number])->first();
      if ($member === null){   
          $member = new Member();
          $member->first_name = $request->first_name;
          $member->last_name = $request->last_name;
          $member->id_card_number = $request->id_card_number;
          $member->object_name = $request->object_name;
          $member->last_login_at = '';
          $member->save();
          return response()->json(['status' => 'success','data' => $member], 200);
      }else{
          return response()->json(['status' => 'Error', 'data' => array('msg' => "I'm sorry, the member already have id card with this number: ".$request->id_card_number)], 500);
      }
  }


  /**
    * @api {get} http://localhost:8000/api/reception/{card_id}/{object_name} ( Postman )
    * @apiName Get Member by Card ID and Object
    * @return json
  */
  public function show($card_id, $object_name)
  {
      $member = Member::where(['id_card_number' => $card_id, 'object_name' => $object_name])->first();
      if ($member === null){
          return response()->json(['status' => 'Error', 'data' => array('msg' => "I'm sorry, member does not exist in the database")], 404);
      }else{      
          // get from and throung date
          $from_date = Carbon::parse(date('Y-m-d', strtotime($member->last_login_at))); 
          $through_date = Carbon::parse(date('Y-m-d', strtotime(Carbon::now()->toDateTimeString()))); 
              
          // get total number of minutes between from and throung date
          $difference = $from_date->diffInDays($through_date);

          if($difference == 0){
              return response()->json(['status' => 'Error','data' => array('msg' => "I'm sorry, the member can use sports facilities only once a day")], 401);
          }else{
              $member->update(['last_login_at' => Carbon::now()->toDateTimeString()]);
              $log = new Log();
              $log->member_id = $member->id;
              $log->object_name = $object_name;
              $log->entry_time = Carbon::now()->toDateTimeString();
              $log->save();
              return response()->json([
                  'status' => 'OK',
                  'object_name' => $object_name,
                  'first_name' => $member->first_name,
                  'last_name' => $member->last_name,
                ], 200);  
          }
      }
  }

  /**
    * @api {put} http://localhost:8000/api/reception/{id} ( Postman - body form )
    * @apiName Edit member
    * @return json
  */
  public function update(Request $request, $id)
  {
      $member = Member::find($id);
      if ($member === null){
          return response()->json(['status' => 'Error', 'data' => array('msg' => "I'm sorry, member does not exist in the database")], 404);
      }else{      
          $member->first_name = $request->first_name;
          $member->last_name = $request->last_name;
          $member->id_card_number = $request->id_card_number;
          $member->object_name = $request->object_name;
          $member->save();
          return response()->json($member);
      }
  }



  /**
    * @api {get} http://localhost:8000/api/reception/logs/{card_id} ( Postman )
    * @apiName Get Member Logs by Card ID
    * @return json
  */
  public function logs($card_id)
  {
      $member = Member::where(['id_card_number' => $card_id])->first();     
      if ($member === null){
          return response()->json(['status' => 'Error', 'data' => array('msg' => "I'm sorry, member does not exist in the database")], 404);
      }else{  
          $log = Log::where(['member_id' => $member->id])->get();
          return (count($log) > 0) ? response()->json(['status' => 'OK','data' => $log], 200) 
                                   : response()->json(['status' => 'OK','data' => array('msg' => "I'm sorry, member logs not exist in the database")], 404);
      }
  }


  /**
    * @api {delete} http://localhost:8000/api/reception/{card_id} ( Postman )
    * @apiName Delete member
    * @return json
  */
  public function destroy($id)
  {
    $member = Member::find($id);
    if ($member === null){  
        return response()->json(['status' => 'Error','data' => array('msg' => "I'm sorry, member does not exist in the database")], 404);
    }else{
      $member->delete();
      return response()->json(['status' => 'OK','data' => array('msg' =>'member removed successfully')], 200);
    }
  }
}