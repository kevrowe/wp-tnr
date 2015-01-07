<?php

/**
 * Slider Widget
 */

register_widget( 'TNR_Carousel' );

/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class TNR_Carousel extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function TNR_Carousel() {
        $widget_ops = array( 'classname' => 'tnr_carousel_widget', 'description' => 'Thumbnail-caption carousel with scattered exit animation' );
        $this->WP_Widget( 'tnr_carousel_widget', 'TNR Carousel', $widget_ops );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        ?>
        <div class="thumb-carousel">
            <?php
            $slideCount = empty($instance['no_slides']) ? 3 : $instance['no_slides'];
            for ($i = 1; $i <= $slideCount; $i++):
                ?>
            <div class="slide<?= $i == 1 ? ' shown' : '' ?>">
                <div class="thumb">
                    <?php
                    $imageUrl = empty($instance['slide'.$i.'_image'])
                    ? 'http://placehold.it/212x132&text=NO IMAGE'
                    : $instance['slide'.$i.'_image'];
                    ?>
                    <img src="<?=$imageUrl?>" alt="Slide <?=$i?> Image" />
                </div>
                <div class="info">
                    <h2><?= $instance['slide'.$i.'_title'] ?></h2>
                    <p><?=
                    $instance['slide'.$i.'_text']
                    ?></p>
                </div>
            </div>
            <?php endfor; ?>
            <!-- /Slide -->
            <div class="next">
                <a href="#"> <img src="<?= get_stylesheet_directory_uri() ?>/img/slider-arrow.gif" alt="Next slide" /> </a>
            </div>
        </div>
        <?php
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {

        // update logic goes here
        $updated_instance = $new_instance;
        return $updated_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array() );
        // display field names here using:
        // $this->get_field_id( 'option_name' ) - the CSS ID
        // $this->get_field_name( 'option_name' ) - the HTML name
        // $instance['option_name'] - the option value

        wp_enqueue_media();
        wp_enqueue_script( 'tnr-media-hook', get_stylesheet_directory_uri(). '/js/tnr-media-hook.js', array('jquery'), $ver = false, $in_footer = true );

        ?>
        <p>
            <label for="<?=$this->get_field_id('no_slides')?>">Number of slides:</label>
            <input type="text" id="<?=$this->get_field_id('no_slides')?>" name="<?=$this->get_field_name('no_slides')?>" value="<?=$instance['no_slides']?>" />
            <input type="button" value="Update" class="widget_update button button-primary right" />
            <span class="spinner"></span>
        </p>
        <?php
        $slideCount = empty($instance['no_slides']) ? 3 : $instance['no_slides'];
        for ($i = 1; $i <= $slideCount; $i++):
            ?>
        <p>
            <label for="<?=$this->get_field_id('slide'.$i.'_title')?>">Slide <?=$i?> Title:</label>
            <input type="text" class="widefat" id="<?=$this->get_field_id('slide'.$i.'_title')?>" name="<?=$this->get_field_name('slide'.$i.'_title')?>"
            value="<?=$instance['slide'.$i.'_title']?>"/>
        </p>
        <p>
            <label for="<?=$this->get_field_id('slide'.$i.'_text')?>">Slide <?=$i?> Text:</label>
            <textarea name="<?=$this->get_field_name('slide'.$i.'_text')?>" id="<?=$this->get_field_id('slide'.$i.'_text')?>" class="widefat" rows="5"><?=
            $instance['slide'.$i.'_text']
            ?></textarea>
        </p>
        <p>
            <label for="<?=$this->get_field_id('slide'.$i.'_image')?>">Slide <?=$i?> Image:</label>
            <p>
                <img src="<?= empty($instance['slide'.$i.'_image']) ? 'http://placehold.it/200x125&text=NO IMAGE' : $instance['slide'.$i.'_image']?>"
                alt="Currently selected image" id="preview<?=$i?>" width="200"/>
            </p>
            <input type="hidden" id="<?=$this->get_field_id('slide'.$i.'_image')?>" name="<?=$this->get_field_name('slide'.$i.'_image')?>"
            data-image="preview<?=$i?>" value="<?=$instance['slide'.$i.'_image']?>" />
            <input type="button" id="<?='slide'.$i.'_image_select'?>" value="Choose Image..." class="media-library-trigger"
            data-target="<?=$this->get_field_id('slide'.$i.'_image')?>"/>
        </p>
        <hr/>
        <?php
        endfor;
    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'TNR_Carousel' );" ) );

?>