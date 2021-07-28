<?php

/*=================================
*
*
*   Creates custom fields for post timeline
*
*
====================================*/

if(function_exists('acf_add_local_field_group')){
  register_field_group(array(
      'key' => 'ufclas-timeline',
      'title' => 'Timeline',
      'fields' => array (
        array (
          'key' => 'timeline-side',
          'label' => 'Timeline Side',
          'name' => 'timeline-side',
          'type' => 'select',
          'choices' => array(
            'left'	=> 'Left Side',
            'right'	=> 'Right Side'
          ),
        ),

        array (
          'key'   => 'event-date',
          'label' => 'Event Date',
          'name'  => 'event-date',
          'type'  => 'date_time_picker',
          'display_format' => 'm/d/Y g:i a',
          'return_format' => 'm/d/Y g:i a',
        ),

        array (
          'key' => 'event-type',
          'label' => 'Event Type',
          'name' => 'event-type',
          'type' => 'text',
        ),

        array (
          'key' => 'event-color',
          'label' => 'Event Color',
          'name' => 'event-color',
          'type' => 'color_picker',
        ),

        array (
          'key' => 'clas-register-event',
          'label' => 'Link for Event Registration',
          'name' => 'clas-register-event',
          'type' => 'text',
        ),
      ),
      'location' => array (
        array (
          array (
            'param' => 'page_template',
            'operator' => '==',
            'value' => 'public/templates/single-event.php'
          ),
        ),
      ),

      ));

}

?>
