<?php

class AES {

    const M_CBC = 'cbc';
    const M_CFB = 'cfb';
    const M_ECB = 'ecb';
    const M_NOFB = 'nofb';
    const M_OFB = 'ofb';
    const M_STREAM = 'stream';

    protected $key = "I0r!.Y@g^m1";
    protected $cipher;
    protected $data;
    protected $mode;
    protected $IV;

    /**
     * @param null $data
     * @param null $blockSize
     * @param null $mode
     */
    function __construct($data = null, $blockSize = null, $mode = null) {
        $this->setData($data);
        $this->setKey($this->key);
        $this->setBlockSize($blockSize);
        $this->setMode($mode);
        $this->setIV("");
    }

    /**
     * @param $data
     */
    public function setData($data) {
        $this->data = $data;
    }


    /**
     * @param $key
     */
    private function setKey($key) {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param $blockSize
     */
    public function setBlockSize($blockSize) {
        switch ($blockSize) {
            case 128:
                $this->cipher = MCRYPT_RIJNDAEL_128;
                break;

            case 192:
                $this->cipher = MCRYPT_RIJNDAEL_192;
                break;

            case 256:
                $this->cipher = MCRYPT_RIJNDAEL_256;
                break;
        }
    }

    /**
     * @param $mode
     */
    public function setMode($mode) {
        switch ($mode) {
            case AES::M_CBC:
                $this->mode = MCRYPT_MODE_CBC;
                break;
            case AES::M_CFB:
                $this->mode = MCRYPT_MODE_CFB;
                break;
            case AES::M_ECB:
                $this->mode = MCRYPT_MODE_ECB;
                break;
            case AES::M_NOFB:
                $this->mode = MCRYPT_MODE_NOFB;
                break;
            case AES::M_OFB:
                $this->mode = MCRYPT_MODE_OFB;
                break;
            case AES::M_STREAM:
                $this->mode = MCRYPT_MODE_STREAM;
                break;
            default:
                $this->mode = MCRYPT_MODE_ECB;
                break;
        }
    }

    /**
     *
     * @return boolean
     */
    public function validateParams() {
        if ($this->data != null &&
            $this->key != null &&
            $this->cipher != null) {
            return true;
        } else {
            return FALSE;
        }
    }

    public function setIV($IV) {
        $this->IV = $IV;
    }

    protected function getIV() {
        if ($this->IV == "") {
            $this->IV = mcrypt_create_iv(mcrypt_get_iv_size($this->cipher, $this->mode), MCRYPT_RAND);
        }
        return $this->IV;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function encrypt() {

        if ($this->validateParams()) {
            return trim(base64_encode(
                mcrypt_encrypt(
                    $this->cipher, $this->key, $this->data, $this->mode, $this->getIV())));
        } else {
            throw new Exception('Invalid params!');
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    public function decrypt() {
        if ($this->validateParams()) {
            return trim(mcrypt_decrypt(
                $this->cipher, $this->key, base64_decode($this->data), $this->mode, $this->getIV()));
        } else {
            throw new Exception('Invalid params!');
        }
    }

}
