<?php
/**
 * Fast Link Widget
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master Widget
 */
class RecensilityFastLink extends WP_Widget{
   public $widget_ID;
    public $widget_name;
    public $widget_options = array();
    public $control_options = array();
    
    function __construct() {
        $this->widget_ID = 'recensility_news_reader';
	$this->widget_name = 'Recensility News Reader Widget';
        
        $this->widget_options = array(
            'classname' => $this->widget_ID,
            'description' => $this->widget_name,
            'customize_selective_refresh' => true,
	);

	$this->control_options = array(
            'width' => 400,
            'height' => 350
	);
    }
    
    public function register(){
	parent::__construct( $this->widget_ID, $this->widget_name, $this->widget_options, $this->control_options );
        add_action( 'widgets_init', array( $this, 'widgetsInit' ) );
    }

    public function widgetsInit(){
	register_widget( $this );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
            
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
            
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Titolo', 'recensility_news_reader_widget_title' );
    ?>
<p>Ricorda che puoi modificare le impostazioni del widget nel plugin</p>    
<p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html__( 'Titolo', 'recensility_news_reader_widget_title' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
    </p>
    <?php 
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );

        return $instance;
    }
}

