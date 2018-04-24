
/** cat_attributes indexes **/
db.getCollection("cat_attributes").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** cat_attributes records **/
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a86"),
  "attr_id": "15",
  "label": "Price (sell) B2B",
  "desc": "Price applied to wholesalers",
  "field_type": "T",
  "len": "8",
  "class": "PZ",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a87"),
  "attr_id": "16",
  "label": "Price (sell) B2C",
  "desc": "End-user price",
  "field_type": "T",
  "len": "8",
  "class": "PZ",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a88"),
  "attr_id": "17",
  "label": "Price (Sell) B2C after discount",
  "desc": "End-user discounted price",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a89"),
  "attr_id": "18",
  "label": "Price (Buy) B2B",
  "desc": "Wholesaler purchase price",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a8a"),
  "attr_id": "19",
  "label": "Price (Buy) B2C",
  "desc": "End-user purchase price",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a8b"),
  "attr_id": "20",
  "label": "Price (Auction Starting Bid)",
  "desc": "Auction starting price",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a8c"),
  "attr_id": "21",
  "label": "Price (Auction Minimum Raise)",
  "desc": "Minimum increase for auction",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a8d"),
  "attr_id": "22",
  "label": "Price (Auction Reserve Price)",
  "desc": "Minimum price you will accept to sell the item",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a8e"),
  "attr_id": "23",
  "label": "Auction Starting Date",
  "desc": "Enter the starting date of the auction",
  "field_type": "D",
  "len": "10",
  "class": "PZ",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a8f"),
  "attr_id": "24",
  "label": "Scheduled Start Time",
  "desc": "Enter the start time of the auction",
  "field_type": "H",
  "len": "10",
  "class": "PZ",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a90"),
  "attr_id": "25",
  "label": "Auction Closing Date",
  "desc": "Insert the closing date of the auction",
  "field_type": "D",
  "len": "10",
  "class": "PZ",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a91"),
  "attr_id": "26",
  "label": "Price Buy Now",
  "desc": "Buy It Now price",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a92"),
  "attr_id": "27",
  "label": "Price per Hour",
  "desc": "Price per hour for the service offered",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a93"),
  "attr_id": "28",
  "label": "Price per Service",
  "desc": "Package price for the service offered",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a94"),
  "attr_id": "29",
  "label": "Price per Month",
  "desc": "Price per month, if the service is provided for a long period",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a95"),
  "attr_id": "29a",
  "label": "Price per Week",
  "desc": "Price per week for the service offered",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a96"),
  "attr_id": "30",
  "label": "Price per Day",
  "desc": "Price per day of work \/ service",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a97"),
  "attr_id": "31",
  "label": "Price per Year",
  "desc": "Annual fee for long-term or multi-year services",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aa4"),
  "attr_id": "44",
  "label": "Image 1",
  "desc": "Image 1",
  "field_type": "UE",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aa5"),
  "attr_id": "45",
  "label": "Image 2",
  "desc": "Image 2",
  "field_type": "UI",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aa6"),
  "attr_id": "46",
  "label": "Image 3",
  "desc": "Image 3",
  "field_type": "UA",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aa7"),
  "attr_id": "47",
  "label": "Image 4",
  "desc": "Image 4",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aa8"),
  "attr_id": "48",
  "label": "Image 5",
  "desc": "Image 5",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aa9"),
  "attr_id": "49",
  "label": "Image 6",
  "desc": "Image 6",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aaa"),
  "attr_id": "50",
  "label": "Image 7",
  "desc": "Image 7",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aab"),
  "attr_id": "51",
  "label": "Image 8",
  "desc": "Image 8",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aac"),
  "attr_id": "52",
  "label": "Livestock Health Certificates",
  "desc": "Load Livestock Health Certificates",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c81"),
  "attr_id": "514",
  "label": "Bedroom Composition",
  "desc": "Specify bedroom composition",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b090d",
  "updated_at": ISODate("2015-11-18T12:49:15.784Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c82"),
  "attr_id": "515",
  "label": "Operation",
  "desc": "Specify the type of operation",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b090e",
  "updated_at": ISODate("2015-11-18T12:49:15.785Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c44"),
  "attr_id": "453",
  "label": "Slide Stroke (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c45"),
  "attr_id": "454",
  "label": "Max. Distance Table to the Slide\/Tool (mm)",
  "desc": "Specify distance in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c46"),
  "attr_id": "455",
  "label": "Slide Size (WxH) (mm)",
  "desc": "Specify length x height in millimeters",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c47"),
  "attr_id": "456",
  "label": "Cushion Power (Kg)",
  "desc": "Specify power in kilowatts",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c48"),
  "attr_id": "457",
  "label": "Wheel Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c49"),
  "attr_id": "458",
  "label": "Wheel Motor Power (kw)",
  "desc": "Specify power in kilowatts",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c4a"),
  "attr_id": "459",
  "label": "Max. Grinding Capacity (WxH) (mm)",
  "desc": "Specify length x height in millimeters",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c4b"),
  "attr_id": "460",
  "label": "Maximum Workpiece Head Speed (RPM)",
  "desc": "Specify speed in RPM",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c4c"),
  "attr_id": "461",
  "label": "Minimum Workpiece Head Speed (RPM)",
  "desc": "Specify speed in RPM",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c4d"),
  "attr_id": "462",
  "label": "Wheel Vertical Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c4e"),
  "attr_id": "463",
  "label": "Wheel Speed (RPM)",
  "desc": "Specify speed in RPM",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c4f"),
  "attr_id": "464",
  "label": "Working Capacity Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c50"),
  "attr_id": "465",
  "label": "Automatic Workpiece Feed (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c51"),
  "attr_id": "466",
  "label": "Tool Stroke (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c52"),
  "attr_id": "467",
  "label": "Centres Height (mm)",
  "desc": "Specify height in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c53"),
  "attr_id": "468",
  "label": "Centre Distance (mm)",
  "desc": "Specify distance in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c54"),
  "attr_id": "469",
  "label": "Max. Diameter Ø over Saddle (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c55"),
  "attr_id": "470",
  "label": "Spindle Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c56"),
  "attr_id": "471",
  "label": "Max. Weight on Centres (Ton)",
  "desc": "Specify maximum weight in tonnes",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c57"),
  "attr_id": "472",
  "label": "Turret Vertical Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c58"),
  "attr_id": "473",
  "label": "Drilling Capacity Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ad0"),
  "attr_id": "87",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ad1"),
  "attr_id": "88",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ad2"),
  "attr_id": "89",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ad4"),
  "attr_id": "91",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ad5"),
  "attr_id": "92",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ad7"),
  "attr_id": "94",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ada"),
  "attr_id": "97",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707adb"),
  "attr_id": "98",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707adc"),
  "attr_id": "99",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ade"),
  "attr_id": "101",
  "label": "Textile Composition: Lining",
  "desc": "Describe the materials of the lining fabric",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ae4"),
  "attr_id": "107",
  "label": "Number of Wheels",
  "desc": "Indicate the number of installed wheels",
  "field_type": "N",
  "len": "1",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ae6"),
  "attr_id": "109",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ae7"),
  "attr_id": "110",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ae8"),
  "attr_id": "111",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ae9"),
  "attr_id": "112",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aea"),
  "attr_id": "113",
  "label": "Size Description: Bags & Luggage SET",
  "desc": "Specify set size",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aeb"),
  "attr_id": "114",
  "label": "Bags & Luggage SET: Number of Units",
  "desc": "Specify the quntity of cases in the set",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aed"),
  "attr_id": "116",
  "label": "Dimensions (LxWxH) mm",
  "desc": "Specify the size in millimeters",
  "field_type": "T",
  "len": "15",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aee"),
  "attr_id": "117",
  "label": "Description of Sport Equipment Accessories",
  "desc": "Description of included accessories",
  "field_type": "T",
  "len": "300",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aef"),
  "attr_id": "118",
  "label": "Diameter Ø (mm)",
  "desc": "Specify diameter measurement in millimeters",
  "field_type": "N",
  "len": "4",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707af0"),
  "attr_id": "119",
  "label": "Tent - Number of Persons",
  "desc": "Specify the tent berth\/sleeps\/persons number",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707af1"),
  "attr_id": "120",
  "label": "Sport Equipment - Material Description",
  "desc": "Description of the material composition",
  "field_type": "T",
  "len": "300",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c87"),
  "attr_id": "520",
  "label": "Bedding Composition",
  "desc": "Specify type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b090f",
  "updated_at": ISODate("2015-11-18T12:49:15.785Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b8e"),
  "attr_id": "276",
  "label": "Year of Production for Boats\/Cars\/Moto\/Aircrafts",
  "desc": "Year of Production for Boats\/Cars\/Moto\/Aircrafts",
  "field_type": "D",
  "len": "4",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b9e"),
  "attr_id": "292",
  "label": "Rear Brakes Type",
  "desc": "Rear brake type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a27",
  "updated_at": ISODate("2015-11-18T12:49:15.723Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bb0"),
  "attr_id": "310",
  "label": "Centreboard Type",
  "desc": "Centreboard Type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08d8",
  "updated_at": ISODate("2015-11-18T12:49:15.730Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bcf"),
  "attr_id": "341",
  "label": "Storage Basement",
  "desc": "Storage Basement",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08e0",
  "updated_at": ISODate("2015-11-18T12:49:15.738Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c85"),
  "attr_id": "518",
  "label": "Number of Seats",
  "desc": "Specify the number of seats",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c86"),
  "attr_id": "519",
  "label": "Number of Columns",
  "desc": "Specify the number of columns",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c88"),
  "attr_id": "521",
  "label": "Hourly Consumption (Kg\/h)",
  "desc": "Specify hourly consumption in Kg per hour",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c8a"),
  "attr_id": "523",
  "label": "Mattress Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0911",
  "updated_at": ISODate("2015-11-18T12:49:15.787Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c8c"),
  "attr_id": "525",
  "label": "Curtain\/Drapes Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0913",
  "updated_at": ISODate("2015-11-18T12:49:15.789Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c8d"),
  "attr_id": "526",
  "label": "Dimensions (LxW) in cm",
  "desc": "Specify product size centimeters",
  "field_type": "N",
  "len": "9",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c8e"),
  "attr_id": "527",
  "label": "Faucet Style",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0914",
  "updated_at": ISODate("2015-11-18T12:49:15.790Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c8f"),
  "attr_id": "528",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c90"),
  "attr_id": "529",
  "label": "Faucet Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0915",
  "updated_at": ISODate("2015-11-18T12:49:15.791Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c95"),
  "attr_id": "534",
  "label": "Lock Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b091a",
  "updated_at": ISODate("2015-11-18T12:49:15.795Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c97"),
  "attr_id": "536",
  "label": "Type of Glass Mounted",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b091c",
  "updated_at": ISODate("2015-11-18T12:49:15.797Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c98"),
  "attr_id": "537",
  "label": "Opening",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b091d",
  "updated_at": ISODate("2015-11-18T12:49:15.798Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c9a"),
  "attr_id": "539",
  "label": "Luminaire Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b091f",
  "updated_at": ISODate("2015-11-18T12:49:15.800Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c9c"),
  "attr_id": "541",
  "label": "Light Source",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0921",
  "updated_at": ISODate("2015-11-18T12:49:15.802Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c9d"),
  "attr_id": "542",
  "label": "Lighting Power Supply",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0922",
  "updated_at": ISODate("2015-11-18T12:49:15.803Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c9e"),
  "attr_id": "543",
  "label": "Candles",
  "desc": "Specify the number of candles",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c9f"),
  "attr_id": "544",
  "label": "Light Color",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0923",
  "updated_at": ISODate("2015-11-18T12:49:15.804Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ca2"),
  "attr_id": "547",
  "label": "Number of Luminaire",
  "desc": "Specify",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ca3"),
  "attr_id": "548",
  "label": "Number of Gangs",
  "desc": "Specify",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ca5"),
  "attr_id": "550",
  "label": "Plug Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0927",
  "updated_at": ISODate("2015-11-18T12:49:15.808Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ca6"),
  "attr_id": "551",
  "label": "Shielding",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0928",
  "updated_at": ISODate("2015-11-18T12:49:15.808Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ca9"),
  "attr_id": "554",
  "label": "Socket Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b092b",
  "updated_at": ISODate("2015-11-18T12:49:15.811Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cab"),
  "attr_id": "556",
  "label": "Bay",
  "desc": "Describe the bay",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cad"),
  "attr_id": "558",
  "label": "Floodlight Material",
  "desc": "Specify the product material",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df84095a32774774707a78"),
  "attr_id": "1",
  "label": "Post Date",
  "desc": "Post Date",
  "field_type": "D",
  "len": "10",
  "class": "MP",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "Status ICT & Machinery",
  "updated_at": ISODate("2015-09-01T13:21:14.594Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df84095a32774774707a79"),
  "attr_id": "2",
  "label": "Company Name",
  "desc": "Company \/ Business Name",
  "field_type": "T",
  "len": "20",
  "class": "CO",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a7a"),
  "attr_id": "3",
  "label": "Message Subject",
  "desc": "Message about the product",
  "field_type": "T",
  "len": "60",
  "class": "MP",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a7c"),
  "attr_id": "5",
  "label": "ECCN Code",
  "desc": "Export Control Classification Number (Required if there are export restrictions)",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a7d"),
  "attr_id": "6",
  "label": "Product\/Service Description",
  "desc": "Describe the product",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a7e"),
  "attr_id": "7",
  "label": "Brand",
  "desc": "Brand as appear on the product. If not available, please type Unbranded",
  "field_type": "T",
  "len": "25",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a7f"),
  "attr_id": "8",
  "label": "Quantity",
  "desc": "Specify the quantities you intend to list, sell or buy",
  "field_type": "N",
  "len": "6",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a80"),
  "attr_id": "9",
  "label": "TAGs (Products & Services)",
  "desc": "Help us to better identify the product by entering some \"KEYWORDS\"",
  "field_type": "T",
  "len": "150",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a83"),
  "attr_id": "12",
  "label": "VAT (or other local tax) (%)",
  "desc": "Specify percentage VAT or other local tax",
  "field_type": "N",
  "len": "6",
  "class": "TX",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ab4"),
  "attr_id": "60",
  "label": "Product Datasheet",
  "desc": "You can add a file containing the technical specifications for your product\/service.",
  "field_type": "F",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ab6"),
  "attr_id": "62",
  "label": "Product\/Service Availability Date",
  "desc": "Specify the date when the product or service you are offering will be available.",
  "field_type": "D",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ab7"),
  "attr_id": "63",
  "label": "Radiation",
  "desc": "Some products such as batteries emit radiations. Specify by choosing from the dropdown menu",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289cd",
  "updated_at": ISODate("2015-11-18T12:49:15.637Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ab8"),
  "attr_id": "64",
  "label": "Rohs Compliant",
  "desc": "Specify whether the product is or isn''t RoHs certified",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289ce",
  "updated_at": ISODate("2015-11-18T12:49:15.639Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707abd"),
  "attr_id": "69",
  "label": "OPTICAL (DVD COMBO)",
  "desc": "Specify if there is a DVD, CD-ROM, or a combined solution CD-ROM\/DVD\/DVD-ROM",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289cf",
  "updated_at": ISODate("2015-11-18T12:49:15.640Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707abe"),
  "attr_id": "70",
  "label": "COA",
  "desc": "Specify which operating system is installed on the machine.",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289d0",
  "updated_at": ISODate("2015-11-18T12:49:15.641Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ac0"),
  "attr_id": "72",
  "label": "Format",
  "desc": "Specify the maximum size the scanner, printer, plotter, or other device manages (A0-A1-A2-A3-A4-B1, etc.)",
  "field_type": "T",
  "len": "2",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ac1"),
  "attr_id": "72a",
  "label": "Scanner\/Printer Speed (page per minute)",
  "desc": "Specify the speed of the feeder of your scanner\/printer",
  "field_type": "T",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ca0"),
  "attr_id": "545",
  "label": "Gangbox Material",
  "desc": "Specify the product material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0924",
  "updated_at": ISODate("2015-11-18T12:49:15.805Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ca1"),
  "attr_id": "546",
  "label": "Lighting Localization",
  "desc": "Specify product localization",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0925",
  "updated_at": ISODate("2015-11-18T12:49:15.806Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c72"),
  "attr_id": "499",
  "label": "Floor\/Wall Covering End Use",
  "desc": "Specify the target environment",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0901",
  "updated_at": ISODate("2015-11-18T12:49:15.772Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c73"),
  "attr_id": "500",
  "label": "Hardwood Floor Installation Mode",
  "desc": "Specify hardwood floor installation method",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0902",
  "updated_at": ISODate("2015-11-18T12:49:15.773Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c74"),
  "attr_id": "501",
  "label": "Hardwood Floor Treatment",
  "desc": "Specify the type of treatment for hardwood floors",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0903",
  "updated_at": ISODate("2015-11-18T12:49:15.774Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c75"),
  "attr_id": "502",
  "label": "Abrasion Class",
  "desc": "Specify abrasion class",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0904",
  "updated_at": ISODate("2015-11-18T12:49:15.775Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c77"),
  "attr_id": "504",
  "label": "Carpet Type",
  "desc": "Specify type of carpet",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0905",
  "updated_at": ISODate("2015-11-18T12:49:15.776Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c7b"),
  "attr_id": "508",
  "label": "Furniture Treatment",
  "desc": "Specify treatment",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0907",
  "updated_at": ISODate("2015-11-18T12:49:15.777Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c7c"),
  "attr_id": "509",
  "label": "Product Status",
  "desc": "Specify the product condition",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0908",
  "updated_at": ISODate("2015-11-18T12:49:15.778Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c7d"),
  "attr_id": "510",
  "label": "Bed\/Mattress Space",
  "desc": "Specify Bed\/Mattress Space",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0909",
  "updated_at": ISODate("2015-11-18T12:49:15.779Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c7e"),
  "attr_id": "511",
  "label": "Furniture Comfort",
  "desc": "Specify whether padded or not padded",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b090a",
  "updated_at": ISODate("2015-11-18T12:49:15.780Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b49"),
  "attr_id": "208",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b4a"),
  "attr_id": "209",
  "label": "HVAC Accessories Description",
  "desc": "Describe the accessories",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b4c"),
  "attr_id": "211",
  "label": "Model",
  "desc": "Enter product model",
  "field_type": "T",
  "len": "20",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b4d"),
  "attr_id": "212",
  "label": "HVAC Performance Description",
  "desc": "Describe the performance of the machine",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b4f"),
  "attr_id": "214",
  "label": "Screw Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b50"),
  "attr_id": "215",
  "label": "Theoretical Shot Volume (cm3)",
  "desc": "Specify volume in cubic centimetres",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b51"),
  "attr_id": "216",
  "label": "Screw L\/D Ratio",
  "desc": "Specify proportion",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b52"),
  "attr_id": "217",
  "label": "Space Between Tie Bar (HxW) (mm)",
  "desc": "Specify height x width in millimeters",
  "field_type": "N",
  "len": "14",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b53"),
  "attr_id": "218",
  "label": "Mold Platen Dimensions (HxW) (mm)",
  "desc": "Specify height x width in millimeters",
  "field_type": "N",
  "len": "14",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b54"),
  "attr_id": "219",
  "label": "Clamping Force (KN)",
  "desc": "Specify force in kilonewton",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b55"),
  "attr_id": "220",
  "label": "Opening Stroke (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b56"),
  "attr_id": "221",
  "label": "Width of Die (mm)",
  "desc": "Specify width in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b57"),
  "attr_id": "222",
  "label": "Maximum Mould Size (LxWxH) (mm)",
  "desc": "Specify height x width x length in millimeters",
  "field_type": "N",
  "len": "20",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b58"),
  "attr_id": "223",
  "label": "Winder Type",
  "desc": "Specify the type",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b59"),
  "attr_id": "224",
  "label": "Pump Motor Power (Kw)",
  "desc": "Specify power in kilowatts",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b5a"),
  "attr_id": "225",
  "label": "Heating Power\/Capacity (Kw)",
  "desc": "Specify power in kilowatts",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b5b"),
  "attr_id": "226",
  "label": "Pump Pressure (Max.) (kg\/cm2)",
  "desc": "Specify the maximum pressure in kilograms per cubic centimeters",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b5c"),
  "attr_id": "227",
  "label": "Extrusion Capacity\/Output (kg\/hr)",
  "desc": "Specify production capacity in kilograms per hour",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b5d"),
  "attr_id": "228",
  "label": "Extruder Motor Power (Kw)",
  "desc": "Specify power in kilowatts",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b5e"),
  "attr_id": "229",
  "label": "Raw Materials",
  "desc": "Specify the type of raw material",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b5f"),
  "attr_id": "230",
  "label": "Number of Barrels",
  "desc": "Specify the number",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b60"),
  "attr_id": "231",
  "label": "Barrel Size (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b61"),
  "attr_id": "232",
  "label": "Inlet Mouth Size (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b62"),
  "attr_id": "233",
  "label": "Number of Rotating Knives",
  "desc": "Specify the number",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b63"),
  "attr_id": "234",
  "label": "Number of Fixed Knives",
  "desc": "Specify the number",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b64"),
  "attr_id": "235",
  "label": "Rotor Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b66"),
  "attr_id": "237",
  "label": "Worked Hours",
  "desc": "Specify the hours worked (for used equipment)",
  "field_type": "N",
  "len": "8",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aad"),
  "attr_id": "53",
  "label": "Image 10",
  "desc": "Image 10",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aae"),
  "attr_id": "54",
  "label": "Image 11",
  "desc": "Image 11",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aaf"),
  "attr_id": "55",
  "label": "Image 12",
  "desc": "Image 12",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ab0"),
  "attr_id": "56",
  "label": "Image 13",
  "desc": "Image 13",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ab1"),
  "attr_id": "57",
  "label": "Image 14",
  "desc": "Image 14",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ab2"),
  "attr_id": "58",
  "label": "Image 15",
  "desc": "Image 15",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ab3"),
  "attr_id": "59",
  "label": "Image 16",
  "desc": "Image 16",
  "field_type": "I",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ab5"),
  "attr_id": "61",
  "label": "URL (Link) Company URL",
  "desc": "Enter the link to your website",
  "field_type": "U",
  "len": "",
  "class": "CO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ab9"),
  "attr_id": "65",
  "label": "CPU Processor Type",
  "desc": "Specify CPU type, model or processor ID",
  "field_type": "T",
  "len": "8",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aba"),
  "attr_id": "66",
  "label": "SPEED",
  "desc": "Specify processor speed",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707abb"),
  "attr_id": "67",
  "label": "RAM",
  "desc": "Specify how much RAM (memory) is installed on the machine",
  "field_type": "T",
  "len": "8",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707abc"),
  "attr_id": "68",
  "label": "HDD",
  "desc": "Specify hard disk size on the machine",
  "field_type": "T",
  "len": "6",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707abf"),
  "attr_id": "71",
  "label": "Screen Size (Inch)",
  "desc": "Specify the screen size in inches",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ac7"),
  "attr_id": "78",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ac8"),
  "attr_id": "79",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ac9"),
  "attr_id": "80",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aca"),
  "attr_id": "81",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707acb"),
  "attr_id": "82",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707acc"),
  "attr_id": "83",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707acd"),
  "attr_id": "84",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707acf"),
  "attr_id": "86",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b7b"),
  "attr_id": "258",
  "label": "Sleeves Type",
  "desc": "Sleeves - Table",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a14",
  "updated_at": ISODate("2015-11-18T12:49:15.706Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b7d"),
  "attr_id": "260",
  "label": "Pants Leg Type",
  "desc": "Leg type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a16",
  "updated_at": ISODate("2015-11-18T12:49:15.708Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b81"),
  "attr_id": "264",
  "label": "Hood",
  "desc": "Hood",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a1a",
  "updated_at": ISODate("2015-11-18T12:49:15.711Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b82"),
  "attr_id": "265",
  "label": "Zip",
  "desc": "Clothing: ZIP (ZIP presence)",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a1b",
  "updated_at": ISODate("2015-11-18T12:49:15.712Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b83"),
  "attr_id": "266",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b84"),
  "attr_id": "267",
  "label": "Ball Dimension",
  "desc": "Ball size",
  "field_type": "T",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b85"),
  "attr_id": "267a",
  "label": "Ball Weight (grams)",
  "desc": "Ball weight (grams)",
  "field_type": "N",
  "len": "6",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b88"),
  "attr_id": "270",
  "label": "Gauge",
  "desc": "Specify gauge",
  "field_type": "N",
  "len": "4",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b89"),
  "attr_id": "271",
  "label": "Number of Cells",
  "desc": "Specify number of cells",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b8c"),
  "attr_id": "274",
  "label": "Power",
  "desc": "Specify power",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b8f"),
  "attr_id": "277",
  "label": "Year of Construction",
  "desc": "Year of manufacture of the product for sale",
  "field_type": "D",
  "len": "4",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b90"),
  "attr_id": "278",
  "label": "Automotive: Year of Registration",
  "desc": "Year of registration for automotive products",
  "field_type": "D",
  "len": "4",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b91"),
  "attr_id": "279",
  "label": "Bike Model",
  "desc": "Bicycle Model",
  "field_type": "T",
  "len": "20",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b92"),
  "attr_id": "280",
  "label": "Trim",
  "desc": "Choose the car trim from the table",
  "field_type": "T",
  "len": "30",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b93"),
  "attr_id": "281",
  "label": "Car Category",
  "desc": "Car Category",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a21",
  "updated_at": ISODate("2015-11-18T12:49:15.717Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b94"),
  "attr_id": "282",
  "label": "Engine Position",
  "desc": "Engine position",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a22",
  "updated_at": ISODate("2015-11-18T12:49:15.718Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b95"),
  "attr_id": "283",
  "label": "Engine Type",
  "desc": "Engine Type",
  "field_type": "T",
  "len": "30",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b96"),
  "attr_id": "284",
  "label": "Valves per Cylinder",
  "desc": "Number of valves per cylinder",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b97"),
  "attr_id": "285",
  "label": "Car Transmission Number of Speed",
  "desc": "Number of gears",
  "field_type": "N",
  "len": "1",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b98"),
  "attr_id": "286",
  "label": "Car\/Moto Drive",
  "desc": "Traction type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a23",
  "updated_at": ISODate("2015-11-18T12:49:15.719Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b99"),
  "attr_id": "287",
  "label": "Car\/Moto Seats",
  "desc": "Number of car\/motorcycle seats",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b9a"),
  "attr_id": "288",
  "label": "Car Doors",
  "desc": "Number of doors",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b9b"),
  "attr_id": "289",
  "label": "Car Chassis",
  "desc": "Chassis style",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a24",
  "updated_at": ISODate("2015-11-18T12:49:15.720Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b9c"),
  "attr_id": "290",
  "label": "CO2 Emissions",
  "desc": "CO2 emissions",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a25",
  "updated_at": ISODate("2015-11-18T12:49:15.721Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b9f"),
  "attr_id": "293",
  "label": "Cargo Space (Volume)",
  "desc": "Cargo space (volume)",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ba0"),
  "attr_id": "294",
  "label": "Fuel Tank Capacity (Volume)",
  "desc": "Tank capacity (volume)",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ba1"),
  "attr_id": "295",
  "label": "Fuel Delivery",
  "desc": "Fuel: power mode",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a28",
  "updated_at": ISODate("2015-11-18T12:49:15.723Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707af2"),
  "attr_id": "121",
  "label": "Engine Power (Kw or W, please specify)",
  "desc": "Motor power (Kw or W, please specify)",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707af3"),
  "attr_id": "122",
  "label": "Maximum Weight Limit (Kg or Lb, please specify)",
  "desc": "Maximum load allowed (Kg or Lb, pls specify)",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707af4"),
  "attr_id": "123",
  "label": "Shaft Description",
  "desc": "Describe material, torque, inflection point, etc.",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707af5"),
  "attr_id": "124",
  "label": "Protections Size",
  "desc": "Specify protective clothing size",
  "field_type": "T",
  "len": "4",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707af6"),
  "attr_id": "125",
  "label": "Grip Material",
  "desc": "Describe type of material",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707afb"),
  "attr_id": "130",
  "label": "Shoes Size (Men\/Women\/Boy & Girl KID & JUNIOR)",
  "desc": "Shoe size - man\/woman\/kid\/junior",
  "field_type": "N",
  "len": "4",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707afc"),
  "attr_id": "131",
  "label": "Shoes Size (Boy & Girl BABY)",
  "desc": "Define the shoes size",
  "field_type": "T",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707afe"),
  "attr_id": "133",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b00"),
  "attr_id": "135",
  "label": "Food & Beverage: Region of Origin",
  "desc": "Specify the region of origin of the product",
  "field_type": "T",
  "len": "25",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b01"),
  "attr_id": "136",
  "label": "Food & Beverage: List of Ingredients",
  "desc": "Specify the list of ingredients",
  "field_type": "T",
  "len": "15",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b02"),
  "attr_id": "137",
  "label": "Heels Size: Height",
  "desc": "Height of the heels on the shoes - men\/women",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b03"),
  "attr_id": "138",
  "label": "Platform Size: Height",
  "desc": "Platform height",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b0a"),
  "attr_id": "145",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b0b"),
  "attr_id": "146",
  "label": "Ties Shape",
  "desc": "Specify tie shape",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289ee",
  "updated_at": ISODate("2015-11-18T12:49:15.669Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b0c"),
  "attr_id": "147",
  "label": "Bow Ties",
  "desc": "Bow Ties",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289ef",
  "updated_at": ISODate("2015-11-18T12:49:15.670Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b0e"),
  "attr_id": "149",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b0f"),
  "attr_id": "150",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b10"),
  "attr_id": "151",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b11"),
  "attr_id": "152",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b18"),
  "attr_id": "159",
  "label": "Hats Size",
  "desc": "Hats - Define Size",
  "field_type": "N",
  "len": "4",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b1c"),
  "attr_id": "163",
  "label": "Gloves Size",
  "desc": "Gloves - Define size",
  "field_type": "T",
  "len": "4",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b1e"),
  "attr_id": "165",
  "label": "Fashion Collection Name",
  "desc": "Enter Collection Name",
  "field_type": "T",
  "len": "15",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b1f"),
  "attr_id": "166",
  "label": "Fashion Status",
  "desc": "Status - Fashion",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289fb",
  "updated_at": ISODate("2015-11-18T12:49:15.682Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b21"),
  "attr_id": "168",
  "label": "Voltage: 110\/220\/340 Volts",
  "desc": "Specify the equipment voltage",
  "field_type": "N",
  "len": "8",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b22"),
  "attr_id": "169",
  "label": "Capacity (Liters)",
  "desc": "Specify the equipment volumetric capacity",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b24"),
  "attr_id": "171",
  "label": "Designer",
  "desc": "Specify the designer name if available otherwise digit NO BRAND or OEM",
  "field_type": "T",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b26"),
  "attr_id": "173",
  "label": "Food & Beverage: How to Preserve\/Store",
  "desc": "Specify how to preserve the food",
  "field_type": "T",
  "len": "15",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b2a"),
  "attr_id": "177",
  "label": "Men Shirt Size",
  "desc": "Size - men shirts",
  "field_type": "T",
  "len": "4",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b2e"),
  "attr_id": "181",
  "label": "Denim Size",
  "desc": "Denim size",
  "field_type": "T",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b30"),
  "attr_id": "183",
  "label": "Women Underwear Cup Size",
  "desc": "Size - Lingerie - Women''s Cup",
  "field_type": "T",
  "len": "4",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b31"),
  "attr_id": "184",
  "label": "Women Underwear Size",
  "desc": "Underwear Size - Women",
  "field_type": "T",
  "len": "4",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b32"),
  "attr_id": "185",
  "label": "Men Underwear Size",
  "desc": "Underwear Size - Men",
  "field_type": "T",
  "len": "4",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b33"),
  "attr_id": "186",
  "label": "Hosiery Size",
  "desc": "Socks size",
  "field_type": "T",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b34"),
  "attr_id": "187",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b40"),
  "attr_id": "199",
  "label": "Specify Butchered Parts",
  "desc": "Specify which parts of the animal were slaughtered",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b41"),
  "attr_id": "200",
  "label": "Specify Animal Species",
  "desc": "Specify the animal breed",
  "field_type": "T",
  "len": "15",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b42"),
  "attr_id": "201",
  "label": "Animal Age (months)",
  "desc": "Specify the animal age",
  "field_type": "N",
  "len": "4",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b45"),
  "attr_id": "204",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b46"),
  "attr_id": "205",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b47"),
  "attr_id": "206",
  "label": "Number of Cookers",
  "desc": "Specify the number of cookers",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b48"),
  "attr_id": "207",
  "label": "Blade Diameter Ø (mm)",
  "desc": "Specify the blade diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bd1"),
  "attr_id": "343",
  "label": "Garden",
  "desc": "Garden",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08e2",
  "updated_at": ISODate("2015-11-18T12:49:15.740Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bd2"),
  "attr_id": "344",
  "label": "Garage Type",
  "desc": "Garage Type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08e3",
  "updated_at": ISODate("2015-11-18T12:49:15.741Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bd5"),
  "attr_id": "347",
  "label": "Car Model",
  "desc": "Car Model",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bd6"),
  "attr_id": "348",
  "label": "Motorcycle Model",
  "desc": "Motorcycle Model",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bd7"),
  "attr_id": "349",
  "label": "Aircraft Model",
  "desc": "Aircraft Model",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bd8"),
  "attr_id": "350",
  "label": "Furniture Description",
  "desc": "Describe the available furniture",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bd9"),
  "attr_id": "351",
  "label": "Boat Model",
  "desc": "Boat Model",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bda"),
  "attr_id": "352",
  "label": "Property Style Description",
  "desc": "Choose property style",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bdb"),
  "attr_id": "353",
  "label": "Property Status",
  "desc": "Property status",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08e6",
  "updated_at": ISODate("2015-11-18T12:49:15.744Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bdc"),
  "attr_id": "354",
  "label": "Number of Floors",
  "desc": "Number of stories",
  "field_type": "T",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bdd"),
  "attr_id": "355",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bde"),
  "attr_id": "356",
  "label": "Warranty Month",
  "desc": "Warranty (months)",
  "field_type": "T",
  "len": "20",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bdf"),
  "attr_id": "357",
  "label": "Property Minimum Price",
  "desc": "Property Minimum Price",
  "field_type": "N",
  "len": "9",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707be0"),
  "attr_id": "358",
  "label": "Property Maximum Price",
  "desc": "Property Maximum Price",
  "field_type": "N",
  "len": "9",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707be1"),
  "attr_id": "359",
  "label": "Lot Size",
  "desc": "Lot square footage",
  "field_type": "N",
  "len": "8",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707be3"),
  "attr_id": "361",
  "label": "Master Bedrooms Number",
  "desc": "Number of Master Bedrooms",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707be4"),
  "attr_id": "362",
  "label": "Total Rooms Number",
  "desc": "Total rooms (number)",
  "field_type": "N",
  "len": "4",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707be5"),
  "attr_id": "363",
  "label": "Bedrooms Description",
  "desc": "Bedrooms Description",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707be7"),
  "attr_id": "365",
  "label": "Living Room & Interior Description",
  "desc": "Living Room & Interior Description",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707be8"),
  "attr_id": "366",
  "label": "Garden Size",
  "desc": "Garden Size",
  "field_type": "N",
  "len": "8",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bea"),
  "attr_id": "368",
  "label": "Car Port Number",
  "desc": "Number of parking spaces",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707beb"),
  "attr_id": "369",
  "label": "Amenities Description",
  "desc": "Amenities Description",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bec"),
  "attr_id": "370",
  "label": "Cooling Description",
  "desc": "Cooling (description)",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bee"),
  "attr_id": "372",
  "label": "Property Description",
  "desc": "Describe the property or load photos",
  "field_type": "T",
  "len": "1000",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bef"),
  "attr_id": "373",
  "label": "Lot Description",
  "desc": "Lot Description",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bf0"),
  "attr_id": "374",
  "label": "Guest House Size",
  "desc": "Guest House Size",
  "field_type": "N",
  "len": "8",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bf3"),
  "attr_id": "377",
  "label": "Property\/Motors\/Boat: Address\/Street",
  "desc": "Property\/Motors\/Boat: Address\/Street",
  "field_type": "T",
  "len": "30",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b67"),
  "attr_id": "238",
  "label": "Hourly Output (Kg\/h)",
  "desc": "Specify production capacity in kilograms per hour",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b68"),
  "attr_id": "239",
  "label": "Capacity (Kg)",
  "desc": "Specify capacity in kilograms",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b69"),
  "attr_id": "240",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b6a"),
  "attr_id": "241",
  "label": "Features for Separators",
  "desc": "Describe the machine features",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b6b"),
  "attr_id": "242",
  "label": "Features for Dosing & Metering Machines",
  "desc": "Describe the machine features",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b6c"),
  "attr_id": "243",
  "label": "Features for Clamping Machines",
  "desc": "Describe the machine features",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b6d"),
  "attr_id": "244",
  "label": "Features for Extruders",
  "desc": "Describe the machine features",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b6e"),
  "attr_id": "245",
  "label": "Features for Energy",
  "desc": "Describe the machine features",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b6f"),
  "attr_id": "246",
  "label": "Features for Die",
  "desc": "Describe the machine features",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b70"),
  "attr_id": "247",
  "label": "Features for Bending & Folding Machines",
  "desc": "Describe the machine features",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b71"),
  "attr_id": "248",
  "label": "Spindle Length (mm)",
  "desc": "Specify length in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b72"),
  "attr_id": "249",
  "label": "Transversal Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b73"),
  "attr_id": "250",
  "label": "Vertical Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b74"),
  "attr_id": "251",
  "label": "Spindle Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b75"),
  "attr_id": "252",
  "label": "Table Size (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b76"),
  "attr_id": "253",
  "label": "Spindle Speed (RPM)",
  "desc": "Specify speed in RPM",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b77"),
  "attr_id": "254",
  "label": "Max Weight on Table (Kg)",
  "desc": "Specify maximum weight in kilograms",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b78"),
  "attr_id": "255",
  "label": "Working Feed (mm\/sec)",
  "desc": "Specify in millimeters per second",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b79"),
  "attr_id": "256",
  "label": "Rapid Feed (mm\/sec)",
  "desc": "Specify in millimeters per second",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c1c"),
  "attr_id": "418",
  "label": "Clarity - measurement unit",
  "desc": "Measurement unit for clarity",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c1d"),
  "attr_id": "419",
  "label": "Brightness",
  "desc": "Brightness",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c1e"),
  "attr_id": "420",
  "label": "Brightness - Lumen unit",
  "desc": "Measurement unit for brightness",
  "field_type": "T",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c1f"),
  "attr_id": "421",
  "label": "Yarn\/Denier (Nylon Stockings)",
  "desc": "Yarn\/Denier (Nylon Stockings)",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c21"),
  "attr_id": "423",
  "label": "Pressure",
  "desc": "Pressure",
  "field_type": "N",
  "len": "6",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c24"),
  "attr_id": "166;3;2",
  "label": "Vintage Era",
  "desc": "Vintage Era",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08f9",
  "updated_at": ISODate("2015-11-18T12:49:15.764Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c27"),
  "attr_id": "202;2",
  "label": "Year of Production for Wines & Liquors",
  "desc": "Year of production for wines and spirits",
  "field_type": "N",
  "len": "4",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c28"),
  "attr_id": "425",
  "label": "Lower Rolls Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c29"),
  "attr_id": "426",
  "label": "Number of Rolls",
  "desc": "Specify number",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c2a"),
  "attr_id": "427",
  "label": "Max. Cutting Thickness (mm)",
  "desc": "Specify maximum thickness in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c2b"),
  "attr_id": "428",
  "label": "GAP (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c2c"),
  "attr_id": "429",
  "label": "Tank (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c2d"),
  "attr_id": "430",
  "label": "X Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c2e"),
  "attr_id": "431",
  "label": "Y Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c2f"),
  "attr_id": "432",
  "label": "Z Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c30"),
  "attr_id": "433",
  "label": "Maximum Working Weight (Kg)",
  "desc": "Specify maximum weight in kilograms",
  "field_type": "N",
  "len": "8",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c31"),
  "attr_id": "434",
  "label": "Maximum Working Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c32"),
  "attr_id": "435",
  "label": "Rotating Speed (RPM)",
  "desc": "Specify speed in RPM",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c33"),
  "attr_id": "436",
  "label": "RAM Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c34"),
  "attr_id": "437",
  "label": "Spindle Taper (ISO)",
  "desc": "Specify size in ISO",
  "field_type": "N",
  "len": "8",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c35"),
  "attr_id": "438",
  "label": "Spindle Power (kw)",
  "desc": "Specify power in kilowatts",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c36"),
  "attr_id": "439",
  "label": "Portal Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c37"),
  "attr_id": "440",
  "label": "Max. Working Height (mm)",
  "desc": "Specify height in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c38"),
  "attr_id": "441",
  "label": "Crossrail Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c39"),
  "attr_id": "442",
  "label": "Table Hole Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c3a"),
  "attr_id": "443",
  "label": "Table Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c3b"),
  "attr_id": "444",
  "label": "Longitudinal Travel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ba2"),
  "attr_id": "296",
  "label": "Front Tyres Type",
  "desc": "Type of front wheels",
  "field_type": "T",
  "len": "12",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ba3"),
  "attr_id": "297",
  "label": "Rear Tyres Type",
  "desc": "Type of rear wheels",
  "field_type": "T",
  "len": "12",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ba4"),
  "attr_id": "298",
  "label": "Maximum Speed",
  "desc": "Maximum Speed",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ba5"),
  "attr_id": "299",
  "label": "Fuel Consumption (\/100)",
  "desc": "Fuel consumption (\/100)",
  "field_type": "T",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ba6"),
  "attr_id": "300",
  "label": "Engine Size",
  "desc": "Displacement",
  "field_type": "N",
  "len": "8",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ba8"),
  "attr_id": "302",
  "label": "Mileage",
  "desc": "Mileage (Km or Miles)",
  "field_type": "N",
  "len": "7",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bab"),
  "attr_id": "305",
  "label": "Fuel",
  "desc": "Type of fuel used",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fbfd2cdd8a57a8b08d6",
  "updated_at": ISODate("2015-11-18T12:49:15.727Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bac"),
  "attr_id": "306",
  "label": "Date of Last Inspection",
  "desc": "Date of latest revision",
  "field_type": "D",
  "len": "10",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bae"),
  "attr_id": "308",
  "label": "Seller Reference Code",
  "desc": "Seller reference code",
  "field_type": "T",
  "len": "15",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707baf"),
  "attr_id": "309",
  "label": "Engine Number",
  "desc": "Number of engines",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08d7",
  "updated_at": ISODate("2015-11-18T12:49:15.728Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bb1"),
  "attr_id": "311",
  "label": "Number of Tanks",
  "desc": "Number of tanks",
  "field_type": "N",
  "len": "1",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bb2"),
  "attr_id": "312",
  "label": "Boat Equipped with Sails (type description)",
  "desc": "Type of sails with which the boat is equipped",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bb3"),
  "attr_id": "313",
  "label": "Berth Number",
  "desc": "Beds",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bb4"),
  "attr_id": "314",
  "label": "Draught",
  "desc": "Draught",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bb5"),
  "attr_id": "315",
  "label": "Offer Type",
  "desc": "Select offer type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08d9",
  "updated_at": ISODate("2015-11-18T12:49:15.731Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bb6"),
  "attr_id": "316",
  "label": "Extra Accessories",
  "desc": "Extra accessories",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bb8"),
  "attr_id": "318",
  "label": "Broker Name",
  "desc": "Broker Name, if available",
  "field_type": "T",
  "len": "30",
  "class": "CO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bb9"),
  "attr_id": "319",
  "label": "Broker Trade Mark",
  "desc": "Broker Logo, if available",
  "field_type": "I",
  "len": "",
  "class": "CO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bba"),
  "attr_id": "320",
  "label": "Wear Grade (from 1 to 10)",
  "desc": "Degree of wear (1 to 10)",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bbb"),
  "attr_id": "321",
  "label": "Aircraft Interior Description",
  "desc": "Description of the aircraft interior",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bbc"),
  "attr_id": "322",
  "label": "Aircraft: Maintenance Needed",
  "desc": "Type of maintenance needed by the aircraft",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bbd"),
  "attr_id": "323",
  "label": "APU (Auxiliary Power Unit)",
  "desc": "APU (Auxiliary Power Unit)",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bbf"),
  "attr_id": "325",
  "label": "Aircraft Registration No",
  "desc": "Registration number",
  "field_type": "T",
  "len": "20",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bc0"),
  "attr_id": "326",
  "label": "Flight Time",
  "desc": "Hours flown",
  "field_type": "T",
  "len": "6",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bc1"),
  "attr_id": "327",
  "label": "Avionics",
  "desc": "Describe the equipment installed on board",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bc2"),
  "attr_id": "328",
  "label": "Additional Features\/Equipment",
  "desc": "Describe the equipment installed on board",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bc3"),
  "attr_id": "329",
  "label": "Aircraft Exterior Description",
  "desc": "Describe the aircraft external conditions",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bc5"),
  "attr_id": "331",
  "label": "Property Size",
  "desc": "Specific Commercial square footage of the property",
  "field_type": "N",
  "len": "7",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bc6"),
  "attr_id": "332",
  "label": "Total Number of Bedrooms",
  "desc": "Total Number of Bedrooms",
  "field_type": "N",
  "len": "4",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bc7"),
  "attr_id": "333",
  "label": "Total Number of Bathrooms",
  "desc": "Total Number of Bathrooms",
  "field_type": "N",
  "len": "4",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bc8"),
  "attr_id": "334",
  "label": "Kitchen Type",
  "desc": "Kitchen Type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08dc",
  "updated_at": ISODate("2015-11-18T12:49:15.735Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bca"),
  "attr_id": "336",
  "label": "Total Number of Living Rooms",
  "desc": "Living room: specify number",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bcb"),
  "attr_id": "337",
  "label": "Heating Description",
  "desc": "Heating (description)",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bcd"),
  "attr_id": "339",
  "label": "Property Floor Location",
  "desc": "Specify at which floor the property is located",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bd0"),
  "attr_id": "342",
  "label": "Attic",
  "desc": "Attic",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08e1",
  "updated_at": ISODate("2015-11-18T12:49:15.739Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c59"),
  "attr_id": "474",
  "label": "Working Radius from Column (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c5a"),
  "attr_id": "475",
  "label": "Column Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c5b"),
  "attr_id": "476",
  "label": "Drilling Length (mm)",
  "desc": "Specify length in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c5c"),
  "attr_id": "477",
  "label": "Gear Width (mm)",
  "desc": "Specify width in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c5d"),
  "attr_id": "478",
  "label": "Stroke Length (mm)",
  "desc": "Specify length in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c5e"),
  "attr_id": "479",
  "label": "Shaving Cutter Size (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c5f"),
  "attr_id": "480",
  "label": "Grinding Wheel (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c60"),
  "attr_id": "481",
  "label": "Product Name",
  "desc": "Specify product name",
  "field_type": "T",
  "len": "30",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c61"),
  "attr_id": "482",
  "label": "Processor Speed",
  "desc": "Specify processor speed",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c62"),
  "attr_id": "483",
  "label": "Processor Socket",
  "desc": "Specify the type of memory sockets",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c64"),
  "attr_id": "485",
  "label": "Memory Capacity (GB)",
  "desc": "Specify memory capacity",
  "field_type": "N",
  "len": "6",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c65"),
  "attr_id": "486",
  "label": "Memory PIN Number",
  "desc": "Specify memory PIN number",
  "field_type": "N",
  "len": "4",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c66"),
  "attr_id": "487",
  "label": "Accessory Description",
  "desc": "Specify included accessories",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c67"),
  "attr_id": "488",
  "label": "Material Composition Description",
  "desc": "Specify the type of material",
  "field_type": "T",
  "len": "60",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c69"),
  "attr_id": "490",
  "label": "Agriculture - Standard Equipment Description",
  "desc": "Describe the basic composition of the equipment",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c6a"),
  "attr_id": "491",
  "label": "Agriculture - Optional Accessories on demand",
  "desc": "List accessories available upon request",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c6b"),
  "attr_id": "492",
  "label": "Operating Temperature (°C)",
  "desc": "Indicate the temperature",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c6d"),
  "attr_id": "494",
  "label": "Job Description",
  "desc": "Describe your business\/competences",
  "field_type": "T",
  "len": "60",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c71"),
  "attr_id": "498",
  "label": "",
  "desc": "",
  "field_type": "",
  "len": "",
  "class": "",
  "req": "",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c76"),
  "attr_id": "503",
  "label": "Floor\/Wall Covering\/Textile - Pattern Description",
  "desc": "Describe the design of the product",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c78"),
  "attr_id": "505",
  "label": "Heatable Volume (m3)",
  "desc": "Specify the number of cubic meters heated by the product",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c79"),
  "attr_id": "506",
  "label": "Upholstery Type",
  "desc": "Describe the type of upholstery",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c7a"),
  "attr_id": "507",
  "label": "Style",
  "desc": "Specify product style",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0906",
  "updated_at": ISODate("2015-11-18T12:49:15.777Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c7f"),
  "attr_id": "512",
  "label": "Bed Special Features",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b090b",
  "updated_at": ISODate("2015-11-18T12:49:15.781Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c80"),
  "attr_id": "513",
  "label": "Bed Type",
  "desc": "Specify bed type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b090c",
  "updated_at": ISODate("2015-11-18T12:49:15.782Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c83"),
  "attr_id": "516",
  "label": "Number of Drawers",
  "desc": "Specify the number of drawers",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c84"),
  "attr_id": "517",
  "label": "Number of Doors",
  "desc": "Specify the number of doors",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bf5"),
  "attr_id": "379",
  "label": "Property\/Motors\/Boat: County\/Municipality",
  "desc": "Property\/Motors\/Boat: County\/Municipality",
  "field_type": "T",
  "len": "30",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bf6"),
  "attr_id": "380",
  "label": "Property Land Register Data (Sheet)",
  "desc": "Property Land Register Data (Sheet)",
  "field_type": "T",
  "len": "10",
  "class": "LO",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bf7"),
  "attr_id": "381",
  "label": "Property Land Register Data (Blueprint)",
  "desc": "Property Land Register Data (Blueprint)",
  "field_type": "T",
  "len": "10",
  "class": "LO",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bf8"),
  "attr_id": "382",
  "label": "Property Land Register Data (Subordinate)",
  "desc": "Property Land Register Data (Subordinate)",
  "field_type": "T",
  "len": "10",
  "class": "LO",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bf9"),
  "attr_id": "383",
  "label": "Property Zoning Code",
  "desc": "Property Zoning code",
  "field_type": "T",
  "len": "10",
  "class": "LO",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bfa"),
  "attr_id": "384",
  "label": "Maximum Working Length (mm)",
  "desc": "Specify maximum length in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bfb"),
  "attr_id": "385",
  "label": "Maximum Working Thickness (mm)",
  "desc": "Specify maximum thickness in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bfc"),
  "attr_id": "386",
  "label": "Upper Roll Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c00"),
  "attr_id": "390",
  "label": "Team Description",
  "desc": "If your organization is divided into team, describes your work team",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c02"),
  "attr_id": "392",
  "label": "Service Starting Date",
  "desc": "Service starting date",
  "field_type": "D",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c03"),
  "attr_id": "393",
  "label": "Services Price Description",
  "desc": "Describe what services are included in the price.",
  "field_type": "T",
  "len": "50",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c06"),
  "attr_id": "396",
  "label": "Goods Shelf-life (Days)",
  "desc": "Product shelf-life (if perishable specify number of days)",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c07"),
  "attr_id": "397",
  "label": "Package (Description)",
  "desc": "Package (Description)",
  "field_type": "T",
  "len": "50",
  "class": "PK",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c08"),
  "attr_id": "398",
  "label": "Package Weight",
  "desc": "Package weight",
  "field_type": "N",
  "len": "6",
  "class": "PK",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c09"),
  "attr_id": "399",
  "label": "Packaging (Description)",
  "desc": "Packaging (Description)",
  "field_type": "T",
  "len": "50",
  "class": "PK",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c0a"),
  "attr_id": "400",
  "label": "Packaging Weight",
  "desc": "Packaging weight",
  "field_type": "N",
  "len": "6",
  "class": "PK",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c0b"),
  "attr_id": "401",
  "label": "Weight",
  "desc": "Weight",
  "field_type": "N",
  "len": "6",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c0d"),
  "attr_id": "403",
  "label": "Length",
  "desc": "Length",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c0f"),
  "attr_id": "405",
  "label": "Length2",
  "desc": "Length 2: secondary length",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c11"),
  "attr_id": "407",
  "label": "Depth\/Width",
  "desc": "Depth",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c13"),
  "attr_id": "409",
  "label": "Height",
  "desc": "Height",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c15"),
  "attr_id": "411",
  "label": "Volume",
  "desc": "Volume",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c17"),
  "attr_id": "413",
  "label": "Girth",
  "desc": "Girth",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c19"),
  "attr_id": "415",
  "label": "Diameter Ø",
  "desc": "Diameter Ø",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c1b"),
  "attr_id": "417",
  "label": "Clarity",
  "desc": "Clarity",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cae"),
  "attr_id": "559",
  "label": "Reflector Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b092d",
  "updated_at": ISODate("2015-11-18T12:49:15.813Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707caf"),
  "attr_id": "560",
  "label": "Lighting - Product Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b092e",
  "updated_at": ISODate("2015-11-18T12:49:15.813Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cb1"),
  "attr_id": "562",
  "label": "Lighting - Design Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0930",
  "updated_at": ISODate("2015-11-18T12:49:15.815Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cb2"),
  "attr_id": "563",
  "label": "Lighting Design Description",
  "desc": "Briefly describe the design",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cb3"),
  "attr_id": "564",
  "label": "Consumption (Kw)",
  "desc": "Specify consumption in kilowatt",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cb7"),
  "attr_id": "568",
  "label": "Sector\/Area of Use",
  "desc": "Specify the sector or area where it is used",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cb8"),
  "attr_id": "569",
  "label": "Conveyor Capacity (t\/h)",
  "desc": "Specify the conveyor capacity in tons per hour",
  "field_type": "T",
  "len": "15",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cb9"),
  "attr_id": "570",
  "label": "Conveyor Speed (m\/s)",
  "desc": "Specify conveyor speed in meters per second",
  "field_type": "T",
  "len": "15",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cba"),
  "attr_id": "571",
  "label": "Jib (mt)",
  "desc": "Specify jib size in meters",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cbb"),
  "attr_id": "572",
  "label": "Forks Length (mm)",
  "desc": "Specify fork length in millimeters",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cbc"),
  "attr_id": "573",
  "label": "Mast Type",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0934",
  "updated_at": ISODate("2015-11-18T12:49:15.818Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cbd"),
  "attr_id": "574",
  "label": "Shipment",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0935",
  "updated_at": ISODate("2015-11-18T12:49:15.819Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cc2"),
  "attr_id": "575",
  "label": "Shipment Information",
  "desc": "Add more information or specifications concerning the transport",
  "field_type": "T",
  "len": "50",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cc4"),
  "attr_id": "577",
  "label": "Melting Temperature (°C)",
  "desc": "Specify the melting temperature",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cc8"),
  "attr_id": "581",
  "label": "Hardness",
  "desc": "Select stone hardness",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b093a",
  "updated_at": ISODate("2015-11-18T12:49:15.825Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ccc"),
  "attr_id": "585",
  "label": "Drying time between coats",
  "desc": "Indicate drying time between coats",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ccf"),
  "attr_id": "588",
  "label": "Paint Certification",
  "desc": "Describe type of paint certification",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cd1"),
  "attr_id": "590",
  "label": "Capacity (m3\/h)",
  "desc": "Indicate capacity in cubic meters per hour",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cd2"),
  "attr_id": "591",
  "label": "Saw Type",
  "desc": "Select the type of saw",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b093f",
  "updated_at": ISODate("2015-11-18T12:49:15.830Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cd6"),
  "attr_id": "595",
  "label": "Planting",
  "desc": "Describe how to plant or planting specifications",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cd7"),
  "attr_id": "596",
  "label": "Plant Care and Other Info",
  "desc": "Describe how to take care of the plant",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cd8"),
  "attr_id": "597",
  "label": "Height Range (cm)",
  "desc": "Indicate the maximum height the adult plant can reach",
  "field_type": "N",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cdb"),
  "attr_id": "600",
  "label": "Return Policy (File upload)",
  "desc": "Upload a file with your return policy",
  "field_type": "F",
  "len": "",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cdc"),
  "attr_id": "601",
  "label": "Return Policy Description",
  "desc": "Describe your return policy",
  "field_type": "T",
  "len": "2000",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cde"),
  "attr_id": "603",
  "label": "Ecotax (%)",
  "desc": "Specify tax value (percentage)",
  "field_type": "N",
  "len": "6",
  "class": "TX",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cdf"),
  "attr_id": "604",
  "label": "Duty Tax (%)",
  "desc": "Specify tax value (percentage)",
  "field_type": "N",
  "len": "6",
  "class": "TX",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840c5a32774774707ce0"),
  "attr_id": "605",
  "label": "Local Tax (other than VAT) (%)",
  "desc": "Specify tax value (percentage)",
  "field_type": "N",
  "len": "6",
  "class": "TX",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c3c"),
  "attr_id": "445",
  "label": "Maximum External Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c3d"),
  "attr_id": "446",
  "label": "Maximum Internal Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c3e"),
  "attr_id": "447",
  "label": "Table Diameter Ø (mm)",
  "desc": "Specify diameter in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c3f"),
  "attr_id": "448",
  "label": "Max. Module",
  "desc": "Describe",
  "field_type": "T",
  "len": "40",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c40"),
  "attr_id": "449",
  "label": "Tooth Width (mm)",
  "desc": "Specify width in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c41"),
  "attr_id": "450",
  "label": "Number of Working Teeth Min.\/Max.",
  "desc": "Specify number",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c42"),
  "attr_id": "451",
  "label": "Spam (mm)",
  "desc": "Specify size in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c43"),
  "attr_id": "452",
  "label": "Max. Lifting Height (mm)",
  "desc": "Specify height in millimeters",
  "field_type": "N",
  "len": "5",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707adf"),
  "attr_id": "102",
  "label": "Lined Garment",
  "desc": "Specify whether the garment is lined or unlined",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289db",
  "updated_at": ISODate("2015-11-18T12:49:15.649Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ae0"),
  "attr_id": "103",
  "label": "Textile Composition: Bags",
  "desc": "Indicate which is the predominant material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289dc",
  "updated_at": ISODate("2015-11-18T12:49:15.654Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ae1"),
  "attr_id": "104",
  "label": "Textile Composition: Luggage",
  "desc": "Indicate which is the predominant material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289dd",
  "updated_at": ISODate("2015-11-18T12:49:15.650Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ae2"),
  "attr_id": "105",
  "label": "Material Composition of Luggage Exterior",
  "desc": "Indicate which is the predominant material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289de",
  "updated_at": ISODate("2015-11-18T12:49:15.655Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ae3"),
  "attr_id": "106",
  "label": "Luggage Wheeling Type",
  "desc": "Indicate the type of wheels",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289df",
  "updated_at": ISODate("2015-11-18T12:49:15.657Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ae5"),
  "attr_id": "108",
  "label": "Luggage Type",
  "desc": "Choose between the different options",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289e0",
  "updated_at": ISODate("2015-11-18T12:49:15.658Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b19"),
  "attr_id": "160",
  "label": "Hats Size - measurement unit ",
  "desc": "Hat: specify measurement unit",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289f7",
  "updated_at": ISODate("2015-11-18T12:49:15.679Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b1a"),
  "attr_id": "161",
  "label": "Material Composition: Gloves",
  "desc": "Gloves: specify the material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289f8",
  "updated_at": ISODate("2015-11-18T12:49:15.680Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c96"),
  "attr_id": "535",
  "label": "Door\/Window End Use",
  "desc": "Specify the intended use of the product",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b091b",
  "updated_at": ISODate("2015-11-18T12:49:15.796Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c99"),
  "attr_id": "538",
  "label": "Thermal Break",
  "desc": "Specify whether thermal break or not",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b091e",
  "updated_at": ISODate("2015-11-18T12:49:15.798Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c9b"),
  "attr_id": "540",
  "label": "Lighting Material",
  "desc": "Specify the material of which the product is made",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0920",
  "updated_at": ISODate("2015-11-18T12:49:15.801Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707afa"),
  "attr_id": "129",
  "label": "Shoe Sole Size",
  "desc": "Define the shoe sole size - Men\/Women\/Children",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289e5",
  "updated_at": ISODate("2015-11-18T12:49:15.662Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707afd"),
  "attr_id": "132",
  "label": "Head Material",
  "desc": "Specify the material from the table",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289e6",
  "updated_at": ISODate("2015-11-18T12:49:15.663Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aff"),
  "attr_id": "134",
  "label": "Material Composition: Sport Footwear",
  "desc": "Specify athletic shoes material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289e7",
  "updated_at": ISODate("2015-11-18T12:49:15.663Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b04"),
  "attr_id": "139",
  "label": "Heels & Platform Size: Height - measurement unit",
  "desc": "Specify heels and platforms height measurement unit",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289e8",
  "updated_at": ISODate("2015-11-18T12:49:15.664Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b05"),
  "attr_id": "140",
  "label": "Men Shoes: Heels Type",
  "desc": "Specify the type of heels - Men",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289e9",
  "updated_at": ISODate("2015-11-18T12:49:15.665Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b06"),
  "attr_id": "141",
  "label": "Women Shoes: Heels Type",
  "desc": "Specify the type of heels - Women",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289ea",
  "updated_at": ISODate("2015-11-18T12:49:15.666Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b07"),
  "attr_id": "142",
  "label": "Material Composition: Heels",
  "desc": "Specify heels material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289eb",
  "updated_at": ISODate("2015-11-18T12:49:15.666Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b08"),
  "attr_id": "143",
  "label": "Material Composition: Sole",
  "desc": "Specify sole material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289ec",
  "updated_at": ISODate("2015-11-18T12:49:15.667Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b09"),
  "attr_id": "144",
  "label": "Toe Shape",
  "desc": "Specify the shape of the tip",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289ed",
  "updated_at": ISODate("2015-11-18T12:49:15.668Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b0d"),
  "attr_id": "148",
  "label": "Ties: Manufacturing Type",
  "desc": "Ties - Type of manufacturing",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289f0",
  "updated_at": ISODate("2015-11-18T12:49:15.671Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b12"),
  "attr_id": "153",
  "label": "Material Composition: Belts",
  "desc": "Specify belt material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289f1",
  "updated_at": ISODate("2015-11-18T12:49:15.672Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b13"),
  "attr_id": "154",
  "label": "Material Composition: Belt Inserts",
  "desc": "Belt inserts - specify the material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289f2",
  "updated_at": ISODate("2015-11-18T12:49:15.674Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b14"),
  "attr_id": "155",
  "label": "Material Composition: Hats",
  "desc": "Hats - specify the material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289f3",
  "updated_at": ISODate("2015-11-18T12:49:15.675Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b15"),
  "attr_id": "156",
  "label": "Textile Composition: Sport Bags & Backpacks",
  "desc": "Sport Bags and Backpacks - specify the material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289f4",
  "updated_at": ISODate("2015-11-18T12:49:15.676Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b16"),
  "attr_id": "157",
  "label": "Hats: Band Color",
  "desc": "Hats - specify band color",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289f5",
  "updated_at": ISODate("2015-11-18T12:49:15.677Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b17"),
  "attr_id": "158",
  "label": "Material Composition: Hats Sweatband",
  "desc": "Hats - specify sweatbend material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289f6",
  "updated_at": ISODate("2015-11-18T12:49:15.678Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bcc"),
  "attr_id": "338",
  "label": "EPC (Energy Performance Certificate)",
  "desc": "Energy efficiency\/EPC (Energy Performance Certificate)",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08de",
  "updated_at": ISODate("2015-11-18T12:49:15.736Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bce"),
  "attr_id": "340",
  "label": "Lift",
  "desc": "Specify if the lift is present (and how many) or not",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08df",
  "updated_at": ISODate("2015-11-18T12:49:15.737Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bd3"),
  "attr_id": "345",
  "label": "Car Port Type",
  "desc": "Parking space: type of parking space",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08e4",
  "updated_at": ISODate("2015-11-18T12:49:15.742Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bd4"),
  "attr_id": "346",
  "label": "Contract Type",
  "desc": "Choose from the table",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08e5",
  "updated_at": ISODate("2015-11-18T12:49:15.743Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707be2"),
  "attr_id": "360",
  "label": "Property\/Lot Size - measurement unit",
  "desc": "Property\/Lot Size - measurement unit",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08e7",
  "updated_at": ISODate("2015-11-18T12:49:15.745Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707be6"),
  "attr_id": "364",
  "label": "Other Rooms (different from bedrooms)",
  "desc": "Other rooms (other than bedrooms)",
  "field_type": "TM",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08e8",
  "updated_at": ISODate("2015-11-18T12:49:15.746Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ca4"),
  "attr_id": "549",
  "label": "Lighting Cover Material",
  "desc": "Specify the product material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0926",
  "updated_at": ISODate("2015-11-18T12:49:15.807Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ca7"),
  "attr_id": "552",
  "label": "Theater Light",
  "desc": "Specify type of theater light",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0929",
  "updated_at": ISODate("2015-11-18T12:49:15.809Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ca8"),
  "attr_id": "553",
  "label": "Lighting - Type of Certification",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b092a",
  "updated_at": ISODate("2015-11-18T12:49:15.810Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707caa"),
  "attr_id": "555",
  "label": "Lighting Application",
  "desc": "Specify the field of use",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b092c",
  "updated_at": ISODate("2015-11-18T12:49:15.812Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cac"),
  "attr_id": "557",
  "label": "Lighting - Surface treatment",
  "desc": "Describe the type of surface treatment. If untreated, write untreated.",
  "field_type": "T",
  "len": "100",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cb0"),
  "attr_id": "561",
  "label": "Anti-shock Lighting",
  "desc": "Specify whether anti-shock or not",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b092f",
  "updated_at": ISODate("2015-11-18T12:49:15.814Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cb4"),
  "attr_id": "565",
  "label": "Socket Material",
  "desc": "Specify the product material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0931",
  "updated_at": ISODate("2015-11-18T12:49:15.816Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cb5"),
  "attr_id": "566",
  "label": "Table Product: Single or Set",
  "desc": "Specify whether you are selling a single product or a set",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0932",
  "updated_at": ISODate("2015-11-18T12:49:15.817Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a7b"),
  "attr_id": "4",
  "label": "Part Number",
  "desc": "Product international identification. It is different from the Reference or Serial Number.",
  "field_type": "T",
  "len": "20",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a81"),
  "attr_id": "10",
  "label": "Status ICT & Machinery",
  "desc": "Choose or select the Product Status",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c44becfcb85f2d289c6",
  "updated_at": ISODate("2015-11-18T12:48:28.301Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a82"),
  "attr_id": "11",
  "label": "Status Cars\/Moto\/Boats",
  "desc": "Choose or select the Product Status",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c44becfcb85f2d289c7",
  "updated_at": ISODate("2015-11-18T12:49:15.633Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a84"),
  "attr_id": "13",
  "label": "Currency Quotation",
  "desc": "Specify the currency of your listing",
  "field_type": "TD",
  "len": "",
  "class": "PZ",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c44becfcb85f2d289c8",
  "updated_at": ISODate("2015-11-18T12:49:15.651Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a85"),
  "attr_id": "14",
  "label": "Sale Type: Price or Auction",
  "desc": "Do you want to sell or create an auction?",
  "field_type": "TD",
  "len": "",
  "class": "PZ",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c44becfcb85f2d289c9",
  "updated_at": ISODate("2015-11-18T12:49:15.634Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a98"),
  "attr_id": "32",
  "label": "Price Information or Discount Policy",
  "desc": "Specify service content and its price or if a discount is provided",
  "field_type": "T",
  "len": "100",
  "class": "PZ",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a99"),
  "attr_id": "33",
  "label": "Price Reverse Auction (I want to pay)",
  "desc": "If you listed a reversed auction (REVERSE AUCTION) pls specify the price you want to pay",
  "field_type": "N",
  "len": "8",
  "class": "PZ",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a9a"),
  "attr_id": "34",
  "label": "Package\/Packaging Weight - measurement unit",
  "desc": "Specify package\/packaging weight measument unit",
  "field_type": "TD",
  "len": "",
  "class": "PK",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c44becfcb85f2d289ca",
  "updated_at": ISODate("2015-11-18T12:49:15.635Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a9b"),
  "attr_id": "35",
  "label": "Country where trade\/service item is available",
  "desc": "Specify in which COUNTRY you intend to provide the service or product",
  "field_type": "TD",
  "len": "",
  "class": "LO",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289cb",
  "updated_at": ISODate("2015-11-18T12:49:15.652Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a9c"),
  "attr_id": "36",
  "label": "City where trade\/service item is available",
  "desc": "Specify in which TOWN  you intend to provide the service or product",
  "field_type": "T",
  "len": "25",
  "class": "LO",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a9d"),
  "attr_id": "37",
  "label": "Zip code where trade\/service item is available",
  "desc": "Specify in which Zip Code you intend to provide the service or product",
  "field_type": "T",
  "len": "10",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a9e"),
  "attr_id": "38",
  "label": "Country Flag Boat\/Cars\/Moto",
  "desc": "Specify the country where the product\/vehicle or vessel is registered ",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289cb",
  "updated_at": ISODate("2015-11-19T01:21:59.409Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707a9f"),
  "attr_id": "39",
  "label": "Country Manufactured in",
  "desc": "Country where the item was made",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289cb",
  "updated_at": ISODate("2015-11-19T01:24:54.770Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aa0"),
  "attr_id": "40",
  "label": "Property GPS",
  "desc": "Enter the GPS coordinates (if available) for the property you want to list. You can find them with Google Earth.",
  "field_type": "T",
  "len": "30",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aa1"),
  "attr_id": "41",
  "label": "Boats Shipyard or Berth GPS",
  "desc": "Enter the GPS coordinates (if available) for the berth or place where is the vessel\/boat you want to list. You can find them with Google Earth.",
  "field_type": "T",
  "len": "30",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aa2"),
  "attr_id": "42",
  "label": "GPS (company offering service\/products)  ",
  "desc": "Enter your GPS coordinates, if available. You can find them with Google Earth.",
  "field_type": "T",
  "len": "30",
  "class": "CO",
  "req": "A",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aa3"),
  "attr_id": "43",
  "label": "Coverage Radius within the service will be performed (pls specify if KM or MI)",
  "desc": "Starting form your headquarters, specify the type of local coverage you offer for your service (specify if given in kilometers or miles).",
  "field_type": "T",
  "len": "10",
  "class": "CO",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289cc",
  "updated_at": ISODate("2015-11-18T12:49:15.636Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bc4"),
  "attr_id": "330",
  "label": "Status based on Appearance & Operation",
  "desc": "Choose a number based on the product aesthetic condition",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08db",
  "updated_at": ISODate("2015-11-18T12:49:15.734Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bc9"),
  "attr_id": "335",
  "label": "Dining Room Type",
  "desc": "Dining room -Type of dining room",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08dd",
  "updated_at": ISODate("2015-11-18T12:49:15.736Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707aec"),
  "attr_id": "115",
  "label": "Bags: Size Type",
  "desc": "Bags: Specify the size of the bag",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289e1",
  "updated_at": ISODate("2015-11-18T12:49:15.658Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707af7"),
  "attr_id": "126",
  "label": "Material Composition: Shoes",
  "desc": "Define shoes material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289e2",
  "updated_at": ISODate("2015-11-18T12:49:15.659Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c6e"),
  "attr_id": "495",
  "label": "Floor\/Wall Covering Intended Use 1",
  "desc": "Specify whether for indoor or outdoor",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08fe",
  "updated_at": ISODate("2015-11-18T12:49:15.770Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c6f"),
  "attr_id": "496",
  "label": "Floor\/Wall Covering Intended Use 2",
  "desc": "Specify if the product can be used as flooring, wall covering, or both",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08ff",
  "updated_at": ISODate("2015-11-18T12:49:15.771Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c70"),
  "attr_id": "497",
  "label": "Porcelain Tiles Features",
  "desc": "Specify Porcelain Tiles Features",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0900",
  "updated_at": ISODate("2015-11-18T12:49:15.772Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707be9"),
  "attr_id": "367",
  "label": "Garden Size - measurement unit",
  "desc": "Garden Size - measurement unit",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08e9",
  "updated_at": ISODate("2015-11-18T12:49:15.748Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bed"),
  "attr_id": "371",
  "label": "Parking Description",
  "desc": "Describe the location, parking, cover type, so as to give more information to those who view your ad",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b86"),
  "attr_id": "268",
  "label": "Hand",
  "desc": "Specify whether for right or left-handed",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a1c",
  "updated_at": ISODate("2015-11-18T12:49:15.713Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b87"),
  "attr_id": "269",
  "label": "Shaft Flex",
  "desc": "Specify Shaft flexibility\/hardness",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a1d",
  "updated_at": ISODate("2015-11-18T12:49:15.713Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b8a"),
  "attr_id": "272",
  "label": "SPORT: Equipment Material Composition",
  "desc": "SPORTS: Equipment main Material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a1e",
  "updated_at": ISODate("2015-11-18T12:49:15.714Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b8b"),
  "attr_id": "273",
  "label": "SPORT: Clothing Material Composition",
  "desc": "SPORT: Clothes main Material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a1f",
  "updated_at": ISODate("2015-11-18T12:49:15.715Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b8d"),
  "attr_id": "275",
  "label": "Power - measurement unit",
  "desc": "Power unit of measurement",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a20",
  "updated_at": ISODate("2015-11-18T12:49:15.716Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b9d"),
  "attr_id": "291",
  "label": "Front Brakes Type",
  "desc": "Front brake type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a26",
  "updated_at": ISODate("2015-11-18T12:49:15.722Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ba7"),
  "attr_id": "301",
  "label": "Mileage - measurement unit",
  "desc": "Measurement unit for mileage",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a29",
  "updated_at": ISODate("2015-11-18T12:49:15.724Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ba9"),
  "attr_id": "303",
  "label": "Driving Hand",
  "desc": "Specify driving hand if left or right",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e5a151becfcb85f2d28a2c",
  "updated_at": ISODate("2015-11-18T12:49:15.727Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707baa"),
  "attr_id": "304",
  "label": "Transmission Type",
  "desc": "Type of transmission",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c4bbecfcb85f2d28a2b",
  "updated_at": ISODate("2015-11-18T12:49:15.726Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bad"),
  "attr_id": "307",
  "label": "Boat - Description of all the work done in the past 2 years",
  "desc": "Boat Description including all the work done in the past 2 years",
  "field_type": "T",
  "len": "200",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bb7"),
  "attr_id": "317",
  "label": "Boat Financial Status",
  "desc": "Economic status of the boat",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08da",
  "updated_at": ISODate("2015-11-18T12:49:15.732Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bbe"),
  "attr_id": "324",
  "label": "Aircraft Serial No",
  "desc": "Serial number: each aircraft has its own production code, enter this code if available",
  "field_type": "T",
  "len": "20",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c89"),
  "attr_id": "522",
  "label": "End Use",
  "desc": "Specify product destination",
  "field_type": "TM",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0910",
  "updated_at": ISODate("2015-11-18T12:49:15.786Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c8b"),
  "attr_id": "524",
  "label": "Textile Product Composition",
  "desc": "Specify whether single product or set of products",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b0912",
  "updated_at": ISODate("2015-11-18T12:49:15.788Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c91"),
  "attr_id": "530",
  "label": "Drain",
  "desc": "Specify whether included or not included",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0916",
  "updated_at": ISODate("2015-11-18T12:49:15.792Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c92"),
  "attr_id": "531",
  "label": "Plating",
  "desc": "Specify the type of finish",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0917",
  "updated_at": ISODate("2015-11-18T12:49:15.793Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c93"),
  "attr_id": "532",
  "label": "Fuel Supply\/Power Source",
  "desc": "Specify the type of power\/energy source",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0918",
  "updated_at": ISODate("2015-11-18T12:49:15.794Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c94"),
  "attr_id": "533",
  "label": "Doors\/Windows\/Frames Certification",
  "desc": "Specify",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0919",
  "updated_at": ISODate("2015-11-18T12:49:15.795Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c68"),
  "attr_id": "489",
  "label": "Wheeling Type",
  "desc": "Specify whether tracked or wheeled",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08fc",
  "updated_at": ISODate("2015-11-18T12:49:15.768Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c6c"),
  "attr_id": "493",
  "label": "Experience Degree",
  "desc": "Specify your degree of experience",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08fd",
  "updated_at": ISODate("2015-11-18T12:49:15.769Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bfe"),
  "attr_id": "388",
  "label": "Service Name",
  "desc": "It is advisable to give a name to the service. It can identify a package of activities and allows you toqualify your company or your professional activity.",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bff"),
  "attr_id": "389",
  "label": "Organization Description",
  "desc": "It is advisable to give information about your organization, how many people work there, etc. You can post Office photos too",
  "field_type": "T",
  "len": "500",
  "class": "CO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c01"),
  "attr_id": "391",
  "label": "Description of other services offered",
  "desc": "In addition to the services you are offering, you can describe other related services or enter a new service on this site.",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c04"),
  "attr_id": "394",
  "label": "Printing Products",
  "desc": "Choose one or more options",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08ec",
  "updated_at": ISODate("2015-11-18T12:49:15.752Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c05"),
  "attr_id": "395",
  "label": "Perishable Goods ",
  "desc": "Perishable goods: (Yes\/No)",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08ed",
  "updated_at": ISODate("2015-11-18T12:49:15.753Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707c0c"),
  "attr_id": "402",
  "label": "Weight - measurement unit",
  "desc": "Measurement unit for weight",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08ee",
  "updated_at": ISODate("2015-11-18T12:49:15.754Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c0e"),
  "attr_id": "404",
  "label": "Length - measurement unit",
  "desc": "Measurement unit for length",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08ef",
  "updated_at": ISODate("2015-11-18T12:49:15.755Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c10"),
  "attr_id": "406",
  "label": "Length2 - measurement unit",
  "desc": "Measurement unit for secondary length",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08f0",
  "updated_at": ISODate("2015-11-18T12:49:15.756Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c12"),
  "attr_id": "408",
  "label": "Depth\/Width - measurement unit",
  "desc": "Measurement unit for Depth",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08f1",
  "updated_at": ISODate("2015-11-18T12:49:15.757Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c14"),
  "attr_id": "410",
  "label": "Height - measurement unit",
  "desc": "Measurement unit for height",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08f2",
  "updated_at": ISODate("2015-11-18T12:49:15.757Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c16"),
  "attr_id": "412",
  "label": "Volume - measurement unit",
  "desc": "Measurement unit for Volume",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08f3",
  "updated_at": ISODate("2015-11-18T12:49:15.758Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c18"),
  "attr_id": "414",
  "label": "Girth - measurement unit",
  "desc": "Measurement unit for girth",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08f4",
  "updated_at": ISODate("2015-11-18T12:49:15.760Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c1a"),
  "attr_id": "416",
  "label": "Diameter - measurement unit",
  "desc": "Measurement unit for diameter",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08f5",
  "updated_at": ISODate("2015-11-18T12:49:15.761Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c20"),
  "attr_id": "422",
  "label": "Speed - measurement unit",
  "desc": "Measurement unit for speed",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08f6",
  "updated_at": ISODate("2015-11-18T12:49:15.762Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c22"),
  "attr_id": "424",
  "label": "Pressure - measurement unit",
  "desc": "Measurement unit for pressure",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08f7",
  "updated_at": ISODate("2015-11-18T12:49:15.762Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c23"),
  "attr_id": "166;3",
  "label": "Pre-owned Specs",
  "desc": "Pre-owned - specify garment and accessories Status",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08f8",
  "updated_at": ISODate("2015-11-18T12:49:15.763Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c25"),
  "attr_id": "166;3;1",
  "label": "Clothes & Accessories Age",
  "desc": "Garment and accessories age",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08fa",
  "updated_at": ISODate("2015-11-18T12:49:15.765Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c26"),
  "attr_id": "189;28",
  "label": "Specify Flour Type (if not included in the previous selection)",
  "desc": "Specify the type of flour (if not listed above)",
  "field_type": "T",
  "len": "15",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707c63"),
  "attr_id": "484",
  "label": "Memory Parity",
  "desc": "Specify memory parity",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08fb",
  "updated_at": ISODate("2015-11-18T12:49:15.766Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b1b"),
  "attr_id": "162",
  "label": "Gloves Type",
  "desc": "Gloves: specify the type of gloves",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289f9",
  "updated_at": ISODate("2015-11-18T12:49:15.681Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b1d"),
  "attr_id": "164",
  "label": "Fashion Collection Year",
  "desc": "Year of the Collection",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289fa",
  "updated_at": ISODate("2015-11-18T12:49:15.682Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b20"),
  "attr_id": "167",
  "label": "Power Source",
  "desc": "Specify the type of equipment power source",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289fc",
  "updated_at": ISODate("2015-11-18T12:49:15.683Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b23"),
  "attr_id": "170",
  "label": "Season",
  "desc": "Specify the collection season",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289fd",
  "updated_at": ISODate("2015-11-18T12:49:15.684Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b25"),
  "attr_id": "172",
  "label": "Size Conversion Chart",
  "desc": "Size chart from file. The next table needs to be filled with the size conversions YOU apply to your clothes",
  "field_type": "TB",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b27"),
  "attr_id": "174",
  "label": "Size: BABY Boy & Girl (months)",
  "desc": "Size: BABY''s age (in months)",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289fe",
  "updated_at": ISODate("2015-11-18T12:49:15.685Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b28"),
  "attr_id": "175",
  "label": "Size: KID Boy & Girl (years)",
  "desc": "Size: KID''s age (in years)",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289ff",
  "updated_at": ISODate("2015-11-18T12:49:15.686Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b29"),
  "attr_id": "176",
  "label": "Size: JUNIOR Boy & Girl (years)",
  "desc": "Size: JUNIOR''s age (in years)",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a00",
  "updated_at": ISODate("2015-11-18T12:49:15.687Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b2b"),
  "attr_id": "178",
  "label": "Shirt Wearability",
  "desc": "Type of shirts fit",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a01",
  "updated_at": ISODate("2015-11-18T12:49:15.688Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b2c"),
  "attr_id": "179",
  "label": "Textile Features",
  "desc": "Shirts fabric characteristics",
  "field_type": "TM",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a02",
  "updated_at": ISODate("2015-11-18T12:49:15.688Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b2d"),
  "attr_id": "180",
  "label": "Drop Size: Men Suits\/Women Suits\/Men Outwear\/Women Outwear",
  "desc": "Drop size - men''s suits\/women''s suits\/men''s outerwear\/women''s Outerwear",
  "field_type": "N",
  "len": "2",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b2f"),
  "attr_id": "182",
  "label": "Adult Clothing Size (excl. Men Shirts\/Underwear\/Denim\/Hosiery)",
  "desc": "Specify clothing size (excl.: MAN''S SHIRTS\/UNDERWEAR\/DENIM\/SOCKS)",
  "field_type": "T",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b35"),
  "attr_id": "188",
  "label": "Packaging Type",
  "desc": "Specify the type of packaging",
  "field_type": "TD",
  "len": "",
  "class": "PK",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a03",
  "updated_at": ISODate("2015-11-18T12:49:15.689Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b36"),
  "attr_id": "189",
  "label": "Type of Flour for Salted & Sweet Products",
  "desc": "Specify the type of flour used",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a04",
  "updated_at": ISODate("2015-11-18T12:49:15.690Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b37"),
  "attr_id": "190",
  "label": "Food & Beverage: Special Products",
  "desc": "Choose among the options provided",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a05",
  "updated_at": ISODate("2015-11-18T12:49:15.691Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b38"),
  "attr_id": "191",
  "label": "Salt Type",
  "desc": "Choose among the options provided",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a06",
  "updated_at": ISODate("2015-11-18T12:49:15.692Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b39"),
  "attr_id": "192",
  "label": "Tea\/Herbal Tea & Infusion Type",
  "desc": "Choose among the options provided",
  "field_type": "TD",
  "len": "",
  "class": "PK",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a07",
  "updated_at": ISODate("2015-11-18T12:49:15.693Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b3a"),
  "attr_id": "193",
  "label": "Cheese: Milk Heat-treatment",
  "desc": "Choose among the options provided",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a08",
  "updated_at": ISODate("2015-11-18T12:49:15.694Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b3b"),
  "attr_id": "194",
  "label": "Cheese: Aging",
  "desc": "Choose among the options provided",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a09",
  "updated_at": ISODate("2015-11-18T12:49:15.694Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b3c"),
  "attr_id": "195",
  "label": "Cheese: Moisture Type",
  "desc": "Choose among the options provided",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a0a",
  "updated_at": ISODate("2015-11-18T12:49:15.695Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b3d"),
  "attr_id": "196",
  "label": "Meat Type",
  "desc": "Choose among the options provided",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a0b",
  "updated_at": ISODate("2015-11-18T12:49:15.696Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b3e"),
  "attr_id": "197",
  "label": "Seafood: Processing Technique",
  "desc": "Choose among the options provided",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a0c",
  "updated_at": ISODate("2015-11-18T12:49:15.697Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b3f"),
  "attr_id": "198",
  "label": "Spice Size (Packaging\/Presentation)",
  "desc": "Choose among the options provided",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a0d",
  "updated_at": ISODate("2015-11-18T12:49:15.698Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b43"),
  "attr_id": "202",
  "label": "Wine & Spirit Aging",
  "desc": "Choose among the options provided",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a0e",
  "updated_at": ISODate("2015-11-18T12:49:15.700Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b44"),
  "attr_id": "203",
  "label": "Ritual Cooking",
  "desc": "Specify which religious worship it complies",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a0f",
  "updated_at": ISODate("2015-11-18T12:49:15.701Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b4b"),
  "attr_id": "210",
  "label": "Installation Method",
  "desc": "Specify the installation mode",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a10",
  "updated_at": ISODate("2015-11-18T12:49:15.702Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b4e"),
  "attr_id": "213",
  "label": "Sport Equipment\/HVAC Status",
  "desc": "Specify the product condition",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a11",
  "updated_at": ISODate("2015-11-18T12:49:15.703Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b65"),
  "attr_id": "236",
  "label": "Soundproofing",
  "desc": "Choose whether present or not present",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a12",
  "updated_at": ISODate("2015-11-18T12:49:15.704Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b7a"),
  "attr_id": "257",
  "label": "Fashion Accessory User",
  "desc": "Fashion: Type of user - recipient",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a13",
  "updated_at": ISODate("2015-11-18T12:49:15.705Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b7c"),
  "attr_id": "259",
  "label": "Pants Waist Type",
  "desc": "Waist - type of waist",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a15",
  "updated_at": ISODate("2015-11-18T12:49:15.707Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b7e"),
  "attr_id": "261",
  "label": "Washing Instructions",
  "desc": "Type of washing",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a17",
  "updated_at": ISODate("2015-11-18T12:49:15.709Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b7f"),
  "attr_id": "262",
  "label": "Neck Type for Men Shirts",
  "desc": "Men''s shirts - collar type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a18",
  "updated_at": ISODate("2015-11-18T12:49:15.709Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707b80"),
  "attr_id": "263",
  "label": "Shirts Cuff Type",
  "desc": "Shirts: Wrist type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d28a19",
  "updated_at": ISODate("2015-11-18T12:49:15.710Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cda"),
  "attr_id": "599",
  "label": "Return Accepted Within (days)",
  "desc": "Select the days within you accept the product return",
  "field_type": "TD",
  "len": "",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdcd2cdd8a57a8b0944",
  "updated_at": ISODate("2015-11-04T14:06:09.463Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cdd"),
  "attr_id": "602",
  "label": "Return Shipment Expenses",
  "desc": "Select who will pay the return shipment expenses",
  "field_type": "TD",
  "len": "",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fded2cdd8a57a8b0945",
  "updated_at": ISODate("2015-11-18T12:49:15.835Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cb6"),
  "attr_id": "567",
  "label": "Paper Tablecloths\/Napkins Decoration",
  "desc": "Specify the type of decoration",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0933",
  "updated_at": ISODate("2015-11-18T12:49:15.817Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cbe"),
  "attr_id": "574;3\/1",
  "label": "National Shipment Price",
  "desc": "Specify national shipping cost. The currency must be the same as the one listed for the product price.",
  "field_type": "N",
  "len": "8",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cbf"),
  "attr_id": "574;3\/2",
  "label": "International Shipment Price",
  "desc": "Specify international shipping cost. The currency must be the same as the one listed for the product price.",
  "field_type": "N",
  "len": "8",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cc0"),
  "attr_id": "574;3\/3",
  "label": "National Shipment Price extra for each additional unit",
  "desc": "Specify national extra shipping cost for each additional item. The currency must be the same as the one listed for the product price.",
  "field_type": "N",
  "len": "8",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cc1"),
  "attr_id": "574;3\/4",
  "label": "International Shipment Price extra for each additional unit",
  "desc": "Specify international extra shipping cost for each additional item. The currency must be the same as the one listed for the product price.",
  "field_type": "N",
  "len": "8",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cc3"),
  "attr_id": "576",
  "label": "Product Form",
  "desc": "Specify the product form (e.g. liquid, powder, granules, etc.)",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0936",
  "updated_at": ISODate("2015-11-18T12:49:15.820Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cc5"),
  "attr_id": "578",
  "label": "Sculpting\/Modeling Waxes Shape",
  "desc": "Choose the shape of the product",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0937",
  "updated_at": ISODate("2015-11-18T12:49:15.822Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cc6"),
  "attr_id": "579",
  "label": "Bit Shank Type",
  "desc": "Select the type of bit shank",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0938",
  "updated_at": ISODate("2015-11-18T12:49:15.822Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cc7"),
  "attr_id": "580",
  "label": "Mineralogical Class",
  "desc": "Select the mineralogical class",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0939",
  "updated_at": ISODate("2015-11-18T12:49:15.824Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cc9"),
  "attr_id": "582",
  "label": "Paint Finish",
  "desc": "Select paint finish",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b093b",
  "updated_at": ISODate("2015-11-18T12:49:15.826Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cca"),
  "attr_id": "583",
  "label": "Paint Base",
  "desc": "Select paint base type",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b093c",
  "updated_at": ISODate("2015-11-18T12:49:15.827Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ccb"),
  "attr_id": "584",
  "label": "Approx. Coverage (1 coat) - (M2 or SF please specify)",
  "desc": "Specify approximate paint coverage in square meters or square feet",
  "field_type": "T",
  "len": "10",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707ccd"),
  "attr_id": "586",
  "label": "Different Colors Available",
  "desc": "Specify with a number how many other color variants are available for this type of paint",
  "field_type": "N",
  "len": "3",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cce"),
  "attr_id": "587",
  "label": "Paint Suitable for",
  "desc": "Specify whether suitable for indoor, outdoor or both",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b093d",
  "updated_at": ISODate("2015-11-18T12:49:15.828Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cd0"),
  "attr_id": "589",
  "label": "Base Resin",
  "desc": "Select paint base resin",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b093e",
  "updated_at": ISODate("2015-11-18T12:49:15.829Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cd3"),
  "attr_id": "592",
  "label": "Machine for",
  "desc": "Select for the processing of which natural stone the machine is intended",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0940",
  "updated_at": ISODate("2015-11-18T12:49:15.831Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cd4"),
  "attr_id": "593",
  "label": "Wine Machine for",
  "desc": "Select for the processing of which wine the machine is intended",
  "field_type": "TM",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0941",
  "updated_at": ISODate("2015-11-18T12:49:15.831Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cd5"),
  "attr_id": "594",
  "label": "Blooming Months",
  "desc": "Select the plant blooming month or months",
  "field_type": "TM",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdbd2cdd8a57a8b0942",
  "updated_at": ISODate("2015-11-18T12:49:15.832Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840b5a32774774707cd9"),
  "attr_id": "598",
  "label": "Countries where you don''t ship",
  "desc": "Select the countries where you don''t ship",
  "field_type": "TM",
  "len": "",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdcd2cdd8a57a8b0943",
  "updated_at": ISODate("2015-11-19T01:25:20.886Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bf1"),
  "attr_id": "375",
  "label": "Guest House Size - measurement unit",
  "desc": "Guest House Size - measurement unit",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08ea",
  "updated_at": ISODate("2015-11-18T12:49:15.751Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bf2"),
  "attr_id": "376",
  "label": "Real Estate Other Features - Description",
  "desc": "Give more information about the property\/lot (description)",
  "field_type": "T",
  "len": "500",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bf4"),
  "attr_id": "378",
  "label": "Property\/Motors\/Boat: State\/Region\/Department\/Land",
  "desc": "Property\/Motors\/Boat: State\/Region\/Department\/Land",
  "field_type": "T",
  "len": "30",
  "class": "LO",
  "req": "L",
  "type": "attr",
  "lang": "en"
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707bfd"),
  "attr_id": "387",
  "label": "Service Destined To",
  "desc": "Who''s your ideal user",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "56125fdad2cdd8a57a8b08eb",
  "updated_at": ISODate("2015-11-18T12:49:15.752Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707af8"),
  "attr_id": "127",
  "label": "Material Composition: Shoes Inserts",
  "desc": "Define the material of the shoes inserts",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289e3",
  "updated_at": ISODate("2015-11-18T12:49:15.660Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707af9"),
  "attr_id": "128",
  "label": "Shoes Lacing",
  "desc": "Define the type of shoes lacing - Men\/Women\/Children",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289e4",
  "updated_at": ISODate("2015-11-18T12:49:15.661Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ac2"),
  "attr_id": "73",
  "label": "Color",
  "desc": "Choose the color in the table below",
  "field_type": "CL",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289d1",
  "updated_at": ISODate("2015-11-18T14:11:41.680Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ac3"),
  "attr_id": "74",
  "label": "Intended Use - Fashion",
  "desc": "Indicate to customers the perfect opportunity to wear the garment for sale",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289d2",
  "updated_at": ISODate("2015-11-18T12:49:15.643Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ac4"),
  "attr_id": "75",
  "label": "Type of Manufacture",
  "desc": "Specify to customers how the garment for sale is made",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289d3",
  "updated_at": ISODate("2015-11-18T12:49:15.644Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ac5"),
  "attr_id": "76",
  "label": "Visible Logo",
  "desc": "Specify if the garment has a visible label (highlighted)",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289d4",
  "updated_at": ISODate("2015-11-18T12:49:15.645Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ac6"),
  "attr_id": "77",
  "label": "Pattern",
  "desc": "Choose from fabric patterns",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289d5",
  "updated_at": ISODate("2015-11-18T12:49:15.645Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ace"),
  "attr_id": "85",
  "label": "Pattern - Sweaters",
  "desc": "Choose from fabric patterns",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289d6",
  "updated_at": ISODate("2015-11-18T12:49:15.646Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ad3"),
  "attr_id": "90",
  "label": "Primary Textile Composition",
  "desc": "Indicate which is the predominant material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289d7",
  "updated_at": ISODate("2015-11-18T12:49:15.647Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ad6"),
  "attr_id": "93",
  "label": "Primary Textile Composition: Outwear",
  "desc": "Indicate which is the predominant material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289d8",
  "updated_at": ISODate("2015-11-18T12:49:15.653Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ad8"),
  "attr_id": "95",
  "label": "Primary Textile Composition: Nylon Hosiery",
  "desc": "Indicate which is the predominant material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289d9",
  "updated_at": ISODate("2015-11-18T12:49:15.648Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707ad9"),
  "attr_id": "96",
  "label": "Primary Textile Composition: Denim",
  "desc": "Indicate which is the predominant material",
  "field_type": "TD",
  "len": "",
  "class": "PR",
  "req": "L",
  "type": "attr",
  "lang": "en",
  "dropdown_list": "55e47c45becfcb85f2d289da",
  "updated_at": ISODate("2015-11-18T12:49:15.649Z")
});
db.getCollection("cat_attributes").insert({
  "_id": ObjectId("55df840a5a32774774707add"),
  "attr_id": "100",
  "label": "Textile Composition Description: Clothes\/Bags\/Cases\/Accessories (excluding Lining)",
  "desc": "Describe the other materials in the garment",
  "field_type": "T",
  "len": "50",
  "class": "PR",
  "req": "M",
  "type": "attr",
  "lang": "en"
});
