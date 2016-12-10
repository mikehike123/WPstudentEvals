<div class="wrap">
    <h1><?php _e( 'Add Skill_card', 'mdccoder' ); ?></h1>

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
                        </tr>                        <tr class="row-shortName">
                            <th scope="row">
                                <label for="shortName"><?php _e( 'Shortname', 'mdccoder' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="shortName" id="shortName" class="regular-text" value="" required="required" />
                            </td>
                        </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="0">

        <?php wp_nonce_field( 'mc_new_skill_card' ); ?>
        <?php submit_button( __( 'Add Skill_card', 'mdccoder' ), 'primary', 'submit_skill_card' ); ?>

    </form>
</div>