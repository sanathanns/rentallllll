<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the email from the form submission
    $email = $_POST['email'];

    // Here you can save the email to a database or handle it accordingly.
    // For this example, we'll just display it as a simple confirmation message.
    echo "<script>alert('Thank you for signing up with $email!');</script>";
}

// Database Connection
$conn = new mysqli("127.0.0.1", "root", "", "rental");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Total Counts
$totalSubscribers = $conn->query("SELECT COUNT(*) AS count FROM subscribe")->fetch_assoc()['count'];
$totalBookings = $conn->query("SELECT COUNT(*) AS count FROM book")->fetch_assoc()['count'];
$totalVehicles = $conn->query("SELECT COUNT(*) AS count FROM vehicles")->fetch_assoc()['count'];

// Fetch Latest Bookings
$bookings = $conn->query("SELECT b.id, b.BookName, b.BookEmail, b.trip_start, b.trip_end, b.payment_option FROM book b ORDER BY b.id DESC LIMIT 5");

// Fetch Latest Users
$users = $conn->query("SELECT id, name, email,profile_image, created_at FROM users ORDER BY id DESC LIMIT 5");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Services</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Bootstrap JS and Popper.js (required for some components) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="allinone.css">
    <style>
           /* General Container Styling */
/* General Container Styling */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}




.container {
    width: 80%;
    margin: auto;
    overflow: hidden;
    padding: 20px;
}



.heading {
    text-align: center;
    margin-bottom: 20px;
}

.heading h2 {
    margin-bottom: 10px;
}

.heading p {
    margin-bottom: 20px;
}

.heading img {
    width: 50px;
    height: auto;
    margin-right: 10px;
    vertical-align: middle;
}

/* Stats Container */
.stats {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center; /* Center the stats horizontally */
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px auto; /* Added margin for spacing */
    max-width: 1200px; /* Limit the width for better readability */
}

.stat {
    flex: 1;
    min-width: 200px;
    text-align: center;
    padding: 16px;
    border-radius: 8px;
    background-color: #f9fafb;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.stat-figure {
    margin-bottom: 12px;
}

.stat-figure svg {
    width: 32px;
    height: 32px;
}

.stat-figure .avatar {
    display: inline-block;
}

.stat-figure .avatar img {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    object-fit: cover;
}

.stat-title {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 24px;
    font-weight: bold;
    color: #1f2937;
    margin-bottom: 8px;
}

.stat-value.text-primary {
    color: #3b82f6;
}

.stat-value.text-secondary {
    color: #6b7280;
}

.stat-desc {
    font-size: 12px;
    color: #6b7280;
}

.stat-desc.text-secondary {
    color: #6b7280;
}

.avatar.online::before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 12px;
    height: 12px;
    background-color: #10b981;
    border-radius: 50%;
    border: 2px solid #ffffff;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stats {
        flex-direction: column;
    }

    .stat {
        min-width: 100%;
    }
}


.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.card {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.icon {
    font-size: 3rem;
    margin-bottom: 15px;
    color: #4CAF50; /* Green color for icons */
}

.card h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #333;
}

.card p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 20px;
    line-height: 1.6;
}

.card a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50; /* Green color for button */
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.card a:hover {
    background-color: #45a049; /* Darker green on hover */
}
/* Contact Us Section */
.contact-container {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-container {
    flex: 1;
    min-width: 300px;
    padding: 20px;
}

.form-container h1 {
    font-size: 2rem;
    color: #333;
}

.form-container p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 20px;
    line-height: 1.6;
}

.form-container strong {
    color: #333;
}

#contact-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

#contact-form input,
#contact-form textarea {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.3s ease;
}

#contact-form input:focus,
#contact-form textarea:focus {
    border-color: #4CAF50; /* Green border on focus */
}

#contact-form textarea {
    resize: vertical;
    min-height: 150px;
}

#contact-form button {
    padding: 10px 20px;
    background-color: #4CAF50; /* Green button */
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#contact-form button:hover {
    background-color: #45a049; /* Darker green on hover */
}

.info-container {
    flex: 1;
    min-width: 300px;
    padding: 20px;
}

.info-section {
    margin-bottom: 30px;
}

.info-section h2 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: #333;
}

.info-card {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    padding: 15px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.info-card img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.info-card p {
    margin: 0;
    font-size: 0.9rem;
    color: #666;
}

.info-card strong {
    color: #333;
    font-size: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-container {
        flex-direction: column;
    }

    .form-container,
    .info-container {
        width: 100%;
    }
}

/* customer services card conatainer*/
.card-container {
    display: flex;
    flex-wrap: wrap; /* Allows the cards to wrap onto new lines on smaller screens */
    justify-content: space-between; /* Adjusts the space between cards */
}

.card {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 10px;
    flex: 0 1 23%; /* Ensures the cards take up about 23% of the width */
    transition: transform 0.2s;
}

.heading-image {
    width: 30px; /* Set the size of the image */
    height: auto; /* Maintain aspect ratio */
    margin-right: 10px; /* Add some space between the image and the text */
    vertical-align: middle; /* Align the image vertically with the text */
}

.card img {
    width: 100%; /* Make the image take up the full width of the card */
    height: auto; /* Maintain the aspect ratio */
    border-radius: 10px; /* Optional: rounds the corners of the image */
    margin-bottom: 15px; /* Adds space between the image and the text */
}

h1 {
            text-align: center;
            margin-bottom: 20px;
        }

/* Responsive styles for smaller screens */
@media screen and (max-width: 1200px) {
    .card {
        flex: 0 1 30%; /* Take up 30% on medium-sized screens (desktops/tablets) */
    }
}

@media screen and (max-width: 768px) {
    .card {
        flex: 0 1 45%; /* Take up 45% on tablets and smaller desktops */
    }
}

@media screen and (max-width: 480px) {
    .card {
        flex: 0 1 100%; /* Take up full width on mobile screens */
    }
}
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
<!-- customer services containers -->

<div class="container">
        <h1>Customer Services</h1>
        <div class="card-container">
            <div class="card">
            <h2>
    <img src="admin/book-img/rental.jpeg" alt="Image description" class="heading-image">
    Special Rates for Car Booking
</h2>

                <p>We’re excited to offer you special rates on car bookings as part of our exclusive promotion. Whether you're planning a weekend getaway, a business trip, or a family vacation, we have the perfect car waiting for you at unbeatable prices.</p>
            </div>
            <div class="card">
                <h2><img src="admin/book-img/ph-re.jpg" alt="Image description" class="heading-image">
                    📱 Mobile Phone Reservation</h2>
                <p>We’re thrilled to announce that you can now reserve your preferred mobile phone with us! Be the first to own the latest models, enjoy exclusive offers, and secure your device hassle-free.</p>
            </div>
            <div class="card">
                <h2><img src="admin/book-img/miles.jpg" alt="Image description" class="heading-image">
                    🗺 Unlimited Miles Car Rental</h2>
                <p>Are you planning your next road trip or a long journey? With our Unlimited Miles Car Rental, the road is yours to explore without worrying about distance limits!</p>
            </div>
            <div class="card">
                <h2><img src="admin/book-img/oneway.jpg" alt="Image description" class="heading-image">
                    🚗 One Way Car Rentals</h2>
                <p>Looking for a flexible travel solution? With our One-Way Car Rentals, you can pick up a car at one location and drop it off at another – no need to return to your starting point!</p>
            </div>
        </div>



    <h1 style="font-size: 2rem;font-weight: bold; color: #333; margin-bottom: 20px;">Rental Services</h1>
    <div class="stats">
    <!-- Total Subscribers -->
    <div class="stat">
        <div class="stat-figure text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-8 w-8 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <div class="stat-title">Total Subscribers</div>
        <div class="stat-value text-primary"><?= $totalSubscribers; ?></div>
        <div class="stat-desc">21% more than last month</div>
    </div>

    <!-- Total Bookings -->
    <div class="stat">
        <div class="stat-figure text-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-8 w-8 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
        </div>
        <div class="stat-title">Total Bookings</div>
        <div class="stat-value text-secondary"><?= $totalBookings; ?></div>
        <div class="stat-desc">21% more than last month</div>
    </div>

    <!-- Total Vehicles -->
    <div class="stat">
        <div class="stat-figure text-secondary">
            <div class="avatar online">
                <div class="w-16 rounded-full">
                    <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
            </div>
        </div>
        <div class="stat-value"><?= $totalVehicles; ?></div>
        <div class="stat-title">Total Vehicles</div>
        <div class="stat-desc text-secondary">Available for rental</div>
    </div>
</div>
<div>
    <h1 style="font-size: 2rem;font-weight: bold; color: #333; margin-bottom: 20px;">Protections & Coverages - DriveNGo</h1>
    <div class="grid">
        <div class="card">
            <div class="icon">🚗</div>
            <h3>Extended Roadside Assistance</h3>
            <p>Get fast, reliable emergency road assistance for a worry-free drive.</p>
            <a href="extended-roadside.html">Learn More ></a>
        </div>
        <div class="card">
            <div class="icon">🔒</div>
            <h3>Loss Damage Waiver (LDW)</h3>
            <p>Protect yourself from financial responsibility in case of damage or theft.</p>
            <a href="loss-damage.html">Learn More ></a>
        </div>
        <div class="card">
            <div class="icon">👨‍⚕️</div>
            <h3>Personal Accident Insurance (PAI)</h3>
            <p>Cover medical expenses and protect passengers in case of an accident.</p>
            <a href="personal-accident.html">Learn More ></a>
        </div>
        <div class="card">
            <div class="icon">🛡️</div>
            <h3>Additional Liability Insurance (ALI)</h3>
            <p>Get additional liability coverage up to $500,000.</p>
            <a href="additional-liability.html">Learn More ></a>
        </div>
        <div class="card">
            <div class="icon">💊</div>
            <h3>Emergency Sickness Plan (ESP)</h3>
            <p>Covers medical emergencies while renting your vehicle.</p>
            <a href="emergency-sickness.html">Learn More ></a>
        </div>
        <div class="card">
            <div class="icon">🎒</div>
            <h3>Personal Effects Insurance (PEP)</h3>
            <p>Get insurance for your personal belongings during your rental period.</p>
            <a href="personal-effects.html">Learn More ></a>
        </div>
    </div>
</div>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php'; // Ensure PHPMailer is installed

    $servername = "localhost";
    $username = "root"; // Change if using a different database user
    $password = ""; // Add password if applicable
    $database = "rental";
    $admin_emails = ["ajithgpet@gmail.com", "ajithakku33@gmail.com", "punithnc005@gmail.com"]; // Multiple admins

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['first-name'];
        $email = $_POST['email'];
        $mobile = $_POST['phone-number'];
        $message = $_POST['message'];

        $sql = "INSERT INTO contacts (name, email, mobile, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $mobile, $message);

        if ($stmt->execute()) {
            echo "Contact details added successfully!";

            // Send email to multiple admins
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Use your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'ajithgpet@gmail.com'; // Your SMTP email
                $mail->Password = 'zlwy tqba glyh vbci'; // Your SMTP password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom($email, $name);
                foreach ($admin_emails as $admin_email) {
                    $mail->addAddress($admin_email);
                }

                $mail->isHTML(true);
                $mail->Subject = "New Contact Form Submission";
                $mail->Body = "<h3>New Contact Inquiry</h3>
                              <p><strong>Name:</strong> $name</p>
                              <p><strong>Email:</strong> $email</p>
                              <p><strong>Mobile:</strong> $mobile</p>
                              <p><strong>Message:</strong> $message</p>";

                $mail->send();
                echo "Email sent successfully to all admins!";
            } catch (Exception $e) {
                echo "Email sending failed: " . $mail->ErrorInfo;
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
    ?>

    <h1 style="font-size: 2rem;font-weight: bold; color: #333; margin-bottom: 20px;"><center>Need Any Help? Contact Us 24/7</center></h1>
    <div id="header-placeholder"></div>
    <div class="contact-container">
        <div class="form-container">
            <h1>Contact Us</h1>
            <p>You have any questions or need additional information?</p>
            <p><strong>Address:</strong> JSS POLYTECHNIC/ Mysore City, Karnataka 570006</p>
            <form id="contact-form" method="POST" action="">
                <input type="text" name="first-name" id="first-name" placeholder="Name" required>
                <input type="text" name="phone-number" id="phone-number" placeholder="Phone Number" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <textarea name="message" id="message" placeholder="Message" required></textarea>
                <button type="submit">Submit Message</button>
            </form>
        </div>
        <div class="info-container">
            <div class="info-section">
                <h2>Customer Center</h2>
                <div class="info-card">
                    <img src="https://via.placeholder.com/50" alt="Punith NC">
                    <div>
                        <p><strong>Punith NC</strong></p>
                        <p>Phone: 8453408707</p>
                        <p>Email: punithnc7718@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="info-section">
                <h2>Change or Cancel Reservation</h2>
                <div class="info-card">
                    <img src="https://via.placeholder.com/50" alt="Swaroop">
                    <div>
                        <p><strong>Swaroop S</strong></p>
                        <p>Phone: 9353312537</p>
                        <p>Email: swaroopswaroop9353@gmail.com</p>
                    </div>
                </div>
                <div class="info-card">
                    <img src="https://via.placeholder.com/50" alt="Ajith">
                    <div>
                        <p><strong>Ajith M</strong></p>
                        <p>Phone: 8217048300</p>
                        <p>Email: ajithakku33@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="service.js"></script>
    <script>
        // JavaScript for additional client-side handling
        document.getElementById("offerForm").addEventListener("submit", function(event) {
            event.preventDefault();
            let email = event.target.elements['email'].value;

            if (email) {
                alert(`Thank you for signing up with ${email}!`);
                event.target.elements['email'].value = ''; // Clear the input field
            } else {
                alert('Please enter a valid email address.');
            }
        });
    </script>
</body>

</html>

