<?php
function wpac_settings_page_html() {
    //Check if current user have admin access.
    if(!is_admin()) {
        return;
    }
    ?>
        <div class="wrap">
            <h1 style="padding:10px; background:#333;color:#fff"><?= esc_html(get_admin_page_title()); ?></h1>
            <form method='post'>
            <table>
                <tr>
                    <th><label for ="myDate">DATE</label></th>
                    <td><input type="Date" name="myDate"></td>
                </tr>
                <tr>
                    <th><label for ="myOccasion">Occasion</label></th>
                    <td><input type="text" name="myOccasion"></td>
                </tr>
                <tr>
                <th><label for ="myTitle">Post Title</label></th>
                    <td><input type="text" name="myTitle"></td>
                </tr>
                <tr>
                    <th><label for ="A_name">Author Name</label></th>
                    <td><select name="A_name" id="admin" required>
                    <?php
                    $users = get_users( array(
                        'fields' =>array( 'ID', 'display_name' )
                    ) );
                    foreach ($users as $user) {
                        echo '<option value="' . $user->ID . '">'. $user->display_name . '</option>';
                    }
                    ?>
                </select></td>
                </tr>
                <tr>
                    <th><label for ="reviewer">Reviewer</label></th>
                    <!-- <td><input type="name" name="reviewer"></td> -->
                    <td><select name="reviewer" id="reviewer" required>
                    <?php
                        $admins = get_users( array(
                            'role'  => 'administrator',
                            'fields'=> array( 'ID', 'display_name' )
                        ) );

                        foreach( $admins as $admin ) {
                            echo '<option value = "' . $admin->ID . '">' . $admin->display_name . '</option>';
                        }
                    ?>
                    </select></td>
                </tr>
            </table>
            <br>
                <?php
                    submit_button( "Schedule Post" );
                ?>
            <br>
            </form>
        </div>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 14px;
                color: #333;
            }
            th, td {
                border: 1px solid #ccc;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    <?

}


function content_calendar_callback()
{
?>
	<h1 class="plugin-title"><?php esc_html_e(get_admin_page_title()); ?></h1>
<?php
	wpac_settings_page_html();
	print_schedule();
}

?>