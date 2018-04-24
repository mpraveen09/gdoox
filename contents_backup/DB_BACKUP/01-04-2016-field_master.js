
/** field_master indexes **/
db.getCollection("field_master").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** field_master records **/
db.getCollection("field_master").insert({
  "_id": ObjectId("562f49d5083f116d1c8b4567"),
  "title": "roles",
  "labels": {
    "form_title": "User Role",
    "label1": "Role Name",
    "label2": "level",
    "label3": "permission",
    "submit": "Save",
    "cancel": "Cancel",
    "edit": "Edit",
    "view": "View",
    "view_all": "View All",
    "create": "Add New",
    "action": "Action"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("5656a5b71c8cb62a102223d0"),
  "title": "review_form_info",
  "labels": {
    "form_title": "Help others! Write a Gdoox review",
    "review_title": "Review Title",
    "your_review": "Your Review",
    "your_rating": "Your Rating",
    "name": "Your Name",
    "save": "Save",
    "submit": "Submit",
    "cancel": "Cancel",
    "edit": "Edit",
    "create": "Create",
    "view": "View",
    "heading": "Help others! Write a Gdoox review",
    "view_all": "View All",
    "action": "Action"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("5674f9871c8cb6d5058b4567"),
  "title": "personal_site_menu",
  "labels": {
    "job-details": "Job Experience",
    "computer-skills": "Computer Skills",
    "competencies": "Competencies",
    "other-skills": "Other Skills",
    "other-info": "Other Information",
    "languages": "Languages",
    "education": "Education",
    "contact": "Contact",
    "businessinfo": "About Us",
    "product-catalog": "Product Catalog",
    "contact-us": "Contact Us",
    "companies-involved": "Companies Involved"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": "user_details_en",
  "fields": {
    "label": "Fields"
  },
  "values": {
    "label": "Values"
  },
  "username": {
    "label": "Username"
  },
  "email": {
    "label": "Email"
  },
  "role": {
    "label": "Role"
  },
  "active": {
    "label": "Active"
  },
  "level": {
    "label": "Level"
  },
  "title": {
    "label": "View User Details"
  },
  "edit_btn": {
    "label": "Edit"
  },
  "d_btn": {
    "label": "Dashboard"
  }
});
db.getCollection("field_master").insert({
  "_id": "profile_en",
  "email": {
    "label": "Email Address"
  },
  "username": {
    "label": "User Name"
  },
  "role": {
    "label": "User Role"
  },
  "password": {
    "label": "Password"
  },
  "edit_btn": {
    "label": "Edit"
  },
  "title": {
    "label": "Profile"
  },
  "d_btn": {
    "label": "Dashoard"
  },
  "edit": {
    "label": "Edit Profile"
  },
  "update": {
    "label": "Update"
  },
  "c_password": {
    "label": "Change Password"
  }
});
db.getCollection("field_master").insert({
  "_id": "cat_attrib_en",
  "file": {
    "label": "Browse File"
  },
  "link": {
    "label": "Browse"
  },
  "confirm": {
    "label": "Do you want to override the existing category?"
  },
  "yes": {
    "label": "Yes"
  },
  "no": {
    "label": "No"
  },
  "column": {
    "label": "Enter the max column"
  },
  "submit": {
    "label": "Import"
  },
  "cancel": {
    "label": "Cancel"
  }
});
db.getCollection("field_master").insert({
  "_id": ObjectId("561bb27e083f11901f8b4567"),
  "title": "social_info",
  "labels": {
    "search": "Go",
    "form_title": "Social Links",
    "social": "Your Business can be followed in the social network. Help us to help you.(Multiple Choice)",
    "facebook": "Facebook",
    "linkedin": "LinkedIn",
    "twitter": "Twitter",
    "pinterest": "Pinterest",
    "google": "Google+",
    "submit": "Submit",
    "cancel": "Cancel",
    "save": "Save",
    "create": "Create",
    "edit": "Edit",
    "view": "View",
    "view_all": "View All"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("561bc070083f110c088b4567"),
  "title": "interest_info",
  "labels": {
    "search": "Go",
    "form_title": "Interests",
    "sport": "Your Sport",
    "books": "Your Books",
    "music": "Your Preferred Music",
    "games_music": "Your Games Music",
    "submit": "Submit",
    "cancel": "Cancel",
    "save": "Save",
    "create": "Create",
    "edit": "Edit",
    "view": "View",
    "view_all": "View All"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("561bb8a5083f11901f8b4568"),
  "title": "relation_info",
  "labels": {
    "search": "Go",
    "form_title": "Relationship With Gdoox",
    "relation": "Relationship With Gdoox",
    "relation_code": "Enter Gdoox Id Code",
    "submit": "Submit",
    "cancel": "Cancel",
    "save": "Save",
    "create": "Create",
    "edit": "Edit",
    "view": "View",
    "view_all": "View All"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("5624980e083f1185138b4568"),
  "title": "account_info",
  "labels": {
    "form_title": "Your Account",
    "email": "Email Address",
    "username": "User Name",
    "role": "User Role",
    "password": "Your Password",
    "cancel": "Cancel",
    "submit": "Update",
    "save": "Save",
    "new_password": "Enter New Password",
    "new_password_confirmation": "Confirm New Password",
    "view": "View",
    "edit": "Edit",
    "view_all": "View All",
    "profile_image": "Profile Picture"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("561bc8b8083f114e158b4567"),
  "title": "invite_user",
  "labels": {
    "search": "Go",
    "form_title": "Invite User",
    "name": "Name",
    "email": "Email",
    "gdoox_code": "Gdoox Id Code",
    "submit": "Invite",
    "button": "Upload & Invite",
    "cancel": "Cancel",
    "edit": "Edit",
    "view": "View",
    "view_all": "View All",
    "create": "Create New",
    "heading": "Invite",
    "browse": "Browse File",
    "check_code": "Do you want to invite with Gdoox Code?",
    "change": "Change"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("5629fdec083f1148178b4567"),
  "title": "business_verification_log",
  "lang": "en",
  "labels": {
    "form_title": "Verify Company/Consortium",
    "heading": "Verify your business with Fiscal ID/VAT Number",
    "heading2": "Verify your business with your business documents",
    "label1": "Select your company",
    "label2": "Fill your Fiscal ID & VAT Number (EU Countries)",
    "label3": "Submit your scanned company documents",
    "label4": "Country of Business",
    "submit": "Verify",
    "cancel": "Cancel",
    "edit": "Edit",
    "view": "View Verified Companies",
    "view2": "View Pending for Verification Companies",
    "view_all": "View All",
    "create": "Verify New"
  }
});
db.getCollection("field_master").insert({
  "_id": ObjectId("56fe120d1c8cb693138b4567"),
  "title": "checkout",
  "labels": {
    "first_name": "First Name",
    "last_name": "Last Name",
    "street_add": "Street",
    "city": "City/Town/District",
    "country": "Country",
    "zip": "Country Area/Zip Code",
    "ph_no": "Phone Number",
    "submit": "Register",
    "cancel": "Cancel",
    "search": "Go",
    "save": "Save",
    "update": "Update",
    "id": "S.No",
    "status": "Status",
    "lang": "Language",
    "created": "Business starts",
    "action": "Actions",
    "view": "View",
    "edit": "Edit",
    "create": "Create",
    "credit_card": "Credit Card",
    "debit_card": "Debit Card",
    "net_banking": "Net Banking",
    "continue": "Continue"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("562df3c2083f111b078b4567"),
  "title": "payment_method",
  "lang": "en",
  "labels": {
    "form_title": "Accept Payment Method",
    "heading": "Payment Method",
    "heading2": "",
    "label1": "Your Name",
    "label2": "Select Payment Method",
    "label3": "",
    "label4": "",
    "submit": "Save",
    "cancel": "Cancel",
    "edit": "Edit",
    "view": "View",
    "view_all": "View All",
    "create": "Add New"
  }
});
db.getCollection("field_master").insert({
  "_id": ObjectId("561cfc81083f1169268b4568"),
  "title": "register",
  "labels": {
    "form_title": "Sign Up",
    "email": "Email Address",
    "username": "Username",
    "password": "Password",
    "confirm": "Confirm Password",
    "gdoox_code": "Use Gdoox Code",
    "submit": "Register",
    "cancel": "Cancel",
    "search": "Go",
    "save": "Save",
    "edit": "Edit",
    "login_title": "Login",
    "remember": "Remember me",
    "button": "Login",
    "forget": "Forget password",
    "user_title": "User Management",
    "view_all": "View All",
    "create": "Create New",
    "role": "Role",
    "license": "Accept the license agreement",
    "level": "Level",
    "action": "Action",
    "active": "Active",
    "view": "View"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("561bb135083f1168208b4567"),
  "title": "personal_info",
  "labels": {
    "search": "Go",
    "form_title": "Personal Info",
    "f_name": "First Name",
    "l_name": "Last Name",
    "s_name": "Second Name",
    "email": "Email Address",
    "initials": "Initials",
    "street_add": "Street Address Of Your Place Of Business",
    "city": "City/Town/District/Region Of Your Place Of Business",
    "country": "Country Of Your Place Of Business",
    "zip": "Country Area/Zip Code Of Your Place Of Business",
    "phone_no1": "Phone Number 1",
    "phone_no2": "Phone Number 2",
    "fax_no": "Fax Number",
    "mobile": "Mobile Phone Number",
    "blackberry": "Blackberry",
    "msm": "MSM",
    "skype": "Skype User Name",
    "business_email": "Business Email Address",
    "position": "Position in your organization.Please tell Customers and Suppliers about your job.(Multiple Choice)",
    "submit": "Submit",
    "cancel": "Cancel",
    "save": "Save",
    "edit": "Edit",
    "view": "Veiw",
    "view_all": "View All",
    "create": "Create"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("5624db34083f1103258b4567"),
  "title": "business_ecommerce_company",
  "labels": {
    "form_title": "E-Commerce Company",
    "ecomm_company_name": "E-Commerce Company Name",
    "slug": "Company Slug",
    "company": "Select your business comapny",
    "save": "Save",
    "submit": "Submit",
    "cancel": "Cancel",
    "edit": "Edit",
    "create": "Create",
    "view": "View",
    "null_error": "You have no any E-store listed",
    "heading": "E-Commerce Store",
    "view_all": "View All",
    "email": "Your email for store registeration",
    "action": "Action",
    "label1": "E-Commerce Company",
    "label2": "Your Business Company",
    "label3": "E-store Email",
    "label4": ""
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("566c0891083f1184388b4567"),
  "title": "job_details",
  "labels": {
    "company_name": "Company Name",
    "old_company_name": "Company Name",
    "old_position": "Position",
    "old_org_type": "Organization Type",
    "from": "From Year",
    "to": "To Year Or Present",
    "position": "Position in \r\nyour organization.Please tell Customers and Suppliers about your job.(Multiple Choice)",
    "org_type": "Organization Type",
    "old_from": "From Year",
    "old_to": "End Year",
    "form_title": "Add Job Experiences",
    "create": "Create",
    "submit": "Save",
    "view_title": "Job Experience"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("5620bd51083f1124088b4567"),
  "title": "business_info",
  "labels": {
    "form_title": "Business Info",
    "company_name": "Company/Consortium Name:",
    "street_add": "Street Address Of Your Place Of Business:",
    "city": "City/Town/District/Region Of Your Place Of Business:",
    "country": "Country Of Business",
    "zip": "Country Area/Zip Code Of Your Place Of Business",
    "phone_no1": "Phone Number 1",
    "phone_no2": "Phone Number 2",
    "fax_no": "Fax Number",
    "mobile": "Mobile Number",
    "skype": "Skype User Name",
    "business_email1": "Business Email Address 1",
    "business_email2": "Business Email Address 2",
    "desc": "Business Description",
    "tags": "Business Description Tags",
    "org_type": "Organization Type",
    "position": "Position in your organization.Please tell Customers and Suppliers about your job.(Multiple Choice)",
    "dimensions": "Company Dimensions",
    "actvity_type": "Activity Type",
    "operation": "Business Operation",
    "brands": "Brands you deal",
    "payment_form": "Accepted Payment form",
    "credit_card": "Credit Cards Accepted",
    "paypal": "Pay Pal For Payment",
    "return_policy": "Accept Return Policy",
    "market": "Your Market",
    "company_image": "Company Image",
    "img_desc": "Select one Image to start up your E-commerce site. Image management on your E-commerce administration page\r\n(will appear on top of the company Showroom page) You hereby confirm that you have legal right to use the uploaded image, that it does not represent offensive or sexually explicit scenes and that its publishing on a website complies with all applicable laws worldwide. As a consequence of your claim, GDOOX will not be responsible for any copyright, trademark or legal issues associated with use of this image. If you do not agree with these terms, then do not upload the image.",
    "logo": "Company Logo",
    "logo_desc": "(will appear on top of the company Showroom page) You hereby confirm that you have legal right to use the uploaded image, that it does not represent offensive or sexually explicit scenes and that its publishing on a website complies with all applicable laws worldwide. As a consequence of your claim, GDOOX will not be responsible for any copyright, trademark or legal issues associated with use of this image. If you do not agree with these terms, then do not upload the image.",
    "submit": "Register",
    "cancel": "Cancel",
    "search": "Go",
    "save": "Save",
    "update": "Update",
    "id": "S.No",
    "status": "Status",
    "verify": "Verify/Activate",
    "lang": "Language",
    "created": "Business starts",
    "action": "Actions",
    "heading": "Company List",
    "view": "View",
    "edit": "Edit",
    "vat_fiscal_id": "Vat & Fiscal ID",
    "create": "Create",
    "view_all": "View All",
    "category": "Category",
    "product_catalog": "Product Catalog",
    "uploaded_product_catalog": "Uploaded Product Catalog"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("566189451c8cb6bd299e0314"),
  "title": "distribution_network",
  "labels": {
    "form_title": "Gdoox Distribution Network",
    "heading": "Distribution Network",
    "work_with_us": "Interested in working with us?",
    "how_to_work": "How do you want to work with us?",
    "sales_rep": "Only for individual Sales Representative",
    "company_name": "Company Name",
    "first_name": "First Name",
    "last_name": "Last Name",
    "gender": "Gender",
    "country_of_work": "Country where you Work",
    "country_of_living": "Country where you Live",
    "region": "Region/State/County:",
    "business_email": "Business email address:",
    "business_phone": "Business phone:",
    "business_mob": "Business Mobile Phone:",
    "skype_account": "Skype Account:",
    "age": "Age",
    "vat": "Your VAT Number",
    "if_eu_country": "(if working in any EU Country)",
    "sales": "Individual Sales Representative",
    "network": "Seller Network (Registered Company)",
    "association": "Trade Association",
    "advertising": "Advertising Organization",
    "cancel": "Cancel",
    "search": "Go",
    "submit": "Submit",
    "save": "Save",
    "update": "Update",
    "status": "Status",
    "view": "View",
    "edit": "Edit",
    "create": "Create",
    "view_all": "View All"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("563b25c5083f11f51a8b4567"),
  "title": "personal_sites",
  "labels": {
    "form_title": "Personal Site",
    "slug": "Site Slug",
    "site_name": "Site Name:",
    "street_add": "Street Address Of Your Place Of Business:",
    "city": "City/Town/District/Region Of Your Place Of Business:",
    "country": "Country Of Your Place Of Business",
    "zip": "Country Area/Zip Code Of Your Place Of Business",
    "phone_no1": "Phone Number 1",
    "phone_no2": "Phone Number 2",
    "fax_no": "Fax Number",
    "mobile": "Mobile Number",
    "skype": "Skype User Name",
    "business_email1": "Business Email Address 1",
    "business_email2": "Business Email Address 2",
    "desc": "Business Description",
    "tags": "Business Description Tags",
    "org_type": "Organization Type",
    "position": "Position in your organization.Please tell Customers and Suppliers about your job.(Multiple Choice)",
    "dimensions": "Site Dimensions",
    "activity_type": "Activity Type",
    "operation": "Business Operation",
    "brands": "Brands you deal",
    "payment_form": "Accepted Payment form",
    "credit_card": "Credit Cards Accepted",
    "paypal": "Pay Pal For Payment",
    "return_policy": "Accept Return Policy",
    "market": "Your Market",
    "site_image": "Site Image",
    "img_desc": "Select one Image to start up your  Site. Image management on your  administration page\r\n(will appear on top of the Site Showroo [...]",
    "site_logo": "Site Logo",
    "logo_desc": "(will appear on top of the Site  page) You hereby confirm that you have legal right to use the uploaded image, that it does not represent o [...]",
    "submit": "Register",
    "cancel": "Cancel",
    "search": "Go",
    "save": "Save",
    "update": "Update",
    "id": "S.No",
    "status": "Status",
    "verify": "Verify/Activate",
    "lang": "Language",
    "created": "Business starts",
    "action": "Actions",
    "heading": "Site List",
    "view": "View",
    "edit": "Edit",
    "vat_fiscal_id": "Vat & Fiscal ID",
    "create": "Create",
    "view_all": "View All",
    "category_name": "Category"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("566ad8c31c8cb6d21ef2a427"),
  "title": "personal_sites_new",
  "labels": {
    "title": "Personal Site",
    "form_general_info": "General Information",
    "form_other_info": "Other Information",
    "first_name": "First Name",
    "second_name": "Second Name",
    "name": "Name",
    "surname": "Surname",
    "references": "References",
    "added_references": "Added References",
    "sponsors": "Sponsors",
    "added_sponsors": "Added Sponsors",
    "initials": "Initials",
    "dob": "Date of Birth",
    "gender": "Gender",
    "male": "Male",
    "female": "Female",
    "street_add": "Street Address",
    "city": "City/Town/District/Region",
    "country": "Country",
    "country_area": "Country Area/Zip Code",
    "private_ph_no": "Private Phone Number",
    "private_mob_no": "Private Mobile Number",
    "business_ph_no": "Business Phone Number",
    "business_mob_no": "Business Mobile Number",
    "skype": "Skype User Name",
    "msm": "MSM",
    "blackberry": "Blackberry",
    "fiscal_id": "Fiscal Id",
    "personal_email": "Personal Email Id",
    "email_address": "E-Mail Address",
    "business_email": "Business Email id",
    "professional_skills": "Professional Skills",
    "skill_tags": "Professional Skills Tags",
    "mother_tongue": "Mother Tongue",
    "language": "Language",
    "add_language": "Add Language",
    "about_us": "About Us",
    "select_understanding": "Understanding",
    "school": "School/ University",
    "year": "Year",
    "from_year": "From Year",
    "to_year": "To year",
    "education": "Education and Training",
    "user_title": "Title",
    "other_certifications": "Other Educational Certifications",
    "job": "About your Current / Last Job",
    "add": "Add",
    "company_name": "Company Name",
    "position": "Position in your organization.Please tell Customers and Suppliers about your job.(Multiple Choice)",
    "position_description": "Position Description",
    "organization_type": "Organization Type",
    "job_experience": "Add Job Experience",
    "computer_skills": "Computer Skills",
    "other_skills": "Other Skills",
    "publications": "Publications",
    "presentations": "Presentations",
    "projects": "Projects",
    "conferences": "Conferences",
    "seminars": "Seminars",
    "awards": "Honours and Awards",
    "membership": "Membership",
    "add_references": "Add References",
    "social": "Social",
    "relation": "Relation with Gdoox",
    "interests": "Interests",
    "slug": "Site Slug",
    "site_name": "Site Name:",
    "desc": "Business Description",
    "tags": "Business Description Tags",
    "org_type": "Organization Type",
    "payment_form": "Accepted Payment form",
    "credit_card": "Credit Cards Accepted",
    "paypal": "Pay Pal For Payment",
    "site_image": "Site Image",
    "img_desc": "Select one Image to start up your Site. Image management on your administration page\r\n(will appear on top of the Site Showroo [...]",
    "site_logo": "Site Logo",
    "logo_desc": "(will appear on top of the Site page) You hereby confirm that you have legal right to use the uploaded image, that it does not represent o [...]",
    "submit": "Register",
    "cancel": "Cancel",
    "search": "Go",
    "save": "Save",
    "update": "Update",
    "id": "S.No",
    "status": "Status",
    "lang": "Language",
    "created": "Business starts",
    "action": "Actions",
    "view": "View",
    "edit": "Edit",
    "create": "Create",
    "view_all": "View All",
    "competencies": "Competencies",
    "short_description": "Short Description",
    "extensive_description": "Extensive Description",
    "contact_info": "Contact Info",
    "next": "Next",
    "import": "Import",
    "select_business_partner": "Select Business Partner",
    "share_products": "Share Products",
    "select_inviter": "Business Inviters",
    "share_your_products": "Share Your Products"
  },
  "lang": "en"
});
db.getCollection("field_master").insert({
  "_id": ObjectId("56682081083f1120218b4567"),
  "title": "account_profile",
  "labels": {
    "form_title": "Account Profile",
    "street_add": "Street Address Of Your Place Of Business:",
    "city": "City/Town/District/Region Of Your Place Of Business:",
    "country": "Country Of Your Place Of Business",
    "zip": "Country Area/Zip Code Of Your Place Of Business",
    "phone_no1": "Phone Number 1",
    "phone_no2": "Phone Number 2",
    "fax_no": "Fax Number",
    "mobile": "Mobile Number",
    "skype": "Skype User Name",
    "business_email1": "Business Email Address 1",
    "business_email2": "Business Email Address 2",
    "position": "Position in your organization.Please tell Customers and Suppliers about your job.(Multiple Choice)",
    "submit": "Register",
    "cancel": "Cancel",
    "search": "Go",
    "save": "Save",
    "update": "Update",
    "id": "S.No",
    "status": "Status",
    "verify": "Verify/Activate",
    "lang": "Language",
    "created": "Business starts",
    "action": "Actions",
    "heading": "Site List",
    "view": "View",
    "edit": "Edit",
    "vat_fiscal_id": "Vat & Fiscal ID",
    "create": "Create",
    "view_all": "View All",
    "category_name": "Business Sectors I'm Interested",
    "language": "Language"
  },
  "lang": "en"
});
