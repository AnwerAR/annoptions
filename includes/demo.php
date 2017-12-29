<?php
// Add Demo page,sections and fields,
add_action( 'ao_options', 'annframe_demo_content' );

function annframe_demo_content( $options ) {

$options->addPage(
  array(
    'page_title'    =>  __( 'Bonito Setup' ),
    'menu_title'    =>  __( 'Bo Setup' ),
    'slug'          =>  'bonito-setup',
    'icon'          =>  'dashicons-marker',
));
$options->addSection(
  'bonito-setup',
  array(
    'id'    => 'bo-basic-inputs',
    'title' => __( 'Basic Input Fields' ),
    'desc'  => __( 'Display the basic input fields of AO.' ),
  )
);
$options->addFields(
  'bo-basic-inputs',
  array(
    array(
      'id'          => 'ao-text',
      'title'       => 'AO Text',
      'type'        => 'text',
      'eclass'      => 'form-control',
      'placeholder' => __( 'Enter ao text' ),
      //'default'     =>  __( '' ),
    ),
    array(
      'id'          => 'ao-select',
      'title'       => 'AO select',
      'type'        => 'select',
      'eclass'      => 'form-control',
      'placeholder' => __( 'Select a value' ),
      'choices'     => array(
          'option1' =>  __('Option one' ),
          'option2' =>  __('Option two' ),
          'option3' =>  __('Option three' ),
          'option4' =>  __('Option four' ),
          'option5' =>  __('Option five' ),
      ),
      'default'     =>  __( 'option4' ),
    ),
    array(
      'id'          => 'ao-checkbox',
      'title'       => 'AO checkbox',
      'type'        => 'checkbox',
      'eclass'      => 'form-control',
      'placeholder' => __( 'Select a value' ),
      'choices'     => array(
          'checkbox1' =>  __('Checkbos one' ),
          'checkbox2' =>  __('Checkbos two' ),
          'checkbox3' =>  __('Checkbos three' ),
          'checkbox4' =>  __('Checkbos four' ),
          'checkbox5' =>  __('Checkbos five' ),
      ),
      'default'     =>  __( 'option4' ),
    ),
    array(
      'id'          => 'ao-phone',
      'title'       => 'AO phone',
      'type'        => 'tel',
      'eclass'      => 'form-control',
      'placeholder' => __( '092 347 5161308' ),
      'default'     =>  __( '+92 347 5161308' ),
    ),
    array(
      'id'          => 'ao-email',
      'title'       => 'AO email',
      'type'        => 'email',
      'eclass'      => 'form-control',
      'placeholder' => __( 'some@example.com' ),
      'default'     =>  __( 'abdul@example.com' ),
    ),
    array(
      'id'          => 'ao-url',
      'title'       => 'AO url',
      'type'        => 'url',
      'eclass'      => 'form-control',
      'placeholder' => __( 'example.com' ),
      'default'     =>  __( 'example.com' ),
    ),
    array(
      'id'          => 'ao-number',
      'title'       => 'AO number',
      'type'        => 'number',
      'eclass'      => 'form-control',
      'placeholder' => __( '123456' ),
      'default'     =>  __( '5121472' ),
    ),
    array(
      'id'          => 'ao-textarea',
      'title'       => 'AO textarea',
      'type'        => 'textarea',
      'eclass'      => 'form-control',
      'placeholder' => __( 'Message' ),
      'default'     =>  __( 'Lorem ipsum dolor sit amet.' ),
    ),
    array(
      'id'          => 'ao-radio',
      'title'       => 'AO radio',
      'type'        => 'radio',
      'eclass'      => 'form-control',
      'placeholder' => __( 'Select option' ),
      'choices'     => array(
          'radio1' =>  __('Radio one' ),
          'radio2' =>  __('Radio two' ),
          'radio3' =>  __('Radio three' ),
          'radio4' =>  __('Radio four' ),
          'radio5' =>  __('Radio five' ),
      ),
      'default'     =>  __( 'radio4' ),
    ),
    array(
      'id'          => 'ao-multiselect',
      'title'       => 'AO multiselect',
      'type'        => 'multiselect',
      'eclass'      => 'form-control',
      'placeholder' => __( 'Select options' ),
      'choices'     => array(
          'option1' =>  __('Option one' ),
          'option2' =>  __('Option two' ),
          'option3' =>  __('Option three' ),
          'option4' =>  __('Option four' ),
          'option5' =>  __('Option five' ),
      ),
      'default'     =>  __( 'option3' ),
    ),
    array(
      'id'          => 'ao-editor',
      'title'       => 'AO editor',
      'type'        => 'editor',
      'eclass'      => 'form-control',
      'placeholder' => __( 'Enter description' ),
      'default'     =>  __( 'Lorem ipsum dolor sit amet.' ),
    ),
    array(
      'id'          => 'ao-repeater',
      'title'       => 'AO repeater',
      'type'        => 'repeater',
      'eclass'      => 'text-repeater',
      'fields'      => array(
        array(
          'id'          => 'ao-admin-mail',
          'title'       => 'AO admin-mail',
          'type'        => 'email',
          'eclass'      => 'form-control',
          'placeholder' => __( 'admin@example.com' ),
          'default'     =>  __( 'admin@example.com' ),
        ),
        array(
          'id'          => 'ao-manager-mail',
          'title'       => 'Manager email',
          'type'        => 'email',
          'eclass'      => 'form-control',
          'placeholder' => __( 'manager@example.com' ),
          'default'     =>  __( 'manager@example.com' ),
        ),
        array(
          'id'          => 'ao-select-two',
          'title'       => 'AO select two',
          'type'        => 'select',
          'eclass'      => 'form-control',
          'placeholder' => __( 'Select a value' ),
          'choices'     => array(
              'option1' =>  __('Option one' ),
              'option2' =>  __('Option two' ),
              'option3' =>  __('Option three' ),
              'option4' =>  __('Option four' ),
              'option5' =>  __('Option five' ),
          ),
          'default'     =>  __( 'option4' ),
        ),
        array(
          'id'          => 'ao-multiselect2',
          'title'       => 'AO multiselect 2',
          'type'        => 'multiselect',
          'eclass'      => 'form-control',
          'placeholder' => __( 'Select options' ),
          'choices'     => array(
              'option1' =>  __('Option one' ),
              'option2' =>  __('Option two' ),
              'option3' =>  __('Option three' ),
              'option4' =>  __('Option four' ),
              'option5' =>  __('Option five' ),
          ),
          'default'     =>  __( 'option3' ),
        ),
      )
    ),

  )
);
}
