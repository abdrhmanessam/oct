<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Memories</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #5d5fef;
            --secondary: #ff6b6b;
            --accent: #feca57;
            --dark: #2c3e50;
            --light: #f8f9fa;
            --success: #1dd1a1;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f7ff;
            color: var(--dark);
            line-height: 1.6;
        }
        
        header {
            background: linear-gradient(135deg, var(--primary), #6c5ce7);
            color: white;
            padding: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        
        header::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        
        header::after {
            content: "";
            position: absolute;
            bottom: -80px;
            left: -30px;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }
        
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
            color: var(--accent);
        }
        
        .tagline {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 5px;
            font-weight: 300;
        }
        
        main {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 2rem;
        }
        
        .page-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .page-title h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        
        .page-title p {
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .page-title::after {
            content: "";
            display: block;
            width: 80px;
            height: 4px;
            background: var(--accent);
            margin: 1.5rem auto;
            border-radius: 2px;
        }
        
        .plans-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .plan-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }
        
        .plan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .plan-header {
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .plan-header::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0));
        }
        
        .basic .plan-header {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }
        
        .premium .plan-header {
            background: linear-gradient(135deg, #a18cd1, #fbc2eb);
        }
        
        .gold .plan-header {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
        }
        
        .plan-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }
        
        .plan-description {
            font-size: 0.9rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }
        
        .plan-body {
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.2rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #555;
            text-align: left;
        }
        
        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }
        
        input:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.2);
            background-color: white;
        }
        
        .btn {
            display: inline-block;
            padding: 14px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            width: 100%;
            text-align: center;
            margin-top: 1rem;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: #4a4cff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(93, 95, 239, 0.3);
        }
        
        .btn-secondary {
            background: var(--secondary);
            color: white;
        }
        
        .ribbon {
            position: absolute;
            top: 15px;
            right: -30px;
            background: var(--accent);
            color: var(--dark);
            padding: 0.3rem 2rem;
            font-size: 0.8rem;
            font-weight: 600;
            transform: rotate(45deg);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        footer {
            text-align: center;
            padding: 2rem;
            background: var(--dark);
            color: white;
            margin-top: 3rem;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .social-links {
            margin-top: 1rem;
        }
        
        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }
        
        .social-links a:hover {
            color: var(--accent);
        }
        
        @media (max-width: 768px) {
            .plans-container {
                grid-template-columns: 1fr;
            }
            
            .header-container {
                flex-direction: column;
                text-align: center;
            }
            
            .logo {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <i class="fas fa-landmark"></i>
                <div>
                    Bank of Memories
                    <div class="tagline">Preserve your precious moments forever</div>
                </div>
            </div>
            <div>
                <a href="#" class="btn btn-secondary" style="width: auto; padding: 10px 20px;">
                    <i class="fas fa-user"></i> My Account
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="page-title">
            <h2>Choose Your Package</h2>
            <p>Select the perfect plan to explore and preserve your cherished memories</p>
        </div>
        
        <div class="plans-container">
            <!-- Basic Plan -->
            <div class="plan-card basic">
                <div class="plan-header">
                    <h3 class="plan-title">Basic Plan</h3>
                    <p class="plan-description">For casual memory explorers</p>
                </div>
                <div class="plan-body">
                    <form action="process_request.php" method="GET">
                        <div class="form-group">
                            <label for="basic-day">Day</label>
                            <input type="number" name="day" id="basic-day" placeholder="Enter day (1-31)" required min="1" max="31">
                        </div>
                        <div class="form-group">
                            <label for="basic-month">Month</label>
                            <input type="number" name="month" id="basic-month" placeholder="Enter month (1-12)" required min="1" max="12">
                        </div>
                        <input type="hidden" name="plan" value="basic">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search Memories
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Premium Plan -->
            <div class="plan-card premium">
                <div class="ribbon">POPULAR</div>
                <div class="plan-header">
                    <h3 class="plan-title">Premium Plan</h3>
                    <p class="plan-description">For serious memory collectors</p>
                </div>
                <div class="plan-body">
                    <form action="process_request.php" method="GET">
                        <div class="form-group">
                            <label for="premium-day">Day</label>
                            <input type="number" name="day" id="premium-day" placeholder="Enter day (1-31)" required min="1" max="31">
                        </div>
                        <div class="form-group">
                            <label for="premium-month">Month</label>
                            <input type="number" name="month" id="premium-month" placeholder="Enter month (1-12)" required min="1" max="12">
                        </div>
                        <div class="form-group">
                            <label for="premium-year">Year</label>
                            <input type="number" name="year" id="premium-year" placeholder="Enter year (1900-2025)" required min="1900" max="2025">
                        </div>
                        <input type="hidden" name="plan" value="premium">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search Memories
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Gold Plan -->
            <div class="plan-card gold">
                <div class="plan-header">
                    <h3 class="plan-title">Gold Plan</h3>
                    <p class="plan-description">For memory connoisseurs</p>
                </div>
                <div class="plan-body">
                    <form action="process_request.php" method="GET">
                        <div class="form-group">
                            <label for="gold-day">Day</label>
                            <input type="number" name="day" id="gold-day" placeholder="Enter day (1-31)" required min="1" max="31">
                        </div>
                        <div class="form-group">
                            <label for="gold-month">Month</label>
                            <input type="number" name="month" id="gold-month" placeholder="Enter month (1-12)" required min="1" max="12">
                        </div>
                        <div class="form-group">
                            <label for="gold-year">Year</label>
                            <input type="number" name="year" id="gold-year" placeholder="Enter year (1900-2025)" required min="1900" max="2025">
                        </div>
                        <div class="form-group">
                            <label for="gold-category">Memory Value</label>
                            <select name="category" id="gold-category">
                                <option value="50">Standard Memories (50 EGP)</option>
                                <option value="100">Precious Memories (100 EGP)</option>
                                <option value="200">Treasure Memories (200 EGP)</option>
                            </select>
                        </div>
                        <input type="hidden" name="plan" value="gold">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search Memories
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2023 Bank of Memories. All rights reserved.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>