<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mã xác nhận khôi phục mật khẩu</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .header { text-align: center; border-bottom: 1px solid #e5e7eb; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { color: #10b981; margin: 0; font-size: 24px; }
        .content { color: #374151; line-height: 1.6; }
        .otp-box { background-color: #f9fafb; border: 1px dashed #10b981; padding: 15px; text-align: center; margin: 20px 0; border-radius: 6px; }
        .otp-code { font-size: 32px; font-weight: bold; color: #047857; letter-spacing: 5px; margin: 0; }
        .footer { text-align: center; font-size: 12px; color: #9ca3af; margin-top: 30px; border-top: 1px solid #e5e7eb; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>AquaControl</h1>
        </div>
        <div class="content">
            <p>Xin chào,</p>
            <p>Chúng tôi nhận được yêu cầu khôi phục mật khẩu cho tài khoản liên kết với email <strong>{{ $email }}</strong>.</p>
            <p>Vui lòng sử dụng mã xác nhận dưới đây để tiếp tục. Mã này có hiệu lực trong vòng <strong>5 phút</strong>:</p>
            
            <div class="otp-box">
                <p class="otp-code">{{ $otp }}</p>
            </div>
            
            <p>Nếu bạn không yêu cầu thay đổi mật khẩu, vui lòng bỏ qua email này. Tài khoản của bạn vẫn an toàn.</p>
            <p>Trân trọng,<br>Đội ngũ AquaControl</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} AquaControl. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
