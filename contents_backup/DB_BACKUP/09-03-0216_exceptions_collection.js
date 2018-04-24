
/** exceptions indexes **/
db.getCollection("exceptions").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** exceptions records **/
db.getCollection("exceptions").insert({
  "_id": ObjectId("56c704e11c8cb6a3238b4568"),
  "subject": "My Demo Subject",
  "description": "My Demo Subject",
  "controller": "ExceptionsController@create",
  "status": "1",
  "updated_at": ISODate("2016-02-19T12:04:49.226Z"),
  "created_at": ISODate("2016-02-19T12:04:49.226Z")
});
