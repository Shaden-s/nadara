<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<h2 style="padding:20px;">Contact Us</h2>

<div style="padding:20px;">

    <!-- contact info -->
    <p>Location: Dammam, Saudi Arabia</p>
    <p>Email: nadara@shop.com</p>

    <!-- google map -->
    <iframe 
    width="300" 
    height="200"
    src="https://maps.google.com/maps?q=dammam&output=embed">
    </iframe>

    <!-- contact form -->
    <form id="contactForm" style="margin-top:20px;">

        <input type="text" name="name" placeholder="Your Name" required><br><br>

        <input type="email" name="email" placeholder="Your Email" required><br><br>

        <textarea name="message" placeholder="Your Message" required></textarea><br><br>

        <button type="submit">Send</button>

    </form>

</div>

<script>
// form validation
document.getElementById("contactForm").addEventListener("submit", function(e){

    let name = document.querySelector("input[name='name']").value;
    let email = document.querySelector("input[name='email']").value;
    let message = document.querySelector("textarea[name='message']").value;

    if(name === "" || email === "" || message === ""){
        alert("Please fill all fields");
        e.preventDefault();
    } else {
        alert("Message sent successfully!");
    }

});
</script>

</body>
</html>