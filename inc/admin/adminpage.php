<form method="POST" action="options.php">
<?php
    settings_fields('dcc_plugin_opt');
    do_settings_sections('dcc_plugin_opt');
    submit_button();
    ?>
</form>