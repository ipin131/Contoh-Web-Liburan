<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    return redirect('/');
}
?>