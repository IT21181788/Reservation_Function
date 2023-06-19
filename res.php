<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guest_name = $_POST["guest_name"];
    $check_in_date = $_POST["check_in_date"];
    $check_out_date = $_POST["check_out_date"];
    $num_guests = $_POST["num_guests"];

    $stmt = $conn->prepare("INSERT INTO reservations (guest_name, check_in_date, check_out_date, num_guests) VALUES (:guest_name, :check_in_date, :check_out_date, :num_guests)");
    $stmt->bindParam(':guest_name', $guest_name);
    $stmt->bindParam(':check_in_date', $check_in_date);
    $stmt->bindParam(':check_out_date', $check_out_date);
    $stmt->bindParam(':num_guests', $num_guests);

    try {
        $stmt->execute();
        echo "<script>alert('Reservation added successfully!');</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>TRAVEL MATE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="res.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
 
        <h1 class="title">Travel MATE.COM</h1>
    </header>
    <a href="Register.html" class="Register-button">Register</a>
    <a href="Login.html" class="Login-button">Login</a>
    <section class="page-bg">
        <header class="header">
            <img src=".\srilanka Flag\srilanka.png.png" alt="Sri Lanka Logo" class="logo">
            <span class="country-name">Sri Lanka</span>
        </header>
        
            <table>
                <tr>
                    <th class="empty-area title-text">HOTELS|ROOMS|EVENTS</th>
                    <th class=""><form><input class="title-search" type="search" placeholder="search"></form></th>
                    <th class="title-bar"><a href="index.html">Contact</a></th>
                    <th>|</th>
                    <th class="title-bar"><a href="index.html">About-us</a></th>
                    <th>|</th>
                    <th class="title-bar"><a href="index.html">Support</a></th>
                </tr>
            </table>
      
        <div><br></div>
        <nav class="navbar">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Facilities</a></li>
                <li><a href="#">Reservation</a></li>
                <li><a href="#">Location</a></li>
                <li><a href="#">Other Service</a></li>
                <li><a href="#">Payment</a></li>
            </ul>
        </nav>

        <div class="container">
            <h2>Add Reservation</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="guest_name">Guest Name:</label>
                <input type="text" name="guest_name" required><br><br>
                <label for="check_in_date">Check-in Date:</label>
                <input type="date" name="check_in_date" required><br><br>
                <label for="check_out_date">Check-out Date:</label>
                <input type="date" name="check_out_date" required><br><br>
                <label for="num_guests">Number of Guests:</label>
                <input type="number" name="num_guests" required><br><br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </section>

    <footer class="footer">
        <div class="upper-part">
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google"></a>
            <a href="#" class="fa fa-linkedin"></a>
            <a href="#" class="fa fa-youtube"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-pinterest"></a>
            <a href="#" class="fa fa-snapchat-ghost"></a>
            <a href="#" class="fa fa-skype"></a>
            <h1>Save Your Time And Enjoy !!!! </h1>
            <p>Sign up with us then we will send you the best deals for you.</p>
        </div>
        <div class="lower-part">
            <div class="left-section">
                <div class="details">
                    <ol>
                        <li><a href="https://example.com">Countries</a></li>
                        <li><a href="https://example.com">Religions</a></li>
                        <li><a href="https://example.com">Cities</a></li>
                        <li><a href="https://example.com">Districts</a></li>
                        <li><a href="https://example.com">Apartments</a></li>
                        <li><a href="https://example.com">Airports</a></li>
                        <li><a href="https://example.com">Hospitals</a></li>
                        <li><a href="https://example.com">Places of Interests</a></li>
                    </ol>
                    <img src=".\footer images\miami-luxury-house.jpg" width="400px" height="380px" alt="image">
                </div>
            </div>
            <div class="middle-section">
                <div class="details">
                    <ol>
                        <li><a href="https://example.com">Homes</a></li>
                        <li><a href="https://example.com">Apartments</a></li>
                        <li><a href="https://example.com">Resorts</a></li>
                        <li><a href="https://example.com">Villas</a></li>
                        <li><a href="https://example.com">Hotels</a></li>
                        <li><a href="https://example.com">Guest Houses</a></li>
                        <li><a href="https://example.com">Cabanas</a></li>
                    </ol>
                    <br> <br> <br> <br><br> <br> <br>
                    <div class="mail">
                        <img src="./icons/icons8-email-48.png" class="footer-mail">
                        <p class="f-t-1">TravelMate123@gmail.com/travlblog@gmail.com</p>
                    </div>
                    <div class="address">
                        <img src=".\icons\icons8-address-48.png" class="footer-address">
                        <p class="f-t-2">No. 581, Kandy road ,Malabe</p>
                    </div>
                    <div class="phone">
                        <img src=".\icons\icons8-phone-48.png" class="footer-phone">
                        <p class="f-t-3">011-2846331/077-2092336</p>
                    </div>
                    <br> <br> <br>
                    &copy; 2023 Travel Mate. All rights reserved. | S.L.I.I.T 04.02 Group MLB_04.02_05 |
                </div>
            </div>
            <div class="right-section">
                <div class="details">
                    <ol>
                        <li><a href="https://example.com">COVID 19</a></li>
                        <li><a href="https://example.com">About Travel mate.com</a></li>
                        <li><a href="https://example.com">Customer Services help</a></li>
                        <li><a href="https://example.com">Partner help</a></li>
                        <li><a href="https://example.com">Careers</a></li>
                        <li><a href="https://example.com">Content Guideline</a></li>
                        <li><a href="https://example.com">Terms and Conditions</a></li>
                        <li><a href="https://example.com">How We Work</a></li>
                    </ol>
                    <img src=".\footer images\sunset-pool.jpg" width="400px" height="380px" alt="image">
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
