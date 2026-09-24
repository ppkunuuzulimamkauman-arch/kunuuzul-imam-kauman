<?php

namespace Database\Seeders;

use App\Models\Permohonan;
use Illuminate\Database\Seeder;

class PermohonanSeeder extends Seeder
{
    public function run(): void
    {
        // Data sesuai screenshot halaman 5 PDF (Permohonan Lama)
        $data = [
            ['pjgt_id'=>'00195','pjgt_nama'=>'TAUFIQUR ROHMAN','nama_madrasah'=>'AL-MARZUQI','alamat_lengkap'=>'Kerang - Sukosari - Kabupaten Bondowoso - JAWA TIMUR','wil'=>'T-4','tahun'=>'1448/1449','status'=>'Ditolak','butuh_gt'=>1,'rapot'=>'A'],
            ['pjgt_id'=>'00366','pjgt_nama'=>'MUKHLAS','nama_madrasah'=>'AL-HUDA','alamat_lengkap'=>'Patemon - Tlogosari - Kabupaten Bondowoso - JAWA TIMUR','wil'=>'T-4','tahun'=>'1448/1449','status'=>'Ditolak','butuh_gt'=>1,'rapot'=>'B'],
            ['pjgt_id'=>'00369','pjgt_nama'=>'AHMAD SYAMSUL MUQIT ZAINI','nama_madrasah'=>'NURUL HIKMAH','alamat_lengkap'=>'Lumutan - Botolinggo - Kabupaten Bondowoso - JAWA TIMUR','wil'=>'T-4','tahun'=>'1448/1449','status'=>'Ditolak','butuh_gt'=>2,'rapot'=>'A'],
            ['pjgt_id'=>'00416','pjgt_nama'=>"NASRUL MUSTA'AN",'nama_madrasah'=>'MISBAHUL JADID','alamat_lengkap'=>'Lumutan - Botolinggo - Kabupaten Bondowoso - JAWA TIMUR','wil'=>'T-4','tahun'=>'1448/1449','status'=>'Ditolak','butuh_gt'=>2,'rapot'=>'A'],
            ['pjgt_id'=>'00871','pjgt_nama'=>'ABDUL WAFI','nama_madrasah'=>'MIFTAHUL ULUM','alamat_lengkap'=>'Sumber Kemuning - Tamanan - Kabupaten Bondowoso - JAWA TIMUR','wil'=>'T-4','tahun'=>'1448/1449','status'=>'Ditolak','butuh_gt'=>2,'rapot'=>'B'],
            ['pjgt_id'=>'00880','pjgt_nama'=>'AHMAD TAUFIQUN NUR','nama_madrasah'=>"MI'ROJUL IHTIDA'",'alamat_lengkap'=>'Tarum - Prajekan - Kabupaten Bondowoso - JAWA TIMUR','wil'=>'T-4','tahun'=>'1448/1449','status'=>'Ditolak','butuh_gt'=>1,'rapot'=>'B'],
            ['pjgt_id'=>'01766','pjgt_nama'=>'MUQODDAS','nama_madrasah'=>'MD MU SYARIF HIDAYATULLAH','alamat_lengkap'=>'Jebung Kidul - Tlogosari - Kabupaten Bondowoso - JAWA TIMUR','wil'=>'T-4','tahun'=>'1448/1449','status'=>'Ditolak','butuh_gt'=>1,'rapot'=>'B'],
            ['pjgt_id'=>'01906','pjgt_nama'=>'MUHAMMAD FARHAN ISMAIL','nama_madrasah'=>'DARUL AKHLAQ','alamat_lengkap'=>'Sumberwringin - Sumberwringin - Kabupaten Bondowoso - JAWA TIMUR','wil'=>'T-4','tahun'=>'1448/1449','status'=>'Ditolak','butuh_gt'=>1,'rapot'=>'B'],
            ['pjgt_id'=>'01954','pjgt_nama'=>'BADRI MUNIR','nama_madrasah'=>'MADRASAH MIFTAHUL ULUM B-76','alamat_lengkap'=>'Gadingsari - Binakal - Kabupaten Bondowoso - JAWA TIMUR','wil'=>'T-4','tahun'=>'1448/1449','status'=>'Ditolak','butuh_gt'=>1,'rapot'=>'C'],
            ['pjgt_id'=>'02178','pjgt_nama'=>'MUHAMMAD FAISOL','nama_madrasah'=>'MD NURUL FALAH','alamat_lengkap'=>'Jeruksoksok - Binakal - Kabupaten Bondowoso - JAWA TIMUR','wil'=>'T-4','tahun'=>'1448/1449','status'=>'Ditolak','butuh_gt'=>1,'rapot'=>'B'],
        ];

        foreach ($data as $row) {
            Permohonan::firstOrCreate(['pjgt_id' => $row['pjgt_id']], array_merge($row, [
                'username' => '00007',
                'nama_pesantren' => 'SIDOGIRI',
                'negara' => 'INDONESIA',
                'provinsi' => 'JAWA TIMUR',
                'kabupaten' => 'KABUPATEN BONDOWOSO',
                'telepon' => '0812498111242',
                'email' => 'contoh@gmail.com',
            ]));
        }
    }
}
