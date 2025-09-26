<?php
$folders = array_filter(glob('*'), 'is_dir');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portfolio Gallery</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background: linear-gradient(90deg, #2c3e50 0%, #4a6491 100%);
            color: white;
            padding: 30px 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.8rem;
            margin-bottom: 10px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .tagline {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        main {
            flex: 1;
            padding: 40px 0;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .portfolio-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .portfolio-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .portfolio-card h2 {
            margin: 0;
            padding: 20px;
            font-size: 1.4rem;
            background: linear-gradient(90deg, #3498db 0%, #2c3e50 100%);
            color: white;
            text-align: center;
            font-weight: 600;
        }

        iframe {
            width: 100%;
            height: 300px;
            border: none;
            background-color: #f9f9f9;
        }

        .card-footer {
            padding: 15px 20px;
            display: flex;
            justify-content: center;
            background-color: #f8f9fa;
            border-top: 1px solid #eaeaea;
        }

        .open-button {
            display: inline-block;
            padding: 10px 25px;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            color: white;
            background: linear-gradient(90deg, #3498db 0%, #2980b9 100%);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .open-button:hover {
            background: linear-gradient(90deg, #2980b9 0%, #21618c 100%);
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin: 30px 0;
        }

        .empty-state h2 {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .empty-state p {
            font-size: 1.1rem;
            color: #7f8c8d;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Footer Styles */
        footer {
            background: linear-gradient(90deg, #2c3e50 0%, #34495e 100%);
            color: #ecf0f1;
            padding: 50px 0 20px;
            margin-top: auto;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 1.4rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
            color: #3498db;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: #3498db;
            border-radius: 3px;
        }

        .footer-section p {
            line-height: 1.6;
            margin-bottom: 20px;
            color: #bdc3c7;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
        }

        .footer-links a:hover {
            color: #3498db;
            padding-left: 5px;
        }

        .footer-links a i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: #34495e;
            border-radius: 50%;
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #3498db;
            transform: translateY(-3px);
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
        }

        .contact-item i {
            margin-right: 15px;
            font-size: 1.2rem;
            color: #3498db;
            width: 20px;
            text-align: center;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #34495e;
            color: #95a5a6;
            font-size: 0.9rem;
        }

        .footer-bottom a {
            color: #3498db;
            text-decoration: none;
        }

        .footer-bottom a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.2rem;
            }
            
            .portfolio-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>🎨 Ctrl+Z Not Needed — I'm That Good</h1>
            <p class="tagline">A collection of my creative works and projects. Each piece tells a story of precision, creativity, and technical excellence.</p>
        </div>
    </header>

    <main>
        <div class="container">
            <?php if (empty($folders)): ?>
                <div class="empty-state">
                    <h2>No Portfolios Found</h2>
                    <p>It looks like there are no portfolio folders in the current directory. Please check back later or contact the administrator.</p>
                </div>
            <?php else: ?>
                <div class="portfolio-grid">
                    <?php foreach ($folders as $folder): ?>
                        <?php if (file_exists("$folder/index.html")): ?>
                            <div class="portfolio-card">
                                <h2><?= strtoupper(htmlspecialchars($folder)) ?></h2>
                                <iframe src="<?= $folder ?>/index.html" title="<?= htmlspecialchars($folder) ?> Portfolio"></iframe>
                                <div class="card-footer">
                                    <a class="open-button" href="<?= $folder ?>/index.html" target="_blank">
                                        <i class="fas fa-external-link-alt"></i> Open in New Tab
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About This Gallery</h3>
                    <p>This portfolio gallery showcases a selection of my best work. Each project represents hours of dedication, creativity, and technical expertise.</p>
                    <p>I believe in creating digital experiences that are not only visually appealing but also functional and user-friendly.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> About Me</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Services</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Contact</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Blog</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact Information</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Creative Street, Design City</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+1 (555) 123-4567</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>hello@portfolio.com</span>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2023 Portfolio Gallery. All rights reserved. | Designed with <i class="fas fa-heart" style="color: #e74c3c;"></i> by a passionate developer</p>
            </div>
        </div>
    </footer>
</body>
</html>