

<!-- Container for Ads -->

<script>
function invokePhpFunction(pub_id) {
	console.log('job Clicked');
    // Make an AJAX request to your PHP script to execute the desired function
    // Example using jQuery AJAX:
    $.ajax({
        url: 'jobClicked.php?id='+pub_id, // Replace 'your_php_script.php' with the path to your PHP script
        type: 'POST',
        data: { action: 'jobClicked' }, // Pass any necessary data to your PHP function
        success: function(response) {
            // Handle the response if needed
            console.log(response);
            if (response == "1 records UPDATED successfully <br>true") {
                return true;
            } else {
                return false;
            }
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
            return false;
        }
    });
}
</script>

<?php 
  
  require_once __DIR__ . "/../../../Controller/pub_con.php";

  $pubC = new pubCon("dmd");

?>


<?php

if ($add_type == "center") {

?>


<!-- Center -->
<div id="ad-container" style="margin: 20px; text-align: center;">
<?php 
	$pubC->generate_pub(); // affichage des pubs
?>
</div>
<!-- End Center -->

<?php

}

?>

<?php

if ($add_type == "left") {

?>

<!-- Left -->
<div id="ad-container" style="margin: 20px;">
<?php 
	$pubC->generate_pub(); // affichage des pubs
?>
</div>
<!-- End Left -->

<?php

}

?>

<?php

if ($add_type == "right") {

?>

<!-- Right -->
<div id="ad-container" style="margin: 20px; text-align: end;">
<?php 
	$pubC->generate_pub(); // affichage des pubs
?>
</div>
<!-- End Right -->

<?php

}

?>



<!-- End Container for Ads -->


