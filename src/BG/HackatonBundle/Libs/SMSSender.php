<?php
/**
 * Created by PhpStorm.
 * User: bguevara
 * Date: 3/29/14
 * Time: 6:33 PM
 */

namespace BG\HackatonBundle\Libs;


class SMSSender {
    private $message;
    private $dest_address;

    const USER = "sms-user";
    const PASS = "sms-pass";
    const PORT = "13131";

    public function __construct($message, $number){
        $this->message = $message;
        $this->dest_address = $number;
    }

    public function sendMessage(){
        $message = urlencode($this->message);
        // Send response SMS message to Kannel
        $url = "http://localhost:".self::PORT."/cgi-bin/sendsms?username=".self::USER."&password=".self::PASS."&to={$this->dest_address}&text={$message}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        /*
        $response = trim($response);
        if ( strpos($response, "OK") != 0 )
            return false;
        */
        return true;
    }
} 