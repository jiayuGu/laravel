<?php

namespace App\Http\Controllers\Login;

 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\DB;

 class AdminLoginController extends Controller
{
    /**
     * 登录
     */
    public function login(Request $request)
   {
       $db = DB::table('admin');
       $data = $db->get();
       $account_DB = $request->input('account');
       $password_DB = $request->input('password');
       $res = [$account_DB,$password_DB];
       foreach ($data as $key=>$value){
           if( $value->account == $account_DB )
           {
               if($value->password == $password_DB)
                   return $res?
                       json_success('登录成功',$res,200):
                       json_fail('登录失败',null,100);
           }
       }
       return 0?
           json_success('登录成功',$res,200):
           json_fail('登录失败',null,100);
   }
    /**
     * 注册
     */
    public static function register(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');
        $db = DB::table('admin');
        $data = $db->get();
        foreach ($data as $key=>$value){
            if( $value->account == $account )
            {
                return 0?
                    json_success('注册成功',200):
                    json_fail('注册失败',null,100);
            }
        }$result = $db->insert(
            [
                'account' => $account,
                'password'=> $password
            ]
        );
        return $result?
            json_success('注册成功',$result,200):
            json_fail('注册失败',null,100);
    }
}





