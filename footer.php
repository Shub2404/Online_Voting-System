<footer class="footer">
    <p><b>Declaration:</b> PROJECT BY <strong>SHUBHANKAR TIWARI & SNEHA JAISWAL</strong></p>
</footer>

<script>
    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute("href")).scrollIntoView({
                behavior: "smooth"
            });
        });
    });
</script>

</body>
</html>
