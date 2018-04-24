
/** business_company_invitations indexes **/
db.getCollection("business_company_invitations").ensureIndex({
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

/** business_company_invitations records **/
db.getCollection("business_company_invitations").insert({
  "_id": ObjectId("56f65fc51c8cb6ca1a8b456a"),
  "company_id": "56b08b53083f11c8228b4567",
  "invitee_id": "56b087d4083f11ea218b4567",
  "inviter_id": "56b07a5a083f119a0b8b4569",
  "status": "Pending",
  "updated_at": ISODate("2016-03-26T10:09:09.499Z"),
  "created_at": ISODate("2016-03-26T10:09:09.499Z")
});
db.getCollection("business_company_invitations").insert({
  "_id": ObjectId("56fa73bc1c8cb69c408b4567"),
  "company_id": "56fa73961c8cb681498b4567",
  "invitee_id": "56b087d4083f11ed218b4567",
  "inviter_id": "56b07a5a083f119a0b8b4569",
  "status": "Pending",
  "updated_at": ISODate("2016-03-29T12:23:24.555Z"),
  "created_at": ISODate("2016-03-29T12:23:24.555Z")
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
  "_id": ObjectId("56fb70a91c8cb674188b4567"),
  "user_id": "56b07a5a083f119a0b8b4569",
  "request_by": "56b07a5a083f119a0b8b4569",
  "contact_id": "999999999999999999999999",
  "users": [
    "56b07a5a083f119a0b8b4569",
    "999999999999999999999999"
  ],
  "status": "0",
  "request": "Accepted",
  "contact_name": "IBM",
  "chat_id": "56fb6ed51c8cb67d178b4567",
  "type": "singlechat",
  "updated_at": ISODate("2016-03-26T10:37:03.291Z"),
  "created_at": ISODate("2016-03-26T10:09:09.499Z")
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
  "_id": ObjectId("56fb6ed51c8cb67d178b4567"),
  "user_id": "56b07a5a083f119a0b8b4569",
  "users": [
    "999999999999999999999999",
    "56b07a5a083f119a0b8b4569"
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
    "56b07a5a083f119a0b8b4569",
    "999999999999999999999999"
  ],
  "type": "groupchat",
  "group_name": "Business Club",
  "updated_at": ISODate("2016-03-29T08:39:59.260Z"),
  "created_at": ISODate("2016-03-29T08:39:59.260Z")
});
