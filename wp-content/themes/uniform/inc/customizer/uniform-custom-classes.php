<?php
/**
 * Custom classes and definitions
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 * 
 */
 
if ( class_exists( 'WP_Customize_Control' ) ) {
    
    class Uniform_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select Category &mdash;', 'uniform' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s </label>',
                $this->label,
                $this->description,
                $dropdown
            );
        }
    }
    
    /**
     * Section info 
     */
     class Uniform_Section_Info extends WP_Customize_Control {
        public $type = 'section_info';
        public $label = '';
        public function render_content() {
?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            </label>
<?php
        }
    }
    
/*------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Switch button customize control.
     *
     * @since 1.3.2
     * @access public
     */
    class Uniform_Customize_Switch_Control extends WP_Customize_Control {

        /**
         * The type of customize control being rendered.
         *
         * @since  1.3.2
         * @access public
         * @var    string
         */
        public $type = 'switch';

        /**
         * Displays the control content.
         *
         * @since  1.3.2
         * @access public
         * @return void
         */
        public function render_content() {
    ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
                <div class="switch_options">
                    <?php 
                        $show_choices = $this->choices;
                        foreach ( $show_choices as $key => $value ) {
                            echo '<span class="switch_part '. esc_attr( $key ).'" data-switch="'. esc_attr( $key ).'">'. esc_html( $value ) .'</span>';
                        }
                    ?>
                    <input type="hidden" id="mt_switch_option" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
                </div>
            </label>
    <?php
        }
    }

/*------------------------------------------------------------------------------------------------------------------------------------*/    
    /**
     * Customize for textarea, extend the WP customizer
     */
    class Uniform_Textarea_Custom_Control extends WP_Customize_Control {
    	/**
    	 * Render the control's content.
    	 * 
    	 */
    	public $type = 'uniform_textarea';
        public function render_content() {
    ?>
    		<label>
    			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
    				<?php echo esc_textarea( $this->value() ); ?>
    			</textarea>
    		</label>
    <?php
    	}
    }
    
    /**
     * Section Re-order
     * A class to re-order section by using drag and drop 
     */

    class Uniform_Section_Re_Order extends WP_Customize_Control {
      
      public $type = 'dragndrop';
        /**
         * Render the content of section reorder
         *
         * @return HTML
         */
        public function render_content() {

            if ( empty( $this->choices ) ){
                return;
            }
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
              <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
        <ul class="controls" id ="uniform-sections-reorder">
        <?php
            $default_short_array = array();
            foreach ( $this->choices as $value => $label ) {
                $default_short_array[$value] = $label;
            }
            $order_save_value = get_theme_mod( $this->id );
            
            if ( !empty( $order_save_value ) ) {
                $order_save_array = explode( ',' , $order_save_value );
                $order_save_array_pop = array_pop( $order_save_array );
                foreach ($order_save_array as $key => $value) {
        ?>
                    <li class="uniform-section-element" data-section-name="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $default_short_array[$value] ); ?></li>
        <?php      
                }
                $section_order_list = $order_save_value;
            } else {
                $order_array = array();
                foreach ( $this->choices as $value => $label ) {
                    $order_array[] = $value;
        ?>
                    <li class="uniform-section-element" data-section-name="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></li>
        <?php
                }
                $section_order_list = implode ( "," , $order_array );
            }
        ?>
        <input id="shortui-order" type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $section_order_list ); ?>" />
        </ul>
    <?php
        }
    }

    /**
     * Theme info 
     */
     class Uniform_Theme_Info extends WP_Customize_Control {
        public $type = 'uniform_theme_info';
        public $label = '';
        public function render_content() {
    ?>
            <label class="customize-control-select">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
            </label>
        <?php
        }
    }
    
/*------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Radio image customize control.
     *
     * @since  1.2.9
     * @access public
     */
    class Uniform_Customize_Control_Radio_Image extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'radio-image';

        /**
         * Loads the jQuery UI Button script and custom scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();

            // We need to make sure we have the correct image URL.
            foreach ( $this->choices as $value => $args )
                $this->choices[ $value ]['url'] = esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) );

            $this->json['choices'] = $this->choices;
            $this->json['link']    = $this->get_link();
            $this->json['value']   = $this->value();
            $this->json['id']      = $this->id;
        }


        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */

        public function content_template() { ?>
            <# if ( data.label ) { #>
                <span class="customize-control-title">{{ data.label }}</span>
            <# } #>

            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <div class="buttonset">

                <# for ( key in data.choices ) { #>

                    <input type="radio" value="{{ key }}" name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" {{{ data.link }}} <# if ( key === data.value ) { #> checked="checked" <# } #> /> 

                    <label for="{{ data.id }}-{{ key }}">
                        <span class="screen-reader-text">{{ data.choices[ key ]['label'] }}</span>
                        <img src="{{ data.choices[ key ]['url'] }}" title="{{ data.choices[ key ]['label'] }}" alt="{{ data.choices[ key ]['label'] }}" />
                    </label>
                <# } #>

            </div><!-- .buttonset -->
        <?php }
    } //end class
    
} //endif

/*------------------------------------------------------------------------------------------------------------------------------------*/
if ( class_exists( 'WP_Customize_Section' ) ) {

    /**
     * Upsell customizer section.
     *
     * @since  1.3.3
     * @access public
     */
    class Uniform_Customize_Section_Upsell extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'upsell';

        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_text = '';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_url = '';

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();

            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() { ?>

            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
                <h3 class="accordion-section-title">
                    {{ data.title }}

                    <# if ( data.pro_text && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>
        <?php }
    } //end class
} //endif