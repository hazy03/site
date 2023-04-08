<?php
/**
 * Define custom fields for widgets
 * 
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
function uniform_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $uniform_widgets_field_type ) {

        // Standard text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $uniform_widgets_name ) ); ?>"><?php echo esc_html( $uniform_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $uniform_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $uniform_widgets_name ) ); ?>" type="text" value="<?php echo esc_attr( $athm_field_value ); ?>" />

                <?php if ( isset( $uniform_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $uniform_widgets_description ); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Standard url field
        case 'url' :
            ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $uniform_widgets_name ) ); ?>"><?php echo esc_html( $uniform_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $uniform_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $uniform_widgets_name ) ); ?>" type="text" value="<?php echo esc_url( $athm_field_value ); ?>" />

                <?php if ( isset( $uniform_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $uniform_widgets_description ); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Textarea field
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $uniform_widgets_name ) ); ?>"><?php echo esc_html( $uniform_widgets_title ); ?>:</label>
                <textarea class="widefat" rows="<?php echo absint( $uniform_widgets_row ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $uniform_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $uniform_widgets_name ) ); ?>"><?php echo esc_textarea( $athm_field_value ); ?></textarea>
            </p>
            <?php
            break;

        // Checkbox field
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo esc_attr( $instance->get_field_id( $uniform_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $uniform_widgets_name ) ); ?>" type="checkbox" value="1" <?php checked( '1', $athm_field_value ); ?>/>
                <label for="<?php echo esc_attr( $instance->get_field_id( $uniform_widgets_name ) ); ?>"><?php echo esc_html( $uniform_widgets_title ); ?></label>

                <?php if ( isset( $uniform_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $uniform_widgets_description ); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        default:
            # code...
            break;
    }
}

function uniform_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );

    if ( $uniform_widgets_field_type == 'textarea' ) {
        return wp_kses_post( $new_field_value );
    } elseif ( $uniform_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } else {
        return sanitize_text_field( $new_field_value );
    }
    
}