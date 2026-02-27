<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Cempur_Before_After_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'cempur_before_after';
    }

    public function get_title() {
        return esc_html__( 'SliderWP Before/After', 'cempur-before-after-slider' );
    }

    public function get_icon() {
        return 'eicon-image-before-after';
    }

    public function get_categories() {
        return array( 'basic' );
    }

    public function get_style_depends() {
        return array( 'cempur-before-after-slider' );
    }

    public function get_script_depends() {
        return array( 'cempur-before-after-slider' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Slider Content', 'cempur-before-after-slider' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'before_image',
            array(
                'label'   => esc_html__( 'Before Image', 'cempur-before-after-slider' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ),
            )
        );

        $this->add_control(
            'after_image',
            array(
                'label'   => esc_html__( 'After Image', 'cempur-before-after-slider' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            array(
                'label' => esc_html__( 'Slider Settings', 'cempur-before-after-slider' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'orientation',
            array(
                'label'   => esc_html__( 'Orientation', 'cempur-before-after-slider' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => array(
                    'horizontal' => esc_html__( 'Horizontal', 'cempur-before-after-slider' ),
                    'vertical'   => esc_html__( 'Vertical', 'cempur-before-after-slider' ),
                ),
            )
        );

        $this->add_control(
            'initial_handle_position',
            array(
                'label' => esc_html__( 'Initial Handle Position', 'cempur-before-after-slider' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array( 'custom' ),
                'range' => array(
                    'custom' => array(
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.01,
                    ),
                ),
                'default' => array(
                    'size' => 0.5,
                ),
            )
        );

        $this->add_control(
            'before_text',
            array(
                'label'       => esc_html__( 'Before Label Text', 'cempur-before-after-slider' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Before', 'cempur-before-after-slider' ),
                'placeholder' => esc_html__( 'Before', 'cempur-before-after-slider' ),
            )
        );

        $this->add_control(
            'after_text',
            array(
                'label'       => esc_html__( 'After Label Text', 'cempur-before-after-slider' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'After', 'cempur-before-after-slider' ),
                'placeholder' => esc_html__( 'After', 'cempur-before-after-slider' ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $before_image_url = ! empty( $settings['before_image']['url'] ) ? $settings['before_image']['url'] : '';
        $after_image_url  = ! empty( $settings['after_image']['url'] ) ? $settings['after_image']['url'] : '';

        if ( empty( $before_image_url ) || empty( $after_image_url ) ) {
            return;
        }

        $orientation = ! empty( $settings['orientation'] ) ? $settings['orientation'] : 'horizontal';
        $position    = isset( $settings['initial_handle_position']['size'] ) ? floatval( $settings['initial_handle_position']['size'] ) : 0.5;

        $position = max( 0, min( 1, $position ) );

        $before_text = isset( $settings['before_text'] ) ? $settings['before_text'] : '';
        $after_text  = isset( $settings['after_text'] ) ? $settings['after_text'] : '';

        $uid = 'cempur-ba-' . $this->get_id();
        ?>
        <div
            id="<?php echo esc_attr( $uid ); ?>"
            class="cempur-ba-slider"
            data-orientation="<?php echo esc_attr( $orientation ); ?>"
            data-position="<?php echo esc_attr( $position ); ?>"
        >
            <div class="cempur-ba-image cempur-ba-image-after">
                <img src="<?php echo esc_url( $after_image_url ); ?>" alt="<?php echo esc_attr( $after_text ); ?>" />
            </div>

            <div class="cempur-ba-image cempur-ba-image-before">
                <img src="<?php echo esc_url( $before_image_url ); ?>" alt="<?php echo esc_attr( $before_text ); ?>" />
            </div>

            <?php if ( '' !== $before_text ) : ?>
                <span class="cempur-ba-label cempur-ba-label-before"><?php echo esc_html( $before_text ); ?></span>
            <?php endif; ?>

            <?php if ( '' !== $after_text ) : ?>
                <span class="cempur-ba-label cempur-ba-label-after"><?php echo esc_html( $after_text ); ?></span>
            <?php endif; ?>

            <button type="button" class="cempur-ba-handle" aria-label="<?php esc_attr_e( 'Drag to compare images', 'cempur-before-after-slider' ); ?>">
                <span aria-hidden="true" class="cempur-ba-handle-icon"></span>
            </button>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        const beforeImageUrl = settings.before_image && settings.before_image.url ? settings.before_image.url : '';
        const afterImageUrl = settings.after_image && settings.after_image.url ? settings.after_image.url : '';

        if ( ! beforeImageUrl || ! afterImageUrl ) {
            return;
        }

        const orientation = settings.orientation ? settings.orientation : 'horizontal';
        const sliderPosition = settings.initial_handle_position && settings.initial_handle_position.size !== undefined
            ? parseFloat( settings.initial_handle_position.size )
            : 0.5;

        const position = Math.max( 0, Math.min( 1, sliderPosition ) );
        const beforeText = settings.before_text ? settings.before_text : '';
        const afterText = settings.after_text ? settings.after_text : '';
        #>
        <div class="cempur-ba-slider" data-orientation="{{ orientation }}" data-position="{{ position }}">
            <div class="cempur-ba-image cempur-ba-image-after">
                <img src="{{ afterImageUrl }}" alt="{{ afterText }}" />
            </div>

            <div class="cempur-ba-image cempur-ba-image-before">
                <img src="{{ beforeImageUrl }}" alt="{{ beforeText }}" />
            </div>

            <# if ( beforeText ) { #>
                <span class="cempur-ba-label cempur-ba-label-before">{{{ beforeText }}}</span>
            <# } #>

            <# if ( afterText ) { #>
                <span class="cempur-ba-label cempur-ba-label-after">{{{ afterText }}}</span>
            <# } #>

            <button type="button" class="cempur-ba-handle" aria-label="<?php esc_attr_e( 'Drag to compare images', 'cempur-before-after-slider' ); ?>">
                <span aria-hidden="true" class="cempur-ba-handle-icon"></span>
            </button>
        </div>
        <?php
    }
}
