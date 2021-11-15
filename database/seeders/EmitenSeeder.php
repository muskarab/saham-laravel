<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmitenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Konvensional
        DB::table('emitens')->insert([
            'emiten_char' => 'ADHI',
            'perusahaan' => 'ADHI',
            'index_id' => 1,
            'sektor_id' => 8,
            'deskripsi' => 'Desc ADHI',
            'eps' => 119.0000,
            'roe' => 3.5804,
            'per' => 11.6300,
            'der' => 3.4600,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'ADRO',
            'perusahaan' => 'ADRO',
            'index_id' => 1,
            'sektor_id' => 4,
            'deskripsi' => 'Desc ADRO',
            'eps' => 176.0000,
            'roe' => 5.3779,
            'per' => 10.4300,
            'der' => 0.6300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'AKRA',
            'perusahaan' => 'AKRA',
            'index_id' => 1,
            'sektor_id' => 4,
            'deskripsi' => 'Desc AKRA',
            'eps' => 558.0000,
            'roe' => 11.1855,
            'per' => 6.5700,
            'der' => 0.9500,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'ANTM',
            'perusahaan' => 'ANTM',
            'index_id' => 1,
            'sektor_id' => 1,
            'deskripsi' => 'Desc ANTM',
            'eps' => 29.0000,
            'roe' => 1.8249,
            'per' => 29.4800,
            'der' => 0.6600,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'ASII',
            'perusahaan' => 'ASII',
            'index_id' => 1,
            'sektor_id' => 7,
            'deskripsi' => 'Desc ASII',
            'eps' => 513.0000,
            'roe' => 8.1505,
            'per' => 14.3300,
            'der' => 0.9100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BBCA',
            'perusahaan' => 'BBCA',
            'index_id' => 1,
            'sektor_id' => 5,
            'deskripsi' => 'Desc BBCA',
            'eps' => 936.0000,
            'roe' => 8.3467,
            'per' => 25.8100,
            'der' => 4.7500,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BBNI',
            'perusahaan' => 'BBNI',
            'index_id' => 1,
            'sektor_id' => 5,
            'deskripsi' => 'Desc BBNI',
            'eps' => 806.0000,
            'roe' => 7.4226,
            'per' => 9.1900,
            'der' => 6.0600,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BBRI',
            'perusahaan' => 'BBRI',
            'index_id' => 1,
            'sektor_id' => 5,
            'deskripsi' => 'Desc BBRI',
            'eps' => 244.0000,
            'roe' => 8.9597,
            'per' => 12.9200,
            'der' => 5.9200,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BBTN',
            'perusahaan' => 'BBTN',
            'index_id' => 1,
            'sektor_id' => 5,
            'deskripsi' => 'Desc BBTN',
            'eps' => 272.0000,
            'roe' => 6.3631,
            'per' => 9.6800,
            'der' => 10.2600,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BJBR',
            'perusahaan' => 'BJBR',
            'index_id' => 1,
            'sektor_id' => 5,
            'deskripsi' => 'Desc BJBR',
            'eps' => 188.0000,
            'roe' => 8.1117,
            'per' => 10.8100,
            'der' => 8.7100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BKSL',
            'perusahaan' => 'BKSL',
            'index_id' => 1,
            'sektor_id' => 9,
            'deskripsi' => 'Desc BKSL',
            'eps' => 2.0000,
            'roe' => 0.5103,
            'per' => 60.4300,
            'der' => 0.5600,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BMRI',
            'perusahaan' => 'BMRI',
            'index_id' => 1,
            'sektor_id' => 5,
            'deskripsi' => 'Desc BMRI',
            'eps' => 527.0000,
            'roe' => 7.3976,
            'per' => 12.7600,
            'der' => 5.3900,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BRPT',
            'perusahaan' => 'BRPT',
            'index_id' => 1,
            'sektor_id' => 1,
            'deskripsi' => 'Desc BRPT',
            'eps' => 67.0000,
            'roe' => 5.1648,
            'per' => 27.2800,
            'der' => 1.5600,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BSDE',
            'perusahaan' => 'BSDE',
            'index_id' => 1,
            'sektor_id' => 9,
            'deskripsi' => 'Desc BSDE',
            'eps' => 43.0000,
            'roe' => 1.9481,
            'per' => 27.1600,
            'der' => 0.7300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'ELSA',
            'perusahaan' => 'ELSA',
            'index_id' => 1,
            'sektor_id' => 4,
            'deskripsi' => 'Desc ELSA',
            'eps' => 35.0000,
            'roe' => 4.0545,
            'per' => 10.6300,
            'der' => 0.6700,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'EXCL',
            'perusahaan' => 'EXCL',
            'index_id' => 1,
            'sektor_id' => 8,
            'deskripsi' => 'Desc EXCL',
            'eps' => -15.0000,
            'roe' => -0.3806,
            'per' => -180.4400,
            'der' => 1.6200,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'GGRM',
            'perusahaan' => 'GGRM',
            'index_id' => 1,
            'sektor_id' => 3,
            'deskripsi' => 'Desc GGRM',
            'eps' => 3695.0000,
            'roe' => 8.7285,
            'per' => 20.0400,
            'der' => 0.6200,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'HMSP',
            'perusahaan' => 'HMSP',
            'index_id' => 1,
            'sektor_id' => 3,
            'deskripsi' => 'Desc HMSP',
            'eps' => 105.0000,
            'roe' => 22.0535,
            'per' => 36.6300,
            'der' => 0.5800,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'ICBP',
            'perusahaan' => 'ICBP',
            'index_id' => 1,
            'sektor_id' => 3,
            'deskripsi' => 'Desc ICBP',
            'eps' => 393.0000,
            'roe' => 11.2259,
            'per' => 22.4600,
            'der' => 0.6900,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'INCO',
            'perusahaan' => 'INCO',
            'index_id' => 1,
            'sektor_id' => 1,
            'deskripsi' => 'Desc INCO',
            'eps' => 85.0000,
            'roe' => 1.5883,
            'per' => 43.5400,
            'der' => 0.1700,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'INDF',
            'perusahaan' => 'INDF',
            'index_id' => 1,
            'sektor_id' => 3,
            'deskripsi' => 'Desc INDF',
            'eps' => 446.0000,
            'roe' => 5.1597,
            'per' => 13.2400,
            'der' => 0.9800,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'INDY',
            'perusahaan' => 'INDY',
            'index_id' => 1,
            'sektor_id' => 4,
            'deskripsi' => 'Desc INDY',
            'eps' => 422.0000,
            'roe' => 7.5319,
            'per' => 6.6400,
            'der' => 2.1000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'INKP',
            'perusahaan' => 'INKP',
            'index_id' => 1,
            'sektor_id' => 1,
            'deskripsi' => 'Desc INKP',
            'eps' => 1793.0000,
            'roe' => 9.6803,
            'per' => 9.6800,
            'der' => 1.3500,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'INTP',
            'perusahaan' => 'INTP',
            'index_id' => 1,
            'sektor_id' => 1,
            'deskripsi' => 'Desc INTP',
            'eps' => 193.0000,
            'roe' => 1.5894,
            'per' => 95.8900,
            'der' => 0.1800,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'ITMG',
            'perusahaan' => 'ITMG',
            'index_id' => 1,
            'sektor_id' => 4,
            'deskripsi' => 'Desc ITMG',
            'eps' => 2625.0000,
            'roe' => 11.4116,
            'per' => 9.8500,
            'der' => 0.4600,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'JSMR',
            'perusahaan' => 'JSMR',
            'index_id' => 1,
            'sektor_id' => 8,
            'deskripsi' => 'Desc JSMR',
            'eps' => 288.0000,
            'roe' => 5.0254,
            'per' => 15.5100,
            'der' => 3.5300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'KLBF',
            'perusahaan' => 'KLBF',
            'index_id' => 1,
            'sektor_id' => 6,
            'deskripsi' => 'Desc KLBF',
            'eps' => 52.0000,
            'roe' => 8.8248,
            'per' => 26.6000,
            'der' => 0.2800,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'LPKR',
            'perusahaan' => 'LPKR',
            'index_id' => 1,
            'sektor_id' => 9,
            'deskripsi' => 'Desc LPKR',
            'eps' => 23.0000,
            'roe' => 0.6048,
            'per' => 14.9500,
            'der' => 0.9300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'LPPF',
            'perusahaan' => 'LPPF',
            'index_id' => 1,
            'sektor_id' => 2,
            'deskripsi' => 'Desc LPPF',
            'eps' => 922.0000,
            'roe' => 57.5278,
            'per' => 7.5100,
            'der' => 1.8700,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'MEDC',
            'perusahaan' => 'MEDC',
            'index_id' => 1,
            'sektor_id' => 4,
            'deskripsi' => 'Desc MEDC',
            'eps' => 67.0000,
            'roe' => 3.5273,
            'per' => 14.9000,
            'der' => 2.5200,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'MNCN',
            'perusahaan' => 'MNCN',
            'index_id' => 1,
            'sektor_id' => 2,
            'deskripsi' => 'Desc MNCN',
            'eps' => 89.0000,
            'roe' => 6.6390,
            'per' => 9.0300,
            'der' => 0.5900,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'PGAS',
            'perusahaan' => 'PGAS',
            'index_id' => 1,
            'sektor_id' => 4,
            'deskripsi' => 'Desc PGAS',
            'eps' => 173.0000,
            'roe' => 4.5072,
            'per' => 12.9700,
            'der' => 0.9900,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'PTBA',
            'perusahaan' => 'PTBA',
            'index_id' => 1,
            'sektor_id' => 4,
            'deskripsi' => 'Desc PTBA',
            'eps' => 447.0000,
            'roe' => 20.2270,
            'per' => 9.6600,
            'der' => 0.5900,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'PTPP',
            'perusahaan' => 'PTPP',
            'index_id' => 1,
            'sektor_id' => 8,
            'deskripsi' => 'Desc PTPP',
            'eps' => 155.0000,
            'roe' => 4.2956,
            'per' => 9.8500,
            'der' => 1.9900,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'SCMA',
            'perusahaan' => 'SCMA',
            'index_id' => 1,
            'sektor_id' => 2,
            'deskripsi' => 'Desc SCMA',
            'eps' => 116.0000,
            'roe' => 17.7105,
            'per' => 16.2300,
            'der' => 0.3100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'SMGR',
            'perusahaan' => 'SMGR',
            'index_id' => 1,
            'sektor_id' => 1,
            'deskripsi' => 'Desc SMGR',
            'eps' => 328.0000,
            'roe' => 3.1505,
            'per' => 30.3000,
            'der' => 0.6100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'SRIL',
            'perusahaan' => 'SRIL',
            'index_id' => 1,
            'sektor_id' => 2,
            'deskripsi' => 'Desc SRIL',
            'eps' => 79.0000,
            'roe' => 11.5808,
            'per' => 4.3400,
            'der' => 1.6800,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'SSMS',
            'perusahaan' => 'SSMS',
            'index_id' => 1,
            'sektor_id' => 3,
            'deskripsi' => 'Desc SSMS',
            'eps' => 69.0000,
            'roe' => 7.6064,
            'per' => 18.7400,
            'der' => 1.5100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'TLKM',
            'perusahaan' => 'TLKM',
            'index_id' => 1,
            'sektor_id' => 8,
            'deskripsi' => 'Desc TLKM',
            'eps' => 176.0000,
            'roe' => 13.0262,
            'per' => 20.7300,
            'der' => 1.0500,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'TPIA',
            'perusahaan' => 'TPIA',
            'index_id' => 1,
            'sektor_id' => 1,
            'deskripsi' => 'Desc TPIA',
            'eps' => 186.0000,
            'roe' => 6.6613,
            'per' => 26.4400,
            'der' => 0.7300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'UNTR',
            'perusahaan' => 'UNTR',
            'index_id' => 1,
            'sektor_id' => 7,
            'deskripsi' => 'Desc UNTR',
            'eps' => 2938.0000,
            'roe' => 11.1178,
            'per' => 11.2300,
            'der' => 0.7200,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'UNVR',
            'perusahaan' => 'UNVR',
            'index_id' => 1,
            'sektor_id' => 3,
            'deskripsi' => 'Desc UNVR',
            'eps' => 925.0000,
            'roe' => 70.4310,
            'per' => 50.8200,
            'der' => 3.1000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'WIKA',
            'perusahaan' => 'WIKA',
            'index_id' => 1,
            'sektor_id' => 8,
            'deskripsi' => 'Desc WIKA',
            'eps' => 115.0000,
            'roe' => 4.2276,
            'per' => 11.8400,
            'der' => 2.6100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'WSBP',
            'perusahaan' => 'WSBP',
            'index_id' => 1,
            'sektor_id' => 1,
            'deskripsi' => 'Desc WSBP',
            'eps' => 52.0000,
            'roe' => 9.5218,
            'per' => 6.8300,
            'der' => 1.0300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'WSKT',
            'perusahaan' => 'WSKT',
            'index_id' => 1,
            'sektor_id' => 8,
            'deskripsi' => 'Desc WSKT',
            'eps' => 441.0000,
            'roe' => 15.0774,
            'per' => 3.8600,
            'der' => 3.4800,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //Syariah
        DB::table('emitens')->insert([
            'emiten_char' => 'ADRO',
            'perusahaan' => 'ADRO',
            'index_id' => 2,
            'sektor_id' => 4,
            'deskripsi' => 'Desc ADRO',
            'eps' => 176.0000,
            'roe' => 5.3779,
            'per' => 10.4300,
            'der' => 0.6300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'AKRA',
            'perusahaan' => 'AKRA',
            'index_id' => 2,
            'sektor_id' => 4,
            'deskripsi' => 'Desc AKRA',
            'eps' => 558.0000,
            'roe' => 11.1855,
            'per' => 6.5700,
            'der' => 0.9500,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'ANTM',
            'perusahaan' => 'ANTM',
            'index_id' => 2,
            'sektor_id' => 1,
            'deskripsi' => 'Desc ANTM',
            'eps' => 29.0000,
            'roe' => 1.8249,
            'per' => 29.4800,
            'der' => 0.6600,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'ASII',
            'perusahaan' => 'ASII',
            'index_id' => 2,
            'sektor_id' => 7,
            'deskripsi' => 'Desc ASII',
            'eps' => 513.0000,
            'roe' => 8.1505,
            'per' => 14.3300,
            'der' => 0.9100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BRPT',
            'perusahaan' => 'BRPT',
            'index_id' => 2,
            'sektor_id' => 1,
            'deskripsi' => 'Desc BRPT',
            'eps' => 67.0000,
            'roe' => 5.1648,
            'per' => 27.2800,
            'der' => 1.5600,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'BSDE',
            'perusahaan' => 'BSDE',
            'index_id' => 2,
            'sektor_id' => 9,
            'deskripsi' => 'Desc BSDE',
            'eps' => 43.0000,
            'roe' => 1.9481,
            'per' => 27.1600,
            'der' => 0.7300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'CTRA',
            'perusahaan' => 'CTRA',
            'index_id' => 2,
            'sektor_id' => 9,
            'deskripsi' => 'Desc CTRA',
            'eps' => 19.0000,
            'roe' => 1.4552,
            'per' => 46.0800,
            'der' => 1.1300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'EXCL',
            'perusahaan' => 'EXCL',
            'index_id' => 2,
            'sektor_id' => 8,
            'deskripsi' => 'Desc EXCL',
            'eps' => -15.0000,
            'roe' => -0.3806,
            'per' => -180.4400,
            'der' => 1.6200,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'ICBP',
            'perusahaan' => 'ICBP',
            'index_id' => 2,
            'sektor_id' => 3,
            'deskripsi' => 'Desc ICBP',
            'eps' => 393.0000,
            'roe' => 11.2259,
            'per' => 22.4600,
            'der' => 0.6900,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'INCO',
            'perusahaan' => 'INCO',
            'index_id' => 2,
            'sektor_id' => 1,
            'deskripsi' => 'Desc INCO',
            'eps' => 85.0000,
            'roe' => 1.5883,
            'per' => 43.5400,
            'der' => 0.1700,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'INDF',
            'perusahaan' => 'INDF',
            'index_id' => 2,
            'sektor_id' => 3,
            'deskripsi' => 'Desc INDF',
            'eps' => 446.0000,
            'roe' => 5.1597,
            'per' => 13.2400,
            'der' => 0.9800,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'INDY',
            'perusahaan' => 'INDY',
            'index_id' => 2,
            'sektor_id' => 4,
            'deskripsi' => 'Desc INDY',
            'eps' => 422.0000,
            'roe' => 7.5319,
            'per' => 6.6400,
            'der' => 2.1000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'INTP',
            'perusahaan' => 'INTP',
            'index_id' => 2,
            'sektor_id' => 1,
            'deskripsi' => 'Desc INTP',
            'eps' => 193.0000,
            'roe' => 1.5894,
            'per' => 95.8900,
            'der' => 0.1800,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'ITMG',
            'perusahaan' => 'ITMG',
            'index_id' => 2,
            'sektor_id' => 4,
            'deskripsi' => 'Desc ITMG',
            'eps' => 2625.0000,
            'roe' => 11.4116,
            'per' => 9.8500,
            'der' => 0.4600,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'KLBF',
            'perusahaan' => 'KLBF',
            'index_id' => 2,
            'sektor_id' => 6,
            'deskripsi' => 'Desc KLBF',
            'eps' => 52.0000,
            'roe' => 8.8248,
            'per' => 26.6000,
            'der' => 0.2800,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'LPKR',
            'perusahaan' => 'LPKR',
            'index_id' => 2,
            'sektor_id' => 9,
            'deskripsi' => 'Desc LPKR',
            'eps' => 23.0000,
            'roe' => 0.6048,
            'per' => 14.9500,
            'der' => 0.9300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'LPPF',
            'perusahaan' => 'LPPF',
            'index_id' => 2,
            'sektor_id' => 2,
            'deskripsi' => 'Desc LPPF',
            'eps' => 922.0000,
            'roe' => 57.5278,
            'per' => 7.5100,
            'der' => 1.8700,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'PGAS',
            'perusahaan' => 'PGAS',
            'index_id' => 2,
            'sektor_id' => 4,
            'deskripsi' => 'Desc PGAS',
            'eps' => 173.0000,
            'roe' => 4.5072,
            'per' => 12.9700,
            'der' => 0.9900,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'PTBA',
            'perusahaan' => 'PTBA',
            'index_id' => 2,
            'sektor_id' => 4,
            'deskripsi' => 'Desc PTBA',
            'eps' => 447.0000,
            'roe' => 20.2270,
            'per' => 9.6600,
            'der' => 0.5900,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'PTPP',
            'perusahaan' => 'PTPP',
            'index_id' => 2,
            'sektor_id' => 8,
            'deskripsi' => 'Desc PTPP',
            'eps' => 155.0000,
            'roe' => 4.2956,
            'per' => 9.8500,
            'der' => 1.9900,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'SCMA',
            'perusahaan' => 'SCMA',
            'index_id' => 2,
            'sektor_id' => 2,
            'deskripsi' => 'Desc SCMA',
            'eps' => 116.0000,
            'roe' => 17.7105,
            'per' => 16.2300,
            'der' => 0.3100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'SMGR',
            'perusahaan' => 'SMGR',
            'index_id' => 2,
            'sektor_id' => 1,
            'deskripsi' => 'Desc SMGR',
            'eps' => 328.0000,
            'roe' => 3.1505,
            'per' => 30.3000,
            'der' => 0.6100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'SMRA',
            'perusahaan' => 'SMRA',
            'index_id' => 2,
            'sektor_id' => 9,
            'deskripsi' => 'Desc SMRA',
            'eps' => 11.0000,
            'roe' => 2.3894,
            'per' => 60.2800,
            'der' => 1.7400,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'TLKM',
            'perusahaan' => 'TLKM',
            'index_id' => 2,
            'sektor_id' => 8,
            'deskripsi' => 'Desc TLKM',
            'eps' => 176.0000,
            'roe' => 13.0262,
            'per' => 20.7300,
            'der' => 1.0500,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'TPIA',
            'perusahaan' => 'TPIA',
            'index_id' => 2,
            'sektor_id' => 1,
            'deskripsi' => 'Desc TPIA',
            'eps' => 186.0000,
            'roe' => 6.6613,
            'per' => 26.4400,
            'der' => 0.7300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'UNTR',
            'perusahaan' => 'UNTR',
            'index_id' => 2,
            'sektor_id' => 7,
            'deskripsi' => 'Desc UNTR',
            'eps' => 2938.0000,
            'roe' => 11.1178,
            'per' => 11.2300,
            'der' => 0.7200,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'UNVR',
            'perusahaan' => 'UNVR',
            'index_id' => 2,
            'sektor_id' => 3,
            'deskripsi' => 'Desc UNVR',
            'eps' => 925.0000,
            'roe' => 70.4310,
            'per' => 50.8200,
            'der' => 3.1000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'WIKA',
            'perusahaan' => 'WIKA',
            'index_id' => 2,
            'sektor_id' => 8,
            'deskripsi' => 'Desc WIKA',
            'eps' => 115.0000,
            'roe' => 4.2276,
            'per' => 11.8400,
            'der' => 2.6100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'WSBP',
            'perusahaan' => 'WSBP',
            'index_id' => 2,
            'sektor_id' => 1,
            'deskripsi' => 'Desc WSBP',
            'eps' => 52.0000,
            'roe' => 9.5218,
            'per' => 6.8300,
            'der' => 1.0300,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('emitens')->insert([
            'emiten_char' => 'WSKT',
            'perusahaan' => 'WSKT',
            'index_id' => 2,
            'sektor_id' => 8,
            'deskripsi' => 'Desc WSKT',
            'eps' => 441.0000,
            'roe' => 15.0774,
            'per' => 3.8600,
            'der' => 3.4800,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
    }
}
