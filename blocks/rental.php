<?php
/**
 * Block template file: rental.php
 *
 * Rental Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */


$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'rental'
    ]
);
?>



<div <?= $wrapper_attributes ?>>

    <?php  // Repeater
    if ( have_rows( 'rental_item' ) ) : ?>
        <?php while ( have_rows( 'rental_item' ) ) : the_row();
            $type       = get_sub_field( 'rental_type' );
            $name       = get_sub_field( 'rental_name' );
            $cost       = get_sub_field( 'rental_cost' );
            $dims       = get_sub_field( 'dimensions' );


            $is_vacancy = get_sub_field( 'is_vacancy' );
            $is_hidden  = get_sub_field( 'hide_rental' );

            // set classnames
            $is_vacancy ? $avail = 'is-avail' : $avail = 'not-avail';
            $is_hidden ? $show = 'show' : $show = 'hide';

            $extras = get_sub_field( 'rental_extras' );
            ?>

            <div class="rental-card">



                <h3 class="rental-name"><?= esc_html( $name ) ?></h3>
                <p class="rental-desc"><?= esc_html($type) ?></p>


                <?php
                /**
                 * This code adds a comma after each item, except for the last one,
                 * by comparing the current counter value with the total number of items in the $extras array.
                 */

                if ( $extras ):
                    $count = 0; $total = count($extras);
                    foreach ( $extras as $extra ):
                        $count++;
                        echo esc_html( $extra['label'] );
                        if ( $count != $total ):
                            echo ', ';
                        endif;
                    endforeach;
                endif; ?>

            </div> <!-- .rental -->
        <?php endwhile; ?>


    <?php else : ?>
        <?php // No rows found ?>
    <?php endif; // end repeater ?>

</div>
