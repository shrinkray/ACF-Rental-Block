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
            $is_promo   = get_sub_field( 'is_promo' );
            $push       = get_sub_field( 'push_feature' );
            $banner     = get_sub_field( 'push_banner' );


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
                    $vacancy = 'Coming Soon';
                    break;
            }

            $is_hidden ? $show = 'hide' : $show = 'show';

            ?>

            <div class="rental-card <?= esc_html($show); ?>">

            <?php

            if ( $is_promo ) :

                if ( $push === '1' ) : // Great Deal!
            ?>
                <div class="promo-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" viewBox="0 0 53 55">
  <g transform="matrix(.78816 0 0 .85107 -64.116 -177.839)">
      <rect width="66.971" height="63.639" x="81.349" y="208.959" style="fill:none;"/>
      <path d="m108.153 198.625 7.691 8.021 10.806-2.589 2.134 10.905 10.491 3.664-4.101 10.328 6.845 8.755-9.034 6.471 1.025 11.065-11.098.56-5.12 9.863-9.639-5.529-9.64 5.529-5.119-9.863-11.099-.56 1.025-11.065-9.033-6.471 6.844-8.755-4.101-10.328 10.491-3.664 2.134-10.905 10.807 2.589 7.691-8.021Z" style="fill:rgb(189,0,0);" transform="matrix(.9647 0 0 .8934 10.63 33.363)"/>
      <text x="400.341" y="190.837" style="font-family:'RobotoSlab-Black', 'Roboto Slab';font-size:12px;fill:white;" transform="matrix(1.26878 0 0 1.17499 -411.579 14.71)">Great</text>
      <text x="401.566" y="202.922" style="font-family:'RobotoSlab-Black', 'Roboto Slab';font-size:12px;fill:white;" transform="matrix(1.26878 0 0 1.17499 -411.579 14.71)">Deal!</text>
  </g>
</svg>
                </div>
            <?php

                elseif ( $push === '2') : // Special
            ?>
                <div class="promo-ribbon ribbon-top-right">
                    <span>SPECIAL</span>
                </div>
            <?php

                endif;

            endif;
            ?>
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
                if ( $is_vacancy['value'] === '1'  ||  $is_vacancy['value'] === '3' ) :
                    ?>

                    <a class="btn" type="link" href="<?= esc_html($btn_link); ?>" target="_self"><?= esc_html( $btn_label ); ?></a>

                <?php else : // space is occupied ?>


                <?php endif; ?>
                </div>




            </div> <!-- .rental -->
        <?php
        endwhile
        ?>


    <?php else : ?>
        <?php // No rows found ?>
    <?php endif; // end repeater ?>

</div>