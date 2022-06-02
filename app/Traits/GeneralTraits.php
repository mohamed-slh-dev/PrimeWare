<?php

namespace App\Traits;

trait GeneralTraits{

    public function returnError($msg){

        return response()->json([
            'status'=> 'false',
            'msg'=>$msg
        ]);

    }

    public function returnSuccess($msg = ''){

        return response()->json([
            'status'=> 'true',
            'msg'=>$msg
        ]);

    }

    public function returnData($key , $value , $msg = ''){

        return response()->json([
            'status'=> 'true',
            'msg'=>$msg,
            $key => $value
        ]);

    }


}