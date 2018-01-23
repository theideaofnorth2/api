<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $client = \Directus\SDK\ClientFactory::create($config);

  function accessProtected($obj, $prop) {
    $reflection = new ReflectionClass($obj);
    $property = $reflection->getProperty($prop);
    $property->setAccessible(true);
    return $property->getValue($obj);
  }


  $params = [
    'limit' => 2000,
  ];

  /*
    Origins
  */

  function GetOrigins($client) {
    $params = [
      'limit' => 2000,
    ];
    $items = $client->getItems('origins', $params);
    $returns = [];
    foreach($items as $item) {
      $splitLocation = explode(",", $item->location);
      $myItem = (object) [
        '_id' => $item->id,
        'name' => $item->name,
        'nativeName' => $item->native_name,
        'vertical' => $item->vertical,
        'horizontal' => $item->horizontal,
        'zoom' => intval($item->zoom),
        'image'=> null,
        'lat' => floatval($splitLocation[0]),
        'lng' => floatval($splitLocation[1]),
        'zoomer_4' => null,
        'zoomer_6' => null,
        'zoomer_8' => null,
        'zoomer_10' => null,
        'zoomer_12' => null,
        'zoomer_13' => null,
        'zoomer_14' => null,
      ];
      if (!is_null($item->image)) {
        $myItem->image = accessProtected($item->image, 'data')['url'];
      };
      if (!is_null($item->zoomer_4)) {
        $myItem->zoomer_4 = accessProtected($item->zoomer_4, 'data')['url'];
      };
      if (!is_null($item->zoomer_6)) {
        $myItem->zoomer_6 = accessProtected($item->zoomer_6, 'data')['url'];
      };
      if (!is_null($item->zoomer_8)) {
        $myItem->zoomer_8 = accessProtected($item->zoomer_8, 'data')['url'];
      };
      if (!is_null($item->zoomer_10)) {
        $myItem->zoomer_10 = accessProtected($item->zoomer_10, 'data')['url'];
      };
      if (!is_null($item->zoomer_12)) {
        $myItem->zoomer_12 = accessProtected($item->zoomer_12, 'data')['url'];
      };
      if (!is_null($item->zoomer_13)) {
        $myItem->zoomer_13 = accessProtected($item->zoomer_13, 'data')['url'];
      };
      if (!is_null($item->zoomer_14)) {
        $myItem->zoomer_14 = accessProtected($item->zoomer_14, 'data')['url'];
      };
      $returns[] = $myItem;
    }
    return $returns;
  }
  
  /*
    Destinations
  */

  function GetDestinations($client) {
    $params = [
      'limit' => 2000,
    ];
    $items = $client->getItems('destinations', $params);
    $returns = [];
    foreach($items as $item) {
      $splitLocation = explode(",", $item->location);
      $myItem = (object) [
        '_id' => $item->id,
        'name' => $item->name,
        'nativeName' => $item->native_name,
        'vertical' => $item->vertical,
        'horizontal' => $item->horizontal,
        'image'=> null,
        'lat' => floatval($splitLocation[0]),
        'lng' => floatval($splitLocation[1]),
      ];
      if (!is_null($item->image)) {
        $myItem->image = accessProtected($item->image, 'data')['url'];
      };
      $returns[] = $myItem;
    }
    return $returns;
  }
  
  /*
    Eggs
  */

  function GetEggs($client) {
    $params = [
      'limit' => 2000,
    ];
    $items = $client->getItems('eggs', $params);
    $returns = [];
    foreach($items as $item) {
      $splitLocation = explode(",", $item->location);
      $myItem = (object) [
        '_id' => $item->id,
        'name' => $item->name,
        'image'=> null,
        'video' => $item->video,
        'originId' => null,
        'lat' => floatval($splitLocation[0]),
        'lng' => floatval($splitLocation[1]),
      ];
      if (!is_null($item->image)) {
        $myItem->image = accessProtected($item->image, 'data')['url'];
      };
      if (!is_null($item->origin_id)) {
        $myItem->originId = accessProtected($item->origin_id, 'data')['id'];
      };
      $returns[] = $myItem;
    }
    return $returns;
  }

  /*
    Interviews
  */

  function GetInterviews($client) {
    $params = [
      'limit' => 2000,
    ];
    $items = $client->getItems('interviews', $params);
    $returns = [];
    foreach($items as $item) {
      $splitLocation = explode(",", $item->location);
      $myItem = (object) [
        '_id' => $item->id,
        'name' => $item->name,
        'sound' => null,
        'image' => null,
        'destinationId' => null,
        'originId' => null,
        'parent' => $item->parent,
        'lat' => floatval($splitLocation[0]),
        'lng' => floatval($splitLocation[1]),
        'eggId' => null,
        'top' => $item->top,
        'left' => $item->left,
      ];
      if (!is_null($item->sound)) {
        $myItem->sound = accessProtected($item->sound, 'data')['url'];
      };
      if (!is_null($item->image)) {
        $myItem->image = accessProtected($item->image, 'data')['url'];
      };
      if (!is_null($item->destination_id)) {
        $myItem->destinationId = accessProtected($item->destination_id, 'data')['id'];
      };
      if (!is_null($item->origin_id)) {
        $myItem->originId = accessProtected($item->origin_id, 'data')['id'];
      };
      if (!is_null($item->egg_id)) {
        $myItem->eggId = accessProtected($item->egg_id, 'data')['id'];
      };
      $returns[] = $myItem;
    }
    return $returns;
  }

  /*
    Slides
  */

  function GetSlides($client) {
    $params = [
      'limit' => 200,
    ];
    $items = $client->getItems('slides', $params);
    $returns = [];
    foreach($items as $item) {
      $myItem = (object) [
        '_id' => $item->id,
        'interviewId' => null,
        'name'=> null,
        'startTime' => $item->time,
        'endTime' => '',
        'type' => 'photo',
      ];
      if (!is_null($item->interview_id)) {
        $myItem->interviewId = accessProtected($item->interview_id, 'data')['id'];
      };
      if (!is_null($item->image)) {
        $myItem->name = accessProtected($item->image, 'data')['url'];
      };
      $returns[] = $myItem;
    }

    $params2 = [
      'offset' => 200,
      'limit' => 200,
    ];
    $items2 = $client->getItems('slides', $params2);
    foreach($items2 as $item) {
      $myItem = (object) [
        '_id' => $item->id,
        'interviewId' => null,
        'name'=> null,
        'startTime' => $item->time,
        'endTime' => '',
        'type' => 'photo',
      ];
      if (!is_null($item->interview_id)) {
        $myItem->interviewId = accessProtected($item->interview_id, 'data')['id'];
      };
      if (!is_null($item->image)) {
        $myItem->name = accessProtected($item->image, 'data')['url'];
      };
      $returns[] = $myItem;
    }

    $params3 = [
      'offset' => 400,
      'limit' => 200,
    ];
    $items3 = $client->getItems('slides', $params3);
    foreach($items3 as $item) {
      $myItem = (object) [
        '_id' => $item->id,
        'interviewId' => null,
        'name'=> null,
        'startTime' => $item->time,
        'endTime' => '',
        'type' => 'photo',
      ];
      if (!is_null($item->interview_id)) {
        $myItem->interviewId = accessProtected($item->interview_id, 'data')['id'];
      };
      if (!is_null($item->image)) {
        $myItem->name = accessProtected($item->image, 'data')['url'];
      };
      $returns[] = $myItem;
    }

    $params4 = [
      'offset' => 600,
      'limit' => 200,
    ];
    $items4 = $client->getItems('slides', $params4);
    foreach($items4 as $item) {
      $myItem = (object) [
        '_id' => $item->id,
        'interviewId' => null,
        'name'=> null,
        'startTime' => $item->time,
        'endTime' => '',
        'type' => 'photo',
      ];
      if (!is_null($item->interview_id)) {
        $myItem->interviewId = accessProtected($item->interview_id, 'data')['id'];
      };
      if (!is_null($item->image)) {
        $myItem->name = accessProtected($item->image, 'data')['url'];
      };
      $returns[] = $myItem;
    }

    return $returns;
  }

  /*
    Pages
  */

  function GetPages($client) {
    $params = [
      'limit' => 2000,
    ];
    $items = $client->getItems('pages', $params);
    $returns = [];
    foreach($items as $item) {
      $myItem = (object) [
        '_id' => $item->id,
        'name' => $item->name,
        'en'=> htmlentities($item->en),
        'fr'=> htmlentities($item->fr),
      ];
      $returns[] = $myItem;
    }
    return $returns;
  }

  /*
    Guides
  */

  function GetGuides($client) {
    $params = [
      'limit' => 2000,
    ];
    $items = $client->getItems('guides', $params);
    $returns = [];
    foreach($items as $item) {
      $myItem = (object) [
        '_id' => $item->id,
        'sortOrder' => $item->sort,
        'view' => $item->view,
      ];
      if (!is_null($item->interview_id)) {
        $myItem->interviewId = accessProtected($item->interview_id, 'data')['id'];
      };
      if (!is_null($item->origin_id)) {
        $myItem->originId = accessProtected($item->origin_id, 'data')['id'];
      };
      if (!is_null($item->egg_id)) {
        $myItem->eggId = accessProtected($item->egg_id, 'data')['id'];
      };
      $returns[] = $myItem;
    }
    return $returns;
  }

  /*
    API response
  */

  $data = [
    'origins' => GetOrigins($client),
    'destinations' => GetDestinations($client),
    'eggs' => GetEggs($client),
    'interviews' => GetInterviews($client),
    'slides' => GetSlides($client),
    'pages' => GetPages($client),
    'guides' => GetGuides($client),
  ];
  header('Access-Control-Allow-Origin: *');
  echo json_encode($data);

?>
