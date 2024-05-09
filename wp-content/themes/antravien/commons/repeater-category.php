<?php

if (!isset($repeater_posts)) $repeater_posts = 'posts';
if (!isset($repeater_post_type)) $repeater_post_type = 'post';
if (!isset($repeater_post_cat)) $repeater_post_cat = 'category';

return array(
    'type' => 'group',
    'heading' => __('Posts'),
    'options' => array(
        'cat' => array(
            'type' => 'select',
            'heading' => 'Category',
            'param_name' => 'cat',
            'full_width' => true,
            'default' => '',
            'config' => array(
                'multiple' => true,
                'placeholder' => 'Select...',
                'termSelect' => array(
                    'post_type' => $repeater_post_cat,
                    'taxonomies' => $repeater_post_cat
                ),
            )
        )
    )
);
