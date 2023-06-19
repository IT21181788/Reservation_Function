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

// Retrieve reservations from the database
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM reservations WHERE guest_name LIKE :search");
    $stmt->bindValue(':search', '%' . $search . '%');
} else {
    $stmt = $conn->query("SELECT * FROM reservations");
}

try {
    $stmt->execute();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Delete a reservation from the database
if (isset($_GET['delete'])) {
    $reservation_ID = $_GET['delete'];

    try {
        $stmt = $conn->prepare("DELETE FROM reservations WHERE reservation_ID = :reservation_ID");
        $stmt->bindParam(':reservation_ID', $reservation_ID);
        $stmt->execute();
        echo "<script>alert('Reservation deleted successfully.');</script>";
    } catch (PDOException $e) {
        echo "Error deleting reservation: " . $e->getMessage();
    }
}

// Edit a reservation
if (isset($_GET['edit'])) {
    $reservation_ID = $_GET['edit'];

    // Retrieve reservation details from the database
    try {
        $stmt = $conn->prepare("SELECT * FROM reservations WHERE reservation_ID = :reservation_ID");
        $stmt->bindParam(':reservation_ID', $reservation_ID);
        $stmt->execute();
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error retrieving reservation details: " . $e->getMessage();
    }
}

// Update a reservation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $reservation_ID = $_POST['reservation_ID'];
    $guest_name = $_POST['guest_name'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $num_guests = $_POST['num_guests'];

    try {
        $stmt = $conn->prepare("UPDATE reservations SET guest_name = :guest_name, check_in_date = :check_in_date, check_out_date = :check_out_date, num_guests = :num_guests WHERE reservation_ID = :reservation_ID");
        $stmt->bindParam(':guest_name', $guest_name);
        $stmt->bindParam(':check_in_date', $check_in_date);
        $stmt->bindParam(':check_out_date', $check_out_date);
        $stmt->bindParam(':num_guests', $num_guests);
        $stmt->bindParam(':reservation_ID', $reservation_ID);
        $stmt->execute();
        echo "<script>alert('Reservation updated successfully.');</script>";
    } catch (PDOException $e) {
        echo "Error updating reservation: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservation List</title>
    <link rel="stylesheet" href="res.css">
    <link rel="stylesheet" href="resList.css">
    <script>
        function editReservation(reservation_ID) {
            window.location.href = "index.php?edit=" + reservation_ID;
        }
        
        function deleteReservation(reservation_ID) {
            console.log("Delete reservation with ID: " + reservation_ID);
            window.location.href = "list.php?delete=" + reservation_ID;
        }
    </script>
</head>
<body>
    <nav>
        <ul>
            <li><a href="user.php">Home</a></li>
            <li><a href="#">Facilities</a></li>
            <li><a href="res.php">Reservation</a></li>
            <li><a href="#">Location</a></li>
            <li><a href="#">Otherservice</a></li>
            <li><a href="#">Payment</a></li>
        </ul>
    </nav>
    <br>
    <div class="container">
        <?php if (isset($_GET['edit']) && isset($reservation)) { ?>
            <h2>Edit Reservation</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="reservation_ID" value="<?php echo $reservation['reservation_ID']; ?>">
                <label for="guest_name">Guest Name:</label>
                <input type="text" name="guest_name" value="<?php echo $reservation['guest_name']; ?>" required><br><br>
                <label for="check_in_date">Check-in Date:</label>
                <input type="date" name="check_in_date" value="<?php echo $reservation['check_in_date']; ?>" required><br><br>
                <label for="check_out_date">Check-out Date:</label>
                <input type="date" name="check_out_date" value="<?php echo $reservation['check_out_date']; ?>" required><br><br>
                <label for="num_guests">Number of Guests:</label>
                <input type="number" name="num_guests" value="<?php echo $reservation['num_guests']; ?>" required><br><br>
                <input type="submit" name="update" value="Update">
            </form>
        <?php } else { ?>
            <h2>Reservation List</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="search" placeholder="Search by guest name">
                <input type="submit" value="Search">
            </form>
            <table>
                <thead>
                    <tr>
                        <th>res-ID</th>
                        <th>Guest Name</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Number of Guests</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation) { ?>
                    <tr>
                        <td><?php echo $reservation['reservation_ID']; ?></td>
                        <td><?php echo $reservation['guest_name']; ?></td>
                        <td><?php echo $reservation['check_in_date']; ?></td>
                        <td><?php echo $reservation['check_out_date']; ?></td>
                        <td><?php echo $reservation['num_guests']; ?></td>
                        <td>
                            <button class="edit-button" onclick="editReservation(<?php echo $reservation['reservation_ID']; ?>)">Edit</button>
                            <button class="delete-button" onclick="deleteReservation(<?php echo $reservation['reservation_ID']; ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</body>
</html>
