
/** dropdown_options indexes **/
db.getCollection("dropdown_options").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** dropdown_options records **/
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45a9"),
  "lang": "it",
  "label": "Materiale Primario Capispalla",
  "attr_id": 93,
  "type": "drop_options",
  "options": [
    "Alpaca",
    "Cammello",
    "Cashmere",
    "Chiffon",
    "Corda",
    "Cotone",
    "Jersey",
    "Lana",
    "Merino",
    "Organza",
    "Raso",
    "Seta",
    "Velluto",
    "Vigogna",
    "Altre fibre naturali",
    "Capretto",
    "Cavallino",
    "Cuoio",
    "Pelle",
    "Pelle Coccodrillo",
    "Pelle e fibra tessile",
    "Pelle martellata",
    "Pelle Razza",
    "Pelle scamosciata",
    "Pelle scamosciata Vitello",
    "Pelle spazzolata",
    "Pelle stampata a Coccodrillo",
    "Pelle stampata",
    "Pelle stampata a Serpente ",
    "Pelle stampata altri rettili",
    "Pelle verniciata",
    "Pelliccia Castoro",
    "Pelliccia Ermellino",
    "Pelliccia Leopardo",
    "Pelliccia Montone",
    "Pelliccia Visone",
    "Pelliccia Volpe",
    "Pellice Zibellino",
    "Vitello",
    "Altre pelli",
    "Altre pellicce",
    "Cordura",
    "Ecopelle",
    "Gore-tex e similari",
    "Materiale tecnico vario",
    "Nylon",
    "Policarbonato",
    "Poliestere",
    "Poliammide",
    "Tricore Poliestere",
    "Altri sintetici"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.560Z"),
  "created_at": ISODate("2016-11-11T12:41:46.560Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45aa"),
  "lang": "en",
  "label": "Materiale Primario Capispalla",
  "attr_id": 93,
  "type": "drop_options",
  "options": [
    "Alpaca",
    "Camel",
    "Cashmere",
    "Chiffon",
    "Rope",
    "Cotton",
    "Jersey",
    "Wool",
    "Merino",
    "Organza",
    "Satin",
    "Silk",
    "Velvet",
    "Vicuna",
    "Other Natural Fibers",
    "Kid",
    "Pony Leather",
    "Hide",
    "Leather",
    "Crocodile Leather",
    "Leather & Textile",
    "Hammered Leather",
    "Ray Leather",
    "Suede Leather",
    "Veal Suede Leather",
    "Brushed Leather",
    "Crocodile Print Leather",
    "Printed Leather",
    "Snake Print Leather",
    "Other Reptile Print Leather",
    "Varnished Leather",
    "Beaver Fur",
    "Ermine Fur",
    "Leopard-Skin",
    "Sheepskin",
    "Mink Fur",
    "Fox Fur",
    "Sable Fur",
    "Veal",
    "Other Leathers",
    "Other Furs",
    "Cordura",
    "Eco-Leather ",
    "Gore-tex & Similar Fibers",
    "Unspecified Technical Material",
    "Nylon",
    "Polycarbonate",
    "Polyester",
    "Polyamide",
    "Tri-Core Polyester",
    "Other Synthetic Fibers"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.561Z"),
  "created_at": ISODate("2016-11-11T12:41:46.561Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45b9"),
  "lang": "it",
  "label": "Materiale borse",
  "attr_id": 103,
  "type": "drop_options",
  "options": [
    "Altre pelli",
    "Altre pellicce",
    "Capretto",
    "Cashmere",
    "Cavallino",
    "Corda",
    "Cordura",
    "Cotone",
    "Cuoio",
    "Daino",
    "Ecopelle",
    "Fibre tessili monocolore",
    "Fibre tessili animalier",
    "Fibre tessili multicolore",
    "Gore-tex e similari",
    "Lana",
    "Materiale tecnico non specificato",
    "Montone",
    "Nylon",
    "Pecari",
    "Pelle",
    "Pelle Coccodrillo",
    "Pelle e fibra tessile",
    "Pelle martellata",
    "Pelle Razza",
    "Pelle scamosciata",
    "Pelle scamosciata Vitello",
    "Pelle spazzolata",
    "Pelle stampata a Coccodrillo",
    "Pelle stampata",
    "Pelle stampata a Serpente ",
    "Pelle stampata altri rettili",
    "Pelle verniciata",
    "Pelliccia Castoro",
    "Pelliccia Ermellino",
    "Pelliccia Leopardo",
    "Pelliccia Montone",
    "Pelliccia Visone",
    "Pelliccia Volpe",
    "Pelliccia Zibellino",
    "Poliammide",
    "Policarbonato",
    "Poliestere",
    "Raso",
    "Seta",
    "Tessuto impermeabile",
    "Tricore Poliestere",
    "Vitello"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.584Z"),
  "created_at": ISODate("2016-11-11T12:41:46.584Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ba"),
  "lang": "en",
  "label": "Materiale borse",
  "attr_id": 103,
  "type": "drop_options",
  "options": [
    "Other Leathers",
    "Other Furs",
    "Kid",
    "Cashmere",
    "Pony Leather",
    "Rope",
    "Cordura",
    "Cotton",
    "Hide",
    "Deer",
    "Eco-Leather ",
    "Monocrome Textile Fibers",
    "Animalier Textile Fibers",
    "Multicolor Textile Fibers",
    "Gore-tex & Similar Fibers",
    "Wool",
    "Unspecified Technical Material",
    "Sheepskin",
    "Nylon",
    "Peccary",
    "Leather",
    "Crocodile Leather",
    "Leather & Textile",
    "Hammered Leather",
    "Ray Leather",
    "Suede Leather",
    "Veal Suede Leather",
    "Brushed Leather",
    "Crocodile Print Leather",
    "Printed Leather",
    "Snake Print Leather",
    "Other Reptile Print Leather",
    "Varnished Leather",
    "Beaver Fur",
    "Ermine Fur",
    "Leopard-Skin",
    "Sheepskin",
    "Mink Fur",
    "Fox Fur",
    "Sable Fur",
    "Polyamide",
    "Polycarbonate",
    "Polyester",
    "Satin",
    "Silk",
    "Waterproof Fabric",
    "Tri-Core Polyester",
    "Veal"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.585Z"),
  "created_at": ISODate("2016-11-11T12:41:46.585Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45c7"),
  "lang": "it",
  "label": "Materiale delle scarpe",
  "attr_id": 126,
  "type": "drop_options",
  "options": [
    "Corda",
    "Cuoio",
    "Pelle",
    "Fibre tessili monocolore",
    "Pelle stampata",
    "Pelle stampata a coccodrillo",
    "Pelle stampata a serpente ",
    "Pelle stampata altri rettili",
    "Pelliccia montone",
    "Pelliccia Visone",
    "Pelliccia Volpe",
    "Pelliccia Leopardo",
    "Pelle coccodrillo",
    "Pelliccia ermellino",
    "Pelliccia zibellino",
    "Pelliccia castoro",
    "Pelle razza",
    "Altre pellicce",
    "Altre pelli",
    "Fibre tessili animalier",
    "Fibre tessili multicolore",
    "Pelle e fibra tessile",
    "Pelle scamosciata",
    "Pelle scamosciata Vitello",
    "Vitello",
    "Capretto",
    "Cavallino",
    "Pelle verniciata",
    "Ecopelle",
    "Pelle spazzolata",
    "Pelle martellata",
    "Gore-tex e similari",
    "Tessuto impermeabile",
    "Materiale tecnico non specificato",
    "Poliammide",
    "Nylon",
    "Policarbonato",
    "Poliestere",
    "Cordura",
    "Tricore Poliestere",
    "Cotone",
    "Lana",
    "Raso",
    "Seta"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.611Z"),
  "created_at": ISODate("2016-11-11T12:41:46.611Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45c8"),
  "lang": "en",
  "label": "Materiale delle scarpe",
  "attr_id": 126,
  "type": "drop_options",
  "options": [
    "Rope",
    "Hide",
    "Leather",
    "Monocrome Textile Fibers",
    "Printed Leather",
    "Crocodile Print Leather",
    "Snake Print Leather",
    "Other Reptile Print Leather",
    "Sheepskin",
    "Mink Fur",
    "Fox Fur",
    "Leopard-Skin",
    "Crocodile Leather",
    "Ermine Fur",
    "Sable Fur",
    "Beaver Fur",
    "Ray Leather",
    "Other Furs",
    "Other Leathers",
    "Animalier Textile Fibers",
    "Multicolor Textile Fibers",
    "Leather & Textile",
    "Suede Leather",
    "Veal Suede Leather",
    "Veal",
    "Kid",
    "Pony Leather",
    "Varnished Leather",
    "Eco-Leather ",
    "Brushed Leather",
    "Hammered Leather",
    "Gore-tex & Similar Fibers",
    "Waterproof Fabric",
    "Unspecified Technical Material",
    "Polyamide",
    "Nylon",
    "Polycarbonate",
    "Polyester",
    "Cordura",
    "Tri-Core Polyester",
    "Cotton",
    "Wool",
    "Satin",
    "Silk"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.613Z"),
  "created_at": ISODate("2016-11-11T12:41:46.613Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ed"),
  "lang": "it",
  "label": "Materiale delle cinture",
  "attr_id": 153,
  "type": "drop_options",
  "options": [
    "Corda",
    "Cuoio",
    "Pelle",
    "Fibre tessili monocolore",
    "Pelle stampata",
    "Pelle stampata a coccodrillo",
    "Pelle stampata a serpente ",
    "Pelle stampata altri rettili",
    "Pelliccia montone",
    "Pelliccia Visone",
    "Pelliccia Volpe",
    "Pelliccia Leopardo",
    "Pelle coccodrillo",
    "Pelliccia ermellino",
    "Pellicia zibellino",
    "Pelliccia castoro",
    "Pelle razza",
    "Altre pellicce",
    "Altre pelli",
    "Fibre tessili animalier",
    "Fibre tessili multicolore",
    "Pelle e fibra tessile",
    "Pelle scamosciata",
    "Pelle scamosciata Vitello",
    "Vitello",
    "Capretto",
    "Cavallino",
    "Pelle verniciata",
    "Ecopelle",
    "Pelle spazzolata",
    "Pelle martellata",
    "Gore-tex e similari",
    "Tessuto impermeabile",
    "Materiale tecnico non specificato",
    "Poliammide",
    "Nylon",
    "Policarbonato",
    "Poliestere",
    "Cordura",
    "Tricore Poliestere",
    "Cotone",
    "Lana"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.675Z"),
  "created_at": ISODate("2016-11-11T12:41:46.675Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ee"),
  "lang": "en",
  "label": "Materiale delle cinture",
  "attr_id": 153,
  "type": "drop_options",
  "options": [
    "Rope",
    "Hide",
    "Leather",
    "Monocrome Textile Fibers",
    "Printed Leather",
    "Crocodile Print Leather",
    "Snake Print Leather",
    "Other Reptile Print Leather",
    "Sheepskin",
    "Mink Fur",
    "Fox Fur",
    "Leopard-Skin",
    "Crocodile Leather",
    "Ermine Fur",
    "Sable Fur",
    "Beaver Fur",
    "Ray Leather",
    "Other Furs",
    "Other Leathers",
    "Animalier Textile Fibers",
    "Multicolor Textile Fibers",
    "Leather & Textile",
    "Suede Leather",
    "Veal Suede Leather",
    "Veal",
    "Kid",
    "Pony Leather",
    "Varnished Leather",
    "Eco-Leather",
    "Brushed Leather",
    "Hammered Leather",
    "Gore-tex & Similar Fibers",
    "Waterproof Fabric",
    "Unspecified Technical Material",
    "Polyamide",
    "Nylon",
    "Polycarbonate",
    "Polyester",
    "Cordura",
    "Tri-Core Polyester",
    "Cotton",
    "Wool"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.677Z"),
  "created_at": ISODate("2016-11-11T12:41:46.677Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45fb"),
  "lang": "it",
  "label": "Materiale dei guanti",
  "attr_id": 161,
  "type": "drop_options",
  "options": [
    "Altre pelli",
    "Altre pellicce",
    "Cashmere",
    "Capretto",
    "Cavallino",
    "Cordura",
    "Cotone",
    "Cuoio",
    "Daino",
    "Ecopelle",
    "Fibre tessili monocolore",
    "Fibre tessili animalier",
    "Fibre tessili multicolore",
    "Gore-tex e similari",
    "Lana",
    "Materiale tecnico non specificato",
    "Montone",
    "Nylon",
    "Pecari",
    "Pelle",
    "Pelle Coccodrillo",
    "Pelle e fibra tessile",
    "Pelle martellata",
    "Pelle Razza",
    "Pelle scamosciata",
    "Pelle scamosciata Vitello",
    "Pelle spazzolata",
    "Pelle stampata a Coccodrillo",
    "Pelle stampata",
    "Pelle stampata a Serpente ",
    "Pelle stampata altri rettili",
    "Pelle verniciata",
    "Pelliccia Castoro",
    "Pelliccia Ermellino",
    "Pelliccia Leopardo",
    "Pelliccia Montone",
    "Pelliccia Visone",
    "Pelliccia Volpe",
    "Pellicia Zibellino",
    "Poliammide",
    "Poliestere",
    "Reps",
    "Sergé",
    "Seta",
    "Tessuto impermeabile",
    "Tricore Poliestere",
    "Twill",
    "Raso",
    "Vitello"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.698Z"),
  "created_at": ISODate("2016-11-11T12:41:46.698Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45fc"),
  "lang": "en",
  "label": "Materiale dei guanti",
  "attr_id": 161,
  "type": "drop_options",
  "options": [
    "Other Leathers",
    "Other Furs",
    "Cashmere",
    "Kid",
    "Pony Leather",
    "Cordura",
    "Cotton",
    "Hide",
    "Deer",
    "Eco-Leather",
    "Monocrome Textile Fibers",
    "Animalier Textile Fibers",
    "Multicolor Textile Fibers",
    "Gore-tex & Similar Fibers",
    "Wool",
    "Unspecified Technical Material",
    "Sheepskin",
    "Nylon",
    "Peccary",
    "Leather",
    "Crocodile Leather",
    "Leather & Textile",
    "Hammered Leather",
    "Ray Leather",
    "Suede Leather",
    "Veal Suede Leather",
    "Brushed Leather",
    "Crocodile Print Leather",
    "Printed Leather",
    "Snake Print Leather",
    "Other Reptile Print Leather",
    "Varnished Leather",
    "Beaver Fur",
    "Ermine Fur",
    "Leopard-Skin",
    "Sheepskin",
    "Mink Fur",
    "Fox Fur",
    "Sable Fur",
    "Polyamide",
    "Polyester",
    "Reps",
    "Sergé",
    "Silk",
    "Waterproof Fabric",
    "Tri-Core Polyester",
    "Twill",
    "Satin",
    "Veal"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.700Z"),
  "created_at": ISODate("2016-11-11T12:41:46.700Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4693"),
  "lang": "it",
  "label": "Printing Products",
  "attr_id": 394,
  "type": "drop_options",
  "options": [
    "Stampa Biglietti Auguri",
    "Stampa Cartellini",
    "Stampa copertine rigide Libri",
    "Stampa Inviti",
    "Stampa oggetti con Logo Aziendale",
    "Stampa Carta Intestata",
    "Stampa luminosa",
    "Stampa Giornali",
    "Stampa Banner Colorati",
    "Stampa Manuali & Cartelle",
    "Stampa su Tappetini Mouse",
    "Stampa su Notebook",
    "Stampa su Notepads",
    "Stampa su scatole imballaggio",
    "Stampa su sacchetti di carta",
    "Stampa Cartoline",
    "Stampa Poster",
    "Servizi Pre-Stampa",
    "Stampa Cartelle di Presentazione",
    "Stampa Depliant",
    "Stampa Blocchi Note",
    "Stampa Stands Fiera",
    "Stampa Copertine Morbide Libri",
    "Stampa Veloce Documenti",
    "Stampa Adesivi",
    "Stampa Etichette",
    "Stampa Banner in Vinile",
    "Stampa Pagine Gialle",
    "Altri Servizi di Stampa"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.920Z"),
  "created_at": ISODate("2016-11-11T12:41:46.920Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4741"),
  "lang": "it",
  "label": "Countries where you don't ship",
  "attr_id": 598,
  "type": "drop_options",
  "options": [
    "AFRICA",
    "Algeria",
    "Angola",
    "Benin",
    "Botswana",
    "Burkina Faso",
    "Burundi",
    "Camerun",
    "Ciad",
    "Comoros",
    "Congo, Repubblica",
    "Congo, Repubblica Democratica",
    "Costa d'Avorio",
    "Egitto",
    "Eritrea",
    "Etiopia",
    "Gambia",
    "Ghana",
    "Gibuti",
    "Guinea",
    "Guinea Equatoriale",
    "Guinea-Bissau",
    "Isole di Capo Verde",
    "Kenya",
    "Lesotho",
    "Liberia",
    "Libia",
    "Madagascar",
    "Malawi",
    "Mali",
    "Marocco",
    "Mauritania",
    "Mauritius",
    "Mayotte",
    "Mozambico",
    "Namibia",
    "Niger",
    "Nigeria",
    "Repubblica Centrafricana",
    "Repubblica di Gabon",
    "Reunion",
    "Ruanda",
    "Sahara Occidentale",
    "Senegal",
    "Seychelles",
    "Sierra Leone",
    "Somalia",
    "St. Elena",
    "Sudafrica",
    "Swaziland",
    "Tanzania",
    "Togo",
    "Tunisia",
    "Uganda",
    "Zambia",
    "Zimbabwe",
    "ASIA",
    "Afghanistan",
    "Armenia",
    "Bangladesh",
    "Bhutan",
    "Cina",
    "Corea del Sud",
    "Georgia",
    "Giappone",
    "Hong Kong",
    "India",
    "Kazakistan",
    "Kirghizistan",
    "Macao",
    "Maldive",
    "Mongolia",
    "Nepal",
    "Pakistan",
    "Azerbaijan, Repubblica Democratica",
    "Sri Lanka",
    "Tagikistan",
    "Turkmenistan",
    "Uzbekistan",
    "AMERICA CENTRALE E CARAIBI",
    "Anguilla",
    "Antigua e Barbuda",
    "Antille Olandesi",
    "Aruba",
    "Bahamas",
    "Barbados",
    "Belize",
    "Costa Rica",
    "Dominica",
    "El Salvador",
    "Giamaica",
    "Grenada",
    "Guadalupe",
    "Guatemala",
    "Haiti",
    "Honduras",
    "Isole Cayman",
    "Isole Turks e Caicos",
    "Isole Vergini (U.S.A.)",
    "Isole Vergini Britanniche",
    "Martinica",
    "Montserrat",
    "Nicaragua",
    "Panama",
    "Porto Rico",
    "Repubblica Dominicana",
    "San Vincenzo e Grenadine",
    "Santa Lucia",
    "St. Kitts-Nevis",
    "Trinidad e Tobago",
    "EUROPA",
    "Albania",
    "Andorra",
    "Austria",
    "Belgio",
    "Bielorussia",
    "Bosnia ed Erzegovina",
    "Bulgaria",
    "Cipro",
    "Città del Vaticano",
    "Croazia, Repubblica di",
    "Danimarca",
    "Estonia",
    "Federazione Russa",
    "Finlandia",
    "Francia",
    "Germania",
    "Gibilterra",
    "Grecia",
    "Guernsey",
    "Irlanda",
    "Islanda",
    "Jersey",
    "Lettonia",
    "Liechtenstein",
    "Lituania",
    "Lussemburgo",
    "Macedonia",
    "Malta",
    "Moldova",
    "Monaco",
    "Montenegro",
    "Norvegia",
    "Paesi Bassi",
    "Polonia",
    "Portogallo",
    "Regno Unito",
    "Repubblica Ceca",
    "Romania",
    "San Marino",
    "Serbia",
    "Slovacchia",
    "Slovenia",
    "Spagna",
    "Svalbard and Jan Mayen",
    "Svezia",
    "Svizzera",
    "Ucraina",
    "Ungheria",
    "MEDIO ORIENTE",
    "Arabia Saudita",
    "Bahrein",
    "Emirati Arabi Uniti",
    "Giordania",
    "Iraq",
    "Israele",
    "Kuwait",
    "Libano",
    "Oman",
    "Qatar",
    "Turchia",
    "Yemen",
    "NORD AMERICA",
    "Bermuda",
    "Canada",
    "Groenlandia",
    "Messico",
    "St Pierre e Miquelon",
    "Stati Uniti",
    "OCEANIA",
    "Australia",
    "Figi",
    "Guam",
    "Isole Cook",
    "Isole Marshall",
    "Isole Salomone",
    "Kiribati",
    "Micronesia",
    "Nauru",
    "Niue",
    "Nuova Caledonia",
    "Nuova Zelanda",
    "Palau",
    "Papua Nuova Guinea",
    "Polinesia francese",
    "Samoa americane",
    "Samoa Occidentale",
    "Tonga",
    "Tuvalu",
    "Vanuatu",
    "Wallis e Futuna",
    "ASIA SUD ORIENTALE",
    "Brunei Darussalam",
    "Cambogia",
    "Filippine",
    "Indonesia",
    "Laos",
    "Malesia",
    "Singapore",
    "Tailandia",
    "Taiwan",
    "Vietnam",
    "SUD AMERICA",
    "Argentina",
    "Bolivia",
    "Brasile",
    "Cile",
    "Colombia",
    "Ecuador",
    "Guyana",
    "Guyana Francese",
    "Isole Falkland (Islas Malvinas)",
    "Paraguay",
    "Perù",
    "Suriname",
    "Uruguay",
    "Venezuela"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.192Z"),
  "created_at": ISODate("2016-11-11T12:41:47.192Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4742"),
  "lang": "en",
  "label": "Countries where you don't ship",
  "attr_id": 598,
  "type": "drop_options",
  "options": [
    "AFRICA",
    "Algeria",
    "Angola",
    "Benin",
    "Botswana",
    "Burkina Faso",
    "Burundi",
    "Cameroon",
    "Chad",
    "Comoros",
    "Congo, Republic",
    "Congo, Democratic Republic",
    "Ivory Coast",
    "Egypt",
    "Eritrea",
    "Ethiopia",
    "Gambia",
    "Ghana",
    "Djibouti",
    "Guinea",
    "Equatorial Guinea",
    "Guinea-Bissau",
    "Cape Verde Islands",
    "Kenya",
    "Lesotho",
    "Liberia",
    "Libya",
    "Madagascar",
    "Malawi",
    "Mali",
    "Morocco",
    "Mauritania",
    "Mauritius",
    "Mayotte",
    "Mozambique",
    "Namibia",
    "Niger",
    "Nigeria",
    "Central African Republic",
    "Republic of Gabon",
    "Reunion",
    "Rwanda",
    "Western Sahara",
    "Senegal",
    "Seychelles",
    "Sierra Leone",
    "Somalia",
    "St. Helena",
    "South Africa",
    "Swaziland",
    "Tanzania",
    "Togo",
    "Tunisia",
    "Uganda",
    "Zambia",
    "Zimbabwe",
    "ASIA",
    "Afghanistan",
    "Armenia",
    "Bangladesh",
    "Bhutan",
    "China",
    "South Korea",
    "Georgia",
    "Japan",
    "Hong Kong",
    "India",
    "Kazakhstan",
    "Kyrgyzstan",
    "Macau",
    "Maldives",
    "Mongolia",
    "Nepal",
    "Pakistan",
    "Azerbaijan Democratic Republic",
    "Sri Lanka",
    "Tajikistan",
    "Turkmenistan",
    "Uzbekistan",
    "CENTRAL AMERICA AND CARIBBEAN",
    "Anguilla",
    "Antigua and Barbuda",
    "Netherlands Antilles",
    "Aruba",
    "Bahamas",
    "Barbados",
    "Belize",
    "Costa Rica",
    "Dominica",
    "El Salvador",
    "Jamaica",
    "Grenada",
    "Guadalupe",
    "Guatemala",
    "Haiti",
    "Honduras",
    "Cayman Islands",
    "Turks and Caicos Islands",
    "Virgin Islands (U.S.A).",
    "British Virgin Islands",
    "Martinique",
    "Montserrat",
    "Nicaragua",
    "Panama",
    "Puerto Rico",
    "Dominican Republic",
    "St. Vincent and the Grenadines",
    "Santa Lucia",
    "St. Kitts-Nevis",
    "Trinidad and Tobago",
    "EUROPE",
    "Albania",
    "Andorra",
    "Austria",
    "Belgium",
    "Belarus",
    "Bosnia and Herzegovina",
    "Bulgaria",
    "Cyprus",
    "Città del Vaticano",
    "Croatia, Republic Of",
    "Denmark",
    "Estonia",
    "Russian Federation",
    "Finland",
    "France",
    "Germany",
    "Gibraltar",
    "Greece",
    "Guernsey",
    "Ireland",
    "Iceland",
    "Jersey",
    "Latvia",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macedonia",
    "Malta",
    "Moldova",
    "Monaco",
    "Montenegro",
    "Norway",
    "Netherlands",
    "Poland",
    "Portugal",
    "United Kingdom",
    "Czech Republic",
    "Romania",
    "San Marino",
    "Serbia",
    "Slovakia",
    "Slovenia",
    "Spain",
    "Svalbard and Jan Mayen",
    "Sweden",
    "Switzerland",
    "Ukraine",
    "Hungary",
    "MIDDLE EAST",
    "Saudi Arabia",
    "Bahrain",
    "United Arab Emirates",
    "Jordan",
    "Iraq",
    "Israel",
    "Kuwait",
    "Lebanon",
    "Oman",
    "Qatar",
    "Turkey",
    "Yemen",
    "NORTH AMERICA",
    "Bermuda",
    "Canada",
    "Greenland",
    "Mexico",
    "St. Pierre and Miquelon",
    "United States",
    "OCEANIA",
    "Australia",
    "Fiji",
    "Guam",
    "Cook Islands",
    "Marshall Islands",
    "Solomon Islands",
    "Kiribati",
    "Micronesia",
    "Nauru",
    "Niue",
    "New Caledonia",
    "New Zealand",
    "Palau",
    "Papua New Guinea",
    "French Polynesia",
    "American Samoa",
    "Western Samoa",
    "Tonga",
    "Tuvalu",
    "Vanuatu",
    "Wallis and Futuna",
    "SOUTH EAST ASIA",
    "Brunei Darussalam",
    "Cambodia",
    "Philippines",
    "Indonesia",
    "Laos",
    "Malaysia",
    "Singapore",
    "Thailand",
    "Taiwan",
    "Vietnam",
    "SOUTH AMERICA",
    "Argentina",
    "Bolivia",
    "Brazil",
    "Chile",
    "Colombia",
    "Ecuador",
    "Guyana",
    "French Guiana",
    "Falkland Islands (Islas Malvinas)",
    "Paraguay",
    "Peru",
    "Suriname",
    "Uruguay",
    "Venezuela"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.194Z"),
  "created_at": ISODate("2016-11-11T12:41:47.194Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4567"),
  "lang": "it",
  "label": "Status ICT & Machinery",
  "attr_id": 10,
  "type": "drop_options",
  "options": [
    "Nuovo",
    "Ricondizionato",
    "Usato",
    "Non Funzionante",
    "As Is Funzionante",
    "Nuovo Scatola Aperta",
    "Dealer Recertified",
    "Maintenance Qualified",
    "Ricondizionato dal Produttore",
    "Nuovo Scatola non originale",
    "Nuovo Dismesso",
    "Dismesso",
    "Mai Usato",
    "Pre-owned"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.441Z"),
  "created_at": ISODate("2016-11-11T12:41:46.441Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4568"),
  "lang": "en",
  "label": "Status ICT & Machinery",
  "attr_id": 10,
  "type": "drop_options",
  "options": [
    "New",
    "Refurbished ",
    "Used",
    "Not Working",
    "As Is Working",
    "New Open Box",
    "Dealer Recertified",
    "Maintenance Qualified",
    "Manufacturer Refurbished",
    "New In Box",
    "New Pull",
    "Pull",
    "Unused",
    "Pre-owned"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.443Z"),
  "created_at": ISODate("2016-11-11T12:41:46.443Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4569"),
  "lang": "it",
  "label": "Status Auto/Moto/Barche",
  "attr_id": 11,
  "type": "drop_options",
  "options": [
    "Nuovo",
    "Km0",
    "Usato",
    "Ricostruito"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.445Z"),
  "created_at": ISODate("2016-11-11T12:41:46.445Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b456a"),
  "lang": "en",
  "label": "Status Auto/Moto/Barche",
  "attr_id": 11,
  "type": "drop_options",
  "options": [
    "New",
    "Km0",
    "Used",
    "Rebuilt"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.448Z"),
  "created_at": ISODate("2016-11-11T12:41:46.448Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b456b"),
  "lang": "it",
  "label": "Valuta quotazione",
  "attr_id": 13,
  "type": "drop_options",
  "options": [
    "European Countries - EUR",
    "USA  Dollar - USD",
    "UK Pound - GBP",
    "Switzerland Franc - CHF",
    "Japan Yen - JPY",
    "Afghanistan Afghani - AFN",
    "Albania Lek - ALL",
    "Algeria Dinar - DZD",
    "Angola Kwanza - AOA",
    "Argentina Peso - ARS",
    "Armenia Dram - AMD",
    "Aruba Guilder - AWG",
    "Australia Dollar - AUD",
    "Azerbaijan Manat - AZN",
    "Bahamas Dollar - BSD",
    "Bahrain Dinar - BHD",
    "Bangladesh Taka - BDT",
    "Barbados Dollar - BBD",
    "BCEAO Franc - XOF",
    "Belarus Ruble - BYR",
    "Belize Dollar - BZD",
    "Bermuda Dollar - BMD",
    "Bhutan Ngultrum - BTN",
    "Bitcoin - XBT",
    "Bolivia Boliviano - BOB",
    "Bosnia and Herzeg. Marka - BAM",
    "Botswana Pula - BWP",
    "Brazil Real - BRL",
    "Brunei Dollar - BND",
    "Bulgaria Lev - BGN",
    "Burundi Franc - BIF",
    "Cambodia Riel - KHR",
    "Canada Dollar - CAD",
    "Cape Verde Escudo - CVE",
    "Cayman Dollar - KYD",
    "CFA Franc BEAC - XAF",
    "CFP Franc - XPF",
    "Chile Peso - CLP",
    "China Yuan Renminbi - CNY",
    "Colombia Peso - COP",
    "Comoros Franc - KMF",
    "Congo Kinshasa Franc - CDF",
    "Costa Rica Colon - CRC",
    "Croatia Kuna - HRK",
    "Cuba Con. Peso - CUC",
    "Cuba Peso - CUP",
    "Czech Republic Koruna - CZK",
    "Denmark Krone - DKK",
    "Djibouti Franc - DJF",
    "Dominican Republic Peso - DOP",
    "East Caribbean Dollar - XCD",
    "Egypt Pound - EGP",
    "El Salvador Colon - SVC",
    "Eritrea Nakfa - ERN",
    "Ethiopia Birr - ETB",
    "Falkland Pound - FKP",
    "Fiji Dollar - FJD",
    "Gambia Dalasi - GMD",
    "Georgia Lari - GEL",
    "Ghana Cedi - GHS",
    "Gibraltar Pound - GIP",
    "Guatemala Quetzal - GTQ",
    "Guernsey Pound - GGP",
    "Guinea Franc - GNF",
    "Guyana Dollar - GYD",
    "Haiti Gourde - HTG",
    "Honduras Lempira - HNL",
    "Hong Kong Dollar - HKD",
    "Hungary Forint - HUF",
    "Iceland Krona - ISK",
    "India Rupee - INR",
    "Indonesia Rupiah - IDR",
    "Iran Rial - IRR",
    "Iraq Dinar - IQD",
    "Isle of Man Pound - IMP",
    "Israel Shekel - ILS",
    "Jamaica Dollar - JMD",
    "Jersey Pound - JEP",
    "Jordan Dinar - JOD",
    "Kazakhstan Tenge - KZT",
    "Kenya Shilling - KES",
    "Korea (North) Won - KPW",
    "Korea (South) Won - KRW",
    "Kuwait Dinar - KWD",
    "Kyrgyzstan Som - KGS",
    "Laos Kip - LAK",
    "Lebanon Pound - LBP",
    "Lesotho Loti - LSL",
    "Liberia Dollar - LRD",
    "Libya Dinar - LYD",
    "Lithuania Litas - LTL",
    "Macau Pataca - MOP",
    "Macedonia Denar - MKD",
    "Madagascar Ariary - MGA",
    "Malawi Kwacha - MWK",
    "Malaysia Ringgit - MYR",
    "Maldives Rufiyaa - MVR",
    "Mauritania Ouguiya - MRO",
    "Mauritius Rupee - MUR",
    "Mexico Peso - MXN",
    "Moldova Leu - MDL",
    "Mongolia Tughrik - MNT",
    "Morocco Dirham - MAD",
    "Mozambique Metical - MZN",
    "Myanmar (Burma) Kyat - MMK",
    "Namibia Dollar - NAD",
    "Nepal Rupee - NPR",
    "Neth. Antilles Guilder - ANG",
    "New Guinea Kina - PGK",
    "New Zealand Dollar - NZD",
    "Nicaragua Cordoba - NIO",
    "Nigeria Naira - NGN",
    "Norway Krone - NOK",
    "Oman Rial - OMR",
    "Pakistan Rupee - PKR",
    "Panama Balboa - PAB",
    "Paraguay Guarani - PYG",
    "Peru Nuevo Sol - PEN",
    "Philippines Peso - PHP",
    "Poland Zloty - PLN",
    "Qatar Riyal - QAR",
    "Romania New Leu - RON",
    "Russia Ruble - RUB",
    "Rwanda Franc - RWF",
    "Samoa Tala - WST",
    "São Tomé Dobra - STD",
    "Saudi Arabia Riyal - SAR",
    "Seborga Luigino - SPL",
    "Serbia Dinar - RSD",
    "Seychelles Rupee - SCR",
    "Sierra Leone Leone - SLL",
    "Singapore Dollar - SGD",
    "Solomon Dollar - SBD",
    "Somalia Shilling - SOS",
    "South Africa Rand - ZAR",
    "Sri Lanka Rupee - LKR",
    "St. Helena Pound - SHP",
    "Sudan Pound - SDG",
    "Suriname Dollar - SRD",
    "Swaziland Lilangeni - SZL",
    "Sweden Krona - SEK",
    "Syria Pound - SYP",
    "Taiwan New Dollar - TWD",
    "Tajikistan Somoni - TJS",
    "Tanzania Shilling - TZS",
    "Thailand Baht - THB",
    "Tonga Pa'anga - TOP",
    "Trinidad Tobago Dollar - TTD",
    "Tunisia Dinar - TND",
    "Turkey Lira - TRY",
    "Turkmenistan Manat - TMT",
    "Tuvalu Dollar - TVD",
    "UAE Dirham - AED",
    "Uganda Shilling - UGX",
    "Ukraine Hryvnia - UAH",
    "Uruguay Peso - UYU",
    "Uzbekistan Som - UZS",
    "Vanuatu Vatu - VUV",
    "Venezuela Bolivar - VEF",
    "Viet Nam Dong - VND",
    "Yemen Rial - YER",
    "Zambia Kwacha - ZMW",
    "Zimbabwe Dollar - ZWD"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.450Z"),
  "created_at": ISODate("2016-11-11T12:41:46.450Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b456c"),
  "lang": "en",
  "label": "Valuta quotazione",
  "attr_id": 13,
  "type": "drop_options",
  "options": [
    "European Countries - EUR",
    "USA  Dollar - USD",
    "UK Pound - GBP",
    "Switzerland Franc - CHF",
    "Japan Yen - JPY",
    "Afghanistan Afghani - AFN",
    "Albania Lek - ALL",
    "Algeria Dinar - DZD",
    "Angola Kwanza - AOA",
    "Argentina Peso - ARS",
    "Armenia Dram - AMD",
    "Aruba Guilder - AWG",
    "Australia Dollar - AUD",
    "Azerbaijan Manat - AZN",
    "Bahamas Dollar - BSD",
    "Bahrain Dinar - BHD",
    "Bangladesh Taka - BDT",
    "Barbados Dollar - BBD",
    "BCEAO Franc - XOF",
    "Belarus Ruble - BYR",
    "Belize Dollar - BZD",
    "Bermuda Dollar - BMD",
    "Bhutan Ngultrum - BTN",
    "Bitcoin - XBT",
    "Bolivia Boliviano - BOB",
    "Bosnia and Herzeg. Marka - BAM",
    "Botswana Pula - BWP",
    "Brazil Real - BRL",
    "Brunei Dollar - BND",
    "Bulgaria Lev - BGN",
    "Burundi Franc - BIF",
    "Cambodia Riel - KHR",
    "Canada Dollar - CAD",
    "Cape Verde Escudo - CVE",
    "Cayman Dollar - KYD",
    "CFA Franc BEAC - XAF",
    "CFP Franc - XPF",
    "Chile Peso - CLP",
    "China Yuan Renminbi - CNY",
    "Colombia Peso - COP",
    "Comoros Franc - KMF",
    "Congo Kinshasa Franc - CDF",
    "Costa Rica Colon - CRC",
    "Croatia Kuna - HRK",
    "Cuba Con. Peso - CUC",
    "Cuba Peso - CUP",
    "Czech Republic Koruna - CZK",
    "Denmark Krone - DKK",
    "Djibouti Franc - DJF",
    "Dominican Republic Peso - DOP",
    "East Caribbean Dollar - XCD",
    "Egypt Pound - EGP",
    "El Salvador Colon - SVC",
    "Eritrea Nakfa - ERN",
    "Ethiopia Birr - ETB",
    "Falkland Pound - FKP",
    "Fiji Dollar - FJD",
    "Gambia Dalasi - GMD",
    "Georgia Lari - GEL",
    "Ghana Cedi - GHS",
    "Gibraltar Pound - GIP",
    "Guatemala Quetzal - GTQ",
    "Guernsey Pound - GGP",
    "Guinea Franc - GNF",
    "Guyana Dollar - GYD",
    "Haiti Gourde - HTG",
    "Honduras Lempira - HNL",
    "Hong Kong Dollar - HKD",
    "Hungary Forint - HUF",
    "Iceland Krona - ISK",
    "India Rupee - INR",
    "Indonesia Rupiah - IDR",
    "Iran Rial - IRR",
    "Iraq Dinar - IQD",
    "Isle of Man Pound - IMP",
    "Israel Shekel - ILS",
    "Jamaica Dollar - JMD",
    "Jersey Pound - JEP",
    "Jordan Dinar - JOD",
    "Kazakhstan Tenge - KZT",
    "Kenya Shilling - KES",
    "Korea (North) Won - KPW",
    "Korea (South) Won - KRW",
    "Kuwait Dinar - KWD",
    "Kyrgyzstan Som - KGS",
    "Laos Kip - LAK",
    "Lebanon Pound - LBP",
    "Lesotho Loti - LSL",
    "Liberia Dollar - LRD",
    "Libya Dinar - LYD",
    "Lithuania Litas - LTL",
    "Macau Pataca - MOP",
    "Macedonia Denar - MKD",
    "Madagascar Ariary - MGA",
    "Malawi Kwacha - MWK",
    "Malaysia Ringgit - MYR",
    "Maldives Rufiyaa - MVR",
    "Mauritania Ouguiya - MRO",
    "Mauritius Rupee - MUR",
    "Mexico Peso - MXN",
    "Moldova Leu - MDL",
    "Mongolia Tughrik - MNT",
    "Morocco Dirham - MAD",
    "Mozambique Metical - MZN",
    "Myanmar (Burma) Kyat - MMK",
    "Namibia Dollar - NAD",
    "Nepal Rupee - NPR",
    "Neth. Antilles Guilder - ANG",
    "New Guinea Kina - PGK",
    "New Zealand Dollar - NZD",
    "Nicaragua Cordoba - NIO",
    "Nigeria Naira - NGN",
    "Norway Krone - NOK",
    "Oman Rial - OMR",
    "Pakistan Rupee - PKR",
    "Panama Balboa - PAB",
    "Paraguay Guarani - PYG",
    "Peru Nuevo Sol - PEN",
    "Philippines Peso - PHP",
    "Poland Zloty - PLN",
    "Qatar Riyal - QAR",
    "Romania New Leu - RON",
    "Russia Ruble - RUB",
    "Rwanda Franc - RWF",
    "Samoa Tala - WST",
    "São Tomé Dobra - STD",
    "Saudi Arabia Riyal - SAR",
    "Seborga Luigino - SPL",
    "Serbia Dinar - RSD",
    "Seychelles Rupee - SCR",
    "Sierra Leone Leone - SLL",
    "Singapore Dollar - SGD",
    "Solomon Dollar - SBD",
    "Somalia Shilling - SOS",
    "South Africa Rand - ZAR",
    "Sri Lanka Rupee - LKR",
    "St. Helena Pound - SHP",
    "Sudan Pound - SDG",
    "Suriname Dollar - SRD",
    "Swaziland Lilangeni - SZL",
    "Sweden Krona - SEK",
    "Syria Pound - SYP",
    "Taiwan New Dollar - TWD",
    "Tajikistan Somoni - TJS",
    "Tanzania Shilling - TZS",
    "Thailand Baht - THB",
    "Tonga Pa'anga - TOP",
    "Trinidad Tobago Dollar - TTD",
    "Tunisia Dinar - TND",
    "Turkey Lira - TRY",
    "Turkmenistan Manat - TMT",
    "Tuvalu Dollar - TVD",
    "UAE Dirham - AED",
    "Uganda Shilling - UGX",
    "Ukraine Hryvnia - UAH",
    "Uruguay Peso - UYU",
    "Uzbekistan Som - UZS",
    "Vanuatu Vatu - VUV",
    "Venezuela Bolivar - VEF",
    "Viet Nam Dong - VND",
    "Yemen Rial - YER",
    "Zambia Kwacha - ZMW",
    "Zimbabwe Dollar - ZWD"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.452Z"),
  "created_at": ISODate("2016-11-11T12:41:46.452Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b456d"),
  "lang": "it",
  "label": "Modalità di vendita",
  "attr_id": 14,
  "type": "drop_options",
  "options": [
    "Vendita",
    "Affitto",
    "Asta"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.453Z"),
  "created_at": ISODate("2016-11-11T12:41:46.453Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b456e"),
  "lang": "en",
  "label": "Modalità di vendita",
  "attr_id": 14,
  "type": "drop_options",
  "options": [
    "To Sell",
    "For Rent",
    "Auction"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.455Z"),
  "created_at": ISODate("2016-11-11T12:41:46.455Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b456f"),
  "lang": "it",
  "label": "Peso Package/Packaging - unità di misura",
  "attr_id": 34,
  "type": "drop_options",
  "options": [
    "Kg",
    "Lb",
    "Ton",
    "1000 Lb"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.456Z"),
  "created_at": ISODate("2016-11-11T12:41:46.456Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4570"),
  "lang": "en",
  "label": "Peso Package/Packaging - unità di misura",
  "attr_id": 34,
  "type": "drop_options",
  "options": [
    "Kg",
    "Lb",
    "Ton",
    "1000 Lb"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.457Z"),
  "created_at": ISODate("2016-11-11T12:41:46.457Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4571"),
  "lang": "it",
  "label": "Paese in cui il prodotto/servizio è disponibile",
  "attr_id": 35,
  "type": "drop_options",
  "options": [
    "Abcasia",
    "Afghanistan",
    "Akrotiri/Dhekelia",
    "Albania",
    "Alderney",
    "Algeria",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antigua/Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Isola di Ascensione",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Bielorussia",
    "Belgio",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia",
    "Bonaire",
    "Bosnia/Herzegovina",
    "Botswana",
    "Brasile",
    "Oceano Indiano Brit.",
    "Isole Vergini Brit.",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Birmania",
    "Burundi",
    "Cambogia",
    "Cameroon",
    "Canada",
    "Capo Verde",
    "Cayman ",
    "Rep. Centrafricana",
    "Ciad",
    "Cile",
    "Cina ",
    "Isole Cocos",
    "Colombia",
    "Comore",
    "Congo, Rep Dem",
    "Congo, Rep",
    "Isole Cook",
    "Costa Rica",
    "Costa d'Avorio",
    "Croazia",
    "Cuba",
    "Curaçao",
    "Cipro",
    "Rep Ceca",
    "Danimarca",
    "Gibuti",
    "Dominica",
    "Rep Dominicana",
    "Timor Est",
    "Ecuador",
    "Egitto",
    "El Salvador",
    "Guinea Equatoriale",
    "Eritrea",
    "Estonia",
    "Etiopia",
    "Isole Falkland",
    "Isole Faroe",
    "Fiji",
    "Finlandia",
    "Francia",
    "Polinesia Francese",
    "Gabon",
    "Gambia",
    "Georgia",
    "Germania",
    "Ghana",
    "Gibilterra",
    "Grecia",
    "Grenada",
    "Guatemala",
    "Guernsey",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hong Kong",
    "Ungheria",
    "Islanda",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Irlanda",
    "Isola di Man",
    "Israele",
    "Italia",
    "Giamaica",
    "Giappone",
    "Jersey",
    "Giordania",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Corea del Nord",
    "Corea del Sud",
    "Kosovo",
    "Kuwait",
    "Kirghizistan",
    "Laos",
    "Lettonia",
    "Libano",
    "Lesotho",
    "Liberia",
    "Libia",
    "Liechtenstein",
    "Lituania",
    "Lussemburgo",
    "Macau",
    "Macedonia ",
    "Madagascar",
    "Malawi",
    "Malesia",
    "Maldives",
    "Mali",
    "Malta",
    "Isole Marshall",
    "Mauritania",
    "Mauritius",
    "Messico",
    "Micronesia",
    "Moldavia",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Montserrat",
    "Marocco",
    "Mozambico",
    "Nagorno-Karabakh ",
    "Namibia",
    "Nauru",
    "Nepal",
    "Olanda",
    "Nuova Caledonia",
    "Nuova Zelanda",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Cipro del Nord",
    "Norvegia",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestina",
    "Panama",
    "Papua Nuova Guinea",
    "Paraguay",
    "Peru",
    "Filippine",
    "Isole Pitcairn",
    "Polonia",
    "Portogallo",
    "Qatar",
    "Romania",
    "Russia",
    "Ruanda",
    "Saba",
    "Sahrawi ",
    "Sant'Elena",
    "Saint Kitts/Nevis",
    "Santa Lucia",
    "St Vincent/Grenadine",
    "Samoa",
    "San Marino",
    "São Tomé e Príncipe",
    "Arabia Saudita",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Sint Eustatius",
    "Sint Maarten",
    "Slovacchia",
    "Slovenia",
    "Isole Solomone",
    "Somalia",
    "Somaliland",
    "Sud Africa",
    "Georgia del Sud/Isole Sandwich Merid.",
    "Ossezia del Sud",
    "Sud Sudan",
    "Spagna",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Swaziland",
    "Svezia",
    "Svizzera",
    "Siria",
    "Taiwan",
    "Tagikistan",
    "Tanzania",
    "Tailandia",
    "Togo",
    "Tonga",
    "Transnistria",
    "Trinidad e Tobago",
    "Tristan da Cunha",
    "Tunisia",
    "Turchia",
    "Turkmenistan",
    "Isole Turks e Caicos",
    "Tuvalu",
    "Uganda",
    "Ucraina",
    "Emirati Arabi Uniti",
    "Regno Unito",
    "Stati Uniti d'America",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Venezuela",
    "Città del Vaticano",
    "Vietnam",
    "Wallis e Futuna",
    "Yemen",
    "Zambia",
    "Zimbabwe",
    "Tutti i paesi"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.459Z"),
  "created_at": ISODate("2016-11-11T12:41:46.459Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4572"),
  "lang": "en",
  "label": "Paese in cui il prodotto/servizio è disponibile",
  "attr_id": 35,
  "type": "drop_options",
  "options": [
    "Abkhazia",
    "Afghanistan",
    "Akrotiri/Dhekelia",
    "Albania",
    "Alderney",
    "Algeria",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antigua/Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Ascension Island",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas, The",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia",
    "Bonaire",
    "Bosnia/Herzegovina",
    "Botswana",
    "Brazil",
    "British Indian Ocn ",
    "British Virgin Is",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Burma",
    "Burundi",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Cape Verde",
    "Cayman ",
    "Central African Rep.",
    "Chad",
    "Chile",
    "China",
    "Cocos Islands",
    "Colombia",
    "Comoros",
    "Congo, Dem Rep",
    "Congo, Rep",
    "Cook Islands",
    "Costa Rica",
    "Côte d'Ivoire",
    "Croatia",
    "Cuba",
    "Curaçao",
    "Cyprus",
    "Czech Rep",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Rep",
    "East Timor",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Ethiopia",
    "Falkland Islands",
    "Faroe Islands",
    "Fiji",
    "Finland",
    "France",
    "French Polynesia",
    "Gabon",
    "Gambia, The",
    "Georgia",
    "Germany",
    "Ghana",
    "Gibraltar",
    "Greece",
    "Grenada",
    "Guatemala",
    "Guernsey",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hong Kong",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Ireland",
    "Isle of Man",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jersey",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea, North",
    "Korea, South",
    "Kosovo",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macau",
    "Macedonia ",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Mauritania",
    "Mauritius",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Montserrat",
    "Morocco",
    "Mozambique",
    "Nagorno-Karabakh ",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "New Caledonia",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Northern Cyprus",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestine",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Pitcairn Islands",
    "Poland",
    "Portugal",
    "Qatar",
    "Romania",
    "Russia",
    "Rwanda",
    "Saba",
    "Sahrawi ",
    "Saint Helena",
    "Saint Kitts/Nevis",
    "Saint Lucia",
    "St Vincent/Grenadine",
    "Samoa",
    "San Marino",
    "São Tomé and Príncipe",
    "Saudi Arabia",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Sint Eustatius",
    "Sint Maarten",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "Somaliland",
    "South Africa",
    "South Georgia/South Sandwich Is",
    "South Ossetia",
    "South Sudan",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Swaziland",
    "Sweden",
    "Switzerland",
    "Syria",
    "Taiwan",
    "Tajikistan",
    "Tanzania",
    "Thailand",
    "Togo",
    "Tonga",
    "Transnistria",
    "Trinidad and Tobago",
    "Tristan da Cunha",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Turks and Caicos Is",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "UAE",
    "United Kingdom",
    "United States",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Venezuela",
    "Vatican City",
    "Vietnam",
    "Wallis and Futuna",
    "Yemen",
    "Zambia",
    "Zimbabwe",
    "All Countries"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.460Z"),
  "created_at": ISODate("2016-11-11T12:41:46.460Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4573"),
  "lang": "it",
  "label": "Bandiera Paese per Barche/Auto/Moto",
  "attr_id": 38,
  "type": "drop_options",
  "options": [
    "Abcasia",
    "Afghanistan",
    "Akrotiri/Dhekelia",
    "Albania",
    "Alderney",
    "Algeria",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antigua/Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Isola di Ascensione",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Bielorussia",
    "Belgio",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia",
    "Bonaire",
    "Bosnia/Herzegovina",
    "Botswana",
    "Brasile",
    "Oceano Indiano Brit.",
    "Isole Vergini Brit.",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Birmania",
    "Burundi",
    "Cambogia",
    "Cameroon",
    "Canada",
    "Capo Verde",
    "Cayman ",
    "Rep. Centrafricana",
    "Ciad",
    "Cile",
    "Cina ",
    "Isole Cocos",
    "Colombia",
    "Comore",
    "Congo, Rep Dem",
    "Congo, Rep",
    "Isole Cook",
    "Costa Rica",
    "Costa d'Avorio",
    "Croazia",
    "Cuba",
    "Curaçao",
    "Cipro",
    "Rep Ceca",
    "Danimarca",
    "Gibuti",
    "Dominica",
    "Rep Dominicana",
    "Timor Est",
    "Ecuador",
    "Egitto",
    "El Salvador",
    "Guinea Equatoriale",
    "Eritrea",
    "Estonia",
    "Etiopia",
    "Isole Falkland",
    "Isole Faroe",
    "Fiji",
    "Finlandia",
    "Francia",
    "Polinesia Francese",
    "Gabon",
    "Gambia",
    "Georgia",
    "Germania",
    "Ghana",
    "Gibilterra",
    "Grecia",
    "Grenada",
    "Guatemala",
    "Guernsey",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hong Kong",
    "Ungheria",
    "Islanda",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Irlanda",
    "Isola di Man",
    "Israele",
    "Italia",
    "Giamaica",
    "Giappone",
    "Jersey",
    "Giordania",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Corea del Nord",
    "Corea del Sud",
    "Kosovo",
    "Kuwait",
    "Kirghizistan",
    "Laos",
    "Lettonia",
    "Libano",
    "Lesotho",
    "Liberia",
    "Libia",
    "Liechtenstein",
    "Lituania",
    "Lussemburgo",
    "Macau",
    "Macedonia ",
    "Madagascar",
    "Malawi",
    "Malesia",
    "Maldives",
    "Mali",
    "Malta",
    "Isole Marshall",
    "Mauritania",
    "Mauritius",
    "Messico",
    "Micronesia",
    "Moldavia",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Montserrat",
    "Marocco",
    "Mozambico",
    "Nagorno-Karabakh ",
    "Namibia",
    "Nauru",
    "Nepal",
    "Olanda",
    "Nuova Caledonia",
    "Nuova Zelanda",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Cipro del Nord",
    "Norvegia",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestina",
    "Panama",
    "Papua Nuova Guinea",
    "Paraguay",
    "Peru",
    "Filippine",
    "Isole Pitcairn",
    "Polonia",
    "Portogallo",
    "Qatar",
    "Romania",
    "Russia",
    "Ruanda",
    "Saba",
    "Sahrawi ",
    "Sant'Elena",
    "Saint Kitts/Nevis",
    "Santa Lucia",
    "St Vincent/Grenadine",
    "Samoa",
    "San Marino",
    "São Tomé e Príncipe",
    "Arabia Saudita",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Sint Eustatius",
    "Sint Maarten",
    "Slovacchia",
    "Slovenia",
    "Isole Solomone",
    "Somalia",
    "Somaliland",
    "Sud Africa",
    "Georgia del Sud/Isole Sandwich Merid.",
    "Ossezia del Sud",
    "Sud Sudan",
    "Spagna",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Swaziland",
    "Svezia",
    "Svizzera",
    "Siria",
    "Taiwan",
    "Tagikistan",
    "Tanzania",
    "Tailandia",
    "Togo",
    "Tonga",
    "Transnistria",
    "Trinidad e Tobago",
    "Tristan da Cunha",
    "Tunisia",
    "Turchia",
    "Turkmenistan",
    "Isole Turks e Caicos",
    "Tuvalu",
    "Uganda",
    "Ucraina",
    "Emirati Arabi Uniti",
    "Regno Unito",
    "Stati Uniti d'America",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Venezuela",
    "Città del Vaticano",
    "Vietnam",
    "Wallis e Futuna",
    "Yemen",
    "Zambia",
    "Zimbabwe"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.462Z"),
  "created_at": ISODate("2016-11-11T12:41:46.462Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4574"),
  "lang": "en",
  "label": "Bandiera Paese per Barche/Auto/Moto",
  "attr_id": 38,
  "type": "drop_options",
  "options": [
    "Abkhazia",
    "Afghanistan",
    "Akrotiri/Dhekelia",
    "Albania",
    "Alderney",
    "Algeria",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antigua/Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Ascension Island",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas, The",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia",
    "Bonaire",
    "Bosnia/Herzegovina",
    "Botswana",
    "Brazil",
    "British Indian Ocn ",
    "British Virgin Is",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Burma",
    "Burundi",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Cape Verde",
    "Cayman ",
    "Central African Rep.",
    "Chad",
    "Chile",
    "China",
    "Cocos Islands",
    "Colombia",
    "Comoros",
    "Congo, Dem Rep",
    "Congo, Rep",
    "Cook Islands",
    "Costa Rica",
    "Côte d'Ivoire",
    "Croatia",
    "Cuba",
    "Curaçao",
    "Cyprus",
    "Czech Rep",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Rep",
    "East Timor",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Ethiopia",
    "Falkland Islands",
    "Faroe Islands",
    "Fiji",
    "Finland",
    "France",
    "French Polynesia",
    "Gabon",
    "Gambia, The",
    "Georgia",
    "Germany",
    "Ghana",
    "Gibraltar",
    "Greece",
    "Grenada",
    "Guatemala",
    "Guernsey",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hong Kong",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Ireland",
    "Isle of Man",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jersey",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea, North",
    "Korea, South",
    "Kosovo",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macau",
    "Macedonia ",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Mauritania",
    "Mauritius",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Montserrat",
    "Morocco",
    "Mozambique",
    "Nagorno-Karabakh ",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "New Caledonia",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Northern Cyprus",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestine",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Pitcairn Islands",
    "Poland",
    "Portugal",
    "Qatar",
    "Romania",
    "Russia",
    "Rwanda",
    "Saba",
    "Sahrawi ",
    "Saint Helena",
    "Saint Kitts/Nevis",
    "Saint Lucia",
    "St Vincent/Grenadine",
    "Samoa",
    "San Marino",
    "São Tomé and Príncipe",
    "Saudi Arabia",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Sint Eustatius",
    "Sint Maarten",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "Somaliland",
    "South Africa",
    "South Georgia/South Sandwich Is",
    "South Ossetia",
    "South Sudan",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Swaziland",
    "Sweden",
    "Switzerland",
    "Syria",
    "Taiwan",
    "Tajikistan",
    "Tanzania",
    "Thailand",
    "Togo",
    "Tonga",
    "Transnistria",
    "Trinidad and Tobago",
    "Tristan da Cunha",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Turks and Caicos Is",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "UAE",
    "United Kingdom",
    "United States",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Venezuela",
    "Vatican City",
    "Vietnam",
    "Wallis and Futuna",
    "Yemen",
    "Zambia",
    "Zimbabwe"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.463Z"),
  "created_at": ISODate("2016-11-11T12:41:46.463Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4575"),
  "lang": "it",
  "label": "Paese di produzione",
  "attr_id": 39,
  "type": "drop_options",
  "options": [
    "Abcasia",
    "Afghanistan",
    "Akrotiri/Dhekelia",
    "Albania",
    "Alderney",
    "Algeria",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antigua/Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Isola di Ascensione",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Bielorussia",
    "Belgio",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia",
    "Bonaire",
    "Bosnia/Herzegovina",
    "Botswana",
    "Brasile",
    "Oceano Indiano Brit.",
    "Isole Vergini Brit.",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Birmania",
    "Burundi",
    "Cambogia",
    "Cameroon",
    "Canada",
    "Capo Verde",
    "Cayman ",
    "Rep. Centrafricana",
    "Ciad",
    "Cile",
    "Cina ",
    "Isole Cocos",
    "Colombia",
    "Comore",
    "Congo, Rep Dem",
    "Congo, Rep",
    "Isole Cook",
    "Costa Rica",
    "Costa d'Avorio",
    "Croazia",
    "Cuba",
    "Curaçao",
    "Cipro",
    "Rep Ceca",
    "Danimarca",
    "Gibuti",
    "Dominica",
    "Rep Dominicana",
    "Timor Est",
    "Ecuador",
    "Egitto",
    "El Salvador",
    "Guinea Equatoriale",
    "Eritrea",
    "Estonia",
    "Etiopia",
    "Isole Falkland",
    "Isole Faroe",
    "Fiji",
    "Finlandia",
    "Francia",
    "Polinesia Francese",
    "Gabon",
    "Gambia",
    "Georgia",
    "Germania",
    "Ghana",
    "Gibilterra",
    "Grecia",
    "Grenada",
    "Guatemala",
    "Guernsey",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hong Kong",
    "Ungheria",
    "Islanda",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Irlanda",
    "Isola di Man",
    "Israele",
    "Italia",
    "Giamaica",
    "Giappone",
    "Jersey",
    "Giordania",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Corea del Nord",
    "Corea del Sud",
    "Kosovo",
    "Kuwait",
    "Kirghizistan",
    "Laos",
    "Lettonia",
    "Libano",
    "Lesotho",
    "Liberia",
    "Libia",
    "Liechtenstein",
    "Lituania",
    "Lussemburgo",
    "Macau",
    "Macedonia ",
    "Madagascar",
    "Malawi",
    "Malesia",
    "Maldives",
    "Mali",
    "Malta",
    "Isole Marshall",
    "Mauritania",
    "Mauritius",
    "Messico",
    "Micronesia",
    "Moldavia",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Montserrat",
    "Marocco",
    "Mozambico",
    "Nagorno-Karabakh ",
    "Namibia",
    "Nauru",
    "Nepal",
    "Olanda",
    "Nuova Caledonia",
    "Nuova Zelanda",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Cipro del Nord",
    "Norvegia",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestina",
    "Panama",
    "Papua Nuova Guinea",
    "Paraguay",
    "Peru",
    "Filippine",
    "Isole Pitcairn",
    "Polonia",
    "Portogallo",
    "Qatar",
    "Romania",
    "Russia",
    "Ruanda",
    "Saba",
    "Sahrawi ",
    "Sant'Elena",
    "Saint Kitts/Nevis",
    "Santa Lucia",
    "St Vincent/Grenadine",
    "Samoa",
    "San Marino",
    "São Tomé e Príncipe",
    "Arabia Saudita",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Sint Eustatius",
    "Sint Maarten",
    "Slovacchia",
    "Slovenia",
    "Isole Solomone",
    "Somalia",
    "Somaliland",
    "Sud Africa",
    "Georgia del Sud/Isole Sandwich Merid.",
    "Ossezia del Sud",
    "Sud Sudan",
    "Spagna",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Swaziland",
    "Svezia",
    "Svizzera",
    "Siria",
    "Taiwan",
    "Tagikistan",
    "Tanzania",
    "Tailandia",
    "Togo",
    "Tonga",
    "Transnistria",
    "Trinidad e Tobago",
    "Tristan da Cunha",
    "Tunisia",
    "Turchia",
    "Turkmenistan",
    "Isole Turks e Caicos",
    "Tuvalu",
    "Uganda",
    "Ucraina",
    "Emirati Arabi Uniti",
    "Regno Unito",
    "Stati Uniti d'America",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Venezuela",
    "Città del Vaticano",
    "Vietnam",
    "Wallis e Futuna",
    "Yemen",
    "Zambia",
    "Zimbabwe"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.465Z"),
  "created_at": ISODate("2016-11-11T12:41:46.465Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4576"),
  "lang": "en",
  "label": "Paese di produzione",
  "attr_id": 39,
  "type": "drop_options",
  "options": [
    "Abkhazia",
    "Afghanistan",
    "Akrotiri/Dhekelia",
    "Albania",
    "Alderney",
    "Algeria",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antigua/Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Ascension Island",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas, The",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia",
    "Bonaire",
    "Bosnia/Herzegovina",
    "Botswana",
    "Brazil",
    "British Indian Ocn ",
    "British Virgin Is",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Burma",
    "Burundi",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Cape Verde",
    "Cayman ",
    "Central African Rep.",
    "Chad",
    "Chile",
    "China",
    "Cocos Islands",
    "Colombia",
    "Comoros",
    "Congo, Dem Rep",
    "Congo, Rep",
    "Cook Islands",
    "Costa Rica",
    "Côte d'Ivoire",
    "Croatia",
    "Cuba",
    "Curaçao",
    "Cyprus",
    "Czech Rep",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Rep",
    "East Timor",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Ethiopia",
    "Falkland Islands",
    "Faroe Islands",
    "Fiji",
    "Finland",
    "France",
    "French Polynesia",
    "Gabon",
    "Gambia, The",
    "Georgia",
    "Germany",
    "Ghana",
    "Gibraltar",
    "Greece",
    "Grenada",
    "Guatemala",
    "Guernsey",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hong Kong",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Ireland",
    "Isle of Man",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jersey",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea, North",
    "Korea, South",
    "Kosovo",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macau",
    "Macedonia ",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Mauritania",
    "Mauritius",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Montserrat",
    "Morocco",
    "Mozambique",
    "Nagorno-Karabakh ",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "New Caledonia",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Northern Cyprus",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestine",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Pitcairn Islands",
    "Poland",
    "Portugal",
    "Qatar",
    "Romania",
    "Russia",
    "Rwanda",
    "Saba",
    "Sahrawi ",
    "Saint Helena",
    "Saint Kitts/Nevis",
    "Saint Lucia",
    "St Vincent/Grenadine",
    "Samoa",
    "San Marino",
    "São Tomé and Príncipe",
    "Saudi Arabia",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Sint Eustatius",
    "Sint Maarten",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "Somaliland",
    "South Africa",
    "South Georgia/South Sandwich Is",
    "South Ossetia",
    "South Sudan",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Swaziland",
    "Sweden",
    "Switzerland",
    "Syria",
    "Taiwan",
    "Tajikistan",
    "Tanzania",
    "Thailand",
    "Togo",
    "Tonga",
    "Transnistria",
    "Trinidad and Tobago",
    "Tristan da Cunha",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Turks and Caicos Is",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "UAE",
    "United Kingdom",
    "United States",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Venezuela",
    "Vatican City",
    "Vietnam",
    "Wallis and Futuna",
    "Yemen",
    "Zambia",
    "Zimbabwe"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.466Z"),
  "created_at": ISODate("2016-11-11T12:41:46.466Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4577"),
  "lang": "it",
  "label": "Raggio di copertura per lo svolgimento del servizio (specif. se in Km o Mi)",
  "attr_id": 43,
  "type": "drop_options",
  "options": [
    "Locale (max 200 Km)",
    "Nazionale",
    "Internazionale",
    "Continentale",
    "Mondiale"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.468Z"),
  "created_at": ISODate("2016-11-11T12:41:46.468Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4578"),
  "lang": "en",
  "label": "Raggio di copertura per lo svolgimento del servizio (specif. se in Km o Mi)",
  "attr_id": 43,
  "type": "drop_options",
  "options": [
    "Local (max 200 Km)",
    "National",
    "International",
    "Continental",
    "Worldwide"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.469Z"),
  "created_at": ISODate("2016-11-11T12:41:46.469Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4579"),
  "lang": "it",
  "label": "Radiazioni (hard or less)",
  "attr_id": 63,
  "type": "drop_options",
  "options": [
    "Forte",
    "Morbida",
    "Ultra Morbida",
    "Nessuna"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.471Z"),
  "created_at": ISODate("2016-11-11T12:41:46.471Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b457a"),
  "lang": "en",
  "label": "Radiazioni (hard or less)",
  "attr_id": 63,
  "type": "drop_options",
  "options": [
    "Hard",
    "Soft",
    "Ultrasoft",
    "None"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.472Z"),
  "created_at": ISODate("2016-11-11T12:41:46.472Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b457b"),
  "lang": "it",
  "label": "Rohs compliant",
  "attr_id": 64,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.474Z"),
  "created_at": ISODate("2016-11-11T12:41:46.474Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b457c"),
  "lang": "en",
  "label": "Rohs compliant",
  "attr_id": 64,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.475Z"),
  "created_at": ISODate("2016-11-11T12:41:46.475Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b457d"),
  "lang": "it",
  "label": "OPTICAL (DVD COMBO)",
  "attr_id": 69,
  "type": "drop_options",
  "options": [
    "DVD",
    "CD-Rom",
    "COMBO",
    "DVDRW"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.478Z"),
  "created_at": ISODate("2016-11-11T12:41:46.478Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b457e"),
  "lang": "en",
  "label": "OPTICAL (DVD COMBO)",
  "attr_id": 69,
  "type": "drop_options",
  "options": [
    "DVD",
    "CD-Rom",
    "COMBO",
    "DVDRW"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.480Z"),
  "created_at": ISODate("2016-11-11T12:41:46.480Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b457f"),
  "lang": "it",
  "label": "COA",
  "attr_id": 70,
  "type": "drop_options",
  "options": [
    "XPP",
    "Win1999",
    "Vista",
    "Win 8",
    "Win7",
    "WinNT",
    "Linux",
    "Altro Sistema Operativo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.482Z"),
  "created_at": ISODate("2016-11-11T12:41:46.482Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4580"),
  "lang": "en",
  "label": "COA",
  "attr_id": 70,
  "type": "drop_options",
  "options": [
    "XPP",
    "Win2000",
    "Vista",
    "Win 8",
    "Win7",
    "WinNT",
    "Linux",
    "Other OS"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.497Z"),
  "created_at": ISODate("2016-11-11T12:41:46.497Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4581"),
  "lang": "it",
  "label": "Colore",
  "attr_id": 73,
  "type": "drop_options",
  "options": [
    "Arancione",
    "Beige",
    "Bianco",
    "Giallo",
    "Grigio",
    "Marrone",
    "Nero",
    "Rosa",
    "Rosso",
    "Trasparente",
    "Blu",
    "Petrolio",
    "Azzurro",
    "Oliva",
    "Lilla",
    "Oro",
    "Argento",
    "Multicolore",
    "Verde",
    "Viola"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.498Z"),
  "created_at": ISODate("2016-11-11T12:41:46.498Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4582"),
  "lang": "en",
  "label": "Colore",
  "attr_id": 73,
  "type": "drop_options",
  "options": [
    "Orange",
    "Beige",
    "White",
    "Yellow",
    "Grey",
    "Brown",
    "Black",
    "Pink",
    "Red",
    "Transparent",
    "Blue",
    "Blue-Green",
    "Azure",
    "Olive",
    "Lilac",
    "Gold",
    "Silver",
    "Multicolor",
    "Green",
    "Violet"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.500Z"),
  "created_at": ISODate("2016-11-11T12:41:46.500Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4583"),
  "lang": "it",
  "label": "Destinazione uso FASHION",
  "attr_id": 74,
  "type": "drop_options",
  "options": [
    "Formali",
    "Cerimonia",
    "Uso Quotidiano",
    "Casual",
    "Business",
    "Party",
    "Matrimonio",
    "Altri ",
    "Sport"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.501Z"),
  "created_at": ISODate("2016-11-11T12:41:46.501Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4584"),
  "lang": "en",
  "label": "Destinazione uso FASHION",
  "attr_id": 74,
  "type": "drop_options",
  "options": [
    "Formal",
    "Ceremony",
    "Daily use",
    "Casual",
    "Business",
    "Party",
    "Wedding",
    "Other",
    "Sport"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.503Z"),
  "created_at": ISODate("2016-11-11T12:41:46.503Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4585"),
  "lang": "it",
  "label": "Tipo di manifattura ",
  "attr_id": 75,
  "type": "drop_options",
  "options": [
    "Su misura",
    "Industriale",
    "A mano",
    "Jacquard"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.505Z"),
  "created_at": ISODate("2016-11-11T12:41:46.505Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4586"),
  "lang": "en",
  "label": "Tipo di manifattura ",
  "attr_id": 75,
  "type": "drop_options",
  "options": [
    "Tailor-made",
    "Industrial",
    "Handmade",
    "Jacquard"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.507Z"),
  "created_at": ISODate("2016-11-11T12:41:46.507Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4587"),
  "lang": "it",
  "label": "Marchio evidente abbigliamento e accessori",
  "attr_id": 76,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.509Z"),
  "created_at": ISODate("2016-11-11T12:41:46.509Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4588"),
  "lang": "en",
  "label": "Marchio evidente abbigliamento e accessori",
  "attr_id": 76,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.511Z"),
  "created_at": ISODate("2016-11-11T12:41:46.511Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4589"),
  "lang": "it",
  "label": "Pattern",
  "attr_id": 77,
  "type": "drop_options",
  "options": [
    "Animalier",
    "Astratto",
    "Aziendale",
    "Bandiere",
    "Camouflage",
    "Delave'",
    "Etniche",
    "Floreale",
    "Gessato",
    "Macchie",
    "Paisley",
    "Pied de poule",
    "Pizzo",
    "Pois",
    "Quadri",
    "Regimental",
    "Rete",
    "Ricamate",
    "Righe larghe",
    "Righe strette",
    "Scozzese/Tartan",
    "Stampate",
    "Strappati",
    "Tinta unita",
    "Altre Fantasie"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.513Z"),
  "created_at": ISODate("2016-11-11T12:41:46.513Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b458a"),
  "lang": "en",
  "label": "Pattern",
  "attr_id": 77,
  "type": "drop_options",
  "options": [
    "Animalier",
    "Patterned",
    "Corporate",
    "Country Flag",
    "Camouflage",
    "Washed Out",
    "Ethnic",
    "Flower",
    "Pinstripe",
    "Spot",
    "Paisley",
    "Pied de poule/Dogtooth",
    "Lace",
    "Polka Dot",
    "Squares & Checks",
    "Regimental",
    "Fishnet",
    "Embroidered",
    "Large Stripes",
    "Narrow Stripes",
    "Tartan",
    "Print",
    "Ripped",
    "Plain",
    "Other Pattern"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.514Z"),
  "created_at": ISODate("2016-11-11T12:41:46.514Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b458b"),
  "lang": "it",
  "label": "",
  "attr_id": 78,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.515Z"),
  "created_at": ISODate("2016-11-11T12:41:46.515Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b458c"),
  "lang": "en",
  "label": "",
  "attr_id": 78,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.517Z"),
  "created_at": ISODate("2016-11-11T12:41:46.517Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b458d"),
  "lang": "it",
  "label": "",
  "attr_id": 79,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.518Z"),
  "created_at": ISODate("2016-11-11T12:41:46.518Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b458e"),
  "lang": "en",
  "label": "",
  "attr_id": 79,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.519Z"),
  "created_at": ISODate("2016-11-11T12:41:46.519Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b458f"),
  "lang": "it",
  "label": "",
  "attr_id": 80,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.520Z"),
  "created_at": ISODate("2016-11-11T12:41:46.520Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4590"),
  "lang": "en",
  "label": "",
  "attr_id": 80,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.522Z"),
  "created_at": ISODate("2016-11-11T12:41:46.522Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4591"),
  "lang": "it",
  "label": "",
  "attr_id": 81,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.523Z"),
  "created_at": ISODate("2016-11-11T12:41:46.523Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4592"),
  "lang": "en",
  "label": "",
  "attr_id": 81,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.524Z"),
  "created_at": ISODate("2016-11-11T12:41:46.524Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4593"),
  "lang": "it",
  "label": "",
  "attr_id": 82,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.526Z"),
  "created_at": ISODate("2016-11-11T12:41:46.526Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4594"),
  "lang": "en",
  "label": "",
  "attr_id": 82,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.527Z"),
  "created_at": ISODate("2016-11-11T12:41:46.527Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4595"),
  "lang": "it",
  "label": "",
  "attr_id": 83,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.528Z"),
  "created_at": ISODate("2016-11-11T12:41:46.528Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4596"),
  "lang": "en",
  "label": "",
  "attr_id": 83,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.530Z"),
  "created_at": ISODate("2016-11-11T12:41:46.530Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4597"),
  "lang": "it",
  "label": "",
  "attr_id": 84,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.531Z"),
  "created_at": ISODate("2016-11-11T12:41:46.531Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4598"),
  "lang": "en",
  "label": "",
  "attr_id": 84,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.532Z"),
  "created_at": ISODate("2016-11-11T12:41:46.532Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4599"),
  "lang": "it",
  "label": "Pattern Maglieria",
  "attr_id": 85,
  "type": "drop_options",
  "options": [
    "Tinta unita",
    "Ricamate",
    "Lavorazione a treccia",
    "Lavorazione a righe",
    "Altre Fantasie"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.534Z"),
  "created_at": ISODate("2016-11-11T12:41:46.534Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b459a"),
  "lang": "en",
  "label": "Pattern Maglieria",
  "attr_id": 85,
  "type": "drop_options",
  "options": [
    "Plain",
    "Embridered",
    "Twisted",
    "Striped",
    "Other Pattern"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.536Z"),
  "created_at": ISODate("2016-11-11T12:41:46.536Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b459b"),
  "lang": "it",
  "label": "",
  "attr_id": 86,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.538Z"),
  "created_at": ISODate("2016-11-11T12:41:46.538Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b459c"),
  "lang": "en",
  "label": "",
  "attr_id": 86,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.540Z"),
  "created_at": ISODate("2016-11-11T12:41:46.540Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b459d"),
  "lang": "it",
  "label": "",
  "attr_id": 87,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.542Z"),
  "created_at": ISODate("2016-11-11T12:41:46.542Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b459e"),
  "lang": "en",
  "label": "",
  "attr_id": 87,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.544Z"),
  "created_at": ISODate("2016-11-11T12:41:46.544Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b459f"),
  "lang": "it",
  "label": "",
  "attr_id": 88,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.545Z"),
  "created_at": ISODate("2016-11-11T12:41:46.545Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45a0"),
  "lang": "en",
  "label": "",
  "attr_id": 88,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.547Z"),
  "created_at": ISODate("2016-11-11T12:41:46.547Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45a1"),
  "lang": "it",
  "label": "",
  "attr_id": 89,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.548Z"),
  "created_at": ISODate("2016-11-11T12:41:46.548Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45a2"),
  "lang": "en",
  "label": "",
  "attr_id": 89,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.549Z"),
  "created_at": ISODate("2016-11-11T12:41:46.549Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45a3"),
  "lang": "it",
  "label": "Materiale primario",
  "attr_id": 90,
  "type": "drop_options",
  "options": [
    "Alpaca",
    "Canapa",
    "Cashmere",
    "Chiffon",
    "Cordura",
    "Cotone",
    "Cuoio",
    "Demin",
    "Ecopelle",
    "Elasten",
    "Flanella",
    "Georgette",
    "Gore-tex e similari",
    "Jersey",
    "Lana",
    "Lattice",
    "Lino",
    "Lycra",
    "Merino",
    "Nylon",
    "Organza",
    "Pelle",
    "Pile",
    "Pique",
    "Pizzo",
    "Poliammide",
    "Poliestere",
    "Raso",
    "Sergé",
    "Seta",
    "Taffettà",
    "Tela",
    "Tulle",
    "Tweed",
    "Velluto",
    "Vigogna",
    "Viscosa",
    "Altre fibre naturali",
    "Altre fibre sintetiche",
    "Altri materiali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.551Z"),
  "created_at": ISODate("2016-11-11T12:41:46.551Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45a4"),
  "lang": "en",
  "label": "Materiale primario",
  "attr_id": 90,
  "type": "drop_options",
  "options": [
    "Alpaca",
    "Hemp",
    "Cashmere",
    "Chiffon",
    "Cordura",
    "Cotton",
    "Hide",
    "Demin",
    "Eco-Leather ",
    "Elasten",
    "Flannel",
    "Georgette",
    "Gore-tex & Similar Fibers",
    "Jersey",
    "Wool",
    "Latex",
    "Linen",
    "Lycra",
    "Merino",
    "Nylon",
    "Organza",
    "Leather",
    "Fleece",
    "Pique",
    "Lace",
    "Polyamide",
    "Polyester",
    "Satin",
    "Sergé",
    "Silk",
    "Taffetà",
    "Canvas",
    "Tulle",
    "Tweed",
    "Velvet",
    "Vicuna",
    "Viscose",
    "Other Natural Fibers",
    "Other Synthetic Fibers",
    "Other Material"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.553Z"),
  "created_at": ISODate("2016-11-11T12:41:46.553Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45a5"),
  "lang": "it",
  "label": "",
  "attr_id": 91,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.554Z"),
  "created_at": ISODate("2016-11-11T12:41:46.554Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45a6"),
  "lang": "en",
  "label": "",
  "attr_id": 91,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.556Z"),
  "created_at": ISODate("2016-11-11T12:41:46.556Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45a7"),
  "lang": "it",
  "label": "",
  "attr_id": 92,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.557Z"),
  "created_at": ISODate("2016-11-11T12:41:46.557Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45a8"),
  "lang": "en",
  "label": "",
  "attr_id": 92,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.558Z"),
  "created_at": ISODate("2016-11-11T12:41:46.558Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ab"),
  "lang": "it",
  "label": "",
  "attr_id": 94,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.562Z"),
  "created_at": ISODate("2016-11-11T12:41:46.562Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ac"),
  "lang": "en",
  "label": "",
  "attr_id": 94,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.564Z"),
  "created_at": ISODate("2016-11-11T12:41:46.564Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ad"),
  "lang": "it",
  "label": "Materiale primario Calze Nylon",
  "attr_id": 95,
  "type": "drop_options",
  "options": [
    "Nylon",
    "Elasten",
    "Lycra"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.565Z"),
  "created_at": ISODate("2016-11-11T12:41:46.565Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ae"),
  "lang": "en",
  "label": "Materiale primario Calze Nylon",
  "attr_id": 95,
  "type": "drop_options",
  "options": [
    "Nylon",
    "Elasten",
    "Lycra"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.566Z"),
  "created_at": ISODate("2016-11-11T12:41:46.566Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45af"),
  "lang": "it",
  "label": "Materiale primario Jeans",
  "attr_id": 96,
  "type": "drop_options",
  "options": [
    "Denim",
    "Velluto",
    "Pelle",
    "Tela",
    "Altri materiali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.568Z"),
  "created_at": ISODate("2016-11-11T12:41:46.568Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45b0"),
  "lang": "en",
  "label": "Materiale primario Jeans",
  "attr_id": 96,
  "type": "drop_options",
  "options": [
    "Denim",
    "Velvet",
    "Leather",
    "Canvas",
    "Other Materials"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.569Z"),
  "created_at": ISODate("2016-11-11T12:41:46.569Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45b1"),
  "lang": "it",
  "label": "",
  "attr_id": 97,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.572Z"),
  "created_at": ISODate("2016-11-11T12:41:46.572Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45b2"),
  "lang": "en",
  "label": "",
  "attr_id": 97,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.574Z"),
  "created_at": ISODate("2016-11-11T12:41:46.574Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45b3"),
  "lang": "it",
  "label": "",
  "attr_id": 98,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.575Z"),
  "created_at": ISODate("2016-11-11T12:41:46.575Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45b4"),
  "lang": "en",
  "label": "",
  "attr_id": 98,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.577Z"),
  "created_at": ISODate("2016-11-11T12:41:46.577Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45b5"),
  "lang": "it",
  "label": "",
  "attr_id": 99,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.578Z"),
  "created_at": ISODate("2016-11-11T12:41:46.578Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45b6"),
  "lang": "en",
  "label": "",
  "attr_id": 99,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.580Z"),
  "created_at": ISODate("2016-11-11T12:41:46.580Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45b7"),
  "lang": "it",
  "label": "Presenza fodera per tutti",
  "attr_id": 102,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.581Z"),
  "created_at": ISODate("2016-11-11T12:41:46.581Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45b8"),
  "lang": "en",
  "label": "Presenza fodera per tutti",
  "attr_id": 102,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.582Z"),
  "created_at": ISODate("2016-11-11T12:41:46.582Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45bb"),
  "lang": "it",
  "label": "Materiale Valigie",
  "attr_id": 104,
  "type": "drop_options",
  "options": [
    "Altre pelli",
    "Alluminio",
    "Cartone",
    "Cordura",
    "Cuoio",
    "Gore-tex e similari",
    "Materiale tecnico non specificato",
    "Nylon",
    "Pelle",
    "Policarbonato",
    "Poliestere",
    "Legno"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.587Z"),
  "created_at": ISODate("2016-11-11T12:41:46.587Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45bc"),
  "lang": "en",
  "label": "Materiale Valigie",
  "attr_id": 104,
  "type": "drop_options",
  "options": [
    "Other Leathers",
    "Aluminium",
    "Cardboard",
    "Cordura",
    "Hide",
    "Gore-tex & Similar Fibers",
    "Unspecified Technical Material",
    "Nylon",
    "Leather",
    "Polycarbonate",
    "Polyester",
    "Wood"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.588Z"),
  "created_at": ISODate("2016-11-11T12:41:46.588Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45bd"),
  "lang": "it",
  "label": "Materiale Rivestimento esterno valigie",
  "attr_id": 105,
  "type": "drop_options",
  "options": [
    "Poliammide",
    "Nylon",
    "Cordura",
    "Poliestere",
    "Altre fibre sintetiche"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.589Z"),
  "created_at": ISODate("2016-11-11T12:41:46.589Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45be"),
  "lang": "en",
  "label": "Materiale Rivestimento esterno valigie",
  "attr_id": 105,
  "type": "drop_options",
  "options": [
    "Polyamide",
    "Nylon",
    "Cordura",
    "Polyester",
    "Other Synthetic Fibers"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.591Z"),
  "created_at": ISODate("2016-11-11T12:41:46.591Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45bf"),
  "lang": "it",
  "label": "Tipo di ruote valigie",
  "attr_id": 106,
  "type": "drop_options",
  "options": [
    "Monodirezionali",
    "Omnidirezionali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.592Z"),
  "created_at": ISODate("2016-11-11T12:41:46.592Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45c0"),
  "lang": "en",
  "label": "Tipo di ruote valigie",
  "attr_id": 106,
  "type": "drop_options",
  "options": [
    "Monodirectional",
    "Omnidirectional"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.594Z"),
  "created_at": ISODate("2016-11-11T12:41:46.594Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45c1"),
  "lang": "it",
  "label": "Tipo Valigie",
  "attr_id": 108,
  "type": "drop_options",
  "options": [
    "Viaggio",
    "Sport"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.595Z"),
  "created_at": ISODate("2016-11-11T12:41:46.595Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45c2"),
  "lang": "en",
  "label": "Tipo Valigie",
  "attr_id": 108,
  "type": "drop_options",
  "options": [
    "Travel",
    "Sport"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.596Z"),
  "created_at": ISODate("2016-11-11T12:41:46.596Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45c3"),
  "lang": "it",
  "label": "",
  "attr_id": 112,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.599Z"),
  "created_at": ISODate("2016-11-11T12:41:46.599Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45c4"),
  "lang": "en",
  "label": "",
  "attr_id": 112,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.606Z"),
  "created_at": ISODate("2016-11-11T12:41:46.606Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45c5"),
  "lang": "it",
  "label": "Borse Tipo di dimensione",
  "attr_id": 115,
  "type": "drop_options",
  "options": [
    "Maxi",
    "Media",
    "Mini"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.608Z"),
  "created_at": ISODate("2016-11-11T12:41:46.608Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45c6"),
  "lang": "en",
  "label": "Borse Tipo di dimensione",
  "attr_id": 115,
  "type": "drop_options",
  "options": [
    "Maxi",
    "Medium",
    "Mini"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.610Z"),
  "created_at": ISODate("2016-11-11T12:41:46.610Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45c9"),
  "lang": "it",
  "label": "Materiale degli inserti nelle scarpe",
  "attr_id": 127,
  "type": "drop_options",
  "options": [
    "ZIP laterale",
    "Zip Centrale",
    "Zip Posteriore",
    "Inserti elastici",
    "Inserti in pelle/pellicica",
    "Inseti metallici",
    "Inserti in fibra tessile",
    "Inserti in ecopelle",
    "Altri inserti",
    "Inserti in plastica",
    "Inserti in alluminio"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.614Z"),
  "created_at": ISODate("2016-11-11T12:41:46.614Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ca"),
  "lang": "en",
  "label": "Materiale degli inserti nelle scarpe",
  "attr_id": 127,
  "type": "drop_options",
  "options": [
    "Side Zip",
    "Central Zip",
    "Rear Zip",
    "Elastic Inserts",
    "Leather/Fur Inserts",
    "Metal Inserts",
    "Textile Inserts",
    "Eco-Leather Inserts",
    "Other Inserts",
    "Plastic Inserts",
    "Aluminium Inserts"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.616Z"),
  "created_at": ISODate("2016-11-11T12:41:46.616Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45cb"),
  "lang": "it",
  "label": "Tipo di Allacciatura scarpe - Uomo/donna/bambini",
  "attr_id": 128,
  "type": "drop_options",
  "options": [
    "Stringata",
    "Senza stringhe",
    "Velcro",
    "Cinghie",
    "Zip"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.617Z"),
  "created_at": ISODate("2016-11-11T12:41:46.617Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45cc"),
  "lang": "en",
  "label": "Tipo di Allacciatura scarpe - Uomo/donna/bambini",
  "attr_id": 128,
  "type": "drop_options",
  "options": [
    "Laced",
    "Without Laces",
    "Velcro",
    "Strapped",
    "Zip"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.619Z"),
  "created_at": ISODate("2016-11-11T12:41:46.619Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45cd"),
  "lang": "it",
  "label": "Misura della pianta scarpe - Uomo/donna/bambini",
  "attr_id": 129,
  "type": "drop_options",
  "options": [
    "Stretta",
    "Normale",
    "Media",
    "Ampia",
    "Extra Ampia"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.621Z"),
  "created_at": ISODate("2016-11-11T12:41:46.621Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ce"),
  "lang": "en",
  "label": "Misura della pianta scarpe - Uomo/donna/bambini",
  "attr_id": 129,
  "type": "drop_options",
  "options": [
    "Narrow",
    "Normal",
    "Medium",
    "Wide",
    "Extra Wide"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.622Z"),
  "created_at": ISODate("2016-11-11T12:41:46.622Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45cf"),
  "lang": "it",
  "label": "Materiale testa",
  "attr_id": 132,
  "type": "drop_options",
  "options": [
    "Titanio",
    "Alluminio",
    "Acciaio",
    "Grafite",
    "Compositi",
    "Legno",
    "Altri Materiali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.624Z"),
  "created_at": ISODate("2016-11-11T12:41:46.624Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45d0"),
  "lang": "en",
  "label": "Materiale testa",
  "attr_id": 132,
  "type": "drop_options",
  "options": [
    "Titanium",
    "Aluminium",
    "Steel",
    "Graphite",
    "Composite",
    "Wood",
    "Other Materials"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.625Z"),
  "created_at": ISODate("2016-11-11T12:41:46.625Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45d1"),
  "lang": "it",
  "label": "",
  "attr_id": 133,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.628Z"),
  "created_at": ISODate("2016-11-11T12:41:46.628Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45d2"),
  "lang": "en",
  "label": "",
  "attr_id": 133,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.630Z"),
  "created_at": ISODate("2016-11-11T12:41:46.630Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45d3"),
  "lang": "it",
  "label": "Materiale calzature sportive",
  "attr_id": 134,
  "type": "drop_options",
  "options": [
    "Polietilene",
    "Glass Fiber",
    "Polifenilene solfato",
    "Kevlar",
    "PBO",
    "Pelle",
    "Poliestere",
    "Gore-tex e similari",
    "Poliammide",
    "Lycra",
    "Policarbonato",
    "Grafite",
    "Fibre tecniche",
    "Altre fibre"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.632Z"),
  "created_at": ISODate("2016-11-11T12:41:46.632Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45d4"),
  "lang": "en",
  "label": "Materiale calzature sportive",
  "attr_id": 134,
  "type": "drop_options",
  "options": [
    "Polyethylene",
    "Glass Fiber",
    "Polyphenylene sulfide",
    "Kevlar",
    "PBO (polybenzoxazole)",
    "Leather",
    "Polyester",
    "Gore-tex & Similar Fibers",
    "Polyamide",
    "Lycra",
    "Polycarbonate",
    "Graphite",
    "Techinical Fibers",
    "Other Fibers"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.634Z"),
  "created_at": ISODate("2016-11-11T12:41:46.634Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45d5"),
  "lang": "it",
  "label": "Unità di misura dell'altezza dei tacchi e dei plateau",
  "attr_id": 139,
  "type": "drop_options",
  "options": [
    "Cm",
    "Inch"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.636Z"),
  "created_at": ISODate("2016-11-11T12:41:46.636Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45d6"),
  "lang": "en",
  "label": "Unità di misura dell'altezza dei tacchi e dei plateau",
  "attr_id": 139,
  "type": "drop_options",
  "options": [
    "Cm",
    "Inch"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.638Z"),
  "created_at": ISODate("2016-11-11T12:41:46.638Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45d7"),
  "lang": "it",
  "label": "Tipo di tacco - Uomo",
  "attr_id": 140,
  "type": "drop_options",
  "options": [
    "Senza tacco",
    "Piatto",
    "Western",
    "Zeppa"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.639Z"),
  "created_at": ISODate("2016-11-11T12:41:46.639Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45d8"),
  "lang": "en",
  "label": "Tipo di tacco - Uomo",
  "attr_id": 140,
  "type": "drop_options",
  "options": [
    "No Heels",
    "Flat",
    "Western",
    "Wedge"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.640Z"),
  "created_at": ISODate("2016-11-11T12:41:46.640Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45d9"),
  "lang": "it",
  "label": "Tipo di tacco - Donna",
  "attr_id": 141,
  "type": "drop_options",
  "options": [
    "Spillo",
    "Sigaro",
    "Italiano",
    "Cubano",
    "Campana",
    "Cono",
    "Rocchetto",
    "Luigi XV",
    "Piatto",
    "Senza tacco",
    "Squadrato",
    "Western",
    "Zeppa in legno",
    "Zeppa in corda",
    "Zeppa in gomma ",
    "Zeppa in sughero"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.642Z"),
  "created_at": ISODate("2016-11-11T12:41:46.642Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45da"),
  "lang": "en",
  "label": "Tipo di tacco - Donna",
  "attr_id": 141,
  "type": "drop_options",
  "options": [
    "Stiletto",
    "Cigar-shaped",
    "Italian",
    "Cuban",
    "Bell-shaped",
    "Cone",
    "Spool",
    "Louis XV",
    "Flat",
    "No Heels",
    "Square",
    "Western",
    "Wood Wedge",
    "Rope Wedge",
    "Rubber Wedge",
    "Cork Wedge"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.643Z"),
  "created_at": ISODate("2016-11-11T12:41:46.643Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45db"),
  "lang": "it",
  "label": "Materiale del tacco",
  "attr_id": 142,
  "type": "drop_options",
  "options": [
    "Resina Plexiglass",
    "Legno",
    "Gomma",
    "Alluminio",
    "Cuoio",
    "Vetro",
    "Altri materiali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.645Z"),
  "created_at": ISODate("2016-11-11T12:41:46.645Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45dc"),
  "lang": "en",
  "label": "Materiale del tacco",
  "attr_id": 142,
  "type": "drop_options",
  "options": [
    "Plexiglass Resin",
    "Wood",
    "Rubber",
    "Aluminium",
    "Hide",
    "Glass",
    "Other Materials"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.646Z"),
  "created_at": ISODate("2016-11-11T12:41:46.646Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45dd"),
  "lang": "it",
  "label": "Materiale della suola",
  "attr_id": 143,
  "type": "drop_options",
  "options": [
    "Gomma",
    "Cuoio",
    "Sintetico",
    "Sughero",
    "Corda",
    "Legno",
    "Con spikes",
    "Spikeless",
    "Fibra tessile",
    "Altri materiali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.648Z"),
  "created_at": ISODate("2016-11-11T12:41:46.648Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45de"),
  "lang": "en",
  "label": "Materiale della suola",
  "attr_id": 143,
  "type": "drop_options",
  "options": [
    "Rubber",
    "Hide",
    "Synthetic",
    "Cork",
    "Rope",
    "Wood",
    "With Spikes",
    "Spikeless",
    "Textile Fiber",
    "Other Materials"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.649Z"),
  "created_at": ISODate("2016-11-11T12:41:46.649Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45df"),
  "lang": "it",
  "label": "Scarpe - Forma della punta",
  "attr_id": 144,
  "type": "drop_options",
  "options": [
    "A punta",
    "Open-toe",
    "Punta tonda",
    "Punta squadrata"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.651Z"),
  "created_at": ISODate("2016-11-11T12:41:46.651Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45e0"),
  "lang": "en",
  "label": "Scarpe - Forma della punta",
  "attr_id": 144,
  "type": "drop_options",
  "options": [
    "Pointed",
    "Open-toe",
    "Rounded",
    "Squared"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.652Z"),
  "created_at": ISODate("2016-11-11T12:41:46.652Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45e1"),
  "lang": "it",
  "label": "",
  "attr_id": 145,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.654Z"),
  "created_at": ISODate("2016-11-11T12:41:46.654Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45e2"),
  "lang": "en",
  "label": "",
  "attr_id": 145,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.655Z"),
  "created_at": ISODate("2016-11-11T12:41:46.655Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45e3"),
  "lang": "it",
  "label": "Cravatte - Forma della Cravatta",
  "attr_id": 146,
  "type": "drop_options",
  "options": [
    "Classica",
    "Slim",
    "Ultra Slim",
    "Piatta",
    "Bolo Tie"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.657Z"),
  "created_at": ISODate("2016-11-11T12:41:46.657Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45e4"),
  "lang": "en",
  "label": "Cravatte - Forma della Cravatta",
  "attr_id": 146,
  "type": "drop_options",
  "options": [
    "Classic",
    "Slim",
    "Ultra Slim",
    "Flat",
    "Bolo Tie"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.660Z"),
  "created_at": ISODate("2016-11-11T12:41:46.660Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45e5"),
  "lang": "it",
  "label": "Papillon",
  "attr_id": 147,
  "type": "drop_options",
  "options": [
    "Slacciato",
    "Annodato"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.661Z"),
  "created_at": ISODate("2016-11-11T12:41:46.661Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45e6"),
  "lang": "en",
  "label": "Papillon",
  "attr_id": 147,
  "type": "drop_options",
  "options": [
    "Untied",
    "Tied"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.664Z"),
  "created_at": ISODate("2016-11-11T12:41:46.664Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45e7"),
  "lang": "it",
  "label": "Cravatte - Tipo di confezionamento",
  "attr_id": 148,
  "type": "drop_options",
  "options": [
    "4 pieghe",
    "7 pieghe",
    "Stampate",
    "No pieghe"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.666Z"),
  "created_at": ISODate("2016-11-11T12:41:46.666Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45e8"),
  "lang": "en",
  "label": "Cravatte - Tipo di confezionamento",
  "attr_id": 148,
  "type": "drop_options",
  "options": [
    "4 Folds",
    "7 Folds",
    "Printed",
    "No Folds"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.668Z"),
  "created_at": ISODate("2016-11-11T12:41:46.668Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45e9"),
  "lang": "it",
  "label": "",
  "attr_id": 151,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.669Z"),
  "created_at": ISODate("2016-11-11T12:41:46.669Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ea"),
  "lang": "en",
  "label": "",
  "attr_id": 151,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.671Z"),
  "created_at": ISODate("2016-11-11T12:41:46.671Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45eb"),
  "lang": "it",
  "label": "",
  "attr_id": 152,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.672Z"),
  "created_at": ISODate("2016-11-11T12:41:46.672Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ec"),
  "lang": "en",
  "label": "",
  "attr_id": 152,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.674Z"),
  "created_at": ISODate("2016-11-11T12:41:46.674Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ef"),
  "lang": "it",
  "label": "Materiali degli inserti nelle cinture",
  "attr_id": 154,
  "type": "drop_options",
  "options": [
    "Alluminio",
    "Argento",
    "Oro",
    "Platino",
    "Pelle",
    "Pelli pregiate",
    "Ottone",
    "Altri metalli"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.678Z"),
  "created_at": ISODate("2016-11-11T12:41:46.678Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45f0"),
  "lang": "en",
  "label": "Materiali degli inserti nelle cinture",
  "attr_id": 154,
  "type": "drop_options",
  "options": [
    "Aluminium",
    "Silver",
    "Gold",
    "Platinum",
    "Leather",
    "Fine Leather",
    "Brass",
    "Other Metals"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.679Z"),
  "created_at": ISODate("2016-11-11T12:41:46.679Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45f1"),
  "lang": "it",
  "label": "Materiale dei Cappelli",
  "attr_id": 155,
  "type": "drop_options",
  "options": [
    "Lino",
    "Cashmere",
    "Lana",
    "Cotone",
    "Canapa",
    "Carta",
    "Merino",
    "Fibre Tecniche",
    "Pelle",
    "Feltro",
    "Rafia",
    "Poliestere",
    "Nylon Poliestere",
    "Altri materiali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.681Z"),
  "created_at": ISODate("2016-11-11T12:41:46.681Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45f2"),
  "lang": "en",
  "label": "Materiale dei Cappelli",
  "attr_id": 155,
  "type": "drop_options",
  "options": [
    "Linen",
    "Cashmere",
    "Wool",
    "Cotton",
    "Hemp",
    "Paper",
    "Merino",
    "Technical Fibers",
    "Leather",
    "Felt",
    "Raffia",
    "Polyester",
    "Nylon Polyester",
    "Other Meterials"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.682Z"),
  "created_at": ISODate("2016-11-11T12:41:46.682Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45f3"),
  "lang": "it",
  "label": "Materiale Borse e Zaini sportivi",
  "attr_id": 156,
  "type": "drop_options",
  "options": [
    "Poliestere",
    "Poliammide",
    "Viscosa",
    "Nylon Poliestere",
    "Cotone",
    "Acetato",
    "Nylon",
    "Pelle",
    "Fibre tecniche",
    "Ecopelle",
    "Altre fibre"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.684Z"),
  "created_at": ISODate("2016-11-11T12:41:46.684Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45f4"),
  "lang": "en",
  "label": "Materiale Borse e Zaini sportivi",
  "attr_id": 156,
  "type": "drop_options",
  "options": [
    "Polyester",
    "Polyamide",
    "Viscose",
    "Nylon Polyester",
    "Cotton",
    "Acetate",
    "Nylon",
    "Leather",
    "Technical Fibers",
    "Eco-leather",
    "Other Fibers"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.685Z"),
  "created_at": ISODate("2016-11-11T12:41:46.685Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45f5"),
  "lang": "it",
  "label": "Cappelli: Colore della cinta",
  "attr_id": 157,
  "type": "drop_options",
  "options": [
    "Arancione",
    "Beige",
    "Bianco",
    "Giallo",
    "Grigio",
    "Marrone",
    "Nero",
    "Rosa",
    "Rosso",
    "Trasparente",
    "Blu",
    "Petrolio",
    "Azzurro",
    "Oliva",
    "Lilla",
    "Oro",
    "Argento",
    "Multicolore",
    "Verde",
    "Viola"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.687Z"),
  "created_at": ISODate("2016-11-11T12:41:46.687Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45f6"),
  "lang": "en",
  "label": "Cappelli: Colore della cinta",
  "attr_id": 157,
  "type": "drop_options",
  "options": [
    "Orange",
    "Beige",
    "White",
    "Yellow",
    "Grey",
    "Brown",
    "Black",
    "Pink",
    "Red",
    "Transparent",
    "Blue",
    "Blue-Green",
    "Azure",
    "Olive",
    "Lilac",
    "Gold",
    "Silver",
    "Multicolor",
    "Green",
    "Violet"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.688Z"),
  "created_at": ISODate("2016-11-11T12:41:46.688Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45f7"),
  "lang": "it",
  "label": "Cappelli: Materiale della fascia interna",
  "attr_id": 158,
  "type": "drop_options",
  "options": [
    "Cotone",
    "Lino",
    "Altre Fibre",
    "Viscosa"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.690Z"),
  "created_at": ISODate("2016-11-11T12:41:46.690Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45f8"),
  "lang": "en",
  "label": "Cappelli: Materiale della fascia interna",
  "attr_id": 158,
  "type": "drop_options",
  "options": [
    "Cotton",
    "Linen",
    "Other Fibers",
    "Viscose"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.692Z"),
  "created_at": ISODate("2016-11-11T12:41:46.692Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45f9"),
  "lang": "it",
  "label": "Unità di misura - taglia del cappello",
  "attr_id": 160,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.694Z"),
  "created_at": ISODate("2016-11-11T12:41:46.694Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45fa"),
  "lang": "en",
  "label": "Unità di misura - taglia del cappello",
  "attr_id": 160,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.697Z"),
  "created_at": ISODate("2016-11-11T12:41:46.697Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45fd"),
  "lang": "it",
  "label": "Guanti: tipo di guanti",
  "attr_id": 162,
  "type": "drop_options",
  "options": [
    "Corti",
    "Lunghi",
    "Corti da sera",
    "Lunghi da sera",
    "3/4 da sera",
    "Moffole",
    "Senza dita"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.702Z"),
  "created_at": ISODate("2016-11-11T12:41:46.702Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45fe"),
  "lang": "en",
  "label": "Guanti: tipo di guanti",
  "attr_id": 162,
  "type": "drop_options",
  "options": [
    "Short",
    "Long",
    "Short Formal",
    "Long Formal",
    "3/4 Formal",
    "Muffs",
    "Fingerless"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.703Z"),
  "created_at": ISODate("2016-11-11T12:41:46.703Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b45ff"),
  "lang": "it",
  "label": "Anno della Collezione",
  "attr_id": 164,
  "type": "drop_options",
  "options": [
    2012,
    2013,
    2014,
    2015,
    2016,
    2017,
    2018,
    2019,
    2020
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.705Z"),
  "created_at": ISODate("2016-11-11T12:41:46.705Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4600"),
  "lang": "en",
  "label": "Anno della Collezione",
  "attr_id": 164,
  "type": "drop_options",
  "options": [
    2012,
    2013,
    2014,
    2015,
    2016,
    2017,
    2018,
    2019,
    2020
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.706Z"),
  "created_at": ISODate("2016-11-11T12:41:46.706Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4601"),
  "lang": "it",
  "label": "Status - Fashion",
  "attr_id": 166,
  "type": "drop_options",
  "options": [
    "Nuovo",
    "Replica Vintage (Nuovo)",
    "Pre-owned"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.714Z"),
  "created_at": ISODate("2016-11-11T12:41:46.714Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4602"),
  "lang": "en",
  "label": "Status - Fashion",
  "attr_id": 166,
  "type": "drop_options",
  "options": [
    "New",
    "Vintage Replica (NEW)",
    "Pre-owned"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.715Z"),
  "created_at": ISODate("2016-11-11T12:41:46.715Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4603"),
  "lang": "it",
  "label": "Alimentazione",
  "attr_id": 167,
  "type": "drop_options",
  "options": [
    "Gas",
    "Elettrico",
    "Legna",
    "Alcol",
    "Pellet",
    "Altro tipo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.717Z"),
  "created_at": ISODate("2016-11-11T12:41:46.717Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4604"),
  "lang": "en",
  "label": "Alimentazione",
  "attr_id": 167,
  "type": "drop_options",
  "options": [
    "Gas-fired",
    "Electric",
    "Wood",
    "Alcohol",
    "Pellet",
    "Other Source"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.718Z"),
  "created_at": ISODate("2016-11-11T12:41:46.718Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4605"),
  "lang": "it",
  "label": "Stagione",
  "attr_id": 170,
  "type": "drop_options",
  "options": [
    "Autunno/Inverno",
    "Primavera/Estate",
    "Tutte le stagioni"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.720Z"),
  "created_at": ISODate("2016-11-11T12:41:46.720Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4606"),
  "lang": "en",
  "label": "Stagione",
  "attr_id": 170,
  "type": "drop_options",
  "options": [
    "Autumn/Winter",
    "Spring/Summer",
    "Any Time"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.723Z"),
  "created_at": ISODate("2016-11-11T12:41:46.723Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4607"),
  "lang": "it",
  "label": "Taglia: Età dei BABY (in mesi)",
  "attr_id": 174,
  "type": "drop_options",
  "options": [
    "0-3",
    "3-6",
    "6-9",
    "9-12",
    "12-15",
    "15-18",
    "18-21",
    "21-24"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.725Z"),
  "created_at": ISODate("2016-11-11T12:41:46.725Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4608"),
  "lang": "en",
  "label": "Taglia: Età dei BABY (in mesi)",
  "attr_id": 174,
  "type": "drop_options",
  "options": [
    "0-3",
    "3-6",
    "6-9",
    "9-12",
    "12-15",
    "15-18",
    "18-21",
    "21-24"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.726Z"),
  "created_at": ISODate("2016-11-11T12:41:46.726Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4609"),
  "lang": "it",
  "label": "Taglia: Età dei KID (in anni)",
  "attr_id": 175,
  "type": "drop_options",
  "options": [
    3,
    4,
    5,
    6,
    7,
    8
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.728Z"),
  "created_at": ISODate("2016-11-11T12:41:46.728Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b460a"),
  "lang": "en",
  "label": "Taglia: Età dei KID (in anni)",
  "attr_id": 175,
  "type": "drop_options",
  "options": [
    3,
    4,
    5,
    6,
    7,
    8
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.730Z"),
  "created_at": ISODate("2016-11-11T12:41:46.730Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b460b"),
  "lang": "it",
  "label": "Taglia: Età dei JUNIOR (in anni)",
  "attr_id": 176,
  "type": "drop_options",
  "options": [
    9,
    10,
    11,
    12,
    13,
    14,
    15,
    16
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.731Z"),
  "created_at": ISODate("2016-11-11T12:41:46.731Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b460c"),
  "lang": "en",
  "label": "Taglia: Età dei JUNIOR (in anni)",
  "attr_id": 176,
  "type": "drop_options",
  "options": [
    9,
    10,
    11,
    12,
    13,
    14,
    15,
    16
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.732Z"),
  "created_at": ISODate("2016-11-11T12:41:46.732Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b460d"),
  "lang": "it",
  "label": "Tipo di vestibilità delle Camicie",
  "attr_id": 178,
  "type": "drop_options",
  "options": [
    "Sciancrate",
    "Cadenti",
    "Slim",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.734Z"),
  "created_at": ISODate("2016-11-11T12:41:46.734Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b460e"),
  "lang": "en",
  "label": "Tipo di vestibilità delle Camicie",
  "attr_id": 178,
  "type": "drop_options",
  "options": [
    "Slim-fit",
    "Drop",
    "Slim",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.735Z"),
  "created_at": ISODate("2016-11-11T12:41:46.735Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b460f"),
  "lang": "it",
  "label": "Caratteristiche del tessuto ",
  "attr_id": 179,
  "type": "drop_options",
  "options": [
    "Anti-Pilling",
    "Anti-Restringimento",
    "Asciutto Veloce",
    "Anti-Pieghe",
    "Traspirante",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.737Z"),
  "created_at": ISODate("2016-11-11T12:41:46.737Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4610"),
  "lang": "en",
  "label": "Caratteristiche del tessuto ",
  "attr_id": 179,
  "type": "drop_options",
  "options": [
    "Anti-Pilling",
    "Anti-Shrink",
    "Quick Dry",
    "Anti-Wrinkle",
    "Breathable",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.739Z"),
  "created_at": ISODate("2016-11-11T12:41:46.739Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4611"),
  "lang": "it",
  "label": "Tipo di confezionamento",
  "attr_id": 188,
  "type": "drop_options",
  "options": [
    "Surgelati",
    "Congelati",
    "Sottovuoto",
    "Freschi",
    "Confezione termica",
    "Altro confezionamento"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.741Z"),
  "created_at": ISODate("2016-11-11T12:41:46.741Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4612"),
  "lang": "en",
  "label": "Tipo di confezionamento",
  "attr_id": 188,
  "type": "drop_options",
  "options": [
    "Frozen",
    "Deep Frozen",
    "Vacuum-Sealed",
    "Fresh",
    "Thermal Packaging",
    "Other Packaging"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.743Z"),
  "created_at": ISODate("2016-11-11T12:41:46.743Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4613"),
  "lang": "it",
  "label": "Tipo di Farina per preparazioni dolci e salate",
  "attr_id": 189,
  "type": "drop_options",
  "options": [
    "Farro",
    "Frumento/Integrale",
    "Grano duro",
    "Grano tenero",
    "Kamut",
    "Mais",
    "Avena",
    "Castagne",
    "Riso",
    "Ceci",
    "Grano saraceno",
    "Orzo",
    "Segale",
    "Soia",
    "Miglio",
    "Teff",
    "Piselli",
    "Fagioli",
    "Fave",
    "Patate",
    "Manioca (tapioca)",
    "Manitoba",
    "Quinoa",
    "Zucca",
    "Noci e nocciole",
    "Cocco",
    "Mandorle",
    "Nessuna di queste"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.745Z"),
  "created_at": ISODate("2016-11-11T12:41:46.745Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4614"),
  "lang": "en",
  "label": "Tipo di Farina per preparazioni dolci e salate",
  "attr_id": 189,
  "type": "drop_options",
  "options": [
    "Spelt",
    "Wheat/Wholewheat",
    "Durum Wheat",
    "Soft Wheat",
    "Kamut",
    "Corn",
    "Oat",
    "Chestnuts",
    "Rice",
    "Chickpeas",
    "Buckwheat",
    "Barley",
    "Rye",
    "Soybeans",
    "Millet",
    "Teff",
    "Peas",
    "Beans",
    "Broad Beans",
    "Potatoes",
    "Cassava (tapioca)",
    "Manitoba",
    "Quinoa",
    "Pumpkin",
    "Walnuts and Hazelnuts",
    "Coconut",
    "Almond",
    "None of the Above"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.747Z"),
  "created_at": ISODate("2016-11-11T12:41:46.747Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4615"),
  "lang": "it",
  "label": "Alimentari: Prodotti Speciali",
  "attr_id": 190,
  "type": "drop_options",
  "options": [
    "Senza farina",
    "Senza uova",
    "Senza zucchero",
    "Senza lattosio",
    "Senza glutine",
    "Senza caffeina",
    "Senza caseina",
    "Senza mais",
    "Senza latte",
    "Senza OGM",
    "Senza sciroppo di mais ad alto fruttosio",
    "Basso contenuto di sale",
    "Basso contenuto di sodio",
    "Basso contenuto di zucchero",
    "Senza zuccheri o dolcificanti aggiunti",
    "Senza ingredienti artificiali",
    "Organico",
    "Senza arachidi",
    "Senza sale",
    "Senza soia",
    "Senza noci",
    "Vegano",
    "Vegetariano",
    "Senza grano",
    "Senza lievito",
    "Paleo",
    "Altri Prodotti speciali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.749Z"),
  "created_at": ISODate("2016-11-11T12:41:46.749Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4616"),
  "lang": "en",
  "label": "Alimentari: Prodotti Speciali",
  "attr_id": 190,
  "type": "drop_options",
  "options": [
    "Flour Free",
    "Egg Free",
    "Sugar Free",
    "Lactose Free",
    "Gluten Free ",
    "Caffeine Free",
    "Casein Free",
    "Corn Free",
    "Dairy Free",
    "GMO Free",
    "High Fructose Corn Syrup Free",
    "Low Salt",
    "Low Sodium",
    "Low Sugar",
    "No added Sugar or Sweeteners",
    "No Artificial Ingredients",
    "Organic",
    "Peanut Free",
    "Salt Free",
    "Soy Free",
    "Tree Nut Free",
    "Vegan",
    "Vegetarian",
    "Wheat Free",
    "Yeast Free",
    "Paleo",
    "Other Special Products"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.751Z"),
  "created_at": ISODate("2016-11-11T12:41:46.751Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4617"),
  "lang": "it",
  "label": "Tipo di sale",
  "attr_id": 191,
  "type": "drop_options",
  "options": [
    "Sale iodato",
    "Sale iposodico",
    "Sale asodico",
    "Sale non igroscopico",
    "Altro tipo di sale"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.753Z"),
  "created_at": ISODate("2016-11-11T12:41:46.753Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4618"),
  "lang": "en",
  "label": "Tipo di sale",
  "attr_id": 191,
  "type": "drop_options",
  "options": [
    "Iodized Salt",
    "Low-Sodium Salt",
    "Sodium Free Salt",
    "Non-Hygroscopic Salt",
    "Other Type of Salt"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.756Z"),
  "created_at": ISODate("2016-11-11T12:41:46.756Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4619"),
  "lang": "it",
  "label": "Formato Tè - Infusi - Tisane",
  "attr_id": 192,
  "type": "drop_options",
  "options": [
    "Bustine",
    "Foglie",
    "In blocco compresso",
    "Solubile",
    "Altro formato di tè"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.758Z"),
  "created_at": ISODate("2016-11-11T12:41:46.758Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b461a"),
  "lang": "en",
  "label": "Formato Tè - Infusi - Tisane",
  "attr_id": 192,
  "type": "drop_options",
  "options": [
    "Bags",
    "Leaves/Loose",
    "Compressed",
    "Instant powder",
    "Other Type of Tea"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.761Z"),
  "created_at": ISODate("2016-11-11T12:41:46.761Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b461b"),
  "lang": "it",
  "label": "Formaggio: Trattamento Termico del Latte",
  "attr_id": 193,
  "type": "drop_options",
  "options": [
    "Crudo",
    "Pastorizzato",
    "Termizzato"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.764Z"),
  "created_at": ISODate("2016-11-11T12:41:46.764Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b461c"),
  "lang": "en",
  "label": "Formaggio: Trattamento Termico del Latte",
  "attr_id": 193,
  "type": "drop_options",
  "options": [
    "Raw",
    "Pasturized",
    "Thermized"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.766Z"),
  "created_at": ISODate("2016-11-11T12:41:46.766Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b461d"),
  "lang": "it",
  "label": "Formaggio: Stagionatura",
  "attr_id": 194,
  "type": "drop_options",
  "options": [
    "Fresco (pochi giorni)",
    "Stagionatura breve (non superiore a 30 gg)",
    "Stagionatura media (non superiore a 6 mesi)",
    "Stagionatura lenta (oltre 6 mesi)",
    "Stravecchio (oltre 1 anno)",
    "Affumicato"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.767Z"),
  "created_at": ISODate("2016-11-11T12:41:46.767Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b461e"),
  "lang": "en",
  "label": "Formaggio: Stagionatura",
  "attr_id": 194,
  "type": "drop_options",
  "options": [
    "Fresh (few days)",
    "Short Aged (no more than 30 days)",
    "Medium Aged (no more than 6 months)",
    "Slow Aged (more than 6 months)",
    "Very Mature (more than 1 year)",
    "Smoked"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.769Z"),
  "created_at": ISODate("2016-11-11T12:41:46.769Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b461f"),
  "lang": "it",
  "label": "Formaggio: Tipo di pasta",
  "attr_id": 195,
  "type": "drop_options",
  "options": [
    "Formaggi a pasta molle",
    "Formaggi a pasta semimolle",
    "Formaggi a pasta semidura",
    "Formaggi a pasta dura",
    "Formaggi a pasta cruda",
    "Formaggi a pasta semicotta",
    "Formaggi a pasta cotta",
    "Formaggi a pasta erborinata",
    "Formaggi a pasta filata",
    "Formaggi a pasta pressata",
    "Formaggi a pasta fusa"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.771Z"),
  "created_at": ISODate("2016-11-11T12:41:46.771Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4620"),
  "lang": "en",
  "label": "Formaggio: Tipo di pasta",
  "attr_id": 195,
  "type": "drop_options",
  "options": [
    "Soft",
    "Semi-soft",
    "Semi-hard",
    "Hard",
    "Raw-milk",
    "Semi-Cooked Curd ",
    "Cooked Curd ",
    "Blue-veined",
    "Pasta Filata (spun paste)",
    "Pressed",
    "Processed"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.772Z"),
  "created_at": ISODate("2016-11-11T12:41:46.772Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4621"),
  "lang": "it",
  "label": "Tipo di Carne",
  "attr_id": 196,
  "type": "drop_options",
  "options": [
    "Avicola",
    "Bovina",
    "Caprina",
    "Equina",
    "Ovina",
    "Selvaggina",
    "Suina",
    "Cervidi",
    "Altro tipo di carne"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.774Z"),
  "created_at": ISODate("2016-11-11T12:41:46.774Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4622"),
  "lang": "en",
  "label": "Tipo di Carne",
  "attr_id": 196,
  "type": "drop_options",
  "options": [
    "Poultry",
    "Beef",
    "Goat",
    "Horse",
    "Sheep",
    "Game",
    "Pork",
    "Deer",
    "Other Meat Type"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.776Z"),
  "created_at": ISODate("2016-11-11T12:41:46.776Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4623"),
  "lang": "it",
  "label": "Pesce - Metodo di produzione",
  "attr_id": 197,
  "type": "drop_options",
  "options": [
    "Affumicato a caldo",
    "Affumicato a freddo",
    "Cotto a vapore",
    "Essiccato",
    "Marinato",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.778Z"),
  "created_at": ISODate("2016-11-11T12:41:46.778Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4624"),
  "lang": "en",
  "label": "Pesce - Metodo di produzione",
  "attr_id": 197,
  "type": "drop_options",
  "options": [
    "Hot Smoked",
    "Cold Smoked",
    "Steamed",
    "Dried",
    "Marinated",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.779Z"),
  "created_at": ISODate("2016-11-11T12:41:46.779Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4625"),
  "lang": "it",
  "label": "Spice Size (Packaging/Presentation)",
  "attr_id": 198,
  "type": "drop_options",
  "options": [
    "Intero",
    "Polvere",
    "Foglie",
    "Semi"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.780Z"),
  "created_at": ISODate("2016-11-11T12:41:46.780Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4626"),
  "lang": "en",
  "label": "Spice Size (Packaging/Presentation)",
  "attr_id": 198,
  "type": "drop_options",
  "options": [
    "Whole",
    "Powder",
    "Leaves",
    "Seeds"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.782Z"),
  "created_at": ISODate("2016-11-11T12:41:46.782Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4627"),
  "lang": "it",
  "label": "Wine & Spirit Aging",
  "attr_id": 202,
  "type": "drop_options",
  "options": [
    "da 1 a 6 anni",
    "D'annata"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.784Z"),
  "created_at": ISODate("2016-11-11T12:41:46.784Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4628"),
  "lang": "en",
  "label": "Wine & Spirit Aging",
  "attr_id": 202,
  "type": "drop_options",
  "options": [
    "1 to 6 Years",
    "Aged Wine"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.785Z"),
  "created_at": ISODate("2016-11-11T12:41:46.785Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4629"),
  "lang": "it",
  "label": "Ritual Cooking",
  "attr_id": 203,
  "type": "drop_options",
  "options": [
    "Occidentale",
    "Islamico",
    "Ebraico",
    "Altre processi rituali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.787Z"),
  "created_at": ISODate("2016-11-11T12:41:46.787Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b462a"),
  "lang": "en",
  "label": "Ritual Cooking",
  "attr_id": 203,
  "type": "drop_options",
  "options": [
    "Western Ritual Cooking",
    "Islamic Ritual Cooking",
    "Jewish Ritual Cooking",
    "Other Ritual Cooking"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.788Z"),
  "created_at": ISODate("2016-11-11T12:41:46.788Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b462b"),
  "lang": "it",
  "label": "",
  "attr_id": 208,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.790Z"),
  "created_at": ISODate("2016-11-11T12:41:46.790Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b462c"),
  "lang": "en",
  "label": "",
  "attr_id": 208,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.791Z"),
  "created_at": ISODate("2016-11-11T12:41:46.791Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b462d"),
  "lang": "it",
  "label": "Installation Method",
  "attr_id": 210,
  "type": "drop_options",
  "options": [
    "Muro alto",
    "Cassetta nel soffitto",
    "Sotto soffitto",
    "Multi Split"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.792Z"),
  "created_at": ISODate("2016-11-11T12:41:46.792Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b462e"),
  "lang": "en",
  "label": "Installation Method",
  "attr_id": 210,
  "type": "drop_options",
  "options": [
    "High Wall",
    "In Ceiling Cassette",
    "Under Ceiling",
    "Multi Splits"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.793Z"),
  "created_at": ISODate("2016-11-11T12:41:46.793Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b462f"),
  "lang": "it",
  "label": "Sport Equipment/HVAC Status",
  "attr_id": 213,
  "type": "drop_options",
  "options": [
    "Nuovo",
    "Ricondizionato",
    "Usato"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.794Z"),
  "created_at": ISODate("2016-11-11T12:41:46.794Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4630"),
  "lang": "en",
  "label": "Sport Equipment/HVAC Status",
  "attr_id": 213,
  "type": "drop_options",
  "options": [
    "New",
    "Refurbished",
    "Used"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.795Z"),
  "created_at": ISODate("2016-11-11T12:41:46.795Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4631"),
  "lang": "it",
  "label": "Soundproofing",
  "attr_id": 236,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.796Z"),
  "created_at": ISODate("2016-11-11T12:41:46.796Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4632"),
  "lang": "en",
  "label": "Soundproofing",
  "attr_id": 236,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.797Z"),
  "created_at": ISODate("2016-11-11T12:41:46.797Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4633"),
  "lang": "it",
  "label": "Fashion Accessory User",
  "attr_id": 257,
  "type": "drop_options",
  "options": [
    "Uomo",
    "Donna",
    "Bambino BABY",
    "Bambina BABY",
    "Bambino KID",
    "Bambina KID",
    "Bambino JUNIOR",
    "Bambina JUNIOR",
    "Unisex"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.798Z"),
  "created_at": ISODate("2016-11-11T12:41:46.798Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4634"),
  "lang": "en",
  "label": "Fashion Accessory User",
  "attr_id": 257,
  "type": "drop_options",
  "options": [
    "Man",
    "Woman",
    "Babt Boy",
    "Baby Girl",
    "Kid Boy",
    "Kid Girl",
    "Junior Boy",
    "Junior Girl",
    "Unisex"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.798Z"),
  "created_at": ISODate("2016-11-11T12:41:46.798Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4635"),
  "lang": "it",
  "label": "Sleeves Type",
  "attr_id": 258,
  "type": "drop_options",
  "options": [
    "Lunghe ",
    "Corte",
    "3/4",
    "Senza maniche"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.799Z"),
  "created_at": ISODate("2016-11-11T12:41:46.799Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4636"),
  "lang": "en",
  "label": "Sleeves Type",
  "attr_id": 258,
  "type": "drop_options",
  "options": [
    "Long",
    "Short",
    "3/4",
    "No Sleeves"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.800Z"),
  "created_at": ISODate("2016-11-11T12:41:46.800Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4637"),
  "lang": "it",
  "label": "Pants Waist Type",
  "attr_id": 259,
  "type": "drop_options",
  "options": [
    "Alta",
    "Media",
    "Bassa"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.801Z"),
  "created_at": ISODate("2016-11-11T12:41:46.801Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4638"),
  "lang": "en",
  "label": "Pants Waist Type",
  "attr_id": 259,
  "type": "drop_options",
  "options": [
    "High",
    "Medium",
    "Low"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.802Z"),
  "created_at": ISODate("2016-11-11T12:41:46.802Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4639"),
  "lang": "it",
  "label": "Pants Leg Type",
  "attr_id": 260,
  "type": "drop_options",
  "options": [
    "Classica",
    "Baggy",
    "Boot Cut",
    "Gamba a tubo",
    "Svasata",
    "Harem",
    "Skinny"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.803Z"),
  "created_at": ISODate("2016-11-11T12:41:46.803Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b463a"),
  "lang": "en",
  "label": "Pants Leg Type",
  "attr_id": 260,
  "type": "drop_options",
  "options": [
    "Classic",
    "Baggy",
    "Boot Cut",
    "Tube-shaped",
    "Flared",
    "Harem",
    "Skinny"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.804Z"),
  "created_at": ISODate("2016-11-11T12:41:46.804Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b463b"),
  "lang": "it",
  "label": "Washing Instructions",
  "attr_id": 261,
  "type": "drop_options",
  "options": [
    "Colorato",
    "Lavaggio scuro",
    "Lavaggio chiaro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.806Z"),
  "created_at": ISODate("2016-11-11T12:41:46.806Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b463c"),
  "lang": "en",
  "label": "Washing Instructions",
  "attr_id": 261,
  "type": "drop_options",
  "options": [
    "Color Wash",
    "Dark Wash  ",
    "Light Wash"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.807Z"),
  "created_at": ISODate("2016-11-11T12:41:46.807Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b463d"),
  "lang": "it",
  "label": "Neck Type for Men Shirts",
  "attr_id": 262,
  "type": "drop_options",
  "options": [
    "Collo alto a doppio contrasto",
    "Collo alto a contrasto",
    "classico 1 bottone",
    "Classico 2 bottoni",
    "Francesi 1 bottone",
    "Francese 2 bottoni",
    "Button down 1 bottone",
    "Button down 2 bottoni",
    "Button down nascosto",
    "Coreano alto 1 bottone",
    "Coreano basso 1 bottone",
    "Cerimonia 1 bottone",
    "Piccolo classico 1 bottone",
    "Senza collo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.808Z"),
  "created_at": ISODate("2016-11-11T12:41:46.808Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b463e"),
  "lang": "en",
  "label": "Neck Type for Men Shirts",
  "attr_id": 262,
  "type": "drop_options",
  "options": [
    "Double Contrast High Collar",
    "Contrast High Collar",
    "Classic 1 Button",
    "Classic 2 Buttons",
    "French 1 Button",
    "French 2 Buttons",
    "Button Down 1 Button",
    "Button Down 2 Buttons",
    "Hidden Button Down",
    "Korean High 1 Button",
    "Korean Low 1 Button",
    "Formal 1 Button",
    "Classic Small 1 Button",
    "No Neck"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.809Z"),
  "created_at": ISODate("2016-11-11T12:41:46.809Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b463f"),
  "lang": "it",
  "label": "Shirts Cuff Type",
  "attr_id": 263,
  "type": "drop_options",
  "options": [
    "Smussato 1 Bottone",
    "Smussato 2 Bottoni",
    "Stondato 1 Bottone",
    "Doppio per gemelli",
    "Singolo per gemelli",
    "Manica Corta",
    "Polsi di ricambio"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.810Z"),
  "created_at": ISODate("2016-11-11T12:41:46.810Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4640"),
  "lang": "en",
  "label": "Shirts Cuff Type",
  "attr_id": 263,
  "type": "drop_options",
  "options": [
    "Bevelled 1 Button",
    "Bevelled 2 Buttons",
    "Rounded 1 Button",
    "Double for Cufflinks",
    "Single for Cufflinks",
    "Short Sleeves",
    "Spare Cuffs"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.811Z"),
  "created_at": ISODate("2016-11-11T12:41:46.811Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4641"),
  "lang": "it",
  "label": "Hood",
  "attr_id": 264,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.813Z"),
  "created_at": ISODate("2016-11-11T12:41:46.813Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4642"),
  "lang": "en",
  "label": "Hood",
  "attr_id": 264,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.815Z"),
  "created_at": ISODate("2016-11-11T12:41:46.815Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4643"),
  "lang": "it",
  "label": "Zip",
  "attr_id": 265,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.822Z"),
  "created_at": ISODate("2016-11-11T12:41:46.822Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4644"),
  "lang": "en",
  "label": "Zip",
  "attr_id": 265,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.823Z"),
  "created_at": ISODate("2016-11-11T12:41:46.823Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4645"),
  "lang": "it",
  "label": "",
  "attr_id": 266,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.824Z"),
  "created_at": ISODate("2016-11-11T12:41:46.824Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4646"),
  "lang": "en",
  "label": "",
  "attr_id": 266,
  "type": "drop_options",
  "options": [
    
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.825Z"),
  "created_at": ISODate("2016-11-11T12:41:46.825Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4647"),
  "lang": "it",
  "label": "Hand",
  "attr_id": 268,
  "type": "drop_options",
  "options": [
    "Sinistra",
    "Destra"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.826Z"),
  "created_at": ISODate("2016-11-11T12:41:46.826Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4648"),
  "lang": "en",
  "label": "Hand",
  "attr_id": 268,
  "type": "drop_options",
  "options": [
    "Left",
    "Right"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.827Z"),
  "created_at": ISODate("2016-11-11T12:41:46.827Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4649"),
  "lang": "it",
  "label": "Shaft Flex",
  "attr_id": 269,
  "type": "drop_options",
  "options": [
    "Giovani - J",
    "Anziani - A",
    "Donne - L",
    "Regolare- R",
    "Rigido - S",
    "Extra Rigido - X",
    "Mid/Intermediate",
    "XX Stiff"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.828Z"),
  "created_at": ISODate("2016-11-11T12:41:46.828Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b464a"),
  "lang": "en",
  "label": "Shaft Flex",
  "attr_id": 269,
  "type": "drop_options",
  "options": [
    "Junior - J",
    "Senior - A",
    "Ladies - L",
    "Regular - R",
    "Stiff - S",
    "Extra Stiff - X",
    "Mid/Intermediate",
    "XX Stiff"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.829Z"),
  "created_at": ISODate("2016-11-11T12:41:46.829Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b464b"),
  "lang": "it",
  "label": "SPORT: Equipment Material Composition",
  "attr_id": 272,
  "type": "drop_options",
  "options": [
    "Legno",
    "Cuoio",
    "Alluminio",
    "Compound",
    "Acciaio",
    "Titanio",
    "Ferro",
    "Gomma",
    "Altri Materiali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.830Z"),
  "created_at": ISODate("2016-11-11T12:41:46.830Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b464c"),
  "lang": "en",
  "label": "SPORT: Equipment Material Composition",
  "attr_id": 272,
  "type": "drop_options",
  "options": [
    "Wood",
    "Hide",
    "Alluminium",
    "Compound",
    "Steel",
    "Titanium",
    "Iron",
    "Rubber",
    "Other Materials"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.831Z"),
  "created_at": ISODate("2016-11-11T12:41:46.831Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b464d"),
  "lang": "it",
  "label": "SPORT: Clothing Material Composition",
  "attr_id": 273,
  "type": "drop_options",
  "options": [
    "Cotone",
    "Poliestere",
    "Lana",
    "Lino",
    "Viscosa",
    "Merino",
    "Cashmere",
    "Seta",
    "Raso",
    "Chiffon",
    "Taffettà",
    "Georgette",
    "Jersey",
    "Velluto",
    "Tulle",
    "Pelle",
    "Organza",
    "Vigogna",
    "Ecopelle",
    "Gore-tex e similari",
    "Nylon",
    "Altre naturali",
    "Altri sintetici",
    "Alpaca",
    "Canapa",
    "Tela",
    "Lycra",
    "Elastam",
    "Kevlar"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.832Z"),
  "created_at": ISODate("2016-11-11T12:41:46.832Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b464e"),
  "lang": "en",
  "label": "SPORT: Clothing Material Composition",
  "attr_id": 273,
  "type": "drop_options",
  "options": [
    "Cotton",
    "Polyester",
    "Wool",
    "Linen",
    "Viscose",
    "Merino",
    "Cashmere",
    "Silk",
    "Satin",
    "Chiffon",
    "Taffetà",
    "Georgette",
    "Jersey",
    "Velvet",
    "Tulle",
    "Leather",
    "Organza",
    "Vicuna",
    "Eco-Leather ",
    "Gore-tex & Similar Fibers",
    "Nylon",
    "Other Natural Fibers",
    "Other Synthetic Fibers",
    "Alpaca",
    "Hemp",
    "Canvas",
    "Lycra",
    "Spandex",
    "Kevlar"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.833Z"),
  "created_at": ISODate("2016-11-11T12:41:46.833Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b464f"),
  "lang": "it",
  "label": "Power - measurement unit",
  "attr_id": 275,
  "type": "drop_options",
  "options": [
    "Kw",
    "HP",
    "CV",
    "W",
    "Btu/h",
    "Cal",
    "V",
    "Hz",
    "A"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.834Z"),
  "created_at": ISODate("2016-11-11T12:41:46.834Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4650"),
  "lang": "en",
  "label": "Power - measurement unit",
  "attr_id": 275,
  "type": "drop_options",
  "options": [
    "Kw",
    "HP",
    "CV",
    "W",
    "Btu/h",
    "Cal",
    "V",
    "Hz",
    "A"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.836Z"),
  "created_at": ISODate("2016-11-11T12:41:46.836Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4651"),
  "lang": "it",
  "label": "Car Category",
  "attr_id": 281,
  "type": "drop_options",
  "options": [
    "Cabrio/Sportive",
    "Familiari",
    "Auto Grandi/di Lusso",
    "Berlina",
    "SUV"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.837Z"),
  "created_at": ISODate("2016-11-11T12:41:46.837Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4652"),
  "lang": "en",
  "label": "Car Category",
  "attr_id": 281,
  "type": "drop_options",
  "options": [
    "Cabrio/Sport Cars",
    "Family cars",
    "Large/Luxury Cars",
    "Sedan",
    "SUV"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.838Z"),
  "created_at": ISODate("2016-11-11T12:41:46.838Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4653"),
  "lang": "it",
  "label": "Engine Position",
  "attr_id": 282,
  "type": "drop_options",
  "options": [
    "Anteriore",
    "Posteriore"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.840Z"),
  "created_at": ISODate("2016-11-11T12:41:46.840Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4654"),
  "lang": "en",
  "label": "Engine Position",
  "attr_id": 282,
  "type": "drop_options",
  "options": [
    "Front",
    "Rear"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.841Z"),
  "created_at": ISODate("2016-11-11T12:41:46.841Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4655"),
  "lang": "it",
  "label": "Car/Moto Drive",
  "attr_id": 286,
  "type": "drop_options",
  "options": [
    "Anteriore",
    "Posteriore",
    "Integrale 4x4"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.843Z"),
  "created_at": ISODate("2016-11-11T12:41:46.843Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4656"),
  "lang": "en",
  "label": "Car/Moto Drive",
  "attr_id": 286,
  "type": "drop_options",
  "options": [
    "Rear-Wheel Drive",
    "Front-Wheel Drive",
    "Four-Wheel Drive"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.845Z"),
  "created_at": ISODate("2016-11-11T12:41:46.845Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4657"),
  "lang": "it",
  "label": "Car Chassis",
  "attr_id": 289,
  "type": "drop_options",
  "options": [
    "Coupe",
    "Station Wagon",
    "Berlina",
    "Sportswagon"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.846Z"),
  "created_at": ISODate("2016-11-11T12:41:46.846Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4658"),
  "lang": "en",
  "label": "Car Chassis",
  "attr_id": 289,
  "type": "drop_options",
  "options": [
    "Coupe",
    "Hatchback",
    "Sedan/Saloon",
    "Sportswagon"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.848Z"),
  "created_at": ISODate("2016-11-11T12:41:46.848Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4659"),
  "lang": "it",
  "label": "CO2 Emissions",
  "attr_id": 290,
  "type": "drop_options",
  "options": [
    "Non classificabile",
    "Euro1",
    "Euro2",
    "Euro3",
    "Euro4",
    "Euro5",
    "Euro6"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.850Z"),
  "created_at": ISODate("2016-11-11T12:41:46.850Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b465a"),
  "lang": "en",
  "label": "CO2 Emissions",
  "attr_id": 290,
  "type": "drop_options",
  "options": [
    "Unclassifiable ",
    "Euro1",
    "Euro2",
    "Euro3",
    "Euro4",
    "Euro5",
    "Euro6"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.851Z"),
  "created_at": ISODate("2016-11-11T12:41:46.851Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b465b"),
  "lang": "it",
  "label": "Front Brakes Type",
  "attr_id": 291,
  "type": "drop_options",
  "options": [
    "Disco",
    "Tamburo",
    "Nastro",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.852Z"),
  "created_at": ISODate("2016-11-11T12:41:46.852Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b465c"),
  "lang": "en",
  "label": "Front Brakes Type",
  "attr_id": 291,
  "type": "drop_options",
  "options": [
    "Disc Brakes",
    "Drum Brakes",
    "Strap Brakes",
    "Other Brakes"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.853Z"),
  "created_at": ISODate("2016-11-11T12:41:46.853Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b465d"),
  "lang": "it",
  "label": "Rear Brakes Type",
  "attr_id": 292,
  "type": "drop_options",
  "options": [
    "Disco",
    "Tamburo",
    "Nastro",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.854Z"),
  "created_at": ISODate("2016-11-11T12:41:46.854Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b465e"),
  "lang": "en",
  "label": "Rear Brakes Type",
  "attr_id": 292,
  "type": "drop_options",
  "options": [
    "Disc Brakes",
    "Drum Brakes",
    "Strap Brakes",
    "Other Brakes"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.855Z"),
  "created_at": ISODate("2016-11-11T12:41:46.855Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b465f"),
  "lang": "it",
  "label": "Fuel Delivery",
  "attr_id": 295,
  "type": "drop_options",
  "options": [
    "Iniezione",
    "Turbo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.856Z"),
  "created_at": ISODate("2016-11-11T12:41:46.856Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4660"),
  "lang": "en",
  "label": "Fuel Delivery",
  "attr_id": 295,
  "type": "drop_options",
  "options": [
    "Injection",
    "Turbo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.858Z"),
  "created_at": ISODate("2016-11-11T12:41:46.858Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4661"),
  "lang": "it",
  "label": "Mileage - measurement unit",
  "attr_id": 301,
  "type": "drop_options",
  "options": [
    "Km",
    "Miglia"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.859Z"),
  "created_at": ISODate("2016-11-11T12:41:46.859Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4662"),
  "lang": "en",
  "label": "Mileage - measurement unit",
  "attr_id": 301,
  "type": "drop_options",
  "options": [
    "Km",
    "Miles"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.860Z"),
  "created_at": ISODate("2016-11-11T12:41:46.860Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4663"),
  "lang": "it",
  "label": "Driving Hand",
  "attr_id": 303,
  "type": "drop_options",
  "options": [
    "Sinistra",
    "Destra"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.861Z"),
  "created_at": ISODate("2016-11-11T12:41:46.861Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4664"),
  "lang": "en",
  "label": "Driving Hand",
  "attr_id": 303,
  "type": "drop_options",
  "options": [
    "Left",
    "Right"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.862Z"),
  "created_at": ISODate("2016-11-11T12:41:46.862Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4665"),
  "lang": "it",
  "label": "Transmission Type",
  "attr_id": 304,
  "type": "drop_options",
  "options": [
    "Manuale",
    "Automatico"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.863Z"),
  "created_at": ISODate("2016-11-11T12:41:46.863Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4666"),
  "lang": "en",
  "label": "Transmission Type",
  "attr_id": 304,
  "type": "drop_options",
  "options": [
    "Manual ",
    "Automatic"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.864Z"),
  "created_at": ISODate("2016-11-11T12:41:46.864Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4667"),
  "lang": "it",
  "label": "Fuel",
  "attr_id": 305,
  "type": "drop_options",
  "options": [
    "Benzina",
    "Diesel",
    "Metano",
    "Alcol",
    "Ibrida",
    "Elettrica",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.865Z"),
  "created_at": ISODate("2016-11-11T12:41:46.865Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4668"),
  "lang": "en",
  "label": "Fuel",
  "attr_id": 305,
  "type": "drop_options",
  "options": [
    "Gasoline",
    "Diesel",
    "Methane",
    "Alcohol",
    "Hybrid",
    "Electric",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.866Z"),
  "created_at": ISODate("2016-11-11T12:41:46.866Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4669"),
  "lang": "it",
  "label": "Engine Number",
  "attr_id": 309,
  "type": "drop_options",
  "options": [
    "Singolo",
    "Doppio"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.867Z"),
  "created_at": ISODate("2016-11-11T12:41:46.867Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b466a"),
  "lang": "en",
  "label": "Engine Number",
  "attr_id": 309,
  "type": "drop_options",
  "options": [
    "Single",
    "Twin"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.868Z"),
  "created_at": ISODate("2016-11-11T12:41:46.868Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b466b"),
  "lang": "it",
  "label": "Centreboard Type",
  "attr_id": 310,
  "type": "drop_options",
  "options": [
    "Deriva a pinne",
    "Deriva a bulbo",
    "Deriva mobile",
    "Altre Derive"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.869Z"),
  "created_at": ISODate("2016-11-11T12:41:46.869Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b466c"),
  "lang": "en",
  "label": "Centreboard Type",
  "attr_id": 310,
  "type": "drop_options",
  "options": [
    "Fin Centreboard",
    "Bulb Centreboard",
    "Daggerboard",
    "Other Centreboard"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.870Z"),
  "created_at": ISODate("2016-11-11T12:41:46.870Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b466d"),
  "lang": "it",
  "label": "Offer Type",
  "attr_id": 315,
  "type": "drop_options",
  "options": [
    "Voglio Acquistare",
    "Voglio Affittare",
    "Voglio affittare in Leasing",
    "Offerta in Vendita",
    "Offerta in Leasing",
    "Offerta in Affitto"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.871Z"),
  "created_at": ISODate("2016-11-11T12:41:46.871Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b466e"),
  "lang": "en",
  "label": "Offer Type",
  "attr_id": 315,
  "type": "drop_options",
  "options": [
    "To Buy",
    "To Rent",
    "To Lease",
    "For Sale",
    "For Lease",
    "For Rent"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.872Z"),
  "created_at": ISODate("2016-11-11T12:41:46.872Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b466f"),
  "lang": "it",
  "label": "Boat Financial Status",
  "attr_id": 317,
  "type": "drop_options",
  "options": [
    "In leasing ",
    "Pagata Interamente",
    "Ipotecata"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.873Z"),
  "created_at": ISODate("2016-11-11T12:41:46.873Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4670"),
  "lang": "en",
  "label": "Boat Financial Status",
  "attr_id": 317,
  "type": "drop_options",
  "options": [
    "Leasing ",
    "Fully Paid",
    "Mortgage"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.875Z"),
  "created_at": ISODate("2016-11-11T12:41:46.875Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4671"),
  "lang": "it",
  "label": "Status based on Appearance & Operation",
  "attr_id": 330,
  "type": "drop_options",
  "options": [
    "Grado A",
    "Grado B",
    "Grado C"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.877Z"),
  "created_at": ISODate("2016-11-11T12:41:46.877Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4672"),
  "lang": "en",
  "label": "Status based on Appearance & Operation",
  "attr_id": 330,
  "type": "drop_options",
  "options": [
    "Grade A",
    "Grade B",
    "Grade C"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.878Z"),
  "created_at": ISODate("2016-11-11T12:41:46.878Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4673"),
  "lang": "it",
  "label": "Kitchen Type",
  "attr_id": 334,
  "type": "drop_options",
  "options": [
    "Cucina",
    "Cucina Abitabile",
    "2° Cucina",
    "Cucinotto",
    "A vista"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.880Z"),
  "created_at": ISODate("2016-11-11T12:41:46.880Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4674"),
  "lang": "en",
  "label": "Kitchen Type",
  "attr_id": 334,
  "type": "drop_options",
  "options": [
    "Kitchen",
    "Family kitchen",
    "2° kitchen",
    "Kitchenette",
    "Open to family room"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.881Z"),
  "created_at": ISODate("2016-11-11T12:41:46.881Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4675"),
  "lang": "it",
  "label": "Dining Room Type",
  "attr_id": 335,
  "type": "drop_options",
  "options": [
    "Zona pranzo",
    "Sala da pranzo",
    "Bancone",
    "Combo Pranzo/Soggiorno",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.882Z"),
  "created_at": ISODate("2016-11-11T12:41:46.882Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4676"),
  "lang": "en",
  "label": "Dining Room Type",
  "attr_id": 335,
  "type": "drop_options",
  "options": [
    "Eating Area",
    "Dining Room",
    "Breakfast Counter/Bar",
    "Living/Dining Combo",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.883Z"),
  "created_at": ISODate("2016-11-11T12:41:46.883Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4677"),
  "lang": "it",
  "label": "EPC (Energy Performance Certificate)",
  "attr_id": 338,
  "type": "drop_options",
  "options": [
    "A+++",
    "A++",
    "A+",
    "A",
    "B+",
    "B",
    "C",
    "D",
    "E",
    "F",
    "G"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.884Z"),
  "created_at": ISODate("2016-11-11T12:41:46.884Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4678"),
  "lang": "en",
  "label": "EPC (Energy Performance Certificate)",
  "attr_id": 338,
  "type": "drop_options",
  "options": [
    "A+++",
    "A++",
    "A+",
    "A",
    "B+",
    "B",
    "C",
    "D",
    "E",
    "F",
    "G"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.885Z"),
  "created_at": ISODate("2016-11-11T12:41:46.885Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4679"),
  "lang": "it",
  "label": "Lift",
  "attr_id": 340,
  "type": "drop_options",
  "options": [
    1,
    2,
    "3+",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.886Z"),
  "created_at": ISODate("2016-11-11T12:41:46.886Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b467a"),
  "lang": "en",
  "label": "Lift",
  "attr_id": 340,
  "type": "drop_options",
  "options": [
    1,
    2,
    "3+",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.887Z"),
  "created_at": ISODate("2016-11-11T12:41:46.887Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b467b"),
  "lang": "it",
  "label": "Storage Basement",
  "attr_id": 341,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.888Z"),
  "created_at": ISODate("2016-11-11T12:41:46.888Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b467c"),
  "lang": "en",
  "label": "Storage Basement",
  "attr_id": 341,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.889Z"),
  "created_at": ISODate("2016-11-11T12:41:46.889Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b467d"),
  "lang": "it",
  "label": "Attic",
  "attr_id": 342,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.890Z"),
  "created_at": ISODate("2016-11-11T12:41:46.890Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b467e"),
  "lang": "en",
  "label": "Attic",
  "attr_id": 342,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.892Z"),
  "created_at": ISODate("2016-11-11T12:41:46.892Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b467f"),
  "lang": "it",
  "label": "Garden",
  "attr_id": 343,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.893Z"),
  "created_at": ISODate("2016-11-11T12:41:46.893Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4680"),
  "lang": "en",
  "label": "Garden",
  "attr_id": 343,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.895Z"),
  "created_at": ISODate("2016-11-11T12:41:46.895Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4681"),
  "lang": "it",
  "label": "Garage Type",
  "attr_id": 344,
  "type": "drop_options",
  "options": [
    "1 Garage Annesso",
    "1 Garage Separato",
    "2 Garage Annessi",
    "2 Garage Separati",
    "3+ Garage Annessi",
    "3+ Garages Separati",
    "Nessun garage"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.896Z"),
  "created_at": ISODate("2016-11-11T12:41:46.896Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4682"),
  "lang": "en",
  "label": "Garage Type",
  "attr_id": 344,
  "type": "drop_options",
  "options": [
    "1 Garage Attached",
    "1 Garage Detached",
    "2 Garages Attached",
    "2 Garages Detached",
    "3+ Garages Attached",
    "3+ Garages Detached",
    "No Garage"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.898Z"),
  "created_at": ISODate("2016-11-11T12:41:46.898Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4683"),
  "lang": "it",
  "label": "Car Port Type",
  "attr_id": 345,
  "type": "drop_options",
  "options": [
    "Posto auto assegnato coperto",
    "Posto auto assegnato esterno",
    "Parcheggio condominiale privato",
    "Parcheggio condominiale pubblico",
    "Posto auto nel vialetto d'accesso",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.900Z"),
  "created_at": ISODate("2016-11-11T12:41:46.900Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4684"),
  "lang": "en",
  "label": "Car Port Type",
  "attr_id": 345,
  "type": "drop_options",
  "options": [
    "Indoor Assigned Carport",
    "Outdoor Assigned Carport",
    "Private Residents' Parking Lot",
    "Public Residents' Parking Lot",
    "Driveway Parking Space",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.901Z"),
  "created_at": ISODate("2016-11-11T12:41:46.901Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4685"),
  "lang": "it",
  "label": "Contract Type",
  "attr_id": 346,
  "type": "drop_options",
  "options": [
    "Voglio Acquistare",
    "Voglio Affittare",
    "Voglio affittare in Leasing",
    "Offerta in Vendita",
    "Offerta in Leasing",
    "Offerta in Affitto"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.903Z"),
  "created_at": ISODate("2016-11-11T12:41:46.903Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4686"),
  "lang": "en",
  "label": "Contract Type",
  "attr_id": 346,
  "type": "drop_options",
  "options": [
    "To Buy",
    "To Rent",
    "To Lease",
    "For Sale",
    "For Lease",
    "For Rent"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.904Z"),
  "created_at": ISODate("2016-11-11T12:41:46.904Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4687"),
  "lang": "it",
  "label": "Property Status",
  "attr_id": 353,
  "type": "drop_options",
  "options": [
    "Modificato",
    "Così com'è",
    "Dal costruttore",
    "Completato",
    "Conversione",
    "Nuovo",
    "Nessuna Modifica",
    "Potenziale Clinica",
    "Riparazioni Cosmetiche",
    "Da Ristrutturare",
    "Ristrutturato",
    "Solo Struttura (non completata)",
    "Da ricostruire",
    "In costruzione",
    "Sconosciuto",
    "Recentemente Ristrutturato"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.906Z"),
  "created_at": ISODate("2016-11-11T12:41:46.906Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4688"),
  "lang": "en",
  "label": "Property Status",
  "attr_id": 353,
  "type": "drop_options",
  "options": [
    "Additions/Alter",
    "As Is",
    "Builder",
    "Completed",
    "Condo Conversion ",
    "New",
    "No Additions/Alter",
    "Rehab Potential",
    "Repairs Cosmetic",
    "Repairs Major Needed",
    "Restored",
    "Shell",
    "To Be Built",
    "Under Costruction",
    "Unknown",
    "Update Remodeled"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.908Z"),
  "created_at": ISODate("2016-11-11T12:41:46.908Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4689"),
  "lang": "it",
  "label": "Property/Lot Size - measurement unit",
  "attr_id": 360,
  "type": "drop_options",
  "options": [
    "M2",
    "SF",
    "Ettari",
    "Acri"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.909Z"),
  "created_at": ISODate("2016-11-11T12:41:46.909Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b468a"),
  "lang": "en",
  "label": "Property/Lot Size - measurement unit",
  "attr_id": 360,
  "type": "drop_options",
  "options": [
    "M2",
    "SF",
    "Hectares",
    "Acres"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.911Z"),
  "created_at": ISODate("2016-11-11T12:41:46.911Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b468b"),
  "lang": "it",
  "label": "Other Rooms (different from bedrooms)",
  "attr_id": 364,
  "type": "drop_options",
  "options": [
    "Atrio",
    "Seminterrato",
    "Guardaroba",
    "Ufficio",
    "Stanza da disegno",
    "Palestra",
    "Soggiorno",
    "Solarium",
    "Salone",
    "Lavanderia",
    "Stanza Cinema",
    "Dispensa",
    "Patio/Balcone",
    "Portico",
    "Entrata",
    "Stanza Giochi",
    "Sauna/Bagno Turco",
    "Sala da bagno",
    "Sala dipendenti",
    "Studio",
    "Cantina Vini",
    "Officina",
    "Nessuna",
    "Altre Stanze"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.912Z"),
  "created_at": ISODate("2016-11-11T12:41:46.912Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b468c"),
  "lang": "en",
  "label": "Other Rooms (different from bedrooms)",
  "attr_id": 364,
  "type": "drop_options",
  "options": [
    "Atrium",
    "Basement",
    "Cloakroom",
    "Den/Office",
    "Drawing Room",
    "Exercise Room/Gym",
    "Family Room",
    "Florida/Sun Room",
    "Great Room",
    "Laundry Room",
    "Media Room",
    "Pantry",
    "Patio/Balcony",
    "Porch",
    "Reception Room",
    "Recreation Room",
    "Sauna/Steam Room",
    "Shower Room",
    "Staff Room",
    "Study",
    "Wine Cellar",
    "Workshop",
    "None",
    "Other Rooms"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.913Z"),
  "created_at": ISODate("2016-11-11T12:41:46.913Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b468d"),
  "lang": "it",
  "label": "Garden Size - measurement unit",
  "attr_id": 367,
  "type": "drop_options",
  "options": [
    "M2",
    "SF",
    "Ettari",
    "Acri"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.914Z"),
  "created_at": ISODate("2016-11-11T12:41:46.914Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b468e"),
  "lang": "en",
  "label": "Garden Size - measurement unit",
  "attr_id": 367,
  "type": "drop_options",
  "options": [
    "M2",
    "SF",
    "Hectares",
    "Acres"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.915Z"),
  "created_at": ISODate("2016-11-11T12:41:46.915Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b468f"),
  "lang": "it",
  "label": "Guest House Size - measurement unit",
  "attr_id": 375,
  "type": "drop_options",
  "options": [
    "M2",
    "SF",
    "Ettari",
    "Acri"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.916Z"),
  "created_at": ISODate("2016-11-11T12:41:46.916Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4690"),
  "lang": "en",
  "label": "Guest House Size - measurement unit",
  "attr_id": 375,
  "type": "drop_options",
  "options": [
    "M2",
    "SF",
    "Hectares",
    "Acres"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.917Z"),
  "created_at": ISODate("2016-11-11T12:41:46.917Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4691"),
  "lang": "it",
  "label": "Service Destined To",
  "attr_id": 387,
  "type": "drop_options",
  "options": [
    "Azienda",
    "Utente Finale",
    "Azienda/Utente Finale",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.918Z"),
  "created_at": ISODate("2016-11-11T12:41:46.918Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4692"),
  "lang": "en",
  "label": "Service Destined To",
  "attr_id": 387,
  "type": "drop_options",
  "options": [
    "Corporarion",
    "User",
    "Corporation/User",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.919Z"),
  "created_at": ISODate("2016-11-11T12:41:46.919Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4694"),
  "lang": "en",
  "label": "Printing Products",
  "attr_id": 394,
  "type": "drop_options",
  "options": [
    "Greeting Cards Printing",
    "Hang Tags",
    "HardCover Book Printing",
    "Invitation Card Printing",
    "Letter Pad Printing",
    "Letterhead",
    "Luminous Printing",
    "Magazines Printing",
    "Make Color Banners",
    "Make Manual & Folder",
    "Mouse Pads Printing",
    "Notebooks Printing",
    "Notepads",
    "Packaging Boxes Printing",
    "Paper Bags Printing",
    "Postcards Printing",
    "Posters Printing",
    "Pre Printing",
    "Presentation Folders",
    "Rack Cards",
    "Scratch Pad Printing",
    "Show Stands Printing",
    "SoftCover Books Printing",
    "Statement Rapid Printing",
    "Stickers",
    "Tag Printing",
    "Vinyl Banners",
    "Yellow Pages Printing",
    "Other Printing Services"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.921Z"),
  "created_at": ISODate("2016-11-11T12:41:46.921Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4695"),
  "lang": "it",
  "label": "Perishable Goods ",
  "attr_id": 395,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.922Z"),
  "created_at": ISODate("2016-11-11T12:41:46.922Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4696"),
  "lang": "en",
  "label": "Perishable Goods ",
  "attr_id": 395,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.923Z"),
  "created_at": ISODate("2016-11-11T12:41:46.923Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4697"),
  "lang": "it",
  "label": "Weight - measurement unit",
  "attr_id": 402,
  "type": "drop_options",
  "options": [
    "Kg",
    "Lb",
    "Ton",
    "1000 Lb",
    "Kg/m2",
    "Lb/ft2",
    "Kg/m3",
    "Lb/ft3"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.930Z"),
  "created_at": ISODate("2016-11-11T12:41:46.930Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4698"),
  "lang": "en",
  "label": "Weight - measurement unit",
  "attr_id": 402,
  "type": "drop_options",
  "options": [
    "Kg",
    "Lb",
    "Ton",
    "1000 Lb",
    "Kg/m2",
    "Lb/ft2",
    "Kg/m3",
    "Lb/ft3"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.932Z"),
  "created_at": ISODate("2016-11-11T12:41:46.932Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b4699"),
  "lang": "it",
  "label": "Length - measurement unit",
  "attr_id": 404,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.934Z"),
  "created_at": ISODate("2016-11-11T12:41:46.934Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b469a"),
  "lang": "en",
  "label": "Length - measurement unit",
  "attr_id": 404,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.935Z"),
  "created_at": ISODate("2016-11-11T12:41:46.935Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b469b"),
  "lang": "it",
  "label": "Length2 - measurement unit",
  "attr_id": 406,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.937Z"),
  "created_at": ISODate("2016-11-11T12:41:46.937Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b469c"),
  "lang": "en",
  "label": "Length2 - measurement unit",
  "attr_id": 406,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.938Z"),
  "created_at": ISODate("2016-11-11T12:41:46.938Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b469d"),
  "lang": "it",
  "label": "Depth/Width - measurement unit",
  "attr_id": 408,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.940Z"),
  "created_at": ISODate("2016-11-11T12:41:46.940Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b469e"),
  "lang": "en",
  "label": "Depth/Width - measurement unit",
  "attr_id": 408,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.942Z"),
  "created_at": ISODate("2016-11-11T12:41:46.942Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b469f"),
  "lang": "it",
  "label": "Height - measurement unit",
  "attr_id": 410,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.943Z"),
  "created_at": ISODate("2016-11-11T12:41:46.943Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46a0"),
  "lang": "en",
  "label": "Height - measurement unit",
  "attr_id": 410,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.945Z"),
  "created_at": ISODate("2016-11-11T12:41:46.945Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46a1"),
  "lang": "it",
  "label": "Volume - measurement unit",
  "attr_id": 412,
  "type": "drop_options",
  "options": [
    "M3",
    "Ft3",
    "Inch3",
    "Cm3",
    "Litri",
    "Galloni",
    "Ettolitri"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.947Z"),
  "created_at": ISODate("2016-11-11T12:41:46.947Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46a2"),
  "lang": "en",
  "label": "Volume - measurement unit",
  "attr_id": 412,
  "type": "drop_options",
  "options": [
    "M3",
    "Ft3",
    "Inch3",
    "Cm3",
    "Liter",
    "Gallons",
    "Hettoliter"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.948Z"),
  "created_at": ISODate("2016-11-11T12:41:46.948Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46a3"),
  "lang": "it",
  "label": "Girth - measurement unit",
  "attr_id": 414,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.949Z"),
  "created_at": ISODate("2016-11-11T12:41:46.949Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46a4"),
  "lang": "en",
  "label": "Girth - measurement unit",
  "attr_id": 414,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.951Z"),
  "created_at": ISODate("2016-11-11T12:41:46.951Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46a5"),
  "lang": "it",
  "label": "Diameter - measurement unit",
  "attr_id": 416,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.952Z"),
  "created_at": ISODate("2016-11-11T12:41:46.952Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46a6"),
  "lang": "en",
  "label": "Diameter - measurement unit",
  "attr_id": 416,
  "type": "drop_options",
  "options": [
    "Mt",
    "Inch",
    "Cm",
    "Ft"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.953Z"),
  "created_at": ISODate("2016-11-11T12:41:46.953Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46a7"),
  "lang": "it",
  "label": "Speed - measurement unit",
  "attr_id": 422,
  "type": "drop_options",
  "options": [
    "mph",
    "kph",
    "fps",
    "m/s",
    "fpm",
    "m/min",
    "nodi"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.954Z"),
  "created_at": ISODate("2016-11-11T12:41:46.954Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46a8"),
  "lang": "en",
  "label": "Speed - measurement unit",
  "attr_id": 422,
  "type": "drop_options",
  "options": [
    "mph",
    "kph",
    "fps",
    "m/s",
    "fpm",
    "m/min",
    "knots"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.956Z"),
  "created_at": ISODate("2016-11-11T12:41:46.956Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46a9"),
  "lang": "it",
  "label": "Pressure - measurement unit",
  "attr_id": 424,
  "type": "drop_options",
  "options": [
    "Pa",
    "Bar",
    "Kg/mm2",
    "lbf/in2",
    "Kg/cm2",
    "psi"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.957Z"),
  "created_at": ISODate("2016-11-11T12:41:46.957Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46aa"),
  "lang": "en",
  "label": "Pressure - measurement unit",
  "attr_id": 424,
  "type": "drop_options",
  "options": [
    "Pa",
    "Bar",
    "Kg/mm2",
    "lbf/in2",
    "Kg/cm2",
    "psi"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.958Z"),
  "created_at": ISODate("2016-11-11T12:41:46.958Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46ab"),
  "lang": "it",
  "label": "Pre-owned Specs",
  "attr_id": "166;3",
  "type": "drop_options",
  "options": [
    "Età capo abbigliamento",
    "Epoca vintage"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.959Z"),
  "created_at": ISODate("2016-11-11T12:41:46.959Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46ac"),
  "lang": "en",
  "label": "Pre-owned Specs",
  "attr_id": "166;3",
  "type": "drop_options",
  "options": [
    "Clothing Age",
    "Vintage Era"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.960Z"),
  "created_at": ISODate("2016-11-11T12:41:46.960Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46ad"),
  "lang": "it",
  "label": "Vintage Era",
  "attr_id": "166;3;2",
  "type": "drop_options",
  "options": [
    "Pre 1900 ",
    "1900-1919",
    "1920-1948 ",
    "1949-1959",
    "1960-1970",
    "1971-1980",
    "1981-1990",
    "1991-2000 "
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.962Z"),
  "created_at": ISODate("2016-11-11T12:41:46.962Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46ae"),
  "lang": "en",
  "label": "Vintage Era",
  "attr_id": "166;3;2",
  "type": "drop_options",
  "options": [
    "Pre 1900 ",
    "1900-1919",
    "1920-1948 ",
    "1949-1959",
    "1960-1970",
    "1971-1980",
    "1981-1990",
    "1991-2000 "
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.963Z"),
  "created_at": ISODate("2016-11-11T12:41:46.963Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46af"),
  "lang": "it",
  "label": "Clothes & Accessories Age",
  "attr_id": "166;3;1",
  "type": "drop_options",
  "options": [
    -1,
    -2,
    -3,
    -4,
    -5,
    -6,
    -7,
    -8,
    -9,
    -10,
    -11,
    -12,
    -13,
    -14
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.964Z"),
  "created_at": ISODate("2016-11-11T12:41:46.964Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46b0"),
  "lang": "en",
  "label": "Clothes & Accessories Age",
  "attr_id": "166;3;1",
  "type": "drop_options",
  "options": [
    -1,
    -2,
    -3,
    -4,
    -5,
    -6,
    -7,
    -8,
    -9,
    -10,
    -11,
    -12,
    -13,
    -14
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.967Z"),
  "created_at": ISODate("2016-11-11T12:41:46.967Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46b1"),
  "lang": "it",
  "label": "Memory Parity",
  "attr_id": 484,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.969Z"),
  "created_at": ISODate("2016-11-11T12:41:46.969Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46b2"),
  "lang": "en",
  "label": "Memory Parity",
  "attr_id": 484,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.971Z"),
  "created_at": ISODate("2016-11-11T12:41:46.971Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46b3"),
  "lang": "it",
  "label": "Wheeling Type",
  "attr_id": 489,
  "type": "drop_options",
  "options": [
    "Gommato",
    "Cingolato"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.972Z"),
  "created_at": ISODate("2016-11-11T12:41:46.972Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46b4"),
  "lang": "en",
  "label": "Wheeling Type",
  "attr_id": 489,
  "type": "drop_options",
  "options": [
    "Wheeled",
    "Tracked"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.974Z"),
  "created_at": ISODate("2016-11-11T12:41:46.974Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46b5"),
  "lang": "it",
  "label": "Experience Degree",
  "attr_id": 493,
  "type": "drop_options",
  "options": [
    "Base",
    "Media",
    "Specializzata"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.975Z"),
  "created_at": ISODate("2016-11-11T12:41:46.975Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46b6"),
  "lang": "en",
  "label": "Experience Degree",
  "attr_id": 493,
  "type": "drop_options",
  "options": [
    "Entry Level",
    "Medium Level",
    "Specialized"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.976Z"),
  "created_at": ISODate("2016-11-11T12:41:46.976Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46b7"),
  "lang": "it",
  "label": "Floor/Wall Covering Intended Use 1",
  "attr_id": 495,
  "type": "drop_options",
  "options": [
    "Interno",
    "Esterno"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.977Z"),
  "created_at": ISODate("2016-11-11T12:41:46.977Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46b8"),
  "lang": "en",
  "label": "Floor/Wall Covering Intended Use 1",
  "attr_id": 495,
  "type": "drop_options",
  "options": [
    "Indoor",
    "Outdoor"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.978Z"),
  "created_at": ISODate("2016-11-11T12:41:46.978Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46b9"),
  "lang": "it",
  "label": "Floor/Wall Covering Intended Use 2",
  "attr_id": 496,
  "type": "drop_options",
  "options": [
    "Pavimenti",
    "Rivestimenti",
    "Pavimenti e rivestimenti"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.979Z"),
  "created_at": ISODate("2016-11-11T12:41:46.979Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46ba"),
  "lang": "en",
  "label": "Floor/Wall Covering Intended Use 2",
  "attr_id": 496,
  "type": "drop_options",
  "options": [
    "Floor",
    "Wall Covering",
    "Floor and Wall Covering"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.980Z"),
  "created_at": ISODate("2016-11-11T12:41:46.980Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46bb"),
  "lang": "it",
  "label": "Porcelain Tiles Features",
  "attr_id": 497,
  "type": "drop_options",
  "options": [
    "Carrabile",
    "Ingelivo",
    "Stonalizzato",
    "Antiscivolo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.981Z"),
  "created_at": ISODate("2016-11-11T12:41:46.981Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46bc"),
  "lang": "en",
  "label": "Porcelain Tiles Features",
  "attr_id": 497,
  "type": "drop_options",
  "options": [
    "Outdoor",
    "Frost Proof",
    "Stone Effect",
    "Anti-Slip"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.983Z"),
  "created_at": ISODate("2016-11-11T12:41:46.983Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46bd"),
  "lang": "it",
  "label": "Floor/Wall Covering End Use",
  "attr_id": 499,
  "type": "drop_options",
  "options": [
    "Casa",
    "Ufficio",
    "Industriale",
    "Commerciale",
    "Ospedale e sanitario",
    "Comunità",
    "Bagno",
    "Soggiorno",
    "Cucina",
    "Giardino"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.984Z"),
  "created_at": ISODate("2016-11-11T12:41:46.984Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46be"),
  "lang": "en",
  "label": "Floor/Wall Covering End Use",
  "attr_id": 499,
  "type": "drop_options",
  "options": [
    "House",
    "Office",
    "Industrial",
    "Commercial",
    "Hospital/Health",
    "Community",
    "Bathroom",
    "Living",
    "Kitchen",
    "Garden"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.985Z"),
  "created_at": ISODate("2016-11-11T12:41:46.985Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46bf"),
  "lang": "it",
  "label": "Hardwood Floor Installation Mode",
  "attr_id": 500,
  "type": "drop_options",
  "options": [
    "Incollato",
    "Inchiodato",
    "Flottante"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.986Z"),
  "created_at": ISODate("2016-11-11T12:41:46.986Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46c0"),
  "lang": "en",
  "label": "Hardwood Floor Installation Mode",
  "attr_id": 500,
  "type": "drop_options",
  "options": [
    "Glued",
    "Nailed",
    "Free Float"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.987Z"),
  "created_at": ISODate("2016-11-11T12:41:46.987Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46c1"),
  "lang": "it",
  "label": "Hardwood Floor Treatment",
  "attr_id": 501,
  "type": "drop_options",
  "options": [
    "Verniciatura",
    "Ceratura",
    "Olio",
    "Prefinito"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.988Z"),
  "created_at": ISODate("2016-11-11T12:41:46.988Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46c2"),
  "lang": "en",
  "label": "Hardwood Floor Treatment",
  "attr_id": 501,
  "type": "drop_options",
  "options": [
    "Painting",
    "Waxing",
    "Oil",
    "Prefinished"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.990Z"),
  "created_at": ISODate("2016-11-11T12:41:46.990Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46c3"),
  "lang": "it",
  "label": "Abrasion Class",
  "attr_id": 502,
  "type": "drop_options",
  "options": [
    "A1",
    "A2",
    "A3",
    "A4",
    "A5"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.991Z"),
  "created_at": ISODate("2016-11-11T12:41:46.991Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46c4"),
  "lang": "en",
  "label": "Abrasion Class",
  "attr_id": 502,
  "type": "drop_options",
  "options": [
    "A1",
    "A2",
    "A3",
    "A4",
    "A5"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.992Z"),
  "created_at": ISODate("2016-11-11T12:41:46.992Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46c5"),
  "lang": "it",
  "label": "Carpet Type",
  "attr_id": 504,
  "type": "drop_options",
  "options": [
    "Bouclée",
    "Vellutate",
    "Agugliate",
    "Altro tipo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.993Z"),
  "created_at": ISODate("2016-11-11T12:41:46.993Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46c6"),
  "lang": "en",
  "label": "Carpet Type",
  "attr_id": 504,
  "type": "drop_options",
  "options": [
    "Bouclée",
    "Velvety",
    "Wired",
    "Oher type"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.995Z"),
  "created_at": ISODate("2016-11-11T12:41:46.995Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46c7"),
  "lang": "it",
  "label": "Style",
  "attr_id": 507,
  "type": "drop_options",
  "options": [
    "Classico",
    "Contemporaneo",
    "Vintage",
    "Disign",
    "Rustico",
    "Etnico"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.997Z"),
  "created_at": ISODate("2016-11-11T12:41:46.997Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46c8"),
  "lang": "en",
  "label": "Style",
  "attr_id": 507,
  "type": "drop_options",
  "options": [
    "Classic",
    "Modern",
    "Vintage",
    "Design",
    "Rustic",
    "Ethnic"
  ],
  "updated_at": ISODate("2016-11-11T12:41:46.999Z"),
  "created_at": ISODate("2016-11-11T12:41:46.999Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46c9"),
  "lang": "it",
  "label": "Furniture Treatment",
  "attr_id": 508,
  "type": "drop_options",
  "options": [
    "Laccato",
    "Verniciato",
    "Grezzo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.1Z"),
  "created_at": ISODate("2016-11-11T12:41:47.1Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8a1c8cb6e5388b46ca"),
  "lang": "en",
  "label": "Furniture Treatment",
  "attr_id": 508,
  "type": "drop_options",
  "options": [
    "Lacquered",
    "Painted",
    "Rough"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.3Z"),
  "created_at": ISODate("2016-11-11T12:41:47.3Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46cb"),
  "lang": "it",
  "label": "Product Status",
  "attr_id": 509,
  "type": "drop_options",
  "options": [
    "Nuovo",
    "Usato",
    "New Open Box"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.4Z"),
  "created_at": ISODate("2016-11-11T12:41:47.4Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46cc"),
  "lang": "en",
  "label": "Product Status",
  "attr_id": 509,
  "type": "drop_options",
  "options": [
    "New",
    "Used",
    "NOB"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.5Z"),
  "created_at": ISODate("2016-11-11T12:41:47.5Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46cd"),
  "lang": "it",
  "label": "Bed/Mattress Space",
  "attr_id": 510,
  "type": "drop_options",
  "options": [
    "1 piazza",
    "1 piazza e 1/2",
    "2 piazze",
    "Queen",
    "King",
    "Super King",
    "Misure speciali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.6Z"),
  "created_at": ISODate("2016-11-11T12:41:47.6Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46ce"),
  "lang": "en",
  "label": "Bed/Mattress Space",
  "attr_id": 510,
  "type": "drop_options",
  "options": [
    "Single",
    "French",
    "Double",
    "Queen",
    "King",
    "Super King",
    "Special Size"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.8Z"),
  "created_at": ISODate("2016-11-11T12:41:47.8Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46cf"),
  "lang": "it",
  "label": "Furniture Comfort",
  "attr_id": 511,
  "type": "drop_options",
  "options": [
    "Non imbotito",
    "Imbotito"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.9Z"),
  "created_at": ISODate("2016-11-11T12:41:47.9Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46d0"),
  "lang": "en",
  "label": "Furniture Comfort",
  "attr_id": 511,
  "type": "drop_options",
  "options": [
    "Non-Padded",
    "Padded"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.10Z"),
  "created_at": ISODate("2016-11-11T12:41:47.10Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46d1"),
  "lang": "it",
  "label": "Bed Special Features",
  "attr_id": 512,
  "type": "drop_options",
  "options": [
    "Letto gonfiabile",
    "Letto ad acqua",
    "Letto autogonfiabile",
    "Letto vibrante"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.11Z"),
  "created_at": ISODate("2016-11-11T12:41:47.11Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46d2"),
  "lang": "en",
  "label": "Bed Special Features",
  "attr_id": 512,
  "type": "drop_options",
  "options": [
    "Inflatable Bed",
    "Water Bed",
    "Auto-Inflatable Bed",
    "Vibrating Bed"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.12Z"),
  "created_at": ISODate("2016-11-11T12:41:47.12Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46d3"),
  "lang": "it",
  "label": "Bed Type",
  "attr_id": 513,
  "type": "drop_options",
  "options": [
    "Letto pieghevole",
    "Letto tradizionale",
    "Letto a castello"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.13Z"),
  "created_at": ISODate("2016-11-11T12:41:47.13Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46d4"),
  "lang": "en",
  "label": "Bed Type",
  "attr_id": 513,
  "type": "drop_options",
  "options": [
    "Foldable Bed",
    "Traditional Bed",
    "Bunk Bed"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.14Z"),
  "created_at": ISODate("2016-11-11T12:41:47.14Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46d5"),
  "lang": "it",
  "label": "Bedroom Composition",
  "attr_id": 514,
  "type": "drop_options",
  "options": [
    "Comodino",
    "Armadio",
    "Cassetiera",
    "Appendiabiti",
    "Poltrona",
    "Specchiera"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.16Z"),
  "created_at": ISODate("2016-11-11T12:41:47.16Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46d6"),
  "lang": "en",
  "label": "Bedroom Composition",
  "attr_id": 514,
  "type": "drop_options",
  "options": [
    "Nightstand",
    "Wardrobe",
    "Dresser",
    "Coat Rack",
    "Armchair",
    "Mirror/Mirror Stand"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.17Z"),
  "created_at": ISODate("2016-11-11T12:41:47.17Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46d7"),
  "lang": "it",
  "label": "Operation",
  "attr_id": 515,
  "type": "drop_options",
  "options": [
    "Manuale",
    "Motorizzato",
    "Reclinabili",
    "Pieghevoli"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.18Z"),
  "created_at": ISODate("2016-11-11T12:41:47.18Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46d8"),
  "lang": "en",
  "label": "Operation",
  "attr_id": 515,
  "type": "drop_options",
  "options": [
    "Manual",
    "Motor-Powered",
    "Adjustable",
    "Foldable"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.19Z"),
  "created_at": ISODate("2016-11-11T12:41:47.19Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46d9"),
  "lang": "it",
  "label": "Bedding Composition",
  "attr_id": 520,
  "type": "drop_options",
  "options": [
    "Set singolo",
    "Singolo",
    "Set matrimoniale",
    "Matrimoniale",
    "Set altre misure",
    "Altre misure"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.21Z"),
  "created_at": ISODate("2016-11-11T12:41:47.21Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46da"),
  "lang": "en",
  "label": "Bedding Composition",
  "attr_id": 520,
  "type": "drop_options",
  "options": [
    "Single Bed Set",
    "Single Bed",
    "Double Bed Set",
    "Double Bed",
    "Set Other Size ",
    "Other Size"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.23Z"),
  "created_at": ISODate("2016-11-11T12:41:47.23Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46db"),
  "lang": "it",
  "label": "End Use",
  "attr_id": 522,
  "type": "drop_options",
  "options": [
    "Casa",
    "Comunità",
    "Ristorante",
    "Ospedale",
    "Bar/Discoteca",
    "Militare",
    "Hotel",
    "Nautica",
    "Aeroplano",
    "Negozio",
    "Urbano",
    "Strutture sportive",
    "Ufficio",
    "Giardino/esterno",
    "Altro settore"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.24Z"),
  "created_at": ISODate("2016-11-11T12:41:47.24Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46dc"),
  "lang": "en",
  "label": "End Use",
  "attr_id": 522,
  "type": "drop_options",
  "options": [
    "Home",
    "Community",
    "Restaurant",
    "Hospital",
    "Bar/Disco",
    "Military",
    "Hotel",
    "Nautical",
    "Airplane",
    "Shop",
    "Urban",
    "Sport Facilities",
    "Office",
    "Garden/Outdoor",
    "Other Sector"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.26Z"),
  "created_at": ISODate("2016-11-11T12:41:47.26Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46dd"),
  "lang": "it",
  "label": "Mattress Type",
  "attr_id": 523,
  "type": "drop_options",
  "options": [
    "Unico",
    "Pieghevole"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.27Z"),
  "created_at": ISODate("2016-11-11T12:41:47.27Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46de"),
  "lang": "en",
  "label": "Mattress Type",
  "attr_id": 523,
  "type": "drop_options",
  "options": [
    "One-piece",
    "Foldable"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.29Z"),
  "created_at": ISODate("2016-11-11T12:41:47.29Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46df"),
  "lang": "it",
  "label": "Textile Product Composition",
  "attr_id": 524,
  "type": "drop_options",
  "options": [
    "Singolo prodotto",
    "Set"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.31Z"),
  "created_at": ISODate("2016-11-11T12:41:47.31Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46e0"),
  "lang": "en",
  "label": "Textile Product Composition",
  "attr_id": 524,
  "type": "drop_options",
  "options": [
    "Single Product",
    "Set"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.33Z"),
  "created_at": ISODate("2016-11-11T12:41:47.33Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46e1"),
  "lang": "it",
  "label": "Curtain/Drapes Type",
  "attr_id": 525,
  "type": "drop_options",
  "options": [
    "Cadenti",
    "A soffietto",
    "Rigide",
    "Altro tipo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.39Z"),
  "created_at": ISODate("2016-11-11T12:41:47.39Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46e2"),
  "lang": "en",
  "label": "Curtain/Drapes Type",
  "attr_id": 525,
  "type": "drop_options",
  "options": [
    "Droopy",
    "Bifold",
    "Panel",
    "Other type"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.40Z"),
  "created_at": ISODate("2016-11-11T12:41:47.40Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46e3"),
  "lang": "it",
  "label": "Faucet Style",
  "attr_id": 527,
  "type": "drop_options",
  "options": [
    "A valvola",
    "Termostatici",
    "Miscelatori",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.42Z"),
  "created_at": ISODate("2016-11-11T12:41:47.42Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46e4"),
  "lang": "en",
  "label": "Faucet Style",
  "attr_id": 527,
  "type": "drop_options",
  "options": [
    "Valve",
    "Thermostatic Mixing Valve",
    "Mixer",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.43Z"),
  "created_at": ISODate("2016-11-11T12:41:47.43Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46e5"),
  "lang": "it",
  "label": "Faucet Type",
  "attr_id": 529,
  "type": "drop_options",
  "options": [
    "Manuale",
    "Monocomando"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.44Z"),
  "created_at": ISODate("2016-11-11T12:41:47.44Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46e6"),
  "lang": "en",
  "label": "Faucet Type",
  "attr_id": 529,
  "type": "drop_options",
  "options": [
    "Manual",
    "Single Lever"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.46Z"),
  "created_at": ISODate("2016-11-11T12:41:47.46Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46e7"),
  "lang": "it",
  "label": "Drain",
  "attr_id": 530,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.47Z"),
  "created_at": ISODate("2016-11-11T12:41:47.47Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46e8"),
  "lang": "en",
  "label": "Drain",
  "attr_id": 530,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.48Z"),
  "created_at": ISODate("2016-11-11T12:41:47.48Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46e9"),
  "lang": "it",
  "label": "Plating",
  "attr_id": 531,
  "type": "drop_options",
  "options": [
    "Bronzatura",
    "Cromatura",
    "Acciaio",
    "Altra finitura"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.49Z"),
  "created_at": ISODate("2016-11-11T12:41:47.49Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46ea"),
  "lang": "en",
  "label": "Plating",
  "attr_id": 531,
  "type": "drop_options",
  "options": [
    "Brass Plating",
    "Chromium Plating",
    "Steel Plating",
    "Other Plating"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.51Z"),
  "created_at": ISODate("2016-11-11T12:41:47.51Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46eb"),
  "lang": "it",
  "label": "Power/Energy Source",
  "attr_id": 532,
  "type": "drop_options",
  "options": [
    "Legna",
    "Minerale",
    "Vapore",
    "Elettrica",
    "Gas",
    "Solare"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.53Z"),
  "created_at": ISODate("2016-11-11T12:41:47.53Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46ec"),
  "lang": "en",
  "label": "Power/Energy Source",
  "attr_id": 532,
  "type": "drop_options",
  "options": [
    "Wood",
    "Mineral",
    "Steam",
    "Electrical",
    "Gas",
    "Solar"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.55Z"),
  "created_at": ISODate("2016-11-11T12:41:47.55Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46ed"),
  "lang": "it",
  "label": "Doors/Windows/Frames Certification",
  "attr_id": 533,
  "type": "drop_options",
  "options": [
    "Classe 1",
    "Classe 2",
    "Classe 3",
    "Classe 4",
    "Classe 5",
    "Classe 6",
    "Nessuna classe"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.57Z"),
  "created_at": ISODate("2016-11-11T12:41:47.57Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46ee"),
  "lang": "en",
  "label": "Doors/Windows/Frames Certification",
  "attr_id": 533,
  "type": "drop_options",
  "options": [
    "Class 1",
    "Class 2",
    "Class 3",
    "Class 4",
    "Class 5",
    "Class 6",
    "No Class"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.60Z"),
  "created_at": ISODate("2016-11-11T12:41:47.60Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46ef"),
  "lang": "it",
  "label": "Lock Type",
  "attr_id": 534,
  "type": "drop_options",
  "options": [
    "Serrature a mortasa",
    "Incassate",
    "Smart card",
    "Combinazione",
    "Telecomando",
    "Elettroserratura",
    "A cilindro",
    "Digitali senza chiave",
    "Altro tipo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.62Z"),
  "created_at": ISODate("2016-11-11T12:41:47.62Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46f0"),
  "lang": "en",
  "label": "Lock Type",
  "attr_id": 534,
  "type": "drop_options",
  "options": [
    "Mortice Locks",
    "Recessed Locks",
    "Smart Card Locks",
    "Combination Door Locks",
    "Remote Control Door Locks",
    "Electronic Locks",
    "Cylinder Locks",
    "Digital Keyless Locks",
    "Other type"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.63Z"),
  "created_at": ISODate("2016-11-11T12:41:47.63Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46f1"),
  "lang": "it",
  "label": "Door/Window End Use",
  "attr_id": 535,
  "type": "drop_options",
  "options": [
    "Abitazione singola",
    "Appartamento in condominio",
    "Negozio/Centro commerciale",
    "Studio/Ufficio",
    "Condominio",
    "Hotel/Residence",
    "Capannoni industriali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.65Z"),
  "created_at": ISODate("2016-11-11T12:41:47.65Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46f2"),
  "lang": "en",
  "label": "Door/Window End Use",
  "attr_id": 535,
  "type": "drop_options",
  "options": [
    "Single House",
    "Apartment in Condo",
    "Shop/Shopping Centre",
    "Study/Office",
    "Condo",
    "Hotel/Residence",
    "Industrial Sheds"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.66Z"),
  "created_at": ISODate("2016-11-11T12:41:47.66Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46f3"),
  "lang": "it",
  "label": "Type of Glass Mounted",
  "attr_id": 536,
  "type": "drop_options",
  "options": [
    "Stratificato",
    "Energy saving",
    "Antieffrazione",
    "Altro tipo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.67Z"),
  "created_at": ISODate("2016-11-11T12:41:47.67Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46f4"),
  "lang": "en",
  "label": "Type of Glass Mounted",
  "attr_id": 536,
  "type": "drop_options",
  "options": [
    "Laminated",
    "Energy Saving",
    "Burglar Proof",
    "Other type"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.68Z"),
  "created_at": ISODate("2016-11-11T12:41:47.68Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46f5"),
  "lang": "it",
  "label": "Opening",
  "attr_id": 537,
  "type": "drop_options",
  "options": [
    "Elettrica ",
    "Manuale"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.70Z"),
  "created_at": ISODate("2016-11-11T12:41:47.70Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46f6"),
  "lang": "en",
  "label": "Opening",
  "attr_id": 537,
  "type": "drop_options",
  "options": [
    "Electric",
    "Manual"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.72Z"),
  "created_at": ISODate("2016-11-11T12:41:47.72Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46f7"),
  "lang": "it",
  "label": "Thermal Break",
  "attr_id": 538,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.73Z"),
  "created_at": ISODate("2016-11-11T12:41:47.73Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46f8"),
  "lang": "en",
  "label": "Thermal Break",
  "attr_id": 538,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.74Z"),
  "created_at": ISODate("2016-11-11T12:41:47.74Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46f9"),
  "lang": "it",
  "label": "Luminaire Type",
  "attr_id": 539,
  "type": "drop_options",
  "options": [
    "Soffitto",
    "Pavimento",
    "Palo",
    "Incassata",
    "Sospensione",
    "Tavolo",
    "Su binario",
    "Muro",
    "Radente",
    "Lampione",
    "Catenaria sospesa",
    "Supportata da colonna",
    "Montata sulla superficie",
    "Free Standing",
    "Chandelier",
    "Riflettore",
    "Proiettore",
    "Palla",
    "Luci notturne",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.76Z"),
  "created_at": ISODate("2016-11-11T12:41:47.76Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46fa"),
  "lang": "en",
  "label": "Luminaire Type",
  "attr_id": 539,
  "type": "drop_options",
  "options": [
    "Ceiling ",
    "Floor",
    "Pole",
    "Recessed",
    "Suspention",
    "Table",
    "Track",
    "Wall",
    "Graze Lighting",
    "Lamppost",
    "Suspended Catenary",
    "Column Supported",
    "Surface Mounted",
    "Free Standing",
    "Chandelier",
    "Reflector",
    "Projector",
    "Ball",
    "Night Lights",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.77Z"),
  "created_at": ISODate("2016-11-11T12:41:47.77Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46fb"),
  "lang": "it",
  "label": "Lighting Material",
  "attr_id": 540,
  "type": "drop_options",
  "options": [
    "Vetro",
    "Legno",
    "Alluminio",
    "Plastica",
    "Carta",
    "Cristalo",
    "Vetro d'arte",
    "Ceramica",
    "Acciaio Inox",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.78Z"),
  "created_at": ISODate("2016-11-11T12:41:47.78Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46fc"),
  "lang": "en",
  "label": "Lighting Material",
  "attr_id": 540,
  "type": "drop_options",
  "options": [
    "Glass",
    "Wood",
    "Aluminium",
    "Plastic",
    "Paper",
    "Crystal",
    "Art Glass",
    "Ceramic",
    "Stainless Steel",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.80Z"),
  "created_at": ISODate("2016-11-11T12:41:47.80Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46fd"),
  "lang": "it",
  "label": "Light Source",
  "attr_id": 541,
  "type": "drop_options",
  "options": [
    "Incandescente standard",
    "Alogena",
    "Fluorescente tubolare",
    "Fluorescente compatta",
    "Alogenuri metallici (HQI)",
    "Vapori Hg Flourescente",
    "Mercurio luce miscelata",
    "Sodio alta pressione",
    "Sodio bassa pressione",
    "Induzione",
    "LED",
    "Ultravioletta",
    "OLEDs",
    "Solare",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.81Z"),
  "created_at": ISODate("2016-11-11T12:41:47.81Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46fe"),
  "lang": "en",
  "label": "Light Source",
  "attr_id": 541,
  "type": "drop_options",
  "options": [
    "Incandescent",
    "Halogen",
    "Tubular Fluorescent",
    "Compact Fluorescent",
    "Metal Halide (HQI)",
    "Fluorescent Hg Vapour",
    "Mercury Mixed Light",
    "High Pressure Sodium",
    "Low Pressure Sodium",
    "Induction",
    "LED",
    "Ultraviolet",
    "OLEDs",
    "Solar",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.83Z"),
  "created_at": ISODate("2016-11-11T12:41:47.83Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b46ff"),
  "lang": "it",
  "label": "Lighting Power Supply",
  "attr_id": 542,
  "type": "drop_options",
  "options": [
    "110V",
    "120V ",
    "12V",
    "26V",
    "36V",
    "48V",
    "Autoset",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.84Z"),
  "created_at": ISODate("2016-11-11T12:41:47.84Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4700"),
  "lang": "en",
  "label": "Lighting Power Supply",
  "attr_id": 542,
  "type": "drop_options",
  "options": [
    "110V",
    "120V ",
    "12V",
    "26V",
    "36V",
    "48V",
    "Autoset",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.85Z"),
  "created_at": ISODate("2016-11-11T12:41:47.85Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4701"),
  "lang": "it",
  "label": "Light Color",
  "attr_id": 544,
  "type": "drop_options",
  "options": [
    "Fino a 2500 °K",
    "Da 2500 a 5000 °K",
    "Più di 5000°K"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.86Z"),
  "created_at": ISODate("2016-11-11T12:41:47.86Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4702"),
  "lang": "en",
  "label": "Light Color",
  "attr_id": 544,
  "type": "drop_options",
  "options": [
    "Up to 2500 °K",
    "From 2500 to 5000 °K",
    "More than 5000°K"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.87Z"),
  "created_at": ISODate("2016-11-11T12:41:47.87Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4703"),
  "lang": "it",
  "label": "Gangbox Material",
  "attr_id": 545,
  "type": "drop_options",
  "options": [
    "Plastica",
    "Ceramica",
    "Altro materiale"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.89Z"),
  "created_at": ISODate("2016-11-11T12:41:47.89Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4704"),
  "lang": "en",
  "label": "Gangbox Material",
  "attr_id": 545,
  "type": "drop_options",
  "options": [
    "Plastic",
    "Ceramic",
    "Other Material"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.90Z"),
  "created_at": ISODate("2016-11-11T12:41:47.90Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4705"),
  "lang": "it",
  "label": "Lighting Localization",
  "attr_id": 546,
  "type": "drop_options",
  "options": [
    "Zona living",
    "Bagno",
    "Camera da letto",
    "Altre aree interne"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.92Z"),
  "created_at": ISODate("2016-11-11T12:41:47.92Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4706"),
  "lang": "en",
  "label": "Lighting Localization",
  "attr_id": 546,
  "type": "drop_options",
  "options": [
    "Living Room",
    "Bathroom",
    "Bedroom",
    "Other Indoor Areas"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.94Z"),
  "created_at": ISODate("2016-11-11T12:41:47.94Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4707"),
  "lang": "it",
  "label": "Lighting Cover Material",
  "attr_id": 549,
  "type": "drop_options",
  "options": [
    "Plastica",
    "Acciaio",
    "Urea",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.95Z"),
  "created_at": ISODate("2016-11-11T12:41:47.95Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4708"),
  "lang": "en",
  "label": "Lighting Cover Material",
  "attr_id": 549,
  "type": "drop_options",
  "options": [
    "Plastic",
    "Steel",
    "Urea",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.98Z"),
  "created_at": ISODate("2016-11-11T12:41:47.98Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4709"),
  "lang": "it",
  "label": "Plug Type",
  "attr_id": 550,
  "type": "drop_options",
  "options": [
    "Schuko",
    "Spina inglese",
    "Americana 2 vie",
    "Spina francese",
    "Spina locale",
    "Americana 3 vie",
    "Connettore",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.99Z"),
  "created_at": ISODate("2016-11-11T12:41:47.99Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b470a"),
  "lang": "en",
  "label": "Plug Type",
  "attr_id": 550,
  "type": "drop_options",
  "options": [
    "Schuko",
    "UK Plug",
    "American - 2 Ways",
    "French Plug",
    "Local Plug",
    "American - 3 Ways",
    "Connector",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.100Z"),
  "created_at": ISODate("2016-11-11T12:41:47.100Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b470b"),
  "lang": "it",
  "label": "Shielding",
  "attr_id": 551,
  "type": "drop_options",
  "options": [
    "Ottica dark light",
    "Alveolare",
    "Batwing"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.101Z"),
  "created_at": ISODate("2016-11-11T12:41:47.101Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b470c"),
  "lang": "en",
  "label": "Shielding",
  "attr_id": 551,
  "type": "drop_options",
  "options": [
    "Dark Light Optics",
    "Alveolar",
    "Batwing"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.102Z"),
  "created_at": ISODate("2016-11-11T12:41:47.102Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b470d"),
  "lang": "it",
  "label": "Theater Light",
  "attr_id": 552,
  "type": "drop_options",
  "options": [
    "Effetti luce",
    "Effetti luce UV",
    "Luci strobo",
    "Illuminatori",
    "Illuminatori professionali",
    "Illuminatori da esterno",
    "Effetti laser",
    "Teste mobili",
    "Sfere a specchi",
    "Spot per sfere",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.103Z"),
  "created_at": ISODate("2016-11-11T12:41:47.103Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b470e"),
  "lang": "en",
  "label": "Theater Light",
  "attr_id": 552,
  "type": "drop_options",
  "options": [
    "Light Effects",
    "UV Light Effects",
    "Strobe Lights",
    "Illuminators",
    "Professional Lights",
    "Outdoor lights",
    "Laser Effects",
    "Moving Heads",
    "Mirror Balls",
    "Ball Spots",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.105Z"),
  "created_at": ISODate("2016-11-11T12:41:47.105Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b470f"),
  "lang": "it",
  "label": "Lighting - Type of Certification",
  "attr_id": 553,
  "type": "drop_options",
  "options": [
    "Certificazione TM",
    "Anti urto",
    "Impermeabile",
    "Subacquea",
    "Stagna",
    "ATEX",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.106Z"),
  "created_at": ISODate("2016-11-11T12:41:47.106Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4710"),
  "lang": "en",
  "label": "Lighting - Type of Certification",
  "attr_id": 553,
  "type": "drop_options",
  "options": [
    "TM Certification",
    "Shock Absorbent",
    "Waterproof",
    "Underwater",
    "Air-Tight",
    "ATEX",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.108Z"),
  "created_at": ISODate("2016-11-11T12:41:47.108Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4711"),
  "lang": "it",
  "label": "Socket Type",
  "attr_id": 554,
  "type": "drop_options",
  "options": [
    "Elettrica",
    "Telefonica",
    "Networking"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.109Z"),
  "created_at": ISODate("2016-11-11T12:41:47.109Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4712"),
  "lang": "en",
  "label": "Socket Type",
  "attr_id": 554,
  "type": "drop_options",
  "options": [
    "Electrical",
    "Phones",
    "Networking"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.110Z"),
  "created_at": ISODate("2016-11-11T12:41:47.110Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4713"),
  "lang": "it",
  "label": "Lighting Application",
  "attr_id": 555,
  "type": "drop_options",
  "options": [
    "Domestico interno",
    "Domestico esterno",
    "Industriale interno",
    "Industriale esterno",
    "Stradale ",
    "Ferroviario",
    "Aeroportuale",
    "Nautico",
    "Ospedaliero",
    "Commerciale interno",
    "Commerciale esterno",
    "Opere d'arte",
    "Teatro",
    "Intratenimento",
    "Automotive",
    "Hotel/Ristoranti/Bar",
    "Uffici",
    "Giardini pubblici",
    "Piscine",
    "Fontane",
    "Parchi",
    "Cinema",
    "Impianti sportivi",
    "Microlitografie",
    "Cura animali",
    "Medicale",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.112Z"),
  "created_at": ISODate("2016-11-11T12:41:47.112Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4714"),
  "lang": "en",
  "label": "Lighting Application",
  "attr_id": 555,
  "type": "drop_options",
  "options": [
    "Home-Indoor",
    "Home-Outdoor",
    "Industrial-Indoor",
    "Industrial-Outdoor",
    "Street Lights",
    "Railways",
    "Airports",
    "Nautical",
    "Hospitals",
    "Commercial-Indoor",
    "Commercial-Outdoor",
    "Works of art",
    "Theaters",
    "Entertainment",
    "Automotive",
    "Hotels/Restaurants/Bars",
    "Offices",
    "Public Gardens",
    "Swimming Pools",
    "Fountains",
    "Parks",
    "Cinemas",
    "Sport Facilities",
    "Microlithography",
    "Animal Care",
    "Medical",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.113Z"),
  "created_at": ISODate("2016-11-11T12:41:47.113Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4715"),
  "lang": "it",
  "label": "Reflector Type",
  "attr_id": 559,
  "type": "drop_options",
  "options": [
    "Spot",
    "Proiettori",
    "Riflettori",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.116Z"),
  "created_at": ISODate("2016-11-11T12:41:47.116Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4716"),
  "lang": "en",
  "label": "Reflector Type",
  "attr_id": 559,
  "type": "drop_options",
  "options": [
    "Spotlights",
    "Projectors",
    "Reflectors",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.118Z"),
  "created_at": ISODate("2016-11-11T12:41:47.118Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4717"),
  "lang": "it",
  "label": "Lighting - Product Type",
  "attr_id": 560,
  "type": "drop_options",
  "options": [
    "Frutta e verdura",
    "Formaggio, pane e pasticceria",
    "Carne e pesce",
    "Vino",
    "Freezer e cooler"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.120Z"),
  "created_at": ISODate("2016-11-11T12:41:47.120Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4718"),
  "lang": "en",
  "label": "Lighting - Product Type",
  "attr_id": 560,
  "type": "drop_options",
  "options": [
    "Fruits and Vegetables",
    "Cheese, Bread and Pastries",
    "Meat and Fish",
    "Wine",
    "Freezers and Coolers"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.122Z"),
  "created_at": ISODate("2016-11-11T12:41:47.122Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4719"),
  "lang": "it",
  "label": "Anti-shock Lighting",
  "attr_id": 561,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.123Z"),
  "created_at": ISODate("2016-11-11T12:41:47.123Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b471a"),
  "lang": "en",
  "label": "Anti-shock Lighting",
  "attr_id": 561,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.126Z"),
  "created_at": ISODate("2016-11-11T12:41:47.126Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b471b"),
  "lang": "it",
  "label": "Lighting - Design Type",
  "attr_id": 562,
  "type": "drop_options",
  "options": [
    "Tradizionale",
    "Vintage",
    "Moderno",
    "Designer",
    "Tecnico",
    "Decorativo"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.127Z"),
  "created_at": ISODate("2016-11-11T12:41:47.127Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b471c"),
  "lang": "en",
  "label": "Lighting - Design Type",
  "attr_id": 562,
  "type": "drop_options",
  "options": [
    "Traditional",
    "Vintage",
    "Modern",
    "Designer",
    "Technical",
    "Decorative"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.128Z"),
  "created_at": ISODate("2016-11-11T12:41:47.128Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b471d"),
  "lang": "it",
  "label": "Socket Material",
  "attr_id": 565,
  "type": "drop_options",
  "options": [
    "Plastica",
    "Acciaio",
    "Urea",
    "Altro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.129Z"),
  "created_at": ISODate("2016-11-11T12:41:47.129Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b471e"),
  "lang": "en",
  "label": "Socket Material",
  "attr_id": 565,
  "type": "drop_options",
  "options": [
    "Plastic",
    "Steel",
    "Urea",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.131Z"),
  "created_at": ISODate("2016-11-11T12:41:47.131Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b471f"),
  "lang": "it",
  "label": "Table Product: Single or Set",
  "attr_id": 566,
  "type": "drop_options",
  "options": [
    "Prodotto singolo",
    "Set 2 persone",
    "Set 4 persone",
    "Set 6 persone",
    "Set 8 persone",
    "Set 10 persone",
    "Set 12 persone",
    "Set 16 persone",
    "Set 24 persone",
    "Altri set"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.132Z"),
  "created_at": ISODate("2016-11-11T12:41:47.132Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4720"),
  "lang": "en",
  "label": "Table Product: Single or Set",
  "attr_id": 566,
  "type": "drop_options",
  "options": [
    "Single Product",
    "2 Person Set",
    "4 Person Set",
    "6 Person Set",
    "8 Person Set",
    "10 Person Set",
    "12 Person Set",
    "16 Person Set",
    "24 Person Set",
    "Other Sets"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.133Z"),
  "created_at": ISODate("2016-11-11T12:41:47.133Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4721"),
  "lang": "it",
  "label": "Paper Tablecloths/Napkins Decoration",
  "attr_id": 567,
  "type": "drop_options",
  "options": [
    "Colorati",
    "Monocolore",
    "Con figure",
    "Personalizzati"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.134Z"),
  "created_at": ISODate("2016-11-11T12:41:47.134Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4722"),
  "lang": "en",
  "label": "Paper Tablecloths/Napkins Decoration",
  "attr_id": 567,
  "type": "drop_options",
  "options": [
    "Colored",
    "Monocrome",
    "Printed",
    "Customized"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.136Z"),
  "created_at": ISODate("2016-11-11T12:41:47.136Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4723"),
  "lang": "it",
  "label": "Mast Type",
  "attr_id": 573,
  "type": "drop_options",
  "options": [
    "Simplex",
    "Duplex (no elevazione libera)",
    "Duplex (con alzata libera)",
    "Triplex",
    "Quadruplex"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.138Z"),
  "created_at": ISODate("2016-11-11T12:41:47.138Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4724"),
  "lang": "en",
  "label": "Mast Type",
  "attr_id": 573,
  "type": "drop_options",
  "options": [
    "Simplex",
    "Duplex (no free lift)",
    "Duplex (free lift)",
    "Triplex",
    "Quadruplex"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.140Z"),
  "created_at": ISODate("2016-11-11T12:41:47.140Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4725"),
  "lang": "it",
  "label": "Shipment",
  "attr_id": 574,
  "type": "drop_options",
  "options": [
    "Incluso",
    "Solo ritiro in sede",
    "Non incluso"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.141Z"),
  "created_at": ISODate("2016-11-11T12:41:47.141Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4726"),
  "lang": "en",
  "label": "Shipment",
  "attr_id": 574,
  "type": "drop_options",
  "options": [
    "Included",
    "Local pickup only",
    "Not included"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.148Z"),
  "created_at": ISODate("2016-11-11T12:41:47.148Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4727"),
  "lang": "it",
  "label": "Product Format",
  "attr_id": 576,
  "type": "drop_options",
  "options": [
    "Grani",
    "Pezzi",
    "Scaglie",
    "Ampolla",
    "Balsamo",
    "Capsule",
    "Crema",
    "Crema-polvere",
    "Gocce",
    "Schiuma",
    "Gel",
    "Liquido",
    "Polvere libera",
    "Lozione",
    "Spray senza gas",
    "Mousse",
    "Olio",
    "Pasta",
    "Matita",
    "Pomata",
    "Polvere pressata",
    "Rollerball",
    "Siero",
    "Shampoo",
    "Fogli",
    "Solido",
    "Spray",
    "Stick",
    "Compresse",
    "Cera",
    "Salviettine",
    "Altro formato prodotto"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.150Z"),
  "created_at": ISODate("2016-11-11T12:41:47.150Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4728"),
  "lang": "en",
  "label": "Product Format",
  "attr_id": 576,
  "type": "drop_options",
  "options": [
    "Grains",
    "Chunks",
    "Flakes",
    "Ampoule",
    "Balm",
    "Capsules",
    "Cream",
    "Cream-to-powder",
    "Drops",
    "Foam",
    "Gel",
    "Liquid",
    "Loose Powder",
    "Lotion",
    "Mist",
    "Mousse",
    "Oil",
    "Paste",
    "Pencil",
    "Pomade",
    "Pressed Powder",
    "Roll-on",
    "Serum",
    "Shampoo",
    "Sheets",
    "Solid",
    "Spray",
    "Stick",
    "Tablets",
    "Wax",
    "Wipes",
    "Other Product Format"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.153Z"),
  "created_at": ISODate("2016-11-11T12:41:47.153Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4729"),
  "lang": "it",
  "label": "Sculpting/Modeling Waxes Shape",
  "attr_id": 578,
  "type": "drop_options",
  "options": [
    "Tonda",
    "Rettangolare",
    "Mezza-tonda",
    "Lanceolata",
    "Altra forma"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.155Z"),
  "created_at": ISODate("2016-11-11T12:41:47.155Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b472a"),
  "lang": "en",
  "label": "Sculpting/Modeling Waxes Shape",
  "attr_id": 578,
  "type": "drop_options",
  "options": [
    "Round",
    "Rectangular",
    "Half-round",
    "Tapered ",
    "Other Shape"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.157Z"),
  "created_at": ISODate("2016-11-11T12:41:47.157Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b472b"),
  "lang": "it",
  "label": "Bit Shank Type",
  "attr_id": 579,
  "type": "drop_options",
  "options": [
    "Codolo cilindrico",
    "Codolo ridotto",
    "Codolo a piramide",
    "Codolo esagonale",
    "Codolo SDS-Plus",
    "Codolo SDS-Top",
    "Codolo SDS-Max",
    "Codolo triangolare",
    "Codolo conico Morse",
    "Codolo quadrato",
    "Codolo filettato",
    "Altro tipo di attacco"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.159Z"),
  "created_at": ISODate("2016-11-11T12:41:47.159Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b472c"),
  "lang": "en",
  "label": "Bit Shank Type",
  "attr_id": 579,
  "type": "drop_options",
  "options": [
    "Straight Shank",
    "Reduced-Shank",
    "Brace Shank",
    "Hex Shank",
    "SDS-Plus Shank",
    "SDS-Top Shank",
    "SDS-Max Shank",
    "Triangle Shank",
    "Morse Taper Shank",
    "Square Shank",
    "Threaded Shank",
    "Other Type of Shank"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.161Z"),
  "created_at": ISODate("2016-11-11T12:41:47.161Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b472d"),
  "lang": "it",
  "label": "Mineralogical Class",
  "attr_id": 580,
  "type": "drop_options",
  "options": [
    "Elementi nativi",
    "Solfuri (e solfosali)",
    "Alogenuri",
    "Ossidi e idrossidi",
    "Carbonati, nitrati e borati",
    "Solfati, cromati, molibdati e wolframati",
    "Fosfati, arseniati e vanadati",
    "Silicati",
    "Complessi organici"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.162Z"),
  "created_at": ISODate("2016-11-11T12:41:47.162Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b472e"),
  "lang": "en",
  "label": "Mineralogical Class",
  "attr_id": 580,
  "type": "drop_options",
  "options": [
    "Native Elements",
    "Sulfides",
    "Halides",
    "Oxides and Hydroxides",
    "Carbonates, Nitrates and Borates",
    "Sulfates, Chromates, Molybdates and Tungstates",
    "Phosphates, Arsenates and Vanadates",
    "Silicates",
    "Organic Minerals"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.163Z"),
  "created_at": ISODate("2016-11-11T12:41:47.163Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b472f"),
  "lang": "it",
  "label": "Hardness",
  "attr_id": 581,
  "type": "drop_options",
  "options": [
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    9,
    10
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.165Z"),
  "created_at": ISODate("2016-11-11T12:41:47.165Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4730"),
  "lang": "en",
  "label": "Hardness",
  "attr_id": 581,
  "type": "drop_options",
  "options": [
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    9,
    10
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.166Z"),
  "created_at": ISODate("2016-11-11T12:41:47.166Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4731"),
  "lang": "it",
  "label": "Paint Finish",
  "attr_id": 582,
  "type": "drop_options",
  "options": [
    "Opaca",
    "Guscio d'uovo",
    "Perlata",
    "Satinata",
    "Semilucida",
    "Lucida"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.168Z"),
  "created_at": ISODate("2016-11-11T12:41:47.168Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4732"),
  "lang": "en",
  "label": "Paint Finish",
  "attr_id": 582,
  "type": "drop_options",
  "options": [
    "Flat/Matte",
    "Eggshell",
    "Pearl",
    "Satin",
    "Semiglos",
    "Gloss"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.169Z"),
  "created_at": ISODate("2016-11-11T12:41:47.169Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4733"),
  "lang": "it",
  "label": "Paint Base",
  "attr_id": 583,
  "type": "drop_options",
  "options": [
    "Base acqua",
    "Base solvente",
    "Olio",
    "Altra base"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.171Z"),
  "created_at": ISODate("2016-11-11T12:41:47.171Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4734"),
  "lang": "en",
  "label": "Paint Base",
  "attr_id": 583,
  "type": "drop_options",
  "options": [
    "Water-Based",
    "Solvent-Based",
    "Oil",
    "Other Paint Base"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.173Z"),
  "created_at": ISODate("2016-11-11T12:41:47.173Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4735"),
  "lang": "it",
  "label": "Paint Suitable for",
  "attr_id": 587,
  "type": "drop_options",
  "options": [
    "Interno",
    "Esterno",
    "Entrambi"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.174Z"),
  "created_at": ISODate("2016-11-11T12:41:47.174Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4736"),
  "lang": "en",
  "label": "Paint Suitable for",
  "attr_id": 587,
  "type": "drop_options",
  "options": [
    "Interior",
    "Exterior",
    "Both"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.176Z"),
  "created_at": ISODate("2016-11-11T12:41:47.176Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4737"),
  "lang": "it",
  "label": "Base Resin",
  "attr_id": 589,
  "type": "drop_options",
  "options": [
    "Naturale",
    "Acrilica",
    "Siliconica",
    "Epossidica",
    "Idrocarbonica",
    "Fossile",
    "Altro tipo di resina"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.177Z"),
  "created_at": ISODate("2016-11-11T12:41:47.177Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4738"),
  "lang": "en",
  "label": "Base Resin",
  "attr_id": 589,
  "type": "drop_options",
  "options": [
    "Natural",
    "Acrylic",
    "Silicon",
    "Epoxy",
    "Hydrocarbon",
    "Fossil",
    "Other Type of Resin"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.178Z"),
  "created_at": ISODate("2016-11-11T12:41:47.178Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4739"),
  "lang": "it",
  "label": "Saw Type",
  "attr_id": 591,
  "type": "drop_options",
  "options": [
    "A ponte",
    "Fissa",
    "Portatile"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.180Z"),
  "created_at": ISODate("2016-11-11T12:41:47.180Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b473a"),
  "lang": "en",
  "label": "Saw Type",
  "attr_id": 591,
  "type": "drop_options",
  "options": [
    "Gantry",
    "Stationary",
    "Portable"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.182Z"),
  "created_at": ISODate("2016-11-11T12:41:47.182Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b473b"),
  "lang": "it",
  "label": "Machine for",
  "attr_id": 592,
  "type": "drop_options",
  "options": [
    "Granito",
    "Marmo",
    "Granito e marmo",
    "Altre pietre naturali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.183Z"),
  "created_at": ISODate("2016-11-11T12:41:47.183Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b473c"),
  "lang": "en",
  "label": "Machine for",
  "attr_id": 592,
  "type": "drop_options",
  "options": [
    "Granite",
    "Marble",
    "Granite and Marble",
    "Other Natural Stones"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.184Z"),
  "created_at": ISODate("2016-11-11T12:41:47.184Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b473d"),
  "lang": "it",
  "label": "Wine Machine for",
  "attr_id": 593,
  "type": "drop_options",
  "options": [
    "Vino rosso",
    "Vino bianco",
    "Vino novello",
    "Vino rosato",
    "Vino moscato",
    "Spumante/Champagne",
    "Tutti i vini"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.186Z"),
  "created_at": ISODate("2016-11-11T12:41:47.186Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b473e"),
  "lang": "en",
  "label": "Wine Machine for",
  "attr_id": 593,
  "type": "drop_options",
  "options": [
    "Red Wine",
    "White Wine",
    "New Wine",
    "Rosé Wine",
    "Muscat Wine",
    "Sparkling Wine",
    "All Wines"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.187Z"),
  "created_at": ISODate("2016-11-11T12:41:47.187Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b473f"),
  "lang": "it",
  "label": "Blooming Months",
  "attr_id": 594,
  "type": "drop_options",
  "options": [
    "Gennaio",
    "Febbraio",
    "Marzo",
    "Aprile",
    "Maggio",
    "Giugno",
    "Luglio",
    "Agosto",
    "Settembre",
    "Ottobre",
    "Novembre",
    "Dicembre"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.188Z"),
  "created_at": ISODate("2016-11-11T12:41:47.188Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4740"),
  "lang": "en",
  "label": "Blooming Months",
  "attr_id": 594,
  "type": "drop_options",
  "options": [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.190Z"),
  "created_at": ISODate("2016-11-11T12:41:47.190Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4743"),
  "lang": "it",
  "label": "Return Accepted Within (days)",
  "attr_id": 599,
  "type": "drop_options",
  "options": [
    14,
    30,
    60,
    90
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.196Z"),
  "created_at": ISODate("2016-11-11T12:41:47.196Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4744"),
  "lang": "en",
  "label": "Return Accepted Within (days)",
  "attr_id": 599,
  "type": "drop_options",
  "options": [
    14,
    30,
    60,
    90
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.198Z"),
  "created_at": ISODate("2016-11-11T12:41:47.198Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4745"),
  "lang": "it",
  "label": "Return Shipment Expenses",
  "attr_id": 602,
  "type": "drop_options",
  "options": [
    "Acquirente",
    "Venditore"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.200Z"),
  "created_at": ISODate("2016-11-11T12:41:47.200Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4746"),
  "lang": "en",
  "label": "Return Shipment Expenses",
  "attr_id": 602,
  "type": "drop_options",
  "options": [
    "Buyer",
    "Seller"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.201Z"),
  "created_at": ISODate("2016-11-11T12:41:47.201Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4747"),
  "lang": "it",
  "label": "Purchase Type",
  "attr_id": 606,
  "type": "drop_options",
  "options": [
    "Acquisto",
    "Richiesta d'affitto",
    "Asta inversa"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.203Z"),
  "created_at": ISODate("2016-11-11T12:41:47.203Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4748"),
  "lang": "en",
  "label": "Purchase Type",
  "attr_id": 606,
  "type": "drop_options",
  "options": [
    "To Buy",
    "To Rent",
    "Reverse Auction"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.205Z"),
  "created_at": ISODate("2016-11-11T12:41:47.205Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4749"),
  "lang": "it",
  "label": "Terminal Block Connection Type",
  "attr_id": 614,
  "type": "drop_options",
  "options": [
    "Morsetti con seraggio a vite (poliammide)",
    "Morsetti con seraggio a vite (melammina)",
    "Morsetti con seraggio a molla",
    "Morsetti con connessione ad incisione d'isolante",
    "Morsetti Push-in",
    "Altro tipo di attacco morsetti"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.207Z"),
  "created_at": ISODate("2016-11-11T12:41:47.207Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b474a"),
  "lang": "en",
  "label": "Terminal Block Connection Type",
  "attr_id": 614,
  "type": "drop_options",
  "options": [
    "Screw-Clamp Terminal Blocks (Polyamide)",
    "Screw-Clamp Terminal Blocks (Melamine)",
    "Spring-Clamp Terminal Blocks",
    "Insulation Displacement Connection Terminal Blocks",
    "Push-In Terminal Blocks",
    "Other Terminal Block Connection Type"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.208Z"),
  "created_at": ISODate("2016-11-11T12:41:47.208Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b474b"),
  "lang": "it",
  "label": "Automatic Calibration",
  "attr_id": 618,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.211Z"),
  "created_at": ISODate("2016-11-11T12:41:47.211Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b474c"),
  "lang": "en",
  "label": "Automatic Calibration",
  "attr_id": 618,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.213Z"),
  "created_at": ISODate("2016-11-11T12:41:47.213Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b474d"),
  "lang": "it",
  "label": "Fitting Type",
  "attr_id": 619,
  "type": "drop_options",
  "options": [
    "E27",
    "E14",
    "B22",
    "Goliath",
    "Lilliput",
    "Tuttovetro (Glassocket)",
    "Bipin",
    "Faston",
    "B14",
    "B24",
    "E26",
    "E40",
    "GU10",
    "Midget Flanged",
    "Prefocus",
    "Altro tipo di attacco (specificare nella \"Descrizione\")"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.214Z"),
  "created_at": ISODate("2016-11-11T12:41:47.214Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b474e"),
  "lang": "en",
  "label": "Fitting Type",
  "attr_id": 619,
  "type": "drop_options",
  "options": [
    "E27",
    "E14",
    "B22",
    "Goliath",
    "Lilliput",
    "Wedge",
    "Bipin",
    "Faston",
    "B14",
    "B24",
    "E26",
    "E40",
    "GU10",
    "Midget Flanged",
    "Prefocus",
    "Other Fitting Type (pls specify in \"Description\")"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.216Z"),
  "created_at": ISODate("2016-11-11T12:41:47.216Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b474f"),
  "lang": "it",
  "label": "Material Properties",
  "attr_id": 620,
  "type": "drop_options",
  "options": [
    "Resistente agli agenti atmosferici",
    "Resistente all'acqua",
    "Resistente al fuoco",
    "Resistente alle intemperie",
    "Impermeabile",
    "Antiruggine",
    "Antisismico",
    "Antimacchia",
    "Antiproiettile",
    "Resistente ai raggi UV ",
    "Anticorrosione",
    "Resistente alle sostanze chimiche ",
    "Resistenza termica",
    "Resistente agli urti",
    "Resistenza alla condensa"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.217Z"),
  "created_at": ISODate("2016-11-11T12:41:47.217Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4750"),
  "lang": "en",
  "label": "Material Properties",
  "attr_id": 620,
  "type": "drop_options",
  "options": [
    "Weather-Resistant",
    "Water-Resistant",
    "Fire-Resistant",
    "Weatherproof",
    "Waterproof",
    "Rust-Resistant",
    "Earthquake Resistant",
    "Stain-Resistant",
    "Bulletproof ",
    "UV Resistant",
    "Corrosion Resistant",
    "Chemical-Resistant",
    "Thermal Resistance",
    "Impact Resistant",
    "Condensation Resistance"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.218Z"),
  "created_at": ISODate("2016-11-11T12:41:47.218Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4751"),
  "lang": "it",
  "label": "Connector Type",
  "attr_id": 623,
  "type": "drop_options",
  "options": [
    "Maschio",
    "Femmina",
    "Maschio/Femmina",
    "Normale"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.220Z"),
  "created_at": ISODate("2016-11-11T12:41:47.220Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4752"),
  "lang": "en",
  "label": "Connector Type",
  "attr_id": 623,
  "type": "drop_options",
  "options": [
    "Male",
    "Female",
    "Male/Female",
    "Normal"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.221Z"),
  "created_at": ISODate("2016-11-11T12:41:47.221Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4753"),
  "lang": "it",
  "label": "Content - measurement unit",
  "attr_id": 625,
  "type": "drop_options",
  "options": [
    "cl",
    "ml",
    "fl. oz",
    "gr",
    "oz",
    "l",
    "gal",
    "kg",
    "lb",
    "cc"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.223Z"),
  "created_at": ISODate("2016-11-11T12:41:47.223Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4754"),
  "lang": "en",
  "label": "Content - measurement unit",
  "attr_id": 625,
  "type": "drop_options",
  "options": [
    "cl",
    "ml",
    "fl. oz",
    "gr",
    "oz",
    "l",
    "gal",
    "kg",
    "lb",
    "cc"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.224Z"),
  "created_at": ISODate("2016-11-11T12:41:47.224Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4755"),
  "lang": "it",
  "label": "Type of Current",
  "attr_id": 627,
  "type": "drop_options",
  "options": [
    "Continua",
    "Alternata"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.225Z"),
  "created_at": ISODate("2016-11-11T12:41:47.225Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4756"),
  "lang": "en",
  "label": "Type of Current",
  "attr_id": 627,
  "type": "drop_options",
  "options": [
    "Direct (DC)",
    "Alternating (AC)"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.226Z"),
  "created_at": ISODate("2016-11-11T12:41:47.226Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4757"),
  "lang": "it",
  "label": "Illumination Color Temperature",
  "attr_id": 628,
  "type": "drop_options",
  "options": [
    "Calda",
    "Fredda",
    "Naturale"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.228Z"),
  "created_at": ISODate("2016-11-11T12:41:47.228Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4758"),
  "lang": "en",
  "label": "Illumination Color Temperature",
  "attr_id": 628,
  "type": "drop_options",
  "options": [
    "Warm",
    "Cool",
    "Natural"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.229Z"),
  "created_at": ISODate("2016-11-11T12:41:47.229Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4759"),
  "lang": "it",
  "label": "Wastewater Treatment Applications",
  "attr_id": 631,
  "type": "drop_options",
  "options": [
    "Acque di scarico comunali",
    "Industria alimentare",
    "Riciclaggio acqua",
    "Industria tessile",
    "Alto contenuto di olio",
    "Industria confezionamento",
    "Industria ittica ",
    "Acque di processo industriali",
    "Industria cartaria",
    "Industria carne e derivati",
    "Industria metallurgica",
    "Industria edile",
    "Acqua potabile",
    "Industria lattiero-casearia",
    "Chimica e farmaceutica",
    "Trattamento fanghi",
    "Altre applicazioni"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.230Z"),
  "created_at": ISODate("2016-11-11T12:41:47.230Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b475a"),
  "lang": "en",
  "label": "Wastewater Treatment Applications",
  "attr_id": 631,
  "type": "drop_options",
  "options": [
    "Municipal Wastewater",
    "Food Industry",
    "Water Recycling",
    "Textile Industry",
    "High Oil Content",
    "Canning Industry",
    "Fish Industry",
    "Industrial Process Water",
    "Paper Industry",
    "Meat and Derived Industry",
    "Metallurgical Industry",
    "Construction Industry",
    "Drinking Water",
    "Milk Industry",
    "Chemical and Pharmaceutical",
    "Sludge Treatment",
    "Other Applications"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.232Z"),
  "created_at": ISODate("2016-11-11T12:41:47.232Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b475b"),
  "lang": "it",
  "label": "Filter Type",
  "attr_id": 638,
  "type": "drop_options",
  "options": [
    "Orizzontali",
    "Verticali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.233Z"),
  "created_at": ISODate("2016-11-11T12:41:47.233Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b475c"),
  "lang": "en",
  "label": "Filter Type",
  "attr_id": 638,
  "type": "drop_options",
  "options": [
    "Horizontal",
    "Vertical"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.234Z"),
  "created_at": ISODate("2016-11-11T12:41:47.234Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b475d"),
  "lang": "it",
  "label": "Measuring Principle",
  "attr_id": 639,
  "type": "drop_options",
  "options": [
    "Dispersione termica",
    "Filo caldo",
    "Pistone oscillante",
    "Pistoni rotanti",
    "Turbina",
    "Disco oscillante",
    "Elettromagnetico",
    "Elettromagnetico/ultrasuoni",
    "Ingranaggi",
    "Massico",
    "Termico a filo caldo",
    "Termico con tecnologia MEMS",
    "Ultrasuoni",
    "Volumetrico",
    "Vortice",
    "Altro principio di misura"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.236Z"),
  "created_at": ISODate("2016-11-11T12:41:47.236Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b475e"),
  "lang": "en",
  "label": "Measuring Principle",
  "attr_id": 639,
  "type": "drop_options",
  "options": [
    "Thermal Dispersion",
    "Hot Wire",
    "Oscillating Piston",
    "Rotary Pistons",
    "Turbine",
    "Nutating Disk",
    "Electromagnetic",
    "Electromagnetic/Ultrasonic",
    "Gears",
    "Mass Flow",
    "Hot Wire Thermal",
    "Thermal with MEMS Technology",
    "Ultrasonic",
    "Volumetric",
    "Vortex",
    "Other Measuring Principle"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.239Z"),
  "created_at": ISODate("2016-11-11T12:41:47.239Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b475f"),
  "lang": "it",
  "label": "Recycled",
  "attr_id": 641,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.241Z"),
  "created_at": ISODate("2016-11-11T12:41:47.241Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4760"),
  "lang": "en",
  "label": "Recycled",
  "attr_id": 641,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.242Z"),
  "created_at": ISODate("2016-11-11T12:41:47.242Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4761"),
  "lang": "it",
  "label": "Paper size",
  "attr_id": 642,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.244Z"),
  "created_at": ISODate("2016-11-11T12:41:47.244Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4762"),
  "lang": "en",
  "label": "Paper size",
  "attr_id": 642,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.245Z"),
  "created_at": ISODate("2016-11-11T12:41:47.245Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4763"),
  "lang": "it",
  "label": "Point Type",
  "attr_id": 651,
  "type": "drop_options",
  "options": [
    "Extra larga",
    "Larga",
    "Conica",
    "Media",
    "Fine",
    "Extra Fine",
    "Micro",
    "Ultra Micro",
    "Ago",
    "Pennello",
    "Altri tipi di punta"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.247Z"),
  "created_at": ISODate("2016-11-11T12:41:47.247Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4764"),
  "lang": "en",
  "label": "Point Type",
  "attr_id": 651,
  "type": "drop_options",
  "options": [
    "Extra Bold",
    "Bold",
    "Conical",
    "Medium",
    "Fine",
    "Extra Fine",
    "Micro",
    "Ultra Micro",
    "Needle",
    "Brush",
    "Other Point Type"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.248Z"),
  "created_at": ISODate("2016-11-11T12:41:47.248Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4765"),
  "lang": "it",
  "label": "Lid Type",
  "attr_id": 661,
  "type": "drop_options",
  "options": [
    "Apertura a libro",
    "Intero"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.249Z"),
  "created_at": ISODate("2016-11-11T12:41:47.249Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4766"),
  "lang": "en",
  "label": "Lid Type",
  "attr_id": 661,
  "type": "drop_options",
  "options": [
    "Half Couch",
    "Full Couch"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.257Z"),
  "created_at": ISODate("2016-11-11T12:41:47.257Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4767"),
  "lang": "it",
  "label": "Wood Exterior Type",
  "attr_id": 662,
  "type": "drop_options",
  "options": [
    "Senza finitura",
    "Naturale",
    "Verniciato",
    "Laminato",
    "Ricoperto di tessuto",
    "Sbiancata"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.259Z"),
  "created_at": ISODate("2016-11-11T12:41:47.259Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4768"),
  "lang": "en",
  "label": "Wood Exterior Type",
  "attr_id": 662,
  "type": "drop_options",
  "options": [
    "Unfinished",
    "Natural",
    "Painted",
    "Laminate",
    "Cloth Covered",
    "Limed"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.261Z"),
  "created_at": ISODate("2016-11-11T12:41:47.261Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4769"),
  "lang": "it",
  "label": "Wood Finish",
  "attr_id": 663,
  "type": "drop_options",
  "options": [
    "Lucida",
    "Semi-lucida",
    "Opaca",
    "Laccata",
    "Cera d'api",
    "Olio naturale",
    "Satinata"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.264Z"),
  "created_at": ISODate("2016-11-11T12:41:47.264Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b476a"),
  "lang": "en",
  "label": "Wood Finish",
  "attr_id": 663,
  "type": "drop_options",
  "options": [
    "Polished (or gloss) Finish",
    "Semi-Gloss Finish",
    "Matte (or flat) Finish",
    "Lacquered Finish",
    "Beeswax Finish",
    "Natural Oil Finish",
    "Satin Finish"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.265Z"),
  "created_at": ISODate("2016-11-11T12:41:47.265Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b476b"),
  "lang": "it",
  "label": "Steel Gauge",
  "attr_id": 664,
  "type": "drop_options",
  "options": [
    "Calibro 16",
    "Calibro 18",
    "Calibro 20",
    "Calibro 22",
    "Altro calibro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.266Z"),
  "created_at": ISODate("2016-11-11T12:41:47.266Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b476c"),
  "lang": "en",
  "label": "Steel Gauge",
  "attr_id": 664,
  "type": "drop_options",
  "options": [
    "16-Gauge ",
    "18-Gauge",
    "20-Gauge",
    "22-Gauge",
    "Other Gauge"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.268Z"),
  "created_at": ISODate("2016-11-11T12:41:47.268Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b476d"),
  "lang": "it",
  "label": "Copper/Bronze Ounce",
  "attr_id": 665,
  "type": "drop_options",
  "options": [
    "32 once",
    "34 once",
    "Altre once"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.269Z"),
  "created_at": ISODate("2016-11-11T12:41:47.269Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b476e"),
  "lang": "en",
  "label": "Copper/Bronze Ounce",
  "attr_id": 665,
  "type": "drop_options",
  "options": [
    "32-Ounce",
    "34-Ounce",
    "Other Ounce"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.270Z"),
  "created_at": ISODate("2016-11-11T12:41:47.270Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b476f"),
  "lang": "it",
  "label": "Metal Finish",
  "attr_id": 666,
  "type": "drop_options",
  "options": [
    "Spazzolato",
    "Placcato",
    "Spruzzato"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.272Z"),
  "created_at": ISODate("2016-11-11T12:41:47.272Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4770"),
  "lang": "en",
  "label": "Metal Finish",
  "attr_id": 666,
  "type": "drop_options",
  "options": [
    "Brushed",
    "Plated",
    "Sprayed"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.274Z"),
  "created_at": ISODate("2016-11-11T12:41:47.274Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4771"),
  "lang": "it",
  "label": "Tipo di finitura spruzzata metallo",
  "attr_id": "666; 3",
  "type": "drop_options",
  "options": [
    "Lucida",
    "Testurizzata",
    "Martellata",
    "Opaca"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.276Z"),
  "created_at": ISODate("2016-11-11T12:41:47.276Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4772"),
  "lang": "en",
  "label": "Tipo di finitura spruzzata metallo",
  "attr_id": "666; 3",
  "type": "drop_options",
  "options": [
    "Polished (gloss) Finish",
    "Crinkled Finish",
    "Hammertone Finish",
    "Matte (or flat) Finish"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.278Z"),
  "created_at": ISODate("2016-11-11T12:41:47.278Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4773"),
  "lang": "it",
  "label": "Type of Fiberglass and Polymer Finish",
  "attr_id": 667,
  "type": "drop_options",
  "options": [
    "Finto legno",
    "Lucida",
    "Spruzzato (finitura)"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.281Z"),
  "created_at": ISODate("2016-11-11T12:41:47.281Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4774"),
  "lang": "en",
  "label": "Type of Fiberglass and Polymer Finish",
  "attr_id": 667,
  "type": "drop_options",
  "options": [
    "Wood Grained Finish",
    "Polish (gloss) Finish",
    "Sprayed Finish"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.282Z"),
  "created_at": ISODate("2016-11-11T12:41:47.282Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4775"),
  "lang": "it",
  "label": "Coffin/Casket Liner Specs",
  "attr_id": 668,
  "type": "drop_options",
  "options": [
    "Resistente alle perforazioni",
    "Resistenete alle perdite"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.283Z"),
  "created_at": ISODate("2016-11-11T12:41:47.283Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4776"),
  "lang": "en",
  "label": "Coffin/Casket Liner Specs",
  "attr_id": 668,
  "type": "drop_options",
  "options": [
    "Puncture-resistant",
    "Leak-proof"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.285Z"),
  "created_at": ISODate("2016-11-11T12:41:47.285Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4777"),
  "lang": "it",
  "label": "Creamation Urns/Ash Caskets Type",
  "attr_id": 669,
  "type": "drop_options",
  "options": [
    "Tubo",
    "Urna",
    "Scrigno",
    "Piccole dimensioni",
    "A libro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.286Z"),
  "created_at": ISODate("2016-11-11T12:41:47.286Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4778"),
  "lang": "en",
  "label": "Creamation Urns/Ash Caskets Type",
  "attr_id": 669,
  "type": "drop_options",
  "options": [
    "Ash Scatter Tube",
    "Cremation Urn",
    "Ash Casket",
    "Keepsake Urn",
    "Book Urn"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.288Z"),
  "created_at": ISODate("2016-11-11T12:41:47.288Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4779"),
  "lang": "it",
  "label": "Gravestones/Monuments/Statues Material",
  "attr_id": 670,
  "type": "drop_options",
  "options": [
    "Granito",
    "Bronzo",
    "Marmo",
    "Arenaria",
    "Acciaio inox",
    "Roccia calcarea",
    "Pietra locale",
    "Pietra ollare",
    "Legno",
    "Cemento",
    "Ghisa",
    "Ardesia",
    "Bronzo bianco",
    "Fibra di vetro",
    "Altri"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.290Z"),
  "created_at": ISODate("2016-11-11T12:41:47.290Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b477a"),
  "lang": "en",
  "label": "Gravestones/Monuments/Statues Material",
  "attr_id": 670,
  "type": "drop_options",
  "options": [
    "Granite",
    "Bronze",
    "Marble",
    "Sandstone",
    "Stainless Steel",
    "Limestone",
    "Fieldstone",
    "Soapstone",
    "Wood",
    "Cement",
    "Cast Iron",
    "Slate",
    "White Bronze",
    "Fiberglass",
    "Other"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.292Z"),
  "created_at": ISODate("2016-11-11T12:41:47.292Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b477b"),
  "lang": "it",
  "label": "Type of Monument Top Shape",
  "attr_id": 671,
  "type": "drop_options",
  "options": [
    "Dritto",
    "Ovale",
    "Ondulato",
    "A Punta",
    "A tetto",
    "Forme speciali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.295Z"),
  "created_at": ISODate("2016-11-11T12:41:47.295Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b477c"),
  "lang": "en",
  "label": "Type of Monument Top Shape",
  "attr_id": 671,
  "type": "drop_options",
  "options": [
    "Straight",
    "Oval",
    "Serpentine",
    "Apex",
    "Ridge",
    "Special Shape"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.297Z"),
  "created_at": ISODate("2016-11-11T12:41:47.297Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b477d"),
  "lang": "it",
  "label": "Type of Monument Ends Shape",
  "attr_id": 672,
  "type": "drop_options",
  "options": [
    "Dritto",
    "Concavo",
    "Convesso",
    "Conico (più larga alla base)",
    "Cono rovesciato (più stretta alla base)",
    "Forme speciali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.298Z"),
  "created_at": ISODate("2016-11-11T12:41:47.298Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b477e"),
  "lang": "en",
  "label": "Type of Monument Ends Shape",
  "attr_id": 672,
  "type": "drop_options",
  "options": [
    "Straight",
    "Concave",
    "Convex",
    "Tapered",
    "Reverse tapered",
    "Special Shape"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.301Z"),
  "created_at": ISODate("2016-11-11T12:41:47.301Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b477f"),
  "lang": "it",
  "label": "Gravestone/Statue - Type of production",
  "attr_id": 673,
  "type": "drop_options",
  "options": [
    "Industriale",
    "Artigianale"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.304Z"),
  "created_at": ISODate("2016-11-11T12:41:47.304Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4780"),
  "lang": "en",
  "label": "Gravestone/Statue - Type of production",
  "attr_id": 673,
  "type": "drop_options",
  "options": [
    "Mass produced",
    "Handcrafted"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.306Z"),
  "created_at": ISODate("2016-11-11T12:41:47.306Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4781"),
  "lang": "it",
  "label": "Thickness - measurement unit",
  "attr_id": 675,
  "type": "drop_options",
  "options": [
    "cm",
    "mm",
    "Micrometro (micron)",
    "ft",
    "in"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.308Z"),
  "created_at": ISODate("2016-11-11T12:41:47.308Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4782"),
  "lang": "en",
  "label": "Thickness - measurement unit",
  "attr_id": 675,
  "type": "drop_options",
  "options": [
    "cm",
    "mm",
    "Micrometer (micron)",
    "ft",
    "in"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.310Z"),
  "created_at": ISODate("2016-11-11T12:41:47.310Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4783"),
  "lang": "it",
  "label": "Age Range",
  "attr_id": 678,
  "type": "drop_options",
  "options": [
    "0-6 mesi",
    "6-12 mesi",
    "12-18 mesi",
    "18-24 mesi",
    "2-3 anni",
    "3-4 anni",
    "4-5 anni",
    "5-6 anni",
    "6-9 anni",
    "9-12 anni",
    "13+ anni",
    "Adulti",
    "Tutte le età"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.311Z"),
  "created_at": ISODate("2016-11-11T12:41:47.311Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4784"),
  "lang": "en",
  "label": "Age Range",
  "attr_id": 678,
  "type": "drop_options",
  "options": [
    "0-6 months",
    "6-12 months",
    "12-18 months",
    "18-24 months",
    "2-3 years",
    "3-4 years",
    "4-5 years",
    "5-6 years",
    "6-9 years",
    "9-12 years",
    "13+ years",
    "Adult",
    "All ages"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.313Z"),
  "created_at": ISODate("2016-11-11T12:41:47.313Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4785"),
  "lang": "it",
  "label": "Bed End Style",
  "attr_id": 679,
  "type": "drop_options",
  "options": [
    "Curvilinea",
    "Doghe",
    "Pannello"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.315Z"),
  "created_at": ISODate("2016-11-11T12:41:47.315Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4786"),
  "lang": "en",
  "label": "Bed End Style",
  "attr_id": 679,
  "type": "drop_options",
  "options": [
    "Curved",
    "Slat",
    "Panel"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.316Z"),
  "created_at": ISODate("2016-11-11T12:41:47.316Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4787"),
  "lang": "it",
  "label": "Entrance Type",
  "attr_id": 680,
  "type": "drop_options",
  "options": [
    "Scaletta inclinata",
    "Scalini",
    "Scaletta dritta"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.317Z"),
  "created_at": ISODate("2016-11-11T12:41:47.317Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4788"),
  "lang": "en",
  "label": "Entrance Type",
  "attr_id": 680,
  "type": "drop_options",
  "options": [
    "Angle Ladder",
    "Staircase",
    "Straight Ladder"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.319Z"),
  "created_at": ISODate("2016-11-11T12:41:47.319Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4789"),
  "lang": "it",
  "label": "Bunks Options",
  "attr_id": 681,
  "type": "drop_options",
  "options": [
    "Scivolo",
    "Tende",
    "Tende parte superiore",
    "Libreria",
    "Cassettiera"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.320Z"),
  "created_at": ISODate("2016-11-11T12:41:47.320Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b478a"),
  "lang": "en",
  "label": "Bunks Options",
  "attr_id": 681,
  "type": "drop_options",
  "options": [
    "Slide",
    "Curtains",
    "Top-Tents",
    "Bookcase",
    "Dresser"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.322Z"),
  "created_at": ISODate("2016-11-11T12:41:47.322Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b478b"),
  "lang": "it",
  "label": "Entrance Location",
  "attr_id": 682,
  "type": "drop_options",
  "options": [
    "Alla fine",
    "Davanti"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.324Z"),
  "created_at": ISODate("2016-11-11T12:41:47.324Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b478c"),
  "lang": "en",
  "label": "Entrance Location",
  "attr_id": 682,
  "type": "drop_options",
  "options": [
    "End",
    "Front"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.325Z"),
  "created_at": ISODate("2016-11-11T12:41:47.325Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b478d"),
  "lang": "it",
  "label": "Book Format",
  "attr_id": 683,
  "type": "drop_options",
  "options": [
    "Audiobook",
    "Ebook",
    "Economici/tascabili",
    "Set con scatola",
    "Libri a grandi caratteri",
    "Braille",
    "Copertina dura",
    "Libri di stoffa",
    "Altri formati libro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.326Z"),
  "created_at": ISODate("2016-11-11T12:41:47.326Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b478e"),
  "lang": "en",
  "label": "Book Format",
  "attr_id": 683,
  "type": "drop_options",
  "options": [
    "Audiobooks",
    "Ebooks",
    "Paperback",
    "Boxed Sets",
    "Large Print Books",
    "Braille",
    "Hardcover",
    "Soft Books",
    "Other Book Format"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.327Z"),
  "created_at": ISODate("2016-11-11T12:41:47.327Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b478f"),
  "lang": "it",
  "label": "Type of Book",
  "attr_id": 684,
  "type": "drop_options",
  "options": [
    "Dizionari, enciclopedie e manuali",
    "Narrativa",
    "Saggistica",
    "Poesia",
    "Teatro",
    "Illustrazioni",
    "Cataloghi e raccolte",
    "Monografia",
    "Periodici/Annuari",
    "Atlanti e carte",
    "Guide",
    "Codici",
    "Libri di testo",
    "Riviste e giornali",
    "Testi generali",
    "Altro tipo di libro"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.329Z"),
  "created_at": ISODate("2016-11-11T12:41:47.329Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4790"),
  "lang": "en",
  "label": "Type of Book",
  "attr_id": 684,
  "type": "drop_options",
  "options": [
    "Reference Book/Manual",
    "Fiction",
    "Non-Fiction",
    "Poetry",
    "Theatre",
    "Picture Book",
    "Catalogs/Collections",
    "Monograph",
    "Journals/Yearbooks",
    "Atlases/Maps",
    "Guides",
    "Codes",
    "Textbooks",
    "Magazines/Newspapers",
    "General Book",
    "Other Type of Book"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.331Z"),
  "created_at": ISODate("2016-11-11T12:41:47.331Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4791"),
  "lang": "it",
  "label": "Music Format",
  "attr_id": 691,
  "type": "drop_options",
  "options": [
    "Vinile",
    "CD",
    "MP3",
    "Altro formato musica"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.332Z"),
  "created_at": ISODate("2016-11-11T12:41:47.332Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4792"),
  "lang": "en",
  "label": "Music Format",
  "attr_id": 691,
  "type": "drop_options",
  "options": [
    "Vinile",
    "CD",
    "MP3",
    "Other Music Format"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.334Z"),
  "created_at": ISODate("2016-11-11T12:41:47.334Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4793"),
  "lang": "it",
  "label": "Recording Type",
  "attr_id": 692,
  "type": "drop_options",
  "options": [
    "Studio",
    "Live"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.335Z"),
  "created_at": ISODate("2016-11-11T12:41:47.335Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4794"),
  "lang": "en",
  "label": "Recording Type",
  "attr_id": 692,
  "type": "drop_options",
  "options": [
    "Studio",
    "Live"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.336Z"),
  "created_at": ISODate("2016-11-11T12:41:47.336Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4795"),
  "lang": "it",
  "label": "Movie Format",
  "attr_id": 696,
  "type": "drop_options",
  "options": [
    "DVD",
    "Blu-Ray Disc",
    "VHS",
    "Altro formato film"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.338Z"),
  "created_at": ISODate("2016-11-11T12:41:47.338Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4796"),
  "lang": "en",
  "label": "Movie Format",
  "attr_id": 696,
  "type": "drop_options",
  "options": [
    "DVD",
    "Blu-Ray Disc",
    "VHS",
    "Other Movie Format"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.339Z"),
  "created_at": ISODate("2016-11-11T12:41:47.339Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4797"),
  "lang": "it",
  "label": "Color or Black & White",
  "attr_id": 698,
  "type": "drop_options",
  "options": [
    "Colori",
    "Bianco e nero"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.341Z"),
  "created_at": ISODate("2016-11-11T12:41:47.341Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4798"),
  "lang": "en",
  "label": "Color or Black & White",
  "attr_id": 698,
  "type": "drop_options",
  "options": [
    "Color",
    "Black & White"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.343Z"),
  "created_at": ISODate("2016-11-11T12:41:47.343Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4799"),
  "lang": "it",
  "label": "Movie Rating",
  "attr_id": 699,
  "type": "drop_options",
  "options": [
    "G - Tutti",
    "PG - Supervisione genitoriale consigliata",
    "PG-13 - Supervisione per minori di 13 anni",
    "R - Supervisione per minori di 17 anni",
    "NC-17 - Solo adulti",
    "NR - Non classificato"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.344Z"),
  "created_at": ISODate("2016-11-11T12:41:47.344Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b479a"),
  "lang": "en",
  "label": "Movie Rating",
  "attr_id": 699,
  "type": "drop_options",
  "options": [
    "G - General Audiences",
    "PG - Parental Guidance Suggested",
    "PG-13 - Parents Strongly Cautioned",
    "R - Restricted",
    "NC-17 - Adults Only",
    "NR - Not Rated"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.345Z"),
  "created_at": ISODate("2016-11-11T12:41:47.345Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b479b"),
  "lang": "it",
  "label": "Region",
  "attr_id": 701,
  "type": "drop_options",
  "options": [
    "Free/0",
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    "9/All"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.346Z"),
  "created_at": ISODate("2016-11-11T12:41:47.346Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b479c"),
  "lang": "en",
  "label": "Region",
  "attr_id": 701,
  "type": "drop_options",
  "options": [
    "Free/0",
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    "9/All"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.347Z"),
  "created_at": ISODate("2016-11-11T12:41:47.347Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b479d"),
  "lang": "it",
  "label": "Video Game Format",
  "attr_id": 703,
  "type": "drop_options",
  "options": [
    "CD",
    "DVD",
    "Blu Ray",
    "Download",
    "Altro formato Video Game"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.348Z"),
  "created_at": ISODate("2016-11-11T12:41:47.348Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b479e"),
  "lang": "en",
  "label": "Video Game Format",
  "attr_id": 703,
  "type": "drop_options",
  "options": [
    "CD",
    "DVD",
    "Blu Ray",
    "Download",
    "Other Video Game Format"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.349Z"),
  "created_at": ISODate("2016-11-11T12:41:47.349Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b479f"),
  "lang": "it",
  "label": "Video Game Rating",
  "attr_id": 705,
  "type": "drop_options",
  "options": [
    "Prima infanzia",
    "Tutti",
    "Tutti 10+",
    "Adolescenti (13+)",
    "Maturi (17+)",
    "Solo adulti (18+)",
    "In attesa di classificazione"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.350Z"),
  "created_at": ISODate("2016-11-11T12:41:47.350Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47a0"),
  "lang": "en",
  "label": "Video Game Rating",
  "attr_id": 705,
  "type": "drop_options",
  "options": [
    "Early Childhood",
    "Everyone",
    "Everyone 10+",
    "Teen (13+)",
    "Mature (17+)",
    "Adults Only (18+)",
    "Rating Pending"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.351Z"),
  "created_at": ISODate("2016-11-11T12:41:47.351Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47a1"),
  "lang": "it",
  "label": "Gender",
  "attr_id": 708,
  "type": "drop_options",
  "options": [
    "Maschio",
    "Femmina",
    "Unisex"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.352Z"),
  "created_at": ISODate("2016-11-11T12:41:47.352Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47a2"),
  "lang": "en",
  "label": "Gender",
  "attr_id": 708,
  "type": "drop_options",
  "options": [
    "Male",
    "Female",
    "Unisex"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.354Z"),
  "created_at": ISODate("2016-11-11T12:41:47.354Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47a3"),
  "lang": "it",
  "label": "Assembly required",
  "attr_id": 709,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.355Z"),
  "created_at": ISODate("2016-11-11T12:41:47.355Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47a4"),
  "lang": "en",
  "label": "Assembly required",
  "attr_id": 709,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.357Z"),
  "created_at": ISODate("2016-11-11T12:41:47.357Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47a5"),
  "lang": "it",
  "label": "Adjustable Skates",
  "attr_id": 711,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.365Z"),
  "created_at": ISODate("2016-11-11T12:41:47.365Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47a6"),
  "lang": "en",
  "label": "Adjustable Skates",
  "attr_id": 711,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.368Z"),
  "created_at": ISODate("2016-11-11T12:41:47.368Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47a7"),
  "lang": "it",
  "label": "Costume user",
  "attr_id": 712,
  "type": "drop_options",
  "options": [
    "Bambino BABY (0-24 mesi)",
    "Bambina BABY (0-24 mesi)",
    "Unisex BABY (0-24 mesi)",
    "Bambino KID (3-8 anni)",
    "Bambina KID (3-8 anni)",
    "Unisex KID (3-8 anni)",
    "Bambino JUNIOR (9-16 anni)",
    "Bambina JUNIOR (9-16 anni)",
    "Unisex JUNIOR (9-16 anni)",
    "Uomo",
    "Donna",
    "Unisex"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.369Z"),
  "created_at": ISODate("2016-11-11T12:41:47.369Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47a8"),
  "lang": "en",
  "label": "Costume user",
  "attr_id": 712,
  "type": "drop_options",
  "options": [
    "BABY Boy (0-24 months)",
    "BABY Girl (0-24 months)",
    "Unisex BABY (0-24 months)",
    "KID Boy (3-8 years)",
    "KID Girl (3-8 years)",
    "Unisex KID (3-8 years)",
    "JUNIOR Boy (9-16 years)",
    "JUNIOR Girl (9-16 years)",
    "Unisex JUNIOR (9-16 years)",
    "Man",
    "Woman",
    "Unisex"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.371Z"),
  "created_at": ISODate("2016-11-11T12:41:47.371Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47a9"),
  "lang": "it",
  "label": "Finish",
  "attr_id": 716,
  "type": "drop_options",
  "options": [
    "Luminoso",
    "Opaco",
    "Naturale",
    "Radiante",
    "Satinato",
    "Brillante",
    "Glitter",
    "Metallica",
    "Altra finitura"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.372Z"),
  "created_at": ISODate("2016-11-11T12:41:47.372Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47aa"),
  "lang": "en",
  "label": "Finish",
  "attr_id": 716,
  "type": "drop_options",
  "options": [
    "Luminous",
    "Matte",
    "Natural",
    "Radiant",
    "Satin",
    "Shimmer",
    "Glitter",
    "Metallic",
    "Other Finish"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.373Z"),
  "created_at": ISODate("2016-11-11T12:41:47.373Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ab"),
  "lang": "it",
  "label": "Skin Type",
  "attr_id": 717,
  "type": "drop_options",
  "options": [
    "Normale",
    "Oleosa",
    "Mista",
    "Secca",
    "Sensibile",
    "Tutti i tipi di pelle"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.374Z"),
  "created_at": ISODate("2016-11-11T12:41:47.374Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ac"),
  "lang": "en",
  "label": "Skin Type",
  "attr_id": 717,
  "type": "drop_options",
  "options": [
    "Normal",
    "Oily",
    "Combination",
    "Dry",
    "Sensitive",
    "All skin types"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.375Z"),
  "created_at": ISODate("2016-11-11T12:41:47.375Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ad"),
  "lang": "it",
  "label": "Hair Texture",
  "attr_id": 719,
  "type": "drop_options",
  "options": [
    "Dritti",
    "Ricci",
    "Ondulati"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.376Z"),
  "created_at": ISODate("2016-11-11T12:41:47.376Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ae"),
  "lang": "en",
  "label": "Hair Texture",
  "attr_id": 719,
  "type": "drop_options",
  "options": [
    "Straight",
    "Curly",
    "Wavy"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.376Z"),
  "created_at": ISODate("2016-11-11T12:41:47.376Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47af"),
  "lang": "it",
  "label": "Hair Type",
  "attr_id": 720,
  "type": "drop_options",
  "options": [
    "Capelli umani",
    "Capelli sintetici"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.377Z"),
  "created_at": ISODate("2016-11-11T12:41:47.377Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47b0"),
  "lang": "en",
  "label": "Hair Type",
  "attr_id": 720,
  "type": "drop_options",
  "options": [
    "Human Hair",
    "Synthetic Hair"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.378Z"),
  "created_at": ISODate("2016-11-11T12:41:47.378Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47b1"),
  "lang": "it",
  "label": "Wig Length",
  "attr_id": 721,
  "type": "drop_options",
  "options": [
    "Parrucche corte",
    "Parrucche mezza lunghezza",
    "Parrucche lunghe"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.379Z"),
  "created_at": ISODate("2016-11-11T12:41:47.379Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47b2"),
  "lang": "en",
  "label": "Wig Length",
  "attr_id": 721,
  "type": "drop_options",
  "options": [
    "Short Wigs",
    "Mid-Length Wigs",
    "Long Wigs"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.381Z"),
  "created_at": ISODate("2016-11-11T12:41:47.381Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47b3"),
  "lang": "it",
  "label": "Cap Size",
  "attr_id": 722,
  "type": "drop_options",
  "options": [
    "Petite",
    "Media",
    "Grande"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.382Z"),
  "created_at": ISODate("2016-11-11T12:41:47.382Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47b4"),
  "lang": "en",
  "label": "Cap Size",
  "attr_id": 722,
  "type": "drop_options",
  "options": [
    "Petite",
    "Average",
    "Large"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.383Z"),
  "created_at": ISODate("2016-11-11T12:41:47.383Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47b5"),
  "lang": "it",
  "label": "Cap Construction",
  "attr_id": 723,
  "type": "drop_options",
  "options": [
    "100% legata a mano",
    "Monofilamento",
    "Tulle cinema (lace front)",
    "Calotta classica",
    "Calotta aperta (Capless)"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.384Z"),
  "created_at": ISODate("2016-11-11T12:41:47.384Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47b6"),
  "lang": "en",
  "label": "Cap Construction",
  "attr_id": 723,
  "type": "drop_options",
  "options": [
    "100% Hand Tied",
    "Monofilament",
    "Lace Front",
    "Basic Cap",
    "Capless"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.386Z"),
  "created_at": ISODate("2016-11-11T12:41:47.386Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47b7"),
  "lang": "it",
  "label": "Bristles Type",
  "attr_id": 724,
  "type": "drop_options",
  "options": [
    "Morbide",
    "Medie",
    "Dure"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.388Z"),
  "created_at": ISODate("2016-11-11T12:41:47.388Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47b8"),
  "lang": "en",
  "label": "Bristles Type",
  "attr_id": 724,
  "type": "drop_options",
  "options": [
    "Soft",
    "Medium",
    "Hard"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.389Z"),
  "created_at": ISODate("2016-11-11T12:41:47.389Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47b9"),
  "lang": "it",
  "label": "Size",
  "attr_id": 725,
  "type": "drop_options",
  "options": [
    "XS",
    "Small",
    "Medium",
    "Large",
    "Extra Large",
    "2XL",
    "3XL",
    "4XL",
    "5XL",
    "6XL",
    "One Size"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.390Z"),
  "created_at": ISODate("2016-11-11T12:41:47.390Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ba"),
  "lang": "en",
  "label": "Size",
  "attr_id": 725,
  "type": "drop_options",
  "options": [
    "XS",
    "Small",
    "Medium",
    "Large",
    "Extra Large",
    "2XL",
    "3XL",
    "4XL",
    "5XL",
    "6XL",
    "One Size"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.391Z"),
  "created_at": ISODate("2016-11-11T12:41:47.391Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47bb"),
  "lang": "it",
  "label": "Pharmaceutical Product Format",
  "attr_id": 728,
  "type": "drop_options",
  "options": [
    "Capsule/Compresse",
    "Polvere",
    "Gocce",
    "Flaconi monodose",
    "Bustine orosolubili",
    "Ovuli",
    "Supposte",
    "Crema",
    "Fiale",
    "Siringa preriempita",
    "Spray",
    "Gel",
    "Gomme",
    "Sciroppo",
    "Schiuma",
    "Pomata/unguento",
    "Lozione",
    "Liquido",
    "Olio",
    "Caramelle",
    "Altro formato farmaceutico"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.392Z"),
  "created_at": ISODate("2016-11-11T12:41:47.392Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47bc"),
  "lang": "en",
  "label": "Pharmaceutical Product Format",
  "attr_id": 728,
  "type": "drop_options",
  "options": [
    "Capsules/Tablets",
    "Powder",
    "Drops",
    "Single-dose vials",
    "Buccal bags",
    "Ovules",
    "Suppositories",
    "Cream",
    "Ampoules",
    "Pre-filled syringe",
    "Spray",
    "Gel",
    "Gums",
    "Syrup",
    "Foam",
    "Ointment/Unguent",
    "Lotion",
    "Liquid",
    "Oil",
    "Lozenges",
    "Other Pharmaceutical Format"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.394Z"),
  "created_at": ISODate("2016-11-11T12:41:47.394Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47bd"),
  "lang": "it",
  "label": "Type of Flow",
  "attr_id": 731,
  "type": "drop_options",
  "options": [
    "Flusso lento",
    "Flusso medio",
    "Flusso veloce",
    "Variflow"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.396Z"),
  "created_at": ISODate("2016-11-11T12:41:47.396Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47be"),
  "lang": "en",
  "label": "Type of Flow",
  "attr_id": 731,
  "type": "drop_options",
  "options": [
    "Slow Flow",
    "Medium Flow",
    "Fast Flow",
    "Vari Flow"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.397Z"),
  "created_at": ISODate("2016-11-11T12:41:47.397Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47bf"),
  "lang": "it",
  "label": "Baby Car Seat Type",
  "attr_id": 733,
  "type": "drop_options",
  "options": [
    "Gruppo 0: 0-10 kg (22 lbs)",
    "Gruppo 0+: 0-13 kg (29 lbs)",
    "Gruppo 0+/1: 0-18 kg (40 lbs)",
    "Gruppo 0+/1/2: 0-25 kg(55 lbs)",
    "Gruppo 1: 9-18 kg (20-40 lbs)",
    "Gruppo 1/2/3: 9-36 kg (20-79 lbs)",
    "Gruppo 2: 15-25 kg (33-55 lbs)",
    "Gruppo 2/3: 15-36 kg (33-79 lbs)",
    "Gruppo 3: 22-36 kg (48-79 lbs)"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.398Z"),
  "created_at": ISODate("2016-11-11T12:41:47.398Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47c0"),
  "lang": "en",
  "label": "Baby Car Seat Type",
  "attr_id": 733,
  "type": "drop_options",
  "options": [
    "Group 0: 0-10 kg (22 lbs)",
    "Group 0+: 0-13 kg (29 lbs)",
    "Group 0+/1: 0-18 kg (40 lbs)",
    "Group 0+/1/2: 0-25 kg(55 lbs)",
    "Group 1: 9-18 kg (20-40 lbs)",
    "Group 1/2/3: 9-36 kg (20-79 lbs)",
    "Group 2: 15-25 kg (33-55 lbs)",
    "Group 2/3: 15-36 kg (33-79 lbs)",
    "Group 3: 22-36 kg (48-79 lbs)"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.399Z"),
  "created_at": ISODate("2016-11-11T12:41:47.399Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47c1"),
  "lang": "it",
  "label": "Isofix System",
  "attr_id": 734,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.400Z"),
  "created_at": ISODate("2016-11-11T12:41:47.400Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47c2"),
  "lang": "en",
  "label": "Isofix System",
  "attr_id": 734,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.401Z"),
  "created_at": ISODate("2016-11-11T12:41:47.401Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47c3"),
  "lang": "it",
  "label": "Dispensing Equipment Position",
  "attr_id": 735,
  "type": "drop_options",
  "options": [
    "Soprabanco",
    "Sottobanco"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.402Z"),
  "created_at": ISODate("2016-11-11T12:41:47.402Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47c4"),
  "lang": "en",
  "label": "Dispensing Equipment Position",
  "attr_id": 735,
  "type": "drop_options",
  "options": [
    "Over-Counter",
    "Under- Counter"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.403Z"),
  "created_at": ISODate("2016-11-11T12:41:47.403Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47c5"),
  "lang": "it",
  "label": "Wheelchair Accessible",
  "attr_id": 745,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.404Z"),
  "created_at": ISODate("2016-11-11T12:41:47.404Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47c6"),
  "lang": "en",
  "label": "Wheelchair Accessible",
  "attr_id": 745,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.406Z"),
  "created_at": ISODate("2016-11-11T12:41:47.406Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47c7"),
  "lang": "it",
  "label": "Curved Track Available",
  "attr_id": 750,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.407Z"),
  "created_at": ISODate("2016-11-11T12:41:47.407Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47c8"),
  "lang": "en",
  "label": "Curved Track Available",
  "attr_id": 750,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.408Z"),
  "created_at": ISODate("2016-11-11T12:41:47.408Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47c9"),
  "lang": "it",
  "label": "Configuration",
  "attr_id": 754,
  "type": "drop_options",
  "options": [
    "Singola",
    "Parallele affiancate",
    "Incrociate",
    "A forbice",
    "Sovrapposte",
    "Altra sistemazione"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.409Z"),
  "created_at": ISODate("2016-11-11T12:41:47.409Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ca"),
  "lang": "en",
  "label": "Configuration",
  "attr_id": 754,
  "type": "drop_options",
  "options": [
    "Single",
    "Parallel (side by side)",
    "Crossed",
    "Scissor",
    "Overlaid",
    "Other Configuration"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.409Z"),
  "created_at": ISODate("2016-11-11T12:41:47.409Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47cb"),
  "lang": "it",
  "label": "Building Material",
  "attr_id": 761,
  "type": "drop_options",
  "options": [
    "Laterizio",
    "Calcestruzzo",
    "Pietra naturale",
    "Tufo",
    "Armati",
    "Klinker",
    "Legno",
    "Pietra artificiale",
    "Cemento",
    "Acciaio",
    "Altri materiali da costruzione"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.410Z"),
  "created_at": ISODate("2016-11-11T12:41:47.410Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47cc"),
  "lang": "en",
  "label": "Building Material",
  "attr_id": 761,
  "type": "drop_options",
  "options": [
    "Clay",
    "Concrete",
    "Natural Stone",
    "Tuff",
    "Reinforced",
    "Klinker",
    "Wood",
    "Faux Stone",
    "Cement",
    "Steel",
    "Other Building Materials"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.411Z"),
  "created_at": ISODate("2016-11-11T12:41:47.411Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47cd"),
  "lang": "it",
  "label": "Prefabricated Structure Material",
  "attr_id": 762,
  "type": "drop_options",
  "options": [
    "Cemento armato",
    "Metallo",
    "Legno",
    "Legno lamellare",
    "Plastica",
    "Acciaio",
    "Laterizio",
    "Altro materiale struttura prefabbricata"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.412Z"),
  "created_at": ISODate("2016-11-11T12:41:47.412Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ce"),
  "lang": "en",
  "label": "Prefabricated Structure Material",
  "attr_id": 762,
  "type": "drop_options",
  "options": [
    "Reinforced Concrete",
    "Metal",
    "Wood",
    "Lamellar Wood",
    "Plastic",
    "Steel",
    "Clay",
    "Other Prefabricated Structure Material"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.413Z"),
  "created_at": ISODate("2016-11-11T12:41:47.413Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47cf"),
  "lang": "it",
  "label": "Operating Voltage",
  "attr_id": 766,
  "type": "drop_options",
  "options": [
    "Linee ad Altissima Tensione (220 kV e 380 kV)",
    "Linee ad Alta Tensione (da 40 kV a 150 kV)",
    "Linee a Media Tensione (da 1 kV a 40 kV)",
    "Linee a Bassa Tensione (380 V e 220 V)"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.414Z"),
  "created_at": ISODate("2016-11-11T12:41:47.414Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47d0"),
  "lang": "en",
  "label": "Operating Voltage",
  "attr_id": 766,
  "type": "drop_options",
  "options": [
    "Very High-Voltage Lines (220 kV and 380 kV)",
    "High-Voltage Lines (from 40 kV to 150 kV)",
    "Medium Voltage Lines (from 1 kV to 40 kV)",
    "Low-Voltage Lines (380 V and 220 V)"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.415Z"),
  "created_at": ISODate("2016-11-11T12:41:47.415Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47d1"),
  "lang": "it",
  "label": "Frequency Band",
  "attr_id": 767,
  "type": "drop_options",
  "options": [
    "ELF",
    "SLF",
    "ULF",
    "VLF",
    "LF",
    "MF",
    "HF",
    "VHF",
    "UHF",
    "SHF",
    "EHF",
    "THF"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.416Z"),
  "created_at": ISODate("2016-11-11T12:41:47.416Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47d2"),
  "lang": "en",
  "label": "Frequency Band",
  "attr_id": 767,
  "type": "drop_options",
  "options": [
    "Extremely Low Frequency (ELF)",
    "Super Low Frequency (SLF)",
    "Ultra Low Frequency (ULF)",
    "Very Low Frequency (VLF)",
    "Low Frequency (LF)",
    "Medium Frequency (MF)",
    "High Frequency (HF)",
    "Very High Frequency (VHF)",
    "Ultra High Frequency (UHF)",
    "Super High Frequency (SHF)",
    "Extremely High Frequency (EHF)",
    "Tremendously High Frequency (THF)"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.417Z"),
  "created_at": ISODate("2016-11-11T12:41:47.417Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47d3"),
  "lang": "it",
  "label": "Main Insulation Material",
  "attr_id": 775,
  "type": "drop_options",
  "options": [
    "Fibra di vetro",
    "Lana minerale (roccia o scorie)",
    "Fibre plastiche",
    "Fibre naturali",
    "Polistirene",
    "Poliisocianurato",
    "Poliuretano",
    "Cellulosa",
    "Cementizio",
    "Resine fenoliche espanse",
    "Vermiculite e perlite",
    "Schiuma di urea-formaldeide",
    "Protezioni per materiali isolanti",
    "Altro materiale isolante"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.418Z"),
  "created_at": ISODate("2016-11-11T12:41:47.418Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47d4"),
  "lang": "en",
  "label": "Main Insulation Material",
  "attr_id": 775,
  "type": "drop_options",
  "options": [
    "Fiberglass",
    "Mineral (rock or slag) Wool",
    "Plastic Fibers",
    "Natural Fibers",
    "Polystyrene",
    "Polyisocyanurate",
    "Polyurethane",
    "Cellulose",
    "Cementitious",
    "Phenolic Foam",
    "Vermiculite and Perlite",
    "Urea-Formaldehyde Foam",
    "Insulation Facings",
    "Other Insulation Material"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.419Z"),
  "created_at": ISODate("2016-11-11T12:41:47.419Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47d5"),
  "lang": "it",
  "label": "Detector Type",
  "attr_id": 776,
  "type": "drop_options",
  "options": [
    "Puntiforme",
    "Lineare"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.420Z"),
  "created_at": ISODate("2016-11-11T12:41:47.420Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47d6"),
  "lang": "en",
  "label": "Detector Type",
  "attr_id": 776,
  "type": "drop_options",
  "options": [
    "Pinpoint",
    "Linear"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.421Z"),
  "created_at": ISODate("2016-11-11T12:41:47.421Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47d7"),
  "lang": "it",
  "label": "Type of Pinpoint Detector",
  "attr_id": "776;1",
  "type": "drop_options",
  "options": [
    "Rivelatori foto-ottici a diffusione",
    "Rivelatori a ionizzazione",
    "Rivelatori ad aspirazione",
    "Rivelatori termovelocimetrici",
    "Rivelatori a soglia",
    "Rivelatori ad infrarossi",
    "Rivelatori ultravioletti"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.423Z"),
  "created_at": ISODate("2016-11-11T12:41:47.423Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47d8"),
  "lang": "en",
  "label": "Type of Pinpoint Detector",
  "attr_id": "776;1",
  "type": "drop_options",
  "options": [
    "Photoelectric Detectors",
    "Ionization Detectors",
    "Aspirating Smoke Detectors",
    "Thermo-Velocimetric Detectors",
    "Threshold Detectors",
    "Infrared Detectors",
    "Ultraviolet Detectors"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.424Z"),
  "created_at": ISODate("2016-11-11T12:41:47.424Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47d9"),
  "lang": "it",
  "label": "Type of Linear Detectors",
  "attr_id": "776;2",
  "type": "drop_options",
  "options": [
    "Rivelatori a riflessione",
    "Rivelatori a sbarramento",
    "Rivelatori a cavo termosensibile"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.426Z"),
  "created_at": ISODate("2016-11-11T12:41:47.426Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47da"),
  "lang": "en",
  "label": "Type of Linear Detectors",
  "attr_id": "776;2",
  "type": "drop_options",
  "options": [
    "Reflected Beam Detectors",
    "Multi Beam Detectors",
    "Linear Heat Detectors"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.427Z"),
  "created_at": ISODate("2016-11-11T12:41:47.427Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47db"),
  "lang": "it",
  "label": "Stationary or Portable",
  "attr_id": 777,
  "type": "drop_options",
  "options": [
    "Fisso",
    "Portatile"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.429Z"),
  "created_at": ISODate("2016-11-11T12:41:47.429Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47dc"),
  "lang": "en",
  "label": "Stationary or Portable",
  "attr_id": 777,
  "type": "drop_options",
  "options": [
    "Stationary",
    "Portable"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.430Z"),
  "created_at": ISODate("2016-11-11T12:41:47.430Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47dd"),
  "lang": "it",
  "label": "Fire Class",
  "attr_id": 788,
  "type": "drop_options",
  "options": [
    "Classe A – Combustibili solidi (legna, carta, plastica, ecc.)",
    "Classe B - Liquidi infiammabili (benzina, gasolio, alcol, ecc.)",
    "Classe C - Gas infiammabili (gas propano, metano, idrogeno, ecc.)",
    "Classe D - Metalli infiammabili (magnesio, potassio, sodio)",
    "Classe E - Quadri elettrici, cabine elettriche, centrali in tensione",
    "Classe F (o K) - Oli da cucina e grassi vegetali"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.431Z"),
  "created_at": ISODate("2016-11-11T12:41:47.431Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47de"),
  "lang": "en",
  "label": "Fire Class",
  "attr_id": 788,
  "type": "drop_options",
  "options": [
    "Class A - Ordinary Combustibles (wood, paper, plastic, etc.)",
    "Class B - Flammable and Combustible Liquids (gasoline, diesel, alcohol, etc.)",
    "Class C - Flammable Gases (propane, methane, hydrogen, etc.)",
    "Class D - Combustible Metals (magnesium, potassium, sodium)",
    "Class E - Energised Electrical Equipment",
    "Class F (or K) - Cooking Oils and Fats"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.432Z"),
  "created_at": ISODate("2016-11-11T12:41:47.432Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47df"),
  "lang": "it",
  "label": "Extinguishing Agent Base",
  "attr_id": 791,
  "type": "drop_options",
  "options": [
    "Proteinico",
    "Sintetico"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.433Z"),
  "created_at": ISODate("2016-11-11T12:41:47.433Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47e0"),
  "lang": "en",
  "label": "Extinguishing Agent Base",
  "attr_id": 791,
  "type": "drop_options",
  "options": [
    "Protein",
    "Synthetic"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.434Z"),
  "created_at": ISODate("2016-11-11T12:41:47.434Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47e1"),
  "lang": "it",
  "label": "Extinguishing Agent Specs",
  "attr_id": 792,
  "type": "drop_options",
  "options": [
    "Standard",
    "Fluoroproteinico",
    "Resistente all'alcool (AR)",
    "Fluoro filmante (AFFF)",
    "Fluoroproteinico filmante (FFFP)"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.435Z"),
  "created_at": ISODate("2016-11-11T12:41:47.435Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47e2"),
  "lang": "en",
  "label": "Extinguishing Agent Specs",
  "attr_id": 792,
  "type": "drop_options",
  "options": [
    "Standard",
    "FluoroProtein",
    "Alcohol Resistant (AR)",
    "Aqueous Film Forming Foam (AFFF)",
    "Film Forming FluoroProtein (FFFP)"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.436Z"),
  "created_at": ISODate("2016-11-11T12:41:47.436Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47e3"),
  "lang": "it",
  "label": "Extinguishing Agent Expansion",
  "attr_id": 793,
  "type": "drop_options",
  "options": [
    "Bassa",
    "Media",
    "Alta"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.436Z"),
  "created_at": ISODate("2016-11-11T12:41:47.436Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47e4"),
  "lang": "en",
  "label": "Extinguishing Agent Expansion",
  "attr_id": 793,
  "type": "drop_options",
  "options": [
    "Low",
    "Medium",
    "High"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.437Z"),
  "created_at": ISODate("2016-11-11T12:41:47.437Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47e5"),
  "lang": "it",
  "label": "Pet Immunity",
  "attr_id": 795,
  "type": "drop_options",
  "options": [
    "Si",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.438Z"),
  "created_at": ISODate("2016-11-11T12:41:47.438Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47e6"),
  "lang": "en",
  "label": "Pet Immunity",
  "attr_id": 795,
  "type": "drop_options",
  "options": [
    "Yes",
    "No"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.439Z"),
  "created_at": ISODate("2016-11-11T12:41:47.439Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47e7"),
  "lang": "it",
  "label": "Location",
  "attr_id": 796,
  "type": "drop_options",
  "options": [
    "Interno",
    "Esterno",
    "Interno/Esterno"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.440Z"),
  "created_at": ISODate("2016-11-11T12:41:47.440Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47e8"),
  "lang": "en",
  "label": "Location",
  "attr_id": 796,
  "type": "drop_options",
  "options": [
    "Indoor",
    "Outdoor",
    "Indoor/Outdoor"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.441Z"),
  "created_at": ISODate("2016-11-11T12:41:47.441Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47e9"),
  "lang": "it",
  "label": "Camera Type",
  "attr_id": 799,
  "type": "drop_options",
  "options": [
    "Infrarossi/Visione notturna",
    "Giorno/Notte",
    "Cablata",
    "Wireless",
    "Network/IP",
    "Analogica",
    "HD-SDI",
    "HDCVI",
    "CCTV",
    "AHD",
    "Full HD",
    "960H",
    "Obiettivo fisso",
    "Obiettivo varifocale",
    "Obiettivo megapixel",
    "Obiettivo Zoom motorizzato"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.442Z"),
  "created_at": ISODate("2016-11-11T12:41:47.442Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ea"),
  "lang": "en",
  "label": "Camera Type",
  "attr_id": 799,
  "type": "drop_options",
  "options": [
    "Infrared/Night Vision",
    "Day/Night",
    "Wired",
    "Wireless",
    "Network/IP",
    "Analog",
    "HD-SDI",
    "HDCVI",
    "CCTV",
    "AHD",
    "Full HD",
    "960H",
    "Fixed Lens",
    "Varifocal Lens",
    "Megapixel Lens",
    "Motorized Zoom Lens"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.442Z"),
  "created_at": ISODate("2016-11-11T12:41:47.442Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47eb"),
  "lang": "it",
  "label": "Network Protocols",
  "attr_id": 804,
  "type": "drop_options",
  "options": [
    "IPv6",
    "IPv4",
    "TCP/IP",
    "UDP",
    "ICMP",
    "DHCP client",
    "NTP client",
    "DNS client",
    "DDNS client",
    "SMTP client",
    "FTP client",
    "HTTP / HTTPS",
    "Samba client",
    "PPPoE",
    "UPnP port forwarding",
    "RTP / RTSP / RTCP",
    "IP filtering",
    "QoS",
    "CoS",
    "Multicast",
    "IGMP",
    "Conforme agli standard ONVIF"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.443Z"),
  "created_at": ISODate("2016-11-11T12:41:47.443Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ec"),
  "lang": "en",
  "label": "Network Protocols",
  "attr_id": 804,
  "type": "drop_options",
  "options": [
    "IPv6",
    "IPv4",
    "TCP/IP",
    "UDP",
    "ICMP",
    "DHCP client",
    "NTP client",
    "DNS client",
    "DDNS client",
    "SMTP client",
    "FTP client",
    "HTTP / HTTPS",
    "Samba client",
    "PPPoE",
    "UPnP port forwarding",
    "RTP / RTSP/ RTCP",
    "IP filtering",
    "QoS",
    "CoS",
    "Multicast",
    "IGMP",
    "ONVIF compliant"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.444Z"),
  "created_at": ISODate("2016-11-11T12:41:47.444Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ed"),
  "lang": "it",
  "label": "Home Automation Technology Type",
  "attr_id": 814,
  "type": "drop_options",
  "options": [
    "BUS",
    "Wireless",
    "Onde convogliate",
    "Altra tecnologia domotica"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.445Z"),
  "created_at": ISODate("2016-11-11T12:41:47.445Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ee"),
  "lang": "en",
  "label": "Home Automation Technology Type",
  "attr_id": 814,
  "type": "drop_options",
  "options": [
    "BUS",
    "Wireless",
    "Power Line Communication",
    "Other Home Automation Technology"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.446Z"),
  "created_at": ISODate("2016-11-11T12:41:47.446Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ef"),
  "lang": "it",
  "label": "Valve Way/Position",
  "attr_id": 815,
  "type": "drop_options",
  "options": [
    "2/2",
    "3/2",
    "4/2",
    "4/3",
    "5/2",
    "5/3"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.447Z"),
  "created_at": ISODate("2016-11-11T12:41:47.447Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47f0"),
  "lang": "en",
  "label": "Valve Way/Position",
  "attr_id": 815,
  "type": "drop_options",
  "options": [
    "2/2",
    "3/2",
    "4/2",
    "4/3",
    "5/2",
    "5/3"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.448Z"),
  "created_at": ISODate("2016-11-11T12:41:47.448Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47f1"),
  "lang": "it",
  "label": "Type of PPE",
  "attr_id": 816,
  "type": "drop_options",
  "options": [
    "Arco elettrico e elettricista",
    "Protezione chimica",
    "Camere bianche",
    "Protezione basse temperature e inverno",
    "Resistente al taglio e all'abrasione",
    "Monouso",
    "Riutilizzabile",
    "Indumenti per tutti gli usi",
    "Resistente al calore e alle fiamme",
    "Stress da calore",
    "Alta visibilità",
    "Impermeabile",
    "Saldatura",
    "Altro tipo di DPI"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.449Z"),
  "created_at": ISODate("2016-11-11T12:41:47.449Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47f2"),
  "lang": "en",
  "label": "Type of PPE",
  "attr_id": 816,
  "type": "drop_options",
  "options": [
    "Arc Flash & Electrician",
    "Chemical Protection",
    "Cleanroom",
    "Cold Weather & Winter Protective",
    "Cut & Abrasion Resistant",
    "Disposable",
    "Reusable",
    "All Purpose Workwear",
    "Heat & Flame Resistant",
    "Heat Stress",
    "High Visibility",
    "Waterproof",
    "Welding",
    "Other Type of PPE"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.450Z"),
  "created_at": ISODate("2016-11-11T12:41:47.450Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47f3"),
  "lang": "it",
  "label": "Toe Type",
  "attr_id": 819,
  "type": "drop_options",
  "options": [
    "Punta in acciaio",
    "Punta liscia",
    "Protezione metatarsale",
    "Puntale di protezione",
    "Parapiede",
    "Senza protezioni"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.451Z"),
  "created_at": ISODate("2016-11-11T12:41:47.451Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47f4"),
  "lang": "en",
  "label": "Toe Type",
  "attr_id": 819,
  "type": "drop_options",
  "options": [
    "Steel Toe",
    "Plain Toe",
    "Metatarsal Guard",
    "Toe Guard",
    "Foot Guard",
    "No Protections"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.451Z"),
  "created_at": ISODate("2016-11-11T12:41:47.451Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47f5"),
  "lang": "it",
  "label": "Safety Shoe Type",
  "attr_id": 820,
  "type": "drop_options",
  "options": [
    "Scarpe antiscivolo",
    "Scarpe con lamina antiforo",
    "Scarpe antiolio",
    "Scarpe anatomiche",
    "Scarpe antisudore",
    "Scarpe antimicotiche",
    "Scarpe anti batteriche",
    "Scarpe antifango",
    "Scarpe antistatiche",
    "Scarpe antiacido",
    "Scarpe antitaglio motosega",
    "Scarpe isolanti",
    "Altro tipo di scarpa infortunistica"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.452Z"),
  "created_at": ISODate("2016-11-11T12:41:47.452Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47f6"),
  "lang": "en",
  "label": "Safety Shoe Type",
  "attr_id": 820,
  "type": "drop_options",
  "options": [
    "Slip Resistant Shoes",
    "Puncture Resistant Shoes",
    "Oil Resistant Shoes",
    "Anatomic Shoes",
    "Breathable Shoes",
    "Antifungal Shoes",
    "Antibacterial Shoes",
    "Mud Resistant Shoes",
    "Anti Static Shoes",
    "Antacid Shoes",
    "Chain Saw Cut Resistant Shoes",
    "Insulated Shoes",
    "Other Type of Safety Shoes"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.453Z"),
  "created_at": ISODate("2016-11-11T12:41:47.453Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47f7"),
  "lang": "it",
  "label": "Suspension Type",
  "attr_id": 821,
  "type": "drop_options",
  "options": [
    "Bardatura Ratchet (dimensionati regolando una piccola manopola)",
    "Bardatura Pinlock (regolate rimuovendo l’elmetto e  facendo combaciare punte e buchi)",
    "Bardatura 1-Touch (regolate schiacciando e facendo scorrere la bardatura fino a misura; può essere fatto con una sola mano)",
    "Bardatura Swing-Ratchet (con cinghia reversibile per l’auto-regolazione)",
    "Altro tipo di bardatura"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.455Z"),
  "created_at": ISODate("2016-11-11T12:41:47.455Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47f8"),
  "lang": "en",
  "label": "Suspension Type",
  "attr_id": 821,
  "type": "drop_options",
  "options": [
    "Ratchet Suspensions (sized by adjusting a small knob)",
    "Pinlock Suspensions (adjusted by removing the hat and matching appropriate pin to hole)",
    "1-Touch Suspensions (adjust by squeezing and sliding the suspension to best fit; can be done with one hand)",
    "Swing-Ratchet Suspensions (use a reversible ratchet to self-adjust)",
    "Other Suspension Type"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.456Z"),
  "created_at": ISODate("2016-11-11T12:41:47.456Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47f9"),
  "lang": "it",
  "label": "Lens Type",
  "attr_id": 823,
  "type": "drop_options",
  "options": [
    "Graduate",
    "Correttive",
    "Polarizzate",
    "Non graduate",
    "Fotocromatiche",
    "Trasparenti"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.457Z"),
  "created_at": ISODate("2016-11-11T12:41:47.457Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47fa"),
  "lang": "en",
  "label": "Lens Type",
  "attr_id": 823,
  "type": "drop_options",
  "options": [
    "Prescription",
    "Corrective",
    "Polarized",
    "Clear (Non-Prescription)",
    "Photochromic",
    "Transparent"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.459Z"),
  "created_at": ISODate("2016-11-11T12:41:47.459Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47fb"),
  "lang": "it",
  "label": "Powder",
  "attr_id": 826,
  "type": "drop_options",
  "options": [
    "Con talco",
    "Senza talco"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.460Z"),
  "created_at": ISODate("2016-11-11T12:41:47.460Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47fc"),
  "lang": "en",
  "label": "Powder",
  "attr_id": 826,
  "type": "drop_options",
  "options": [
    "Powdered",
    "Powder-Free"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.461Z"),
  "created_at": ISODate("2016-11-11T12:41:47.461Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47fd"),
  "lang": "it",
  "label": "Work Glove Material",
  "attr_id": 827,
  "type": "drop_options",
  "options": [
    "Pelle di Maialino scamosciato",
    "Crosta bovina",
    "Crosta bovina con dorso in cotone",
    "Orlato",
    "Maglia",
    "Fiore di vitello",
    "Rivestiti NBR",
    "Flexy Grip Sensor",
    "Tessuto interlock",
    "Jersey",
    "Lattice",
    "Tela",
    "Nitrile",
    "Altro materiale"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.462Z"),
  "created_at": ISODate("2016-11-11T12:41:47.462Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47fe"),
  "lang": "en",
  "label": "Work Glove Material",
  "attr_id": 827,
  "type": "drop_options",
  "options": [
    "Suede Pig Skin",
    "Bovine Crust",
    "Bovine Crust with Cotton Back",
    "Hemmed",
    "Mesh",
    "Calf Flower",
    "NBR Coated",
    "Flexy Grip Sensor",
    "Interlock Fabric",
    "Jersey",
    "Latex",
    "Canvas",
    "Nitrile",
    "Other Material"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.463Z"),
  "created_at": ISODate("2016-11-11T12:41:47.463Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b47ff"),
  "lang": "it",
  "label": "D-Ring Location",
  "attr_id": 829,
  "type": "drop_options",
  "options": [
    "Fronte",
    "Lato",
    "Retro",
    "Spalle"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.464Z"),
  "created_at": ISODate("2016-11-11T12:41:47.464Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4800"),
  "lang": "en",
  "label": "D-Ring Location",
  "attr_id": 829,
  "type": "drop_options",
  "options": [
    "Front",
    "Side",
    "Back",
    "Shoulders"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.465Z"),
  "created_at": ISODate("2016-11-11T12:41:47.465Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4801"),
  "lang": "it",
  "label": "Flow Rate - measurement unit",
  "attr_id": 832,
  "type": "drop_options",
  "options": [
    "gps",
    "lps",
    "gpm",
    "lpm",
    "ft3/min",
    "m3/min"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.466Z"),
  "created_at": ISODate("2016-11-11T12:41:47.466Z")
});
db.getCollection("dropdown_options").insert({
  "_id": ObjectId("5825bc8b1c8cb6e5388b4802"),
  "lang": "en",
  "label": "Flow Rate - measurement unit",
  "attr_id": 832,
  "type": "drop_options",
  "options": [
    "gps",
    "lps",
    "gpm",
    "lpm",
    "ft3/min",
    "m3/min"
  ],
  "updated_at": ISODate("2016-11-11T12:41:47.487Z"),
  "created_at": ISODate("2016-11-11T12:41:47.487Z")
});
