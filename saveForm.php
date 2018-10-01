<?php

add_action('wpcf7_before_send_mail', 'save_form' );
 
function save_form( $wpcf7 ) {
   global $wpdb;
 
   /*
    Nota: desde la version 3.9 Contact Form 7 ha eliminado $wpcf7->posted_data
    y ahora se accede a los datos a través de API.
   */
 
   $submission = WPCF7_Submission::get_instance();
 
   if ( $submission ) {
 
       $submited = array();
       $submited['title'] = $wpcf7->title();
       $submited['posted_data'] = $submission->get_posted_data();
 
    }

    
    
  
        
     $data = array(
                'name'  => $submited['posted_data']['first-name'],
                'telefono'  => $submited['posted_data']['telefono'],
                'your-message'  => $submited['posted_data']['your-message'],
                'email' => $submited['posted_data']['email-111']
            
                );
                
                print_r($data);exit;
 
     $wpdb->insert( $wpdb->prefix . 'tps_forms', 
		    array( 
                          'form'  => $submited['title'], 
                           'nombre' => $data['name'],
                           'telefono' => $data['telefono'],
                           'mensaje' => $data['your-message'],
                           'email' => $data['email'],
                          
			   'date' => date('Y-m-d H:i:s')
			)
		);
}
?>