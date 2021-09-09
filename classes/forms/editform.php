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

defined('MOODLE_INTERNAL') || die();

// Moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class editform extends moodleform {
    // Add elements to form.
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't f orget the underscore!

        // notification text.
        $mform->addElement('text', 'notificationtext', get_string('notificationtext', 'local_notification'));
        $mform->setType('notificationtext', PARAM_NOTAGS);
        $mform->setDefault('notificationtext', 'Default notification');

        // notification type.

        // Select Options.
        $choices = array();
        $choices['0'] = \core\output\notification::NOTIFY_WARNING;
        $choices['1'] = \core\output\notification::NOTIFY_SUCCESS;
        $choices['2'] = \core\output\notification::NOTIFY_INFO;
        $choices['3'] = \core\output\notification::NOTIFY_ERROR;
        $mform->addElement('select', 'notificationtype', get_string('notificationtype', 'local_notification'), $choices);
        $mform->setDefault('notificationtype', '1');

        $this->add_action_buttons();

    }

    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}