<?php
/**
 * Plugin Name: Snowfall
 * Description: This plugin adds a snowfall effect to your WordPress site.
 * Version: 1.0
 * Author: Bard
 * Author URI: https://bard.ai
 */

add_action( 'wp_enqueue_scripts', function() {
    // Enqueue the snowfall script
    wp_enqueue_script( 'snowfall', plugins_url( 'snowfall.js', __FILE__ ), [ 'jquery' ], null, true );

    // Add the snowfall data to the global scope
    $snowfall_data = [
        'speed' => 100, // The speed of the snowflakes in pixels per second
        'size' => 20, // The size of the snowflakes in pixels
        'color' => '#ffffff', // The color of the snowflakes
    ];
    $GLOBALS['snowfall_data'] = $snowfall_data;
});

add_action( 'wp_footer', function() {
    // Output the snowfall script
    ?>
    <script>
        (function($) {
            $(document).ready(function() {
                // Create a snowfall instance
                var snowfall = new Snowfall(<?php echo json_encode( $GLOBALS['snowfall_data'] ); ?>);

                // Add the snowfall instance to the document
                $('body').append(snowfall.el);
            });
        })(jQuery);
    </script>
    <?php
});
