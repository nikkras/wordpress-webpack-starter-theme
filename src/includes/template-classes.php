<?php

///////////////////////////////////////////////////////////////////////////////
// TEMPLATE CLASSES
///////////////////////////////////////////////////////////////////////////////

// ---------------------------------------------------------------
// CUSTOM WALKER CLASS FOR MAIN MENU
// ---------------------------------------------------------------

class WPNK_Nav_Menu_Walker_Simple extends Walker_Nav_Menu
{
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        /*
         * Adds post_name as class
         *  1. The title as class, to support portability, uses title, because post_title is not consitent
         *  2. If has children (not currently supported)
         *  3. Current regardless the level
         */
        $classes = array();
        $hasSub = false;
        $classes[] = sanitize_html_class(sanitize_title($item->title));
        $classes[] = ($item->current or $item->current_item_ancestor or $item->current_item_parent)
            ? 'listMenu__li--current' : '';

        $originalClasses = $item->classes;
        foreach ($originalClasses as $class) {
            if ($class === 'menu-item-has-children') {
                $hasSub = true;
            }
        }
        if ($hasSub) {
            $classes[] = 'listMenu__li--sub';
        }

        $output .= '<li class="listMenu__li listMenu__li--' . trim(implode(' ', $classes)) . '">';

        $attributes = '';
        /*
         * Adds description if available, wrapped in small tags, because its an alternate way of calling the item
         */
        $description = ($item->description != '') ? "<p class=\"description\"><small>{$item->description}</small></p>"
            : '';
        !empty($item->attr_title)
            // Avoid redundant titles
            and $item->attr_title !== $item->title
            and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';

        !empty($item->url)
            and $attributes .= ' href="' . esc_attr($item->url) . '"';

        $attributes = trim($attributes);
        $title = apply_filters('the_title', $item->title, $item->ID);
        $item_output = "{$args->before}<a class=\"navLink\" {$attributes}>{$args->link_before}{$title}</a>{$description}"
            . "$args->link_after $args->after";

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el',
            $item_output,
            $item,
            $depth,
            $args
        );
    }

    /**
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '<ul class="sub-menu">';
    }

    /**
     * @see Walker::end_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '</ul>';
    }

    /**
     * @see Walker::end_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= '</li>';
    }
} // END Custom Walker Menu
