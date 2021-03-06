<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['form_cms_page']['table'] = 'cms_page';
$config['form_cms_page']['fields'] = array(
    array('label'      => 'Id',
          'field_name' => 'id',
          'type'       => 'text',
          'value'      => '',
          'maxlength'  => '8',
          'rule'       => 'trim|xss_clean|required',
    ),
    array('label'      => 'Name',
          'field_name' => 'name',
          'type'       => 'text',
          'value'      => '',
          'maxlength'  => '255',
          'rule'       => 'trim|xss_clean|required',
    ),
    array('label'      => 'Content',
          'field_name' => 'content',
          'type'       => 'text',
          'value'      => '',
          'maxlength'  => '',
          'rule'       => 'trim|xss_clean|required',
    ),
    array('label'      => 'Updated',
          'field_name' => 'updated',
          'type'       => 'text',
          'value'      => '',
          'maxlength'  => '8',
          'rule'       => 'trim|xss_clean|required',
    ),
    array('label'      => 'Cms Menu Id',
          'field_name' => 'cms_menu_id',
          'type'       => 'text',
          'value'      => '',
          'maxlength'  => '10',
          'rule'       => 'trim|xss_clean|required',
    ),
);
?>
