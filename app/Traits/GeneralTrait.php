<?php
namespace  App\Traits;
trait GeneralTrait {
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
            $key=>$value,
            'status'=>true,
            "msg"=>$msg
        ];
        if (!empty($extra)) {
            foreach ($extra as $key => $value) {
                $data[$key] = $value;
            }
        }
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
            foreach ($messages as $key => $value) {
                $data[$key] = $value;
            }
        }
        return response()->json($data);
    }



    public function returnValidationError($validator){
        return $this->returnError($validator->errors()->first());
    }

}
