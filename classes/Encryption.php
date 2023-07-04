<? 
class Mcrpty {
    private static $key = "aaa123bbb456Meveccc";
    public static function _encrypt($data) {
        if(isset($data) && $data != "") {
            try{
                $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
                $encrypted = openssl_encrypt($data, 'aes-256-cbc', self::$key, 0, $iv);
                return base64_encode($encrypted . '::' . $iv);
            } catch (Exception $e) {
                return $data;
            }
        }else{
            return $data;
        }
    }

    public static function _decrypt($data) {
        if(isset($data) && $data != "") {
            try{
                $split = explode('::', base64_decode($data), 2);
                if(sizeof($split) == 2) {
                    list($encrypted_data, $iv) = $split;
                    return openssl_decrypt($encrypted_data, 'aes-256-cbc', self::$key, 0, $iv);
                }
                return $data;
            } catch (Exception $e) {
                return $data;
            }
        }else{
            return $data;
        }
    }
}
?>