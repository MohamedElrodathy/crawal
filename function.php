<?php


class crawler {


   public static $timeout = 2;


   public static function http_request($url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,            $url);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$timeout);
      curl_setopt($ch, CURLOPT_TIMEOUT,        self::$timeout);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      curl_close($ch);
      return $response;
   }


   public static function strip_whitespace($data) {
      $data = preg_replace('/\s+/', ' ', $data);
      return trim($data);
   }


   public static function extract_elements($tag, $data) {
      $response = array();
      $dom      = new DOMDocument;
      @$dom->loadHTML($data);
      foreach ( $dom->getElementsByTagName($tag) as $index => $element ) {
         $response[$index]['text'] = $element->nodeValue;
         foreach ( $element->attributes as $attribute ) {
            $response[$index]['attributes'][strtolower($attribute->nodeName)] = $attribute->nodeValue;
         }
      }
      return $response;
   }


}
?>