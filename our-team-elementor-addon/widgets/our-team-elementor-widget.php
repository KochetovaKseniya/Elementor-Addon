<?php
use \Elementor\Widget_Base;

use \Elementor\Controls_Manager;

class Our_Team_Elementor_Widget extends Widget_Base {

    public function get_name() {
        return 'our_team_elementor_widget';
    }

    public function get_title() {
        return esc_html__('Our Team', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_categories() {
        return ['basic'];
    }

    public function get_keywords() {
        return ['hello', 'world'];
    }

    protected function _register_controls() {
 
        // Section Content Controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Elements', 'elementor-addon'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text_content',
            [
                'label' => esc_html__('Text Content', 'elementor-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Default text content',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'blocks',
            [
                'label' => esc_html__('Blocks', 'elementor-addon'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text_content' => 'Default text content',
                        'image' => '',
                    ],
                ],
                'title_field' => '{{{ text_content }}}',
            ]
        );

        $this->end_controls_section();

        // Layout Controls
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout', 'elementor-addon'),
            ]
        );
    
        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__('Elements per column', 'elementor-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 4, 
                    ],
                    'tablet' => [
                        'min' => 1,
                        'max' => 3, 
                    ],
                    'mobile' => [
                        'min' => 1,
                        'max' => 2, 
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 3,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 1,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .your-column-class' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'enable_slider',
            [
                'label' => esc_html__('Enable Slider', 'elementor-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'elementor-addon'),
                'label_off' => esc_html__('No', 'elementor-addon'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'slides_spacebetween',
            [
                'label' => esc_html__('Slides - spacebetween', 'elementor-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => 30,
                'condition' => [
                    'enable_slider' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        // Style Section Controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'elementor-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Text Typography', 'elementor-addon'),
                'selector' => '{{WRAPPER}} .team__item p',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'elementor-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team__item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $columns_desktop = isset($settings['columns']['size']) ? $settings['columns']['size'] : 3;
        $columns_tablet = isset($settings['columns_tablet']['size']) ? $settings['columns_tablet']['size'] : 2;
        $columns_mobile = isset($settings['columns_mobile']['size']) ? $settings['columns_mobile']['size'] : 1;
        
        $enable_slider = $settings['enable_slider'] === 'yes';
        $slides_spacebetween = $settings['slides_spacebetween'];
        ?>
        <?php if ($enable_slider) { ?>
            <style>
 
            </style>
        <?php } else { ?>
            <style>
                .team__list {
                    display: grid;
                    gap: 20px;
                }
                @media (min-width: 1025px) {
                    .team__list {
                        grid-template-columns: repeat(<?php echo $columns_desktop; ?>, 1fr);
                    }
                }
                @media (max-width: 1024px) and (min-width: 768px) {
                    .team__list {
                        grid-template-columns: repeat(<?php echo $columns_tablet; ?>, 1fr);
                    }
                }
                @media (max-width: 767px) {
                    .team__list {
                        grid-template-columns: repeat(<?php echo $columns_mobile; ?>, 1fr);
                    }
                }
            </style>
        <?php } ?>
        <div class="team__list">
            <?php if ($enable_slider) { ?>
                <div class="swiper-container">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>

                    <div class="swiper-wrapper">
            <?php } ?>
                        
                    <?php
                    foreach ($settings['blocks'] as $block) {
                        $text_content = isset($block['text_content']) ? $block['text_content'] : '';
                        $image_url = isset($block['image']['url']) ? $block['image']['url'] : '';

                        ?>
                        <?php if ($enable_slider) { echo '<div class="swiper-slide">'; } ?>
                        <div class="team__item ">
                            <div class="team__item--img">
                                <img src="<?php echo $image_url; ?>" alt="Image">
                            </div>
                            <p><?php echo $text_content; ?></p>
                        </div>
                        <?php
                        if ($enable_slider) { echo '</div>'; } 
                    }
                    ?>
                <?php if ($enable_slider) { ?>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            let columnsDesktop = <?php echo $columns_desktop; ?>;
                            let columnsTablet = <?php echo $columns_tablet; ?>;
                            let columnsMobile = <?php echo $columns_mobile; ?>;
                            let spaceBetween = <?php echo $slides_spacebetween; ?>;

                            var swiper = new Swiper('.swiper-container', {
                                slidesPerView: columnsMobile,
                                slidesPerGroup: columnsMobile,
                                pagination: {
                                    el: '.swiper-pagination',
                                    clickable: true,
                                },
                                spaceBetween: spaceBetween,
                                breakpoints: {
                                    767: {
                                        slidesPerView: columnsTablet,
                                        slidesPerGroup: columnsTablet
                                    },
                                    1260: {
                                        slidesPerView: columnsDesktop,
                                        slidesPerGroup: columnsDesktop
                                    }
                                },
                                navigation: {
                                    nextEl: ".swiper-button-next",
                                    prevEl: ".swiper-button-prev",
                                }
                            });
                        });
                    </script>

                <?php } ?>

        </div>

        <?php
    }
}
?>
