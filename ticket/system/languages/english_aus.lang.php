<?php
namespace sts;


class lang {

	private $lang_array = array();

	function __construct() {
	
		$language_array['Add'] 									= 'Add';
		$language_array['Edit'] 								= 'Edit';
		$language_array['Save'] 								= 'Save';
		$language_array['Cancel'] 								= 'Cancel';
		$language_array['Delete'] 								= 'Delete';
		
		$language_array['Yes'] 									= 'Yes';
		$language_array['No'] 									= 'No';
		$language_array['On'] 									= 'On';
		$language_array['Off'] 									= 'Off';

		$language_array['Guest Portal'] 						= 'Guest Portal';
		$language_array['Tickets'] 								= 'Tickets';
		$language_array['Login'] 								= 'Login';
		$language_array['Logout'] 								= 'Logout';
		$language_array['Home'] 								= 'Home';
		$language_array['Welcome'] 								= 'Welcome';
		$language_array['Profile'] 								= 'Profile';
		$language_array['Users'] 								= 'Users';
		$language_array['User'] 								= 'User';
		$language_array['Settings'] 							= 'Settings';
		$language_array['Email'] 								= 'Email';
		$language_array['Register'] 							= 'Register';

		$language_array['Name'] 								= 'Name';
		$language_array['Username'] 							= 'Username';
		$language_array['Password'] 							= 'Password';
		$language_array['Password Again'] 						= 'Password Again';

		$language_array['Forgot Password'] 						= 'Forgot Password';
		$language_array['Create Account'] 						= 'Create Account';
		$language_array['Login Failed'] 						= 'Login Failed';
		
		$language_array['Departments'] 							= 'Departments';
		$language_array['Priorities'] 							= 'Priorities';
		$language_array['AD'] 									= 'AD';
		$language_array['Plugins'] 								= 'Plugins';
		$language_array['View Log'] 							= 'View Log';
		$language_array['Log'] 									= 'Log';
		$language_array['Logs'] 								= 'Logs';
		$language_array['All login attempts are logged.']		= 'All login attempts are logged.';
		
		$language_array['You must have an account before you can submit a ticket. Please register here.'] = 
		'You must have an account before you can submit a ticket. Please register here.';
		
		$language_array['Account Registration Is Disabled.']	= 'Account Registration Is Disabled.';

		$language_array['Ticket']								= 'Ticket';
		$language_array['Edit Ticket']							= 'Edit Ticket';
		$language_array['View Ticket']							= 'View Ticket';

		$language_array['Gravatar']								= 'Gravatar';

		$language_array['Change Password']						= 'Change Password';
		$language_array['Current Password']						= 'Current Password';

		$language_array['Email Notifications']					= 'Email Notifications';

		$language_array['New Password']							= 'New Password';
		$language_array['New Password Again']					= 'New Password Again';

		$language_array['Profile Updated']						= 'Profile Updated';

		$language_array['New Ticket']							= 'New Ticket';
		$language_array['Permissions']							= 'Permissions';

		$language_array['Status']								= 'Status';
		$language_array['Priority']								= 'Priority';
		$language_array['Submitted By']							= 'Submitted By';
		$language_array['Assigned User']						= 'Assigned User';
		$language_array['Department']							= 'Department';
		$language_array['Added']								= 'Added';
		$language_array['Updated']								= 'Updated';
		$language_array['ID']									= 'ID';

		$language_array['User Details']							= 'User Details';
		$language_array['Phone']								= 'Phone';
		$language_array['Files']								= 'Files';

		$language_array['Notes']								= 'Notes';
		$language_array['Add Note']								= 'Add Note';
		$language_array['Attach File']							= 'Attach File';
		$language_array['Close Ticket']							= 'Close Ticket';
		
		$language_array['ago']									= 'ago';

		$language_array['Open']									= 'Open';
		$language_array['Closed']								= 'Closed';

		$language_array['Search']								= 'Search';
		$language_array['Sort By']								= 'Sort By';
		$language_array['Sort Order']							= 'Sort Order';
		$language_array['Assigned']								= 'Assigned';

		$language_array['Ascending']							= 'Ascending';
		$language_array['Descending']							= 'Descending';

		$language_array['Close']								= 'Close';
		$language_array['Filter']								= 'Filter';
		$language_array['Clear']								= 'Clear';
		
		$language_array['Failed To Create Account']				= 'Failed To Create Account';
		$language_array['Passwords Do Not Match']				= 'Passwords Do Not Match';
		$language_array['Username Invalid']						= 'Username Invalid';
		$language_array['Email Address In Use']					= 'Email Address In Use';
		$language_array['Email Address Invalid']				= 'Email Address Invalid';
		$language_array['Please Enter A Name']					= 'Please Enter A Name';
		$language_array['Account Registration Is Disabled.']	= 'Account Registration Is Disabled.';
		$language_array['Create a Support Ticket']				= 'Create a Support Ticket';
		$language_array['Page Limit']							= 'Page Limit';
		
		$language_array['The database needs upgrading before you continue.']	= 'The database needs upgrading before you continue.';
		
		$language_array['Upgrade']								= 'Upgrade';
		$language_array['Open Tickets']							= 'Open Tickets';
		$language_array['Copyright']							= 'Copyright';
		$language_array['This ticket is from a user without an account.'] = 'This ticket is from a user without an account.';

		$language_array['Subject']								= 'Subject';
		$language_array['Description']							= 'Description';
		$language_array['Subject Empty']						= 'Subject Empty';
		$language_array['File Upload Failed. Ticket Not Submitted.']						= 'File Upload Failed. Ticket Not Submitted.';

		$language_array['Description']							= 'Description';
		$language_array['IP Address']							= 'IP Address';
		$language_array['This page displays the last 100 events in the system.']	= 'This page displays the last 100 events in the system.';
		
		$language_array['Show All']								= 'Show All';

		$language_array['Item']									= 'Item';
		$language_array['Value']								= 'Value';

		$language_array['Severity']								= 'Severity';
		$language_array['Type']									= 'Type';
		$language_array['Source']								= 'Source';
		$language_array['User ID']								= 'User ID';
		$language_array['Reverse DNS Entry']					= 'Reverse DNS Entry';
		$language_array['File']									= 'File';
		$language_array['File Line']							= 'File Line';
		
		$language_array['Are you sure you wish to delete this ticket?']							= 'Are you sure you wish to delete this ticket?';
		
		$language_array['Selected Tickets']						= 'Selected Tickets';
		$language_array['No Tickets Found.']					= 'No Tickets Found.';

		$language_array['Previous']								= 'Previous';
		$language_array['Next']									= 'Next';
		$language_array['Page']									= 'Page';

		$language_array['Toggle']								= 'Toggle';
		$language_array['Do']									= 'Do';
		$language_array['New Guest Ticket']						= 'New Guest Ticket';

		$language_array['Address']								= 'Address';
		$language_array['Authentication Type']					= 'Authentication Type';


		$language_array['Program Version']						= 'Program Version';
		$language_array['Database Version']						= 'Database Version';

		$language_array['There is a software update available.'] = 'There is a software update available.';

		$language_array['More Information']						= 'More Information';
		$language_array['Settings Saved']						= 'Settings Saved';
		$language_array['Site Settings']						= 'Site Settings';

		$language_array['View Guest Ticket']					= 'View Guest Ticket';
		$language_array['Unable to reset password.']			= 'Unable to reset password.';
		$language_array['An email with a reset link has been sent to your account.']			= 'An email with a reset link has been sent to your account.';
		
		$language_array['Request Reset']						= 'Request Reset';

		$language_array['If you have forgotten your password you can reset it here.'] = 'If you have forgotten your password you can reset it here.';
		$language_array['An email will be sent to your account with a reset password link. Please follow this link to complete the password reset process.'] = 'An email will be sent to your account with a reset password link. Please follow this link to complete the password reset process.';

		$language_array['Update Info']							= 'Update Info';
		$language_array['Update Information']					= 'Update Information';
		$language_array['Installed Version']					= 'Installed Version';
		$language_array['Available Version']					= 'Available Version';
		
		$language_array['Download']								= 'Download';
		$language_array['No updates found.']					= 'No updates found.';


		$language_array['Submitter']							= 'Submitter';
		$language_array['Administrator']						= 'Administrator';
		$language_array['Plus User']							= 'Plus User';
		$language_array['Moderator']							= 'Moderator';

		$language_array['Edit User']							= 'Edit User';		
		$language_array['View User']							= 'View User';

		$language_array['Local']								= 'Local';
		$language_array['Active Directory']						= 'Active Directory';
		
		$language_array['Add User']								= 'Add User';
		$language_array['New User']								= 'New User';
		
		$language_array['Full Name']							= 'Full Name';
		
		$language_array['Email (recommended)']					= 'Email (recommended)';
		$language_array['Phone (optional)']						= 'Phone (optional)';
		$language_array['Address (optional)']					= 'Address (optional)';

		$language_array['Name Empty']							= 'Name Empty';
		$language_array['Username Empty']						= 'Username Empty';
		$language_array['Password Empty']						= 'Password Empty';
		$language_array['Username In Use']						= 'Username In Use';

		$language_array['Passwords Do Not Match']				= 'Passwords Do Not Match';
		$language_array['Password (if blank the password is not changed)']				= 'Password (if blank the password is not changed)';

		$language_array['Version']								= 'Version';
		$language_array['Disabled']								= 'Disabled';
		$language_array['Enabled']								= 'Enabled';

		$language_array['This page upgrades the database to the latest version.'] = 'This page upgrades the database to the latest version.';

		$language_array['Your database is currently up to date and does not need upgrading.'] = 'Your database is currently up to date and does not need upgrading.';

		$language_array['Upgrade Complete.']					= 'Upgrade Complete.';

		$language_array['Please ensure you have a full database backup before continuing.']	= 'Please ensure you have a full database backup before continuing.';
	
		$language_array['Start Upgrade']						= 'Start Upgrade';
		$language_array['Site Name']							= 'Site Name';
		$language_array['Domain Name (e.g example.com)']		= 'Domain Name (e.g example.com)';
		$language_array['Script Path (e.g /sts)']				= 'Script Path (e.g /sts)';
	
		$language_array['Port Number (80 for HTTP and 443 for Secure HTTP are the norm)']				= 'Port Number (80 for HTTP and 443 for Secure HTTP are the norm)';

		$language_array['Secure HTTP (recommended, requires SSL certificate)']		= 'Secure HTTP (recommended, requires SSL certificate)';

		$language_array['Default Language']						= 'Default Language';
		$language_array['Site Options']							= 'Site Options';
		$language_array['HTML & WYSIWYG Editor']				= 'HTML & WYSIWYG Editor';
		$language_array['Account Protection (user accounts are locked for 15 minutes after 5 failed logins)']	= 'Account Protection (user accounts are locked for 15 minutes after 5 failed logins)';
		
		$language_array['Login Message']						= 'Login Message';
		$language_array['Account Registration Enabled']			= 'Account Registration Enabled';

		$language_array['Gravatar Enabled']						= 'Gravatar Enabled';
		$language_array['File Storage Enabled (for file attachments)']	= 'File Storage Enabled (for file attachments)';

		$language_array['File Storage Path (must be outside the public web folder e.g./home/sts/files/ or C:\sts\files\)']						= 'File Storage Path (must be outside the public web folder e.g./home/sts/files/ or C:\sts\files\)';

		$language_array['Ticket Settings']						= 'Ticket Settings';
		$language_array['Ticket Settings Saved']				= 'Ticket Settings Saved';
		
		$language_array['Are you sure you wish to delete this user?'] = 'Are you sure you wish to delete this user?';

		$language_array['General Settings']						= 'General Settings';
		$language_array['Reply/Notifications for Anonymous Tickets (sends emails to non-users)'] = 'Reply/Notifications for Anonymous Tickets (sends emails to non-users)';

		$language_array['Guest Portal Text']					= 'Guest Portal Text';
		
		$language_array['Please note that removing priorities that are in use will leave tickets without a priority.']					= 'Please note that removing priorities that are in use will leave tickets without a priority.';

		$language_array['Please note that removing departments that are in use will leave tickets without a department.']				= 'Please note that removing departments that are in use will leave tickets without a department.';

		$language_array['Default Department cannot be deleted.']				= 'Default Department cannot be deleted.';

		$language_array['You cannot delete yourself.']							= 'You cannot delete yourself.';
		
		$language_array['Note: LDAP is required for this function to work.']	= 'Note: LDAP is required for this function to work.';

		$language_array['Server (e.g. dc.example.local or 192.168.1.1)']		= 'Server (e.g. dc.example.local or 192.168.1.1)';
		$language_array['Account Suffix (e.g. @example.local)']					= 'Account Suffix (e.g. @example.local)';
		$language_array['Base DN (e.g. DC=example,DC=local)']					= 'Base DN (e.g. DC=example,DC=local)';
		$language_array['Create user on valid login']							= 'Create user on valid login';

		$language_array['Plugins can be used to add extra functionality to Tickets.']							= 'Plugins can be used to add extra functionality to Tickets.';
		$language_array['Please ensure that you only install trusted plugins.']							= 'Please ensure that you only install trusted plugins.';

		$language_array['Email Settings']										= 'Email Settings';
		$language_array['Cron has been run.']									= 'Cron has been run.';

		$language_array['Please ensure that you have the cron system setup, otherwise emails will not be sent or downloaded.'] = 'Please ensure that you have the cron system setup, otherwise emails will not be sent or downloaded.';

		$language_array['Run Cron Manually']									= 'Run Cron Manually';
		$language_array['Test Email']											= 'Test Email';
		$language_array['Email Address']										= 'Email Address';
		$language_array['Send Test']											= 'Send Test';

		$language_array['Outbound SMTP Server']									= 'Outbound SMTP Server';
		$language_array['SMTP Enabled']											= 'SMTP Enabled';
		$language_array['Server']												= 'Server';
		$language_array['Port']													= 'Port';
		$language_array['TLS']													= 'TLS';
		$language_array['Outgoing Email Address']								= 'Outgoing Email Address';
		$language_array['SMTP Authentication']									= 'SMTP Authentication';

		$language_array['POP3 Accounts']										= 'POP3 Accounts';
		$language_array['Hostname']												= 'Hostname';

		$language_array['Email Notification Templates']							= 'Email Notification Templates';
		$language_array['Body']													= 'Body';
		$language_array['New Ticket Note']										= 'New Ticket Note';
	

		$language_array['Add POP Account']										= 'Add POP Account';
		$language_array['Add Account']											= 'Add Account';
		$language_array['Edit Account']											= 'Edit Account';

		$language_array['No POP3 Accounts Are Setup.']							= 'No POP3 Accounts Are Setup.';

		$language_array['Name (nickname for this account)']						= 'Name (nickname for this account)';
		$language_array['Hostname (i.e mail.example.com)']						= 'Hostname (i.e mail.example.com)';
		$language_array['TLS (required for gmail and other servers that use SSL)']	= 'TLS (required for gmail and other servers that use SSL)';
		
		$language_array['Port (default 110)']									= 'Port (default 110)';
	
		$language_array['Download File Attachments']							= 'Download File Attachments';
		$language_array['Leave Message on Server']								= 'Leave Message on Server';

		$language_array['Adding a POP account allows the system to download emails from the POP account and convert them into Tickets.'] = 'Adding a POP account allows the system to download emails from the POP account and convert them into Tickets.';
		$language_array['The system will match email address to existing users and attach emails to ticket notes if the email is part of an existing ticket.'] = 'The system will match email address to existing users and attach emails to ticket notes if the email is part of an existing ticket.';
		$language_array['The Department and Priority options are only used when creating a new ticket and not when attaching an email to an existing ticket.']								= 'The Department and Priority options are only used when creating a new ticket and not when attaching an email to an existing ticket.';

		$language_array['Are you sure you wish to delete this POP3 Account?']	= 'Are you sure you wish to delete this POP3 Account?';

		$language_array['Test Email Failed. View the logs for more details.']	= 'Test Email Failed. View the logs for more details.';
		$language_array['Test Email Failed. Email address was empty.']			= 'Test Email Failed. Email address was empty.';
		$language_array['Test Email Failed. SMTP server not set.']				= 'Test Email Failed. SMTP server not set.';

		$language_array['Error']												= 'Error';

		$language_array['Captcha']												= 'Captcha';
		$language_array['Anti-Spam Image']										= 'Anti-Spam Image';
		$language_array['Anti-Spam Text']										= 'Anti-Spam Text';
		$language_array['Anti-Spam Text Incorrect']								= 'Anti-Spam Text Incorrect';
		$language_array['Anti-Spam Captcha Enabled (helps protect the guest portal and user registration from bots)']	= 'Anti-Spam Captcha Enabled (helps protect the guest portal and user registration from bots)';

		$language_array['If email address is present notifications can be emailed to the user.'] = 'If email address is present notifications can be emailed to the user.';
		$language_array['Local: The password is stored in the local database.']	= 'Local: The password is stored in the local database.';
		$language_array['Active Directory: The password is stored in Active Directory, password fields are ignored.'] = 'Active Directory: The password is stored in Active Directory, password fields are ignored.';
		$language_array['Note: Active Directory must be enabled and connected to an Active Directory server in the settings page.'] = 'Note: Active Directory must be enabled and connected to an Active Directory server in the settings page.';
		$language_array['Submitters: Can create and view their own tickets.'] = 'Submitters: Can create and view their own tickets.';
		$language_array['Users: Can create and view their own tickets and view assigned tickets.'] = 'Users: Can create and view their own tickets and view assigned tickets.';
		$language_array['Moderators: Can create and view all tickets, assign tickets and create tickets for other users.'] = 'Moderators: Can create and view all tickets, assign tickets and create tickets for other users.';
		$language_array['Administrators: The same as Moderators but can add users and change System Settings.'] = 'Administrators: The same as Moderators but can add users and change System Settings.';

		$language_array['You cannot change the password for this account.']		= 'You cannot change the password for this account.';

		$language_array['Private Message']										= 'Private Message';
		$language_array['Private Messages']										= 'Private Messages';
		$language_array['To']													= 'To';
		$language_array['From']													= 'From';
		$language_array['Date']													= 'Date';
		$language_array['Unread']												= 'Unread';
		$language_array['Sent']													= 'Sent';
		
		$language_array['Are you sure you wish to delete this message?']		= 'Are you sure you wish to delete this message?';

		$language_array['View Message']											= 'View Message';
		$language_array['Create Message']										= 'Create Message';
		$language_array['Send']													= 'Send';

		$language_array['Notice']												= 'Notice';
		$language_array['Warning']												= 'Warning';
		$language_array['Authentication']										= 'Authentication';
		$language_array['Cron']													= 'Cron';
		$language_array['POP3']													= 'POP3';
		$language_array['Storage']												= 'Storage';
		$language_array['No Messages']											= 'No Messages';
		
		
		//Version 2.1+
		
		$language_array['Custom Fields']										= 'Custom Fields';
		$language_array['Text Input']											= 'Text Input';
		$language_array['Text Area']											= 'Text Area';
		$language_array['Drop Down']											= 'Drop Down';
		$language_array['Dropdown']												= 'Dropdown';
		$language_array['Dropdown Fields']										= 'Dropdown Fields';
		$language_array['Input Type']											= 'Input Type';
		$language_array['Option']												= 'Option';
		$language_array['Input Options']										= 'Input Options';

		$language_array['Custom Fields allow you to add extra global fields to your tickets.']	= 'Custom Fields allow you to add extra global fields to your tickets.';


		$language_array['Text Input (single line of text).']					= 'Text Input (single line of text).';
		$language_array['Text Area (multiple lines of text).']					= 'Text Area (multiple lines of text).';
		$language_array['Dropdown box with options.']							= 'Dropdown box with options.';
		$language_array['All data attached to this custom field will be deleted. Are you sure you wish to delete this Custom Field?'] = 'All data attached to this custom field will be deleted. Are you sure you wish to delete this Custom Field?';

		
		//Version 2.2+
		$language_array['Closed Tickets']										= 'Closed Tickets';
		$language_array['Show Extra Settings']									= 'Show Extra Settings';
		$language_array['Default Timezone']										= 'Default Timezone';
		$language_array['Colour']												= 'Colour';
		$language_array['Add Status']											= 'Add Status';
		$language_array['Edit Status']											= 'Edit Status';
		$language_array['HEX Colour']											= 'Hex Colour';
		$language_array['Are you sure you wish to delete this Status?']			= 'Are you sure you wish to delete this Status?';

		
		//Vesion 2.3+
		$language_array['External Services']									= 'External Services';
		$language_array['Add SMTP Account']										= 'Add SMTP Account';
		$language_array['Select SMTP Account']									= 'Select SMTP Account';
		$language_array['Default SMTP Account']									= 'Default SMTP Account';
		$language_array['SMTP Accounts']										= 'SMTP Accounts';
		$language_array['Are you sure you wish to delete this SMTP account?']	= 'Are you sure you wish to delete this SMTP account?';
		$language_array['Port (default 25)']									= 'Port (default 25)';
		$language_array['Pushover Enabled']										= 'Pushover Enabled';
		$language_array['Pushover for all Users']								= 'Pushover for all Users';
		$language_array['Pushover Application Token']							= 'Pushover Application Token';
		$language_array['Pushover Key']											= 'Pushover Key';

		$language_array['Notifications']										= 'Notifications';

		$language_array['Below is a list of the users who will receive pushover notifications whenever a new ticket or ticket note is added.']										= 'Below is a list of the users who will receive pushover notifications whenever a new ticket or ticket note is added.';
		
		$language_array['On Behalf Of']											= 'On Behalf Of';
		$language_array['Assigned To']											= 'Assigned To';
		
		//Version 2.4+
		$language_array['Global Moderator']										= 'Global Moderator';
		$language_array['Staff']												= 'Staff';
		$language_array['Public']												= 'Public';
		$language_array['Members']												= 'Members';
		$language_array['Add Department']										= 'Add Department';
		$language_array['Edit Department']										= 'Edit Department';
		$language_array['Are you sure you wish to delete this Department?']		= 'Are you sure you wish to delete this Department?';
		$language_array['Replies']												= 'Replies';
		$language_array['Reply']												= 'Reply';

		$language_array['Staff: Can create and view their own tickets, view assigned tickets and view tickets within assigned departments.'] = 'Staff: Can create and view their own tickets, view assigned tickets and view tickets within assigned departments.';
		$language_array['Moderators: Can create and view tickets, assign tickets and create tickets for other users within assigned departments.'] = 'Moderators: Can create and view tickets, assign tickets and create tickets for other users within assigned departments.';
		$language_array['Global Moderators: Can create and view all tickets, assign tickets and create tickets for other users.'] = 'Global Moderators: Can create and view all tickets, assign tickets and create tickets for other users.';
		$language_array['Administrators: The same as Global Moderators but can add users and change System Settings.'] = '		Administrators: The same as Global Moderators but can add users and change System Settings.';
		
		//Version 2.5+
		$language_array['Email Account']										= 'Email Account';
		$language_array['Map']													= 'Map';
		$language_array['Send Welcome Email']									= 'Send Welcome Email';
		$language_array['New User (Welcome Email)']								= 'New User (Welcome Email)';
		$language_array['Are you sure you wish to clear the queue?']			= 'Are you sure you wish to clear the queue?';
		$language_array['Reset Cron']											= 'Reset Cron';
		$language_array['Clear Queue']											= 'Clear Queue';
		
		
		$this->lang_array 			= $language_array;
		
	}
	
	public function get() {
		return $this->lang_array;
	}

}	
?>