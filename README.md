The Campaign Management CRM offers two distinct dashboards: one for Admins and one for Users. Admins have full control, including user management (create, edit, delete) and campaign oversight (adding, editing, and deleting campaigns). Users can view and search campaigns, edit them, and download campaign data. The system ensures data integrity with strict validation rules for campaign inputs and automatic calculations for pending leads, providing a streamlined approach to campaign tracking and management for both roles.



The campaign management CRM has two dashboards.
1)User
2)Admin
Admin: 
Admin has access to all the sections like,add new user, view user, edit user, delete user.

New User:  Admin can create or add news user by creating username and password. Also admin can assign role to newly created user like, admin/user.

View User: Admin can view all users in view user section.

Edit User: Admin can edit user’s username, email and role.

Delete User:  Admin can delete user.

Add Campaign:  
Admin can add new campaign using excel. 
•	Invalid date format not acceptable. 
•	Also blank date is not acceptable.
•	Start date always should less than end date.
•	Communication id can not be blank.
•	Campaign code cannot be blank.
•	Campaign  name can not be blank.

Edit Campaign: Admin can edit campaign in dashboard section.

Delete Campaign: Admin can delete campaign by clicking delete button. 

Download Data:
Admin can download all the data with the selected month and year.


User:  User can login with username and password.

User have the access only to view all the campaign, all the sections like live, due today, overdue and completed.

Also user is able to edit a campaign in dashboard section.

User can search campaign by using campaign code.
User can download campaign data by month and year clicking on export to excel.

User can logout  using logout button in header.





Dashboard:
All campaigns with all the status like(live, pause,completed,pending) displays
Pending Lead  = Lead Goal - Delivered Lead
Pending lead will automatically calculate on the basis of lead goal and delivered lead.


Live:
All the campaigns with the live status will display.

Completed:
All the completed campaigns will display here.

Duetoday:

1.	Date Range Check:
CURDATE() BETWEEN camp_start_date AND camp_end_date
•	This checks if the current date falls within the campaign's start and end dates (camp_start_date and camp_end_date).

2.	Active Campaign Check:

camp_status = 'Live'

•  This ensures that only campaigns with a status of 'Live' are selected.

3.	Delivery Date Condition:

(first_delivery_date = CURDATE()) OR (first_delivery_date < CURDATE() AND FIND_IN_SET(DAYNAME(CURDATE()), delivery_days) > 0)



•	If the first delivery date (first_delivery_date) is today, the campaign is selected.
•	If the first delivery date is in the past, it checks if today's day of the week is included in the delivery_days field,

1st checks   WHEN first_delivery_date = CURDATE()
2nd (first_delivery_date < CURDATE() 
                      AND FIND_IN_SET(DAYNAME(CURDATE()), delivery_days) > 0)
              )



Overdue:
$sql = "SELECT communication_id, camp_code, channel_id, camp_name, camp_start_date, camp_end_date, delivery_days, lead_goal, camp_status, first_delivery_date, delivered_lead, pending_lead, weekly_lead
              FROM campaign_details 
              WHERE camp_end_date < ? 
              AND camp_status = 'Live' 
              AND camp_code LIKE ?
              LIMIT ?, ?";


1.	camp_end_date < ?: This condition will filter the campaigns that have an end date before a certain date (which will be provided as a parameter, likely in the format YYYY-MM-DD).

2.	camp_status = 'Live': This ensures that the query only retrieves campaigns that are marked as "Live".

3.	camp_code LIKE ?: The LIKE clause will allow for pattern matching in the camp_code field. The second ? will be replaced by a value, which can be a search term (with wildcard characters like %), for example: 'CAM%' to find campaigns whose code starts with CAM.

4.	LIMIT ?, ?: The LIMIT clause is used to limit the number of rows returned by the query. The first ? is the offset (where the results should start), and the second ? is the limit (the maximum number of rows to return). These values will typically be set for pagination purposes.










Table structure

1.	id (int(11)) – Primary key, auto-incremented. This uniquely identifies each record in the table.
2.	camp_code (varchar(50)) – A code or identifier for the campaign.
3.	communication_id (int(11)) – ID related to a communication, possibly a foreign key to another table.
4.	channel_id (int(11)) – ID for the communication channel used in the campaign.
5.	file_no (int(11)) – File number, potentially a reference to related files or documents.
6.	quarter (varchar(255)) – The quarter of the year in which the campaign runs (e.g., "Q1 2024").
7.	camp_name (varchar(100)) – Name of the campaign.
8.	camp_start_date (date) – The start date of the campaign.
9.	camp_end_date (date) – The end date of the campaign.
10.	camp_status (enum) – The current status of the campaign. Possible values are:
•	Pending
•	Completed
•	Live
•	Pause
•	Cancel
•	Escalation
11.	delivery_days (varchar(200)) – Days on which deliveries or activities related to the campaign are scheduled.
12.	lead_goal (int(11)) – The target number of leads for the campaign.
13.	weekly_lead (int(11)) – Weekly lead generation target or count.
14.	delivered_lead (int(11)) – Number of leads delivered so far.
15.	generated_lead (int(11)) – Number of leads generated in the campaign.
16.	undelivered_lead (int(11)) – Leads that were not delivered.
17.	pending_lead (int(11)) – Leads that are pending or not yet processed.
18.	extra_lead (int(11)) – Extra leads, possibly exceeding the original target or goals.
19.	named_acc (varchar(255)) – Named account or customer for the campaign.
20.	exclusions (varchar(255)) – Specific exclusions for the campaign (e.g., regions, industries).
21.	first_delivery_date (date) – The date of the first delivery or action in the campaign.
22.	country (varchar(255)) – The country in which the campaign is targeted or operating.
23.	job_title (varchar(255)) – Job title of the target audience in the campaign.
24.	job_level (varchar(255)) – Job level of the target audience in the campaign.
25.	industry (varchar(255)) – Industry or sector relevant to the campaign.
26.	custm_que (varchar(255)) – Possibly a custom queue or set of criteria for the campaign.
27.	company_size (varchar(110)) – The size of the companies being targeted (e.g., small, medium, large).
28.	notes (varchar(255)) – Additional notes or comments related to the campaign.
29.	duration (varchar(255)) – Duration or time frame of the campaign.
30.	created_at (timestamp) – The timestamp of when the record was created.
31.	updated_at (timestamp) – The timestamp of when the record was last updated, with automatic updating on changes.
