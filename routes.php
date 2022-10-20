<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");
// API ROUTING;
//=============================================================
// Static GET
// In the URL -> http://localhost or https://abuloy.ph
// The output -> Index
get('/', 'index.php');
get('/dashboard', 'views/dashboard.php');
get('/dashboard-user', 'views/dashboard-user.php');
// get('/dashboard-admin', 'views/dashboard-admin.php');

// register
get('/register', 'register.php');
post('/register', 'register.php');
get('/register-email-verification/$token', 'register-email-verification.php');
get('/register-update-verification/$token', 'register-update-verification.php');

// start-new-fund
get('/start-new-fund', 'start-new-fund.php');
post('/start-new-fund', 'start-new-fund.php');
get('/start-new-fund-upload/$token', 'start-new-fund-upload.php');
get('/start-new-fund-verification/$token', 'start-new-fund-verification.php');
get('/start-new-fund-verification-update/$token', 'start-new-fund-verification-update.php');
post('/start-new-fund-fnc', 'views/start-new-fund.fnc.php'); //post functions for start a new fund
post('/start-new-fund-photo', 'views/start-new-fund-photo.php'); //post functions for start a new fund

// my-new-fund
get('/my-new-fund/$token', 'my-new-fund.php');
post('/my-new-fund/$token', 'my-new-fund.php');
get('/my-new-fund-verification/$token', 'my-new-fund-verification.php');

// login
get('/login', 'login.php');
post('/login', 'login.php');
get('/login-verification', 'login-verification.php'); // login-verification *send OTP to email
post('/login-verification', 'login-verification.php');

post('/login-fnc', 'login.fnc.php'); // user-verification *email verified and auto login

// forgot-password
get('/forgot-password', 'forgot-password.php');
post('/forgot-password', 'forgot-password.php');
get('/request-password-success/$token', 'forgot-password-mail.php'); //get forget token for reset of password
// get('/request-password-success/$token', 'request-password-success.php'); // sendForgetEmail
get('/reset-password/$token', 'reset-password.php');  // after email-submit in forgot-password page, comes reset-password page
post('/reset-password/$token', 'reset-password.php');  // send post reset-password to execute fnc
post('/reset-password-fnc', 'reset-password.fnc.php'); // post functions reset-password

// donations or donate page (*list all of funds raise)
get('/donees', 'views/donees.php');
// donees page per account /$aid (*will be available in donate page)
// get('/donate/$aid', 'views/donate.php'); //get donate page if want to donate as anonymous or have no account
// post('/donate/$aid', 'views/donate.php'); //post donate page if want to donate as anonymous or have no account

get('/donate/$code', 'views/donate.php'); //get donate page if want to donate as anonymous or have no account
post('/donate/$code', 'views/donate.php'); //post donate page if want to donate as anonymous or have no account

post('/donate-payment-fnc', 'views/donate-payment.fnc.php'); //post donate page if want to donate as anonymous or have no account
get('/donate-user/$id', 'views/donate-user.php'); //get donate page if want with user account
post('/donate-user/$id', 'views/donate-user.php'); //post donate page if want with user account

// Sharing page (*short url link)
get('/share/$short_url', 'views/share.php');
post('/share/$short_url', 'views/share.php');

// contact
get('/contact-us', 'views/contact-us.php');
post('/contact-us', 'views/contact-us.php');

// terms-and-conditions
get('/terms-and-conditions', 'views/terms-and-conditions.php');

// privacy-policy
get('/privacy-policy', 'views/privacy-policy.php');

// WHY ABULOY.PH
// about-us
get('/about-us', 'views/about-us.php');
// how-it-works
get('/how-it-works', 'views/how-it-works.php');
// faq
get('/faq', 'views/faq.php');


//=============================================================
// User Registered additional pages
// user list of funds page
get('/my-funds', 'views/my-funds.php');
// user account page
get('/account', 'views/account.php');
// list of user funds created
get('/account-list', 'views/account-list.php');
// update-fund (*where user can update the funds infos)
get('/update-fund', 'views/update-fund.php');
// Under Account Page, if Request to Withdraw Fund button click, this page withdrawals can request for withdrawal of fund
get('/account-withdrawal', 'views/account-withdrawal.php');


//=============================================================
// Administrator additional pages
get('/admin', 'admin.php'); // Index page for Admin Only | Login page for Admin Only
// get('/admin-login', 'admin-login.php'); // GET Login page for Admin Only
// post('/admin-login', 'admin-login.php'); // POST Login page for Admin Only
// get('/admin-fnc', 'admin-login-fnc.php'); // GET Login page for Admin Only
get('/dashboard-setting', 'views/admin/dashboard-setting.php');  //dashboard-settings for (users/admin/anonymous donator/sharer)
get('/funds-tracking', 'views/admin/funds-tracking.php'); // funds-tracking pages (status if pending, paid, refunded, expired links, withdrawn funds, audit, etc.)
get('/withdrawals-setting', 'views/admin/withdrawals-setting.php'); // withdrawal-settings for all the funds finished or completed (beneficiary of funds data can be view/update here)
get('/emails-setting', 'views/admin/emails-setting.php'); // email-settings (all the emails send, received, inquiries and templates that transact in abuloy page will be listed here, for references)
get('/account-setting', 'views/admin/account-setting.php'); // account-settings page will help on updating/deleting accounts created by users
get('/member-setting', 'views/admin/member-setting.php'); // member-setting page will be just the list of members of Abuloy and the designation of roles and priviledges for other feature functions in the future
get('/service-policy-setting', 'views/admin/service-policy-setting.php'); // service-policy-settings will help create or modify the abuloy.ph terms and conditions, privacy-policy, how-it-works, about-us, and FAQs page
get('/images-setting', 'views/admin/images-setting.php'); // image-settings page will help crop the images and display the correct resolutions, and also for uploading logos, and user images or account images
get('/themes-setting', 'views/admin/themes-setting.php'); //themes-settings will help to custom a new theme or update the color scheme, transparency and styles of every pages
get('/pages-setting', 'views/admin/pages-setting.php'); // page-settings will update the page meta-datas, create new meta input, buttons, textarea, etc. that will be used for specific pages and other features for the future (*this page also connected to themes-settings)


//=============================================================
// logout
get('/logout', 'logout.php');
get('/logout/$token', 'logout.php');
// post('/logout', 'logout.php');

//=============================================================
// API OR FUNCTIONS CALL
get('/ajax', 'ajax.php');
post('/ajax', 'ajax.php');


//=============================================================
// Redirections
// webhook success or redirect success?hash=request_id
get('/success', 'views/success.php');
post('/success', 'views/success.php');
// webhook fail or redirect fail
get('/fail', 'views/fail.php');
post('/fail', 'views/fail.php');
// webhooks for Forgot Password to Reset/Requests
// get('/request-password-success', 'hooks/request-password-success.php');
get('/request-password-failed', 'hooks/request-password-failed.php');
get('/reset-password-success', 'hooks/reset-password-success.php');
get('/reset-password-failed', 'hooks/reset-password-failed.php');

//=============================================================
// Errors and Validations pages
// Login Verification Error Messages
get('/err-log-exit', 'util/err-log-exit.php'); //login attempt 3 times, locked
get('/status/$err_log_1', 'util/err-log-status.php'); //login attempt 3 times, locked
get('/status/$err_log_2', 'util/err-log-status.php'); //login verification status not verified

//=============================================================
// PHP information
get('/php', 'info.php');

// TEST
get('/info', 'info.php');
get('/shortener', 'views/shortener.php');
get('/code-generator', 'views/code-generator.php');
get('/testmail', 'testmail.php');
get('/formscript', 'formscript.php');


//=============================================================
// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','404.php');