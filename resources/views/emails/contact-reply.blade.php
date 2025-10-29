<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response from Centrum Optimi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #D4AF37 0%, #C5A028 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .email-header img {
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
        }
        .email-header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }
        .email-body {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333333;
            margin-bottom: 20px;
        }
        .intro-text {
            color: #555555;
            margin-bottom: 25px;
            font-size: 15px;
        }
        .original-message-section {
            background-color: #f9f9f9;
            border-left: 4px solid #D4AF37;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .original-message-section h3 {
            color: #333333;
            font-size: 14px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .original-message-content {
            color: #666666;
            font-size: 14px;
            line-height: 1.8;
            font-style: italic;
        }
        .admin-reply-section {
            margin: 30px 0;
        }
        .admin-reply-section h3 {
            color: #D4AF37;
            font-size: 16px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .admin-reply-content {
            color: #333333;
            font-size: 15px;
            line-height: 1.8;
            white-space: pre-wrap;
        }
        .signature {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 2px solid #eeeeee;
            color: #666666;
            font-size: 14px;
        }
        .signature strong {
            color: #D4AF37;
            display: block;
            margin-bottom: 5px;
        }
        .email-footer {
            background-color: #2c3e50;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .contact-info {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .contact-info p {
            margin: 5px 0;
            color: #ecf0f1;
        }
        .contact-info a {
            color: #D4AF37;
            text-decoration: none;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #D4AF37;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }
        .social-links a:hover {
            color: #ffffff;
        }
        .copyright {
            margin-top: 20px;
            font-size: 12px;
            color: #95a5a6;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #dddddd, transparent);
            margin: 25px 0;
        }
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
            .email-header, .email-body, .email-footer {
                padding: 20px 15px;
            }
            .email-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <img src="{{ asset('logos/logo.jpeg') }}" alt="Centrum Optimi Logo">
            <h1>Response to Your Message</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="greeting">
                Hello {{ $contact->name }},
            </div>

            <div class="intro-text">
                Thank you for reaching out to Centrum Optimi Educational Development Organization. We have received your message and are pleased to provide you with the following response:
            </div>

            <div class="divider"></div>

            <!-- Admin Reply (Most Important - Shown First) -->
            <div class="admin-reply-section">
                <h3>Our Response:</h3>
                <div class="admin-reply-content">{{ $contact->admin_reply }}</div>
            </div>

            <div class="divider"></div>

            <!-- Original Message Reference -->
            <div class="original-message-section">
                <h3>Your Original Message:</h3>
                <div class="original-message-content">
                    <strong>Subject:</strong> {{ $contact->subject }}<br>
                    <strong>Sent:</strong> {{ $contact->created_at->format('F j, Y, g:i a') }}<br><br>
                    {{ $contact->message }}
                </div>
            </div>

            <!-- Signature -->
            <div class="signature">
                <strong>Best regards,</strong>
                <p>The Centrum Optimi Team</p>
                <p style="font-size: 13px; color: #999999; margin-top: 10px;">
                    Empowering Communities Through Education
                </p>
            </div>

            <div style="margin-top: 30px; padding: 15px; background-color: #fffbf0; border-radius: 4px; border: 1px solid #f0e6c8;">
                <p style="font-size: 13px; color: #666666; margin: 0;">
                    <strong>Need further assistance?</strong> Feel free to reply directly to this email or contact us using the information below.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <div class="contact-info">
                <p><strong style="color: #D4AF37;">Centrum Optimi Educational Development Organization</strong></p>
                <p>📧 Email: <a href="mailto:info@centrumoptimi.org">info@centrumoptimi.org</a></p>
                <p>📞 Phone: <a href="tel:+2348012345678">+234 801 234 5678</a></p>
                <p>🌐 Website: <a href="https://centrumoptimi.org">www.centrumoptimi.org</a></p>
            </div>

            <div style="height: 1px; background-color: #34495e; margin: 20px 0;"></div>

            <div class="social-links">
                <a href="#">Facebook</a> |
                <a href="#">Twitter</a> |
                <a href="#">Instagram</a> |
                <a href="#">LinkedIn</a>
            </div>

            <div class="copyright">
                &copy; {{ date('Y') }} Centrum Optimi Educational Development Organization. All rights reserved.
            </div>

            <div style="margin-top: 15px; font-size: 11px; color: #7f8c8d;">
                You received this email because you contacted us through our website.
            </div>
        </div>
    </div>
</body>
</html>
