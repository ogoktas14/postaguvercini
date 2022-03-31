<?php

namespace SerefErcelik\PostaGuvercini;

use Illuminate\Support\Facades\Http;

class PostaGuvercini
{
     private $country_code = '0090';

     public function countryCode($country_code = '0090'){
         $this->country_code = $country_code;
         return $this;
     }

     private function addCountryCode($phone){
         if (!$this->country_code){
             $this->country_code = config('postaguvercini.country_code', '0090');
         }
         return $this->country_code . $phone;
     }

     public function sendMessage($to, $message){
        $phone = $this->addCountryCode($to);
        $user = config('postaguvercini.user');
        $password = config('postaguvercini.password');
        $url = "https://y.postaguvercini.com/api_http/sendsms.asp?user=$user&password=$password&gsm=$phone&text=".urlencode(iconv('UTF-8','ISO-8859-9',$message));
        $request = Http::get($url);
        $response = $request->body();
        return $request->body();
     }
     //TODO Response kendi içerisinde ayrılacak.
     public function response($response){
         $response = explode('&', $response);
         $errno = $response[0];
         $errtext = $response[1];
         $errno = explode('=', $errno);
         $errno = $errno[1];
         $errtext = explode('=', $errtext);
         $errtext = $errtext[1];
         return ['errno' => $errno, 'errtext' => $errtext];
     }
}