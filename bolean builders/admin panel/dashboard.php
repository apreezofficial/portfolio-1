<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar h2 {
            color: #3498db;
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar nav a {
            display: block;
            padding: 12px;
            color: white;
            text-decoration: none;
            margin: 8px 0;
            border-radius: 4px;
            transition: background 0.3s, transform 0.2s;
        }
        .sidebar nav a:hover {
            background-color: #34495e;
            transform: translateX(5px);
        }
        .main-content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 20px;
        }
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 15px;
            text-align: right;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .logout-btn {
            background-color: #e74c3c;
            border: none;
            padding: 10px 15px;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            transition: background 0.3s;
        }
        .logout-btn:hover {
            background-color: #c0392b;
        }
        .section {
            display: none;
        }
        .active {
            display: block;
        }
        .portfolio-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .portfolio-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .portfolio-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .portfolio-item-content {
            padding: 15px;
        }
        .portfolio-item h3 {
            margin: 0;
            color: #2c3e50;
        }
        .portfolio-item p {
            color: #7f8c8d;
            font-size: 14px;
            margin: 10px 0;
        }
        .portfolio-item-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .portfolio-item-actions button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .portfolio-item-actions .edit-btn {
            background-color: #3498db;
            color: white;
        }
        .portfolio-item-actions .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        .portfolio-item-actions button:hover {
            opacity: 0.9;
        }
        .add-portfolio-btn {
            background-color: #2ecc71;
            border: none;
            padding: 10px 15px;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            margin-bottom: 20px;
            transition: background 0.3s;
        }
        .add-portfolio-btn:hover {
            background-color: #27ae60;
        }

        /* Dashboard Styles */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .stat-card h3 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.5rem;
        }
        .stat-card p {
            color: #7f8c8d;
            font-size: 14px;
            margin: 10px 0 0;
        }
        .stat-card .icon {
            font-size: 2rem;
            color: #3498db;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <nav>
            <a href="#" onclick="showSection('dashboard')">Dashboard</a>
            <a href="#" onclick="showSection('users')">Users</a>
            <a href="#" onclick="showSection('services')">Services</a>
            <a href="portfolio.php" onclick="showSection('portfolio')">Portfolio</a>
            <a href="#" onclick="showSection('testimonials')">Testimonials</a>
            <a href="#" onclick="showSection('pricing')">Pricing</a>
            <a href="#" onclick="showSection('messages')">Messages</a>
            <a href="#" onclick="showSection('settings')">Settings</a>
        </nav>
    </div>
    <div class="main-content">
        <div class="header">
            <button class="logout-btn" onclick="logout()">Logout</button>
        </div>

        <!-- Dashboard Section -->
        <div id="dashboard" class="section active">
            <h2>Dashboard Overview</h2>
            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="icon">📊</div>
                    <h3>25</h3>
                    <p>Total Projects</p>
                </div>
                <div class="stat-card">
                    <div class="icon">📩</div>
                    <h3>8</h3>
                    <p>New Messages</p>
                </div>
                <div class="stat-card">
                    <div class="icon">🛠️</div>
                    <h3>5</h3>
                    <p>Active Services</p>
                </div>
                <div class="stat-card">
                    <div class="icon">👥</div>
                    <h3>2</h3>
                    <p>Total Admins</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.classList.remove('active'));
            document.getElementById(sectionId).classList.add('active');
        }
        function logout() {
            alert("Logging out...");
            window.location.href = "login.php";
        }
        function addPortfolioItem() {
            alert("Add new portfolio item functionality goes here.");
            // You can open a modal or redirect to a form page for adding new items.
        }
    </script>
</body>
</html>