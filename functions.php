<?php

register_nav_menus(array(
    'section-menu' => __('Section Menu', 'galaxyio'),
    'menu-one' => __('Menu One', 'galaxyio'),
    'menu-two' => __('Menu Two', 'galaxyio'),
    'menu-three' => __('Menu Three', 'galaxyio'),
    'menu-four' => __('Menu Four', 'galaxyio'),
    'menu-five' => __('Menu Five', 'galaxyio'),
    'product-menu' => __('Product Menu', 'galaxyio'),
));
add_theme_support('post-thumbnails');

//set_theme_mod('nav_menu_locations', array('ccc'=>'main_nav'));

function galaxyio_menu($args = array()) {
    $menu = wp_get_nav_menu_object('section-menu');
    $menu_items = wp_get_nav_menu_items($menu->term_id, array('update_post_term_cache' => false));
}

class galaxyio_hover_walker extends Walker_Nav_Menu {

    function walk($elements, $max_depth) {

        $args = array_slice(func_get_args(), 2);
        $output = '';

        if ($max_depth < -1) //invalid parameter
            return $output;
        
        if (empty($elements)) //nothing to walk
            return $output;

        $id_field = $this->db_fields['id'];
        $parent_field = $this->db_fields['parent'];

        // flat display
        if (-1 == $max_depth) {
            $empty_array = array();
            foreach ($elements as $e)
                $this->display_element($e, $empty_array, 1, 0, $args, $output);
            return $output;
        }

        /*
         * need to display in hierarchical order
         * separate elements into two buckets: top level and children elements
         * children_elements is two dimensional array, eg.
         * children_elements[10][] contains all sub-elements whose parent is 10.
         */
        $top_level_elements = array();
        $children_elements = array();
        foreach ($elements as $e) {
            if (0 == $e->$parent_field)
                $top_level_elements[] = $e;
            else
                $children_elements[$e->$parent_field][] = $e;
        }

        /*
         * when none of the elements is top level
         * assume the first one must be root of the sub elements
         */
        if (empty($top_level_elements)) {

            $first = array_slice($elements, 0, 1);
            $root = $first[0];

            $top_level_elements = array();
            $children_elements = array();
            foreach ($elements as $e) {
                if ($root->$parent_field == $e->$parent_field)
                    $top_level_elements[] = $e;
                else
                    $children_elements[$e->$parent_field][] = $e;
            }
        }

        foreach ($top_level_elements as $e) {
            $this->display_element($e, $children_elements, $max_depth, 0, $args, $output);
        }
        /*
         * if we are displaying all levels, and remaining children_elements is not empty,
         * then we got orphans, which should be displayed regardless
         */
        if (( $max_depth == 0 ) && count($children_elements) > 0) {

            $empty_array = array();
            foreach ($children_elements as $orphans)
                foreach ($orphans as $op)
                    $this->display_element($op, $empty_array, 1, 0, $args, $output);
        }

        return $output;
    }

    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";

    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        $indent = "\n" . ( $depth ) ? str_repeat("\t", $depth) : '';

        if (strcasecmp($item->title, 'divider')) {
            $class_names = $value = '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'ddmenu-item-' . $item->ID;


            $class_names = '';//$class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . '>';
            

            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            //$item_output .= ($args->has_children && $depth == 0) ? ' <span class="caret"></span></a>' : '</a>';
            $item_output .=  '</a>';
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        } else {
            $output .= $indent . '<li class="divider">';
        }
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {

        if (!$element)
            return;

        $id_field = $this->db_fields['id'];

        //display this element
        if (is_array($args[0]))
            $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
        elseif (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);
        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if (($max_depth == 0 || $max_depth > $depth + 1 ) && isset($children_elements[$id])) {
            foreach ($children_elements[$id] as $child) {
                if (!isset($newlevel)) {
                    $newlevel = true;
                    $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }

                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
            }
            unset($children_elements[$id]);
        }

        if (isset($newlevel) && $newlevel) {
            //end the child delimiter
            $cb_args = array_merge(array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }
        

        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }

}

class galaxyio_bootstrap_walker extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        if (strcasecmp($item->title, 'divider')) {
            $class_names = $value = '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;
//			$classes[] = ($item->current && 0 == $depth) ? 'active' : '';
            $classes[] = 'menu-item-' . $item->ID;
            $class_names = ''; //join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            if ($args->has_children && 0 < $depth)
                $class_names .= ' dropdown-submenu';
            elseif ($args->has_children && 0 == $depth)
                $class_names .= ' dropdown';

            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . '>';

            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
            $attributes .= ($args->has_children) ? ' data-toggle="dropdown" data-target="#" class="dropdown-toggle"' : '';

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= ($args->has_children && $depth == 0) ? ' <span class="caret"></span></a>' : '</a>';
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        } else {
            $output .= $indent . '<li class="divider">';
        }
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {

        if (!$element)
            return;

        $id_field = $this->db_fields['id'];

        //display this element
        if (is_array($args[0]))
            $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
        elseif (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);
        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if (($max_depth == 0 || $max_depth > $depth + 1 ) && isset($children_elements[$id])) {

            foreach ($children_elements[$id] as $child) {
                if (!isset($newlevel)) {
                    $newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
            }
            unset($children_elements[$id]);
        }

        if (isset($newlevel) && $newlevel) {
            //end the child delimiter
            $cb_args = array_merge(array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }

}

function galaxyio_nav_fb() {
    echo '<ul class="nav">';
    wp_list_pages(array(
        'echo' => 1,
        'title_li' => '',
        'sort_column' => 'menu_order, post_title',
        'walker' => new galaxyio_page_walker(),
        'post_type' => 'page',
        'post_status' => 'publish'
    ));
    echo '</ul>';
}

class galaxyio_page_walker extends Walker_Page {

    function start_el(&$output, $page, $depth, $args, $current_page) {
        $item_html = '';
        parent::start_el($item_html, $page, $depth, $args, $current_page);
        $css_class = array('page_item', 'page-item-' . $page->ID);
        if ($args['has_children'] && 0 == $depth) {
            $css_class[] = 'dropdown';
        } elseif ($args['has_children'] && 0 < $depth)
            $css_class[] = 'dropdown-submenu';

        $css_class = ''; //implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
        if ($args['has_children'] && 0 == $depth) {
            $item_html = '<li class="' . $css_class . '" ><a href="' . get_permalink($page->ID) . '">' . apply_filters('the_title', $page->post_title, $page->ID) . '<span class="caret dropdown-toggle" data-toggle="dropdown"></span></a>';
        }
        else
            $item_html = '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . apply_filters('the_title', $page->post_title, $page->ID) . '</a>';
        $output .= $item_html;
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "\n<ul class=\"dropdown-menu\">\n";
    }

}

if (!function_exists('advantage_content_class')) :

    function advantage_content_class() {
        global $advantage_options;
        $class = "span" . $advantage_options['content'] . ' ';
        if (2 == $advantage_options['sidebarpos'] && ( $advantage_options['sidebar1'] > 0 || $advantage_options['sidebar2'] > 0 )) {
            if (( $advantage_options['content'] + $advantage_options['sidebar1'] + $advantage_options['sidebar2'] ) > 12) {
                if ($advantage_options['sidebar1'] > $advantage_options['sidebar2'])
                    $push_col = $advantage_options['sidebar1'];
                else
                    $push_col = $advantage_options['sidebar2'];
            }
            else {
                $push_col = $advantage_options['sidebar1'] + $advantage_options['sidebar2'];
            }
            $class = $class . "push" . $push_col . ' ';
        } elseif (3 == $advantage_options['sidebarpos'] && $advantage_options['sidebar1'] > 0) {
            $push_col = $advantage_options['sidebar1'];
            $class = $class . "push" . $push_col . ' ';
        }
        return $class;
    }








endif;
