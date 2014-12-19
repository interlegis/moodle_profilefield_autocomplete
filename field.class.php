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
 * autocomplete profile field.
 *
 * @package    profilefield_autocomplete
 * @copyright  2014 Interlegis {@link http://www.interlegis.leg.br}
 * @copyright  based on menu field by onwards Shane Elliot {@link http://pukunui.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class profile_field_autocomplete
 *
 * @copyright  2007 onwards Shane Elliot {@link http://pukunui.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class profile_field_autocomplete extends profile_field_base {
    /**
     * Create the code snippet for this field instance
     * Overwrites the base class method
     * @param moodleform $mform Moodle form instance
     */
    public function edit_field_add($mform) {
        $mform->addElement('text', $this->inputname, format_string($this->field->name), 'class="yui3-skin-sam"');
    	$datasource = "{$CFG->wwwroot}/user/profile/field/autocomplete/search.php?id={$this->field->id}&q={query}";
        #Hack: I have not found a more elegant way to include the JS on the page
    	global $PAGE;
    	$PAGE->requires->yui_module('moodle-profilefield_autocomplete-autocomplete',
    			'M.profilefield_autocomplete.autocomplete.init',
    			array($this->inputname, $datasource));
    }

    /**
     * Set the default value for this field instance
     * Overwrites the base class method.
     * @param moodleform $mform Moodle form instance
     */
    public function edit_field_set_default($mform) {
        $mform->setDefault($this->inputname, $this->field->defaultdata);
    }
}
