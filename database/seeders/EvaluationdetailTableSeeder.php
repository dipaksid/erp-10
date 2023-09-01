<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EvaluationdetailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
		Schema::disableForeignKeyConstraints();
        \DB::table('evaluation_details')->delete();
        
        \DB::table('evaluation_details')->insert(array (
            0 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 1,
                'form_detail' => 'CONSIDER EMPLOYEE\'S SKILL LEVEL, KNOWLEDGE AND UNDERSTANDING OF ALL PHASES OF JOB AND THOSE REQUIRING IMPROVED SKILLS AND/OR EXPERIENCE.',
                'form_title' => 'KNOWLEDGE OF WORK',
                'id' => 1,
                'max_rating' => 10,
                'seq' => 1,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            1 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 1,
                'form_detail' => 'CONSIDERS THE ACURACY AND THOROUGHNESS IN COMPLETING WORK ASSIGNMENT AND ADHERENCE TO STANDARDS INCLUSIVE OF OFFICE PRIVARE & CONFIDENTIAL.',
                'form_title' => 'QUALITY OF WORK & CONFIDENTAILITY',
                'id' => 2,
                'max_rating' => 10,
                'seq' => 2,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            2 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 1,
                'form_detail' => 'CONSIDER THE AMOUNT OF WORK COMPLETED IN RELATION TO ASSIGNED RESPONSIBILITIES AND THE EFFECTIVE UTILIZATION OF TIME. SHOULD BE ABLE TO WORK WELL UNDER PRESSURE.',
                'form_title' => 'PRODUCTIVITY',
                'id' => 3,
                'max_rating' => 10,
                'seq' => 3,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            3 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 1,
                'form_detail' => 'CONSIDER THE EMPLOYEE\'S AVAILABILITY AND RESPONSOVENESS TO ASSIGNED DUTIES AND RELIABILITY IN PERFORMING THEM PROPERLY WITHOUT SACRIFICING ACCURACY AND COMPANY SOP.',
                'form_title' => 'DEPENDABILITY',
                'id' => 5,
                'max_rating' => 10,
                'seq' => 4,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            4 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 1,
                'form_detail' => 'CONSIDER HOW WELL IS THE EMPLOYEE ADJUSTS TO ANY CHANGE IN DUTIES, PROCEDURES OR WORK ENVIRONMENT. HOW WELL DOES THE EMPLOYEE ACCEPT NEW IDEAS AND APPROACHES TO WORK, RESPOND APPROPRIATELY TO CONSTRUCTIVE CRITICISM AND TO SUGGESTIONS FOR WORK IMPROVEMENT.',
                'form_title' => 'ADAPTABILITY',
                'id' => 6,
                'max_rating' => 10,
                'seq' => 5,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            5 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 1,
                'form_detail' => 'CONSIDER HOW WELL EMPLOYEE DEMONSTRATES RESOURCEFULNESS, INDEPENDENT THINKING, AND EXTEND TO WHICH EMPLOYEE SEEKS ADDITIONAL CHALLENGES AND OPPORTUNITIES ON THEIR OWN. EXHIBITS INGENUITY AND INITIATIVE IN JOB PERFORMANCE. SEEKS TO CREATE NEW METHODS AND PROCESS FOR IMPROVEMENT.',
                'form_title' => 'SELF-INITIATIVE',
                'id' => 7,
                'max_rating' => 10,
                'seq' => 6,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            6 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 1,
                'form_detail' => 'CONSIDER HOW WELL THE EMPLOYEE PLANS AND ORGANIZES WORK; COORDINATES WITH OTHERS AND ESTABLISHES APPROPRIATE PRIORITIES; CARRIES OT WORK EFFECTIVELY. INCLUDE DEMONSTRATES PROPER JUDGMENT AND PROBLEM SOLVING SKILLS.',
                'form_title' => 'PLANNING AND ORGANIZING',
                'id' => 8,
                'max_rating' => 10,
                'seq' => 7,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            7 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 1,
                'form_detail' => 'MEASURES EFFECTIVENESS IN LISTENING TO OTHERS, EXPRESSING IDEAS, PROVIDING RELEVANT AND TIMELY INFORMATION CLERLY BOTH ORALLY AND IN WRITING TO MANAGEMENT AND COLLEAGUES.',
                'form_title' => 'COMMUNICATION',
                'id' => 9,
                'max_rating' => 10,
                'seq' => 8,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            8 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 1,
                'form_detail' => 'CONSIDER HOW WELL THE EMPLOYEE GETS ALONG WITH FELLOW COLLEAGUES, RESPECTS THE RIGHT OF OTHER EMPLOYEES AND SHOWS A COOPERATIVE SPIRIT.',
                'form_title' => 'TEAMWORK',
                'id' => 10,
                'max_rating' => 10,
                'seq' => 9,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            9 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 1,
                'form_detail' => 'CONSIDER THE EMPLOYEE\'S ATTENDANCE, APPRORIATE USE OF LEAVE, WORK ARRIVAL AND DEPARTURES, EMPLOYEE\'S NEATNESS AND PERSONAL HYGIENE APPROPRIATE TO POSITION.',
                'form_title' => 'ATTENDANCE, PUNCTUALITY AND PERSONAL APPEARANCE',
                'id' => 11,
                'max_rating' => 10,
                'seq' => 10,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            10 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 2,
                'form_detail' => 'DEMONSTRATES PROFESSIONAL, ADMINISTRATIVE, SUPERVISORY, AND/OR SPECIALIZED KNOWLEDGE REQUIRED TO ACCOMPLISH THE JOB DUTIES.',
                'form_title' => 'JOB KNOWLEDGE',
                'id' => 12,
                'max_rating' => 10,
                'seq' => 1,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            11 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 2,
                'form_detail' => 'COMPLETE DUTIES WITH THOROUGHNESS AND ACCURACY. DEMONSTRATES ABILITY TO MANAGE SEVERAL RESPONSIBILITIES SIMULTANEOUSLY. DEMONSTRATES WILLINGNESS AND ABILITY TO CARRY A FAIR SHARE OF WORKLOAD.',
                'form_title' => 'QUALITY AND QUANTITY OF WORK',
                'id' => 13,
                'max_rating' => 10,
                'seq' => 2,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            12 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 2,
                'form_detail' => 'THE EXTENT TO WHICH AN EMPLOYEE CAN BE RELIED UPON REGARDING TASK COMPLETION AND FOLLOW-UP, INCLUDING MEETING DEADLINES ON TIME WITHOUT SACRIFICING ACCURACY, WORK QUALITY AND COMPANY\'S PROLICES AND PROCEDURES INCLUSIVE OF OFFCE P&C.',
                'form_title' => 'RELIABILITY AND CONFIDENTAILITY',
                'id' => 14,
                'max_rating' => 10,
                'seq' => 3,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            13 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 2,
                'form_detail' => 'DEMONSTRATES ABILITY TO DIRECT AND GUIDE SUBORDINATES IN THE COMPLETION OF WORK ASSIGNMENTS. INCLUDES CLEARLY DEFINING, OVERSEEING, AND ENSURING SATISFACTORY COMPLETION OF DELEGATED WORK.',
                'form_title' => 'DELEGATION AND SUPERVISION',
                'id' => 15,
                'max_rating' => 10,
                'seq' => 4,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            14 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 2,
                'form_detail' => 'THE EXTENT TO WHICH THE EMPLOYEE PLANS AND ORGANIZES WORK SO AS TO WORK EFFICIENTLY AND EFFECTIVELY. ALSO INCLUDES THE EXTENT TO WHICH THE EMPLOYEE REVIEWS AND DEVELOPS PROCEDURES AND RECOMMENDATIONS FOR IMPROVEMENT IN BOTH THE ASSIGNED AND RELATED WORK AREAS.',
                'form_title' => 'PLANNING, ORGANIZING AND TIME MANAGEMENT SKILLS',
                'id' => 16,
                'max_rating' => 10,
                'seq' => 5,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            15 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 2,
                'form_detail' => 'THE EXTENT TO WHICH THE EMPLOYEE DEMONSTRATES PROPER JUDGMENT, DECISION MAKING AND PROBLEM SOLVING SKILLS.',
                'form_title' => 'DECISION MAKING AND JUDGMENT',
                'id' => 17,
                'max_rating' => 10,
                'seq' => 6,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            16 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 2,
                'form_detail' => 'CONSIDER THE EMPLOYEE\'S OWN EFFORT TO SEEK AND ASSUME GREATER RESPONSIBILITIES, DEVELOP NEW WAYS TO HANDLE WORK SITUATIONS, MONITORS ASSIGNMENT INDEPENDENTLY AND FOLLOW THROUGH APPROPRIATELY.',
                'form_title' => 'INITIATIVE',
                'id' => 18,
                'max_rating' => 10,
                'seq' => 7,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            17 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 2,
                'form_detail' => 'CONSIDER THE EMPLOYEE\'S ABILITY TO EXPRESS IDEAS CLEARLY BOTH ORALLY AND IN WRITING, LISTENS WELL AND RESPONDS APPROPRIATELY. CONSIDER THE EMPLOYEE\'S ABILITY TO ADAPT TO ANY CHANGES, ACCEPT NEW IDEAS AND APPROACHES TO WORK, RESPONDS APPROPRIATELY TO CRITICISM AND SUGGESTIONS FOR WORK IMPROVEMENT.',
                'form_title' => 'COMMUNICATION AND FLEXIBILITY',
                'id' => 19,
                'max_rating' => 10,
                'seq' => 8,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            18 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 2,
                'form_detail' => 'THE EXTENT TO WHICH THE EMPLOYEE MAINTAINS POSITIVE WORKING RELATIONSHIPS WITH OTHER PEERS, WILLINGNESS TO HELP OTHERS AND SHOWS A COOPERATIVE SPIRIT.',
                'form_title' => 'TEAM WORK',
                'id' => 20,
                'max_rating' => 10,
                'seq' => 9,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            19 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'evaluation_id' => 2,
                'form_detail' => 'CONSIDER THE EMPLOYEE\'S ATTENDANCE, APPROPRIATE USE OF LEAVE, WORK ARRIVAL AND DEPARTURES, EMPLOYEE\'S NEATNESS AND PERSONAL HYGIENE APPROPRIATE TO POSITION.',
                'form_title' => 'ATTENDANCE, PUNCTUALITY AND PERSONAL APPEARANCE',
                'id' => 21,
                'max_rating' => 10,
                'seq' => 10,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
        ));
        
        Schema::enableForeignKeyConstraints();
    }
}