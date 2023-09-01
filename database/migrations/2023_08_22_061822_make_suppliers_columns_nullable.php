<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeSuppliersColumnsNullable extends Migration
{
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            // List the columns you want to modify here
            $nullableColumns = [
                'companycode',
                'companyname',
                'companyname2',
                'registrationno',
                'registrationno2',
                'address1',
                'address2',
                'address3',
                'address4',
                'contactperson',
                'phoneno1',
                'phoneno2',
                'faxno1',
                'faxno2',
                'homepage',
                'businessnature',
                'creditlimit',
                'currentbalance',
                'status',
                'gstregno',
                'zipcode',
                'bandar',
            ];

            foreach ($nullableColumns as $column) {
                $table->string($column)->nullable()->change();
            }
        });
    }

    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            // Reverse the changes if needed
            $nullableColumns = [
                'companycode',
                'companyname',
                'companyname2',
                'registrationno',
                'registrationno2',
                'address1',
                'address2',
                'address3',
                'address4',
                'contactperson',
                'phoneno1',
                'phoneno2',
                'faxno1',
                'faxno2',
                'homepage',
                'businessnature',
                'creditlimit',
                'currentbalance',
                'status',
                'gstregno',
                'zipcode',
                'bandar',
            ];

            foreach ($nullableColumns as $column) {
                $table->string($column)->nullable(false)->change();
            }
        });
    }
}

