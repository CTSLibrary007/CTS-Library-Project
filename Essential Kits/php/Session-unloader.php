<script>
    window.onunload = () => {
        <?php
            session_unset();
            session_destroy();
        ?>
    }
</script>