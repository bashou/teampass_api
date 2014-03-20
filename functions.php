<?php

function teampass_pbkdf2_hash($p, $s, $c, $kl, $st = 0, $a = 'sha256')
{
    $kb = $st + $kl;
    $dk = '';

    for ($block = 1; $block <= $kb; $block++) {
        $ib = $h = hash_hmac($a, $s . pack('N', $block), $p, true);
        for ($i = 1; $i < $c; $i++) {
            $ib ^= ($h = hash_hmac($a, $h, $p, true));
        }
        $dk .= $ib;
    }

    return substr($dk, $st, $kl);
}

function teampass_decrypt_pw($encrypted, $salt, $rand_key, $itcount = 2072)
{

	# example parameters:
	#   $encoded  = 'K2QwSkV0U2ZtNjRRUUE3Sk5jY0poWWtNbTQ0aUhydmZsZEdpeGJPVWxlWTLGNAPoPi13x0BAkLcm4tCnG3xb9Aer+iuxUGQ5N2MxZWFmM2NmZjIxMjlhMjE5NjE1ZTY4ZmQzZTFiNDZlMzZkMjZmOGNlMTg3ZjZjM2YzYjQ0YTNhYzUyYWZrdHVzMTA3c3c1d2M4cDE5bWNiczd1cHlwbmk5em5hN2JuY3A1bjM2bTl1czkzY2FvZG90emxyajV4Z3o4NHkx';
	#   $password = 'MTMFQe$&e3Zb';
	#   $salt     = 'SpTxzu6h6c5ZSX6WSpTxzu6h6c5ZSX6W';
	#   $rand_key = 'b8e01b8c9f32ab8';

	$decoded = teampass_decrypt_pw($encoded, $salt, $rand_key);


    $encrypted = base64_decode($encrypted);
    $pass_salt = substr($encrypted, -64);
    $encrypted = substr($encrypted, 0, -64);
    $key       = teampass_pbkdf2_hash($salt, $pass_salt, $itcount, 16, 32);
    $iv        = base64_decode(substr($encrypted, 0, 43) . '==');
    $encrypted = substr($encrypted, 43);
    $mac       = substr($encrypted, -64);
    $encrypted = substr($encrypted, 0, -64);
    if ($mac !== hash_hmac('sha256', $encrypted, $salt)) return null;
    return substr(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $encrypted, 'ctr', $iv), "\0\4"), strlen($rand_key));
}

function rest_get ($request) {
	var_dump($request);
}

?>