<?php
$item = mc_get_skill_card( $id );
?>

<div class="wrap">
    <h1><?php _e( 'Skill_card', 'mdccoder' ); ?></h1>

        <table class="form-table">
            <tbody>
                <?php var_dump($item); ?>
            </tbody>
        </table>

    </form>
</div>