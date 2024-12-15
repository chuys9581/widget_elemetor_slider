<?php
class Elementor_Image_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'image_slider_widget';
    }

    public function get_title() {
        return __('Image Slider Widget', 'elementor-image-slider-widget');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-image-slider-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Choose Image', 'elementor-image-slider-widget'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __('Link', 'elementor-image-slider-widget'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'elementor-image-slider-widget'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __('Slides', 'elementor-image-slider-widget'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => __('Slide', 'elementor-image-slider-widget'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="swiper-container image-slider-widget">
            <div class="swiper-wrapper">
                <?php foreach ($settings['slides'] as $slide) : ?>
                    <div class="swiper-slide">
                        <?php if (!empty($slide['link']['url'])) : ?>
                            <a href="<?php echo esc_url($slide['link']['url']); ?>" 
                               <?php echo $slide['link']['is_external'] ? 'target="_blank"' : ''; ?>
                               <?php echo $slide['link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                        <?php endif; ?>
                        <img src="<?php echo esc_url($slide['image']['url']); ?>" alt="Slide Image">
                        <?php if (!empty($slide['link']['url'])) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <?php
    }

    public function get_script_depends() {
        return ['swiper'];
    }

    public function get_style_depends() {
        return ['swiper'];
    }
}