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

        $this->add_control(
            'badge_text',
            array(
                'label'       => esc_html__( 'Badge Text', 'cempur-before-after-slider' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__( 'New', 'cempur-before-after-slider' ),
            )
        );

        $this->add_control(
            'headline_text',
            array(
                'label'       => esc_html__( 'Headline', 'cempur-before-after-slider' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__( 'Before/After Comparison', 'cempur-before-after-slider' ),
            )
        );

        $this->add_control(
            'subtext_text',
            array(
                'label'       => esc_html__( 'Subtext', 'cempur-before-after-slider' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => esc_html__( 'Add a short supporting text.', 'cempur-before-after-slider' ),
                'rows'        => 3,
            )
        );

        $this->add_control(
            'button_text',
            array(
                'label'       => esc_html__( 'Button Text', 'cempur-before-after-slider' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__( 'Learn More', 'cempur-before-after-slider' ),
            )
        );

        $this->add_control(
            'button_link',
            array(
                'label'         => esc_html__( 'Button Link', 'cempur-before-after-slider' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => 'https://example.com',
                'show_external' => true,
                'default'       => array(
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => false,
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
                'label'      => esc_html__( 'Initial Handle Position', 'cempur-before-after-slider' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array( '%' ),
                'range'      => array(
                    '%' => array(
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ),
                ),
                'default'    => array(
                    'size' => 50,
                    'unit' => '%',
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

        $this->add_control(
            'label_placement',
            array(
                'label'   => esc_html__( 'Before/After Label Placement', 'cempur-before-after-slider' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'top',
                'options' => array(
                    'top'    => esc_html__( 'Top', 'cempur-before-after-slider' ),
                    'bottom' => esc_html__( 'Bottom', 'cempur-before-after-slider' ),
                    'hidden' => esc_html__( 'Hidden', 'cempur-before-after-slider' ),
                ),
            )
        );

        $this->add_control(
            'enable_fullscreen',
            array(
                'label'        => esc_html__( 'Enable Fullscreen Button', 'cempur-before-after-slider' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'cempur-before-after-slider' ),
                'label_off'    => esc_html__( 'No', 'cempur-before-after-slider' ),
                'return_value' => 'yes',
                'default'      => 'no',
            )
        );

        $this->add_control(
            'enable_lazy_loading',
            array(
                'label'        => esc_html__( 'Enable Native Lazy Loading', 'cempur-before-after-slider' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'cempur-before-after-slider' ),
                'label_off'    => esc_html__( 'No', 'cempur-before-after-slider' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            array(
                'label' => esc_html__( 'Global Button Styles', 'cempur-before-after-slider' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .cempur-ba-cta',
            )
        );

        $this->add_control(
            'button_text_color',
            array(
                'label'     => esc_html__( 'Text Color', 'cempur-before-after-slider' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .cempur-ba-cta' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'button_background_color',
            array(
                'label'     => esc_html__( 'Background Color', 'cempur-before-after-slider' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .cempur-ba-cta' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'button_border_color',
            array(
                'label'     => esc_html__( 'Border Color', 'cempur-before-after-slider' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .cempur-ba-cta' => 'border-color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'button_border_width',
            array(
                'label'      => esc_html__( 'Border Width', 'cempur-before-after-slider' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array( 'px' ),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 8,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .cempur-ba-cta' => 'border-width: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'button_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'cempur-before-after-slider' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array( 'px' ),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 60,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .cempur-ba-cta' => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'button_padding',
            array(
                'label'      => esc_html__( 'Padding', 'cempur-before-after-slider' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', 'em', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .cempur-ba-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'button_hover_text_color',
            array(
                'label'     => esc_html__( 'Hover Text Color', 'cempur-before-after-slider' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .cempur-ba-cta:hover, {{WRAPPER}} .cempur-ba-cta:focus-visible' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'button_hover_background_color',
            array(
                'label'     => esc_html__( 'Hover Background Color', 'cempur-before-after-slider' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .cempur-ba-cta:hover, {{WRAPPER}} .cempur-ba-cta:focus-visible' => 'background-color: {{VALUE}};',
                ),
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

        $orientation  = ! empty( $settings['orientation'] ) && 'vertical' === $settings['orientation'] ? 'vertical' : 'horizontal';
        $raw_position = isset( $settings['initial_handle_position']['size'] ) ? floatval( $settings['initial_handle_position']['size'] ) : 50;
        $position     = $raw_position > 1 ? $raw_position / 100 : $raw_position;
        $position     = max( 0, min( 1, $position ) );

        $before_text      = isset( $settings['before_text'] ) ? $settings['before_text'] : '';
        $after_text       = isset( $settings['after_text'] ) ? $settings['after_text'] : '';
        $badge_text       = isset( $settings['badge_text'] ) ? $settings['badge_text'] : '';
        $headline_text    = isset( $settings['headline_text'] ) ? $settings['headline_text'] : '';
        $subtext_text     = isset( $settings['subtext_text'] ) ? $settings['subtext_text'] : '';
        $button_text      = isset( $settings['button_text'] ) ? $settings['button_text'] : '';
        $button_url       = ! empty( $settings['button_link']['url'] ) ? $settings['button_link']['url'] : '';
        $button_external  = ! empty( $settings['button_link']['is_external'] );
        $button_nofollow  = ! empty( $settings['button_link']['nofollow'] );
        $button_rel_parts = array();
        if ( $button_external ) {
            $button_rel_parts[] = 'noopener';
            $button_rel_parts[] = 'noreferrer';
        }
        if ( $button_nofollow ) {
            $button_rel_parts[] = 'nofollow';
        }
        $button_rel = implode( ' ', $button_rel_parts );
        $label_placement  = isset( $settings['label_placement'] ) ? $settings['label_placement'] : 'top';
        $valid_placements = array( 'top', 'bottom', 'hidden' );
        if ( ! in_array( $label_placement, $valid_placements, true ) ) {
            $label_placement = 'top';
        }

        $enable_fullscreen = ! empty( $settings['enable_fullscreen'] ) && 'yes' === $settings['enable_fullscreen'];
        $enable_lazy       = ! isset( $settings['enable_lazy_loading'] ) || 'yes' === $settings['enable_lazy_loading'];
        $loading_attr      = $enable_lazy ? 'lazy' : 'eager';

        $has_overlay = '' !== trim( $badge_text ) || '' !== trim( $headline_text ) || '' !== trim( $subtext_text ) || ( '' !== trim( $button_text ) && '' !== trim( $button_url ) );

        $uid = 'cempur-ba-' . $this->get_id();
        ?>
        <div
            id="<?php echo esc_attr( $uid ); ?>"
            class="cempur-ba-slider cempur-ba-labels-<?php echo esc_attr( $label_placement ); ?>"
            data-orientation="<?php echo esc_attr( $orientation ); ?>"
            data-position="<?php echo esc_attr( $position ); ?>"
        >
            <div class="cempur-ba-image cempur-ba-image-after">
                <img src="<?php echo esc_url( $after_image_url ); ?>" alt="<?php echo esc_attr( $after_text ); ?>" loading="<?php echo esc_attr( $loading_attr ); ?>" decoding="async" />
            </div>

            <div class="cempur-ba-image cempur-ba-image-before">
                <img src="<?php echo esc_url( $before_image_url ); ?>" alt="<?php echo esc_attr( $before_text ); ?>" loading="<?php echo esc_attr( $loading_attr ); ?>" decoding="async" />
            </div>

            <?php if ( '' !== $before_text ) : ?>
                <span class="cempur-ba-label cempur-ba-label-before"><?php echo esc_html( $before_text ); ?></span>
            <?php endif; ?>

            <?php if ( '' !== $after_text ) : ?>
                <span class="cempur-ba-label cempur-ba-label-after"><?php echo esc_html( $after_text ); ?></span>
            <?php endif; ?>

            <?php if ( $has_overlay ) : ?>
                <div class="cempur-ba-overlay">
                    <?php if ( '' !== trim( $badge_text ) ) : ?>
                        <span class="cempur-ba-badge"><?php echo esc_html( $badge_text ); ?></span>
                    <?php endif; ?>

                    <?php if ( '' !== trim( $headline_text ) ) : ?>
                        <h3 class="cempur-ba-headline"><?php echo esc_html( $headline_text ); ?></h3>
                    <?php endif; ?>

                    <?php if ( '' !== trim( $subtext_text ) ) : ?>
                        <p class="cempur-ba-subtext"><?php echo esc_html( $subtext_text ); ?></p>
                    <?php endif; ?>

                    <?php if ( '' !== trim( $button_text ) && '' !== trim( $button_url ) ) : ?>
                        <a
                            class="cempur-ba-cta"
                            href="<?php echo esc_url( $button_url ); ?>"
                            <?php if ( $button_external ) : ?>target="_blank"<?php endif; ?>
                            <?php if ( '' !== $button_rel ) : ?>rel="<?php echo esc_attr( $button_rel ); ?>"<?php endif; ?>
                        >
                            <?php echo esc_html( $button_text ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( $enable_fullscreen ) : ?>
                <button type="button" class="cempur-ba-fullscreen" aria-label="<?php esc_attr_e( 'Toggle fullscreen', 'cempur-before-after-slider' ); ?>">
                    <span aria-hidden="true">⤢</span>
                </button>
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

        const orientation = settings.orientation === 'vertical' ? 'vertical' : 'horizontal';
        const sliderPositionRaw = settings.initial_handle_position && settings.initial_handle_position.size !== undefined
            ? parseFloat( settings.initial_handle_position.size )
            : 50;

        const sliderPosition = sliderPositionRaw > 1 ? sliderPositionRaw / 100 : sliderPositionRaw;
        const position = Math.max( 0, Math.min( 1, sliderPosition ) );
        const beforeText = settings.before_text ? settings.before_text : '';
        const afterText = settings.after_text ? settings.after_text : '';
        const badgeText = settings.badge_text ? settings.badge_text : '';
        const headlineText = settings.headline_text ? settings.headline_text : '';
        const subtextText = settings.subtext_text ? settings.subtext_text : '';
        const buttonText = settings.button_text ? settings.button_text : '';
        const buttonUrl = settings.button_link && settings.button_link.url ? settings.button_link.url : '';
        const labelPlacement = settings.label_placement ? settings.label_placement : 'top';
        const enableFullscreen = settings.enable_fullscreen === 'yes';
        const loadingAttr = settings.enable_lazy_loading === 'no' ? 'eager' : 'lazy';
        const hasOverlay = !!( badgeText || headlineText || subtextText || ( buttonText && buttonUrl ) );
        #>
        <div class="cempur-ba-slider cempur-ba-labels-{{ labelPlacement }}" data-orientation="{{ orientation }}" data-position="{{ position }}">
            <div class="cempur-ba-image cempur-ba-image-after">
                <img src="{{ afterImageUrl }}" alt="{{ afterText }}" loading="{{ loadingAttr }}" decoding="async" />
            </div>

            <div class="cempur-ba-image cempur-ba-image-before">
                <img src="{{ beforeImageUrl }}" alt="{{ beforeText }}" loading="{{ loadingAttr }}" decoding="async" />
            </div>

            <# if ( beforeText ) { #>
                <span class="cempur-ba-label cempur-ba-label-before">{{{ beforeText }}}</span>
            <# } #>

            <# if ( afterText ) { #>
                <span class="cempur-ba-label cempur-ba-label-after">{{{ afterText }}}</span>
            <# } #>

            <# if ( hasOverlay ) { #>
                <div class="cempur-ba-overlay">
                    <# if ( badgeText ) { #>
                        <span class="cempur-ba-badge">{{{ badgeText }}}</span>
                    <# } #>

                    <# if ( headlineText ) { #>
                        <h3 class="cempur-ba-headline">{{{ headlineText }}}</h3>
                    <# } #>

                    <# if ( subtextText ) { #>
                        <p class="cempur-ba-subtext">{{{ subtextText }}}</p>
                    <# } #>

                    <# if ( buttonText && buttonUrl ) { #>
                        <a class="cempur-ba-cta" href="{{ buttonUrl }}"
                            <# if ( settings.button_link && settings.button_link.is_external ) { #>target="_blank"<# } #>
                            <# if ( settings.button_link && ( settings.button_link.is_external || settings.button_link.nofollow ) ) { #>
                                rel="<# if ( settings.button_link.is_external ) { #>noopener noreferrer <# } #><# if ( settings.button_link.nofollow ) { #>nofollow<# } #>"
                            <# } #>
                        >
                            {{{ buttonText }}}
                        </a>
                    <# } #>
                </div>
            <# } #>

            <# if ( enableFullscreen ) { #>
                <button type="button" class="cempur-ba-fullscreen" aria-label="<?php esc_attr_e( 'Toggle fullscreen', 'cempur-before-after-slider' ); ?>">
                    <span aria-hidden="true">⤢</span>
                </button>
            <# } #>

            <button type="button" class="cempur-ba-handle" aria-label="<?php esc_attr_e( 'Drag to compare images', 'cempur-before-after-slider' ); ?>">
                <span aria-hidden="true" class="cempur-ba-handle-icon"></span>
            </button>
        </div>
        <?php
    }
}
