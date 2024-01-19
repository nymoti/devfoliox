<?php
/**
 * DevfolioX functions and definitions
 *
 *
 * @package DevfolioX
 */
require ABSPATH . "vendor/stoutlogic/acf-builder/autoload.php";

use StoutLogic\AcfBuilder\FieldsBuilder;

$options = new FieldsBuilder('theme_options');
acf_add_options_page([
    'page_title' => 'DevFoliox',
    'menu_title' => 'DevFoliox',
    'menu_slug' => 'theme-options',
    'update_button' => 'Update',
    'capability' => 'edit_theme_options',
    'position' => '2',
    'autoload' => true,
]);

$options = new FieldsBuilder('theme_options', []);

$options
    ->setLocation('options_page', '==', 'theme-options');

$options->addTab('header', ['placement' => 'left', 'label' => 'Personal Details'])
            ->setConfig('placement', 'left')
                    ->addImage('profile_image_menu', ['label' => 'Profile Image'])
                    ->addImage('profile_image_banner', ['label' => 'Profile Banner Image'])
                    ->addText('first_name', ['label' => 'Frist Name'])
                    ->addText('middle_name', ['label' => 'Middle Name'])
                    ->addText('last_name', ['label' => 'Last Name'])
        ->addTab('contact', ['placement' => 'left', 'label' => 'Contact'])
            ->addText('email', ['label' => 'Email'])
            ->addText('phone', ['label' => 'Phone'])
            ->addText('Address', ['label' => 'Address'])
        ->addTab('social_media', ['placement' => 'left', 'label' => 'Social Media'])
            ->addText('linkedin', ['label' => 'Linkeding'])
            ->addText('github', ['label' => 'Github'])
            ->addText('twitter', ['label' => 'X'])
            ->addText('facebook', ['label' => 'Facebook'])
            ->addText('instagram', ['label' => 'Instagram']);

acf_add_local_field_group($options->build());