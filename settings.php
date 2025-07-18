<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Adhoc manager settings.
 *
 * @package    tool_adhoc
 * @author     Skylar Kelty <S.Kelty@kent.ac.uk>
 * @copyright  2016 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('modules', new admin_category('queues', new lang_string('subplugintype_queue_plural', 'tool_adhoc')));

    $temp = new admin_settingpage('managequeues', new lang_string('managequeues', 'tool_adhoc'));
    $temp->add(new tool_adhoc_setting_managequeues());
    $ADMIN->add('queues', $temp);

    foreach (core_plugin_manager::instance()->get_plugins_of_type('queue') as $plugin) {
        /** @var \tool_adhoc\plugininfo\queue $plugin */
        $plugin->load_settings($ADMIN, 'queues', $hassiteconfig);
    }

    $ADMIN->add('server', new admin_externalpage(
        'adhoctaskmanagerreport',
        get_string('adhoctasks', 'tool_adhoc'),
        new \moodle_url("/admin/tool/adhoc/index.php")
    ));
}
