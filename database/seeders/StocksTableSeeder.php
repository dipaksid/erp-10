<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StocksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('stocks')->delete();

        \DB::table('stocks')->insert(array (
            0 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 4,
                'created_at' => NULL,
                'description' => '',
                'id' => 1,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '55.00',
                'sellingprice' => '80.00',
                'seq' => 55,
                'stockcode' => '3PLY NCR PAPER',
                'stockid' => 'FF399D3E-4BD1-42BC-B50E-033B0C26CEEF',
                'stockname' => '9.5" X 11" 3PLY 2UPS NCR PLAIN PAPER',
                'stockspec' => '<p>* 1 BOX = 500 FANS.</p>',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            1 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => NULL,
                'description' => '',
                'id' => 2,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '320.00',
                'seq' => 70,
                'stockcode' => 'PS-16 POWER SUPPLY',
                'stockid' => '54B42427-6D2E-447B-A93A-0CF0494DE8BD',
                'stockname' => '16CH CAMERA POWER SUPPLY',
                'stockspec' => '<p>* 1 YEAR ON MANUFACTURING DEFECTS.</p>

<p>-S/N :</p>',
                'updated_at' => '2023-02-27 08:34:24',
            ),
            2 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 4,
                'created_at' => NULL,
                'description' => '',
                'id' => 6,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '47.00',
                'sellingprice' => '63.00',
                'seq' => 52,
                'stockcode' => '9.5 X 11 PLAIN FORM',
                'stockid' => 'C6E59648-161D-4669-A5D6-48D2B090B61E',
                'stockname' => '9.5" X 11" 1PLY 60GSM COMPUTER PLAIN FORM',
                'stockspec' => '<p>* 1 BOX = 2000 FANS.</p>',
                'updated_at' => '2023-02-27 08:34:44',
            ),
            3 =>
            array (
                'alw_pls' => 'Y',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => NULL,
                'description' => '',
                'id' => 7,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 36,
                'min_order_qty' => 36,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '24.67',
                'sellingprice' => '30.00',
                'seq' => 39,
                'stockcode' => 'OKI39O0',
                'stockid' => '272B78B5-D9AC-4656-A0A0-5552933477E0',
                'stockname' => 'OKI 390 ORIGINAL RIBBON',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:43',
            ),
            4 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => NULL,
                'description' => '',
                'id' => 8,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 10,
                'min_order_qty' => 10,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '8.30',
                'sellingprice' => '18.00',
                'seq' => 43,
                'stockcode' => 'ERC 38 RIBBON',
                'stockid' => '3892BBB6-5C0E-45B5-ADB9-5D58FB4E0C73',
                'stockname' => 'EPSON ERC 38 ORIGINAL RIBBON',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:43',
            ),
            5 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => NULL,
                'description' => '',
                'id' => 9,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '6.80',
                'sellingprice' => '8.50',
                'seq' => 64,
                'stockcode' => 'PVC FILE',
                'stockid' => 'DA734AAA-3239-4E76-BBE5-71DB9904CC7D',
                'stockname' => '15" X 11" COMPUTER PVC FILE',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:34',
            ),
            6 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 2,
                'created_at' => NULL,
                'description' => '',
                'id' => 11,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '0.00',
                'seq' => 68,
                'stockcode' => 'HDMI',
                'stockid' => '026124FD-B8A0-4FE0-B161-7CC6916623E2',
                'stockname' => 'HDMI CABLE',
                'stockspec' => NULL,
                'updated_at' => '2023-02-27 08:34:24',
            ),
            7 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => NULL,
                'description' => '',
                'id' => 13,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '80.00',
                'seq' => 71,
                'stockcode' => 'CAMERA ADAPTER',
                'stockid' => 'BDD94294-394B-42F1-8D3D-878C6B9640F1',
                'stockname' => 'CAMERA ADAPTER',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:24',
            ),
            8 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-12-10 14:18:51',
                'description' => '',
                'id' => 76,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '1279.00',
                'sellingprice' => '1590.00',
                'seq' => 20,
                'stockcode' => '390T PRINTER',
                'stockid' => '',
                'stockname' => 'OKI ML390T PLUS 80 COL DOT-MATRIX PRINTER',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE FOR NEW PRINTHEAD.</p>

<p>- PRINTER S/N -</p>

<p>- PRINTHEAD S/N -</p>',
                'updated_at' => '2022-06-13 07:35:15',
            ),
            9 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 4,
                'created_at' => NULL,
                'description' => '',
                'id' => 17,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 2,
                'min_order_qty' => 2,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '71.00',
                'sellingprice' => '83.00',
                'seq' => 51,
                'stockcode' => '15 X 11',
                'stockid' => 'BDC8662C-CB53-4B60-B657-BF7ECF534637',
                'stockname' => '15" X 11" 1PLY 60GSM COMPUTER PLAIN FORM',
                'stockspec' => '<p>* 1 BOX = 2000 FANS.</p>',
                'updated_at' => '2023-02-27 08:34:43',
            ),
            10 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => NULL,
                'description' => '',
                'id' => 18,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '6.00',
                'seq' => 65,
                'stockcode' => 'SMALL PVC FILE',
                'stockid' => '129C2232-726E-4F45-A5A3-CC0617EED48C',
                'stockname' => '9.5" X 11" COMPUTER PVC FILE',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:24',
            ),
            11 =>
            array (
                'alw_pls' => 'Y',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => NULL,
                'description' => '',
                'id' => 19,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 36,
                'min_order_qty' => 18,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '21.18',
                'sellingprice' => '27.00',
                'seq' => 38,
                'stockcode' => 'OKI320',
                'stockid' => 'B0B16AF6-B0E3-4190-9054-D135F338C853',
                'stockname' => 'OKI 320 ORIGINAL RIBBON',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:49',
            ),
            12 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 8,
                'created_at' => NULL,
                'description' => '',
                'id' => 20,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '0.00',
                'seq' => 75,
                'stockcode' => 'COURIER',
                'stockid' => 'C2E2DBD6-8E56-4A95-8F53-D341DE3FDFF5',
                'stockname' => 'COURIER CHARGE',
                'stockspec' => '<p>* SEND BY SEA FREIGHT OR AIR FREIGHT.</p>

<p>* SEND ITEM ?</p>',
                'updated_at' => '2023-02-27 08:34:24',
            ),
            13 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => NULL,
                'description' => '',
                'id' => 22,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '180.00',
                'seq' => 72,
                'stockcode' => 'CAT5E',
                'stockid' => '50F7B83F-6B32-43DF-9041-D86BF9F46840',
                'stockname' => 'CAT5E NETWORK CABLE',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:24',
            ),
            14 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => NULL,
                'description' => '',
                'id' => 23,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '14.00',
                'sellingprice' => '27.00',
                'seq' => 42,
                'stockcode' => 'ERC 27 RIBBON',
                'stockid' => 'AAB5C059-E241-4CF5-911B-D8CE9EB4B157',
                'stockname' => 'EPSON ERC 27 ORIGINAL RIBBON',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:43',
            ),
            15 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => NULL,
                'description' => '',
                'id' => 24,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '1490.00',
                'sellingprice' => '1900.00',
                'seq' => 21,
                'stockcode' => '391T PRINTER',
                'stockid' => '463EAD07-92B7-4A5F-8144-E31FD28C33DC',
                'stockname' => 'OKI 391T PLUS 136 COL DOT-MATRIX PRINTER',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE FOR NEW PRINTHEAD.</p>

<p>* PRINTER S/N -</p>

<p>* PRINTHEAD S/N -</p>',
                'updated_at' => '2022-06-13 07:35:15',
            ),
            16 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => NULL,
                'description' => '',
                'id' => 25,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 10,
                'min_order_qty' => 20,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '82.64',
                'sellingprice' => '92.00',
                'seq' => 41,
                'stockcode' => 'OKI395',
                'stockid' => '1C6160FE-1817-49D7-9852-E774B2A3F99B',
                'stockname' => 'OKI 395 ORIGINAL RIBBON',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:43',
            ),
            17 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => NULL,
                'description' => '',
                'id' => 26,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '0.00',
                'seq' => 69,
                'stockcode' => '16GB PEN DRIVE',
                'stockid' => '8BF844DF-F415-4A42-A78D-F256DA2EAFCB',
                'stockname' => 'ADATA 16GB PEN DRIVE',
                'stockspec' => '<p>* COLOR : ?</p>',
                'updated_at' => '2023-02-27 08:34:24',
            ),
            18 =>
            array (
                'alw_pls' => 'Y',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => NULL,
                'description' => '',
                'id' => 28,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 18,
                'min_order_qty' => 18,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '29.11',
                'sellingprice' => '38.00',
                'seq' => 40,
                'stockcode' => 'OKI790',
                'stockid' => 'CEB3805C-B794-4E4C-A3E4-FBD469010F07',
                'stockname' => 'OKI 790 ORIGINAL RIBBON',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:43',
            ),
            19 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 1,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-06 13:56:39',
                'description' => '',
                'id' => 36,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 99999,
                'min_order_qty' => 99999,
                'opening_year' => 2021,
                'opening_year_qty' => 99999,
                'purchaseprice' => '0.00',
                'sellingprice' => '7500.00',
                'seq' => 1,
                'stockcode' => 'WIN PAWN SYSTEM',
                'stockid' => '',
                'stockname' => 'WIN PAWN MANAGEMENT SYSTEM V1.0 LICENSE',
                'stockspec' => '<p>* ORIGINAL PRICE AT RM7,500.00 / SERVER / LOCATION.</p>

<p>* ADDITIONAL WORKSTATION ADD RM500.00.</p>

<p>* C/W ONE SHOP AND ONE COMPUTER LICENSE.</p>

<p>* C/W ON-LINE TRAINING.</p>

<p>* C/W REMOTE COMPUTER SETUP BY TEAMVIEWER VER 12.</p>

<p>* C/W ACTUAL DAY ONE AND MONTH END SUPPORT.</p>

<p>* C/W REMINDER AND AUCTION TRAINING.</p>

<p>* SUPPORT FOR COMPUTER HARDWARE WITH MS WINDOWS 10</p>

<p>PROFESSIONAL 64 BITS OEM LICENSE.</p>

<p>* SUPPORT FOR HARDWARE WITH PARALLEL / USB PRINTER PORT.</p>

<p>* EXCLUDE ACCOMMODATION AND AIR FREIGHT CHARGES.</p>

<p>(DEPEND ON BOOKING FREIGHT AT THAT TIME AND PAYABLE BY PURCHASER).</p>

<p>- S/N : @serialno</p>',
                'updated_at' => '2023-05-23 13:03:10',
            ),
            20 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-12-10 14:21:36',
                'description' => '',
                'id' => 77,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '1843.94',
                'sellingprice' => '2280.00',
                'seq' => 23,
                'stockcode' => '791T PRINTER',
                'stockid' => '',
                'stockname' => 'OKI ML791T PLUS 136 COL DOT-MATRIX PRINTER',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE FOR NEW PRINTHEAD.</p>

<p>- PRINTER S/N :</p>

<p>- PRINTHEAD S/N :</p>',
                'updated_at' => '2022-06-13 07:35:15',
            ),
            21 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-06-06 14:03:03',
                'description' => '',
                'id' => 37,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '550.00',
                'seq' => 33,
                'stockcode' => 'IC CARD READER',
                'stockid' => '',
                'stockname' => 'MYCAD IC CARD READER C/W TOUCH',
                'stockspec' => '<p>- DONGLE S/N :</p>',
                'updated_at' => '2022-06-13 07:35:10',
            ),
            22 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-06-06 14:06:10',
                'description' => '',
                'id' => 38,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '550.00',
                'seq' => 31,
                'stockcode' => '5MP DESKTOP CAMERA',
                'stockid' => '',
                'stockname' => '5MP EXTERNAL DESKTOP CAMERA',
                'stockspec' => '<p>- S/N :</p>',
                'updated_at' => '2022-06-13 07:35:10',
            ),
            23 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-06-06 15:52:23',
                'description' => '',
                'id' => 39,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '425.00',
                'sellingprice' => '510.00',
                'seq' => 35,
                'stockcode' => '24" HDMI MONITOR',
                'stockid' => '',
                'stockname' => 'SAMSUNG 24" HDMI MONITOR',
                'stockspec' => '<p>* 1 YEAR WARRANTY ON MANUFACTURING DEFECTS.</p>

<p>* PRODUCT CODE :</p>

<p>* S/N:<br />
&nbsp;</p>',
                'updated_at' => '2023-02-27 08:34:55',
            ),
            24 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 4,
                'created_at' => '2020-06-06 15:57:45',
                'description' => '',
                'id' => 40,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 10,
                'min_order_qty' => 50,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '1.90',
                'sellingprice' => '3.40',
                'seq' => 57,
                'stockcode' => '1PLYROLL',
                'stockid' => '',
                'stockname' => '1PLY PAPER ROLL',
                'stockspec' => '<p>* 1 BOX = 100 ROLLS PAPER.</p>',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            25 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 4,
                'created_at' => '2020-06-06 15:59:05',
                'description' => '',
                'id' => 41,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '3.30',
                'sellingprice' => '4.80',
                'seq' => 58,
                'stockcode' => '2PLYROLL',
                'stockid' => '',
                'stockname' => '2PLY PAPER ROLL',
                'stockspec' => '<p>* 1 BOX = 100 ROLLS.</p>',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            26 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 1,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-07 15:10:38',
                'description' => '',
                'id' => 42,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '500.00',
                'seq' => 2,
                'stockcode' => 'WORK - PAWN',
                'stockid' => '',
                'stockname' => 'WIN PAWN MANAGEMENT SYSTEM VER 1.0 LICENSE',
                'stockspec' => '<p>* ONLINE INSTALL BY &nbsp; @user&nbsp; AT&nbsp; @installdate&nbsp; .</p>

<p>* FOR&nbsp;&nbsp; @number &nbsp; PC LICENSE.</p>

<p>* S/N : @serialno.</p>',
                'updated_at' => '2023-05-23 13:03:10',
            ),
            27 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 2,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-07 15:15:11',
                'description' => '',
                'id' => 43,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '7500.00',
                'seq' => 6,
                'stockcode' => 'WIN GSS SYSTEM',
                'stockid' => '',
                'stockname' => 'WIN GOLDSMITH MANAGEMENT SYSTEM VER 1.0 LICENSE',
                'stockspec' => '<p>* ORIGINAL PRICE AT RM7,500.00 / SERVER / LOCATION.</p>

<p>* C/W ONE SHOP AND ONE COMPUTER LICENSE.</p>

<p>* C/W ON-LINE TRAINING.</p>

<p>* C/W REMOTE COMPUTER SETUP BY TEAMVIEWER VER 12.</p>

<p>* C/W ACTUAL DAY ONE AND MONTH END SUPPORT.</p>

<p>* SUPPORT FOR COMPUTER HARDWARE WITH MIN MS WINDOWS 10</p>

<p>PROFESSIONAL OS (64BIT).</p>

<p>* SUPPORT FOR HARDWARE WITH PARALLEL / USB PRINTER PORT.</p>

<p>- S/N : @serialno</p>',
                'updated_at' => '2021-08-17 13:20:11',
            ),
            28 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 2,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-07 15:19:49',
                'description' => '',
                'id' => 44,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '500.00',
                'seq' => 7,
                'stockcode' => 'WORK - GSS',
                'stockid' => '',
                'stockname' => 'WIN GOLDSMITH MANAGEMENT SYSTEM VER 1.0 LICENSE',
                'stockspec' => '<p>* ONLINE INSTALL BY&nbsp; @user &nbsp; AT&nbsp; @installdate .</p>

<p>* FOR&nbsp; @number&nbsp; PC LICENSE.</p>

<p>* S/N : @serialno.</p>',
                'updated_at' => '2021-08-17 13:20:47',
            ),
            29 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 1,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-07 15:21:07',
                'description' => '',
                'id' => 45,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '2500.00',
                'seq' => 4,
                'stockcode' => 'CON WIN PAWN - HQ',
                'stockid' => '',
                'stockname' => 'CONSOLIDATE WIN PAWN MANAGEMENT SYSTEM V1.0 LICENSE',
                'stockspec' => '<p>* ORIGINAL PRICE AT RM2,500.00 / SERVER / LOCATION FOR HQ.</p>

<p>* ADDITIONAL BRANCH ADD RM250.00.</p>

<p>* C/W ON-LINE TRAINING.</p>

<p>* C/W REMOTE COMPUTER SETUP BY TEAMVIEWER VER 12.</p>

<p>* C/W ACTUAL DAY ONE AND MONTH END SUPPORT.</p>

<p>* SUPPORT FOR COMPUTER HARDWARE WITH MS WINDOWS 10</p>

<p>PROFESSIONAL 64 BITS OEM LICENSE.</p>

<p>* SUPPORT FOR HARDWARE WITH PARALLEL / USB PRINTER PORT.</p>

<p>* EXCLUDE ACCOMMODATION AND AIR FREIGHT CHARGES.</p>

<p>(DEPEND ON BOOKING FREIGHT AT THAT TIME AND PAYABLE BY PURCHASER).</p>

<p>- S/N : @serialno</p>',
                'updated_at' => '2021-08-17 13:19:13',
            ),
            30 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 1,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-07 15:21:46',
                'description' => '',
                'id' => 46,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '250.00',
                'seq' => 3,
                'stockcode' => 'BRANCH LICENSE',
                'stockid' => '',
                'stockname' => 'CONSOLIDATE WIN PAWN MANAGEMENT SYSTEM V1.0',
                'stockspec' => '<p>* INSTALL AT</p>

<p>* INSTALLED BY DATED :</p>

<p>* S/N : @serialno.</p>',
                'updated_at' => '2021-08-17 13:18:59',
            ),
            31 =>
            array (
                'alw_pls' => 'Y',
                'auto_send_purchase' => 'N',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-06-07 15:25:37',
                'description' => '',
                'id' => 47,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '750.00',
                'sellingprice' => '970.00',
                'seq' => 28,
                'stockcode' => 'TSCBARP',
                'stockid' => '',
                'stockname' => 'TSC BARCODE PRINTER',
                'stockspec' => '<p>* PRODUCT CODE : TE200</p>

<p>* NO WARRANTY AVAILABLE FOR NEW PRINTHEAD.</p>

<p>-S/N :</p>',
                'updated_at' => '2023-02-10 06:02:39',
            ),
            32 =>
            array (
                'alw_pls' => 'Y',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-06-07 15:28:00',
                'description' => '',
                'id' => 48,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '370.00',
                'sellingprice' => '485.00',
                'seq' => 29,
                'stockcode' => 'DS2208',
                'stockid' => '',
                'stockname' => 'ZEBRA DS 2208 BARCODE SCANNER',
                'stockspec' => '<p>* 1 YEAR WARRANTY.</p>

<p>- S/N : @serialno</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>',
                'updated_at' => '2023-02-16 10:12:57',
            ),
            33 =>
            array (
                'alw_pls' => 'Y',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => '2020-06-07 15:51:41',
                'description' => '',
                'id' => 49,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 10,
                'min_order_qty' => 10,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '43.00',
                'sellingprice' => '62.00',
                'seq' => 60,
                'stockcode' => 'BARCODE LABEL',
                'stockid' => '',
            'stockname' => 'BARCODE LABEL (W) 55X16',
                'stockspec' => '<p>* 55MM X 16MM ART PAPER.</p>

<p>* 1 ROLL = 1000PCS LABEL.</p>

<p>* WHITE COLOR.</p>',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            34 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 7,
                'stock_categories_id' => 1,
                'created_at' => '2020-09-23 08:09:55',
                'description' => '',
                'id' => 74,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '4500.00',
                'sellingprice' => '4500.00',
                'seq' => 5,
                'stockcode' => 'WIN BNM SYSTEM',
                'stockid' => '',
                'stockname' => 'WIN BNM MANAGEMENT SYSTEM VER 1.0 LICENSE',
                'stockspec' => '<p>* C/W ONE SHOP AND ONE COMPUTER LICENSE.</p>

<p>* C/W REMOTE COMPUTER SETUP BY TEAMVIEWER VER 12.</p>

<p>* C/W ON-LINE TRAINING.</p>

<p>* SUPPORT FOR EXISTING COMPUTER HARDWARE.</p>

<p>* ALL PRINTING REPORT FROM THIS SOFTWARE WILL DIRECT TO A4 SIZE PAPER.</p>

<p>* EXCLUDE ACCOMMODATION AND AIR FREIGHT CHARGES</p>

<p>(DEPEND ON BOOKING FREIGHT AT THAT TIME AND PAYABLE BY PURCHASER).</p>

<p>- S/N : @serialno</p>',
                'updated_at' => '2021-05-07 14:15:17',
            ),
            35 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-06-08 05:16:41',
                'description' => '',
                'id' => 51,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '780.00',
                'sellingprice' => '1080.00',
                'seq' => 26,
                'stockcode' => 'BIXOLON PRINTER',
                'stockid' => '',
                'stockname' => 'BIXOLON USB RECEIPT PRINTER',
                'stockspec' => '<p>* 1 YEAR WARRANTY ON MANUFACTURING DEFECTS.</p>

<p>* CUTTER, USB PORT, SERIAL PORT, ETHERNET PORT.</p>

<p>* C/W USB 2.0 CABLE.</p>

<p>* S/N -</p>',
                'updated_at' => '2022-11-29 11:41:30',
            ),
            36 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-06-08 05:22:14',
                'description' => '',
                'id' => 52,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '982.00',
                'sellingprice' => '1350.00',
                'seq' => 25,
                'stockcode' => 'EPSON TM-U220PA',
                'stockid' => '',
                'stockname' => 'EPSON TM-U220PA PARALLEL RECEIPT PRINTER',
                'stockspec' => '<p>* 1 YEAR WARRANTY ON MANUFACTURING DEFECTS.</p>

<p>* PARALLEL PORT , AUTO CUTTER.</p>

<p>- S/N -</p>',
                'updated_at' => '2022-06-13 07:35:16',
            ),
            37 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-06-08 05:23:50',
                'description' => '',
                'id' => 53,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '4980.00',
                'sellingprice' => '4184.65',
                'seq' => 27,
                'stockcode' => '3410 PRINTER',
                'stockid' => '',
                'stockname' => 'OKI 3410 136 COL DOT-MATRIX PRINTER',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE FOR NEW PRINTHEAD.</p>

<p>* PRINTER S/N -</p>

<p>* PRINTHEAD S/N -</p>',
                'updated_at' => '2022-06-13 07:35:09',
            ),
            38 =>
            array (
                'alw_pls' => 'Y',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => '2020-06-08 09:05:06',
                'description' => '',
                'id' => 54,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 4,
                'min_order_qty' => 8,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '20.00',
                'sellingprice' => '35.00',
                'seq' => 44,
                'stockcode' => 'BARCODERIBBON',
                'stockid' => '',
                'stockname' => 'BARCODE RIBBON',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>

<p>* 80MM X 300M (WAX).</p>',
                'updated_at' => '2023-02-28 13:06:07',
            ),
            39 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 6,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-08 09:33:41',
                'description' => '',
                'id' => 55,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '7500.00',
                'seq' => 9,
                'stockcode' => 'WIN JBS SYSTEM',
                'stockid' => '',
                'stockname' => 'WIN JBS MANAGEMENT SYSTEM VER 1.0 LICENSE',
                'stockspec' => '<p>* ORIGINAL PRICE AT RM7,500.00 / SERVER / LOCATION.</p>

<p>* ADDITIONAL WORKSTATION ADD RM500.00.</p>

<p>* C/W ONE SHOP AND ONE COMPUTER LICENSE.</p>

<p>* C/W LOCAL COMPUTER SETUP AND INSTALLATION.</p>

<p>* C/W ON-LINE TRAINING.</p>

<p>* C/W ACTUAL DAY ONE AND MONTH END SUPPORT.</p>

<p>* C/W REMINDER AND WRITE-OFF TRAINING.</p>

<p>* ALLOW INSTALLMENT FIXED BY A PERIOD SELECTED.</p>

<p>* ALLOW UPAH AND EXPIRE PERIOD ADJUST FOR EVERY TICKET.</p>

<p>* SUPPORT FOR COMPUTER HARDWARE WITH MS WINDOWS 10</p>

<p>PROFESSIONAL 64BITS OEM LICENSE.</p>

<p>* SUPPORT FOR HARDWARE WITH PARALLEL / USB PRINTER PORT</p>

<p>- S/N : @serialno.</p>',
                'updated_at' => '2021-08-17 13:23:22',
            ),
            40 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 6,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-08 12:40:40',
                'description' => '',
                'id' => 56,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '500.00',
                'seq' => 10,
                'stockcode' => 'WORK - JBS',
                'stockid' => '',
                'stockname' => 'WIN JBS MANAGEMENT SYSTEM VER 1.0 LICENSE',
                'stockspec' => '<p>* ONLINE INSTALL BY&nbsp; @user &nbsp; AT&nbsp; @installdate .</p>

<p>* FOR&nbsp; @number &nbsp; PC LICENSE.</p>

<p>* S/N : @serialno.</p>',
                'updated_at' => '2021-08-17 13:23:55',
            ),
            41 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2021-09-09 14:58:59',
                'description' => '',
                'id' => 98,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '750.00',
                'seq' => 32,
                'stockcode' => '5MP HD 2WAY CAMERA',
                'stockid' => '',
                'stockname' => '5MP HD EXTERNAL 2WAY DESKTOP CAMERA',
                'stockspec' => '<p>- S/N :</p>',
                'updated_at' => '2022-06-13 07:35:10',
            ),
            42 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => '2020-06-08 12:46:40',
                'description' => '',
                'id' => 57,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '55.00',
                'seq' => 45,
                'stockcode' => 'THERMALRIBBON',
                'stockid' => '',
                'stockname' => 'THERMAL RIBBON',
            'stockspec' => '<p>* 60MM (W) X 300M - WATER PROOF</p>

<p>* MATERIAL : RESIN.</p>

<p>* FACE OUT.</p>',
                'updated_at' => '2023-02-27 08:34:43',
            ),
            43 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => '2020-06-08 12:50:45',
                'description' => '',
                'id' => 58,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '40.00',
                'seq' => 59,
                'stockcode' => 'B LABEL WATERPROOF',
                'stockid' => '',
            'stockname' => 'BARCODE LABEL (WATER PROOF)',
            'stockspec' => '<p>* BLANK DIE-CUT LABEL 55MM (W) X 16MM (H).</p>

<p>* MATERIAL : WHITE POLYESTER (50 MICRON)</p>

<p>* PEARL WHITE WITH PERFORATION.</p>

<p>* 1 PANEL, 1 CORE, 3MM GAP.</p>

<p>* PACKING : 1000PCS PER ROLL.</p>

<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            44 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 5,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-08 12:54:46',
                'description' => '',
                'id' => 59,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '7500.00',
                'seq' => 11,
                'stockcode' => 'WINMLSSYS',
                'stockid' => '',
                'stockname' => 'WIN MONEYLENDER MANAGEMENT SYSTEM V1.0 LICENSE',
                'stockspec' => '<p>* ORIGINAL PRICE AT RM7,500.00 / SERVER / LOCATION.</p>

<p>* ADDITIONAL WORKSTATION ADD RM500.00.</p>

<p>* C/W ONE SHOP AND ONE COMPUTER LICENSE.</p>

<p>* C/W ON-LINE TRAINING.</p>

<p>* C/W REMOTE COMPUTER SETUP BY TEAMVIEWER VER 12.</p>

<p>* C/W ACTUAL DAY ONE AND MONTH END SUPPORT.</p>

<p>* C/W REMINDER AND AUCTION TRAINING.</p>

<p>* SUPPORT FOR COMPUTER HARDWARE WITH MS WINDOWS 7 / 10 PROFESSIONAL OS (64 BITS).</p>

<p>* SUPPORT FOR HARDWARE WITH PARALLEL / USB PRINTER PORT.</p>

<p>* EXCLUDE ACCOMMODATION AND AIR FREIGHT CHARGES.</p>

<p>(DEPEND ON BOOKING FREIGHT AT THAT TIME AND PAYABLE BY PURCHASER).</p>

<p>* - S/N : @serialno.</p>',
                'updated_at' => '2021-08-17 13:22:01',
            ),
            45 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 5,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-08 12:56:06',
                'description' => '',
                'id' => 60,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '500.00',
                'seq' => 12,
                'stockcode' => 'WORK - MONEY LENDER',
                'stockid' => '',
                'stockname' => 'WIN MONEYLENDER MANAGEMENT SYSTEM VER 1.0 LICENSE',
                'stockspec' => '<p>* ONLINE INSTALL BY &nbsp; @user&nbsp; AT&nbsp; @installdate&nbsp; .</p>

<p>* FOR&nbsp;&nbsp; @number &nbsp; PC LICENSE.</p>

<p>* S/N : @serialno.</p>',
                'updated_at' => '2021-08-25 07:06:40',
            ),
            46 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 8,
                'created_at' => '2020-06-08 13:02:49',
                'description' => '',
                'id' => 61,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '150.00',
                'seq' => 74,
                'stockcode' => 'LABOUR',
                'stockid' => '',
                'stockname' => 'LABOUR CHARGE',
                'stockspec' => '',
                'updated_at' => '2023-02-27 08:34:24',
            ),
            47 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 1,
                'created_at' => '2020-06-29 13:14:46',
                'description' => '',
                'id' => 15,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '0.00',
                'seq' => 76,
                'stockcode' => '99',
                'stockid' => '',
                'stockname' => 'REPLACEMENT',
                'stockspec' => NULL,
                'updated_at' => '2023-02-27 08:34:24',
            ),
            48 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 5,
                'created_at' => '2020-07-14 14:28:28',
                'description' => '@COMPANY',
                'id' => 73,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '0.00',
                'seq' => 56,
                'stockcode' => '1X80G PAWN TICKET',
                'stockid' => '',
                'stockname' => '1PLY 80GRAM COMPUTER PRE-PRINTED FORM',
                'stockspec' => '<p>* PAWN TICKET.</p>

<p>* 9.5&#39; X 11&#39; 1PLY 2UPS 80GSM PAPER.</p>

<p>* 1 BOX = 2000 FANS (4000 TICKETS).</p>

<p>* 1 COLOR FRONT AND 1 COLOR BACK.</p>',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            49 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-12-18 10:46:54',
                'description' => '',
                'id' => 90,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '136.00',
                'sellingprice' => '190.00',
                'seq' => 67,
                'stockcode' => '4 PORT USB 2.0 HUB',
                'stockid' => '',
                'stockname' => 'ATEN UH-275A 4 PORT USB 2.0 HUB',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:24',
            ),
            50 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 9,
                'created_at' => '2020-06-08 13:39:25',
                'description' => '@COMPANY',
                'id' => 64,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '0.00',
                'seq' => 17,
                'stockcode' => 'CCTV MAINTENANCE',
                'stockid' => '',
                'stockname' => 'CCTV MAINTENANCE',
                'stockspec' => '<p>* CCTV MAINTENANCE FEE FOR YEARLY BASIS.</p>

<p>* CONTRACT PERIOD : @contractdate.</p>

<p>* SERVICE DATE : @servicedate.</p>',
                'updated_at' => '2021-04-30 09:22:57',
            ),
            51 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 9,
                'created_at' => '2020-06-08 13:51:04',
                'description' => '@COMPANY',
                'id' => 65,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '0.00',
                'seq' => 14,
                'stockcode' => 'SOFT MAINTENANCE',
                'stockid' => '',
                'stockname' => 'SOFTWARE MAINTENANCE FEE',
                'stockspec' => '<p>* SOFTWARE MAINTENANCE FEE FOR @system.</p>

<p>* CONTRACT DATE : @contractdate.</p>

<p>* SERVICE DATE : @servicedate.</p>',
                'updated_at' => '2020-12-10 13:59:16',
            ),
            52 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 9,
                'created_at' => '2020-06-08 14:00:06',
                'description' => '@COMPANY',
                'id' => 66,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '0.00',
                'seq' => 15,
                'stockcode' => 'SOFTHARDMAINTENANCE',
                'stockid' => '',
                'stockname' => 'SOFTWARE & HARDWARE MAINTENANCE',
                'stockspec' => '<p>* SOFTWARE &amp; HARDWARE MAINTENANCE FEE FOR @system.</p>

<p>* CONTRACT DATE : @contractdate.</p>

<p>* SERVICE DATE : @servicedate.</p>',
                'updated_at' => '2021-04-30 09:22:21',
            ),
            53 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 8,
                'created_at' => '2020-06-08 14:30:43',
                'description' => '',
                'id' => 67,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '0.00',
                'seq' => 73,
                'stockcode' => 'AIR TICKET',
                'stockid' => '',
                'stockname' => 'AIR TICKET CHARGES',
                'stockspec' => '<p>* PERIOD :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TO</p>',
                'updated_at' => '2023-02-27 08:34:24',
            ),
            54 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 8,
                'created_at' => '2020-06-08 14:31:11',
                'description' => '',
                'id' => 68,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '200.00',
                'seq' => 62,
                'stockcode' => 'ARTWORK',
                'stockid' => '',
                'stockname' => 'ARTWORK CHARGE',
                'stockspec' => '',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            55 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-06-09 12:00:06',
                'description' => '',
                'id' => 69,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '3000.00',
                'seq' => 13,
                'stockcode' => 'SUSILICENSE',
                'stockid' => '',
                'stockname' => 'SUSI LICENSE SOFTWARE INSTALLATION & TESTING FOR SERVER ONLY',
                'stockspec' => '',
                'updated_at' => '2021-06-07 08:58:43',
            ),
            56 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-06-09 12:06:59',
                'description' => '',
                'id' => 70,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '7000.00',
                'sellingprice' => '8930.00',
                'seq' => 30,
                'stockcode' => 'BWSERVER',
                'stockid' => '',
                'stockname' => 'BRIGHT-WIN SERVER',
                'stockspec' => '<p>* 1 X INTEL SCALABLE XEON 4208 8C/16T 2.1G 11M 9.6GT UPI.</p>

<p>* X11SPM-F SERVER MOTHERBOARD.</p>

<p>* 32GB (16GB x 2) DDR4 2666MHZ RDIMM.</p>

<p>* 240GB PV310 M.2 SSD (OS).</p>

<p>* 2TB 3.5&rdquo; 7200RPM 6G ENTERPRISE SATA HARDDISK (DATA).</p>

<p>* LOGITECH K-120 USB KEYBOARD.</p>

<p>- S/N :</p>

<p>* LOGITECH M105 USB MOUSE.</p>

<p>- S/N :</p>

<p>* SPD633-X11SP PEDESTAL CHASIS.</p>

<p>- ST</p>',
                'updated_at' => '2022-06-13 07:35:09',
            ),
            57 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-12-10 14:23:07',
                'description' => '',
                'id' => 78,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '1490.31',
                'sellingprice' => '1800.00',
                'seq' => 22,
                'stockcode' => '790T PRINTER',
                'stockid' => '',
                'stockname' => 'OKI ML790T PLUS 80 COL DOT-MATRIX PRINTER',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE FOR NEW PRINTHEAD.</p>

<p>- PRINTER S/N -</p>

<p>- PRINTHEAD S/N -</p>',
                'updated_at' => '2022-06-13 07:35:15',
            ),
            58 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 8,
                'created_at' => '2020-12-10 14:24:34',
                'description' => '',
                'id' => 79,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '601.00',
                'sellingprice' => '680.00',
                'seq' => 37,
                'stockcode' => 'WIN 10 64 BIT OEM',
                'stockid' => '',
                'stockname' => 'MICROSOFT WINDOWS 10 PRO 64 BITS OEM LICENSE',
                'stockspec' => '<p>- PRODUCT KEY :</p>',
                'updated_at' => '2023-02-27 08:34:49',
            ),
            59 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-12-10 14:25:44',
                'description' => '',
                'id' => 80,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '685.00',
                'sellingprice' => '1100.00',
                'seq' => 36,
                'stockcode' => '2000VA UPS',
                'stockid' => '',
                'stockname' => 'SYLION S-200EU LINE -INTERACTIVE UPS',
                'stockspec' => '<p>* 1 YEAR WARRANTY.</p>

<p>- S/N :</p>',
                'updated_at' => '2023-02-27 08:34:49',
            ),
            60 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-12-10 14:27:17',
                'description' => '',
                'id' => 81,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '50.00',
                'sellingprice' => '80.00',
                'seq' => 66,
                'stockcode' => '4 GANG EXTENSION PLU',
                'stockid' => '',
                'stockname' => 'STERNGATE T5 4 GANG EXTENSION WITH IEC CONNECTOR',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>

<p>-S/N :</p>',
                'updated_at' => '2023-02-27 08:34:24',
            ),
            61 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-12-11 05:46:38',
                'description' => '',
                'id' => 82,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '236.00',
                'sellingprice' => '290.00',
                'seq' => 49,
                'stockcode' => 'OKI ML390 TRACTOR',
                'stockid' => '',
                'stockname' => 'OKI ML390 / 391 TRACTOR',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-03-16 10:18:30',
            ),
            62 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 3,
                'created_at' => '2020-12-11 05:51:55',
                'description' => '',
                'id' => 83,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '25.00',
                'sellingprice' => '30.00',
                'seq' => 46,
                'stockcode' => 'FULLMARK FX 2190',
                'stockid' => '',
                'stockname' => 'FULLMARK FX 2190 RIBBON',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:43',
            ),
            63 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => '2020-12-11 05:52:31',
                'description' => '',
                'id' => 84,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '6.50',
                'sellingprice' => '13.00',
                'seq' => 47,
                'stockcode' => 'FULLMARK LQ 310',
                'stockid' => '',
                'stockname' => 'FULLMARK LQ 310 RIBBON',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:43',
            ),
            64 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => '2020-12-11 05:53:09',
                'description' => '',
                'id' => 85,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '6.50',
                'sellingprice' => '14.00',
                'seq' => 48,
                'stockcode' => 'FULLMARK 390 RIBBON',
                'stockid' => '',
                'stockname' => 'FULLMARK 390 RIBBON',
                'stockspec' => '<p>* NO WARRANTY AVAILABLE.</p>',
                'updated_at' => '2023-02-27 08:34:43',
            ),
            65 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 10,
                'stock_categories_id' => 9,
                'created_at' => '2020-12-14 05:44:39',
                'description' => 'DOMAIN NAME FOR YEAR @YEAR',
                'id' => 88,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '150.00',
                'seq' => 18,
                'stockcode' => 'DOMAIN NAME',
                'stockid' => '',
                'stockname' => 'DOMAIN NAME',
                'stockspec' => '<p><span style="font-family:sans-serif">* DYNDNS CCTV DOMAIN CONNECTION.<br />
* NAME REGISTRATION YEARLY FOR @YEAR CHARGE.</span><br />
<span style="font-size:11px">* @adrmk</span></p>',
                'updated_at' => '2021-04-30 09:23:12',
            ),
            66 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 4,
                'created_at' => '2020-12-15 06:15:26',
                'description' => '',
                'id' => 89,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '68.00',
                'sellingprice' => '80.00',
                'seq' => 54,
                'stockcode' => '9.5" X 11" 2PLY NCR',
                'stockid' => '',
                'stockname' => '9.5" X 11" 2PLY 2UPS NCR PLAIN FORM',
                'stockspec' => '<p>* 1 BOX = 1000 FANS.</p>',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            67 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 9,
                'created_at' => '2020-12-20 09:04:05',
                'description' => '@COMPANY',
                'id' => 91,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '0.00',
                'seq' => 16,
                'stockcode' => 'QNE MAINTENANCE',
                'stockid' => '',
                'stockname' => 'QNE ACCOUNT MAINTENANCE',
                'stockspec' => '<p>* SOFTWARE MAINTENANCE FEE FOR @system.</p>

<p>* CONTRACT DATE : @contractdate.</p>

<p>* PRODUCT ID : @adrmk.<br />
&nbsp;</p>',
                'updated_at' => '2021-04-30 09:22:44',
            ),
            68 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'Y',
                'b_serial' => 'Y',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2020-12-28 08:24:41',
                'description' => '',
                'id' => 92,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '830.00',
                'sellingprice' => '1030.00',
                'seq' => 24,
                'stockcode' => 'EPSON TM-U220B',
                'stockid' => '',
                'stockname' => 'EPSON TM-U220B USB RECEIPT PRINTER',
                'stockspec' => '<p>* AUTO CUTTER.</p>

<p>* BLACK COLOR.</p>

<p>* NO WARRANTY AVAILABLE FOR NEW PRINTHEAD.</p>

<p>- PRINTER S/N -</p>

<p>- PRINTHEAD S/N -</p>',
                'updated_at' => '2022-06-13 07:35:15',
            ),
            69 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2021-01-02 11:08:29',
                'description' => '',
                'id' => 94,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 99999,
                'min_order_qty' => 99999,
                'opening_year' => 2021,
                'opening_year_qty' => 99999,
                'purchaseprice' => '0.00',
                'sellingprice' => '160.00',
                'seq' => 63,
                'stockcode' => 'GOLD STICKER',
                'stockid' => '',
                'stockname' => 'GOLD STICKER',
                'stockspec' => '<p>* 1 PACK = 10,000 PCS STICKER.</p>',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            70 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 4,
                'created_at' => '2021-01-29 13:42:38',
                'description' => '',
                'id' => 95,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 0,
                'opening_year_qty' => 0,
                'purchaseprice' => '50.00',
                'sellingprice' => '60.00',
                'seq' => 53,
                'stockcode' => '1PLY 2UPS 60GSM',
                'stockid' => '',
                'stockname' => '9.5" X 11" 1PLY 2UPS 60GSM PLAIN FORM',
                'stockspec' => '<p>* 1 BOX = 2000 FANS.</p>',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            71 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 2,
                'stock_categories_id' => 1,
                'created_at' => '2021-03-22 12:40:44',
                'description' => '',
                'id' => 96,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '100.00',
                'seq' => 8,
                'stockcode' => 'GSS-POS SYSTEM',
                'stockid' => '',
                'stockname' => 'WIN GOLDSMITH CLIENT POS SYSTEM VER 1.0 LICENSE',
                'stockspec' => '<p>* ONLINE INSTALL BY&nbsp;&nbsp;&nbsp; @user &nbsp;&nbsp; AT @installdate&nbsp; . &nbsp;&nbsp;&nbsp;<br />
* FOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; UNIT PAD LICENSE.</p>',
                'updated_at' => '2021-08-17 13:21:21',
            ),
            72 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 12,
                'created_at' => '2021-06-10 06:40:06',
                'description' => '',
                'id' => 97,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 1,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '90.00',
                'seq' => 1,
                'stockcode' => 'ON LOAN - 391T 1',
                'stockid' => '',
                'stockname' => 'OKI 391T 136 COL DOT MATRIX PRINTER',
                'stockspec' => '<p>- OKI391T 136 COL DOT MATRIX PRINTER.<br />
- WITH FRONT COVER &amp; PULL UP ROLLER<br />
- PRINTER S/N : 001C1008418.<br />
- PRINTHEAD S/N : 43161380.</p>',
                'updated_at' => '2023-05-23 13:11:17',
            ),
            73 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 12,
                'created_at' => '2021-11-30 08:13:11',
                'description' => '',
                'id' => 99,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 1,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '90.00',
                'seq' => 4,
                'stockcode' => 'ON LOAN - 391T 4',
                'stockid' => '',
                'stockname' => 'OKI 391T 136 COL DOT-MATRIX PRINTER',
                'stockspec' => '<p>-OKI ML391T 136 COL DOT MATRIX PRINTER.</p>

<p>- WITH FRONT COVER &amp; PULL UP ROLLER.</p>

<p>- PRINTER S/N : 203C1016711</p>

<p>- PRINTHEAD S/N : 73235397</p>',
                'updated_at' => '2023-05-23 13:11:17',
            ),
            74 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 12,
                'created_at' => '2021-11-30 08:14:56',
                'description' => '',
                'id' => 100,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 1,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '90.00',
                'seq' => 5,
                'stockcode' => 'ON LOAN - 391T 5',
                'stockid' => '',
                'stockname' => 'OKI ML391T 136 COL DOT MATRIX PRINTER',
                'stockspec' => '<p>- OKI ML391T 136 COL DOT MATRIX PRINTER.</p>

<p>- WITH FRONT COVER &amp; PULL UP ROLLER.</p>

<p>- PRINTER S/N : 203C1016752</p>

<p>- PRINTHEAD S/N : 54255867</p>

<p>&nbsp;</p>',
                'updated_at' => '2023-05-23 13:11:17',
            ),
            75 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 12,
                'created_at' => '2021-11-30 08:17:01',
                'description' => '',
                'id' => 101,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 1,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '99.00',
                'seq' => 9,
                'stockcode' => 'ON LOAN - 391T 10',
                'stockid' => '',
                'stockname' => 'OKI ML391T 136 COL DOT MATRIX PRINTER',
                'stockspec' => '<p>- OKI ML391T 136 COL DOT MATRIX PRINTER.</p>

<p>- WITH FRONT COVER &amp; PULL UP ROLLER.</p>

<p>- PRINTER S/N : 205C1017767</p>

<p>- PRINTHEAD S/N : 29090174</p>',
                'updated_at' => '2023-05-23 13:18:09',
            ),
            76 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 12,
                'created_at' => '2021-11-30 08:19:21',
                'description' => '',
                'id' => 102,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 1,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '99.00',
                'seq' => 2,
                'stockcode' => 'ON LOAN - 391T 2',
                'stockid' => '',
                'stockname' => 'OKI ML391T 136 COL DOT MATRIX PRINTER',
                'stockspec' => '<p>- OKI ML391T 136 COL DOT-MATRIX PRINTER.</p>

<p>- WITH FRONT COVER &amp; PULL UP ROLLER.</p>

<p>- PRINTER S/N : 804C1005630</p>

<p>- PRINTHEAD S/N : 72140413</p>',
                'updated_at' => '2023-05-23 13:19:06',
            ),
            77 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 12,
                'created_at' => '2021-11-30 08:20:57',
                'description' => '',
                'id' => 103,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 1,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '99.00',
                'seq' => 7,
                'stockcode' => 'ON LOAN - 391T 7',
                'stockid' => '',
                'stockname' => 'OKI ML391T 136 COL DOT MATRIX PRINTER',
                'stockspec' => '<p>- OKI ML391T 136 COL DOT MATRIX PRINTER.</p>

<p>- WITH FRONT COVER &amp; PULL UP ROLLER.</p>

<p>- PRINTER S/N : 005C1009604.</p>

<p>- PRINTHEAD S/N : 06105257.</p>',
                'updated_at' => '2023-05-23 13:11:17',
            ),
            78 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 12,
                'created_at' => '2021-11-30 08:59:07',
                'description' => '',
                'id' => 104,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 1,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '99.00',
                'seq' => 8,
                'stockcode' => 'ON LOAN - 391T 9',
                'stockid' => '',
                'stockname' => 'OKI ML391T 136 COL DOT MATRIX PRINTER',
                'stockspec' => '<p>- OKI ML391T 136 COL DOT-MATRIX PRINTER.</p>

<p>- WITH FRONT COVER &amp; PULL UP ROLLER.</p>

<p>- PRINTER S/N : AE91031717E0</p>

<p>- PRINTHEAD S/N : 45095076</p>',
                'updated_at' => '2023-05-23 13:16:22',
            ),
            79 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 12,
                'created_at' => '2021-11-30 09:00:24',
                'description' => '',
                'id' => 105,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 1,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '99.00',
                'seq' => 10,
                'stockcode' => 'ON LOAN - 391T 11',
                'stockid' => '',
                'stockname' => 'OKI ML391T 136 COL DOT MATRIX PRINTER',
                'stockspec' => '<p>- OKI ML391T 136 COL DOT-MATRIX PRINTER.</p>

<p>- WITH FRONT COVER &amp; PULL UP ROLLER.</p>

<p>- PRINTER S/N : AE7C000314E0</p>

<p>- PRINTHEAD S/N : 7B3145921</p>',
                'updated_at' => '2023-05-23 13:18:09',
            ),
            80 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 12,
                'created_at' => '2021-11-30 09:02:08',
                'description' => '',
                'id' => 106,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 1,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '99.00',
                'seq' => 3,
                'stockcode' => 'ON LOAN - 391T 3',
                'stockid' => '',
                'stockname' => 'OKI ML391T 136 COL DOT MATRIX PRINTER',
                'stockspec' => '<p>- OKI ML391T 136 COL DOT MATRIX PRINTER.</p>

<p>- WITH FRONT COVER &amp; PULL UP ROLLER.</p>

<p>- PRINTER S/N : 005C1009621.</p>

<p>- PRINTHEAD S/N : 24200543.</p>',
                'updated_at' => '2023-05-23 13:19:06',
            ),
            81 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => NULL,
                'stock_categories_id' => 12,
                'created_at' => '2021-11-30 09:03:16',
                'description' => '',
                'id' => 107,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 1,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '0.00',
                'sellingprice' => '99.00',
                'seq' => 6,
                'stockcode' => 'ON LOAN - 391T 6',
                'stockid' => '',
                'stockname' => 'OKI ML391T 136 COL DOT MATRIX PRINTER',
                'stockspec' => '<p>- OKI ML391T 136 COL DOT MATRIX PRINTER.</p>

<p>- WITH FRONT COVER &amp; PULL UP ROLLER.</p>

<p>- PRINTER S/N : 52010732E0</p>

<p>- PRINTHEAD S/N : 5A135986</p>',
                'updated_at' => '2023-05-23 13:11:17',
            ),
            82 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2022-03-28 11:12:12',
                'description' => '',
                'id' => 108,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '203.00',
                'sellingprice' => '290.00',
                'seq' => 50,
                'stockcode' => 'OKI ML391T',
                'stockid' => '',
                'stockname' => 'OKI ML391T PULL-UP-ROLLER',
                'stockspec' => '',
                'updated_at' => '2023-03-16 10:19:25',
            ),
            83 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 3,
                'created_at' => '2022-04-14 08:40:22',
                'description' => '',
                'id' => 109,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 10,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '49.00',
                'sellingprice' => '85.00',
                'seq' => 61,
                'stockcode' => 'BARCODE LABEL 30X70',
                'stockid' => '',
                'stockname' => 'BARCODE LABEL 30X70',
            'stockspec' => '<p>* 30MM(W)&nbsp; X 70MM (H) ART PAPER WITH SPECIAL DIE CUT.</p>

<p>* 1 ROLL = 1000PCS LABEL.</p>

<p>* WHITE COLOR.</p>',
                'updated_at' => '2023-02-27 08:34:33',
            ),
            84 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2022-06-08 07:17:24',
                'description' => '',
                'id' => 110,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '1262.97',
                'sellingprice' => '1580.00',
                'seq' => 19,
                'stockcode' => 'OKI ML320T PRINTER',
                'stockid' => '',
                'stockname' => 'OKI ML320T PLUS DOT-MATRIX PRINTER',
                'stockspec' => '',
                'updated_at' => '2022-06-13 07:35:16',
            ),
            85 =>
            array (
                'alw_pls' => 'N',
                'auto_send_purchase' => 'N',
                'b_serial' => 'N',
                'customer_categories_id' => 0,
                'stock_categories_id' => 2,
                'created_at' => '2023-02-27 08:33:47',
                'description' => '',
                'id' => 111,
                'lastpurchaseprice' => '0.00',
                'lastsellingprice' => '0.00',
                'loan_flag' => 0,
                'min_lvl_qty' => 0,
                'min_order_qty' => 0,
                'opening_year' => 2021,
                'opening_year_qty' => 0,
                'purchaseprice' => '776.00',
                'sellingprice' => '950.00',
                'seq' => 34,
                'stockcode' => 'THUMB READER',
                'stockid' => '',
                'stockname' => 'MSO 1300V3 THUMB PRINT READER',
                'stockspec' => '<p>MODEL:MSO1300V3</p>',
                'updated_at' => '2023-02-27 08:35:18',
            ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
