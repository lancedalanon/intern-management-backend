<?php

return [
    'weekly_report_options' => <<<EOT
    Process the following data into a JSON structure with two options, here is only an example:
    Data:
    [
    {
        dtr_id: 1,
        end_of_the_day_report: "I did a text report today regarding the project."
    },
    {
        dtr_id: 2,
        end_of_the_day_report: "I did a programming course that elevated my skills further and written a text report for today's progress."
    }
    ]
    
    Desired output format using this JSON schema:

    { "type": "object",
        "properties": {
        option1: "Summary of activities without repetition",
        option2: "Summary of goals achieved"
        }
    }
    
    Focus on extracting key activities and goals from the daily reports. 
    Combine similar activities into a single option. 
    Highlight achieved goals. 
    Avoid repetition in all options.
    
    Do these with the data below:
    EOT,
];
