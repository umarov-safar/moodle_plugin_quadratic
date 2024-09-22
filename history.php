<?php
require_once(__DIR__ . '/../../config.php');
global $DB, $OUTPUT;

$context = context_system::instance();
$PAGE->set_context($context);

$PAGE->set_url(new moodle_url('/blocks/quadratic_calculator/history.php'));
$PAGE->set_title(get_string('history', 'block_quadratic_calculator'));
$PAGE->set_heading(get_string('history', 'block_quadratic_calculator'));

$PAGE->requires->css('/blocks/quadratic_calculator/style.css');

echo $OUTPUT->header();
$history = $DB->get_records('block_quadratic_calculator');

echo html_writer::start_tag('table', ['border' => 1, 'class'=> 'history-table']);
echo html_writer::start_tag('tr');
echo html_writer::tag('th', get_string('id', 'block_quadratic_calculator'));
echo html_writer::tag('th', get_string('a', 'block_quadratic_calculator'));
echo html_writer::tag('th', get_string('b', 'block_quadratic_calculator'));
echo html_writer::tag('th', get_string('c', 'block_quadratic_calculator'));
echo html_writer::tag('th', get_string('x1', 'block_quadratic_calculator'));
echo html_writer::tag('th', get_string('x2', 'block_quadratic_calculator'));
echo html_writer::tag('th', get_string('discriminant', 'block_quadratic_calculator'));
echo html_writer::tag('th', get_string('user_id', 'block_quadratic_calculator'));
echo html_writer::end_tag('tr');

foreach ($history as $entry) {
    echo html_writer::start_tag('tr');
    echo html_writer::tag('td', $entry->id);
    echo html_writer::tag('td', $entry->a);
    echo html_writer::tag('td', $entry->b);
    echo html_writer::tag('td', $entry->c);
    echo html_writer::tag('td', $entry->x1);
    echo html_writer::tag('td', $entry->x2);
    echo html_writer::tag('td', $entry->discriminant);
    echo html_writer::tag('td', $entry->user_id);
    echo html_writer::end_tag('tr');
}

echo html_writer::end_tag('table');

echo $OUTPUT->footer();