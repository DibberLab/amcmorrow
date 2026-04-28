<?php
$pageTitle = "Andrew McMorrow - Resume";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        h1, h2, h3, h4 {
            margin-bottom: 0px;
            color: #222;
        }
        
        p {
            margin-bottom: 20px;
        }
        
        a {
            color: #0066cc;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        a:hover {
            color: #004080;
        }
        
        /* Header Styles */
        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 30px;
        }
        
        /* Mobile Nav */
        .hamburger {
            display: none;
            cursor: pointer;
        }
        
        /* Resume Section */
        .resume-section {
            padding: 80px 0;
            background-color: #fff;
        }
        
        .resume-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .resume-header {
            margin-bottom: 30px;
        }
        
        .resume-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .contact-info {
            font-size: 16px;
            margin-bottom: 30px;
        }
        
        .resume-section-title {
            font-size: 24px;
            border-bottom: 2px solid #e9f0f7;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #0066cc;
        }
        
        .resume-section-content {
            margin-bottom: 40px;
        }
        
        .job-title {
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .company {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: -5px;
        }
        
        .job-period {
            font-size: 16px;
            color: #666;
            margin-bottom: 15px;
        }

        .job-summary {
            font-style: italic;
            color: #555;
            margin-bottom: 15px;
        }
        
        ul {
            list-style-type: disc;
            padding-left: 20px;
            margin-bottom: 20px;
        }
        
        ul li {
            margin-bottom: 8px;
        }
        
        /* Download Section */
        .download-section {
            margin-bottom: 30px;
        }
        
        .download-btn {
            display: inline-block;
            padding: 8px 15px;
            margin-right: 10px;
            background-color: #0066cc;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .download-btn:hover {
            background-color: #004080;
            color: white;
        }
        
        /* Footer */
        footer {
            background-color: #222;
            color: #fff;
            padding: 40px 0;
            text-align: center;
        }
        
        .footer-content {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .social-link {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #333;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin: 0 10px;
            transition: background-color 0.3s;
        }
        
        .social-link:hover {
            background-color: #0066cc;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }
            
            .nav-links {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 70px);
                background-color: #fff;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                transition: left 0.3s;
            }
            
            .nav-links.active {
                left: 0;
            }
            
            .nav-links li {
                margin: 15px 0;
            }
            
            .resume-container {
                padding: 20px;
            }
            
            .resume-header h1 {
                font-size: 28px;
            }
            
            .resume-section-title {
                font-size: 22px;
            }
            
            .job-title, .company {
                font-size: 18px;
            }
            
            .download-section {
                text-align: center;
            }
            
            .download-btn {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">Andrew McMorrow</div>
                <ul class="nav-links">
                    <li><a href="https://amcmorrow.com#about">About</a></li>
                    <li><a href="https://amcmorrow.com#experience">Work Experience</a></li>
                    <li><a href="https://amcmorrow.com#projects">Projects</a></li>
                    <li><a href="https://amcmorrow.com#contact">Contact</a></li>
                </ul>
                <div class="hamburger">
                    <span>☰</span>
                </div>
            </nav>
        </div>
    </header>
    
    <section class="resume-section">
        <div class="container">
            <div class="download-section">
                <h2>Download Resume</h2>
                <a href="docs/Andrew%20McMorrow.pdf" class="download-btn">PDF</a>
                <a href="docs/Andrew%20McMorrow.docx" class="download-btn">DOC</a>
                <a href="docs/Andrew%20McMorrow.txt" class="download-btn">TXT</a>
            </div>
            
            <div class="resume-container">
                <div class="resume-header">
                    <h1>Andrew McMorrow</h1>
                    <div class="contact-info">
                        Minneapolis, MN | <a href="mailto:amcmorrow84@proton.me">amcmorrow84@proton.me</a> | <a href="tel:+16123848959">612-384-8959</a> | <a href="http://amcmorrow.com" target="_blank">amcmorrow.com</a>
                    </div>
                </div>
                
                <div class="resume-section-content">
                    <h2 class="resume-section-title">Professional Summary</h2>
                    <p>
                        A results-driven ecommerce leader with over 10 years of experience architecting D2C strategy and executing technical solutions that drive measurable revenue growth. Proven expertise in optimizing the entire digital ecosystem, from complex website migrations and marketing automation to data analysis and user experience. Adept at leading cross-functional teams and leveraging data-driven insights to surpass ambitious business goals.
                    </p>
                </div>
                
                <div class="resume-section-content">
                    <h2 class="resume-section-title">Core Competencies</h2>
                    <h3>Ecommerce & Strategy</h3>
                    <p>D2C Strategy & Execution, Ecommerce Optimization, Website Migration, UX/UI Design & Accessibility, Workflow Automation</p>
                    <h3>Marketing & Analytics</h3>
                    <p>Email Marketing & Automation, Performance Analytics, SEO/SEM/PPC Campaigns, A/B Testing, Conversion Rate Optimization, Content Marketing</p>
                    <h3>Technical Proficiencies</h3>
                    <p>Shopify, Klaviyo, Google Analytics, Looker, HTML, CSS, JavaScript, SQL, Bright Pearl, Meta Ads, AI Models (ChatGPT, Claude, Gemini APIs)</p>
                </div>
                
                <div class="resume-section-content">
                    <h2 class="resume-section-title">Professional Experience</h2>
                    
                    <div class="job">
                        <h3 class="company">Revo Brands - Maple Grove, MN</h3>
                        <div class="job-title">Senior Ecommerce & Digital Strategy Manager</div>
                        <div class="job-period">Oct 2021 - Present</div>
                        <p class="job-summary">Directed the comprehensive digital strategy for D2C and B2B ecommerce channels, leading a cross-functional team to enhance digital presence, optimize user experience, and drive revenue growth through data-driven initiatives.</p>
                        <ul>
                            <li>Spearheaded ecommerce strategies across three brands, optimizing websites and wholesale dealer portals to achieve a <strong>20% increase</strong> in online sales revenue.</li>
                            <li>Led the D2C strategy, overseeing website content, product merchandising, and promotional campaigns on Shopify to drive sales and enhance customer loyalty.</li>
                            <li>Implemented Klaviyo for automated email marketing, developing welcome, abandoned cart, and winback flows that improved engagement and resulted in a <strong>25% increase</strong> in email-driven revenue.</li>
                            <li>Conducted in-depth data analysis on sales, customer behavior, and site traffic, generating actionable insights that drove a <strong>15% improvement</strong> in conversion rates.</li>
                            <li>Orchestrated the multi-brand digital marketing calendar for product launches and campaigns, using ClickUp to streamline collaboration with creative and brand leadership.</li>
                            <li>Enhanced product discoverability by <strong>30%</strong> by designing and optimizing product listings and keywords.</li>
                            <li>Led accessibility compliance efforts to ensure all digital platforms met WCAG standards, enhancing inclusivity.</li>
                        </ul>
                    </div>
                    
                    <div class="job">
                        <h3 class="company">Dakota Stones - Edina, MN</h3>
                        <div class="job-title">Director of Ecommerce & Technology</div>
                        <div class="job-period">April 2007 - Oct 2021</div>
                        <p class="job-summary">Served as the lead data strategist and technical director, culminating in a leadership position overseeing all ecommerce operations, digital marketing, and IT infrastructure for multiple brand websites.</p>
                        <ul>
                            <li>Directed a complex, dual-system migration of ERP from Intuit POS to Bright Pearl and the company website to Shopify, ensuring <strong>100% data accuracy</strong> during the transition.</li>
                            <li>Successfully re-platformed Dakotastones.com to Shopify, which boosted online sales by <strong>18%</strong> through improved site responsiveness and usability.</li>
                            <li>Increased operational efficiency by <strong>20%</strong> by managing and optimizing physical inventory processes and streamlining product listings.</li>
                            <li>Engineered custom HTML, CSS, and JavaScript features to enhance Shopify theme functionality and user experience.</li>
                            <li>Grew website traffic by <strong>15%</strong> by creating and executing weekly email campaigns and blog content.</li>
                        </ul>
                    </div>
                    
                    <div class="job">
                        <h3 class="company">Treasure Island Casino - Welch, MN</h3>
                        <div class="job-title">Digital Marketing Strategist</div>
                        <div class="job-period">July 2015 - June 2018</div>
                        <p class="job-summary">Developed and executed integrated digital marketing strategies for a premier resort and casino, managing the online presence for the main casino and its associated brands, including a golf course and community website.</p>
                        <ul>
                            <li>Designed and launched TICasino.com, incorporating SEO best practices that resulted in a <strong>40% increase</strong> in organic traffic.</li>
                            <li>Managed multi-channel digital marketing campaigns (SEM, PPC, display ads), achieving a <strong>25% growth</strong> in customer acquisition.</li>
                            <li>Increased video engagement rates on social media by <strong>30%</strong> through strategic content editing and campaign deployment.</li>
                            <li>Developed and coded the Mount Frontenac Golf Course website to improve site usability and user satisfaction.</li>
                        </ul>
                    </div>
                </div>
                
                <div class="resume-section-content">
                    <h2 class="resume-section-title">Education</h2>
                    <div class="education">
                        <h3 class="company">Brown College - Mendota Heights, MN</h3>
                        <div class="job-period">April 2006</div>
                        <p><strong>Associate of Arts in Visual Communications with Emphasis on Multi-Media</strong></p>
                        <ul>
                            <li>Relevant Coursework: Ecommerce Fundamentals, Digital Marketing, Email Marketing Automation, and Conversion Optimization.</li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <p>© <?php echo date('Y'); ?> Andrew McMorrow. All rights reserved.</p>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/andrew-mcmorrow/" target="_blank" class="social-link">in</a>
                    <a href="mailto:amcmorrow84@proton.me" class="social-link">✉</a>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Navigation
            const hamburger = document.querySelector('.hamburger');
            const navLinks = document.querySelector('.nav-links');
            
            hamburger.addEventListener('click', function() {
                navLinks.classList.toggle('active');
            });
        });
    </script>
</body>
</html>