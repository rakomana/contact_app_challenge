<?php
require 'config\db_connection.php';
require 'app\Models\Contact.php';

$contact = new Contact();

/**
 * get resources from storage
 * @return html
 */
function index()
{
    $contact = new Contact();
    $contacts = $contact->query("SELECT * FROM contacts");

    showTable($contacts);
}

/**
 * get resource from storage
 * @return array
*/
function show()
{
    $contact = new Contact();

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $get_id = $contact->query("SELECT * FROM contacts WHERE id='$id'");

        if (mysqli_num_rows($get_id) === 1) {
            $row = mysqli_fetch_assoc($get_id);
            return ($row);
        }
    }
}

/**
 * delete resource from storage
 * @return string
 */
function delete()
{
    $contact = new Contact();

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {

        $userid = $_GET['id'];
        $delete_user = $contact->query("DELETE FROM contacts WHERE id='$userid'");

        if ($delete_user) {
            echo "<script>alert('Data Deleted');window.location.href = 'insert.php';</script>";
            exit;
        } else {
            echo "I think something went wrong";
        }
    }
}

/**
 * Search resources from storage
 * @return html
 */
function get_search_data()
{
    $contact = new Contact();
    $value = $_GET['value'];
    $results = $contact->query("SELECT * FROM contacts WHERE full_name LIKE '%".$value."%'");

    showTable($results);
}

/**
 * Create new resource in storage
 */
if (isset($_POST['full_name']) && isset($_POST['phone_number']) && isset($_POST['email'])) {
    // check title and content empty or not
    if (!empty($_POST['full_name']) && !empty($_POST['phone_number']) && !empty($_POST['email'])) {

        // Escape special characters.
        $full_name = $contact->validate($_POST['full_name']);
        $phone_number = $contact->validate($_POST['phone_number']);
        $email = $contact->validate($_POST['email']);

        // Check if email already exists
        $check_email = $contact->query("SELECT 'email' FROM contacts WHERE email = '$email'");

        if (mysqli_num_rows($check_email) > 0) {
            echo "<script>alert('Oops email already exists - please try a different email');window.location.href = 'insert.php';</script>";
        
        } else {

            // Insert data into database
            $insert_query = $contact->query("INSERT INTO contacts(full_name,phone_number,email) VALUES('$full_name','$phone_number', '$email')");

            //Now check if data has been inserted
            if ($insert_query) {
                echo "<script>alert('Data inserted');window.location.href = 'index.php';</script>";
                exit;
            } else {
                echo "<h3>Data was not inserted!</h3>";
            }
        }
    } else {
        echo "<h4>Please fill all fields</h4>";
    }
}

/**
 * Update resource in storage
 */
if (isset($_POST['update_full_name']) && isset($_POST['update_phone_number']) && isset($_POST['update_email'])) {

    //check if items are empty
    if (!empty($_POST['update_full_name']) && !empty($_POST['update_phone_number']) && !empty($_POST['update_email'])) {
        echo 'hello';
        // Escape special characters.
        $full_name = $contact->validate($_POST['update_full_name']);
        $phone_number = $contact->validate($_POST['update_phone_number']);
        $email = $contact->validate($_POST['update_email']);

        $id = $_GET['id'];

        $update_query = $contact->query("UPDATE contacts SET full_name='$full_name',phone_number='$phone_number',email='$email' WHERE id=$id");

        if ($update_query) {
            echo "<script>alert('Post Updated');window.location.href = 'index.php';</script>";
            exit;
        } else {
            echo "<h3>Sorry, that didn't work</h3>";
        }
    } else {
        echo "<h4>Please fill all fields</h4>";
    }
}


/**
 * html table 
*/
function showTable($contacts)
{
    if (mysqli_num_rows($contacts) > 0) {

        echo '
            <table>
                <tr>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
        ';
        while ($row = mysqli_fetch_assoc($contacts)) {
            echo '
            <tr>
                <td>' . $row['full_name'] . '</td>
                <td>' . $row['phone_number'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>
                    <a href="update.php?id=' . $row['id'] . '">Edit</a> |
                    <a href="delete.php?id=' . $row['id'] . '">Delete</a>
                </td>
            </tr>
        ';
        }
        echo '
            </table>
        ';
    } else {
        echo "<h3>We could not find anything</h3>";
    }
}

/**
 * Get value to search
*/
if (isset($_POST['value'])) {
    echo "<script>window.location.href = 'search.php?value=" . $_POST['value'] . "';</script>";
}