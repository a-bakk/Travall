<?php

$tmp = basename($_SERVER['PHP_SELF'], ".php");

echo "<footer class='p-1 bg-primary text-white text-center " . (($tmp === "competition" || $tmp === "dec_routes" || $tmp ==="index") ? "fixed-bottom" : "position-relative") . "'>";
echo "
    <div class='container'>
        <p class='lead mt-3 fw-bold'>Copyright &copy; 2022 Travall</p>
    </div>
</footer>";