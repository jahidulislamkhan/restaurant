<?php

function request_is_post(){
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function testCurl($url = null) {

	$fields = ['orders' => [
                            1 => [
                                    'customer_id' => urlencode(1),
                                    'item_id' => urlencode('12345678'),
                                    'quantity' => urlencode(2),
                                    'unit_price' => urlencode(100),
                                    'recipe' => [1, 2],
                                    'addon' => [1, 3]
                                ],
                            2 => [
                                    'customer_id' => urlencode(1),
                                    'item_id' => urlencode('123456'),
                                    'quantity' => urlencode(1),
                                    'unit_price' => urlencode(500),
                                    'recipe' => [1, 2, 4],
                                    'addon' => [1, 3, 5]
                                ]
                        ]
    ];
    $fields_string = http_build_query($fields);
    // var_dump($fields_string);
    /*$fields_string = '';
    foreach($fields as $key=>$value){ 
        $fields_string .= $key.'='.$value.'&'; 
    }
    $fields_string = rtrim($fields_string, "&");*/

	$ch = curl_init();

    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);

    if($result === false)
    {    
        echo sprintf('<span>%s</span>CURL error:', curl_error($ch));
        return;
    }

    $json_result = json_decode($result, true);
    curl_close($ch);
    // var_dump($result);
    echo json_encode($json_result);

}
function customerRegistrationCurl($url = null) {

    $fields = [
                'email' => urlencode('user2@gmail.com'),
                'password' => urlencode('123456'),
                'mobile_no' => urlencode('123456789'),
                'device_name' => urlencode('SAMSUNG-GT-2900'),
                'imei_no' => urlencode('1234567890')
            ];
    $fields_string = '';
    foreach($fields as $key => $value){ 
        $fields_string .= $key.'='.$value.'&'; 
    }
    $fields_string = rtrim($fields_string, "&");

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);

    if($result === false)
    {    
        echo sprintf('<span>%s</span>CURL error:', curl_error($ch));
        return;
    }

    $json_result = json_decode($result, true);
    curl_close($ch);
    echo json_encode($json_result);
    // echo $result;

}
function customerLogIn($url = null) {

    $fields = [
                'email' => urlencode('mail@mail.com'),
                'password' => urlencode('abcd123'),
            ];
    $fields_string = '';
    foreach($fields as $key => $value){ 
        $fields_string .= $key.'='.$value.'&'; 
    }
    $fields_string = rtrim($fields_string, "&");

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);

    if($result === false)
    {    
        echo sprintf('<span>%s</span>CURL error:', curl_error($ch));
        return;
    }

    $json_result = json_decode($result, true);
    curl_close($ch);
    echo json_encode($json_result);
    // echo $result;

}
