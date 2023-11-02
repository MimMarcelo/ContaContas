<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sources = [
            "cNU" => "Credit Card",
            "EDU - Education" => "Spent",
            "FOO - Food" => "Spent",
            "FUN - Funny" => "Spent",
            "GNR - General" => "Spent",
            "HEL - Helth" => "Spent",
            "HOM - Home" => "Spent",
            "PER - Personal" => "Spent",
            "TRA - Transit" => "Spent",
            "AV" => "CC",
            "BB" => "CC",
            "EY" => "CC",
            "ITI" => "CC",
            "MO" => "CC",
            "MY" => "CC",
            "NU" => "CC",
            "XP" => "CC",
            "BTC" => "Cript",
            "TVRI11" => "FII",
            "HFOF11" => "FII",
            "HGLG11" => "FII",
            "MFII11" => "FII",
            "MXRF11" => "FII",
            "RECT11" => "FII",
            "VILG11" => "FII",
            "VINO11" => "FII",
            "VISC11" => "FII",
            "VSLH11" => "FII",
            "XPCI11" => "FII",
            "XPCM11" => "FII",
            "XPLG11" => "FII",
            "AC+ - Accrual" => "Gain",
            "AE+ - Active earning" => "Gain",
            "OE+ - Other earning" => "Gain",
            "PE+ - Passive earning" => "Gain",
            "Ana" => "Payer",
            "Barbara" => "Payer",
            "Dijon" => "Payer",
            "Milhas" => "Payer",
            "Larissa" => "Payer",
            "Mãe" => "Payer",
            "LTC" => "REIT",
            "O" => "REIT",
            "SLG" => "REIT",
            "STAG" => "REIT",
            "99P" => "FIX",
            "CDB EY" => "FIX",
            "CDB MO" => "FIX",
            "CDB XP" => "FIX",
            "pITI" => "FIX",
            "PP" => "FIX",
            "UV" => "FIX",
            "NUBR33" => "BDR",
            "pNU" => "FIX",
            "RZAG11" => "FII",
            "Higor" => "Payer",
            "Dolly" => "Payer",
        ];
        foreach($sources as $k => $v){
            DB::table('sources')->insert([
                'name' => $k,
                'kind' => $v,
                'user_id' => 3
            ]);
        }
    }
}
