<?
$jsVersion = "2.0.15";
$cssVersion = "2.0.8";

$ACCEPT_LANG = ['tc', 'sc', 'en'];

// warroom goal log
$GOAL_LOG_VIEW = 0;
$GOAL_LOG_STATUS = 1;
$GOAL_LOG_DISCUSSION = 2;

// mobile
$MOBILE_IOS_MINI_VERSION = "1.0.0";
$MOBILE_IOS_MINI_BUILD = 1;
$MOBILE_ANDROID_MINI_VERSION = "1.0.0";
$MOBILE_ANDROID_MINI_BUILD = 1;

// upload folders
$FACE_FOLDER = "../../face_files/";
$ATTACHMENT_FOLDER = "../../warroom_attachment_files/";
$LEAVE_FOLDER = "../../leave_attachment_files/";
$EXPENSE_FOLDER = "../../expense_attachment_files/";

// action log
$ACTION_LOG_NA = -1;
$ACTION_LOG_LOGIN = 0;
$ACTION_LOG_ENTER_STAFF = 1;
$ACTION_LOG_ADD_USER = 2;
$ACTION_LOG_EDIT_USER = 3;
$ACTION_LOG_DELETE_USER = 4;
$ACTION_LOG_ENTER_COMPANY = 5;
$ACTION_LOG_ADD_DEPARTMENT = 6;
$ACTION_LOG_EDIT_DEPARTMENT = 7;
$ACTION_LOG_DELETE_DEPARTMENT = 8;
$ACTION_LOG_ADD_POSITION = 9;
$ACTION_LOG_EDIT_POSITION = 10;
$ACTION_LOG_DELETE_POSITION = 11;
$ACTION_LOG_ENTER_BATCH_UPLOAD = 12;
$ACTION_LOG_BATCH_UPLOAD_USER = 13;
$ACTION_LOG_BATCH_UPLOAD_SALES = 14;
$ACTION_LOG_BATCH_UPLOAD_ROI = 15;
$ACTION_LOG_BATCH_DELETE_USER = 16;
$ACTION_LOG_BATCH_DELETE_SALES = 17;
$ACTION_LOG_BATCH_DELETE_ROI = 18;
$ACTION_LOG_ENTER_PMP = 19;
$ACTION_LOG_CREATE_PMP = 20;
$ACTION_LOG_EDIT_PMP = 21;
$ACTION_LOG_DELETE_PMP = 22;
$ACTION_LOG_CONFIRM_BEGINNING_REVIEW = 23;
$ACTION_LOG_CONFIRM_MID_YEAR_REVIEW  = 24;
$ACTION_LOG_CONFIRM_YEAR_END_REVIEW  = 25;
$ACTION_LOG_UPDATE_PMP_REVIEW = 26;
$ACTION_LOG_DELETE_PMP_REVIEW = 27;
$ACTION_LOG_UNLOCK_PMP_REVIEW = 28;
$ACTION_LOG_ENTER_VEIN = 29;
$ACTION_LOG_CREATE_VEIN = 30;
$ACTION_LOG_DELETE_VEIN = 31;
$ACTION_LOG_COMPLETE_VEIN = 32;
$ACTION_LOG_ENTER_ONBOARD = 33;
$ACTION_LOG_CREATE_ONBOARD = 34;
$ACTION_LOG_DELETE_ONBAORD = 35;
$ACTION_LOG_COMPLETE_ONBOARD = 36;
$ACTION_LOG_ENTER_HUMAN_CAPITAL = 37;
$ACTION_LOG_ENTER_SALES_PERFORMANCE = 38;
$ACTION_LOG_ENTER_ROI = 39;
$ACTION_LOG_ENTER_COMPETENCY = 40;
$ACTION_LOG_ADD_COMPETENCY = 41;
$ACTION_LOG_UPDATE_COMPETENCY = 42;
$ACTION_LOG_DELETE_COMPETENCY = 43;
$ACTION_LOG_ENTER_PERMISSION = 44;
$ACTION_LOG_ADD_PERMISSION = 45;
$ACTION_LOG_UPDATE_PERMISSION = 46;
$ACTION_LOG_DELETE_PERMISSION = 47;
$ACTION_LOG_ENTER_SUPPORT = 48;
$ACTION_LOG_ADD_SUPPORT_TICKET = 49;
$ACTION_LOG_ADD_SUPPORT_REPLY = 50;
$ACTION_LOG_UPDATE_SUPPORT_STATUS = 51;
$ACTION_LOG_ENTER_SETTINGS = 52;
$ACTION_LOG_CHANGE_LANGUAGE = 53;
$ACTION_LOG_CHANGE_LOGO = 54;
$ACTION_LOG_CHANGE_PASSWORD = 55;
$ACTION_LOG_ENTER_LOG = 56;
$ACTION_LOG_ENTER_WAR_ROOM = 57;
$ACTION_LOG_ADD_COMPANY = 58;
$ACTION_LOG_EDIT_COMPANY = 59;
$ACTION_LOG_DELETE_COMPANY = 60;
$ACTION_LOG_ADD_PMP_REVIEW = 61;
$ACTION_LOG_ADD_WAR_ROOM = 62;
$ACTION_LOG_DELETE_WAR_ROOM = 63;
$ACTION_LOG_ADD_WAR_ROOM_GOAL = 64;
$ACTION_LOG_DELETE_WAR_ROOM_GOAL = 65;
$ACTION_LOG_UPDATE_WAR_ROOM_GOAL_STATUS = 66;
$ACTION_LOG_ADD_WAR_ROOM_DISCUSSION = 67;
$ACTION_LOG_UPDATE_WAR_ROOM_GOAL = 68;
$ACTION_LOG_EDIT_WAR_ROOM = 69;
$ACTION_LOG_ENTER_ATTENDANCE = 70;
$ACTION_LOG_REGISTER_ATTENDANCE = 71;
$ACTION_LOG_CHECK_ATTENDANCE = 72;
$ACTION_LOG_UPDATE_ATTENDANCE_SETTING = 73;
$ACTION_LOG_ENTER_PROFILE = 74;
$ACTION_LOG_ENTER_PERSONNEL_RECORD = 75;
$ACTION_LOG_ENTER_STAFF_PARTICULARS = 76;
$ACTION_LOG_ENTER_TERMINATION_STAFF = 77;
$ACTION_LOG_ENTER_PART_TIME_STAFF = 78;
$ACTION_LOG_ENTER_NEW_HIRES = 79;
$ACTION_LOG_ENTER_SELF_UPDATE = 80;
$ACTION_LOG_ENTER_BIRTHDAY_ALERT = 81;
$ACTION_LOG_ENTER_METRIC_ANALYTICS = 82;
$ACTION_LOG_ENTER_HRIS_SETTING = 83;
$ACTION_LOG_ENTER_LEAVE = 84;
$ACTION_LOG_BATCH_UPLOAD_LEAVE = 85;
$ACTION_LOG_ENTER_GRADE = 86;
$ACTION_LOG_ENTER_OCHART = 87;
$ACTION_LOG_CHANGE_OCHART = 88;
$ACTION_LOG_ENTER_ROSTER = 89;
$ACTION_LOG_BATCH_UPLOAD_ROSTER = 90;
$ACTION_LOG_ENTER_EXPENSE = 91;
$ACTION_LOG_ENTER_SPECIAL = 92;
$ACTION_LOG_ENTER_DEDUCT = 93;
$ACTION_LOG_BATCH_UPLOAD_SPECIAL_PAYMENT = 94;
$ACTION_LOG_ENTER_PAYROLL_ITEM = 95;
$ACTION_LOG_ENTER_PAYROLL_SETTING = 96;
$ACTION_LOG_ENTER_PAYROLL = 97;
$ACTION_LOG_ENTER_TAX = 98;
$ACTION_LOG_ENTER_LOGO = 99;
$ACTION_LOG_ENTER_ITINERARY = 100;
$ACTION_LOG_CHANGE_COMPANY_INFO = 101;
$ACTION_LOG_ENTER_MPF = 102;
$ACTION_LOG_BATCH_UPLOAD_ATTENDANCE = 103;
$ACTION_LOG_ENTER_CW_PERSONNEL_RECORD = 104;
$ACTION_LOG_ENTER_CW_SETTING = 105;
$ACTION_LOG_ENTER_CW_RECORD = 106;
$ACTION_LOG_ENTER_CW_HISTORY = 107;
$ACTION_LOG_ENTER_CW_LOG = 108;
$ACTION_LOG_ENTER_ASSESS_360 = 109;

// profile change log
$EMPLOYEE_LOG_OTHERS = -1;
$EMPLOYEE_LOG_USERNAME = 0;
$EMPLOYEE_LOG_STAFF_NAME = 1;
$EMPLOYEE_LOG_ENGLISH_NAME = 2;
$EMPLOYEE_LOG_CHINESE_NAME = 3;
$EMPLOYEE_LOG_HKID = 4;
$EMPLOYEE_LOG_BIRTH = 5;
$EMPLOYEE_LOG_SEX = 6;
$EMPLOYEE_LOG_ADDRESS = 7;
$EMPLOYEE_LOG_PERSONAL_EMAIL = 8;
$EMPLOYEE_LOG_HOME = 9;
$EMPLOYEE_LOG_MOBILE = 10;
$EMPLOYEE_LOG_EMERGENCY_CONTACT_PERSON = 11;
$EMPLOYEE_LOG_DEPARTMENT = 12;
$EMPLOYEE_LOG_POSITION = 13;
$EMPLOYEE_LOG_JOIN = 14;
$EMPLOYEE_LOG_TERMINATION = 15;
$EMPLOYEE_LOG_PROBATION = 16;
$EMPLOYEE_LOG_STAFF_ID = 17;
$EMPLOYEE_LOG_SALARY = 18;
$EMPLOYEE_LOG_SALARY_TYPE = 19;
$EMPLOYEE_LOG_GRADE = 20;
$EMPLOYEE_LOG_EMPLOYMENT = 21;
$EMPLOYEE_LOG_LEVEL = 22;
$EMPLOYEE_LOG_ACTIVE = 23;
$EMPLOYEE_LOG_VISA = 24;
$EMPLOYEE_LOG_PASSPORT = 25;
$EMPLOYEE_LOG_PLACE_OF_ISSUE = 26;
$EMPLOYEE_LOG_NATIONALITY = 27;
$EMPLOYEE_LOG_RACE = 28;
$EMPLOYEE_LOG_RELIGION = 29;
$EMPLOYEE_LOG_MARITAL = 30;
$EMPLOYEE_LOG_EDUCATION = 31;
$EMPLOYEE_LOG_QUALIFICATION = 32;
$EMPLOYEE_LOG_BANK_NAME = 33;
$EMPLOYEE_LOG_BANK_ACCOUNT = 34;
$EMPLOYEE_LOG_CLASS = 35;
// $EMPLOYEE_LOG_OVERTIME = 35;
// $EMPLOYEE_LOG_COMMISSION = 36;
// $EMPLOYEE_LOG_ANNUAL_LEAVE = 37;
// $EMPLOYEE_LOG_MEDICAL = 38;
$EMPLOYEE_LOG_EMERGENCY_CONTACT_PHONE = 36;
$EMPLOYEE_LOG_TEAM_ID = 37;
$EMPLOYEE_LOG_COUNTRY = 38;
$EMPLOYEE_LOG_BANK_CODE = 39;
$EMPLOYEE_LOG_MAX_COUNT = 39;

$CW_LOG_LAST_NAME = 1;
$CW_LOG_FIRST_NAME = 2;
$CW_LOG_HKID = 3;
$CW_LOG_SEX = 4;
$CW_LOG_BIRTH = 5;
$CW_LOG_ADDRESS = 6;
$CW_LOG_PHONE = 7;
$CW_LOG_EMERGENCY_NAME = 8;
$CW_LOG_EMERGENCY_NO = 9;
$CW_LOG_MPF = 10;
$CW_LOG_JOIN = 11;
$CW_LOG_TERM = 12;
$CW_LOG_HOURLY_RATE = 13;
$CW_LOG_DEPARTMENT = 14;
$CW_LOG_POSITION = 15;
$CW_LOG_DELETE_PM = 16;
$CW_LOG_APPROVE_PM = 17;
$CW_LOG_ADD_IN = 18;
$CW_LOG_ADD_OUT = 19;
$CW_LOG_UPDATE_IN = 20;
$CW_LOG_UPDATE_OUT = 21;
$CW_LOG_DELETE_IN = 22;
$CW_LOG_DELETE_OUT = 23;
$CW_LOG_UNIT_PRICE = 24;
$CW_LOG_QTY = 25;
$CW_LOG_ADD_LOCATION = 26;
$CW_LOG_UPDATE_LOCATION = 27;

// package
$PACKAGE_SETUP = "Setup";
$PACKAGE_HUMAN_CAPITAL = "Human_Capital";
$PACKAGE_BUSINESS = "Business";
$PACKAGE_ROI = "ROI";
$PACKAGE_QUIZ = "Quiz";
$PACKAGE_ONBOARDING = "Onboarding";
$PACKAGE_WAR_ROOM = "War_Room";
$PACKAGE_ATTENDANCE = "Attendance";
$PACKAGE_PERSONNEL_RECORD = "Personnel_Record";
$PACKAGE_LEAVE = "Leave";
$PACKAGE_ITINERARY = "Itinerary";
$PACKAGE_ROSTER = "Roster";
$PACKAGE_EXPENSE = "Pay_Item";
$PACKAGE_COMPETENCY = "Competency";
$PACKAGE_SUPPORT = "Support";
$PACKAGE_PAYROLL = "Payroll";
$PACKAGE_TAX = "Tax";
$PACKAGE_CW = "Casual_Worker";
$PACKAGE_CW_UNIT = "Casual_Worker_Unit";
$PACKAGE_ASSESS_360 = "Assess360";

//-----------------------------NEW------------------------------------
$PACKAGE_LIST_OF_RATERS = "List_of_raters";
//--------------------------------------------------------------------

// session page
$SESSION_PAGE_BULK = "bulk";
$SESSION_PAGE_COMPANY = "company";
$SESSION_PAGE_GRADE = "grade";
$SESSION_PAGE_OCHART = "ochart";
$SESSION_PAGE_LOGO = "logo";
$SESSION_PAGE_ROLE = "role";
$SESSION_PAGE_COMPETENCY = "competency";
$SESSION_PAGE_DASHBOARD = "dashboard";
$SESSION_PAGE_PACKAGE = "package";
$SESSION_PAGE_PMP = "pmp";
$SESSION_PAGE_WAR_ROOM = "war_room";
$SESSION_PAGE_QUIZ = "quiz";
$SESSION_PAGE_ONBOARDING = "onboarding";
$SESSION_PAGE_ROI = "roi";
$SESSION_PAGE_SALES = "sales";
$SESSION_PAGE_ATTENDANCE = "attendance";
$SESSION_PAGE_SETTINGS = "settings";
$SESSION_PAGE_SUPPORT = "support";
$SESSION_PAGE_USERS = "users";
$SESSION_PAGE_LOG = "log";
$SESSION_PAGE_PERSONNEL_RECORD = "personnelRecord";
$SESSION_PAGE_STAFF_PARTICULARS = "staffParticulars";
$SESSION_PAGE_TERMINATION = "termination";
$SESSION_PAGE_PARTTIME = "pattime";
$SESSION_PAGE_NEW_HIRES = "newHires";
$SESSION_PAGE_SELF_UPDATE = "selfUpdate";
$SESSION_PAGE_BIRTHDAY_ALERT = "birthdayAlert";
$SESSION_PAGE_METRIC_DASHBOARD = "metricDashboard";
$SESSION_PAGE_HRIS_SETTING = "hrisSetting";
$SESSION_PAGE_LEAVE = "leave";
$SESSION_PAGE_ITINERARY = "itinerary";
$SESSION_PAGE_ROSTER = "roster";
$SESSION_PAGE_EXPENSE = "expense";
$SESSION_PAGE_SPECIAL = "special";
$SESSION_PAGE_DEDUCT = "deduct";
$SESSION_PAGE_PAYROLL = "payroll";
$SESSION_PAGE_TAX = "tax";
$SESSION_PAGE_MPF = "mpf";
$SESSION_PAGE_CW_SETTING = "casualWorkerSetting";
$SESSION_PAGE_CW_PM = "casualWorkerPM";
$SESSION_PAGE_CW_RECORD = "casualWorkerRecord";
$SESSION_PAGE_CW_HISTORY = "casualWorkerHistory";
$SESSION_PAGE_CW_LOG = "casualWorkerLog";
$SESSION_PAGE_ASSESS_360 = "assess360";

//----------------------------------NEW-----------------------------------
$SESSION_PAGE_LIST_OF_RATERS = "List_of_raters";
//------------------------------------------------------------------------

// user setting
$USER_SETTING_STAFF_ID = 1;
$USER_SETTING_NAME = 2;
$USER_SETTING_NAME_EN = 3;
$USER_SETTING_NAME_CN = 4;
$USER_SETTING_SEX = 5;
$USER_SETTING_HKID = 6;
$USER_SETTING_BIRTH = 7;
$USER_SETTING_MARITAL = 8;
$USER_SETTING_EDUCATION = 9;
$USER_SETTING_QUALIFICATION = 10;
$USER_SETTING_JOIN_DATE = 11;
$USER_SETTING_PROBATION_DATE = 12;
$USER_SETTING_DEPARTMENT = 13;
$USER_SETTING_POSITION = 14;
$USER_SETTING_TEAM_ID = 15;
$USER_SETTING_GRADE_LEVEL = 16;
$USER_SETTING_EMPLOYMENT = 17;
$USER_SETTING_SALARY = 18;
$USER_SETTING_CLASS = 19;
$USER_SETTING_COUNTRY = 20;
$USER_SETTING_TERMINATION_DATE = 21;
$USER_SETTING_MOBILE_NO = 22;
$USER_SETTING_HOME_NO = 23;
$USER_SETTING_PERSONAL_EMAIL = 24;
$USER_SETTING_BANK_NAME = 25;
$USER_SETTING_BANK_CODE = 26;
$USER_SETTING_BANK_ACCOUNT = 27;
$USER_SETTING_EMERGENCY = 28;
$USER_SETTING_ADDRESS = 29;
$USER_SETTING_VISA = 30;
$USER_SETTING_PASSPORT = 31;
$USER_SETTING_PLACE_OF_ISSUE = 32;
$USER_SETTING_NATIONALITY = 33;
$USER_SETTING_RACE = 34;
$USER_SETTING_RELIGION = 35;
$USER_SETTING_MAX_COUNT = 35;

// permission
$PERMISSION_STAFF_VIEW = "1_1";
$PERMISSION_STAFF_EDIT = "1_2";
$PERMISSION_STAFF_EDIT_SALARY = "1_3";
$PERMISSION_STAFF_EDIT_PROBATION = "1_4";
$PERMISSION_STAFF_EDIT_TERMINATION = "1_5";
$PERMISSION_STAFF_EDIT_ANNUAL_LEAVE = "1_6";
$PERMISSION_STAFF_EDIT_BENEFIT_MEDICAL = "1_7";
$PERMISSION_STAFF_VIEW_PROBATION = "1_8";
$PERMISSION_STAFF_VIEW_TERMINATION = "1_9";
$PERMISSION_ROLE_VIEW = "15_1";
$PERMISSION_ROLE_EDIT = "15_2";
$PERMISSION_COMPANY_VIEW = "2_1";
$PERMISSION_COMPANY_EDIT = "2_2";
$PERMISSION_COMPANY_GRADE = "2_3";
$PERMISSION_COMPANY_CHART = "2_4";
$PERMISSION_COMPANY_LEAVE_LIABILITY = "2_5";
$PERMISSION_BATCH_UPLOAD_VIEW = "3_1";
$PERMISSION_BATCH_UPLOAD_EDIT = "3_2";
$PERMISSION_PROFILE_VIEW = "14_1";
$PERMISSION_PROFILE_RECORD = "14_2";
$PERMISSION_PROFILE_PARTICULAR = "14_3";
$PERMISSION_PROFILE_TERMINATION = "14_4";
$PERMISSION_PROFILE_PARTTIME = "14_5";
$PERMISSION_PROFILE_NEW_HIRE = "14_6";
$PERMISSION_PROFILE_SELF_UPDATE = "14_7";
$PERMISSION_PROFILE_BIRTHDAY_ALERT = "14_8";
$PERMISSION_PROFILE_METRIC_DASHBOARD = "14_9";
$PERMISSION_PROFILE_418_ALERT_EMAIL = "14_10";
$PERMISSION_PROFILE_PASS_PROBATION_ALERT_EMAIL = "14_11";
$PERMISSION_ATTENDANCE_VIEW = "13_1";
$PERMISSION_ATTENDANCE_VIEW_ALL = "13_2";
$PERMISSION_ATTENDANCE_EDIT = "13_3";
$PERMISSION_ATTENDANCE_MOBILE = "13_4";
$PERMISSION_PMP_VIEW = "4_1";
$PERMISSION_PMP_ADD = "4_2";
$PERMISSION_PMP_EDIT = "4_3";
$PERMISSION_PMP_RESULT = "4_4";
$PERMISSION_PMP_APPRAISER = "4_5";
$PERMISSION_HUMAN_CAPITAL_VIEW = "5_1";
$PERMISSION_ROI_VIEW = "6_1";
$PERMISSION_ROI_EDIT = "6_2";
$PERMISSION_SALES_PERFORMANCE_VIEW = "7_1";
$PERMISSION_SALES_PERFORMANCE_EDIT = "7_2";
$PERMISSION_VEIN_VIEW = "8_1";
$PERMISSION_VEIN_EDIT = "8_2";
$PERMISSION_VEIN_RESULT = "8_3";
$PERMISSION_VEIN_MANAGER = "8_4";
$PERMISSION_VEIN_STAFF = "8_5";
$PERMISSION_ONBOARD_VIEW = "9_1";
$PERMISSION_ONBOARD_EDIT = "9_2";
$PERMISSION_ONBOARD_RESULT = "9_3";
$PERMISSION_WARROOM_VIEW = "10_1";
$PERMISSION_WARROOM_VIEW_ALL = "10_2";
$PERMISSION_WARROOM_EDIT = "10_3";
$PERMISSION_SUPPORT_VIEW = "11_1";
$PERMISSION_SUPPORT_EDIT = "11_2";
$PERMISSION_SETTINGS_VIEW = "12_1";
$PERMISSION_SETTINGS_EDIT = "12_2";
$PERMISSION_LEAVE_VIEW = "16_1";
$PERMISSION_LEAVE_VIEW_DEPARTMENT = "16_2";
$PERMISSION_LEAVE_VIEW_ALL = "16_3";
$PERMISSION_LEAVE_APPROVE = "16_4";
$PERMISSION_LEAVE_SETUP = "16_5";
$PERMISSION_LEAVE_ADJUSTMENT = "16_6";
$PERMISSION_LEAVE_VIEW_TEAM = "16_7";
$PERMISSION_ROSTER_SETUP = "17_1";
$PERMISSION_ROSTER_VIEW = "17_2";
$PERMISSION_ROSTER_VIEW_DEPARTMENT = "17_3";
$PERMISSION_ROSTER_VIEW_ALL = "17_4";
$PERMISSION_ROSTER_VIEW_TEAM = "17_5";
$PERMISSION_COMPETENCY_VIEW = "18_1";
$PERMISSION_EXPENSE_VIEW = "20_1";
$PERMISSION_EXPENSE_APPROVE = "20_2";
$PERMISSION_PAYROLL_VIEW = "21_1";
$PERMISSION_PAYROLL_VIEW_RECONCILIATION = "21_2";
$PERMISSION_PAYROLL_VIEW_LIABILITY = "21_3";
$PERMISSION_PAYROLL_CONFIRM = "21_4";
$PERMISSION_PAYROLL_DOUBLE_CONFIRM = "21_5";
$PERMISSION_TAX_VIEW = "22_1";
$PERMISSION_TAX_VIEW_ALL = "22_2";
$PERMISSION_TAX_VIEW_SUMMARY = "22_3";
$PERMISSION_TAX_GENERATE_REPORT = "22_4";
$PERMISSION_ITINERARY_VIEW = "23_1";
$PERMISSION_ITINERARY_VIEW_DEPARTMENT = "23_2";
$PERMISSION_ITINERARY_VIEW_ALL = "23_3";
$PERMISSION_ITINERARY_APPROVE = "23_4";
$PERMISSION_ITINERARY_VIEW_TEAM = "23_5";
$PERMISSION_HRIS_SELF_UPDATE = "24_1";
$PERMISSION_HRIS_418_ALERT = "24_2";
$PERMISSION_HRIS_BIRTHDAY = "24_3";
$PERMISSION_HRIS_LEAVE = "24_4";
$PERMISSION_HRIS_OTHER_BENEFIT = "24_5";
$PERMISSION_HRIS_ATTENDANCE = "24_6";
$PERMISSION_HRIS_HOLIDAY = "24_7";
$PERMISSION_HRIS_SHIFT = "24_8";
$PERMISSION_HRIS_LEAVE_LIABILITY = "24_9";
$PERMISSION_HRIS_PAY_ITEM = "24_10";
$PERMISSION_HRIS_AVERAGE_WAGE = "24_11";
$PERMISSION_HRIS_PAYROLL = "24_12";
$PERMISSION_HRIS_TAX = "24_13";
$PERMISSION_HRIS_LEAVE_APPROVAL = "24_14";
$PERMISSION_HRIS_DAILY_WORKING_HOURS = "24_15";
$PERMISSION_HRIS_LATE_DEDUCTION = "24_16";
$PERMISSION_MPF_VIEW = "25_1";
$PERMISSION_ASSESS360_VIEW = "26_1";

// template type
$TEMPLATE_TYPE_BIRTHDAY_ALERT = 1;
$TEMPLATE_TYPE_PAYSLIP = 2;

$TEMPLATE_TYPE_PAYSLIP_ORIENTAL = 1;
$TEMPLATE_TYPE_PAYSLIP_PROCURENET = 2;

// annual leave status
$ANNUAL_LEAVE_STATUS_PROCESSING = 0;
$ANNUAL_LEAVE_STATUS_APPROVED = 1;
$ANNUAL_LEAVE_STATUS_REJECTED = 2;
$ANNUAL_LEAVE_STATUS_SYSTEM_ADD = -2;
$ANNUAL_LEAVE_STATUS_CARRY_FORWARD = -3;
$ANNUAL_LEAVE_STATUS_ADJUST_BALANCE_MANUAL = -4;

// leave approval
$LEAVE_APPROVAL_BY_POSITION = 0;
$LEAVE_APPROVAL_BY_GRADE = 1;
$LEAVE_APPROVAL_BY_STAFF = -1;
$LEAVE_APPROVAL_BY_USER_RIGHT = 2;

// leave id
$LEAVE_TYPE_ANNUAL = 1;
$LEAVE_TYPE_CON_SICK_LEAVE = 2;
$LEAVE_TYPE_BIRTHDAY = 3;
$LEAVE_TYPE_FULL_SICK_LEAVE = 4;
$LEAVE_TYPE_WORK_INJURY = 5;

// itinerary status
$ITINERARY_STATUS_PROCESSING = 0;
$ITINERARY_STATUS_APPROVED = 1;
$ITINERARY_STATUS_REJECTED = 2;

// expense type
$EXPENSE_TYPE_ALLOWANCE = 0;
$EXPENSE_TYPE_DEDUCTION = 1;
// $EXPENSE_TYPE_REIMBURSEMENT = 2;
// $EXPENSE_TYPE_MEDICAL = 3;

// expense status
$EXPENSE_STATUS_PROCESSING = 0;
$EXPENSE_STATUS_APPROVED = 1;
$EXPENSE_STATUS_REJECTED = 2;
$EXPENSE_STATUS_SPECIAL = 3;

// payroll confirm / approve / reject
$PAYROLL_CONFIRM = 0;
$PAYROLL_APPROVE = 1;
$PAYROLL_REJECT = 2;

// holiday country
$HOLIDAY_COUNTRY_HK = "Hong Kong";
$HOLIDAY_COUNTRY_US = "United States";
$HOLIDAY_COUNTRY_UK = "United Kingdom";

// bank
$BANK_CODE_BOCHK = "bochk";
$BANK_CODE_HSBC = "hsbc";

// mpf
$MPF_TYPE_EMPLOYEE = 0;
$MPF_TYPE_EMPLOYER = 1;

// casual worker
$CW_RECORD_STATUS_UNAPPROVE = 0;
$CW_RECORD_STATUS_APPROVED = 1;
$CW_RECORD_STATUS_PAID = 2;