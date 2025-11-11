<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Activity Registration</title>
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
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .content h2 {
            color: #e83068;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        table td:first-child {
            font-weight: bold;
            color: #666;
            width: 140px;
        }
        .message-box {
            background: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #e83068;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #e83068;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            background: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .metadata {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 New Activity Registration</h1>
        </div>

        <div class="content">
            <h2>New Registration Received</h2>
            <p>A new activity registration has been received from your website.</p>

            <table>
                <tr>
                    <td>Participant:</td>
                    <td><strong>{{ $submission->name }}</strong></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a></td>
                </tr>
                <tr>
                    <td>Registered:</td>
                    <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>

            <h3>Registration Details:</h3>
            <div class="message-box">
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

                <h4 style="margin-top: 0; color: #666;">Activity Details:</h4>
                <table style="width: 100%; margin-bottom: 20px;">
                    @if(isset($details['Activity']))
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold; width: 120px;">Activity:</td>
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

                <h4 style="margin-top: 20px; color: #666;">Registrant Details:</h4>
                <table style="width: 100%;">
                    @if(isset($details['Name']))
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold; width: 120px;">Name:</td>
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
            </div>

            <center>
                <a href="{{ url('/admin/contact-submissions/' . $submission->id) }}" class="button">
                    View in Admin Panel
                </a>
            </center>

            <div class="metadata">
                <strong>Technical Details:</strong><br>
                IP Address: {{ $submission->ip_address }}
            </div>
        </div>

        <div class="footer">
            <p><strong>Edinburgh College BASE</strong><br>
            Business Advice and Support for Entrepreneurs<br>
            Bankhead Avenue, Sighthill, Edinburgh, EH11 4DE</p>
        </div>
    </div>
</body>
</html>
