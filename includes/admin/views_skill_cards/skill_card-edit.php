<div class="wrap">
    <h1><?php _e( 'Edit Skill_card', 'mdccoder' ); ?></h1>

    <?php $item = mc_get_skill_card( $id ); ?>

    <form action="" method="post">

        <table class="form-table">
            <tbody>
                                        <tr class="row-name">
                            <th scope="row">
                                <label for="name"><?php _e( 'Name', 'mdccoder' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="name" id="name" class="regular-text" value="<?php echo esc_attr( $item->name ); ?>" required="required" />
                            </td>
                        </tr>                        <tr class="row-shortName">
                            <th scope="row">
                                <label for="shortName"><?php _e( 'Shortname', 'mdccoder' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="shortName" id="shortName" class="regular-text" value="<?php echo esc_attr( $item->shortName ); ?>" required="required" />
                            </td>
                        </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

        <?php wp_nonce_field( 'mc_new_skill_card' ); ?>
        <?php submit_button( __( 'Update Skill_card', 'mdccoder' ), 'primary', 'submit_skill_card' ); ?>

    </form>
</div>