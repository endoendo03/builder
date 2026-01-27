<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOptionsToSurveyQuestions extends Migration
{
    public function up()
    {
        $fields = [
            'options' => [
                'type' => 'TEXT', 
                'null' => true, 
                'after' => 'type',
                'comment' => 'カンマ区切りの選択肢'
            ],
        ];
        $this->forge->addColumn('survey_questions', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('survey_questions', ['options']);
    }
}
