<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Account Created</title>
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
            max-width: 120px;
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
        .credentials-box {
            background-color: #f9f9f9;
            border-left: 4px solid #D4AF37;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .credentials-box h3 {
            color: #D4AF37;
            font-size: 16px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .credential-item {
            margin: 12px 0;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
        }
        .credential-label {
            color: #666666;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .credential-value {
            color: #333333;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Courier New', monospace;
        }
        .role-badge {
            display: inline-block;
            padding: 8px 16px;
            background-color: #D4AF37;
            color: #ffffff;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin: 15px 0;
        }
        .login-button {
            display: inline-block;
            padding: 14px 32px;
            background-color: #D4AF37;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
        }
        .login-button:hover {
            background-color: #C5A028;
        }
        .info-box {
            background-color: #fffbf0;
            border: 1px solid #f0e6c8;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
        }
        .info-box p {
            font-size: 13px;
            color: #666666;
            margin: 0;
        }
        .warning-box {
            background-color: #fff4e5;
            border: 1px solid #ffe0b2;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
        }
        .warning-box p {
            font-size: 13px;
            color: #e65100;
            margin: 0;
        }
        .features-list {
            margin: 20px 0;
            padding-left: 0;
            list-style: none;
        }
        .features-list li {
            padding: 8px 0 8px 30px;
            position: relative;
            color: #555555;
            font-size: 14px;
        }
        .features-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #D4AF37;
            font-weight: bold;
            font-size: 18px;
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
            <h1>Welcome to the Admin Team!</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="greeting">
                Hello {{ $user->name }},
            </div>

            <div class="intro-text">
                We're excited to inform you that an administrator account has been created for you at Centrum Optimi Educational Foundation. You now have access to our content management system.
            </div>

            <!-- Role Badge -->
            <div style="text-align: center;">
                <span class="role-badge">
                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                </span>
            </div>

            <div class="divider"></div>

            <!-- Login Credentials -->
            <div class="credentials-box">
                <h3>Your Login Credentials</h3>
                
                <div class="credential-item">
                    <div class="credential-label">Email Address</div>
                    <div class="credential-value">{{ $user->email }}</div>
                </div>
                
                <div class="credential-item">
                    <div class="credential-label">Temporary Password</div>
                    <div class="credential-value">{{ $password }}</div>
                </div>
            </div>

            <!-- Warning Box -->
            <div class="warning-box">
                <p><strong>⚠️ Important Security Notice:</strong> Please change your password immediately after your first login. This temporary password will be shown only once in this email.</p>
            </div>

            <!-- Login Button -->
            <div style="text-align: center;">
                <a href="{{ route('admin.login') }}" class="login-button">
                    Login to Admin Dashboard
                </a>
            </div>

            <div class="divider"></div>

            <!-- Access Information Based on Role -->
            <h3 style="color: #333333; font-size: 16px; margin-bottom: 15px;">Your Access Level</h3>
            
            @if($user->role === 'super_admin')
            <p style="color: #555555; margin-bottom: 15px;">As a <strong>Super Administrator</strong>, you have full access to:</p>
            <ul class="features-list">
                <li>Manage all users and administrators</li>
                <li>Create, edit, and delete all content</li>
                <li>Manage posts, programs, and gallery items</li>
                <li>View and respond to contact messages</li>
                <li>Manage donations and volunteers</li>
                <li>Access all system settings</li>
                <li>Full administrative control</li>
            </ul>
            @elseif($user->role === 'admin')
            <p style="color: #555555; margin-bottom: 15px;">As an <strong>Administrator</strong>, you have access to:</p>
            <ul class="features-list">
                <li>Create, edit, and delete content</li>
                <li>Manage posts, programs, and gallery items</li>
                <li>View and respond to contact messages</li>
                <li>Manage donations and volunteers</li>
                <li>Access most administrative features</li>
            </ul>
            @else
            <p style="color: #555555; margin-bottom: 15px;">As a <strong>Content Editor</strong>, you can:</p>
            <ul class="features-list">
                <li>Create and edit blog posts</li>
                <li>Manage programs and initiatives</li>
                <li>Upload and organize gallery images</li>
                <li>Update content across the website</li>
            </ul>
            @endif

            <div class="divider"></div>

            <!-- Info Box -->
            <div class="info-box">
                <p><strong>Need Help?</strong> If you have any questions or need assistance, please don't hesitate to contact the system administrator or reply to this email.</p>
            </div>

            <!-- Signature -->
            <div class="signature">
                <strong>Best regards,</strong>
                <p>The Centrum Optimi Admin Team</p>
                <p style="font-size: 13px; color: #999999; margin-top: 10px;">
                    Empowering Communities Through Education
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

            <div class="copyright">
                &copy; {{ date('Y') }} Centrum Optimi Educational Development Organization. All rights reserved.
            </div>

            <div style="margin-top: 15px; font-size: 11px; color: #7f8c8d;">
                You received this email because an administrator account was created for you.
            </div>
        </div>
    </div>
</body>
</html>
