<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
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
            <h1>🔔 New Contact Form Submission</h1>
        </div>

        <div class="content">
            <h2>New Enquiry Received</h2>
            <p>A new contact form submission has been received from your website.</p>

            <table>
                <tr>
                    <td>Name:</td>
                    <td><strong>{{ $submission->name }}</strong></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a></td>
                </tr>
                @if($submission->phone)
                <tr>
                    <td>Phone:</td>
                    <td><a href="tel:{{ $submission->phone }}">{{ $submission->phone }}</a></td>
                </tr>
                @endif
                <tr>
                    <td>Subject:</td>
                    <td>{{ $submission->subject }}</td>
                </tr>
                <tr>
                    <td>Submitted:</td>
                    <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>

            <h3>Message:</h3>
            <div class="message-box">
                {{ $submission->message }}
            </div>

            <center>
                <a href="{{ url('/admin/contact-submissions/' . $submission->id) }}" class="button">
                    View in Admin Panel
                </a>
            </center>

            <div class="metadata">
                <strong>Technical Details:</strong><br>
                IP Address: {{ $submission->ip_address }}<br>
                User Agent: {{ $submission->user_agent }}
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
