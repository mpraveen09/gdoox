
/** user_chats indexes **/
db.getCollection("user_chats").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** user_chats records **/
db.getCollection("user_chats").insert({
  "_id": ObjectId("56ea7b471c8cb6fc1c8b4567"),
  "users": [
    "560820831187184567",
    "56b07a5a083f119a0b8b4569"
  ],
  "chats": [
    {
      "user_id": "56b07a5a083f119a0b8b4569",
      "msg": "Hello! This is my first message"
    },
    {
      "user_id": "56g08208s31s18fh718456y7",
      "msg": "Hello! This is my Second message."
    }
  ],
  "type": "singlechat"
});
