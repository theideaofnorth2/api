<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require 'multiRequest.php';

  $urls = array(
    'https://theideaofnorth2.com/wordpress/wp-json/acf/v3/origins?per_page=1000',
    'https://theideaofnorth2.com/wordpress/wp-json/acf/v3/destinations?per_page=1000',
    'https://theideaofnorth2.com/wordpress/wp-json/acf/v3/eggs?per_page=1000',
    'https://theideaofnorth2.com/wordpress/wp-json/acf/v3/interviews?per_page=1000',
    'https://theideaofnorth2.com/wordpress/wp-json/acf/v3/sheets?per_page=1000',
    'https://theideaofnorth2.com/wordpress/wp-json/acf/v3/guides?per_page=1000',
  );

  $requests = multiRequest($urls);
  
  function acfToParent($n)
  {
    $item = $n["acf"];
    $item["_id"] = $n["id"];
    if (array_key_exists("origin", $item)) {
      $item["originId"] = $item["origin"];
      unset($item["origin"]);
    }
    if (array_key_exists("destination", $item)) {
      $item["destinationId"] = $item["destination"];
      unset($item["destination"]);
    }
    if (array_key_exists("egg", $item)) {
      $item["eggId"] = $item["egg"];
      unset($item["egg"]);
    }
    if (array_key_exists("native_name", $item)) {
      $item["nativeName"] = $item["native_name"];
      unset($item["native_name"]);
    }
    if (array_key_exists("interview", $item)) {
      $item["interviewId"] = $item["interview"];
      unset($item["interview"]);
    }
    if (array_key_exists("zoom", $item)) {
      $item["zoom"] = (int)$item["zoom"];
    }
    if (array_key_exists("top", $item)) {
      $item["top"] = (int)$item["top"];
    }
    if (array_key_exists("left", $item)) {
      $item["left"] = (int)$item["left"];
    }
    if (array_key_exists("en", $item)) {
      $item["en"] = htmlentities($item["en"]);
    }
    if (array_key_exists("fr", $item)) {
      $item["fr"] = htmlentities($item["fr"]);
    }
    if (array_key_exists("location", $item)) {
      if (is_array($item["location"]) && array_key_exists("lat", $item["location"])) {
        $item["lat"] = floatval($item["location"]["lat"]);
      }
      if (is_array($item["location"]) && array_key_exists("lng", $item["location"])) {
        $item["lng"] = floatval($item["location"]["lng"]);
      }
      unset($item["location"]);
    }
    return($item);
  }

  function convertAcf($item)
  {
    if (array_key_exists("origin", $item)) {
      $item["originId"] = $item["origin"];
      unset($item["origin"]);
    }
    if (array_key_exists("destination", $item)) {
      $item["destinationId"] = $item["destination"];
      unset($item["destination"]);
    }
    if (array_key_exists("egg", $item)) {
      $item["eggId"] = $item["egg"];
      unset($item["egg"]);
    }
    if (array_key_exists("interview", $item)) {
      $item["interviewId"] = $item["interview"];
      unset($item["interview"]);
    }
    return($item);
  }
  
  $data = [
    'origins' => array_map("acfToParent", json_decode($requests[0], true)),
    'destinations' => array_map("acfToParent", json_decode($requests[1], true)),
    'eggs' => array_map("acfToParent", json_decode($requests[2], true)),
    'interviews' => array_map("acfToParent", json_decode($requests[3], true)),
    'pages' => array_map("acfToParent", json_decode($requests[4], true)),
    'guides' => array_map("convertAcf", array_values(json_decode($requests[5], true))[0]["acf"]["guides"]),
    'slides' => [],
  ];
  header('Access-Control-Allow-Origin: *');
  echo json_encode($data);


?>