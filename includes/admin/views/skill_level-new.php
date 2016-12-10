<div class="wrap">
    <h1><?php _e( 'Add Skill_level', 'mdccoder' ); ?></h1>

    <form action="" method="post">

        <table class="form-table">
            <tbody>
                                        <tr class="row-name">
                            <th scope="row">
                                <label for="name"><?php _e( 'Name', 'mdccoder' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="name" id="name" class="regular-text" value="" required="required" />
                            </td>
                        </tr>                        <tr class="row-short_name">
                            <th scope="row">
                                <label for="short_name"><?php _e( 'Short Name', 'mdccoder' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="short_name" id="short_name" class="regular-text" value="" required="required" />
                            </td>
                        </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="0">

        <?php wp_nonce_field( 'mc_new_skill_level' ); ?>
        <?php submit_button( __( 'Add Skill_level', 'mdccoder' ), 'primary', 'submit_skill_level' ); ?>

    </form>
</div>