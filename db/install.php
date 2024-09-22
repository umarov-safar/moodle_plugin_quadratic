<?php
declare(strict_types=1);
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
 * Code to be executed after the plugin's database scheme has been installed is defined here.
 *
 * @package     block_quadratic_calculator
 * @category    upgrade
 * @copyright   2024 Safar <safarumarov711@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Custom code to be run on installing the plugin.
 */
function xmldb_block_quadratic_calculator_install() {
    global $DB;
    $dbman = $DB->get_manager();
    $table = new xmldb_table('block_quadratic_calculator');

    // Adding fields to table block_quadratic_calculator.
    $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
    $table->add_field('a', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, null);
    $table->add_field('b', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, null);
    $table->add_field('c', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, null);
    $table->add_field('x1', XMLDB_TYPE_NUMBER, '10, 3', null, null, null, null);
    $table->add_field('x2', XMLDB_TYPE_NUMBER, '10, 2', null, null, null, null);
    $table->add_field('discriminant', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, null);
    $table->add_field('user_id', XMLDB_TYPE_INTEGER, '10', null, null, null, null);

    // Adding keys to table block_quadratic_calculator.
    $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

    // Conditionally launch create table for block_quadratic_calculator.
    if (!$dbman->table_exists($table)) {
        $dbman->create_table($table);
    }

    return true;
}
