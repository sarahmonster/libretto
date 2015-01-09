<?php
/**
 * The template for displaying search forms in Readly
 *
 * @package Readly
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label class="screen-reader-text"><?php echo _x( 'Search for:', 'assistive text', 'readly' ) ?></label>
  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search for&hellip;', 'placeholder', 'readly' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'readly' ) ?>" />
  <p class="search-submit">
    <input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'readly' ) ?>" />
  </p>
</form>
