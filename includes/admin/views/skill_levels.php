<div class="wrap">
    <h2><?php _e( 'Skill_levels', 'mdccoder' ); ?> <?php echo sprintf( '<a href="?page=%s&action=%s" class="add-new-h2">Add New</a>',  esc_attr( $_REQUEST['page'] ), 'new' ); ?></h2>

    <form method="post">
        <input type="hidden" name="page" value="skill_levels">
        <?php
            $skill_levels_list_table = new Skill_levels_List_Table();
            $skill_levels_list_table->prepare_items();
            $skill_levels_list_table->search_box( __( 'Search', 'mdccoder' ), 'skill_levels' );
            $skill_levels_list_table->display();
        ?>
    </form>
</div>