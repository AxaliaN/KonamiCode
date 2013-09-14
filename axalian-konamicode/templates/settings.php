<div class="wrap">
    <h2>KonamiCode</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('axalian_konamicode-group'); ?>
        <?php @do_settings_fields('axalian_konamicode-group'); ?>

        <?php do_settings_sections('axalian_konamicode'); ?>

        <?php @submit_button(); ?>
    </form>
</div>