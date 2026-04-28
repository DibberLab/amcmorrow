<?php
$pageTitle = "Andrew McMorrow - Digital Marketing & E-commerce Portfolio";
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
            margin-bottom: 20px;
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
        
        /* Hero Section */
        .hero {
            padding: 100px 0;
            background-color: #e9f0f7;
            text-align: center;
        }
        
        .hero h1 {
            font-size: 42px;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 18px;
            max-width: 800px;
            margin: 0 auto 30px;
        }
        
        .cta-button {
            display: inline-block;
            background-color: #0066cc;
            color: #fff;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .cta-button:hover {
            background-color: #004080;
            color: #fff;
        }
        
        /* About Section */
        .about {
            padding: 80px 0;
            background-color: #fff;
        }
        
        /* Work Experience Section */
        .work-experience {
            padding: 80px 0;
            background-color: #f9f9f9;
        }
        
        .work-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .work-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .work-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
        
        .work-card-image {
            height: 200px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #555;
        }
        
        .work-card-content {
            padding: 20px;
        }
        
        .work-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        .work-card p {
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        .tag {
            display: inline-block;
            background-color: #e9f0f7;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            margin-right: 5px;
            margin-bottom: 5px;
            color: #0066cc;
        }
        
        /* Projects Section */
        .projects {
            padding: 80px 0;
            background-color: #fff;
        }
        
        /* Contact Section */
        .contact {
            padding: 80px 0;
            background-color: #e9f0f7;
            text-align: center;
        }
        
        .contact-info {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 40px;
        }
        
        .contact-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .contact-icon {
            width: 60px;
            height: 60px;
            background-color: #0066cc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            color: #fff;
            font-size: 24px;
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
            
            .hero h1 {
                font-size: 32px;
            }
            
            .hero p {
                font-size: 16px;
            }
            
            .work-grid {
                grid-template-columns: 1fr;
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
                    <li><a href="#about">About</a></li>
                    <li><a href="#work">Work Experience</a></li>
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="/resume">Resume</a></li>
                </ul>
                <div class="hamburger">
                    <span>☰</span>
                </div>
            </nav>
        </div>
    </header>
    
    <section class="hero">
        <div class="container">
            <h1>Digital Marketing & E-commerce Strategist</h1>
            <p>With over a decade of experience driving digital success through strategic marketing, UX design, and e-commerce optimization</p>
            <a href="#contact" class="cta-button">Get In Touch</a>
        </div>
    </section>
    
    <section id="about" class="about">
        <div class="container">
            <h2>A bit of background...</h2>
            <p>With over a decade of experience in digital marketing and e-commerce, I have had the privilege of leading digital marketing efforts for multiple companies. My expertise lies in overseeing campaigns, schedules, and website maintenance while utilizing my skills in UX design, database management, and ad set supervision to drive e-commerce success. Throughout my career, I have demonstrated a strong ability to lead and manage digital marketing and e-commerce operations at a strategic level, focusing on optimizing campaigns, enhancing user experiences, and leveraging data-driven insights to deliver measurable results.</p>
            
            <p>My passion for innovation, coupled with my deep understanding of the ever-evolving digital landscape, enables me to develop and execute effective strategies that drive growth and profitability. I take pride in my ability to collaborate with cross-functional teams, bringing a strategic vision and hands-on approach to every project I undertake. As I continue to grow and evolve in my career, I remain dedicated to leveraging my expertise to help businesses thrive in the digital age, confident in my ability to make a significant impact in the field of digital marketing and e-commerce.</p>
        </div>
    </section>
    
    <section id="work" class="work-experience">
        <div class="container">
            <h2>Full Time Work</h2>
            <div class="work-grid">
                <div class="work-card">
                    <a href="https://revobrands.com" target="_blank">
                        <div class="work-card-image" style="background-image: url('https://amcmorrow.com/logo/revobrands-logo.png'); background-size:contain;"></div>
                        <div class="work-card-content">
                            <h3>Revo Brands</h3>
                            <div>
                                <span class="tag">Web Design</span>
                                <span class="tag">UX Design</span>
                            </div>
                            <p>Revo Brands ignites growth in enthusiast and mission critical brands through superior innovation, design and marketing. We go to market through our brands Real Avid and Outdoor Edge.</p>
                        </div>
                    </a>
                </div>
                
                <div class="work-card">
                    <a href="https://realavid.com" target="_blank">
                    <div class="work-card-image" style="background-image: url('https://amcmorrow.com/logo/realavid-logo.png'); background-size:contain;"></div>
                    <div class="work-card-content">
                        <h3>Real Avid</h3>
                        <div>
                            <span class="tag">SEO</span>
                            <span class="tag">UX Design</span>
                            <span class="tag">Email Marketing</span>
                        </div>
                        <p>Real innovation and smart design have made Real Avid the go-to brand for Gun DIY® consumers. From Master Grade® tools to High Performance Gun CleaningTM and the world's leading line of multi-tools for guns, Real Avid sets the high bar for real world performance.</p>
                    </div>
                    </a>
                </div>
                
                <div class="work-card">
                    <a href="https://ouutdooredge.com" target="_blank">
                    <div class="work-card-image" style="background-image: url('https://amcmorrow.com/logo/outdooredge-logo.png'); background-size:contain;"></div>
                    <div class="work-card-content">
                        <h3>Outdoor Edge</h3>
                        <div>
                            <span class="tag">UX Design</span>
                            <span class="tag">SEO</span>
                            <span class="tag">Email Marketing</span>
                        </div>
                        <p>Outdoor Edge is a leading knife and tool brand that develops and uses innovative technology to create highly functional knives for hunters, fishers, outdoor enthusiasts, tradesmen and everyday carry. Their patented RazorSafeTM Blade System leads the industry in replaceable blade knives.</p>
                    </div>
                    </a>
                </div>
                
                <div class="work-card">
                    <a href="https://workiqtools.com" target="_blank">
                    <div class="work-card-image" style="background-image: url('https://amcmorrow.com/logo/workiqtools-logo.png'); background-size:contain;"></div>
                    <div class="work-card-content">
                        <h3>WorkIQ Tools</h3>
                        <div>
                            <span class="tag">Brand Development</span>
                            <span class="tag">Web Design</span>
                            <span class="tag">SEO</span>
                            <span class="tag">Email Marketing</span>
                        </div>
                        <p>The world's smartest bench vise system is transforming the way DIYers, craftsmen, hobbyists, makers, and pros work. The IQ Vise System's three parts combine to help you solve problems.</p>
                    </div>
                    </a>
                </div>
                
                <div class="work-card">
                    <a href="https://dakotastones.com" target="_blank">
                    <div class="work-card-image" style="background-image: url('https://amcmorrow.com/logo/dakotastones-logo.png'); background-size:contain;"></div>
                    <div class="work-card-content">
                        <h3>Dakota Stones</h3>
                        <div>
                            <span class="tag">ERP</span>
                            <span class="tag">Web Development</span>
                            <span class="tag">Email Marketing</span>
                        </div>
                        <p>Dakota Stones manufactures the only branded line of gemstone beads in the world.</p>
                    </div>
                    </a>
                </div>
                
                <div class="work-card">
                    <a href="https://goodybeads.com" target="_blank">
                    <div class="work-card-image" style="background-image: url('https://amcmorrow.com/logo/goodybeads-logo.png'); background-size:contain;"></div>
                    <div class="work-card-content">
                        <h3>Goody Beads</h3>
                        <div>
                            <span class="tag">Database Management</span>
                            <span class="tag">Web Design</span>
                            <span class="tag">Email Marketing</span>
                        </div>
                        <p>At GoodyBeads, our mission is to bring you the latest jewelry-making trends. With over 20 years of experience, our staff has a great eye to keep you in the loop and make your projects shine.</p>
                    </div>
                    </a>
                </div>
                
                <div class="work-card">
                    <a href="https://ticasino.com" target="_blank">
                    <div class="work-card-image" style="background-image: url('https://amcmorrow.com/logo/ticasino-logo.png'); background-size:contain;"></div>
                    <div class="work-card-content">
                        <h3>Treasure Island Casino</h3>
                        <div>
                            <span class="tag">Email Marketing</span>
                            <span class="tag">Video Graphics</span>
                            <span class="tag">SEO</span>
                        </div>
                        <p>Located along the Mississippi River, our breath-taking casino resort boasts fine and casual dining options, a full-service salon and spa, a family friendly water park, bowling alley, an event center and live entertainment venues including an outdoor amphitheater.</p>
                    </div>
                    </a>
                </div>
                
                <div class="work-card">
                    <a href="https://ainsleyshea.com" target="_blank">
                    <div class="work-card-image" style="background-image: url('https://amcmorrow.com/logo/ainsleyshea-logo.png'); background-size:contain;"></div>
                    <div class="work-card-content">
                        <h3>Ainsley Shea</h3>
                        <div>
                            <span class="tag">Web Design</span>
                            <span class="tag">Brand Development</span>
                        </div>
                        <p>Our method is a bit different. We don't want to throw tactics at you. We sit down with a white board with your key people and get everyone to understand the story.</p>
                    </div>
                    </a>                
                </div>
            </div>
        </div>
    </section>
    
    <section id="projects" class="projects">
        <div class="container">
            <h2>Personal & Client Projects</h2>
            <div class="work-grid">
                <div class="work-card">
                    <a href="https://epicebikeadventures.com" target="_blank">
                    <div class="work-card-image">Epic Ebike Adventures</div>
                    <div class="work-card-content">
                        <h3>Epic Ebike Adventures Website</h3></a>
                        <p>A Shopify site for an ebike rental business in Las Vegas was successfully set up. The process involved choosing the right theme, customizing it to align with the brand, and adding all the necessary products, pages and features such as payment and shipping options, to ensure a seamless customer experience.</p>
                    </div>
                </div>
                
                <div class="work-card">
                    <div class="work-card-image">Brisk Services</div>
                    <div class="work-card-content">
                        <h3>Brisk Services Website</h3>
                        <p>A successful WordPress website was crafted for a client by following a series of key steps. The foundation was laid by setting up a hosting account and installing WordPress, then selecting the perfect theme from a wide range of options. Customizing the theme with the theme editor or custom CSS brought the vision to life.</p>
                    </div>
                </div>
                
                <div class="work-card">
                    <div class="work-card-image">Driftless Camp</div>
                    <div class="work-card-content">
                        <h3>Driftless Camp Website</h3>
                        <p>Crafting a successful WordPress website for a client involved several essential steps. The process started with setting up a hosting account and installing WordPress, followed by choosing the ideal theme from a vast collection of options. Customization, page and post creation, plugin integration, and menu organization resulted in a fully functional website.</p>
                    </div>
                </div>
                
                <div class="work-card">
                    <div class="work-card-image">Bellflower Bodywork</div>
                    <div class="work-card-content">
                        <h3>Bellflower Bodywork Website</h3>
                        <p>The process of developing a massage therapy website for a client was a well-planned and executed project. Every step was taken to ensure the website was not only functional but also visually appealing to visitors. Despite the setback, I remain committed to working with the client to find a solution to bring the site back online in the future.</p>
                    </div>
                </div>
                
                <div class="work-card">
                    <div class="work-card-image">Focused Fire</div>
                    <div class="work-card-content">
                        <h3>Focused Fire Website</h3>
                        <p>A hosting account was set up and WordPress was installed, followed by choosing a fitting theme from the vast collection available. The chosen theme was then customized using the theme editor or custom CSS to bring the client's vision to life. The end result was a well-rounded and functional website that accurately reflected the client's laser engraving business.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="contact" class="contact">
        <div class="container">
            <h2>Contact</h2>
            <p>Do you have any questions? Please do not hesitate to contact me directly. I will get back to you within a matter of hours to help.</p>
            
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon">✉</div>
                    <h3>Email</h3>
                    <a href="mailto:amcmorrow84@proton.me">amcmorrow84@proton.me</a>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">📱</div>
                    <h3>Phone</h3>
                    <a href="tel:6123848959">612-384-8959</a>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">in</div>
                    <h3>LinkedIn</h3>
                    <a href="https://www.linkedin.com/in/andrew-mcmorrow/" target="_blank">Andrew McMorrow</a>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <p>© <?php echo date('Y'); ?> Andrew McMorrow. All rights reserved.</p>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/andrew-mcmorrow/" class="social-link">in</a>
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
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 70,
                            behavior: 'smooth'
                        });
                        
                        // Close mobile menu if open
                        navLinks.classList.remove('active');
                    }
                });
            });
        });
    </script>
</body>
</html>