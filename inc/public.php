<?php

add_action('wp_enqueue_scripts',function() {

  $axios = new_script('bp/axios','https://unpkg.com/axios/dist/axios.min.js')
    ->setInFooter(true)
    ->enqueue();

  $script = new_bp_script('bp/contact_form','form-contact.js')
    ->setDependencies(array('jquery'))
    ->setInFooter(true)
    ->addData('bp_contact_form_ajax',array(
      'api_nonce' => wp_create_nonce('wp_rest'),
      'submitUrl'    => site_url('/wp-json/bp/v1/contact_form_handler')
    ))
    ->enqueue();

});

add_action('rest_api_init',function() {
  
  // Register the route
  register_rest_route('bp/v1','/contact_form_handler/',array(
    'methods'   => 'post',
    'callback'  => 'bp_contact_form_handler'
  ));

});

function bp_contact_form_handler($data) {

  $fields = $data['fields'];
  
  // Stores the response
  $response = (object) array(); 

  // User email
  $user_email = new Blueprint\Email();

    $template = new_email_template();

    $template->setTitle('Message received!');
    
      $content = $template->getContent();
    
        $content->addP()
          ->addText("Thank you for contacting Sherpa Design Co! I'll be in touch shortly.");

    $user_email->setTo('aofolts@gmail.com');
    $user_email->setSubject('Test');
    $user_email->setBody($template->build());
    
    //$user_email_status = $user_email->send();
    $user_email_status = true;

  // Verify that emails were sent
  if ($user_email_status) {
    $response->error = false;
  } 
  else {
    $response->error = true;
  }

  return json_encode($response);

}

add_action('wp_ajax_nopriv_bp_contact_form_handler','bp_contact_form_handler');
add_action('wp_ajax_bp_contact_form_handler','bp_contact_form_handler');