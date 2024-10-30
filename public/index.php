<?php

defined('ABSPATH') or die("No script kiddies please!");

function chathispano_webchat_page( $atts ) {
    $url = CHATHISPANO_WEBCHAT_URLBASE."?";

    if (get_option('chathispano_webchat_theme') != '')
        $url = $url."theme=".get_option('chathispano_webchat_theme');
    else
        $url = $url."theme=chathispano";

    if (get_option('chathispano_webchat_layout') != '')
        $url = $url."&layout=".get_option('chathispano_webchat_layout');

    if (get_option('chathispano_webchat_autojoin'))
        $url = $url."&autojoin=true";
    else
        $url = $url."&autojoin=false";

    if (get_option('chathispano_webchat_nick') != '')
        //$url = $url."&nick=".get_option('chathispano_webchat_nick');
        $url = $url."&nick=".str_replace("?", rand(10000,99999), get_option('chathispano_webchat_nick'));

//    if (get_option('chathispano_webchat_realname') != '')
//        $url = $url."&realname=".rawurlencode(get_option('chathispano_webchat_realname'));

    $channels = isset($atts['chan']) ? $atts['chan'] : '';
    if ($channels == '')
        $channels = get_option('chathispano_webchat_chan');
    if ($channels != '')
        $url = $url.$channels;

?>
    <center>
        <iframe
            marginwidth="0"
            marginheight="0"
            src="<?php echo $url; ?>"
<?php
    if (get_option('chathispano_webchat_width') != '')
        echo "width=\"".get_option('chathispano_webchat_width')."\"";
    if (get_option('chathispano_webchat_height') != '')
        echo "height=\"".get_option('chathispano_webchat_height')."\"";
?>
            scrolling="no"
            frameborder="0">
        </iframe>
    </center>
<?php
}

function chathispano_webchat( $atts ) {
    ob_start();
    chathispano_webchat_page( $atts );

    return ob_get_clean();
}

add_shortcode( 'chathispano_webchat', 'chathispano_webchat' );
add_shortcode( 'chathispano_kiwi', 'chathispano_webchat' );
?>
