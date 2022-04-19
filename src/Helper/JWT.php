<?php

namespace Ideris\Helper;

class JWT
{
    public static function verifyExpired($token): bool
    {
        $bodyEncoded = explode('.', $token)[1] ?? '';
        $bodyEncoded = json_decode(base64_decode($bodyEncoded));
        if (!$bodyEncoded || !is_object($bodyEncoded))
            return true;

        $expireTimestamp = $bodyEncoded->exp;

        $curDateTime = date("Y-m-d H:i:s");
        $dateCheck = date("Y-m-d H:i:s", $expireTimestamp - 60);//menos 1 minuto

        return $dateCheck < $curDateTime;
    }
}