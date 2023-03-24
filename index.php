<!DOCTYPE html>
<html>
   <head>
      <title>Online Class Booking</title>
   </head>
   <body>
      <h1>Online Class Booking</h1>
      <form method="post" action="book_class.php">
         <label for="class">Select a class:</label>
         <select id="class" name="class">
            <option value="yoga">Yoga</option>
            <option value="pilates">Pilates</option>
            <option value="zumba">Zumba</option>
         </select>
         <label for="date">Select a date:</label>
         <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>">
         <input type="submit" value="Search">
      </form>
      
      <?php
         include "db_conn.php"; // include database connection code

         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $class = $_POST["class"];
            $date = $_POST["date"];

            // Get available timeslots
            $sql = "SELECT time FROM bookings WHERE class='$class' AND date='$date' AND status='available'";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
               echo "<h2>Available Timeslots:</h2>";
               echo "<ul>";
               while ($row = mysqli_fetch_assoc($result)) {
                  echo "<li>".$row["time"]."</li>";
               }
               echo "</ul>";
               echo "<form method='post' action='confirm_booking.php'>";
               echo "<input type='hidden' name='class' value='$class'>";
               echo "<input type='hidden' name='date' value='$date'>";
               echo "<label for='time'>Select a timeslot:</label>";
               echo "<select id='time' name='time'>";
               mysqli_data_seek($result, 0);
               while ($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='".$row["time"]."'>".$row["time"]."</option>";
               }
               echo "</select>";
               echo "<input type='submit' value='Book Now'>";
               echo "</form>";
            } else {
               echo "<p>No available timeslots found.</p>";
            }

            mysqli_close($conn);
         }
      ?>
   </body>
</html>
