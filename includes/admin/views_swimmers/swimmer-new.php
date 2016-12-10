<div class="wrap">
    <h1><?php _e( 'Add Swimmer', 'mdccoder' ); ?></h1>

    <form action="" method="post">

        <table class="form-table">
            <tbody>
                                        <tr class="row-first_name">
                            <th scope="row">
                                <label for="first_name"><?php _e( 'First Name', 'mdccoder' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="first_name" id="first_name" class="regular-text" value="" required="required" />
                            </td>
                        </tr>                        <tr class="row-last_name">
                            <th scope="row">
                                <label for="last_name"><?php _e( 'Last Name', 'mdccoder' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="last_name" id="last_name" class="regular-text" value="" required="required" />
                            </td>
                        </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="0">

        <?php wp_nonce_field( 'mc_new_swimmer' ); ?>
        <?php submit_button( __( 'Add Swimmer', 'mdccoder' ), 'primary', 'submit_swimmer' ); ?>

    </form>
</div>