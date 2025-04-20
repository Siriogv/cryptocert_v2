<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class QRCode {

  public static $_ENCODING_UTF8 = "UTF-8";
  public static $_ENCODING_Shift_JIS = "Shift_JIS";
  public static $_ENCODING_ISO_8859_1 = "ISO-8859-1";

  public static $_OUTPUT_FORMAT_PNG = "png";
  public static $_OUTPUT_FORMAT_GIF = "gif";

  private $baseUrl = "http://chart.apis.google.com/chart";
  private $width=250;
  private $height=250;
  private $map = array();

  function __construct() {
    $this->map['cht']="qr";
    $this->map['chs']=$this->width."x".$this->height;
    $this->map['chof'] = QRCode::$_OUTPUT_FORMAT_PNG;
  }

  public function setOutputEncoding($type) { $this->map['choe'] = $type; }
  public function setOutputFormat($type) { $this->map['chof'] = $type; }
  public function getOuputFormat() { return $this->map['chof']; }
  public function setData($data) { $this->map['chl'] = urlencode($data);}
  public function setImageSize($width, $height) { $this->map['chs'] = $width."x".$height; }
  public function setMargin($margin) { $this->map['chld'] = $margin; }
  public function getMap() { return $this->map; }

  public function setErrorCorrectionLevel($errorCorrectionLevel) {
        $this->map['chld'] = $errorCorrectionLevel;
  }

  public function getUrlQuery() {
    return $this->baseUrl."?".$this->getQuery();
  }

  public function getQuery() {
    $query = "";
    $keys = array_keys($this->map);
    $i = 0;
    $length = count($this->map);
    foreach($keys as $key) {
      $query .= $key."=".$this->map[$key];
      $i++;
      if($i<$length) $query.="&";
    }
    return $query;
  }

  public function getContentsForGet() {
    return file_get_contents($this->baseUrl."?".$this->getQuery());
  }

  public function getContentsForPost() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->baseUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("accept: image/png"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$this->getQuery());
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    if($info['http_code'] == 200) {
      return $output;
    }
    return $info['http_code'];
  }
}

?>