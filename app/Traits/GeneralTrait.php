<?php
namespace  App\Traits;

use App\Classes\Responseobject;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

trait GeneralTrait {
    public function lang($lang)
    {
        if (in_array($lang, ['ar', 'en']) ) {
            default_lang($lang);
        } else {
            default_lang();
        }
    }
    public function failed($validator)
    {
        $response   = new Responseobject();
        $response->status = $response::status_failed;
        $response->code = $response::code_failed;
        foreach ($validator->errors()->getMessages() as $item) {
            array_push($response->msg, $item);
        }

        return Response::json(
            $response
        );
    }
    public function returnError($msg){
        return response()->json([
            'status'=>false,
            "msg"=>$msg
        ]);
    }
    public function errorField($field){
        $massage = __($field.' required');
        return response()->json([
            "msg" => $massage,
            "status" => false
        ]);
    }
    public function errorMessage($massage){
        return response()->json([
            "msg" => __($massage),
            "status" => false
        ]);
    }
    public function SuccessMessage($massage){
        return response()->json([
            "msg" => __($massage),
            "status" => true
        ]);
    }
    public function returnSuccess($msg=""){
        return response()->json([
            'status'=>true,
            "msg"=>$msg
        ]);
    }
    public function returnData($key,$value,$msg="",array $extra=[]){
        $data = [
            $key=>$value
        ];
        if (!empty($extra)) {
            foreach ($extra as $key => $value) {
                $data[$key] = $value;
            }
        }
        $data['status'] = true;
        $data['msg'] = $msg;
        return response()->json($data);
    }
    public function returnFailData($key,$value,$msg="",array $extra=[]){
        $data = [
            $key=>$value,
            'status'=>false,
            "msg"=>$msg
        ];
        if (!empty($extra)) {
            foreach ($extra as $key => $value) {
                $data[$key] = $value;
            }
        }
        return response()->json($data);
    }
    public function ValidatorMessages($messages){
        $data = [
            'status'=>false,
            "msg"=>'validation failed'
        ];
        if (!empty($messages)) {
            $data["msg"] = array_values($messages)[0][0];
        }
        return response()->json($data);
    }
    public function remoteFileExists($url) {
        $curl = curl_init($url);
        //don't fetch the actual page, you only want to check the connection is ok
        curl_setopt($curl, CURLOPT_NOBODY, true);
        //do request
        $result = curl_exec($curl);

        $ret = false;

        //if request did not fail
        if ($result !== false) {
            //if request was ok, check response code
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($statusCode == 200) {
                $ret = true;
            }
        }
        curl_close($curl);

        return $ret;
    }

    public function checkImage($file)
    {

        if (strpos($file, 'http') === false and strpos($file, 'https') === false) {
            return false;
        }
        /*
        if (false === file_get_contents($file,0,null,0,1)) {
            dd(1);
        }
        dd(2);*/
        return true;
    }

    public function returnValidationError($validator){
        return $this->returnError($validator->errors()->first());
    }

    public function Validator($request, $rules, $niceNames = [])
    {
        $this->lang($request->lang);
        return Validator::make($request->all(), $rules, [], $niceNames);
    }

}
