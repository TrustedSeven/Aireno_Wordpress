<?php
function get_page_by_template($template = '') {
    $args = array(
        'meta_key' => '_wp_page_template',
        'meta_value' => $template
    );
    $pages = get_pages($args);
    if (count($pages) > 0)
        return $pages[0];
    else return site_url();
}

function aireno_get_page_link_by_name($page_name) {
    return get_permalink(get_page_by_template('page-'.$page_name.'.php'));
}

function aireno_get_icon_svg( $group, $icon, $size = 24 ) {
    return Aireno_SVG_Icons::get_svg( $group, $icon, $size );
}

if ( ! function_exists( 'aireno_the_posts_navigation' ) ) {
    /**
     * Print the next and previous posts navigation.
     *
     * @since Aireno
     *
     * @return void
     */
    function aireno_the_posts_navigation() {
        the_posts_pagination(
            array(
                'before_page_number' => esc_html__( '', TEXT_DOMAIN ) . ' ',
                'mid_size'           => 0,
                'prev_text'          => sprintf(
                    '%s <span class="nav-prev-text">%s</span>',
                    is_rtl() ? aireno_get_icon_svg( 'ui', 'arrow_right' ) : aireno_get_icon_svg( 'ui', 'arrow_left' ),
                    wp_kses(
                        __( 'First', TEXT_DOMAIN ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    )
                ),
                'next_text'          => sprintf(
                    '<span class="nav-next-text">%s</span> %s',
                    wp_kses(
                        __( 'Last', TEXT_DOMAIN ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    is_rtl() ? aireno_get_icon_svg( 'ui', 'arrow_left' ) : aireno_get_icon_svg( 'ui', 'arrow_right' )
                ),
            )
        );
        ?>
        <?php
    }
}

/**
 * Creates continue reading text.
 *
 * @since Aireno
 */
function aireno_continue_reading_text() {
    $continue_reading = sprintf(
    /* translators: %s: Post title. Only visible to screen readers. */
        esc_html__( 'Continue reading %s', TEXT_DOMAIN ),
        the_title( '<span class="screen-reader-text">', '</span>', false )
    );

    return $continue_reading;
}

function aireno_list_refine_categories($name, $selected_id, $class = '', $disabled = '')
{
    $refine_categories = get_terms(
        array(
            'taxonomy' => 'refinecat',
            'hide_empty' => false,
        )
    );
    $options = array();
    $index = 0;
    foreach ($refine_categories as $category) {
        if (!$disabled) {
            $obj = array(
                'term_id' => $category->term_id,
                'name' => $category->name,
                'selected' => ($category->term_id == $selected_id) ? 'selected' : '',
            );
            if ($index == 0 && $selected_id == '') {
                $obj['selected'] = 'selected';
            }
            $options[] = $obj;
            $index ++;
        }
        else {
            if ($category->term_id == $selected_id) $options[] = array(
                'term_id' => $category->term_id,
                'name' => $category->name,
                'selected' => 'selected',
            );
        }
    }
    if (count($options) == 0) {
        $category = array_shift($refine_categories);
        $options[] = array(
            'term_id' => $category->term_id,
            'name' => $category->name,
            'selected' => 'selected',
        );
    }
    ?>
    <select class="form-select form-control form-control-solid <?=$class?>" name="<?= $name ?>">
        <?php
        foreach ($options as $option) {
            echo '<option value="' . $option['term_id'] . '"' . $option['selected'] . '>' . $option['name'] . '</option>';
        }
        ?>
    </select>
    <?php
}

