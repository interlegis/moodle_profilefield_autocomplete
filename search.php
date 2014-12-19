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
 * autocomplete profile field version information.
 *
 * @package    profilefield_autocomplete
 * @copyright  2014 Interlegis {@link http://www.interlegis.leg.br}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../../config.php');

$id    = required_param('id', PARAM_INT);
$q     = optional_param('q', '', PARAM_RAW);
$limit = optional_param('limit', 100, PARAM_INT);

$field  = $DB->get_record('user_info_field', array('id'=>$id));
$url    = $field->param1;
$data   = explode("\n", $field->param2);

if ($url) {
	/*
	 * Because CORS (http://enable-cors.org/) is disabled as default in
	 * most browsers and sites, and because I have not found a way
	 * to enable it using YUI autocomplete component, I was forced to
	 * create this indirection to get the data from external URLs.
	 * The lightweight way to do this would be to send the data source URL
	 * directly to the client browser. This would reduce the time, complexity,
	 * server load, and failure possibilities.
	 */ 
	$url = str_replace('{query}', $q, $url);
	$url = str_replace('{limit}', $limit, $url);
	$result = file_get_contents($url);
} else {
 	$result = array();
	$termos = explode(" ", strtolower(trim($q)));
 	foreach ($data as $row) {
 		$todos = true;
 		$lrow = strtolower($row);
 		foreach ($termos as $termo) {
 			$todos = ($todos and (strpos($lrow, $termo) !== false));
		}
		if ($todos) {
			$result[] = $row;
			if (count($result) >= $limit) {
				break;
			}
		}
 	}
 	$result = json_encode($result);
}

header('Content-Type: application/json');
echo $result;