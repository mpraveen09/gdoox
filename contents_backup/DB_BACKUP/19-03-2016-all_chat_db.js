
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

/** chat_contacts records **/
db.getCollection("chat_contacts").insert({
  "_id": ObjectId("56e803b11c8cb6621b8b4567"),
  "user_id": "56b07a5a083f119a0b8b4569",
  "slug": "superadmine-store",
  "email": "superadmin@uginfosystems.com",
  "user_contact_id": "56bda4b1083f11ea088b4567",
  "user_contact_name": "Mukesh Joshi",
  "updated_at": ISODate("2016-03-02T12:07:10.695Z"),
  "status": "1",
  "user_name": "Superadmin Company"
});
db.getCollection("chat_contacts").insert({
  "_id": ObjectId("56ed4bcc1c8cb60d238b4567"),
  "user_id": "56bda4b1083f11ea088b4567",
  "slug": "superadmine-store",
  "email": "superadmin@uginfosystems.com",
  "user_contact_id": "56b07a5a083f119a0b8b4569",
  "user_contact_name": "Sachin Tendulkar",
  "updated_at": ISODate("2016-03-02T12:07:10.695Z"),
  "status": "0",
  "user_name": "Mukesh Joshi"
});

/** chat_messages records **/
db.getCollection("chat_messages").insert({
  "_id": ObjectId("56ed4dde1c8cb637168b4568"),
  "users": [
    "56bda4b1083f11ea088b4567",
    "56b07a5a083f119a0b8b4569"
  ],
  "message": "sdfasdfasdfsd",
  "type": "singlechat",
  "date": "2016-03-19",
  "from_id": "56b07a5a083f119a0b8b4569",
  "to_id": "56ed30361c8cb64d238b4567",
  "sent_from": "Superadmin Company",
  "sent_to": "Mukesh Joshi",
  "chat_id": "56ed30361c8cb64d238b4567",
  "updated_at": ISODate("2016-03-19T13:02:22.811Z"),
  "created_at": ISODate("2016-03-19T13:02:22.811Z")
});

/** chat_users_relations records **/
db.getCollection("chat_users_relations").insert({
  "_id": ObjectId("56ed23001c8cb66b108b4567"),
  "users": [
    "56bda4b1083f11ea088c4567",
    "56b07a5a083f119a0b8b4569"
  ],
  "type": "singlechat"
});
db.getCollection("chat_users_relations").insert({
  "_id": ObjectId("56ed30361c8cb64d238b4567"),
  "users": [
    "56bda4b1083f11ea088b4567",
    "56b07a5a083f119a0b8b4569"
  ],
  "type": "singlechat"
});
