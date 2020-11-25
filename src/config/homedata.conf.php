<?php

// Default imagefile to use when picture is missing
define( "DEFAULT_SLIDE_PICTURE", "graphics/koti_puuttuu.png" );

class HomeStruct {
	public $title; // string, couple of words
	public $slogan; // string, sentence
	public $designer; // string, first and last name
	public $face; // string, filepath to picture of designer's face
	public $email; // string, email
	public $facebook; // string, url
	public $pdfsrc; // string, filepath
	public $picturedir; // string, path to picture directory. End by '/'
	public $iconsrc; // string, path to frontpage homeicon

	public function __construct($title, $slogan, $designer, $face, $email, $facebook, $pdfsrc, $picturedir, $iconsrc ) {
		$this->title = $title;
		$this->slogan = $slogan;
		$this->designer = $designer;
		$this->face = $face;
		$this->email = $email;
		$this->facebook = $facebook;
		$this->pdfsrc = $pdfsrc;
		$this->picturedir = $picturedir;
		$this->iconsrc = $iconsrc;
	}
}

// Home
$homedata = array ();

array_push( $homedata,
	new HomeStruct(
		"home0_name",
		"home0_slogan",
		"Jare Virtanen",
		"files/jare/jare.jpg",
		"home0_email",
		"http://www.facebook.com",
		"files/jare/minimikoti_kolmen_ruudun_koti_jare_virtanen.pdf",
		"files/jare/",
		"files/jare/etusivulle_res.jpg"
	),
	new HomeStruct(
		"home1_name",
		"home1_slogan",
		"Jani Järvinen",
		"files/jani/jani.jpg",
		"home1_email",
		"http://www.facebook.com",
		"files/jani/minimikoti_omakotikontti_jani_jarvinen.pdf",
		"files/jani/",
		"files/jani/00_kuva etusivulle_res.jpg"
	),
	new HomeStruct(
		"home2_name",
		"home2_slogan",
		"Sini Kotilainen",
		"files/sini/sini.jpg",
		"home2_email",
		"http://www.facebook.com",
		"files/sini/minimikoti_kohti_korkeuksia_sini_kotilainen.pdf",
		"files/sini/",
		"files/sini/etusivukuva_res.jpg"
	),
	new HomeStruct(
		"home3_name",
		"home3_slogan",
		"Rosa Paukio",
		"files/rosa/rosa.jpg",
		"home3_email",
		"http://www.facebook.com",
		"files/rosa/minimikoti_valosiilo_rosa_paukio.pdf",
		"files/rosa/",
		"files/rosa/00_res.jpg"
	),
	new HomeStruct(
		"home4_name",
		"home4_slogan",
		"Maija Heinilä",
		"files/maija/maija.jpg",
		"home4_email",
		"http://www.facebook.com",
		"files/maija/minimikoti_primitiivikoti_maija_heinila.pdf",
		"files/maija/",
		"files/maija/00_etusivulle_leikkausA_res.jpg"
	),
	new HomeStruct(
		"home5_name",
		"home5_slogan",
		"Anu Nukarinen",
		"files/anu/anu.jpg",
		"home5_email",
		"http://www.facebook.com",
		"files/anu/minimikoti_kukkakapseli_anu_nukarinen.pdf",
		"files/anu/",
		"files/anu/00kuva_ETUSIVUKUVA_res.jpg"
	),
	new HomeStruct(
		"home6_name",
		"home6_slogan",
		"Heikki Ilvespalo",
		"files/heikki/heikki.jpg",
		"home6_email",
		"http://www.facebook.com",
		"files/heikki/minimikoti_tankotanssi_heikki_ilvespalo.pdf",
		"files/heikki/",
		"files/heikki/00_etusivukuva_res.jpg"
	),
	new HomeStruct(
		"home7_name",
		"home7_slogan",
		"Kaisa Toivonen",
		"files/kaisa/kaisa.jpg",
		"home7_email",
		"http://www.facebook.com",
		"files/kaisa/minimikoti_synbios_kaisa_toivonen.pdf",
		"files/kaisa/",
		"files/kaisa/00_Kansikuva_res.jpg"
	)
);

// Picture struct
class PicStr {
	public $title; // string, couple of words
	public $text; // string, max 50 words
	public $resized; // string, filename of resized picture
	public $original; // string, filename of original picture

	public function __construct( $title, $text, $resized, $original ) {
		$this->title = $title;
		$this->text = $text;
		$this->resized = $resized;
		$this->original = $original;
	}
}

// Home pictures
$picturedata = array (
	array(), // 0 Kolmen ruudun koti
	array(), // 1 Omakotikontti
	array(), // 2 Kohti korkeuksia
	array(), // 3 Valosiilo
	array(), // 4 Primitiivikoti
	array(), // 5 Kukkakapseli
	array(), // 6 Tankotanssi
	array()  // 7 SynBIOS
);

// Kolmen ruudun koti
array_push ( $picturedata[0],
	new PicStr(
		"ulkoperskis",
		"home0_pic0_text",
		"ulkoperskis_res.jpg",
		"ulkoperskis_med.jpg"
	),
	new PicStr(
		"julkkari",
		"home0_pic1_text",
		"julkkari_res.jpg",
		"julkkari_med.png"
	),
	new PicStr(
		"pohjat",
		"home0_pic2_text",
		"pohjat_res.jpg",
		"pohjat_med.png"
	),
	new PicStr(
		"leikkaukset",
		"home0_pic3_text",
		"leikkaukset_res.jpg",
		"leikkaukset_med.png"
	),
	new PicStr(
		"sisäperskis",
		"home0_pic4_text",
		"sisaperskis_res.jpg",
		"sisaperskis_med.jpg"
	),
	new PicStr(
		"kuistiperskis",
		"home0_pic5_text",
		"kuistiperskis_res.jpg",
		"kuistiperskis_med.jpg"
	),
	new PicStr(
		"kolmelle",
		"home0_pic6_text",
		"kolmelle_res.png",
		"kolmelle_med.png"
	)
);


// Omakotikontti
array_push ( $picturedata[1],
	new PicStr(
		"Perspektiivi",
		"home1_pic0_text",
		"01_3DEE_MINIMI2_res.jpg",
		"01_3DEE_MINIMI2_med.jpg"
	),
	new PicStr(
		"Asemakaava",
		"home1_pic1_text",
		"02_assari_res.png",
		"02_assari_med.png"
	),
	new PicStr(
		"Pohjat",
		"home1_pic2_text",
		"03_pohjat_res.png",
		"03_pohjat.png"
	),
	new PicStr(
		"Julkisivut",
		"home1_pic3_text",
		"04_julkkarit_res.png",
		"04_julkkarit_med.jpg"
	),
	new PicStr(
		"Leikkaukset",
		"home1_pic4_text",
		"05_leikkaukset_res.png",
		"05_leikkaukset_med.png"
	),
	new PicStr(
		"Kalusteet",
		"home1_pic5_text",
		"06_kaluste_res.png",
		"06_kaluste_med.png"
	),
	new PicStr(
		"Viher",
		"home1_pic6_text",
		"07_viher_res.jpg",
		"07_viher_med.jpg"
	),
	new PicStr(
		"Variaatiot",
		"home1_pic7_text",
		"08_variaatiot_res.png",
		"08_variaatiot_med.jpg"
	)
);

// Kohti korkeuksia
array_push ( $picturedata[2],
	new PicStr(
		"Kohti korkeuksia",
		"home2_pic0_text",
		"kuvatiedosto_01_res.jpg",
		"kuvatiedosto_01.jpg"
	),
	new PicStr(
		"Kohti korkeuksia",
		"home2_pic1_text",
		"kuvatiedosto_02_res.png",
		"kuvatiedosto_02.png"
	),
	new PicStr(
		"Kohti korkeuksia",
		"home2_pic2_text",
		"kuvatiedosto_03_res.jpg",
		"kuvatiedosto_03.jpg"
	),
	new PicStr(
		"Kohti korkeuksia",
		"home2_pic3_text",
		"kuvatiedosto_04_res.png",
		"kuvatiedosto_04.png"
	),
	new PicStr(
		"Kohti korkeuksia",
		"home2_pic4_text",
		"kuvatiedosto_05_res.png",
		"kuvatiedosto_05.png"
	),
	new PicStr(
		"Kohti korkeuksia",
		"home2_pic5_text",
		"kuvatiedosto_06_res.jpg",
		"kuvatiedosto_06.jpg"
	)
);

// Valosiilo
array_push ( $picturedata[3],
	new PicStr(
		"Perspektiivikuva",
		"home3_pic0_text",
		"01_res.jpg",
		"01.jpg"
	),
	new PicStr(
		"Sisältä",
		"home3_pic1_text",
		"02_res.jpg",
		"02_med.jpg"
	),
	new PicStr(
		"Kalusteet",
		"home3_pic2_text",
		"03_res.jpg",
		"03.jpg"
	),
	new PicStr(
		"Pohjapiirros",
		"home3_pic3_text",
		"04_res.png",
		"04.png"
	),
	new PicStr(
		"Pohjapiirrokset",
		"home3_pic4_text",
		"05_res.jpg",
		"05.jpg"
	),
	new PicStr(
		"Sisältä",
		"home3_pic5_text",
		"06_res.jpg",
		"06.jpg"
	),
	new PicStr(
		"Poikkileikkaus",
		"home3_pic6_text",
		"07_res.jpg",
		"07.jpg"
	),
	new PicStr(
		"Poikkileikkaus",
		"home3_pic7_text",
		"08.jpg",
		"08.jpg"
	),
	new PicStr(
		"Ulkokuva",
		"home3_pic8_text",
		"09.jpg",
		"09.jpg"
	)
);

// Primitiivikoti
array_push ( $picturedata[4],
	new PicStr(
		"Primitiivikoti",
		"home4_pic0_text",
		"01_kuva_res.jpg",
		"01_kuva_med.jpg"
	),
	new PicStr(
		"Pohjat",
		"home4_pic1_text",
		"02_pohjat_res.png",
		"02_pohjat_med.jpg"
	),
	new PicStr(
		"Rakennusperiaatekuva",
		"home4_pic2_text",
		"03_rakperiaatekuva_res.jpg",
		"03_rakperiaatekuva_med.jpg"
	),
	new PicStr(
		"Julkisivut",
		"home4_pic3_text",
		"04_julkisivut_res.jpg",
		"04_julkisivut_med.jpg"
	),
	new PicStr(
		"Leikkaus",
		"home4_pic4_text",
		"05_leikkaus_res.jpg",
		"05_leikkaus_med.jpg"
	),
	new PicStr(
		"Sisäperspektiivi",
		"home4_pic5_text",
		"06_sisaperspektiivi_res.jpg",
		"06_sisaperspektiivi_med.jpg"
	),
	new PicStr(
		"Ulkoperspektiivi",
		"home4_pic6_text",
		"07_ulkoperspis_res.jpg",
		"07_ulkoperspis_med.jpg"
	)
);

// Kukkakapseli
array_push ( $picturedata[5],
	new PicStr(
		"Kaupunki",
		"home5_pic0_text",
		"01kuva_ULKO_KAUPUNKI_res.jpg",
		"01kuva_ULKO_KAUPUNKI_med.jpg"
	),
	new PicStr(
		"Sijoitus",
		"home5_pic1_text",
		"02kuva_SIJOITUS_3_5_10_res.jpg",
		"02kuva_SIJOITUS_3_5_10_med.jpg"
	),
	new PicStr(
		"Kerrokset",
		"home5_pic2_text",
		"03kuva_ KERROKSET_res.jpg",
		"03kuva_ KERROKSET_med.jpg"
	),
	new PicStr(
		"Sisältä",
		"home5_pic3_text",
		"04kuva_TYHJA_3_5_10_res.jpg",
		"04kuva_TYHJA_3_5_10_med.jpg"
	),
	new PicStr(
		"Pohja",
		"home5_pic4_text",
		"05kuva_POHJA_res.jpg",
		"05kuva_POHJA_med.jpg"
	),
	new PicStr(
		"Kalusteet",
		"home5_pic5_text",
		"06kuva_KALUSTEET_3_5_10_res.jpg",
		"06kuva_KALUSTEET_3_5_10_med.jpg"
	),
	new PicStr(
		"Tanssija",
		"home5_pic6_text",
		"07kuva_TANSSITYYPPI_3_5_10_res.jpg",
		"07kuva_TANSSITYYPPI_3_5_10_med.jpg"
	),
	new PicStr(
		"Ulkokuva",
		"home5_pic7_text",
		"08kuva_ULKO2_res.jpg",
		"08kuva_ULKO2_med.jpg"
	)
);

// Tankotanssi
array_push ( $picturedata[6],
	new PicStr(
		"Sijoitusalue",
		"home6_pic0_text",
		"01_sijoitusalue_res.jpg",
		"01_sijoitusalue_med.jpg"
	),
	new PicStr(
		"Kierrätysmateriaalit",
		"home6_pic1_text",
		"02_kierratysmateriaalit_res.jpg",
		"02_kierratysmateriaalit_med.jpg"
	),
	new PicStr(
		"Rakenneleikkaus",
		"home6_pic2_text",
		"03_rakenneleikkaus_res.jpg",
		"03_rakenneleikkaus_med.jpg"
	),
	new PicStr(
		"Detalji",
		"home6_pic3_text",
		"04_detalji_res.png",
		"04_detalji_med.png"
	),
	new PicStr(
		"Ulkoperspektiivi",
		"home6_pic4_text",
		"05_ulkoperspektiivi_res.jpg",
		"05_ulkoperspektiivi_med.jpg"
	),
	new PicStr(
		"Pohjat",
		"home6_pic5_text",
		"06_pohjat_res.jpg",
		"06_pohjat_med.jpg"
	),
	new PicStr(
		"Sisäperspektiivi",
		"home6_pic6_text",
		"07_sisaperspektiivi_res.jpg",
		"07_sisaperspektiivi_med.jpg"
	)
);

// SynBIOS
array_push ( $picturedata[7],
	new PicStr(
		"Pystyleikkaus",
		"home7_pic0_text",
		"01_Pystyleikkaus_res.jpg",
		"01_Pystyleikkaus_med.jpg"
	),
	new PicStr(
		"Vaakaleikkaus",
		"home7_pic1_text",
		"02_Vaakaleikkaus_res.jpg",
		"02_Vaakaleikkaus_med.jpg"
	),
	new PicStr(
		"Symbioosi",
		"home7_pic2_text",
		"03_Symbioosi_res.jpg",
		"03_Symbioosi_med.jpg"
	),
	new PicStr(
		"Sisäperspektiivi 1",
		"home7_pic3_text",
		"04_Sisaperskis1_res.jpg",
		"04_Sisaperskis1_med.jpg"
	),
	new PicStr(
		"Sisäperspektiivi 2",
		"home7_pic4_text",
		"05_Sisaperskis2_res.jpg",
		"05_Sisaperskis2_med.jpg"
	),
	new PicStr(
		"Pohjapiirustus",
		"home7_pic5_text",
		"06_Pohjapiirustus_res.png",
		"06_Pohjapiirustus_med.png"
	)
);
