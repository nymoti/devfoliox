<?php
/**
 * DevfolioX Theme Options
 *
 *
 * @package DevfolioX
 */

require ABSPATH . "vendor/stoutlogic/acf-builder/autoload.php";

use StoutLogic\AcfBuilder\FieldsBuilder;

$doorTypeFields = new FieldsBuilder('door_type_fields');

$doorTypeFields->addTab('doors_info', ['placement' => 'left'])
                ->addAccordion('nl_door', [
                    'label' => 'Dutch Translation',
                    'open' => 1])
                    ->addText('nl_name', ['label' => 'Nom'])
                    ->addTextarea('nl_description',[
                        'rows' => '4',
                        'label' => 'Description'
                    ])
                ->addAccordion('nl_door_end')->endpoint()
                ->addAccordion('de_door', [
                    'label' => 'German Translation',
                    'open' => 0])
                    ->addText('de_name', ['label' => 'Name'])
                    ->addTextarea('de_description',[
                        'rows' => '4',
                        'label' => 'Description'
                    ])
                ->addAccordion('de_door_end')->endpoint()
                ->addAccordion('en_door', [
                    'label' => 'English Translation',
                    'open' => 0])
                    ->addText('en_name', ['label' => 'Name'])
                    ->addTextarea('en_description',[
                        'rows' => '4',
                        'label' => 'Description'
                    ])
                ->addAccordion('en_door_end')->endpoint()
                ->addImage('image')
                ->addTab('door_types', ['placement' => 'left', 'label' => 'Door Models'])
                    ->addRepeater('door_types', ['layout' => 'row', 'label' => 'Models'])
                        ->addTab('door_type_name', ['placement' => 'left', 'label' => 'Model Name'])
                            ->addText('door_type_nl_name', ['label' => 'Dutch'])
                            ->addText('door_type_de_name', ['label' => 'German'])
                            ->addText('door_type_en_name', ['label' => 'English'])
                        ->addTab('euro_type', ['placement' => 'left', 'label' => 'Europe Measurements'])
                            ->addText('door_weight', ['label' => 'Weight'])
                            ->addText('euro_slag', ['label' => 'Slag (mm)'])
                            ->addText('euro_maat', ['label' => 'Size (mm)'])
                            ->addText('euro_price', ['label' => 'Price (€)'])
                        ->addTab('usa_type', ['placement' => 'left', 'label' => 'Usa Measurements'])
                            ->addText('usa_door_weight', ['label' => 'Weight'])
                            ->addText('usa_slag', ['label' => 'Slag (inch)'])
                            ->addText('usa_maat', ['label' => 'Size (inch)'])
                            ->addText('usa_price', ['label' => 'Price ($)'])
                    ->endRepeater();

$doorType = new FieldsBuilder('door');
$doorType->setLocation('post_type', '==', 'door_type');
$doorType->addFields($doorTypeFields);

acf_add_local_field_group($doorType->build());

return $doorType;
