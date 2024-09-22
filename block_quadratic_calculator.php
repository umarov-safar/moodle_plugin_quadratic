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
 * Block quadratic_calculator is defined here.
 *
 * @package     block_quadratic_calculator
 * @copyright   2024 Safar <safarumarov711@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_quadratic_calculator extends block_base {

    /**
     * Initializes class member variables.
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_quadratic_calculator');
    }

    /**
     * Returns the block contents.
     *
     * @return stdClass The block contents.
     */
    public function get_content() {

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        global $CFG;
        include_once $CFG->dirroot  . '/blocks/quadratic_calculator/forms/quadratic_form.php';
        $form = new quadratic_form();

        $this->submitionSetting($form);

        $this->content = new stdClass();
        $this->content->text = $form->render();

        $historyUrl = new moodle_url('/blocks/quadratic_calculator/history.php');
        $this->content->footer = html_writer::link($historyUrl, get_string('go_to_history', 'block_quadratic_calculator'));



        return $this->content;
    }

    /**
     * Defines configuration data.
     *
     * The function is called immediately after init().
     */
    public function specialization() {

        // Load user defined title and make sure it's never empty.
        if (empty($this->config->title)) {
            $this->title = get_string('pluginname', 'block_quadratic_calculator');
        } else {
            $this->title = $this->config->title;
        }
    }

    /**
     * Sets the applicable formats for the block.
     *
     * @return string[] Array of pages and permissions.
     */
    public function applicable_formats() {
        return array('all' => true);
    }

    function _self_test() {
        return true;
    }

    private function submitionSetting(quadratic_form $form)
    {
        if ($form->is_cancelled()) {
            $form->set_data([]);
            return;
        }

        if ($form->is_submitted()) {
            $data = $form->get_data();
            $a = $data->a;
            $b = $data->b;
            $c = $data->c;

            $calculator = new \block_quadratic_calculator\calculator();
            [$discriminate, $x1, $x2] = $calculator::solve($a, $b, $c);

            global $DB;
            global $USER;

            $DB->insert_record('block_quadratic_calculator', (object)[
                'a' => $data->a,
                'b' => $data->a,
                'c' => $data->c,
                'x1' => $x1,
                'x2' => $x2,
                'discriminant' => $discriminate,
                'user_id' => $USER->id
            ]);
        }
    }
}
