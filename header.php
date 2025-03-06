<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveNgo</title>

    <style>
        /* General Header Styles */
        header {
            background-color: #28a745; /* Dark Green */
            padding: 10px 20px;
            height: 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Logo & Title */
        .logo-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .header-title {
            font-size: 26px;
            font-weight: bold;
            color: white;
            margin: 0;
        }

        /* Navigation */
        nav {
            display: flex;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            padding: 0;
            margin: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        nav ul li a:hover {
            color: black;
        }

        /* Profile Icon */
        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        /* Profile Dropdown */
        .profile-popup {
            display: none;
            position: absolute;
            right: 10px;
            top: 60px;
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            min-width: 120px;
            z-index: 100;
        }

        .profile-popup a {
            display: block;
            text-align: center;
            padding: 8px;
            text-decoration: none;
            color: #28a745;
            font-weight: bold;
        }

        .profile-popup a:hover {
            background-color: black;
            color: white;
            border-radius: 5px;
        }

        /* Hamburger Menu (Mobile) */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }

        .hamburger .line {
            width: 25px;
            height: 3px;
            background-color: white;
            border-radius: 5px;
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            position: absolute;
            top: 60px;
            right: 10px;
            background-color: white;
            width: 200px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: center;
            z-index: 100;
        }

        .mobile-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-menu ul li {
            margin: 10px 0;
        }

        .mobile-menu ul li a {
            text-decoration: none;
            color: #28a745;
            font-weight: bold;
            display: block;
            padding: 10px;
        }

        .mobile-menu ul li a:hover {
            background-color: black;
            color: white;
            border-radius: 5px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            nav {
                display: none; /* Hide nav on mobile */
            }

            .hamburger {
                display: flex; /* Show hamburger */
            }

            .profile-icon {
                display: none; /* Hide profile icon */
            }
        }
    </style>
</head>
<body>

<header>
    <!-- Left Side: Logo & Title -->
    <div class="logo-title">
        <img src="images/Logo.png" alt="Logo" class="logo">
        <h1 class="header-title">DriveNgo</h1>
    </div>

    <!-- Navigation (Only for Larger Screens) -->
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="location.php">Location</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <!-- Profile Icon (Only for Larger Screens) -->
    <img src="images/profilelogo.png" alt="Profile" class="profile-icon" id="profileButton">

    <!-- Profile Popup -->
    <div class="profile-popup" id="profilePopup">
        <a href="#" id="profileLink">Profile</a>
        <a href="#" id="logoutButton">Logout</a>
        <a href="admin/admin.html" id="adminButton">Admin</a>
    </div>

    <!-- Hamburger Menu (Only for Mobile) -->
    <div class="hamburger" id="hamburgerIcon">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </div>

    <!-- Mobile Menu (Contains Navigation & Profile) -->
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="location.php">Location</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="#" id="profileLinkMobile">Profile</a></li>
            <li><a href="#" id="logoutButtonMobile">Logout</a></li>
            <li><a href="admin/admin.html" id="adminButtonMobile">Admin</a></li>
        </ul>
    </div>
</header>

<script>
    // Profile Menu Toggle (For Desktop)
    document.getElementById("profileButton").addEventListener("click", function(event) {
        event.stopPropagation();
        var popup = document.getElementById("profilePopup");
        popup.style.display = popup.style.display === "block" ? "none" : "block";
    });

    // Close Profile Menu on Click Outside
    document.addEventListener("click", function(event) {
        var profilePopup = document.getElementById("profilePopup");
        if (!document.getElementById("profileButton").contains(event.target)) {
            profilePopup.style.display = "none";
        }
    });

    // Mobile Menu Toggle
    document.getElementById("hamburgerIcon").addEventListener("click", function(event) {
        event.stopPropagation();
        var menu = document.getElementById("mobileMenu");
        menu.style.display = menu.style.display === "block" ? "none" : "block";
    });

    // Close Mobile Menu on Click Outside
    document.addEventListener("click", function(event) {
        var mobileMenu = document.getElementById("mobileMenu");
        if (!document.getElementById("hamburgerIcon").contains(event.target)) {
            mobileMenu.style.display = "none";
        }
    });
</script>

</body>
</html>
