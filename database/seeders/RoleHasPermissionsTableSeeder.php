<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
		Schema::disableForeignKeyConstraints();
        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 2,
                'role_id' => 1,
            ),
            2 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            3 => 
            array (
                'permission_id' => 2,
                'role_id' => 3,
            ),
            4 => 
            array (
                'permission_id' => 2,
                'role_id' => 4,
            ),
            5 => 
            array (
                'permission_id' => 3,
                'role_id' => 1,
            ),
            6 => 
            array (
                'permission_id' => 3,
                'role_id' => 4,
            ),
            7 => 
            array (
			'permission_id' => 4,
                'role_id' => 1,
            ),
            8 => 
            array (
                'permission_id' => 5,
                'role_id' => 1,
            ),
            9 => 
            array (
                'permission_id' => 5,
                'role_id' => 4,
            ),
            10 => 
            array (
                'permission_id' => 6,
                'role_id' => 1,
            ),
            11 => 
            array (
                'permission_id' => 6,
                'role_id' => 4,
            ),
            12 => 
            array (
                'permission_id' => 7,
                'role_id' => 1,
            ),
            13 => 
            array (
                'permission_id' => 7,
                'role_id' => 2,
            ),
            14 => 
            array (
                'permission_id' => 7,
                'role_id' => 4,
            ),
            15 => 
            array (
                'permission_id' => 8,
                'role_id' => 1,
            ),
            16 => 
            array (
                'permission_id' => 8,
                'role_id' => 4,
            ),
            17 => 
            array (
                'permission_id' => 9,
                'role_id' => 1,
            ),
            18 => 
            array (
                'permission_id' => 9,
                'role_id' => 3,
            ),
            19 => 
            array (
                'permission_id' => 9,
                'role_id' => 4,
            ),
            20 => 
            array (
                'permission_id' => 10,
                'role_id' => 1,
            ),
            21 => 
            array (
                'permission_id' => 10,
                'role_id' => 4,
            ),
            22 => 
            array (
                'permission_id' => 11,
                'role_id' => 1,
            ),
            23 => 
            array (
                'permission_id' => 12,
                'role_id' => 1,
            ),
            24 => 
            array (
                'permission_id' => 12,
                'role_id' => 2,
            ),
            25 => 
            array (
                'permission_id' => 12,
                'role_id' => 3,
            ),
            26 => 
            array (
                'permission_id' => 12,
                'role_id' => 4,
            ),
            27 => 
            array (
                'permission_id' => 13,
                'role_id' => 1,
            ),
            28 => 
            array (
                'permission_id' => 14,
                'role_id' => 1,
            ),
            29 => 
            array (
                'permission_id' => 15,
                'role_id' => 1,
            ),
            30 => 
            array (
                'permission_id' => 16,
                'role_id' => 1,
            ),
            31 => 
            array (
                'permission_id' => 17,
                'role_id' => 1,
            ),
            32 => 
            array (
                'permission_id' => 18,
                'role_id' => 1,
            ),
            33 => 
            array (
                'permission_id' => 19,
                'role_id' => 1,
            ),
            34 => 
            array (
                'permission_id' => 20,
                'role_id' => 1,
            ),
            35 => 
            array (
                'permission_id' => 21,
                'role_id' => 1,
            ),
            36 => 
            array (
                'permission_id' => 22,
                'role_id' => 1,
            ),
            37 => 
            array (
                'permission_id' => 23,
                'role_id' => 1,
            ),
            38 => 
            array (
                'permission_id' => 24,
                'role_id' => 1,
            ),
            39 => 
            array (
                'permission_id' => 25,
                'role_id' => 1,
            ),
            40 => 
            array (
                'permission_id' => 26,
                'role_id' => 1,
            ),
            41 => 
            array (
                'permission_id' => 27,
                'role_id' => 1,
            ),
            42 => 
            array (
                'permission_id' => 28,
                'role_id' => 1,
            ),
            43 => 
            array (
                'permission_id' => 29,
                'role_id' => 1,
            ),
            44 => 
            array (
                'permission_id' => 30,
                'role_id' => 1,
            ),
            45 => 
            array (
                'permission_id' => 31,
                'role_id' => 1,
            ),
            46 => 
            array (
                'permission_id' => 31,
                'role_id' => 4,
            ),
            47 => 
            array (
                'permission_id' => 32,
                'role_id' => 1,
            ),
            48 => 
            array (
                'permission_id' => 33,
                'role_id' => 1,
            ),
            49 => 
            array (
                'permission_id' => 34,
                'role_id' => 1,
            ),
            50 => 
            array (
                'permission_id' => 35,
                'role_id' => 1,
            ),
            51 => 
            array (
                'permission_id' => 36,
                'role_id' => 1,
            ),
            52 => 
            array (
                'permission_id' => 36,
                'role_id' => 4,
            ),
            53 => 
            array (
                'permission_id' => 37,
                'role_id' => 1,
            ),
            54 => 
            array (
                'permission_id' => 38,
                'role_id' => 1,
            ),
            55 => 
            array (
                'permission_id' => 38,
                'role_id' => 2,
            ),
            56 => 
            array (
                'permission_id' => 38,
                'role_id' => 4,
            ),
            57 => 
            array (
                'permission_id' => 39,
                'role_id' => 1,
            ),
            58 => 
            array (
                'permission_id' => 39,
                'role_id' => 4,
            ),
            59 => 
            array (
                'permission_id' => 40,
                'role_id' => 1,
            ),
            60 => 
            array (
                'permission_id' => 41,
                'role_id' => 1,
            ),
            61 => 
            array (
                'permission_id' => 42,
                'role_id' => 1,
            ),
            62 => 
            array (
                'permission_id' => 42,
                'role_id' => 4,
            ),
            63 => 
            array (
                'permission_id' => 43,
                'role_id' => 1,
            ),
            64 => 
            array (
                'permission_id' => 44,
                'role_id' => 1,
            ),
            65 => 
            array (
                'permission_id' => 44,
                'role_id' => 4,
            ),
            66 => 
            array (
                'permission_id' => 45,
                'role_id' => 1,
            ),
            67 => 
            array (
                'permission_id' => 46,
                'role_id' => 1,
            ),
            68 => 
            array (
                'permission_id' => 47,
                'role_id' => 1,
            ),
            69 => 
            array (
                'permission_id' => 47,
                'role_id' => 4,
            ),
            70 => 
            array (
                'permission_id' => 48,
                'role_id' => 1,
            ),
            71 => 
            array (
                'permission_id' => 49,
                'role_id' => 1,
            ),
            72 => 
            array (
                'permission_id' => 49,
                'role_id' => 3,
            ),
            73 => 
            array (
                'permission_id' => 50,
                'role_id' => 1,
            ),
            74 => 
            array (
                'permission_id' => 51,
                'role_id' => 1,
            ),
            75 => 
            array (
                'permission_id' => 52,
                'role_id' => 1,
            ),
            76 => 
            array (
                'permission_id' => 53,
                'role_id' => 1,
            ),
            77 => 
            array (
                'permission_id' => 54,
                'role_id' => 1,
            ),
            78 => 
            array (
                'permission_id' => 54,
                'role_id' => 4,
            ),
            79 => 
            array (
                'permission_id' => 55,
                'role_id' => 1,
            ),
            80 => 
            array (
                'permission_id' => 56,
                'role_id' => 1,
            ),
            81 => 
            array (
                'permission_id' => 57,
                'role_id' => 1,
            ),
            82 => 
            array (
                'permission_id' => 57,
                'role_id' => 4,
            ),
            83 => 
            array (
                'permission_id' => 58,
                'role_id' => 1,
            ),
            84 => 
            array (
                'permission_id' => 59,
                'role_id' => 1,
            ),
            85 => 
            array (
                'permission_id' => 59,
                'role_id' => 4,
            ),
            86 => 
            array (
                'permission_id' => 60,
                'role_id' => 1,
            ),
            87 => 
            array (
                'permission_id' => 61,
                'role_id' => 1,
            ),
            88 => 
            array (
                'permission_id' => 62,
                'role_id' => 1,
            ),
            89 => 
            array (
                'permission_id' => 62,
                'role_id' => 4,
            ),
            90 => 
            array (
                'permission_id' => 63,
                'role_id' => 1,
            ),
            91 => 
            array (
                'permission_id' => 64,
                'role_id' => 1,
            ),
            92 => 
            array (
                'permission_id' => 64,
                'role_id' => 2,
            ),
            93 => 
            array (
                'permission_id' => 64,
                'role_id' => 4,
            ),
            94 => 
            array (
                'permission_id' => 65,
                'role_id' => 1,
            ),
            95 => 
            array (
                'permission_id' => 65,
                'role_id' => 2,
            ),
            96 => 
            array (
                'permission_id' => 66,
                'role_id' => 1,
            ),
            97 => 
            array (
                'permission_id' => 66,
                'role_id' => 2,
            ),
            98 => 
            array (
                'permission_id' => 67,
                'role_id' => 1,
            ),
            99 => 
            array (
                'permission_id' => 67,
                'role_id' => 2,
            ),
            100 => 
            array (
                'permission_id' => 67,
                'role_id' => 4,
            ),
            101 => 
            array (
                'permission_id' => 68,
                'role_id' => 1,
            ),
            102 => 
            array (
                'permission_id' => 69,
                'role_id' => 1,
            ),
            103 => 
            array (
                'permission_id' => 70,
                'role_id' => 1,
            ),
            104 => 
            array (
                'permission_id' => 71,
                'role_id' => 1,
            ),
            105 => 
            array (
                'permission_id' => 72,
                'role_id' => 1,
            ),
            106 => 
            array (
                'permission_id' => 72,
                'role_id' => 4,
            ),
            107 => 
            array (
                'permission_id' => 73,
                'role_id' => 1,
            ),
            108 => 
            array (
                'permission_id' => 74,
                'role_id' => 1,
            ),
            109 => 
            array (
                'permission_id' => 74,
                'role_id' => 2,
            ),
            110 => 
            array (
                'permission_id' => 74,
                'role_id' => 3,
            ),
            111 => 
            array (
                'permission_id' => 74,
                'role_id' => 5,
            ),
            112 => 
            array (
                'permission_id' => 75,
                'role_id' => 1,
            ),
            113 => 
            array (
                'permission_id' => 75,
                'role_id' => 2,
            ),
            114 => 
            array (
                'permission_id' => 75,
                'role_id' => 4,
            ),
            115 => 
            array (
                'permission_id' => 76,
                'role_id' => 1,
            ),
            116 => 
            array (
                'permission_id' => 76,
                'role_id' => 4,
            ),
            117 => 
            array (
                'permission_id' => 77,
                'role_id' => 1,
            ),
            118 => 
            array (
                'permission_id' => 78,
                'role_id' => 1,
            ),
            119 => 
            array (
                'permission_id' => 78,
                'role_id' => 4,
            ),
            120 => 
            array (
                'permission_id' => 79,
                'role_id' => 1,
            ),
            121 => 
            array (
                'permission_id' => 79,
                'role_id' => 2,
            ),
            122 => 
            array (
                'permission_id' => 79,
                'role_id' => 4,
            ),
            123 => 
            array (
                'permission_id' => 80,
                'role_id' => 1,
            ),
            124 => 
            array (
                'permission_id' => 81,
                'role_id' => 1,
            ),
            125 => 
            array (
                'permission_id' => 82,
                'role_id' => 1,
            ),
            126 => 
            array (
                'permission_id' => 83,
                'role_id' => 1,
            ),
            127 => 
            array (
                'permission_id' => 83,
                'role_id' => 4,
            ),
            128 => 
            array (
                'permission_id' => 84,
                'role_id' => 1,
            ),
            129 => 
            array (
                'permission_id' => 85,
                'role_id' => 1,
            ),
            130 => 
            array (
                'permission_id' => 85,
                'role_id' => 2,
            ),
            131 => 
            array (
                'permission_id' => 86,
                'role_id' => 1,
            ),
            132 => 
            array (
                'permission_id' => 87,
                'role_id' => 1,
            ),
            133 => 
            array (
                'permission_id' => 88,
                'role_id' => 1,
            ),
            134 => 
            array (
                'permission_id' => 89,
                'role_id' => 1,
            ),
            135 => 
            array (
                'permission_id' => 89,
                'role_id' => 2,
            ),
            136 => 
            array (
                'permission_id' => 90,
                'role_id' => 1,
            ),
            137 => 
            array (
                'permission_id' => 90,
                'role_id' => 2,
            ),
            138 => 
            array (
                'permission_id' => 90,
                'role_id' => 3,
            ),
            139 => 
            array (
                'permission_id' => 91,
                'role_id' => 1,
            ),
            140 => 
            array (
                'permission_id' => 91,
                'role_id' => 2,
            ),
            141 => 
            array (
                'permission_id' => 91,
                'role_id' => 4,
            ),
            142 => 
            array (
                'permission_id' => 92,
                'role_id' => 1,
            ),
            143 => 
            array (
                'permission_id' => 93,
                'role_id' => 1,
            ),
            144 => 
            array (
                'permission_id' => 94,
                'role_id' => 1,
            ),
            145 => 
            array (
                'permission_id' => 95,
                'role_id' => 1,
            ),
            146 => 
            array (
                'permission_id' => 95,
                'role_id' => 2,
            ),
            147 => 
            array (
                'permission_id' => 95,
                'role_id' => 4,
            ),
            148 => 
            array (
                'permission_id' => 96,
                'role_id' => 1,
            ),
            149 => 
            array (
                'permission_id' => 97,
                'role_id' => 1,
            ),
            150 => 
            array (
                'permission_id' => 98,
                'role_id' => 1,
            ),
            151 => 
            array (
                'permission_id' => 99,
                'role_id' => 1,
            ),
            152 => 
            array (
                'permission_id' => 100,
                'role_id' => 1,
            ),
            153 => 
            array (
                'permission_id' => 101,
                'role_id' => 1,
            ),
            154 => 
            array (
                'permission_id' => 102,
                'role_id' => 1,
            ),
            155 => 
            array (
                'permission_id' => 102,
                'role_id' => 2,
            ),
            156 => 
            array (
                'permission_id' => 102,
                'role_id' => 4,
            ),
            157 => 
            array (
                'permission_id' => 103,
                'role_id' => 1,
            ),
            158 => 
            array (
                'permission_id' => 104,
                'role_id' => 1,
            ),
            159 => 
            array (
                'permission_id' => 105,
                'role_id' => 1,
            ),
            160 => 
            array (
                'permission_id' => 106,
                'role_id' => 1,
            ),
            161 => 
            array (
                'permission_id' => 107,
                'role_id' => 1,
            ),
            162 => 
            array (
                'permission_id' => 108,
                'role_id' => 1,
            ),
            163 => 
            array (
                'permission_id' => 109,
                'role_id' => 1,
            ),
            164 => 
            array (
                'permission_id' => 109,
                'role_id' => 2,
            ),
            165 => 
            array (
                'permission_id' => 109,
                'role_id' => 4,
            ),
            166 => 
            array (
                'permission_id' => 110,
                'role_id' => 1,
            ),
            167 => 
            array (
                'permission_id' => 110,
                'role_id' => 2,
            ),
            168 => 
            array (
                'permission_id' => 111,
                'role_id' => 1,
            ),
            169 => 
            array (
                'permission_id' => 111,
                'role_id' => 2,
            ),
            170 => 
            array (
                'permission_id' => 112,
                'role_id' => 1,
            ),
            171 => 
            array (
                'permission_id' => 113,
                'role_id' => 1,
            ),
            172 => 
            array (
                'permission_id' => 113,
                'role_id' => 3,
            ),
            173 => 
            array (
                'permission_id' => 114,
                'role_id' => 1,
            ),
            174 => 
            array (
                'permission_id' => 115,
                'role_id' => 1,
            ),
            175 => 
            array (
                'permission_id' => 116,
                'role_id' => 1,
            ),
            176 => 
            array (
                'permission_id' => 116,
                'role_id' => 3,
            ),
            177 => 
            array (
                'permission_id' => 117,
                'role_id' => 1,
            ),
            178 => 
            array (
                'permission_id' => 118,
                'role_id' => 1,
            ),
            179 => 
            array (
                'permission_id' => 118,
                'role_id' => 3,
            ),
            180 => 
            array (
                'permission_id' => 118,
                'role_id' => 5,
            ),
            181 => 
            array (
                'permission_id' => 119,
                'role_id' => 1,
            ),
            182 => 
            array (
                'permission_id' => 119,
                'role_id' => 3,
            ),
            183 => 
            array (
                'permission_id' => 120,
                'role_id' => 1,
            ),
            184 => 
            array (
                'permission_id' => 120,
                'role_id' => 3,
            ),
            185 => 
            array (
                'permission_id' => 121,
                'role_id' => 1,
            ),
            186 => 
            array (
                'permission_id' => 122,
                'role_id' => 1,
            ),
            187 => 
            array (
                'permission_id' => 122,
                'role_id' => 3,
            ),
            188 => 
            array (
                'permission_id' => 123,
                'role_id' => 1,
            ),
            189 => 
            array (
                'permission_id' => 123,
                'role_id' => 3,
            ),
            190 => 
            array (
                'permission_id' => 124,
                'role_id' => 1,
            ),
            191 => 
            array (
                'permission_id' => 124,
                'role_id' => 3,
            ),
            192 => 
            array (
                'permission_id' => 125,
                'role_id' => 1,
            ),
            193 => 
            array (
                'permission_id' => 126,
                'role_id' => 1,
            ),
            194 => 
            array (
                'permission_id' => 127,
                'role_id' => 1,
            ),
            195 => 
            array (
                'permission_id' => 127,
                'role_id' => 3,
            ),
            196 => 
            array (
                'permission_id' => 128,
                'role_id' => 1,
            ),
            197 => 
            array (
                'permission_id' => 129,
                'role_id' => 1,
            ),
            198 => 
            array (
                'permission_id' => 130,
                'role_id' => 1,
            ),
            199 => 
            array (
                'permission_id' => 131,
                'role_id' => 1,
            ),
            200 => 
            array (
                'permission_id' => 131,
                'role_id' => 4,
            ),
            201 => 
            array (
                'permission_id' => 132,
                'role_id' => 1,
            ),
            202 => 
            array (
                'permission_id' => 132,
                'role_id' => 3,
            ),
            203 => 
            array (
                'permission_id' => 133,
                'role_id' => 1,
            ),
            204 => 
            array (
                'permission_id' => 134,
                'role_id' => 1,
            ),
            205 => 
            array (
                'permission_id' => 135,
                'role_id' => 1,
            ),
            206 => 
            array (
                'permission_id' => 136,
                'role_id' => 1,
            ),
            207 => 
            array (
                'permission_id' => 136,
                'role_id' => 3,
            ),
            208 => 
            array (
                'permission_id' => 136,
                'role_id' => 4,
            ),
            209 => 
            array (
                'permission_id' => 137,
                'role_id' => 1,
            ),
            210 => 
            array (
                'permission_id' => 137,
                'role_id' => 3,
            ),
            211 => 
            array (
                'permission_id' => 138,
                'role_id' => 1,
            ),
            212 => 
            array (
                'permission_id' => 138,
                'role_id' => 3,
            ),
            213 => 
            array (
                'permission_id' => 139,
                'role_id' => 1,
            ),
            214 => 
            array (
                'permission_id' => 139,
                'role_id' => 3,
            ),
            215 => 
            array (
                'permission_id' => 140,
                'role_id' => 1,
            ),
            216 => 
            array (
                'permission_id' => 140,
                'role_id' => 3,
            ),
            217 => 
            array (
                'permission_id' => 141,
                'role_id' => 1,
            ),
            218 => 
            array (
                'permission_id' => 141,
                'role_id' => 3,
            ),
            219 => 
            array (
                'permission_id' => 141,
                'role_id' => 4,
            ),
            220 => 
            array (
                'permission_id' => 142,
                'role_id' => 1,
            ),
            221 => 
            array (
                'permission_id' => 142,
                'role_id' => 3,
            ),
            222 => 
            array (
                'permission_id' => 142,
                'role_id' => 4,
            ),
            223 => 
            array (
                'permission_id' => 142,
                'role_id' => 5,
            ),
            224 => 
            array (
                'permission_id' => 143,
                'role_id' => 1,
            ),
            225 => 
            array (
                'permission_id' => 143,
                'role_id' => 3,
            ),
            226 => 
            array (
                'permission_id' => 143,
                'role_id' => 5,
            ),
            227 => 
            array (
                'permission_id' => 144,
                'role_id' => 1,
            ),
            228 => 
            array (
                'permission_id' => 144,
                'role_id' => 3,
            ),
            229 => 
            array (
                'permission_id' => 144,
                'role_id' => 4,
            ),
            230 => 
            array (
                'permission_id' => 144,
                'role_id' => 5,
            ),
            231 => 
            array (
                'permission_id' => 145,
                'role_id' => 1,
            ),
            232 => 
            array (
                'permission_id' => 145,
                'role_id' => 3,
            ),
            233 => 
            array (
                'permission_id' => 145,
                'role_id' => 4,
            ),
            234 => 
            array (
                'permission_id' => 145,
                'role_id' => 5,
            ),
            235 => 
            array (
                'permission_id' => 146,
                'role_id' => 1,
            ),
            236 => 
            array (
                'permission_id' => 146,
                'role_id' => 4,
            ),
            237 => 
            array (
                'permission_id' => 147,
                'role_id' => 1,
            ),
            238 => 
            array (
                'permission_id' => 147,
                'role_id' => 3,
            ),
            239 => 
            array (
                'permission_id' => 147,
                'role_id' => 4,
            ),
            240 => 
            array (
                'permission_id' => 147,
                'role_id' => 5,
            ),
            241 => 
            array (
                'permission_id' => 148,
                'role_id' => 1,
            ),
            242 => 
            array (
                'permission_id' => 149,
                'role_id' => 1,
            ),
            243 => 
            array (
                'permission_id' => 149,
                'role_id' => 2,
            ),
            244 => 
            array (
                'permission_id' => 150,
                'role_id' => 1,
            ),
            245 => 
            array (
                'permission_id' => 150,
                'role_id' => 2,
            ),
            246 => 
            array (
                'permission_id' => 151,
                'role_id' => 1,
            ),
            247 => 
            array (
                'permission_id' => 151,
                'role_id' => 2,
            ),
            248 => 
            array (
                'permission_id' => 152,
                'role_id' => 1,
            ),
            249 => 
            array (
                'permission_id' => 152,
                'role_id' => 3,
            ),
            250 => 
            array (
                'permission_id' => 152,
                'role_id' => 4,
            ),
            251 => 
            array (
                'permission_id' => 153,
                'role_id' => 1,
            ),
            252 => 
            array (
                'permission_id' => 153,
                'role_id' => 3,
            ),
            253 => 
            array (
                'permission_id' => 153,
                'role_id' => 4,
            ),
            254 => 
            array (
                'permission_id' => 153,
                'role_id' => 5,
            ),
            255 => 
            array (
                'permission_id' => 154,
                'role_id' => 1,
            ),
            256 => 
            array (
                'permission_id' => 154,
                'role_id' => 3,
            ),
            257 => 
            array (
                'permission_id' => 154,
                'role_id' => 4,
            ),
            258 => 
            array (
                'permission_id' => 154,
                'role_id' => 5,
            ),
            259 => 
            array (
                'permission_id' => 155,
                'role_id' => 1,
            ),
            260 => 
            array (
                'permission_id' => 156,
                'role_id' => 1,
            ),
            261 => 
            array (
                'permission_id' => 157,
                'role_id' => 1,
            ),
            262 => 
            array (
                'permission_id' => 158,
                'role_id' => 1,
            ),
            263 => 
            array (
                'permission_id' => 159,
                'role_id' => 1,
            ),
            264 => 
            array (
                'permission_id' => 160,
                'role_id' => 1,
            ),
            265 => 
            array (
                'permission_id' => 161,
                'role_id' => 1,
            ),
            266 => 
            array (
                'permission_id' => 162,
                'role_id' => 1,
            ),
            267 => 
            array (
                'permission_id' => 163,
                'role_id' => 1,
            ),
            268 => 
            array (
                'permission_id' => 164,
                'role_id' => 1,
            ),
            269 => 
            array (
                'permission_id' => 164,
                'role_id' => 3,
            ),
            270 => 
            array (
                'permission_id' => 164,
                'role_id' => 5,
            ),
            271 => 
            array (
                'permission_id' => 165,
                'role_id' => 1,
            ),
            272 => 
            array (
                'permission_id' => 166,
                'role_id' => 1,
            ),
            273 => 
            array (
                'permission_id' => 166,
                'role_id' => 3,
            ),
            274 => 
            array (
                'permission_id' => 167,
                'role_id' => 1,
            ),
            275 => 
            array (
                'permission_id' => 167,
                'role_id' => 3,
            ),
            276 => 
            array (
                'permission_id' => 168,
                'role_id' => 1,
            ),
            277 => 
            array (
                'permission_id' => 168,
                'role_id' => 3,
            ),
            278 => 
            array (
                'permission_id' => 169,
                'role_id' => 1,
            ),
            279 => 
            array (
                'permission_id' => 169,
                'role_id' => 3,
            ),
            280 => 
            array (
                'permission_id' => 170,
                'role_id' => 1,
            ),
            281 => 
            array (
                'permission_id' => 171,
                'role_id' => 1,
            ),
            282 => 
            array (
                'permission_id' => 171,
                'role_id' => 3,
            ),
            283 => 
            array (
                'permission_id' => 172,
                'role_id' => 1,
            ),
            284 => 
            array (
                'permission_id' => 172,
                'role_id' => 3,
            ),
            285 => 
            array (
                'permission_id' => 173,
                'role_id' => 1,
            ),
            286 => 
            array (
                'permission_id' => 173,
                'role_id' => 3,
            ),
            287 => 
            array (
                'permission_id' => 174,
                'role_id' => 1,
            ),
            288 => 
            array (
                'permission_id' => 174,
                'role_id' => 3,
            ),
            289 => 
            array (
                'permission_id' => 175,
                'role_id' => 1,
            ),
            290 => 
            array (
                'permission_id' => 176,
                'role_id' => 1,
            ),
            291 => 
            array (
                'permission_id' => 176,
                'role_id' => 3,
            ),
            292 => 
            array (
                'permission_id' => 177,
                'role_id' => 1,
            ),
            293 => 
            array (
                'permission_id' => 177,
                'role_id' => 3,
            ),
            294 => 
            array (
                'permission_id' => 178,
                'role_id' => 1,
            ),
            295 => 
            array (
                'permission_id' => 178,
                'role_id' => 3,
            ),
            296 => 
            array (
                'permission_id' => 178,
                'role_id' => 5,
            ),
            297 => 
            array (
                'permission_id' => 179,
                'role_id' => 1,
            ),
            298 => 
            array (
                'permission_id' => 179,
                'role_id' => 3,
            ),
            299 => 
            array (
                'permission_id' => 179,
                'role_id' => 5,
            ),
            300 => 
            array (
                'permission_id' => 180,
                'role_id' => 1,
            ),
            301 => 
            array (
                'permission_id' => 181,
                'role_id' => 1,
            ),
            302 => 
            array (
                'permission_id' => 181,
                'role_id' => 3,
            ),
            303 => 
            array (
                'permission_id' => 181,
                'role_id' => 5,
            ),
            304 => 
            array (
                'permission_id' => 182,
                'role_id' => 1,
            ),
            305 => 
            array (
                'permission_id' => 183,
                'role_id' => 1,
            ),
            306 => 
            array (
                'permission_id' => 183,
                'role_id' => 3,
            ),
            307 => 
            array (
                'permission_id' => 184,
                'role_id' => 1,
            ),
            308 => 
            array (
                'permission_id' => 184,
                'role_id' => 2,
            ),
            309 => 
            array (
                'permission_id' => 184,
                'role_id' => 3,
            ),
            310 => 
            array (
                'permission_id' => 184,
                'role_id' => 4,
            ),
            311 => 
            array (
                'permission_id' => 184,
                'role_id' => 5,
            ),
            312 => 
            array (
                'permission_id' => 185,
                'role_id' => 1,
            ),
            313 => 
            array (
                'permission_id' => 185,
                'role_id' => 3,
            ),
            314 => 
            array (
                'permission_id' => 185,
                'role_id' => 5,
            ),
            315 => 
            array (
                'permission_id' => 186,
                'role_id' => 1,
            ),
            316 => 
            array (
                'permission_id' => 186,
                'role_id' => 3,
            ),
            317 => 
            array (
                'permission_id' => 187,
                'role_id' => 1,
            ),
            318 => 
            array (
                'permission_id' => 188,
                'role_id' => 1,
            ),
            319 => 
            array (
                'permission_id' => 188,
                'role_id' => 2,
            ),
            320 => 
            array (
                'permission_id' => 188,
                'role_id' => 3,
            ),
            321 => 
            array (
                'permission_id' => 188,
                'role_id' => 4,
            ),
            322 => 
            array (
                'permission_id' => 188,
                'role_id' => 5,
            ),
            323 => 
            array (
                'permission_id' => 189,
                'role_id' => 1,
            ),
            324 => 
            array (
                'permission_id' => 190,
                'role_id' => 1,
            ),
        ));
        
        Schema::enableForeignKeyConstraints();
    }
}