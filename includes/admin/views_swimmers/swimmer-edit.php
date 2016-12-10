<div class="wrap">
    <h1><?php _e( 'Edit Swimmer', 'mdccoder' ); ?></h1>

    <?php $item = mc_get_swimmer( $id ); ?>

    <form action="" method="post">

        <table class="form-table">
            <tbody>
                                        <tr class="row-first_name">
                            <th scope="row">
                                <label for="first_name"><?php _e( 'First Name', 'mdccoder' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="first_name" id="first_name" class="regular-text" value="<?php echo esc_attr( $item->first_name ); ?>" required="required" />
                            </td>
                        </tr>                        <tr class="row-last_name">
                            <th scope="row">
                                <label for="last_name"><?php _e( 'Last Name', 'mdccoder' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="last_name" id="last_name" class="regular-text" value="<?php echo esc_attr( $item->last_name ); ?>" required="required" />
                            </td>
                        </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

        <?php wp_nonce_field( 'mc_new_swimmer' ); ?>
        <?php submit_button( __( 'Update Swimmer', 'mdccoder' ), 'primary', 'submit_swimmer' ); ?>

    </form>
</div>