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

    <?php // Flexible Content
    if ( have_rows( 'order_rentals' ) ): ?>
        <?php while ( have_rows( 'order_rentals' ) ) : the_row(); ?>
            <?php if ( get_row_layout() == 'spaces' ) : ?>

                <?php  // Repeater
                    if ( have_rows( 'rental_item' ) ) : ?>
                    <?php while ( have_rows( 'rental_item' ) ) : the_row();
                        $type  = get_sub_field( 'rental_type' );
                        $name  = get_sub_field( 'rental_name' );
                        $image = get_sub_field( 'rental_image' );
                        $size  = get_sub_field( 'full' ); // TODO: set this up
                        ?>

                    <div class="rental-card">

                        <?php if ( $image ) : ?>
                        <div class="card-image">
                            <?php echo wp_get_attachment_image( $image, $size ); ?>
                        </div>
                        <?php endif; ?>

                        <h3 class="rental-name"><?= esc_html( $name ) ?></h3>
                        <p class="rental-desc"><?= esc_html($type) ?></p>
                        <ul class="rental-deets">

                            <?php // Repeater
                                if ( have_rows( 'rental_detail' ) ) : ?>
                            <li>
                                <?php while ( have_rows( 'rental_detail' ) ) : the_row();
                                    $item = get_sub_field( 'detail_item' );

                                    ?>

                                <?= esc_html($item) ?>



                                <?php endwhile; ?>
                            </li>
                            <?php else : ?>
                                <?php // No rows found ?>
                            <?php endif; // rental_detail repeater ?>
                        </ul>
                         <!--  image gallery removed -->
                    </div> <!-- .rental -->
                    <?php endwhile; ?>


                <?php else : ?>
                    <?php // No rows found ?>
                <?php endif; // end repeater ?>

            <?php endif; ?>
        <?php endwhile; // order_rentals ?>
    <?php else: ?>
        <?php // No layouts found ?>
    <?php endif; // order_rentals flex content ?>

</div>
