<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Registration Confirmed</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #e83068 0%, #f1e73c 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 26px;
        }
        .content {
            padding: 30px;
        }
        .content h2 {
            color: #e83068;
            margin-top: 0;
        }
        .highlight-box {
            background: #fff8e1;
            border-left: 4px solid #f1e73c;
            padding: 15px;
            margin: 20px 0;
        }
        .message-box {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .message-box h4 {
            margin-top: 0;
            color: #666;
        }
        .footer {
            background: #2d3748;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .footer h3 {
            color: #f1e73c;
            margin-top: 0;
        }
        .footer p {
            margin: 5px 0;
            color: #cbd5e0;
        }
        .footer a {
            color: #f1e73c;
            text-decoration: none;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #f1e73c;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Registration Confirmed!</h1>
        </div>

        <div class="content">
            <h2>Hi {{ $submission->name }},</h2>

            <p>Thank you for registering for an activity with <strong>Edinburgh College BASE</strong>!</p>

            <div class="highlight-box">
                <p><strong>✅ Your registration has been confirmed!</strong></p>
                <p>We've received your registration and our team will contact you shortly with further details.</p>
            </div>

            <p>For your records, here are your registration details:</p>

            <div class="message-box">
                <h4>Activity Details:</h4>
                @php
                    // Parse the message to extract details
                    $lines = explode("\n", $submission->message);
                    $details = [];
                    foreach ($lines as $line) {
                        if (strpos($line, ':') !== false && $line !== 'Activity Registration:' && $line !== 'Registrant Details:') {
                            list($key, $value) = explode(':', $line, 2);
                            $details[trim($key)] = trim($value);
                        }
                    }
                @endphp

                <table style="width: 100%; margin-bottom: 20px;">
                    @if(isset($details['Activity']))
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold; width: 100px;">Activity:</td>
                        <td style="padding: 8px 0;">{{ $details['Activity'] }}</td>
                    </tr>
                    @endif
                    @if(isset($details['Date']))
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Date:</td>
                        <td style="padding: 8px 0;">{{ $details['Date'] }}</td>
                    </tr>
                    @endif
                    @if(isset($details['Time']) && $details['Time'] !== 'N/A')
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Time:</td>
                        <td style="padding: 8px 0;">{{ $details['Time'] }}</td>
                    </tr>
                    @endif
                    @if(isset($details['Location']) && $details['Location'] !== 'N/A')
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Location:</td>
                        <td style="padding: 8px 0;">{{ $details['Location'] }}</td>
                    </tr>
                    @endif
                    @if(isset($details['Price']))
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Price:</td>
                        <td style="padding: 8px 0;">{{ $details['Price'] }}</td>
                    </tr>
                    @endif
                </table>

                <h4>Registrant Details:</h4>
                <table style="width: 100%;">
                    @if(isset($details['Name']))
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold; width: 100px;">Name:</td>
                        <td style="padding: 8px 0;">{{ $details['Name'] }}</td>
                    </tr>
                    @endif
                    @if(isset($details['Email']))
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Email:</td>
                        <td style="padding: 8px 0;">{{ $details['Email'] }}</td>
                    </tr>
                    @endif
                </table>

                <p style="color: #999; font-size: 12px; margin-top: 15px;">
                    Registered: {{ $submission->created_at->format('l, d F Y \a\t H:i') }}
                </p>
            </div>

            <p>If you have any questions or need to make changes to your registration, please don't hesitate to contact us:</p>
            <p>
                📞 <strong>Phone:</strong> +44 (0) 131 XXX XXXX<br>
                📧 <strong>Email:</strong> <a href="mailto:info@hub-base.co.uk">info@hub-base.co.uk</a>
            </p>

            <p>We look forward to seeing you at the activity!</p>

            <p>Best regards,<br>
            <strong>The Edinburgh College BASE Team</strong></p>
        </div>

        <div class="footer">
            <h3>Edinburgh College BASE</h3>
            <p>Business Advice and Support for Entrepreneurs</p>
            <p>Bankhead Avenue, Sighthill</p>
            <p>Edinburgh, EH11 4DE</p>
            <br>
            <p>
                <a href="mailto:info@hub-base.co.uk">info@hub-base.co.uk</a> |
                <a href="tel:+441313xxxxxx">+44 (0) 131 XXX XXXX</a>
            </p>

            <div class="social-links">
                <a href="#" title="Facebook">📘</a>
                <a href="#" title="Twitter">🐦</a>
                <a href="#" title="LinkedIn">💼</a>
                <a href="#" title="Instagram">📷</a>
            </div>

            <p style="font-size: 11px; color: #718096; margin-top: 20px;">
                This is an automated confirmation email. Please do not reply directly to this email.
            </p>
        </div>
    </div>
</body>
</html>
