<?php
/**
 * Description of uniApi
 *
 * @author ors
 */
class uniApi {

    public $api_key;
    public $lang = 'ru';
    private $langlist = array('ru');

    /**
     * Создаем объект с разрешенными языками
     * @param string $key ключ доступа к API
     * @param string $lang язык сообщений сервера API, в данный момент поддерживается ru, en, it
     */
    public function __construct($api_key, $lang = 'ru') {
        $this->api_key = $api_key;
        if (in_array($lang, $this->langlist))
            $this->lang = $lang; 
    } 

    /**
     * Отправка запросов и обработка ошибок
     * @param string $method название метода
     * @param array $args аргументы метода, свои для каждого метода
     */
    private function uniRequest($method, $args) {
        $post_array = array_merge(array(
            'api_key' => $this->api_key,
            'lang' => $this->lang,
        ),$args);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_URL,
                'http://api.unisender.com/ru/api/'.$method.'?format=json');
        $result = curl_exec($ch);

        if ($result) {
            // Раскодируем ответ API-сервера
            $jsonObj = json_decode($result);

            if (null === $jsonObj) {
                // Ошибка в полученном ответе
                echo "Invalid JSON";
            } elseif (!empty($jsonObj->error)) {
                // Ошибка добавления пользователя
                echo "An error occured: " . $jsonObj->error . "(code: " . $jsonObj->code . ")";
            }
        } else {
            // Ошибка соединения с API-сервером
            echo "API access error";
        }
        return $jsonObj->result;
    }
    /**
    * Этот метод добавляет контакты (e-mail адрес и/или мобильный телефон) подписчика в один или несколько списков, а также позволяет добавить/поменять значения дополнительных полей и меток.
    * @param <type> $email
    * @param <type> $list Перечисленные через запятую коды списков, в которые надо добавить подписчика.
    * @param <type> $phone В случае наличия и e-mail, и телефона, подписчик будет включён и в e-mail, и в SMS списки рассылки.
    * @param <type> $ip IP-адрес подписчика
    * @param <type> $first_name
    * @param <type> $last_name 
    */
    public function subscribe($email, $list, $phone=NULL, $ip=NULL, $first_name=NULL, $last_name=NULL) {
        $args = array (
          'list_ids' => $list,
          'fields[email]' => $email,
          'fields[Name]' => $first_name.' '.$last_name,
          'request_ip' => $ip,
          'overwrite' => 2,
          'double_optin' => 1
        );
        if ($phone)
            $args['fields[phone]']=$phone;
        $result=$this->uniRequest('subscribe', $args);
        if ($result=='too_many_double_optins'){
            $args['double_optin']=0;
            $result=$this->uniRequest('subscribe', $args);
        }
//        return $result;
    }
}

function validateEmail($email){
    $pattern = "/^[^@]{1,64}\@[^\@]{1,255}$/";
    $condition = @preg_match($pattern, $email);
    if (!$condition) {
        return true;
    }

    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
        $pattern = "/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/";
        $condition = @preg_match($pattern,$local_array[$i]);
        if (!$condition) {
            return true;
        }
    }

    $pattern = "^\[?[0-9\.]+\]?$";
    $condition = @preg_match($pattern, $email_array[1]);
    if (!$condition) {
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
            return true;
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            $pattern = "/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/";
            $condition = @preg_match($pattern,$domain_array[$i]);
            if (!$condition) {
                return true;
            }
        }
    }
    return false;
}

$properties =& $scriptProperties;

$properties['email'] = isset($_POST['email']) ? $_POST['email'] : null;

$errors = array(
    'email' => false
);

/* email */
$errors['email'] = validateEmail($properties['email']);
/* end email */

$output = array('success'=>true);

$errorCheck = false;
$errorOutput = array();
foreach ($errors as $name => $error) {
    if($error) {
        $errorCheck = true;
        $errorOutput[$name] = true;
    }
}

if($errorCheck) {
    $output = array(
        'success'   =>  false,
        'errors'    =>  $errorOutput
    );
} else {
    $uni = new uniApi($modx->getOption('unisender_api_key'));

    $uni->subscribe($properties['email'], $modx->getOption('unisender_list_ids'));
}

return json_encode($output);