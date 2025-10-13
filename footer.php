<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Info</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .footer {
            background: linear-gradient(135deg, #4fa1ed 0%, #3578d2 100%);
            color: white;
            padding: 3em 1em;
            margin-top: 5em;
            border-top: 4px solid #1d75bd;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 200%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: shimmer 3s infinite;
            pointer-events: none;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2em;
            align-items: center;
        }

        .footer-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1em;
            animation: fadeInUp 0.8s ease-out;
        }

        .footer-section:nth-child(1) { animation-delay: 0.1s; }
        .footer-section:nth-child(2) { animation-delay: 0.2s; }
        .footer-section:nth-child(3) { animation-delay: 0.3s; }

        .footer-title {
            font-size: clamp(14px, 3vw, 16px);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5em;
            opacity: 0.95;
        }

        .footer-info {
            display: flex;
            flex-direction: column;
            gap: 0.8em;
            text-align: center;
        }

        .footer-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8em;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .footer-item:hover {
            transform: translateY(-2px);
        }

        .footer-icon {
            font-size: clamp(18px, 3vw, 22px);
            opacity: 0.9;
            transition: all 0.3s ease;
        }

        .footer-item:hover .footer-icon {
            opacity: 1;
            transform: scale(1.1);
        }

        .footer a {
            color: white;
            text-decoration: none;
            font-size: clamp(13px, 2.5vw, 15px);
            transition: all 0.3s ease;
            position: relative;
        }

        .footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: rgba(255,255,255,0.8);
            transition: width 0.3s ease;
        }

        .footer a:hover::after {
            width: 100%;
        }

        .footer p {
            margin: 0;
            font-size: clamp(13px, 2.5vw, 15px);
            opacity: 0.95;
        }

        .footer-divider {
            height: 2px;
            background: rgba(255,255,255,0.2);
            margin: 2em 0;
            grid-column: 1 / -1;
            animation: slideInRight 0.8s ease-out 0.4s both;
        }

        .footer-bottom {
            grid-column: 1 / -1;
            text-align: center;
            font-size: clamp(12px, 2vw, 14px);
            opacity: 0.85;
            animation: fadeIn 0.8s ease-out 0.5s both;
        }

        .footer-bottom p {
            margin: 0.5em 0;
        }

        .social-links {
            display: flex;
            gap: 1em;
            justify-content: center;
            margin-top: 1em;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .social-link:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-3px);
            border-color: rgba(255,255,255,0.6);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                width: 0;
            }
            to {
                width: 100%;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 0.85;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer {
                padding: 2.5em 1em;
                margin-top: 3em;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5em;
            }

            .footer-section {
                align-items: center;
            }

            .footer-divider {
                margin: 1.5em 0;
            }

            .social-links {
                gap: 0.8em;
            }

            .social-link {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .footer {
                padding: 2em 0.8em;
                margin-top: 2em;
                border-top: 3px solid #1d75bd;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.2em;
            }

            .footer-section {
                gap: 0.8em;
            }

            .footer-title {
                font-size: 13px;
                letter-spacing: 0.5px;
            }

            .footer-item {
                gap: 0.6em;
            }

            .footer-icon {
                font-size: 18px;
            }

            .footer a,
            .footer p {
                font-size: 13px;
            }

            .footer-bottom {
                font-size: 12px;
            }

            .social-link {
                width: 34px;
                height: 34px;
                font-size: 14px;
            }

            .social-links {
                gap: 0.6em;
                margin-top: 0.8em;
            }
        }

        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        /* Dark mode support */
        body.dark-mode .footer {
            background: linear-gradient(135deg, #5a5a5a 0%, #4a4a4a 100%);
            border-top-color: #3a3a3a;
        }

    </style>
</head>
<body>

    <div class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-title">📧 Email</div>
                <div class="footer-info">
                    <div class="footer-item">
                        <i class="fas fa-envelope footer-icon"></i>
                        <a href="mailto:cr.aricenttechnologyltd@gmail.com">
                            cr.aricenttechnologyltd@gmail.com
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-section">
                <div class="footer-title">📱 Phone</div>
                <div class="footer-info">
                    <div class="footer-item">
                        <i class="fas fa-phone footer-icon"></i>
                        <a href="tel:+254786718716">+254 786 718 716</a>
                    </div>
                    <div class="footer-item">
                        <i class="fas fa-mobile-alt footer-icon"></i>
                        <a href="tel:+254785599926">+254 785 599 926</a>
                    </div>
                </div>
            </div>

            <div class="footer-section">
                <div class="footer-title">🌐 Connect</div>
                <div class="social-links">
                    <a href="#" class="social-link" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="footer-bottom">
                <p>&copy; 2025 CRAT System. All rights reserved.</p>
                <p>Empowering Your Digital Future</p>
            </div>
        </div>
    </div>

</body>
</html>