<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * This is a one-line short description of the file.
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    local_notification
 * @category   local
 * @copyright  2021 Shadman Ahmed
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/notification/classes/forms/editform.php');

global $DB;

$PAGE->set_url(new moodle_url('/local/notification/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Edit notifications');

$mform = new editform();

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    // Handle form cancel operation, if cancel button is present on form.
    // Go back to manage page.
    redirect($CFG->wwwroot . '/local/notification/manage.php', 'You cancelled the manage form');
} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    // Insert the data into database table 'local_notification'.
    $notificationtext = $fromform->notificationtext;
    $notificationtype = $fromform->notificationtype;

    $recordtoinsert = new stdClass();

    $recordtoinsert->notificationtext = $notificationtext;
    $recordtoinsert->notificationtype = $notificationtype;

    $DB->insert_record('local_notification', $recordtoinsert);

    // After successful insertion into the database, redirect to manage page.
    redirect($CFG->wwwroot . '/local/notification/manage.php', 'You created a notification with title ' . $notificationtext);
}

echo $OUTPUT->header();
// Here will be a form for notification.
$mform->display();

echo $OUTPUT->footer();
