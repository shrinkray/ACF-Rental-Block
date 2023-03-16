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
        'class' => 'accordion'
    ]
);
?>



<div <?= $wrapper_attributes ?>>

        <?php if ( have_rows( 'rental_item' ) ) : ?>
            <?php while ( have_rows( 'rental_item' ) ) : the_row();
                $type = get_sub_field( 'rental_type' );
                ?>

                <div class="rental">


                <?php if ( have_rows( 'rental_detail' ) ) : ?>
                    <?php while ( have_rows( 'rental_detail' ) ) : the_row();
                        $heading = get_sub_field( 'detail_item' );
                        $content = get_sub_field( 'detail_content' );

                        ?>
                        <h2><?= esc_html( $type ) ?></h2>
                        <h3><?= esc_html( $heading ) ?></h3>
                        <p><?= esc_html($content) ?></p>


                    <?php endwhile; ?>
                <?php else : ?>
                    <?php // No rows found ?>
                <?php endif; ?>
                <?php 	$rental_gallery_ids = get_sub_field( 'rental_gallery' );
                $size = 'thumbnail';
                ?>

                <?php if ( $rental_gallery_ids ) :  ?>
                    <?php foreach ( $rental_gallery_ids as $rental_gallery_id ): ?>
                        <?php echo wp_get_attachment_image( $rental_gallery_id, $size ); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endwhile; ?>

            </div> <!-- .rental -->

        <?php else : ?>
            <?php // No rows found ?>
        <?php endif; ?>

</div>
