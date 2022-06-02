<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptioncodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        
        // 1-  types array
        $types = [
            'Restaurant',
            'Homemade',
        ];



        // cities array
        $cities = [
            'Dubai',
            'Abu Dhabi',
            'Sharjah',
            'Ajman',
            'Umm Al Quwain',
            'Al Ain',
            'RAK',
        ];


        $citiesIds = [
            3,
            4,
            5,
            6,
            7,
            8,
            9,
        ];

        // number of districts in each city
        $districtsInCity = [

            140, //Dubai 140 (D)
            202, //Abu Dhabi 62 (D)
            280, //Sharjah 78
            305, //Ajman 25
            322, //Umm Al Quwain 17
            365, //Al Ain 43
            366, //RAK 1


        ];



        // districts array
        $districts = [

            // 1- Dubai = 139 district
            'Dubai Hills',
            'Design District',
            'BurJuma',
            'Deira Duba',
            'Sheikh Zayed Roa',
            'World Trade Center',
            'Liwan',
            'Lifestyle City',
            'Arabian Ranches 2',
            'Layan',
            'Abu Hail',
            'Academic City',
            'Al Badaa',
            'Al Baraha',
            'Al Barari',
            'Al Barsha 1',
            'Al Barsha 2',
            'Al Barsha 3',
            'Barsha Heights',
            'Al Barsha South ',
            'Al Furjan',
            'Al Garhoud',
            'Al Hudaiba',
            'Al Jaddaf',
            'Al Jafiliya',
            'Al Karama',
            'Al Khabisi',
            'Al Khawaneej 1',
            'Al Khawaneej 2',
            'Al Mamzar',
            'Al Manara',
            'Al Mankhool',
            'Al Mizhar 1',
            'Al Mizhar 2',
            'Al Muntazah Complex',
            'Al Murar',
            'Al Nahda 1',
            'Al Nahda 2',
            'Al Quoz 1',
            'Al Quoz 2',
            'Al Quoz 3',
            'Al Quoz 4',
            'Al Qusais 1',
            'Al Qusais 2',
            'Al Raffa',
            'Al Rashidiya',
            'Al Rigga',
            'Al Safa',
            'Al Safouh 1',
            'Al Safouh 2',
            'Al Satwa',
            'Al Twar 1',
            'Al Waha',
            'Al Waheda',
            'Al Warqa 1',
            'Al Warqa 2',
            'Al Warqa 3',
            'Al Warqa 4',
            'Al Wasl',
            'Arabian Ranches',
            'Arjan Dubailand',
            'Bluewaters Island',
            'Business Bay',
            'City of Arabia',
            'Damac Hills',
            'Damac Hills Estate',
            'Discovery Gardens',
            'Downtown',
            'Dubai Festival City',
            'Dubai Healthcare City',
            'DIFC',
            'Internet City',
            'Investment park',
            'Knowledge Village',
            'Marina',
            'Media City',
            'Studio City',
            'Emirates Hills 1',
            'Emirates Hills 2',
            'Falcon City',
            'Hayat Townhouses',
            'Hor Al Anz',
            'IBN Battuta',
            'IMPZ',
            'International City',
            'Jebel Ali Village',
            'Jumeirah 1',
            'Jumeirah 2',
            'Jumeirah 3',
            'JBR',
            'Jumeirah Heights',
            'Jumeirah Island',
            'JLT',
            'Jumeirah Park',
            'JVC',
            'JVT',
            'Majan',
            'Meadows',
            'Meydan',
            'Mira',
            'Mirdif',
            'Motor City',
            'Mudon',
            'Muhaisanah 1',
            'Muhaisanah 2',
            'Muhaisanah 3',
            'Muhaisanah 4',
            'Muteena',
            'Nad Al Hammar',
            'Nadd Al Sheba',
            'Naif',
            'Nshama Town Square',
            'Oud Al Muteena',
            'Oud Metha',
            'Palm Jumeirah',
            'Ras Al Khor',
            'Remraam',
            'Silicon Oasis',
            'Sport City',
            'Springs',
            'Tecom',
            'The Gardens',
            'The Greens',
            'The Lakes',
            'The Sustainable City',
            'The Villa ',
            'Umm Al Sheif',
            'Umm Hurair',
            'Umm Ramool',
            'Umm Suqeim 1',
            'Warsan',
            'Zaabeel',
            'City Walk',
            'Al Twar 2',
            'Al Twar 3',
            'Umm Suqeim 2',
            'Umm Suqeim 3',
            'Living Legends',
            'Nad Al Shamma',
            'OTHER',





            // 2- Abu Dhabi
            'Al Aman',
            'Al Bahya ',
            'Al Bandar',
            'Al Bateen',
            'Al Dana',
            'Al Dhafrah',
            'Al Etihad',
            'Al Falah',
            'Al Ghadeer',
            'Al Hisn',
            'Al Kharamah',
            'Al Mannal',
            'Al Maqta',
            'Al Maryah Island',
            'Al Muneera',
            'Al Muntazah',
            'Al Muroor',
            'Al Musalla',
            'Al Mushrif',
            'Al Raha',
            'Al Raha Gardens',
            'Al Rahba',
            'Al Rayhan',
            'Al Reef',
            'Al Reem Island',
            'Al Rowdah',
            'Al Saadah',
            'Al Saadiyat',
            'Al Samha',
            'Al Shahama',
            'Al Shamkhah',
            'Al Wahda',
            'Al Zaab',
            'Al Zahiyah',
            'Al Zahraa',
            'Al Zeina',
            'Baniyas',
            'Bloom Gardens',
            'Eastern Mangrove',
            'Embassies District',
            'Hills Abu Dhabi',
            'Khalifa City',
            'Khalifa City A',
            'Khalifa City B',
            'Madinat Zayed',
            'Mangrove Village',
            'Masdar City',
            'Ministries Area',
            'Mohamed Bin Zayed City',
            'Rowdhat Abu Dhabi',
            'Saadiyat Island',
            'Yas Island',
            'Zayed Sport City',
            'Zayed University',
            'Jazeerat Al Reem',
            'Khalidiya Village',
            'Khalidiyah',
            'Hadbat Al Zafaranah',
            'Al Ras Al Akhdar',
            'Al Marina',
            'Al Kasir',
            'OTHER',






            // Sharjah
            'Al Abar',
            'Al Azra',
            'Al Bu Daniq',
            'Al Darari',
            'Al Falaj',
            'Al Fayha',
            'Al Fisht',
            'Al Ghafia',
            'Al Gharayen',
            'Al Gharb',
            'Al Ghubaiba',
            'Al Goaz',
            'Al Hazannah',
            'Al Heerah Suburb',
            'Al Jazzat',
            'Al Jubail',
            'Al Jurainah 1',
            'Al Jurainah 2',
            'Al Jurainah 3',
            'Al Jurainah 4',
            'Al Khaledia Suburb',
            'Al Khan',
            'Al Khezamia',
            'Al Layyeh Suburb',
            'Al Mahatah',
            'Al Majaz 1',
            'Al Majaz 2',
            'Al Majaz 3',
            'Al Manakh',
            'Al Mansoura',
            'Al Mareija',
            'Al Mirqab',
            'Al Mujarrah',
            'Al Muntazah',
            'Al Musalla',
            'Al Nabaah',
            'Al Nahda',
            'Al Nasserya',
            'Al Nekhailat',
            'Al Noof 1',
            'Al Noof 2',
            'Al Noof 3',
            'Al Noof 4',
            'Al Nud',
            'Al Qadisiya',
            'Al Qasba',
            'Al Qylayaah',
            'Al Ramaqiya',
            'Al Ramla East',
            'Al Ramtha ',
            'Al Rifaah',
            'Al Riqa Suburb',
            'Al Sabkha',
            'Al Seef',
            'Al Shahba',
            'Al Sharq',
            'Al Sweihat',
            'Al Taawun',
            'Al Talaa',	
           ' Al Turfa',
            'Al Yarmook',
            'Al Yash',
            'Barashi',
            'Dasman',
            'Halwan',
            'Halwan Suburb', 
            'Maysaloon ',
            'Muwafjah', 
            'Muwailih', 
            'Qarayen 1',
            'Qarayen 2',
            'Qarayen 3',
            'Qarayen 4',
            'Qarayen 5', 
            'Samnan ',
            'Sharqan ',
            'Al Rahmaniya',
            'OTHER', 



            // Ajman
            'City Center',
            'Corniche',
            'Marina',
            'Pearl',
            'Uptown',
            'Al Bustan',
            'Al Butain',
            'Al Hamidiya',
            'Al Hamriya',
            'Al Helio',
            'Al Jurf',
            'Al Muntazi',
            'Al Mushairef',
            'Al Naemiyah',
            'Al Nakhil',
            'Al Owan',
            'Al Rashidiya',
            'Al Rowdha',
            'Al Rumailah',
            'Al Zahra',
            'Al Zora',
            'Emirates City',
            'Emirates City Extension',
            'Garden City',
            'Green City',





            // Umm Al Quwain
            'Al Aahad',
            'Al Abrab',
            'Al Dar Al Baida',
            'Al Haditha',
           ' Al Hawiyah',  
            'Al Humrah',  
            'Al Limghadar', 
            'Al Maidan',  
            'Al Raas', 
            'Al Ramlah',  
            'Al Raudah', 
            'Al Riqqah',  
            'Al Salamah',  
            'Fallaj Al Muwallah',  
            'Green Belt', 
            'Old Town Area', 
            'Marina',




            // Al Ain
            'Al Bateen',
            'Al Dahma',
            'Al Fouah', 
            'Al Ghadeer',
            'Al Hili',
            'Al iqabiyyah',
            'Al Jahili',
            'Al Jimi',
            'Al Khalidiyah', 
            'Al Khibeesi',
            'Al Khrair',
            'Al Maqam',
            'Al Markhaniyyah',
            'Al Masoudi',
            'Al Mnaizfah',
            'Al Mnaizlah',
            'Al Murabaa',
            'Al Mutarid ',
            'Al Mutawah', 
            'Al Muwaiji',
            'Al Niyadat',
            'Al Owainah',
            'Al Qattarah', 
            'Al Ruwaikah',
            'Al Sallan',
            'Al Sarouj', 
            'Al Tiwayyah',
            'Al Ugdat',
            'Asharij',
            'Bid Bin Ammar',
            'Falaj Hazzaa',
            'Ghnaymah',
            'Hai Khalid',
            'Jizat wraigah', 
            'Majlood',
            'Mreifia',
            'Nimah',
            'Oud Bin Sag-Han',
            'Shabhanet Asher',
            'Shareat Al Muwaiji',
            'Shiab Al Ashkhar',
            'Shibat Al Wutah',
            'Tawam',



            // RAK
            'OTHER',




        ];




        // ids only (from 10 to 375)
        $districtsIds = array();

        for ($i=0; $i < count($districts); $i++) {

            $districtsIds[$i] = $i+10;
        }







        // ==================================


        // types inserting
        for ($i = 0; $i < count($types); $i++) {

            DB::table('optioncodes')->insert([
                'name' => $types[$i],
                'type' => 'partnertype',
            ]);
        } //end of type inserting




        // cities inserting
        for ($i = 0; $i < count($cities); $i++) {

            DB::table('optioncodes')->insert([
                'name' => $cities[$i],
                'type' => 'city',
            ]);
        } //end of cities inserting




        // districts inserting
        for ($i = 0; $i < count($districts); $i++) {

            DB::table('optioncodes')->insert([
                'name' => $districts[$i],
                'type' => 'district',
            ]);
        } //end of cities inserting









        // relationship between cities and districts in city_districts table
        for ($i = 0; $i < count($districts); $i++) {



            // 1- Dubai
            if ($i < $districtsInCity[0]) {

                DB::table('city_districts')->insert([
                    'city_id' => $citiesIds[0],
                    'district_id' => $districtsIds[$i],
                ]);
            }


            // 2- Abu Dhabi
            elseif ($i < $districtsInCity[1]) {

                DB::table('city_districts')->insert([
                    'city_id' => $citiesIds[1],
                    'district_id' => $districtsIds[$i],
                ]);
            }


            // 3- Sharjah
            elseif ($i < $districtsInCity[2]) {

                DB::table('city_districts')->insert([
                    'city_id' => $citiesIds[2],
                    'district_id' => $districtsIds[$i],
                ]);
            }



            // 4- Ajman
            elseif ($i < $districtsInCity[3]) {

                DB::table('city_districts')->insert([
                    'city_id' => $citiesIds[3],
                    'district_id' => $districtsIds[$i],
                ]);
            }




            // 5- Umm Al Quwain
            elseif ($i < $districtsInCity[4]) {

                DB::table('city_districts')->insert([
                    'city_id' => $citiesIds[4],
                    'district_id' => $districtsIds[$i],
                ]);
            }




            // 6- Al Ain
            elseif ($i < $districtsInCity[5]) {

                DB::table('city_districts')->insert([
                    'city_id' => $citiesIds[5],
                    'district_id' => $districtsIds[$i],
                ]);
            }




            // 7- RAK
            elseif ($i < $districtsInCity[6]) {

                DB::table('city_districts')->insert([
                    'city_id' => $citiesIds[6],
                    'district_id' => $districtsIds[$i],
                ]);
            }



        } //end for loop of relationship



    } //end of run method

} //end seeder
