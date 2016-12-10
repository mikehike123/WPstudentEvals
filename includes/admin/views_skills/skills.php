<div class="wrap">
    <h2><?php _e( 'Skills', 'mdccoder' ); ?> <?php echo sprintf( '<a href="?page=%s&action=%s&skill_card_id=%s&" class="add-new-h2">Add New</a>',  esc_attr( $_REQUEST['page'] ), 'new' ,esc_attr( $_REQUEST['skill_card_id'] )); ?></h2>

    <form method="post">
        <input type="hidden" name="page" value="skills">
        <input type="hidden" name="skill_card_id" value="<?php echo esc_attr( $_REQUEST['skill_card_id'] ); ?>">
        <?php
            $skills_list_table = new Skills_List_Table();
            $skills_list_table->prepare_items();
            $skills_list_table->search_box( __( 'Search', 'mdccoder' ), 'skills' );
            $skills_list_table->display();
        ?>
    </form>
</div>