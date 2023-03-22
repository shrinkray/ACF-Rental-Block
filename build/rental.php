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

    <?php
    $btn_link   = get_field( 'link' );
    // Repeater
    if ( have_rows( 'rental_item' ) ) :

        while ( have_rows( 'rental_item' ) ) : the_row();

        // vars
            $show       = '';
            $avail      = 'test';
            $vacancy    = 'test';
            $type       = get_sub_field( 'rental_type' );
            $name       = get_sub_field( 'rental_name' );
            $cost       = get_sub_field( 'rental_cost' );
            $cost_note  = get_sub_field( 'cost_note' );
            $dims       = get_sub_field( 'dimensions' );
            $extras     = get_sub_field( 'rental_extras' );
            $btn_label  = get_sub_field( 'label' );
            $is_vacancy = get_sub_field( 'is_vacancy' );
            $is_hidden  = get_sub_field( 'hide_rental' );


        // set classnames

        switch ( $is_vacancy['value'] ) {
            case 1:
                $avail = 'open';
                $vacancy = 'Open';
                break;
            case 2:
                $avail = 'occupied';
                $vacancy = 'Occupied';
                break;
            case 3:
                $avail = 'available';
                $vacancy = 'Available Soon';
                break;
        }

            $is_hidden ? $show = 'hide' : $show = 'show';

            ?>

            <div class="rental-card <?= esc_html($show); ?>">
                <div class="header <?= esc_html($type['value']); ?>">

                    <h3 class="unit-desc"><?= esc_html($type['label']) ?></h3>

                    <div class="vacancy <?= esc_html( $avail ); ?>">
                        <span><?= esc_html( $vacancy ); ?></span>
                    </div>
                </div>
                <div class="body">
                    <?php
                    if ( $name ) :
                    ?>
                    <h4 class="unit-name"><?= esc_html( $name ) ?></h4>

                    <?php else : ?>
                    <div class="unit-name"></div>
                    <?php
                    endif;
                    ?>

                    <?php // Code option for price, show a message for flex spaces

                    if ( $type['value'] !== 'flex' ) : ?>

                    <div class="unit-cost">
                        <span class="dollar-sign">$</span><span class="value"><?= esc_html($cost); ?></span><span
                                class="range">/mo</span>
                    </div>
                    <?php else : ?>

                    <div class="unit-cost flex-col ">
                        <span class="check-prices"><?= esc_html( $cost_note ); ?></span>
                    </div>

                    <?php endif; ?>
                    <div class="unit-dims">
                        <?= esc_html( $dims ); ?>
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
                                echo esc_html( $extra['label'] ); ?><?= ( $count != $total ) ? ', ' :  ''  ?>

                            <?php
                            endforeach;
                        endif; ?>
                    </div>

                </div>
                <div class="footer">
                <?php
                if ( $is_vacancy  ) :
                    ?>

                    <a class="btn" type="link" href="<?= esc_html($btn_link); ?>" target="_self"><?= esc_html( $btn_label ); ?></a>

                <?php else : // space is occupied ?>


                <?php endif; ?>
                </div>




            </div> <!-- .rental -->
        <?php endwhile; ?>


    <?php else : ?>
        <?php // No rows found ?>
    <?php endif; // end repeater ?>

</div>
