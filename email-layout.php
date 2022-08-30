<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    
</head>
<body>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
    <style type='text/css'>
    body {
        font-family: 'Poppins', Sans-Serif;
    }
    </style>    
    <table style='width:50vw'>
        <tr>
            <td><a href='abuloy.ph' style='background-color:#A265E6;color:white;font-size:24px;padding:0.2rem 0.5rem;margin:0;border-top-left-radius:30px;border-top-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;'><span style='font-family:Poppins,sans-serif;font-weight:700;text-decoration:underline;color:#94F7CF;margin-left:0.5rem'>Abuloy</span></a></td>
        </tr>
        <tr>
            <td><div style='position:relative;top:10px;margin:5px 0;border-bottom: 2px solid #94F7CF'></div></td>
        </tr>
        <tr>
            <td style='width:100vh;margin:2% 0;'><div style='margin-top:25px;text-align:left;width:100vh;'>Hi $user_firstname,<br/><br/><span style='color:#A265E6;font-weight:500'>Forgot your password? Let's have a new one!</span><br/></div></td>
        </tr>
        <tr>
            <td style='padding: 15px 0 20px;'>We have received a request to reset your password for Abuloy.PH account.</td>
        </tr>
        <tr><td style='padding: 0px 0 15px 0;'>You can change your password by clicking the link below:</td></tr>
        <tr>
            <td style='padding: 0px 0 15px 0;'><a href="/reset-password" style='height:50px;border-radius:25px;background-color:#A265E6;color:#94F7CF;padding:8px 15px;text-align:center;font-weight:500;font-family:Poppins'>Set a new password</a></td>
        </tr>
        <tr>
            <td style='padding: 15px 0 0 0;'>However, if you did not request to reset your password.<br/>Please email us immediately by replying to this email.</td>
        </tr>
    </table>

    <div>
    <form action="/reset-password-fnc" method="POST" class="reset-form">
        <input type="text" id="email" name="email" class="form-control my-3" value="<?= $email ?>">
        <input type="text" id="password" name="password" class="form-control text-center" placeholder="Enter New">
        <span class="reset-error"></span>
        <button class="btn btn-lavander my-3 reset-submit btn-sm">Validate and Login</button>
    </form>
    </div>
</body>
</html>