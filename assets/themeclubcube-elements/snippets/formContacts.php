<?php

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

$properties['fields'] = !empty($properties['fields']) ? explode(',',$properties['fields']) : array('name','email','message');
$properties['validate'] = !empty($properties['validate']) ? explode(',',$properties['validate']) : array('name','email','message');
$properties['emailTo'] = !empty($properties['emailTo']) ? $properties['emailTo'] : $modx->getOption('emailsender');;
$properties['subject'] = !empty($properties['subject']) ? $properties['subject'] : 'Contact Form';
$properties['tpl'] = !empty($properties['tpl']) ? $properties['tpl'] : 'emailContacts';

$fields = array();
foreach($properties['fields'] as $fieldName) {
    $fields[$fieldName] = isset($_POST[$fieldName]) ? $_POST[$fieldName] : null;
}

$errors = array();
$errorCheck = false;
foreach($properties['validate'] as $fieldValidate){
    if($fieldValidate == 'email' && isset($fields[$fieldValidate]) && !empty($fields[$fieldValidate])) {
        $errors[$fieldValidate] = validateEmail($fields[$fieldValidate]);
        if($errors[$fieldValidate]) $errorCheck = true;
    }
    if(!$fields[$fieldValidate]) {
        $errors[$fieldValidate] = true;
        $errorCheck = true;
    }
}

$output = array('success'=>true);

if($errorCheck) {
    $output = array(
        'success'   =>  false,
        'errors'    =>  $errors
    );
} else {

    if(!is_null($properties['emailTo'])) {
        $message = $modx->getChunk($properties['tpl'], $fields);

        $modx->getService('mail', 'mail.modPHPMailer');
        $modx->mail->set(modMail::MAIL_BODY,$message);
        $modx->mail->set(modMail::MAIL_FROM,$modx->getOption('emailsender'));
        $modx->mail->set(modMail::MAIL_FROM_NAME,$modx->getOption('site_name'));
        $modx->mail->set(modMail::MAIL_SENDER,$modx->getOption('site_name'));
        $modx->mail->set(modMail::MAIL_SUBJECT,$properties['subject']);
        $modx->mail->address('to',$properties['emailTo']);
        $modx->mail->setHTML(true);
        if (!$modx->mail->send()) {
            $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to send the email: '.$err);
        }
        $modx->mail->reset();
    }
}

return json_encode($output);