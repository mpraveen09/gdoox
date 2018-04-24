
/** business_info indexes **/
db.getCollection("business_info").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** chat_contacts indexes **/
db.getCollection("chat_contacts").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** chat_messages indexes **/
db.getCollection("chat_messages").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** chat_users_relations indexes **/
db.getCollection("chat_users_relations").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** business_info records **/
db.getCollection("business_info").insert({
  "_id": ObjectId("56b082ef083f11871f8b4567"),
  "_token": "20N4xc3MQIf5XXyRQQ88U7Cb8UkIwvjs3jn11qBn",
  "user_id": "56b07a5a083f119a0b8b4569",
  "company_name": "Superadmin Company",
  "street_add": "224, Jasola Vihar",
  "city": "New Delhi",
  "country": "India",
  "zip": "110025",
  "phone_no1": "9897580093",
  "phone_no2": "",
  "fax_no": "",
  "mobile": "9650536719",
  "skype": "superadmin.ugi",
  "business_email1": "superadmin@uginfosystems.com",
  "business_email2": "",
  "desc": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet elit lacinia enim venenatis placerat lobortis sit amet diam. Proin pulvinar mollis feugiat. Phasellus feugiat ante vitae turpis scelerisque dictum. Nullam ac ornare tellus. Praesent at neque sit amet nisi rutrum placerat ac sit amet lacus. Cras luctus ullamcorper lorem, eu cursus urna tristique quis. Maecenas tincidunt et metus et placerat. Maecenas vel odio eros. Aenean ut vehicula mauris, nec facilisis elit. Proin porta nisl lectus, at ullamcorper purus dignissim a. Aenean finibus dolor quis suscipit eleifend. Morbi blandit non ligula ac fringilla. Pellentesque quis quam elit. Phasellus euismod quam non mauris tincidunt placerat. Praesent pharetra scelerisque dictum.",
  "tags": "Lorem Ipsum",
  "org_type": [
    "Individual Company",
    "Aluminum",
    "Chemicals - Major Diversified"
  ],
  "actvity_type": "Services",
  "operation": "Manufacture",
  "brands": "Lorem Ipsum",
  "payment_form": [
    "WesternUnion",
    "Letter of credit",
    "Wire Transfer"
  ],
  "credit_card": [
    "VISA",
    "DINES"
  ],
  "paypal": "",
  "return_policy": "",
  "market": "National",
  "logo": "gdoox_superadmin_logo.png",
  "status": "Inactive",
  "verify": "Verify/Activate",
  "type": "business",
  "logo_path": "/uploads/2016/02/superadmin/company_logo/",
  "vat_fiscal_id": "123456",
  "_method": "PUT",
  "updated_at": ISODate("2016-03-01T02:33:37.880Z")
});
db.getCollection("business_info").insert({
  "_id": ObjectId("56b08b53083f11c8228b4567"),
  "_token": "WR8WrmcTe1dN15BKGlCIoZ5Vn33qsUJo2qjUSM4d",
  "user_id": "56b087d4083f11ea218b4567",
  "company_name": "Multiuser Company",
  "street_add": "224, 2nd Floor, Jasola Vihar",
  "city": "New Delhi",
  "country": "India",
  "zip": "110025",
  "phone_no1": "1234567890",
  "phone_no2": "",
  "fax_no": "",
  "mobile": "8447593762",
  "skype": "multiuser.ugi",
  "business_email1": "multiuser@uginfosystems.com",
  "business_email2": "",
  "desc": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet elit lacinia enim venenatis placerat lobortis sit amet diam. Proin pulvinar mollis feugiat. Phasellus feugiat ante vitae turpis scelerisque dictum. Nullam ac ornare tellus. Praesent at neque sit amet nisi rutrum placerat ac sit amet lacus. Cras luctus ullamcorper lorem, eu cursus urna tristique quis. Maecenas tincidunt et metus et placerat. Maecenas vel odio eros. Aenean ut vehicula mauris, nec facilisis elit. Proin porta nisl lectus, at ullamcorper purus dignissim a. Aenean finibus dolor quis suscipit eleifend. Morbi blandit non ligula ac fringilla. Pellentesque quis quam elit. Phasellus euismod quam non mauris tincidunt placerat. Praesent pharetra scelerisque dictum.",
  "tags": "Lorem Ipsum",
  "org_type": "Individual Company",
  "actvity_type": "Services",
  "operation": "Manufacture",
  "brands": "Lorem Ipsum",
  "payment_form": "WesternUnion",
  "credit_card": "1",
  "paypal": "",
  "return_policy": "",
  "market": "Local",
  "logo": "gdoox_multiuser_logo.png",
  "logo_path": "/uploads/2016/02/multiuser/company_logo/",
  "status": "Active",
  "verify": "Verified",
  "type": "business",
  "vat_fiscal_id": null
});
db.getCollection("business_info").insert({
  "_id": "54321",
  "user_id": "12345",
  "company_name": "Accenture",
  "street_add": "Noida",
  "city": "Noida",
  "country": "India",
  "zip": "110025",
  "phone_no1": "9090909090",
  "phone_no2": "",
  "fax_no": "",
  "mobile": "9090909090",
  "skype": "accenture.ugi",
  "business_email1": "admin@accenture.com",
  "business_email2": "",
  "desc": "Lorem ipsum.",
  "tags": "Lorem Ipsum",
  "org_type": "Individual Company",
  "actvity_type": "Services",
  "operation": "Manufacture",
  "brands": "Lorem Ipsum",
  "payment_form": "WesternUnion",
  "credit_card": "1",
  "paypal": "",
  "return_policy": "",
  "market": "Local",
  "logo": "gdoox_multiuser_logo.png",
  "logo_path": "/uploads/2016/02/multiuser/company_logo/",
  "status": "Active",
  "verify": "Verified",
  "type": "business",
  "vat_fiscal_id": null
});

/** chat_contacts records **/
db.getCollection("chat_contacts").insert({
  "_id": ObjectId("56f65fc51c8cb6ca1a8b4568"),
  "user_id": "56b07a5a083f119a0b8b4569",
  "request_by": "56b07a5a083f119a0b8b4569",
  "contact_id": "56b087d4083f11ea218b4567",
  "users": [
    "56b07a5a083f119a0b8b4569",
    "56b08b53083f11c8228b4567"
  ],
  "status": "0",
  "request": "Accepted",
  "contact_name": "Multiuser Company",
  "chat_id": "56f65fc51c8cb6ca1a8b4567",
  "type": "singlechat",
  "updated_at": ISODate("2016-03-26T10:37:03.291Z"),
  "created_at": ISODate("2016-03-26T10:09:09.498Z")
});
db.getCollection("chat_contacts").insert({
  "_id": ObjectId("56f65fc51c8cb6ca1a8b4569"),
  "user_id": "56b087d4083f11ea218b4567",
  "request_by": "56b07a5a083f119a0b8b4569",
  "contact_id": "56b07a5a083f119a0b8b4569",
  "users": [
    "56b07a5a083f119a0b8b4569",
    "56b08b53083f11c8228b4567"
  ],
  "status": "0",
  "request": "Accepted",
  "contact_name": "Deep Singh",
  "chat_id": "56f65fc51c8cb6ca1a8b4567",
  "type": "singlechat",
  "updated_at": ISODate("2016-03-26T10:37:03.291Z"),
  "created_at": ISODate("2016-03-26T10:09:09.499Z")
});
db.getCollection("chat_contacts").insert({
  "_id": ObjectId("56fa3f5f1c8cb667138b4568"),
  "user_id": "56b07a5a083f119a0b8b4569",
  "chat_id": "56fa3f5f1c8cb667138b4567",
  "users": [
    "56b087d4083f11ea218b4567",
    "56b07a5a083f119a0b8b4569"
  ],
  "group_name": "Business Club",
  "status": "0",
  "type": "groupchat",
  "updated_at": ISODate("2016-03-29T08:39:59.28Z"),
  "created_at": ISODate("2016-03-29T08:39:59.28Z")
});
db.getCollection("chat_contacts").insert({
  "_id": ObjectId("56fa76051c8cb60c458b4567"),
  "user_id": "56b07a5a083f119a0b8b4569",
  "request_by": "56b07a5a083f119a0b8b4569",
  "contact_id": "12345",
  "users": [
    "56b07a5a083f119a0b8b4569",
    "12345"
  ],
  "status": "0",
  "request": "Accepted",
  "contact_name": "Accenture Company",
  "chat_id": "54321",
  "type": "singlechat",
  "updated_at": ISODate("2016-03-26T10:37:03.291Z"),
  "created_at": ISODate("2016-03-26T10:09:09.498Z")
});

/** chat_messages records **/
db.getCollection("chat_messages").insert({
  "_id": ObjectId("56fa651e1c8cb677138b4567"),
  "users": [
    "56b07a5a083f119a0b8b4569",
    "56b08b53083f11c8228b4567"
  ],
  "message": "Hello",
  "type": "singlechat",
  "date": "2016-03-29",
  "from_id": "56b07a5a083f119a0b8b4569",
  "from_name": "Deep Singh",
  "to_id": "56b087d4083f11ea218b4567",
  "to_name": "Multiuser Company",
  "chat_id": "56f65fc51c8cb6ca1a8b4567",
  "status": "1",
  "updated_at": ISODate("2016-03-29T11:21:02.747Z"),
  "created_at": ISODate("2016-03-29T11:21:02.747Z")
});
db.getCollection("chat_messages").insert({
  "_id": ObjectId("56fa662e1c8cb6cd138b4567"),
  "users": [
    "56b07a5a083f119a0b8b4569",
    "56b08b53083f11c8228b4567"
  ],
  "message": "Hi",
  "type": "singlechat",
  "date": "2016-03-29",
  "from_id": "56b087d4083f11ea218b4567",
  "from_name": "Multiuser Company",
  "to_id": "56b07a5a083f119a0b8b4569",
  "to_name": "Deep Singh",
  "chat_id": "56f65fc51c8cb6ca1a8b4567",
  "status": "1",
  "updated_at": ISODate("2016-03-29T11:25:34.702Z"),
  "created_at": ISODate("2016-03-29T11:25:34.702Z")
});
db.getCollection("chat_messages").insert({
  "_id": ObjectId("56fa66e01c8cb666138b4567"),
  "message": "Hello",
  "type": "groupchat",
  "date": "2016-03-29",
  "from_id": "56b087d4083f11ea218b4567",
  "from_name": "Deep Singh",
  "chat_id": "56fa3f5f1c8cb667138b4567",
  "status": "1",
  "updated_at": ISODate("2016-03-29T11:28:32.818Z"),
  "created_at": ISODate("2016-03-29T11:28:32.818Z")
});

/** chat_users_relations records **/
db.getCollection("chat_users_relations").insert({
  "_id": ObjectId("56f65fc51c8cb6ca1a8b4567"),
  "user_id": "56b07a5a083f119a0b8b4569",
  "users": [
    "56b07a5a083f119a0b8b4569",
    "56b08b53083f11c8228b4567"
  ],
  "type": "singlechat",
  "status": "Pending",
  "updated_at": ISODate("2016-03-26T10:09:09.493Z"),
  "created_at": ISODate("2016-03-26T10:09:09.493Z")
});
db.getCollection("chat_users_relations").insert({
  "_id": ObjectId("56fa3f5f1c8cb667138b4567"),
  "user_id": "56b07a5a083f119a0b8b4569",
  "users": [
    "56b087d4083f11ea218b4567",
    "56b07a5a083f119a0b8b4569"
  ],
  "type": "groupchat",
  "group_name": "Business Club",
  "updated_at": ISODate("2016-03-29T08:39:59.26Z"),
  "created_at": ISODate("2016-03-29T08:39:59.26Z")
});
db.getCollection("chat_users_relations").insert({
  "_id": "12345",
  "user_id": "56b07a5a083f119a0b8b4569",
  "users": [
    "56b07a5a083f119a0b8b4569",
    "56b087d4083f11ed218b4567"
  ],
  "type": "singlechat",
  "status": "Pending",
  "updated_at": ISODate("2016-03-26T10:09:09.493Z"),
  "created_at": ISODate("2016-03-26T10:09:09.493Z")
});
