<?php

class NoticeHelper
{
    public static function sendAlert($message)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://tonggao.baidu.com/event/create");
        curl_setopt($ch, CURLOPT_POST, 1);
        $service_id = constant("BELLRINGER_SERVICE_ID");
        $service_key = constant("BELLRINGER_SERVICE_KEY");
        $post_field="{\"service_id\":$service_id,\"description\":\"$message\",\"event_type\":\"trigger\"}";
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $header[] = "servicekey:$service_key";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
