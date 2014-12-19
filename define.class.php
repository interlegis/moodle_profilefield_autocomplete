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
 * autocomplete profile field definition.
 *
 * @package    profilefield_autocomplete
 * @copyright  2014 Interlegis {@link http://www.interlegis.leg.br}
 * @copyright  Based on menu field by onwards Shane Elliot {@link http://pukunui.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class profile_define_autocomplete
 *
 * @copyright  2007 onwards Shane Elliot {@link http://pukunui.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class profile_define_autocomplete extends profile_define_base {

    /**
     * Adds elements to the form for creating/editing this type of profile field.
     * @param moodleform $form
     */
    public function define_form_specific($form) {
        // Param 1 for autocomplete type contains the source URL.
        $form->addElement('text', 'param1', get_string('datasourceurl', 'profilefield_autocomplete'), 'size="50"');
        $form->addHelpButton('param1', 'datasourceurl', 'profilefield_autocomplete');
        $form->setType('param1', PARAM_TEXT);

        // Param 2 has strings to display in autocomplete
         $form->addElement('textarea', 'param2', get_string('options', 'profilefield_autocomplete'), array('rows' => 6, 'cols' => 40));
         $form->addHelpButton('options', 'options', 'profilefield_autocomplete');
        
        // Default data.
        $form->addElement('text', 'defaultdata', get_string('profiledefaultdata', 'admin'), 'size="50"');
        $form->setType('defaultdata', PARAM_TEXT);
    }

    /**
     * Processes data before it is saved.
     * @param array|stdClass $data
     * @return array|stdClass
     */
    public function define_save_preprocess($data) {
        $data->param2 = str_replace("\r", '', $data->param2);
        return $data;
    }
}