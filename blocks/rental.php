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
    if ( have_rows( 'rental_item' ) ) :

        while ( have_rows( 'rental_item' ) ) : the_row();

        // vars
            $show = '';
            $type       = get_sub_field( 'rental_type' );
            $name       = get_sub_field( 'rental_name' );
            $cost       = get_sub_field( 'rental_cost' );
            $dims       = get_sub_field( 'dimensions' );
            $extras     = get_sub_field( 'rental_extras' );
            $is_vacancy = get_sub_field( 'is_vacancy' );
            $is_hidden  = get_sub_field( 'hide_rental' );

        // set classnames
            $is_vacancy ? $avail = 'open' : $avail = 'occupied';
            $is_hidden ? $show = 'hide' : $show = 'show';

            ?>

            <div class="rental-card <?= esc_html($show); ?>">
                <div class="header <?= esc_html($type['value']); ?>">

                    <h3 class="unit-desc"><?= esc_html($type['label']) ?></h3>

                    <div class="vacancy <?= esc_html( $avail ); ?>">
                        <span class=""><?= esc_html( $avail ); ?></span>
                    </div>
                </div>
                <div class="body">
                    <h4 class="unit-name"><?= esc_html( $name ) ?></h4>
                    <div class="unit-cost">
                        <span class="dollar-sign">$</span><span class="value"><?= esc_html($cost); ?></span><span class="range">/mo</span>
                    </div>
                    <div class="unit-dims">
                        <?= esc_html($dims); ?>
                    </div>
                    <div class="unit-extras">
                        <?php
                        /**
                         * This code adds a comma after each item, except for the last one,
                         */

                        if ( $extras ):
                            $count = 0; $total = count($extras);
                            foreach ( $extras as $extra ):
                                $count++;
                                echo esc_html( $extra['label'] ); ?>

                                <?= ( $count != $total ) ? ', ' :  ''  ?>

                            <?php
                            endforeach;
                        endif; ?>
                    </div>

                </div>
                <div class="footer">
                    <label for="#button">
                        <button class="btn" id="button">Interested?</button>
                    </label>
                </div>




            </div> <!-- .rental -->
        <?php endwhile; ?>


    <?php else : ?>
        <?php // No rows found ?>
    <?php endif; // end repeater ?>

</div>
