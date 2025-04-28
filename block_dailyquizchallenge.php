<?php

class block_dailyquizchallenge extends block_base {

    public function init() {
        $this->title = get_string('pluginname', 'block_dailyquizchallenge');
    }

    public function get_content() {
        global $DB, $PAGE;

        if ($this->content != null) {
            return $this->content;
        }

        $this->content = new stdClass();

        // Include the external CSS
        $PAGE->requires->css('/blocks/dailyquizchallenge/style.css');  // External CSS file

        $questionrecord = $DB->get_record_sql('SELECT * FROM {block_dailyquizchallenge_qs} ORDER BY RAND() LIMIT 1');

        if (!$questionrecord) {
            $this->content->text = get_string('noquestions', 'block_dailyquizchallenge');
            return $this->content;
        }

        $html = html_writer::start_div('dailyquiz-block', ['data-questionid' => $questionrecord->id, 'data-correctoption' => $questionrecord->correctoption]);
        $html .= html_writer::tag('div', format_string($questionrecord->question), ['class' => 'dailyquiz-question']);

        $options = [
            1 => format_string($questionrecord->option1),
            2 => format_string($questionrecord->option2),
            3 => format_string($questionrecord->option3),
            4 => format_string($questionrecord->option4),
        ];

        foreach ($options as $key => $optiontext) {
            $html .= html_writer::tag('button', $optiontext, [
                'class' => 'dailyquiz-option',
                'data-option' => $key
            ]);
        }

        // ans->message
        $html .= html_writer::tag('div', '', ['class' => 'dailyquiz-message']);

        $html .= html_writer::end_div();
        
        $this->content->text = $html;

        $PAGE->requires->js_call_amd('block_dailyquizchallenge/quiz', 'init');

        return $this->content;
    }

    public function applicable_formats() {
        return ['all' => true];
    }
}
