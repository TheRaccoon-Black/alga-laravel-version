<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyakitDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'PK01' => [
                'penyebab' => 'Reaksi alergi atau iritasi kulit akibat kontak langsung dengan zat pemicu seperti sabun, kosmetik, logam (nikel), karet, atau tumbuhan.',
                'ciri_ciri' => 'Kulit kemerahan, gatal, bentol-bentol kecil, kadang melepuh, muncul di area yang bersentuhan dengan alergen. Bersifat lokal sesuai area kontak.',
                'treatment' => 'Hindari kontak dengan zat pemicu. Kompres dingin untuk mengurangi gatal. Gunakan lotion kalamin. Konsultasi dokter jika gejala parah.',
                'obat' => 'Salep kortikosteroid topikal (hidrokortison 1%), antihistamin oral (cetirizine, loratadine), krim emolien.',
            ],
            'PK02' => [
                'penyebab' => 'Pertumbuhan berlebihan jamur Malassezia pada kulit, sering dipicu oleh stres, cuaca lembap, atau perubahan hormon.',
                'ciri_ciri' => 'Kerokan bersisik kuning berminyak di kulit kepala, alis, sayap hidung, dan dada. Kulit kemerahan dengan sisik lengket.',
                'treatment' => 'Cuci area affected dengan shampoo anti-jamur secara teratur. Jaga kebersihan dan keringkan area lipatan kulit. Kurangi stres.',
                'obat' => 'Shampoo ketokonazol 2%, krim ketokonazol 2% topikal, krim siklopirox, salep seng pirition.',
            ],
            'PK03' => [
                'penyebab' => 'Faktor genetik dan gangguan sistem imun yang menyebabkan kulit kering kronis, sering dipicu alergen, stres, atau cuaca kering.',
                'ciri_ciri' => 'Kulit sangat kering, kemerahan, gatal hebat (terutama malam), kulit bersisik, muncul pada lipatan tangan/kaki dan wajah. Sering kambuh.',
                'treatment' => 'Hindari sabun keras, pakai pelembab sering, jangan garuk, pakai pakaian katun longgar, kelola stres. Hindari pemicu alergi.',
                'obat' => 'Pelembab emolien (vaseline, cetaphil), kortikosteroid topikal ringan-sedang, krim pimecrolimus/tacrolimus, antihistamin.',
            ],
            'PK04' => [
                'penyebab' => 'Infeksi jamur Dermatophyta di selangkangan, sering terjadi pada olahraga, cuaca panas lembap, atau orang dengan keringat berlebih.',
                'ciri_ciri' => 'Lingkaran kemerahan di selangkangan dengan tepi lebih jelas dan agak menonjol, gatal, kadang mengering di tengah. Bisa menyebar ke paha dalam.',
                'treatment' => 'Jaga area selangkangan tetap kering dan bersih, ganti pakaian dalam rutin, hindari pakaian ketat, gunakan bedak anti jamur.',
                'obat' => 'Krim clotrimazol 1%, krim terbinafin, tablet itrakonazol (kasus parah), bedak antifungal.',
            ],
            'PK05' => [
                'penyebab' => 'Gatal kronis berulang akibat garukan terus-menerus, bisa dipicu stres, keringat, atau iritan. Menyebabkan penebalan kulit.',
                'ciri_ciri' => 'Area kulit menebal dan kasar (lichenifikasi), berwarna lebih gelap dari sekitarnya, gatal hebat terutama malam hari, sering di leher dan lengan.',
                'treatment' => 'Hentikan kebiasaan garuk, kompres dingin, jaga kelembaban kulit, kelola stres. Gunakan penutup luka untuk mencegah garukan.',
                'obat' => 'Kortikosteroid topikal potent (betametason), salep oklusif, antihistamin sedatif (difenhidramin) malam hari.',
            ],
            'PK06' => [
                'penyebab' => 'Penyakit autoimun yang mempercepat pergantian sel kulit, dipicu genetik, stres, infeksi, cedera kulit, atau obat-obatan tertentu.',
                'ciri_ciri' => 'Plak kemerahan dengan sisik putih-perak, muncul di siku, lutut, kulit kepala, dan punggung bawah. Bisa disertai nyeri dan pecah-pecah.',
                'treatment' => 'Paparkan kulit pada sinar matahari terbatas, hindari trauma kulit, kelola stres, mandi air hangat bukan panas, jangan garuk sisik.',
                'obat' => 'Kortikosteroid topikal, analog vitamin D (kalciportriol), fototerapi UVB, salep salisilat, obat sistemik (metotrexat, biologic).',
            ],
            'PK07' => [
                'penyebab' => 'Infeksi jamur Dermatophyta pada kulit tubuh, menular melalui kontak langsung, alat bersama, atau permukaan lembap (kolam, lantai).',
                'ciri_ciri' => 'Lingkaran kemerahan di kulit tubuh dengan tepi aktif dan tengah cenderung sembuh, gatal, sisik halus di tepi. Dikenal sebagai panu badan.',
                'treatment' => 'Jaga kebersihan kulit, jangan berbagi handuk/alat, keringkan tubuh setelah mandi, hindari pakaian basah terlalu lama.',
                'obat' => 'Krim clotrimazol 1%, krim terbinafin 1%, krim mikonazol, tablet flukonazol (untuk luas/parah).',
            ],
            'PK08' => [
                'penyebab' => 'Infeksi parasit tungau Sarcoptes scabiei yang membuat terowongan di lapisan kulit, menular melalui kontak kulit langsung dan prolonged contact.',
                'ciri_ciri' => 'Gatal hebat terutama malam hari, benjolan kecil kemerahan, garis-garis tipis (traktus) di kulit, sering di sela jari, pergelangan, selangkangan, putting.',
                'treatment' => 'Cuci seluruh pakaian dan seprai dengan air panas, isolasi dari kontak dekat sampai pengobatan selesai, obati seluruh anggota rumah.',
                'obat' => 'Krim permetrin 5% (first line), lotion benzil benzoat 25%, tablet ivermectin (oral), salep sulfur presipitatus 10%.',
            ],
            'PK09' => [
                'penyebab' => 'Infeksi jamur Pityrosporum orbiculare (Malassezia) pada lapisan atas kulit, sering pada cuaca panas lembap dan kulit berminyak.',
                'ciri_ciri' => 'Bercak putih, kemerahan, atau kecokelatan di dada, punggung, dan lengan atas dengan tepi tidak teratur. Sisik halus, gatal ringan.',
                'treatment' => 'Jaga kebersihan dan keringkan kulit, gunakan shampoo antifungal sebagai body wash, hindari sinar matahari berlebihan.',
                'obat' => 'Shampoo ketokonazol 2% (sebagai body wash), krim ketokonazol 2%, tablet flukonazol dosis tunggal (kasus luas).',
            ],
            'PK10' => [
                'penyebab' => 'Reaktivasi virus Varicella Zoster (VZV) yang dormant di ganglion saraf, dipicu menurunnya imunitas, stres, atau usia lanjut.',
                'ciri_ciri' => 'Ruam berbobot kemerahan berupa gelembung berisi cairan sepanjang satu sisi tubuh (dermatom), nyeri/bakar terasa sebelum ruam muncul, demam ringan.',
                'treatment' => 'Istirahat cukup, jangan pecahkan gelembung, kompres dingin, jaga kebersihan area, hindari kontak dengan ibu hamil dan bayi.',
                'obat' => 'Asiklovir 800mg 5x/hari (7 hari), valasiklovir, paracetamol untuk nyeri, bedak calamine untuk gatal, antibiotik topikal jika infeksi sekunder.',
            ],
            'PK11' => [
                'penyebab' => 'Kerusakan atau kehilangan sel melanosit (penghasil pigmen) secara autoimun, bisa dipicu stres, trauma kulit, atau faktor genetik.',
                'ciri_ciri' => 'Bercak putih sempurna tanpa sisik di kulit, tepi sering hiperpigmentasi, tidak gatal/tidak nyeri, muncul di wajah, tangan, sendi, dan area genital.',
                'treatment' => 'Lindungi kulit dari sinar UV (sunscreen SPF30+), hindari trauma kulit (koebner phenomenon), kelola stres, konsultasi rutin ke dokter kulit.',
                'obat' => 'Kortikosteroid topikal, krim takrolimus/pimecrolimus, fototerapi NB-UVB, terapi ekspresi pigmentasi (mimic), operasi transplantasi melanosit (kasus stabil).',
            ],
            'PK12' => [
                'penyebab' => 'Infeksi bakteri Streptococcus pyogenes atau Staphylococcus aureus pada permukaan kulit, menular melalui kontak langsung dan benda terkontaminasi.',
                'ciri_ciri' => 'Luka berambut madu/kuning keemasan di sekitar mulut dan hidung, gelembung pecah meninggalkan kerak, kemerahan, kadang demam. Lebih sering pada anak.',
                'treatment' => 'Jaga kebersihan luka, cuci tangan teratur, jangan sentuh luka, pisahkan handuk/alat makan. Isolasi sampai 24 jam setelah antibiotik.',
                'obat' => 'Salep mupirocin 2% topikal, amoksisilin atau asetralamin oral, sefaleksin (alternatif), antiseptik kulit (povidon-iodine).',
            ],
        ];

        foreach ($data as $id => $info) {
            $exists = DB::table('penyakits')->where('id_penyakit', $id)->exists();
            if ($exists) {
                DB::table('penyakits')->where('id_penyakit', $id)->update($info);
            } else {
                DB::table('penyakits')->insert(array_merge(['id_penyakit' => $id, 'nama_penyakit' => $id], $info));
            }
        }
    }
}
