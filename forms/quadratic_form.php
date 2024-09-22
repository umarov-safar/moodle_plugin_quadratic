<?php
declare(strict_types=1);

require_once("$CFG->libdir/formslib.php");

class quadratic_form extends moodleform {
    public function definition() {

        $mform = $this->_form;

        $requiredMessage = get_string('required_field', 'block_quadratic_calculator');

        $mform->addElement('text', 'a', get_string('a', 'block_quadratic_calculator'));
        $mform->setType('a', PARAM_FLOAT);
        $mform->addRule('a', $requiredMessage, 'required', null, 'client');

        $mform->addElement('text', 'b', get_string('b', 'block_quadratic_calculator'));
        $mform->setType('b', PARAM_FLOAT);
        $mform->addRule('b', $requiredMessage, 'required', null, 'client');

        $mform->addElement('text', 'c', get_string('c', 'block_quadratic_calculator'));
        $mform->setType('c', PARAM_FLOAT);
        $mform->addRule('c', $requiredMessage, 'required', null, 'client');

        $this->add_action_buttons(true, get_string('solve', 'block_quadratic_calculator'));
    }


    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if ($data['a'] == 0) {
            $errors['a'] = get_string('error_nonzero_a', 'block_quadratic_calculator');
        }

        return $errors;
    }
}
