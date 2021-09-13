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

function local_notification_before_footer() {

    global $DB;

    $notifications = $DB->get_records('local_notification');

    foreach ($notifications as $notification) {
        $type = \core\output\notification::NOTIFY_ERROR;
        if ($notification->notificationtype === '0') {
            $type = \core\output\notification::NOTIFY_WARNING;
        }
        if ($notification->notificationtype === '1') {
            $type = \core\output\notification::NOTIFY_SUCCESS;
        }
        if ($notification->notificationtype === '2') {
            $type = \core\output\notification::NOTIFY_INFO;
        }
        \core\notification::add($notification->notificationtext, $type);
    }
    // Add a notification of some kind.

}