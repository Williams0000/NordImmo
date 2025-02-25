
<?php get_header(); ?>

<div class="single-property-container">
    <div class="container">
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="property-header">
                <h1><?php the_title(); ?></h1>
                <p class="property-meta">
                    <?php 
                    $location = get_post_meta(get_the_ID(), 'location', true);
                    if (!empty($location)) {
                        echo '<span class="property-location"><i class="fas fa-map-marker-alt"></i> ' . esc_html($location) . '</span>';
                    }
                    ?>
                    <?php
                    $price = get_post_meta(get_the_ID(), 'price', true);
                    echo $price ? '<span class="property-price">' . esc_html($price) . ' €</span>' : '<span class="property-price">Prix non communiqué</span>';
                    ?>
                </p>
            </div>

            <!-- Image principale -->
            <div class="property-main-image">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('large', ['class' => 'property-image']);
                } else {
                    echo '<div class="property-no-image">Pas d\'image disponible</div>';
                } ?>
            </div>

            <!-- Galerie d’images -->
            <div class="property-gallery">
                <?php
                $gallery = get_post_meta(get_the_ID(), 'property_gallery', true);
                if (!empty($gallery)) {
                    $images = explode(',', $gallery);
                    echo '<div class="gallery-grid">';
                    foreach ($images as $image_id) {
                        echo wp_get_attachment_image($image_id, 'medium', false, ['class' => 'gallery-image']);
                    }
                    echo '</div>';
                }
                ?>
            </div>

            <!-- Détails de la maison -->
            <div class="property-details">
    <h2>Détails du bien</h2>
    <ul>
        <li><strong>Type :</strong> <?php echo get_the_term_list(get_the_ID(), 'property_type', '', ', '); ?></li>
        <li><strong>Statut :</strong> <?php echo get_the_term_list(get_the_ID(), 'property_status', '', ', '); ?></li>
        <li><strong>Localisation :</strong> <?php echo get_post_meta(get_the_ID(), 'location', true) ?: 'Non spécifié'; ?></li>
        <li><strong>Prix :</strong> <?php echo get_post_meta(get_the_ID(), 'price', true) ? get_post_meta(get_the_ID(), 'price', true) . ' €' : 'Prix non communiqué'; ?></li>
        <li><strong>Chambres :</strong> <?php echo get_post_meta(get_the_ID(), 'bedrooms', true) ?: 'Non spécifié'; ?></li>
        <li><strong>Salles de bain :</strong> <?php echo get_post_meta(get_the_ID(), 'bathrooms', true) ?: 'Non spécifié'; ?></li>
        <li><strong>Superficie :</strong> <?php echo get_post_meta(get_the_ID(), 'surface', true) ? get_post_meta(get_the_ID(), 'surface', true) . ' m²' : 'Non spécifié'; ?></li>
    </ul>
</div>


            <!-- Description complète -->
            <div class="property-description">
                <h2>Description</h2>
                <?php the_content(); ?>
            </div>

            <!-- Bouton retour -->
            <div class="back-to-properties">
                <a href="<?php echo get_post_type_archive_link('property'); ?>" class="btn-back">← Retour aux propriétés</a>
            </div>

        <?php endwhile; endif; ?>

    </div>
</div>
<pre>
<?php print_r(get_post_meta(get_the_ID())); ?>
</pre>

<?php get_footer(); ?>
