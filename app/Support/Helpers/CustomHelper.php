<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 6/1/2017
 * Time: 10:44 PM
 */

use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

if (!function_exists('api_route')) {
    /**
     * Dingo\Api\Routing\Router
     * @param $api
     * @return \Dingo\Api\Routing\Router
     */
    function api_route($name, array $params = [])
    {
        return app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route($name, $params);
    }
}

if (!function_exists('success')) {
    function success($data = ['success' => true])
    {
        return [
            'code' => SUCCESS,
            'message' => 'success',
            'data' => $data
        ];
    }
}

if (!function_exists('error')) {
    function error($message, $code = PARAMS_ILLEGAL, $data = null)
    {
        _log($message, $code, \Request::all());
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}

if (!function_exists('qr_code')) {
    /**
     * @param $t
     * @param int $s
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function qr_code($t, $s = 150)
    {
        return response(QrCode::format('png')->encoding('UTF-8')->size($s)->generate($t), 200, ['Content-Type' => 'image/png']);
    }
}

if (!function_exists('_log')) {
    /**
     * @param $var
     */
    function _log()
    {
        $vars = func_get_args();
        Log::info(\Request::get('equ', '未知设备') . '使用' . \Request::getMethod() . '方法请求' . \Request::path());
        Log::info('请求头 -  Authorization：' . \Request::header(AUTH_HEADER));
        Log::info(Session::all());
        foreach ($vars as $var) {
            Log::info($var);
        }
    }
}

if (!function_exists('validate')) {
    function validate(array $data, array $roles, array $messages = [], array $customAttributes = [])
    {
        $v = Validator::make($data, $roles, $messages, $customAttributes);
        if ($v->fails()) {
            _log($v->messages());
            Log::info(\Request::all());
            throw new \App\Exceptions\ValidateLogException($v->messages());
        }
    }
}

if (!function_exists('generate_auth_code')) {
    /**
     * 生成验证码和消息
     * @param $message
     * @return object
     */
    function generate_auth_code()
    {
        $authCode = rand(100000, 999999);

        return $authCode;
    }
}

if (!function_exists('send_auth_code')) {
    function send_auth_code($nation, $phone, $admin = false)
    {
        $code = generate_auth_code();
        $params = array($code, 1);

        if ($admin == true)
            $resp =  send_sms_admin($phone, $params);
        else
            $resp =  send_sms($nation, $phone, $params);

        if ($resp->result != 0)
            return false;
        else
            return $code;
//        return $message->authCode;
    }
}

if (!function_exists('send_sms')) {
    function send_sms($code, $phone, $params)
    {
        $sender = new SmsSender(config('sms.appid'), config('sms.appkey'));
        $tpl = config('sms.chinese.au_tpl');
        $appId = getAppIdFromHeader();
        if ($code = '86') {
            switch ($appId) {
                case '1':
                    $tpl = config('sms.chinese.au_tpl');
                    break;
                case '2':
                    $tpl = config('sms.chinese.sa_tpl');
                    break;
                case '3':
                    $tpl = config('sms.chinese.us_tpl');
                    break;
                case 4:
                    $tpl = config('sms.chinese.uk_tpl');
            }
        } else {
            switch ($appId) {
                case '1':
                    $tpl = config('sms.foreign.au_tpl');
                    break;
                case '2':
                    $tpl = config('sms.foreign.sa_tpl');
                    break;
                case '3':
                    $tpl = config('sms.foreign.us_tpl');
                    break;
                case 4:
                    $tpl = config('sms.foreign.uk_tpl');
            }
        }

        $result = $sender->sendWithParam($code, $phone, $tpl, $params, config('sms.sign'), "");

        $resp = json_decode($result);

//        if ($resp->result != 0) {
//            throw new \App\Exceptions\SmsException('发送短信失败。');
//        }

        return $resp;
    }
}

if (!function_exists('send_sms_admin')) {
    function send_sms_admin($phone, $params)
    {
        $sender = new SmsSender(config('sms.appid'), config('sms.appkey'));
        $tpl = config('sms.chinese.au_tpl');
        $code = '86';

        $result = $sender->sendWithParam($code, $phone, $tpl, $params, config('sms.sign'), "");

        $resp = json_decode($result);

//        if ($resp->result != 0) {
//            throw new \App\Exceptions\SmsException('发送短信失败。');
//        }

        return $resp;
    }
}

if (!function_exists('get_jwt_token')) {
    /**
     * @return null|string
     */
    function get_jwt_token()
    {
        $token = \Request::header(AUTH_HEADER);
        if (is_null($token)) {
            return null;
        }
        $token = str_replace('Bearer ', '', $token);
        if ($token == 'Bearer') {
            return null;
        }
        return $token;
    }
}

if (!function_exists('jwt_to_user')) {
    /**
     * @param $token
     * @return User|null
     */
    function jwt_to_user($token)
    {
        $self = AuthToken::find($token);
        if ($self instanceof User) {
            \Auth::login($self);
            return $self;
        }
        return null;
    }
}

if (!function_exists('user')) {
    /**
     * @return User|null
     */
    function user(Request $request = null)
    {
        $self = Auth::user();
        if (is_null($self)) {
            $token = get_jwt_token();
            return jwt_to_user($token);
        }
        return $self;

    }
}

if (!function_exists('admin')) {
    /**
     * @return User|null
     */
    function admin(Request $request = null)
    {
        $id = auth()->guard('admin')->id();

        $admin = Admin::find($id);

        return $admin;
    }
}

if (!function_exists('jwt_login')) {
    /**
     * @param User|array $cred
     * @param string $errMsg
     * @return array
     */
    function jwt_login($cred, $errMsg = '登录失败，请检查手机和验证码。')
    {
        if ($cred instanceof User) {
            Auth::login($cred);
        }
        if ($cred instanceof User or Auth::attempt($cred)) {
            $user = Auth::user();
            if ($cred instanceof User) {
                $user = $cred;
            }
            $userInfo = user_info($user);
            $token = AuthToken::login($user);
            return success([
                'user' => $userInfo,
                'authToken' => $token,
            ]);
        } else {
            return error($errMsg, LOGIN_ERROR);
        }
    }
}

if (!function_exists('jwt_refresh_token')) {
    function jwt_refresh_token()
    {
        $token = Session::get(JWT_AUTH_TOKEN);
        if (is_null($token)) {
            $token = JWTAuth::getToken();
        }
        return $token;
    }
}

if (!function_exists('jwt_user')) {
    function jwt_user($user = null)
    {
        if (is_null($user)) {
            $user = user();
        }
        $authToken = get_jwt_token();
        if (is_null($authToken) and $user instanceof User) {
            $authToken = AuthToken::login($user);
        }
        if (is_null($user)) {
            return null;
        } else {
            $userInfo = user_info($user);
            return [
                'user' => $userInfo,
                'authToken' => $authToken,
            ];
        }
    }
}

if (!function_exists('user_avatar')) {
    function user_avatar($filename)
    {
        if (str_contains($filename, '://')) {
            return $filename;
        } else if (is_null($filename) || $filename == '') {
            return asset(DEFAULT_IMAGE);
        } else {
            return asset(config('image.avatar_path') . '/' . $filename);
        }
    }
}

if (!function_exists('image_url')) {
    function image_url($filename)
    {
        if (str_contains($filename, '://')) {
            return $filename;
        } else if (is_null($filename) || $filename == '') {
            return asset(DEFAULT_IMAGE);
        } else {
            return asset(config('image.image_path') . '/' . $filename);
        }
    }
}

if (!function_exists('origin_url')) {
    function origin_url($filename)
    {
        if (str_contains($filename, '://')) {
            return $filename;
        } else if (is_null($filename) || $filename == '') {
            return asset(DEFAULT_IMAGE);
        } else {
            return asset(config('image.origin_path') . '/' . $filename);
        }
    }
}

if (!function_exists('treasure_image')) {
    function treasure_image($filename)
    {
        if (str_contains($filename, '://')) {
            return $filename;
        } else if (is_null($filename) || $filename == '') {
            return asset(DEFAULT_IMAGE);
        } else {
            return asset(config('image.treasure_path') . '/' . $filename);
        }
    }
}

if (!function_exists('bag_image')) {
    function bag_image($filename)
    {
        if (str_contains($filename, '://')) {
            return $filename;
        } else if (is_null($filename) || $filename == '') {
            return asset(DEFAULT_IMAGE);
        } else {
            return asset(config('image.bag_path') . '/' . $filename);
        }
    }
}

if (!function_exists('handle_extension')) {
    /**
     * 处理图片后缀
     * @param $extension
     * @return string
     */
    function handle_extension($extension)
    {
        if (in_array($extension, ['png', 'gif', 'jpg', 'jpeg'])) {
            return '.' . $extension;
        } else {
            return '.png';
        }
    }
}

if (!function_exists('save_file_as')) {
    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param $path
     * @param $filename
     * @return bool|mixed|string
     */
    function save_file_as($file, $path, $filename)
    {
        if ($file instanceof \Illuminate\Http\UploadedFile) {
            return $file->storeAs($path, $filename, 'local');
        } else {
            return Storage::disk('local')->put($path . '/' . $filename, transform_base64($file));
        }
    }
}

if (!function_exists('transform_base64')) {
    /**
     * @param $base64
     * @param bool $isAndroid
     * @return string
     * @throws \Exception
     */
    function transform_base64($base64)
    {
        if (\Request::get('equ', 'web') != 'web') {
            return base64_decode($base64);
        } else {
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)) {
                return base64_decode(str_replace($result[1], '', $base64));
            }
            throw new \Exception('base64转换文件流失败。请检查base64是否正确。');
        }
    }
}

if (!function_exists('getAppIdFromHeader')) {
    function getAppIdFromHeader()
    {
        $appid = \Request::header(APPID);
        if (!is_null($appid))
            return $appid;
        else
            throw new \Exception('没有找到App。');
    }
}

if (!function_exists('getAppId')) {
    function getAppId()
    {
        if (\Request::session()->has('appid'))
            return \Request::session()->get('appid');
        else
            throw new \Exception('没有找到App。');
    }
}

if (!function_exists('dateDiff')) {
    /**
     * @param $base64
     * @param bool $isAndroid
     * @return string
     * @throws \Exception
     */
    function dateDiff($start, $end)
    {
        $start_ts = strtotime($start);

        $end_ts = strtotime($end);

        $diff = $end_ts - $start_ts;

        return round($diff / 86400);
    }
}

if (!function_exists('juhecurl')) {
    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
}

