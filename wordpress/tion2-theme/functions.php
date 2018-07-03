<?php

  require($_SERVER['DOCUMENT_ROOT']."/api/wordpressApi.php");

  function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyCjMvzKmIdIbXC3TUmDCnvILDM229DxOcw');
  }
  add_action('acf/init', 'my_acf_init');	

  function my_acf_save_post() {
    exportApiData();
  }
  add_action('acf/save_post', 'my_acf_save_post', 20);

?>