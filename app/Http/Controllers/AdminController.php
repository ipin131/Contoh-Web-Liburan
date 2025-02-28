<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    abort(403, 'Akses tidak diizinkan!');
}

?>